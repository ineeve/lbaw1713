-- SELECT01
-- select user profile
SELECT users.id,username,email,gender,Countries.name As country,picture,points,permission
FROM users NATURAL JOIN countries
WHERE users.username = $username;

-- SELECT02
-- select news data to show on preview
SELECT title,users.username As author,date,votes,image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
FROM news NATURAL JOIN users WHERE textsearchable_index_col @@ to_tsquery($search_string)
LIMIT 10 OFFSET $offset;

-- SELECT03 (obtém uma notícia, mesmo que tenha sido 'apagada')
-- select news title,date,body,image,votes,section,author
SELECT title,date,votes,Sections.name as section_name,Sections.icon as section_icon , Users.username as author, body
FROM news NATURAL JOIN sections NATURAL JOIN users JOIN newssources ON news.id = newsSources.news_id
WHERE news.id = $newsId;

-- SELECT04
--Obter uma noticia que não foi 'apagada' (seus conteudos)
SELECT title, date, body, image, votes, Sections.name, Users.username
 FROM News, Sections, Users
 WHERE News.id  = $newsID AND Sections.id = News.section_id AND Users.id = News.author_id
 AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id);

--SELECT05
--Obter as noticias de uma noticia de uma categoria especifica
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE Sections.id = News.section_id AND Users.id = News.author_id AND Sections.name = $section
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
  ORDER BY date DESC LIMIT 10 OFFSET $offset;

-- SELECT06
-- Obter noticias entre duas datas
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE Sections.id = News.section_id AND Users.id = News.author_id AND News.date BETWEEN $startdate AND $enddate
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id)
  ORDER BY date DESC LIMIT 10 OFFSET $offset;

-- SELECT07
-- List badges
SELECT name, brief, votes, articles, comments
FROM Badges LIMIT 10 OFFSET $offset;

-- SELECT08
-- List news of an user
SELECT title, date, body, image, votes, Sections.name, Users.username
FROM News INNER JOIN Sections ON (News.section_id = Sections.id)
      INNER JOIN Users ON (News.author_id = Users.id)
WHERE NOT EXISTS (SELECT *
                  FROM DeletedItems
                  WHERE DeletedItems.news_id = News.id)
  AND $userId = News.author_id ORDER BY date DESC LIMIT 10 OFFSET $offset;

-- SELECT09
-- List sections
SELECT name, icon
FROM Sections LIMIT 50 OFFSET $offset;

-- SELECT10
-- Search for your listed interests
SELECT title, date, body, image, votes, Sections.name, Users.username
FROM News INNER JOIN UserInterests ON (News.section_id = UserInterests.section_id AND $user_id = UserInterests.user_id)
      INNER JOIN Sections ON (News.section_id = Sections.id)
      INNER JOIN Users ON (News.author_id = Users.id)
WHERE NOT EXISTS (
  SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
  ORDER BY date DESC LIMIT 10 OFFSET $offset;


-- SELECT11
SELECT date, type, was_read, user_id, news_id, users.username
FROM notifications, users
WHERE notifications.target_user_id = $target_user_id AND (user_id = users.id OR user_id IS NULL) ORDER BY date DESC LIMIT 10 OFFSET 0;

-- SELECT12
SELECT *
FROM ModeratorComments
WHERE ModeratorComments.news_id = $newsId ORDER BY date DESC LIMIT 10 OFFSET $offset;

-- SELECT13
SELECT *
FROM ModeratorComments
WHERE ModeratorComments.comment_id = $commentId ORDER BY date DESC LIMIT 10 OFFSET $offset;

-- SELECT14
SELECT *
FROM ReportedItems
WHERE NOT EXISTS ( SELECT *
                   FROM DeletedItems
                   WHERE (
                          ((ReportedItems.comment_id = DeletedItems.comment_id) AND (ReportedItems.news_id IS NULL) AND (DeletedItems.news_id IS NULL))
                          OR((ReportedItems.comment_id IS NULL) AND (DeletedItems.comment_id IS NULL) AND (ReportedItems.news_id = DeletedItems.news_id))))
                          ORDER BY date DESC LIMIT 10 OFFSET $offset;

-- SELECT15
--Obter as noticias do ultimo mes
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE News.date > CURRENT_DATE - INTERVAL '30 days'
 AND Sections.id = News.section_id AND Users.id = News.author_id
  AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id)
  ORDER BY date DESC LIMIT 10 OFFSET $offset; 

-- SELECT16
--Obter os comentarios de uma noticia
SELECT text, date, Users.username
  FROM Comments, Users
  WHERE Comments.target_news_id = $newsID AND Comments.creator_user_id = Users.id
  AND NOT EXISTS (SELECT DeletedItems.comment_id FROM DeletedItems WHERE DeletedItems.comment_id = Comments.id)
  ORDER BY date DESC LIMIT 10 OFFSET $offset; 

-- SELECT17
-- Obter todos os reports a noticias
SELECT Users.username, News.title AS newsTitle, ReportedItems.description
  FROM ReportedItems
    INNER JOIN Users ON  ReportedItems.user_id = Users.id
    INNER JOIN News ON ReportedItems.news_id = News.id
    WHERE ReportedItems.news_id IS NOT NULL
    LIMIT 10 OFFSET $offset;

-- SELECT18
--Obter todos os reports a comentarios
SELECT Users.username, ReportedItems.comment_id AS commentID, ReportedItems.description
 FROM ReportedItems
   INNER JOIN Users ON  ReportedItems.user_id = Users.id
   WHERE ReportedItems.comment_id IS NOT NULL
   LIMIT 10 OFFSET $offset;

-- SELECT19
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
WHERE ReportDescriptionForUserComment.username = $username LIMIT 10 OFFSET $offset;

-- SELECT20
--Selecionar as razões fixas de denuncia de um só comentario ($commentID)
-- feito por um utilizador $username
--Nota: usar 1440 como exemplo de $commentID
SELECT reason
  FROM ReasonsForReport INNER JOIN ReportDescriptionForUserComment
  ON ReasonsForReport.reported_item_id = ReportDescriptionForUserComment.itemID
  WHERE ReportDescriptionForUserComment.commentID = $commentID;

-- SELECT21
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
WHERE ReportDescriptionForUserNews.username = $username LIMIT 10 OFFSET $offset;

-- SELECT22
--Selecionar as razões fixas de denuncia de uma só noticia ($newsID)
-- feito por um utilizador $username
SELECT reason FROM
  ReasonsForReport INNER JOIN ReportDescriptionForUserNews 
  ON ReasonsForReport.reported_item_id = ReportDescriptionForUserNews.itemID
  WHERE ReportDescriptionForUserNews.newsID = $newsID LIMIT 10 OFFSET $offset;

-- SELECT23
-- Obter achievements/badges de um utilizador
SELECT badges.id as badge_id, name, brief, votes, comments, articles FROM badges JOIN achievements ON badges.id = achievements.badge_id
WHERE achievements.user_id = $user_id LIMIT 10 OFFSET $offset;


-- UPDATES INSERTS DELETES ------------------------------------------------------------------

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

-- UPDATE06
UPDATE comments
SET "text" = $text, "date" = now()
WHERE id=$id;

-- TODO  FIND OTHERS

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
