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
EXECUTE PROCEDURE create_notification_follow;


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
CREATE FUNCTION create_notification_follow()
RETURNS trigger AS
$BODY$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id)
    VALUES ('FollowMe', NEW.followed_user_id, follower_used_id);
END;
$BODY$