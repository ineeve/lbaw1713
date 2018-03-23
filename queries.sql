



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
      WHERE ((ReportedItems.comment_id = DeletedItems.comment_id)
      AND(ReportedItems.news_id=DeletedItems.news_id)));

-- List badges
SELECT name, brief, votes, articles, comments
FROM Badges;

-- List news
-- TODO: Limit body to first characters/words
SELECT title, "date", body, image, votes, Sections.name, Users.username
FROM News INNER JOIN Sections ON (News.section_id = Sections.id)
      INNER JOIN Users ON (News.author_id = Users.id);

-- List sections
SELECT Sections.name, icon
FROM Sections;

-- Search for your listed interests
SELECT title, "date", body, image, votes, Sections.name, Users.username
FROM News INNER JOIN
      INNER JOIN Users ON (News.author_id = Users.id);

--Obter uma noticia (seus conteudos)
 SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE News.id  = $newsID AND Sections.id = News.section_id AND Users.id = News.author_id;
--Obter as noticias publicadas por um utilizador
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE News.author_id = $userID AND Sections.id = News.section_id AND Users.id = News.author_id;
--Obter as noticias de uma noticia de uma categoria especifica
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE Sections.id = News.section_id AND Users.id = News.author_id AND Sections.name = $section;
--Obter noticias entre duas datas
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE Sections.id = News.section_id AND Users.id = News.author_id AND News.date BETWEEN $startDate AND $endDate;
--Obter as noticias do ultimo mes
SELECT title, date, body, image, votes, Sections.name, Users.username
  FROM News, Sections, Users
  WHERE MONTH(News.date) = MONTH(GETDATE()) AND Sections.id = News.section_id AND Users.id = News.author_id;
--Obter os comentarios de uma noticia
SELECT text, date, Users.username
 FROM Comments, Users
 WHERE Comments.target_news_id = $newsID AND Comments.creator_user_id = Users.id;
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

--Obter os comentarios denunciadas de um utilizador
CREATE VIEW ReportDescriptionForUserComment AS
SELECT User.id AS userID, Users.username AS username, Comments.id AS commentID, ReportedItems.description AS description
FROM Comments
  INNER JOIN Users ON Comments.creator_user_id = Users.id AND Users.username = $username
  INNER JOIN ReportItems ON ReportItems.comment_id = Comments.id
  WHERE ReportedItems.comment_id IS NOT NULL;

SELECT commentID, description
FROM ReportDescriptionForUserComment
WHERE ReportDescriptionForUserComment.username = $username;

--Selecionar as razões fixas de denuncia de um só comentario ($commentID)
-- feito por um utilizador $username
SELECT Reason.name
FROM Reason
  INNER JOIN ReasonForReport ON Reason.id = ReasonForReport.reason_id
  INNER JOIN ReportDescriptionForUserComment ON ReasonForReport.(user_id, news_id,comment_id) = ReportDescriptionForUserComment.(userID, NULL, commentID)
  WHERE ReportDescriptionForUserComment.commentID = &commentID;

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
