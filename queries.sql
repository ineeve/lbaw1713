-- SELECT01
-- select user profile
SELECT username,email,gender,Countries.name As country,picture,points,permission
FROM users NATURAL JOIN countries
WHERE users.id = $userId;

-- SELECT02
-- select news data to show on preview
SELECT title,users.username As author,date,votes,image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
FROM news NATURAL JOIN users WHERE textsearchable_index_col @@ to_tsquery($search_string)
LIMIT 100 OFFSET 0;

-- SELECT03
-- select news title,date,body,image,votes,section,author
SELECT title,date,votes,Sections.name as section_name,Sections.icon as section_icon , Users.username as author, body
FROM news NATURAL JOIN sections NATURAL JOIN users JOIN newssources ON news.id = newsSources.news_id
WHERE news.id = $newsId;

-- UPDATE01
-- atualizar info de um utilizador
UPDATE user
SET email=$email, gender=$gender, country_id=$country_id, picture=$picture
WHERE id=$id;

-- INSERT02
-- Criar um user
INSERT INTO user (username, email, gender, country_id, picture, password)
VALUES ($username, $email, $gender, $country_id, $picture, $password);

-- INSERT03
-- Criar uma notícia
INSERT INTO news (title, body, image, section_id, author_id)
VALUES ($title, body=$body, image=$image, section_id=$section_id, author_id=$author_id);

-- UPDATE04
UPDATE news
SET title = $title, date = now(), body=$body, image=$image, section_id=$section_id
WHERE id=$id;

--INSERT05
INSERT INTO comments ("text", creator_user_id, target_news_id) VALUES ($text,#user_id,$news_id);

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

-- SELECT07
-- List badges
SELECT name, brief, votes, articles, comments
FROM Badges;

-- SELECT08
-- List news of an user
-- TODO: Limit body to first characters/words
SELECT title, date, body, image, votes, Sections.name, Users.username
FROM News INNER JOIN Sections ON (News.section_id = Sections.id)
      INNER JOIN Users ON (News.author_id = Users.id)
WHERE NOT EXISTS (SELECT *
                  FROM DeletedItems
                  WHERE DeletedItems.news_id = News.id)
  AND $userId = News.author_id;

-- SELECT09
-- List sections
SELECT name, icon
FROM Sections;

-- SELECT10
-- Search for your listed interests
SELECT title, date, body, image, votes, Sections.name, Users.username
FROM News INNER JOIN UserInterests ON (News.section_id = UserInterests.section_id
                                        AND $user_id = UserInterests.user_id)
      INNER JOIN Sections ON (News.section_id = Sections.id)
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
SELECT Users.username, News.title AS newsTitle, ReportedItems.description
  FROM ReportedItems
    INNER JOIN Users ON  ReportedItems.user_id = Users.id
    INNER JOIN News ON ReportedItems.news_id = News.id
    WHERE ReportedItems.news_id IS NOT NULL;
--Obter todos os reports a comentarios
SELECT Users.username, ReportedItems.comment_id AS commentID, ReportedItems.description
 FROM ReportedItems
   INNER JOIN Users ON  ReportedItems.user_id = Users.id
   WHERE ReportedItems.comment_id IS NOT NULL;

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
DROP VIEW IF EXISTS ReportDescriptionForUserNews;

CREATE VIEW ReportDescriptionForUserNews AS
SELECT Users.username AS username, News.id AS newsID, News.title AS newsTitle, ReportedItems.description AS description, ReportedItems.id itemID
FROM News
  INNER JOIN Users ON News.author_id = Users.id AND Users.username = $username
  INNER JOIN ReportedItems ON ReportedItems.news_id = News.id
  WHERE ReportedItems.news_id IS NOT NULL;

SELECT newsTitle, description
FROM ReportDescriptionForUserNews
WHERE ReportDescriptionForUserNews.username = $username;

--Selecionar as razões fixas de denuncia de uma só noticia ($newsID)
-- feito por um utilizador $username
SELECT Reasons.name
FROM Reasons
  INNER JOIN ReasonsForReport ON Reasons.id = ReasonsForReport.reason_id
  INNER JOIN ReportDescriptionForUserNews ON ReasonForReport.reported_item_id = ReportDescriptionForUserNews.itemID
  WHERE ReportDescriptionForUserNews.newsID = &newsID;



-- FREQUENT INSERTS / UPDATES / DELETES

-- INSERT10
-- Create news report
INSERT INTO ReportedItems (user_id, news_id, description)
VALUES ($userId, $newsId, $description);

-- INSERT11
-- Create comment report
INSERT INTO ReportedItems (user_id, comment_id, description)
VALUES ($userId, $commentId, $description);

-- INSERT12
-- Delete news
INSERT INTO DeletedItems (user_id, news_id, brief)
VALUES ($userId, $newsId, $brief);

-- INSERT13
-- Delete comment
INSERT INTO DeletedItems (user_id, comment_id, brief)
VALUES ($userId, $commentId, $brief);
