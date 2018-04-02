--FUNCIONA--------------------------------------------------

DROP TRIGGER IF EXISTS notification_follow ON Follows;
DROP FUNCTION IF EXISTS create_notification_follow();

CREATE FUNCTION create_notification_follow()
RETURNS trigger AS
$notification_follow$
BEGIN
INSERT INTO Notifications (type, target_user_id, user_id)
VALUES ('FollowMe', NEW.followed_user_id, NEW.follower_user_id);
RETURN NEW;
END;
$notification_follow$ LANGUAGE plpgsql;

CREATE TRIGGER notification_follow
AFTER INSERT ON Follows
FOR EACH ROW EXECUTE PROCEDURE create_notification_follow();


DROP TRIGGER IF EXISTS score_vote_add ON Votes;

DROP FUNCTION IF EXISTS update_score_add_vote();

CREATE FUNCTION update_score_add_vote()
RETURNS trigger AS
$score_vote_add$
BEGIN
IF NEW.type = TRUE THEN -- upvoted
UPDATE News SET votes = votes + 1
WHERE News.id = NEW.news_id;
UPDATE Users SET points = points + 1
WHERE Users.id = (SELECT Users.id
	FROM Users INNER JOIN News ON (Users.id = News.author_id)
	WHERE  NEW.news_id = News.id);
	ELSE -- downvoted
	UPDATE News SET votes = votes - 1
	WHERE News.id =  NEW.news_id;
	UPDATE Users SET points = points - 1
	WHERE Users.id = (SELECT Users.id
		FROM Users INNER JOIN News ON (Users.id = News.author_id)
		WHERE  NEW.news_id = News.id);
		END IF;
		RETURN NEW;
		END;
		$score_vote_add$ LANGUAGE plpgsql;

CREATE TRIGGER score_vote_add
AFTER INSERT ON Votes
FOR EACH ROW EXECUTE PROCEDURE update_score_add_vote();

--END    FUNCIONA_-------------------------------------------------

DROP TRIGGER IF EXISTS score_vote_change ON Votes;
DROP TRIGGER IF EXISTS score_vote_remove ON Votes;
DROP FUNCTION IF EXISTS update_score_change_vote();
DROP FUNCTION IF EXISTS update_score_remove_vote();



CREATE TRIGGER score_vote_change
AFTER UPDATE ON Votes
EXECUTE PROCEDURE update_score_change_vote();

CREATE TRIGGER score_vote_remove
AFTER DELETE ON Votes
EXECUTE PROCEDURE update_score_remove_vote();



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



-- Increment/decrement news and news' author points when adding a Votes entry.


CREATE FUNCTION update_score_change_vote()
RETURNS trigger AS
$BODY$
BEGIN
	IF NEW.type IS TRUE AND OLD.type IS FALSE THEN -- changed downvote to upvote
		UPDATE News SET votes = votes + 2
			WHERE News.id = NEW.news_id;
		UPDATE Users SET points = points + 2
			WHERE Users.id = (SELECT id
												FROM Users INNER JOIN News ON (Users.id = News.author_id)
												WHERE NEW.news_id = News.id);
	ELSE
		IF NEW.type IS false AND OLD.type IS TRUE THEN -- changed upvote to downvote
			UPDATE News SET votes = votes - 2
			WHERE News.id = NEW.news_id;
		UPDATE Users SET points = points - 2
			WHERE Users.id = (SELECT id
												FROM Users INNER JOIN News ON (Users.id = News.author_id)
												WHERE NEW.news_id = News.id);
		END IF;
	END IF;
	RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;

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
	RETURN NEW;
END;
$BODY$ LANGUAGE plpgsql;



--Notificacao de quando alguem comenta uma noticia minha
CREATE OR REPLACE FUNCTION create_notification_comment(target_news_id integer)
RETURNS trigger AS $$
BEGIN
  INSERT INTO Notifications (type, target_user_id, news_id)
    VALUES ('CommentMyPost',
			(SELECT author_id  FROM News WHERE id = target_news_id), target_news_id);
	RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

--Notificacao de quando alguem que seguimos publica uma noticia
CREATE OR REPLACE FUNCTION create_notification_followed_publish(target integer, followed integer, new_id integer)
RETURNS trigger AS $$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id, news_id)
    VALUES ('FollowedPublish', target, followed, news_id);
	RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

--Notificacao de quando alguem que seguimos publica uma noticia
CREATE OR REPLACE FUNCTION create_notification_followed_publish(target integer, user_voted integer, new_id integer)
RETURNS trigger AS $$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id, news_id)
    VALUES ('VoteMyPost', target, user_voted, news_id);
	RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';


--Teste

DROP TRIGGER IF EXISTS notification_follow ON Follows;

CREATE TRIGGER notification_follow
	AFTER INSERT ON Follows
	EXECUTE PROCEDURE create_notification_follow(NEW.follower_user_id, NEW.followed_user_id);

CREATE FUNCTION create_notification_follow(follower_user_id integer, followed_user_id integer)
RETURNS trigger AS
$BODY$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id)
    VALUES ('FollowMe', followed_user_id, follower_user_id);
	RETURN NEW;
END;
$BODY$

INSERT INTO Follows(follower_user_id, followed_user_id) VALUES (2, 1);

SELECT * FROM Notifications WHERE Notifications.target_user_id = 1;
