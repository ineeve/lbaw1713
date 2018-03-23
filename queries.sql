-- SELECT01
-- select user profile
SELECT username,email,gender,Countries.name As country,picture,points,permission 
FROM Users NATURAL JOIN Countries
WHERE Users.id = $userId;
-- SELECT02

-- SELECT03
-- select news title,date,body,image,votes,section,author
SELECT title,date,body,image,votes,Sections.name as section_name,Sections.icon as section_icon , Users.username as author
FROM News NATURAL JOIN Sections NATURAL JOIN Users JOIN NewsSources ON News.id = NewsSources.id
WHERE News.id = $newsId

-- select news sources
SELECT news_id, source_id FROM NewsSources
WHERE news_id = $newsId;


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
FROM News INNER JOIN UserInterests ON (UserInterests.section_id = News.section_id AND UserInterests.username = $username)
      INNER JOIN Sections ON (News.section_id = Sections.id)
      INNER JOIN Users ON (News.author_id = Users.id);