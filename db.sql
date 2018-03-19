-- DROP TABLES

DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS News CASCADE;
DROP TABLE IF EXISTS Comments CASCADE;
DROP TABLE IF EXISTS Reasons CASCADE;
DROP TABLE IF EXISTS ModeratorComment CASCADE;
DROP TABLE IF EXISTS Badges CASCADE;
DROP TABLE IF EXISTS FAQs CASCADE;
DROP TABLE IF EXISTS Countries CASCADE;
DROP TABLE IF EXISTS Sources CASCADE;
DROP TABLE IF EXISTS Sections CASCADE;
DROP TABLE IF EXISTS Notifications CASCADE;
DROP TABLE IF EXISTS Votes CASCADE;
DROP TABLE IF EXISTS Bans CASCADE;
DROP TABLE IF EXISTS ReportedItems CASCADE;
DROP TABLE IF EXISTS ReasonsForReport CASCADE;
DROP TABLE IF EXISTS DeletedComment CASCADE;
DROP TABLE IF EXISTS Achievements CASCADE;
DROP TABLE IF EXISTS DeletedNews CASCADE;
DROP TABLE IF EXISTS Follows CASCADE;
DROP TABLE IF EXISTS UserInterests CASCADE;
DROP TABLE IF EXISTS DeletedNewsReason CASCADE;
DROP TABLE IF EXISTS NewsSources CASCADE;
DROP TABLE IF EXISTS DeletedCommentReason CASCADE;

-- CREATE TABLES

CREATE TABLE Users (
	id SERIAL,
	username text NOT NULL,
	email text NOT NULL,
	gender text,
	country_id INTEGER,
	picture text,
	password text NOT NULL,
	points INTEGER NOT NULL,
	permission text NOT NULL,
	CONSTRAINT gender CHECK (gender = ANY(ARRAY['Male', 'Female', 'Other']::text[])),
	CONSTRAINT points CHECK (points >= 0),
	CONSTRAINT permission CHECK (permission = ANY (ARRAY['Admin','Moderator','Normal']::text[]))
);

CREATE TABLE News (
	id SERIAL,
	title text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	body text NOT NULL,
	image text NOT NULL,
	votes INTEGER NOT NULL,
	section_id INTEGER NOT NULL,
	author_id INTEGER NOT NULL
);

CREATE TABLE Comments(
	id SERIAL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator INTEGER NOT NULL,
	target_news_id INTEGER NOT NULL
);

CREATE TABLE Reasons(
	id SERIAL,
	name text NOT NULL
);


CREATE TABLE ModeratorComment(
	id SERIAL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator_user_id INTEGER NOT NULL,
	news_id INTEGER,
	comment_id INTEGER,
	CONSTRAINT moderator_comment_attr_null CHECK (news_id NOT NULL OR comment_id NOT NULL)
);

CREATE TABLE Badges(
	id SERIAL,
	name text NOT NULL,
	brief text,
	votes INTEGER,
	articles INTEGER,
	comments INTEGER,
	creator_user_id INTEGER NOT NULL,
	CONSTRAINT notification_attr_null CHECK (votes NOT NULL OR articles NOT NULL OR comments NOT NULL)
);

CREATE TABLE FAQs (
   id SERIAL,
   question TEXT NOT NULL,
   answer TEXT NOT NULL
);


CREATE TABLE Countries (
   id SERIAL,
   name TEXT NOT NULL
);

CREATE TABLE Sources (
   id SERIAL,
   link TEXT NOT NULL,
   author TEXT NOT NULL,
   consultation_date DATE NOT NULL
);


CREATE TABLE Sections (
   id SERIAL,
   name TEXT NOT NULL,
   icon TEXT NOT NULL
);

CREATE DOMAIN NotificationType text CHECK (VALUE IN (’FollowMe’,‘CommentMyPost’, ‘FollowedPublish’, ‘VoteMyPost’));

CREATE TABLE Notifications (
   id SERIAL,
   "date" DATE NOT NULL DEFAULT now(),
   type NotificationType NOT NULL,
   target_user_id INTEGER,
   was_read BOOLEAN DEFAULT false,
   user_id INTEGER,
   news_id INTEGER,
	 CONSTRAINT notification_type_attr CHECK ((type = ’FollowMe’ AND news_id NULL)OR user_id NULL),
	 CONSTRAINT notification_attr_null CHECK (news_id NOT NULL OR user_id NOT NULL)
);


CREATE TABLE Votes (
   user_id INTEGER,
   news_id INTEGER,
   type BOOLEAN NOT NULL
   );

CREATE TABLE Achievements (
	badges_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL
);
CREATE TABLE DeletedNews (
	news_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	brief TEXT
);
CREATE TABLE Follows (
	follower_user_id INTEGER NOT NULL,
	followed_user_id INTEGER NOT NULL
);
CREATE TABLE UserInterests (
	user_id INTEGER NOT NULL,
	section_id INTEGER NOT NULL
);
CREATE TABLE DeletedNewsReason (
	deleted_news_id INTEGER NOT NULL,
	deleted_comments_id INTEGER NOT NULL
);
CREATE TABLE NewsSources (
	news_id INTEGER NOT NULL,
	source_id INTEGER NOT NULL
);
CREATE TABLE DeletedCommentReason (
	reason_id INTEGER NOT NULL,
	comment_id INTEGER NOT NULL
);


CREATE TABLE Bans (
	banned_user_id INTEGER,
	admin_user_id INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	reason text NOT NULL
);


CREATE TABLE ReportedItems (
	userID INTEGER,
	newsID INTEGER,
	commentID INTEGER,
	description text
);

CREATE TABLE ReasonsForReport (
	reasonID INTEGER,
	userID INTEGER,
	newsID INTEGER,
	commentID INTEGER
);


CREATE TABLE DeletedComment (
	commentID INTEGER,
	userID INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	brief text
);

-- PRIMARY KEYS AND UNIQUES


ALTER TABLE ONLY UserAccount
	ADD CONSTRAINT UserAccount_pkey PRIMARY KEY(userID);
ALTER TABLE ONLY UserAccount
	ADD CONSTRAINT UserAccount_username_key UNIQUE(username);
ALTER TABLE ONLY UserAccount
	ADD CONSTRAINT UserAccount_email_key UNIQUE(email);

ALTER TABLE ONLY NEWS
	ADD CONSTRAINT News_pkey PRIMARY KEY(newsID);

ALTER TABLE ONLY Comments
	ADD CONSTRAINT Comment_pkey PRIMARY KEY(commentID);

ALTER TABLE ONLY Reasons
	ADD CONSTRAINT Reason_pkey PRIMARY KEY(reasonID);

ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_pkey PRIMARY KEY(moderatorCommentID);

ALTER TABLE ONLY Badges
	ADD CONSTRAINT Badges_pkey PRIMARY KEY(badgeID);

ALTER TABLE ONLY FAQs
	ADD CONSTRAINT FAQ_faqID_pkey PRIMARY KEY (faqID);
ALTER TABLE ONLY FAQs
	ADD CONSTRAINT FAQ_question_key UNIQUE (question);

ALTER TABLE ONLY Countries
	ADD CONSTRAINT Countries_countryID_pkey PRIMARY KEY (countryID);
ALTER TABLE ONLY Countries
	ADD CONSTRAINT Countries_name_key UNIQUE (name);

ALTER TABLE ONLY Sources
	ADD CONSTRAINT Sources_sourceID_pkey PRIMARY KEY (sourceID);

ALTER TABLE ONLY Sections
	ADD CONSTRAINT Section_sectionID_pkey PRIMARY KEY (sectionID);
ALTER TABLE ONLY Sections
	ADD CONSTRAINT Section_name_key UNIQUE (name);

ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_notificationID_pkey PRIMARY KEY (notificationID);

ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_userID_newsID_pkey PRIMARY KEY (userID, newsID);

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_pkey PRIMARY KEY (badgesID, userID);

ALTER TABLE ONLY DeletedNews
	ADD CONSTRAINT DeletedNews_pkey PRIMARY KEY (news);

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_pkey PRIMARY KEY (follower, followed);

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_pkey PRIMARY KEY (“user”, section);

ALTER TABLE ONLY DeletedNewsReason
	ADD CONSTRAINT DeletedNewsReason_pkey PRIMARY KEY (deleted, reason);

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_pkey PRIMARY KEY (news, source);

ALTER TABLE ONLY DeletedCommentReason
	ADD CONSTRAINT DeletedCommentReason_pkey PRIMARY KEY (reason, comment);

ALTER TABLE ONLY Bans
	ADD CONSTRAINT Banned_bannedID_pkey PRIMARY KEY (bannedID);


ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_ReportItemsID_pkey PRIMARY KEY (userID,newsID,commentID);

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reasonsForReporNewsID_pkey PRIMARY KEY (reasonID,userID,newsID,commentID);

ALTER TABLE ONLY DeletedComment
	ADD CONSTRAINT DeletedComment_commentID_pkey PRIMARY KEY (commentID);



-- FOREIGN KEYS


ALTER TABLE ONLY UserAccount
	ADD CONSTRAINT UserAccount_country_fkey FOREIGN KEY (country) REFERENCES Countries(countryID);

ALTER TABLE ONLY News
	ADD CONSTRAINT News_section_fkey FOREIGN KEY (section) REFERENCES Sections(sectionID);
ALTER TABLE ONLY News
	ADD CONSTRAINT News_author_fkey FOREIGN KEY (author) REFERENCES UserAccount(userID);

ALTER TABLE ONLY Comments
	ADD CONSTRAINT Comment_creator_fkey FOREIGN KEY (creator) REFERENCES UserAccount(userID);
ALTER TABLE ONLY Comments
 ADD CONSTRAINT Comment_targetNews_fkey FOREIGN KEY (targetNews) REFERENCES News(newsID) ON DELETE CASCADE;

ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_creator_fkey FOREIGN KEY (creator) REFERENCES UserAccount(userID);
ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_news_fkey FOREIGN KEY (news) REFERENCES News(newsID);
ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_comment_fkey FOREIGN KEY (news) REFERENCES Comments(commentID);

ALTER TABLE ONLY Badges
	ADD CONSTRAINT Badges_creator_fkey FOREIGN KEY (creator) REFERENCES UserAccount(userID);

ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_targetUser_fkey FOREIGN KEY (targetUser) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_user_fkey FOREIGN KEY (user_id) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_news_fkey FOREIGN KEY (news_id) REFERENCES News (id);

ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_newsID_fkey FOREIGN KEY (newsID) REFERENCES News (newsID);

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_badges_fkey FOREIGN KEY (badgesID) REFERENCES Badges(badgeID);

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_user_fkey FOREIGN KEY (userID) REFERENCES UserAccount(userID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNews
	ADD CONSTRAINT DeletedNews_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNews
	ADD CONSTRAINT DeletedNews_user_fkey FOREIGN KEY (“user”) REFERENCES UserAccount(userID);

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_follower_fkey FOREIGN KEY (follower) REFERENCES UserAccount(userID) ON DELETE CASCADE;

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_followed_fkey FOREIGN KEY (followed) REFERENCES UserAccount(userID) ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_user_fkey FOREIGN KEY (“user”) REFERENCES UserAccount(userID) ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_section_fkey FOREIGN KEY (section) REFERENCES Sections(sectionID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNewsReason
	ADD CONSTRAINT DeletedNewsReason_deleted_fkey FOREIGN KEY (deleted) REFERENCES DeletedNews(news) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNewsReason
	ADD CONSTRAINT DeletedNewsReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reasons(reasonID);


ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON DELETE CASCADE;

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_source_fkey FOREIGN KEY (source) REFERENCES Sources(sourceID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedCommentReason
	ADD CONSTRAINT DeletedCommentReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reasons(reasonID);

ALTER TABLE ONLY DeletedCommentReason
	ADD CONSTRAINT DeletedCommentReason_comment_fkey FOREIGN KEY (comment) REFERENCES DeletedComment(commentID) ON DELETE CASCADE;

ALTER TABLE ONLY Bans
	ADD CONSTRAINT Banned_admin_fkey FOREIGN KEY (admin) REFERENCES UserAccount (userID);


ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_newsID_fkey FOREIGN KEY (newsID) REFERENCES NEWS(newsID) ON DELETE CASCADE;
ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_commentID_fkey FOREIGN KEY (commentID) REFERENCES Comments(ID) ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reasonID_fkey FOREIGN KEY (reasonID) REFERENCES Reasons (reasonID);
ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reportNewsID_fkey FOREIGN KEY (userID, newsID, commentID) REFERENCES ReportNews;

ALTER TABLE ONLY DeletedComment
	ADD CONSTRAINT DeletedComment_commentID_fkey FOREIGN KEY (commentID) REFERENCES Comments (commentID) ON DELETE CASCADE;
ALTER TABLE ONLY DeletedComment
