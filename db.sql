-- DROP TABLES

DROP TABLE IF EXISTS UserAccount CASCADE;
DROP TABLE IF EXISTS News CASCADE;
DROP TABLE IF EXISTS Comment CASCADE;
DROP TABLE IF EXISTS Reason CASCADE;
DROP TABLE IF EXISTS ModeratorComment CASCADE;
DROP TABLE IF EXISTS Badge CASCADE;
DROP TABLE IF EXISTS FAQ CASCADE;
DROP TABLE IF EXISTS Country CASCADE;
DROP TABLE IF EXISTS Source CASCADE;
DROP TABLE IF EXISTS Section CASCADE;
DROP TABLE IF EXISTS Notification CASCADE;
DROP TABLE IF EXISTS Vote CASCADE;
DROP TABLE IF EXISTS Banned CASCADE;
DROP TABLE IF EXISTS ReportNews CASCADE;
DROP TABLE IF EXISTS ReasonsForReportNews CASCADE;
DROP TABLE IF EXISTS ReportComment CASCADE;
DROP TABLE IF EXISTS ReasonsForReportComment CASCADE;
DROP TABLE IF EXISTS DeletedComment CASCADE;
DROP TABLE IF EXISTS Achievements CASCADE;
DROP TABLE IF EXISTS DeletedNews CASCADE;
DROP TABLE IF EXISTS Follows CASCADE;
DROP TABLE IF EXISTS UserInterests CASCADE;
DROP TABLE IF EXISTS DeletedNewsReason CASCADE;
DROP TABLE IF EXISTS NewsSource CASCADE;
DROP TABLE IF EXISTS DeletedCommentReason CASCADE;

-- CREATE TABLES

CREATE TABLE UserAccount (    
	userID SERIAL NOT NULL,
	username text NOT NULL,
	email text NOT NULL,
	gender text,
	country INTEGER,
	picture text,
	password text NOT NULL,
	points INTEGER NOT NULL,
	permission text NOT NULL,
	CONSTRAINT gender CHECK (gender = ANY(ARRAY['Male', 'Female', 'Other']::text[])),
	CONSTRAINT points CHECK (points >= 0),
	CONSTRAINT permission CHECK (permission = ANY (ARRAY['Admin','Moderator','Normal']::text[]))
);

CREATE TABLE News (
	newsID SERIAL NOT NULL,
	title text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	body text NOT NULL,
	image text NOT NULL,
	votes INTEGER NOT NULL,
	section INTEGER NOT NULL,
	author INTEGER NOT NULL
);

CREATE TABLE Comment(
	commentID SERIAL NOT NULL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator INTEGER NOT NULL,
	targetNews INTEGER NOT NULL
);

CREATE TABLE Reason(
	reasonID SERIAL NOT NULL,
	name text NOT NULL
);


CREATE TABLE ModeratorComment(
	moderatorCommentID SERIAL NOT NULL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator INTEGER NOT NULL,
	news INTEGER,
	comment INTEGER
);

CREATE TABLE Badge(
	badgeID SERIAL NOT NULL,
	name text NOT NULL,
	brief text,
	votes INTEGER,
	articles INTEGER,
	comments INTEGER,
	creator INTEGER NOT NULL
);

CREATE TABLE FAQ (
   faqID SERIAL NOT NULL,
   question TEXT NOT NULL,
   answer TEXT NOT NULL
);


CREATE TABLE Country (
   countryID SERIAL NOT NULL,
   name TEXT NOT NULL
);

CREATE TABLE Source (
   sourceID SERIAL NOT NULL,
   link TEXT NOT NULL,
   author TEXT NOT NULL,
   consultationDate DATE NOT NULL
);


CREATE TABLE Section (
   sectionID SERIAL NOT NULL,
   name TEXT NOT NULL,
   icon TEXT NOT NULL
);

CREATE TABLE Notification (
   notificationID SERIAL NOT NULL,
   link TEXT NOT NULL,
   votesNum INTEGER,
   date DATE NOT NULL DEFAULT now(),
   type NotificationType NOT NULL,
   targetUser INTEGER,
   wasRead BOOLEAN
);

CREATE TABLE Vote (
   userID INTEGER,
   newsID INTEGER,
   type BOOLEAN NOT NULL
   );

CREATE TABLE Achievements (
	badgesID INTEGER NOT NULL,
	userID INTEGER NOT NULL
);
CREATE TABLE DeletedNews (
	news INTEGER NOT NULL,
	“user” INTEGER NOT NULL,
	date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	brief TEXT
);
CREATE TABLE Follows (
	follower INTEGER NOT NULL,
	followed INTEGER NOT NULL
);
CREATE TABLE UserInterests (
	“user” INTEGER NOT NULL,
	section INTEGER NOT NULL
);
CREATE TABLE DeletedNewsReason (
	deleted INTEGER NOT NULL,
	reason INTEGER NOT NULL
);
CREATE TABLE NewsSource (
	news INTEGER NOT NULL,
	source INTEGER NOT NULL
);
CREATE TABLE DeletedCommentReason (
	reason INTEGER NOT NULL,
	comment INTEGER NOT NULL
);


CREATE TABLE Banned (
	bannedID INTEGER,
	admin INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	reason text NOT NULL
);

CREATE TABLE ReportNews (
	userID INTEGER,
	newsID INTEGER,
	description text
);

CREATE TABLE ReasonsForReportNews (
	reasonID INTEGER,
	userID INTEGER,
	newsID INTEGER
);
CREATE TABLE ReportComment (
  userID INTEGER,
  commentID INTEGER,
  description text
);

CREATE TABLE ReasonsForReportComment (
	reasonID INTEGER,
	userID INTEGER,
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

ALTER TABLE ONLY Comment
	ADD CONSTRAINT Comment_pkey PRIMARY KEY(commentID);

ALTER TABLE ONLY Reason
	ADD CONSTRAINT Reason_pkey PRIMARY KEY(reasonID);

ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_pkey PRIMARY KEY(moderatorCommentID);

ALTER TABLE ONLY Badge
	ADD CONSTRAINT Badge_pkey PRIMARY KEY(badgeID);

ALTER TABLE ONLY FAQ
	ADD CONSTRAINT FAQ_faqID_pkey PRIMARY KEY (faqID);
ALTER TABLE ONLY FAQ
	ADD CONSTRAINT FAQ_question_key UNIQUE (question);

ALTER TABLE ONLY Country
	ADD CONSTRAINT Country_countryID_pkey PRIMARY KEY (countryID);
ALTER TABLE ONLY Country
	ADD CONSTRAINT Country_name_key UNIQUE (name);

ALTER TABLE ONLY Source
	ADD CONSTRAINT Source_sourceID_pkey PRIMARY KEY (sourceID);

ALTER TABLE ONLY Section
	ADD CONSTRAINT Section_sectionID_pkey PRIMARY KEY (sectionID);
ALTER TABLE ONLY Section
	ADD CONSTRAINT Section_name_key UNIQUE (name);

ALTER TABLE ONLY Notification
	ADD CONSTRAINT Notification_notificationID_pkey PRIMARY KEY (notificationID);

ALTER TABLE ONLY Vote
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
    
ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_pkey PRIMARY KEY (news, source);

ALTER TABLE ONLY DeletedCommentReason
	ADD CONSTRAINT DeletedCommentReason_pkey PRIMARY KEY (reason, comment);

ALTER TABLE ONLY Banned
	ADD CONSTRAINT Banned_bannedID_pkey PRIMARY KEY (bannedID);

ALTER TABLE ONLY ReportNews
	ADD CONSTRAINT ReportNews_reportNewsID_pkey PRIMARY KEY (userID,newsID);

ALTER TABLE ONLY ReasonsForReportNews
	ADD CONSTRAINT ReasonsForReportNews_reasonsForReportNewsID_pkey PRIMARY KEY (reasonID,userID,newsID);

ALTER TABLE ONLY ReportComment
	ADD CONSTRAINT ReportComment_reportCommentID_pkey PRIMARY KEY (userID,commentID);

ALTER TABLE ONLY ReasonsForReportComment
	ADD CONSTRAINT ReasonsForReportComment_reasonsForReportCommentID_pkey PRIMARY KEY (reasonID,userID,commentID);

ALTER TABLE ONLY DeletedComment
	ADD CONSTRAINT DeletedComment_commentID_pkey PRIMARY KEY (commentID);



-- FOREIGN KEYS


ALTER TABLE ONLY UserAccount
	ADD CONSTRAINT UserAccount_country_fkey FOREIGN KEY (country) REFERENCES Country(countryID);

ALTER TABLE ONLY News
	ADD CONSTRAINT News_section_fkey FOREIGN KEY (section) REFERENCES Section(sectionID);
ALTER TABLE ONLY News
	ADD CONSTRAINT News_author_fkey FOREIGN KEY (author) REFERENCES UserAccount(userID);

ALTER TABLE ONLY Comment
	ADD CONSTRAINT Comment_creator_fkey FOREIGN KEY (creator) REFERENCES UserAccount(userID);
ALTER TABLE ONLY Comment
 ADD CONSTRAINT Comment_targetNews_fkey FOREIGN KEY (targetNews) REFERENCES News(newsID) ON DELETE CASCADE;

ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_creator_fkey FOREIGN KEY (creator) REFERENCES UserAccount(userID);
ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_news_fkey FOREIGN KEY (news) REFERENCES News(newsID);
ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_comment_fkey FOREIGN KEY (news) REFERENCES Comment(commentID);

ALTER TABLE ONLY Badge
	ADD CONSTRAINT Badge_creator_fkey FOREIGN KEY (creator) REFERENCES UserAccount(userID);

ALTER TABLE ONLY Notification
	ADD CONSTRAINT Notification_targetUser_fkey FOREIGN KEY (targetUser) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Notification
	ADD CONSTRAINT Notification_user_fkey FOREIGN KEY (“user”) REFERENCES UserAccount (userID);

ALTER TABLE ONLY Vote
	ADD CONSTRAINT Vote_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Vote
	ADD CONSTRAINT Vote_newsID_fkey FOREIGN KEY (newsID) REFERENCES News (newsID);
 
ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_badges_fkey FOREIGN KEY (badgesID) REFERENCES Badge(badgeID);
 
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
	ADD CONSTRAINT UserInterests_section_fkey FOREIGN KEY (section) REFERENCES Section(sectionID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNewsReason
	ADD CONSTRAINT DeletedNewsReason_deleted_fkey FOREIGN KEY (deleted) REFERENCES DeletedNews(news) ON DELETE CASCADE;
 
ALTER TABLE ONLY DeletedNewsReason
	ADD CONSTRAINT DeletedNewsReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reason(reasonID);


ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON DELETE CASCADE;
 
ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_source_fkey FOREIGN KEY (source) REFERENCES Source(sourceID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedCommentReason
	ADD CONSTRAINT DeletedCommentReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reason(reasonID);
 
ALTER TABLE ONLY DeletedCommentReason
	ADD CONSTRAINT DeletedCommentReason_comment_fkey FOREIGN KEY (comment) REFERENCES DeletedComment(commentID) ON DELETE CASCADE;

ALTER TABLE ONLY Banned
	ADD CONSTRAINT Banned_admin_fkey FOREIGN KEY (admin) REFERENCES UserAccount (userID);

ALTER TABLE ONLY ReportNews
	ADD CONSTRAINT ReportNews_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY ReportNews
	ADD CONSTRAINT ReportNews_newsID_fkey FOREIGN KEY (newsID) REFERENCES NEWS(newsID) ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForReportNews
	ADD CONSTRAINT ReasonsForReportNews_reasonID_fkey FOREIGN KEY (reasonID) REFERENCES Reason (reasonID);
ALTER TABLE ONLY ReasonsForReportNews
	ADD CONSTRAINT ReasonsForReportNews_reportNewsID_fkey FOREIGN KEY (userID, newsID) REFERENCES ReportNews;

ALTER TABLE ONLY ReportComment
	ADD CONSTRAINT ReportComment_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY ReportComment
	ADD CONSTRAINT ReportComment_commentID_fkey FOREIGN KEY (commentID) REFERENCES Comment (commentID) ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForReportComment
	ADD CONSTRAINT ReasonsForReportComment_reasonID_fkey FOREIGN KEY (reasonID) REFERENCES Reason (reasonID);
ALTER TABLE ONLY ReasonsForReportComment
	ADD CONSTRAINT ReasonsForReportComment_reportCommentID_fkey FOREIGN KEY (userID, commentID) REFERENCES ReportComment;

ALTER TABLE ONLY DeletedComment
	ADD CONSTRAINT DeletedComment_commentID_fkey FOREIGN KEY (commentID) REFERENCES Comment (commentID) ON DELETE CASCADE;
ALTER TABLE ONLY DeletedComment
	ADD CONSTRAINT DeletedComment_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
