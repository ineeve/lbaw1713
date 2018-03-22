



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

/* SELECT Sections.name
FROM Sections INNER JOIN UserInterests ON (Sections.id = UserInterests.section_id)
      INNER JOIN Users ON (Users.id = UserInterests.user_id)
WHERE Users.username = $username; */
-- Search for your listed interests
-- TODO: Unfinished
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
SELECT text, date, username
 FROM Comments, Users
 WHERE Comments.target_news_id = $newsID AND Comments.creator_user_id = Users.id;
