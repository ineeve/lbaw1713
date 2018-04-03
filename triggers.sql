-- TRIGGERS

DROP TRIGGER IF EXISTS score_vote;
DROP TRIGGER IF EXISTS score_vote_remove;
DROP TRIGGER IF EXISTS notification_follow;

CREATE TRIGGER score_vote
AFTER INSERT ON Votes
EXECUTE PROCEDURE update_score_add_vote;

CREATE TRIGGER score_vote_remove
AFTER DELETE ON Votes
EXECUTE PROCEDURE update_score_remove_vote;

CREATE TRIGGER notification_follow
	AFTER INSERT ON Follows
	EXECUTE PROCEDURE create_notification_follow(NEW.follower_user_id, NEW.followed_user_id);

CREATE TRIGGER notification_comment
  AFTER INSERT ON Comments
  EXECUTE PROCEDURE create_notification_comment(NEW.id);

CREATE TRIGGER notification_followed_publish
  AFTER INSERT ON News
	FOR EACH ROW
  EXECUTE PROCEDURE create_notification_followed_publish((SELECT Users.id FROM Users
	INNER JOIN Follows ON Users.id = Follows.follower_user_id
WHERE Follows.followed_user_id = NEW.author_id), NEW.author_id, NEW.id);

CREATE TRIGGER notification_vote_my_post
  AFTER INSERT ON Votes
	EXECUTE PROCEDURE create_notification_vote_my_post((SELECT Users.id FROM Users
	INNER JOIN News ON Users.id = News.author_id
WHERE News.id = NEW.news_id), NEW.user_id, NEW.news_id);

-- FUNCTIONS

DROP FUNCTION IF EXISTS update_score_add_vote;
DROP FUNCTION IF EXISTS update_score_remove_vote;
DROP FUNCTION IF EXISTS create_notification_follow;

-- Increment/decrement news and news' author points when adding a Votes entry.
CREATE FUNCTION update_score_add_vote()
RETURNS trigger AS
$BODY$
BEGIN
	IF NEW.type IS TRUE THEN -- upvoted
		UPDATE News SET votes = votes + 1
			WHERE News.id = NEW.news_id;
		UPDATE Users SET points = points + 1
			WHERE Users.id = (SELECT id
												FROM Users INNER JOIN News ON (Users.id = News.author_id)
												WHERE NEW.news_id = News.id);
	ELSE -- downvoted
		UPDATE News SET votes = votes - 1
			WHERE News.id = NEW.news_id;
		UPDATE Users SET points = points - 1
			WHERE Users.id = (SELECT id
												FROM Users INNER JOIN News ON (Users.id = News.author_id)
												WHERE NEW.news_id = News.id);
	END IF;
END;
$BODY$

-- Increment/decrement news and news' author points when removing a Votes entry.
CREATE FUNCTION update_score_remove_vote()
RETURNS trigger AS
$BODY$
BEGIN
	IF OLD.type IS TRUE THEN -- removed upvote
		UPDATE News SET votes = votes - 1
			WHERE News.id = NEW.news_id;
		UPDATE Users SET points = points - 1
			WHERE Users.id = (SELECT id
												FROM Users INNER JOIN News ON (Users.id = News.author_id)
												WHERE NEW.news_id = News.id);
	ELSE -- removed downvote
		UPDATE News SET votes = votes + 1
			WHERE News.id = NEW.news_id;
		UPDATE Users SET points = points + 1
			WHERE Users.id = (SELECT id
												FROM Users INNER JOIN News ON (Users.id = News.author_id)
												WHERE NEW.news_id = News.id);
	END IF;
END;
$BODY$

-- Insert new notification for an user when someone else follows him.
CREATE FUNCTION create_notification_follow(follower_user_id integer, followed_user_id integer)
RETURNS trigger AS
$BODY$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id)
    VALUES ('FollowMe', followed_user_id, follower_user_id);
END;
$BODY$
--Notificacao de quando alguem comenta uma noticia minha
CREATE OR REPLACE FUNCTION create_notification_comment(target_news_id integer)
RETURNS trigger AS $$
BEGIN
  INSERT INTO Notifications (type, target_user_id, news_id)
    VALUES ('CommentMyPost',
			(SELECT author_id  FROM News WHERE id = target_news_id), target_news_id);
END;
$$ LANGUAGE 'plpgsql';

--Notificacao de quando alguem que seguimos publica uma noticia
CREATE OR REPLACE FUNCTION create_notification_followed_publish(target integer, followed integer, new_id integer)
RETURNS trigger AS $$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id, news_id)
    VALUES ('FollowedPublish', target, followed, news_id);
END;
$$ LANGUAGE 'plpgsql';

--Notificacao de quando alguem que seguimos publica uma noticia
CREATE OR REPLACE FUNCTION create_notification_followed_publish(target integer, user_voted integer, new_id integer)
RETURNS trigger AS $$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id, news_id)
    VALUES ('VoteMyPost', target, user_voted, news_id);
END;
$$ LANGUAGE 'plpgsql';
