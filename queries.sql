-- SELECT01
-- select user profile
SELECT username,email,gender,Countries.name As country,picture,points,permission
FROM users NATURAL JOIN countries
WHERE users.id = $userId;
-- SELECT02
SELECT


-- UPDATE04
UPDATE News
SET title = $title, "date" = now(), body=$body, image=$image, section_id=$section_id
WHERE id=$id;

--INSERT05
INSERT INTO comments ("text", creator_user_id, target_news_id) VALUES ($text,#user_id,$news_id);

-- SELECT03
-- select news title,date,body,image,votes,section,author
SELECT title,date,image,votes,Sections.name as section_name,Sections.icon as section_icon , Users.username as author, body
FROM news NATURAL JOIN sections NATURAL JOIN users JOIN newssources ON news.id = newsSources.news_id
WHERE news.id = $newsId;

-- select news sources
SELECT news_id, source_id FROM NewsSources
WHERE news_id = $newsId;

-- UPDATE06
UPDATE comments
SET "text" = $text, "date" = now()
WHERE id=$id;

-- SELECT11
SELECT *
FROM Notifications
WHERE Notifications.target_user_id = $userId;
-- SELECT12
SELECT *
FROM ModeratorComments
WHERE ModeratorComments.news_id = $newsId;
-- SELECT13
SELECT *
FROM ModeratorComments
WHERE ModeratorComments.comment_id = $commentId;
-- SELECT14
SELECT *
FROM ReportedItems
WHERE NOT EXISTS ( SELECT *
      FROM DeletedItems
      WHERE (
        ((ReportedItems.comment_id = DeletedItems.comment_id) AND (ReportedItems.news_id IS NULL) AND (DeletedItems.news_id IS NULL))
        OR((ReportedItems.comment_id IS NULL) AND (DeletedItems.comment_id IS NULL) AND (ReportedItems.news_id = DeletedItems.news_id))));

-- List badges
SELECT name, brief, votes, articles, comments
FROM Badges;

-- List news
-- TODO: Limit body to first characters/words
SELECT title, date, body, image, votes, Sections.name, Users.username
FROM News INNER JOIN Sections ON (News.section_id = Sections.id)
      INNER JOIN Users ON (News.author_id = Users.id)
WHERE NOT EXISTS (SELECT *
                  FROM DeletedItems
                  WHERE DeletedItems.news_id = News.id);

-- List sections
SELECT name, icon
FROM Sections;

-- Search for your listed interests
SELECT title, date, body, image, votes, Sections.name, Users.username
FROM News INNER JOIN
      INNER JOIN Users ON (News.author_id = Users.id)
WHERE NOT EXISTS (SELECT *
                  FROM DeletedItems
                  WHERE DeletedItems.news_id = News.id);

--Obter uma noticia (seus conteudos)
SELECT title, date, body, image, votes, Sections.name, Users.username
 FROM News, Sections, Users
 WHERE News.id  = $newsID AND Sections.id = News.section_id AND Users.id = News.author_id
 AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id);
--Obter as noticias publicadas por um utilizador
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE News.author_id = $userID AND Sections.id = News.section_id AND Users.id = News.author_id
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id);
--Obter as noticias de uma noticia de uma categoria especifica
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE Sections.id = News.section_id AND Users.id = News.author_id AND Sections.name = $section
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id);
--Obter noticias entre duas datas
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE Sections.id = News.section_id AND Users.id = News.author_id AND cast(News.date AS DATE) BETWEEN $startDate AND $endDate
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id);
--Obter as noticias do ultimo mes
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE EXTRACT(MONTH FROM cast(News.date AS DATE)) = EXTRACT(MONTH FROM now())
AND EXTRACT(YEAR FROM cast(News.date AS DATE)) = EXTRACT(YEAR FROM now())
 AND Sections.id = News.section_id AND Users.id = News.author_id
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id);
--Obter os comentarios de uma noticia
SELECT text, date, Users.username
 FROM Comments, Users
 WHERE Comments.target_news_id = $newsID AND Comments.creator_user_id = Users.id
 AND NOT EXISTS (SELECT DeletedItems.comment_id FROM DeletedItems WHERE DeletedItems.comment_id = Comments.id);;
--Obter todos os reports a noticias
SELECT Users.username, News.title, description
 FROM ReportedItems, Users, News
 WHERE ReportedItems.news_id IS NOT NULL AND ReportedItems.user_id = Users.id AND ReportedItems.news_id = News.id;
--OU
 SELECT Users.username, News.title AS newsTitle, ReportedItems.description
  FROM ((ReportedItems
    INNER JOIN Users ON  ReportedItems.user_id = Users.id) AS T
    INNER JOIN News ON T.news_id = News.id)
    WHERE ReportedItems.news_id IS NOT NULL;
--Obter todos os reports a comentarios
SELECT Users.username, ReportedItems.comment_id AS commentID, ReportedItems.description
 FROM ReportedItems
   INNER JOIN Users ON  ReportedItems.user_id = Users.id
   WHERE commentID IS NOT NULL;

--Obter os comentarios denunciados de um utilizador
--Nota: usar 'YstumtueniP' como exemplo de $username
DROP VIEW IF EXISTS ReportDescriptionForUserComment;

CREATE VIEW ReportDescriptionForUserComment AS
SELECT Users.username AS username, Comments.id AS commentID, ReportedItems.description AS description, ReportedItems.id itemID
FROM Comments
  INNER JOIN Users ON Comments.creator_user_id = Users.id AND Users.username = $username
  INNER JOIN ReportedItems ON ReportedItems.comment_id = Comments.id
  WHERE ReportedItems.comment_id IS NOT NULL;

SELECT commentID, description
FROM ReportDescriptionForUserComment
WHERE ReportDescriptionForUserComment.username = $username;

--Selecionar as razões fixas de denuncia de um só comentario ($commentID)
-- feito por um utilizador $username
--Nota: usar 1440 como exemplo de $commentID
SELECT Reasons.name
FROM Reasons
  INNER JOIN ReasonsForReport ON Reasons.id = ReasonsForReport.reason_id
  INNER JOIN ReportDescriptionForUserComment ON ReasonsForReport.reported_item_id = ReportDescriptionForUserComment.itemID
  WHERE ReportDescriptionForUserComment.commentID = $commentID;

--Obter as noticias denunciadas de um utilizador
CREATE VIEW ReportDescriptionForUserNews AS
SELECT User.id AS userID, Users.username AS username, News.id AS newsID, News.title AS newsTitle, ReportedItems.description AS description
FROM News
  INNER JOIN Users ON News.author_id = Users.id AND Users.username = $username
  INNER JOIN ReportItems ON ReportItems.news_id = News.id
  WHERE ReportedItems.news_id IS NOT NULL;

SELECT newsTitle, description
FROM ReportDescriptionForUserNews
WHERE ReportDescriptionForUserNews.username = $username;

--Selecionar as razões fixas de denuncia de uma só noticia ($newsID)
-- feito por um utilizador $username
SELECT Reason.name
FROM Reason
  INNER JOIN ReasonForReport ON Reason.id = ReasonForReport.reason_id
  INNER JOIN ReportDescriptionForUserNews ON ReasonForReport.(user_id, news_id,comment_id) = ReportDescriptionForUserNews.(userID, newsID, NULL)
  WHERE ReportDescriptionForUserNews.newsID = &newsID;



-- FREQUENT INSERTS / UPDATES / DELETES

-- Create news report
INSERT INTO ReportedItems (user_id, news_id, description)
VALUES ($userId, $newsId, $description);

-- Create comment report
INSERT INTO ReportedItems (user_id, comment_id, description)
VALUES ($userId, $commentId, $description);



-- Delete news
INSERT INTO DeletedItems (user_id, news_id, brief)
VALUES ($userId, $newsId, $brief);

-- Delete comment
INSERT INTO DeletedItems (user_id, comment_id, brief)
VALUES ($userId, $commentId, $brief);
