

--FUNCIONA--------------------------------------------------

DROP TRIGGER IF EXISTS notification_follow ON Follows;
DROP FUNCTION IF EXISTS create_notification_follow();

--Notificacao de quando alguem comenta uma noticia minha

CREATE FUNCTION create_notification_follow()
RETURNS trigger AS
$$
BEGIN
INSERT INTO Notifications (type, target_user_id, user_id)
VALUES ('FollowMe', NEW.followed_user_id, NEW.follower_user_id);
RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER notification_follow
AFTER INSERT ON Follows
FOR EACH ROW EXECUTE PROCEDURE create_notification_follow();

--TESTAR :
-- INSERT INTO Comments(text, creator_user_id, target_news_id) VALUES ('ola', 2, 1);
-- SELECT * FROM Notifications WHERE Notifications.target_user_id = 56;

DROP TRIGGER IF EXISTS notification_comment ON Follows;
DROP FUNCTION IF EXISTS create_notification_comment();

--Notificacao de quando alguem comenta uma noticia minha

CREATE OR REPLACE FUNCTION create_notification_comment()
RETURNS trigger AS
$$
BEGIN
  INSERT INTO Notifications (type, target_user_id, news_id)
    VALUES ('CommentMyPost',
			(SELECT author_id  FROM News WHERE id = NEW.target_news_id), NEW.target_news_id);
	RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER notification_comment
  AFTER INSERT ON Comments
  FOR EACH ROW EXECUTE PROCEDURE create_notification_comment();

-- TESTAR:
-- INSERT INTO Follows(follower_user_id, followed_user_id) VALUES (2, 1);
-- SELECT * FROM Notifications WHERE Notifications.target_user_id = 1;

DROP TRIGGER IF EXISTS notification_followed_publish ON Follows;
DROP FUNCTION IF EXISTS create_notification_followed_publish();

--Notificacao de quando alguem que seguimos publica uma noticia

CREATE OR REPLACE FUNCTION create_notification_followed_publish()
RETURNS trigger AS
$$
BEGIN
  INSERT INTO Notifications (type, target_user_id, user_id, news_id)
    VALUES ('FollowedPublish', (SELECT Users.id FROM Users
		INNER JOIN Follows ON Users.id = Follows.follower_user_id
	WHERE Follows.followed_user_id = NEW.author_id), NEW.author_id, NEW.id);
	RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

CREATE TRIGGER notification_followed_publish
  AFTER INSERT ON News
	FOR EACH ROW
  EXECUTE PROCEDURE create_notification_followed_publish();

-- TESTE:
-- INSERT INTO News(title, body, image, section_id, author_id) VALUES ('A dusting of salt could cool the planet', '', 'teste1.png', 8, 36);
-- SELECT * FROM Notifications WHERE Notifications.target_user_id = 9;

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

DROP TRIGGER IF EXISTS score_vote_remove ON Votes;

DROP FUNCTION IF EXISTS update_score_remove_vote();

CREATE TRIGGER score_vote_remove
AFTER DELETE ON Votes
EXECUTE PROCEDURE update_score_remove_vote();

CREATE TRIGGER notification_vote_my_post
  AFTER INSERT ON Votes
	EXECUTE PROCEDURE create_notification_vote_my_post((SELECT Users.id FROM Users
	INNER JOIN News ON Users.id = News.author_id
WHERE News.id = NEW.news_id), NEW.user_id, NEW.news_id);

-- FUNCTIONS

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
