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
DROP TABLE IF EXISTS ReportItems CASCADE;
DROP TABLE IF EXISTS ReasonsForReport CASCADE;
DROP TABLE IF EXISTS Achievements CASCADE;
DROP TABLE IF EXISTS DeletedItem CASCADE;
DROP TABLE IF EXISTS Follows CASCADE;
DROP TABLE IF EXISTS UserInterests CASCADE;
DROP TABLE IF EXISTS DeletedItemReason CASCADE;
DROP TABLE IF EXISTS NewsSource CASCADE;

-- CREATE TABLES

CREATE TABLE UserAccount (    
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

CREATE TABLE Comment(
	 id SERIAL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator INTEGER NOT NULL,
	target_news_id INTEGER NOT NULL
);

CREATE TABLE Reason(
	id SERIAL,
	name text NOT NULL
);


CREATE TABLE ModeratorComment(
	id SERIAL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator_user_id INTEGER NOT NULL,
	news_id INTEGER,
	comment_id INTEGER
);

CREATE TABLE Badge(
	id SERIAL,
	name text NOT NULL,
	brief text,
	votes INTEGER,
	articles INTEGER,
	comments INTEGER,
	creator_user_id INTEGER NOT NULL
);

CREATE TABLE FAQ (
   id SERIAL,
   question TEXT NOT NULL,
   answer TEXT NOT NULL
);


CREATE TABLE Country (
   id SERIAL,
   name TEXT NOT NULL
);

CREATE TABLE Source (
   id SERIAL,
   link TEXT NOT NULL,
   author TEXT NOT NULL,
   consultation_date DATE NOT NULL
);


CREATE TABLE Section (
   id SERIAL,
   name TEXT NOT NULL,
   icon TEXT NOT NULL
);

CREATE TABLE Notification (
   id SERIAL,
   date DATE NOT NULL DEFAULT now(),
   type NotificationType NOT NULL,
   target_user_id INTEGER,
   was_read BOOLEAN DEFAULT false,
   user_id INTEGER,
   news_id INTEGER,
CONSTRAINT notification_type_attr CHECK ((type = ’FollowMe’ AND news_id NULL)OR user_id NULL),
CONSTRAINT notification_attr_null CHECK (news_id NOT NULL OR user_id NOT NULL)
);

CREATE DOMAIN NotificationType text CHECK (VALUE IN (’FollowMe’,‘CommentMyPost’, ‘FollowedPublish’, ‘VoteMyPost’));

CREATE TABLE Vote (
   userID INTEGER,
   newsID INTEGER,
   type BOOLEAN NOT NULL
   );

CREATE TABLE Achievements (
	badgesID INTEGER NOT NULL,
	userID INTEGER NOT NULL
);
CREATE TABLE DeletedItem (
	newsID INTEGER NOT NULL,
	userID INTEGER NOT NULL,
	commentID INTEGER NOT NULL,
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
CREATE TABLE DeletedItemReason (
	deleted_newsID INTEGER NOT NULL,
	deleted_commentID INTEGER NOT NULL,
	reason INTEGER NOT NULL
);
CREATE TABLE NewsSource (
	news INTEGER NOT NULL,
	source INTEGER NOT NULL
);

CREATE TABLE Banned (
	bannedID INTEGER,
	admin INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	reason text NOT NULL
);

CREATE TABLE ReportItems (
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

ALTER TABLE ONLY DeletedItem
	ADD CONSTRAINT DeletedItem_pkey PRIMARY KEY (newsID,commentID);
    
ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_pkey PRIMARY KEY (follower, followed);

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_pkey PRIMARY KEY (“user”, section);

ALTER TABLE ONLY DeletedItemReason
	ADD CONSTRAINT DeletedItemReason_pkey PRIMARY KEY (newsID,commentID, reason);
    
ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_pkey PRIMARY KEY (news, source);

ALTER TABLE ONLY Banned
	ADD CONSTRAINT Banned_bannedID_pkey PRIMARY KEY (bannedID);

ALTER TABLE ONLY ReportItems
	ADD CONSTRAINT ReportItems_ReportItemsID_pkey PRIMARY KEY (userID,newsID,commentID);

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reasonsForReporNewsID_pkey PRIMARY KEY (reasonID,userID,newsID,commentID);


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
	ADD CONSTRAINT Notification_user_fkey FOREIGN KEY (user_id) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Notification
	ADD CONSTRAINT Notification_news_fkey FOREIGN KEY (news_id) REFERENCES News (id);

ALTER TABLE ONLY Vote
	ADD CONSTRAINT Vote_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY Vote
	ADD CONSTRAINT Vote_newsID_fkey FOREIGN KEY (newsID) REFERENCES News (newsID);
 
ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_badges_fkey FOREIGN KEY (badgesID) REFERENCES Badge(badgeID);
 
ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_user_fkey FOREIGN KEY (userID) REFERENCES UserAccount(userID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItem
	ADD CONSTRAINT DeletedItem_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON DELETE CASCADE;
ALTER TABLE ONLY DeletedItem
	ADD CONSTRAINT DeletedItem_comment_fkey FOREIGN KEY (commentID) REFERENCES Comment(id) ON DELETE CASCADE;
ALTER TABLE ONLY DeletedItem
	ADD CONSTRAINT DeletedItem_user_fkey FOREIGN KEY (“user”) REFERENCES UserAccount(userID);

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_follower_fkey FOREIGN KEY (follower) REFERENCES UserAccount(userID) ON DELETE CASCADE;
 
ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_followed_fkey FOREIGN KEY (followed) REFERENCES UserAccount(userID) ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_user_fkey FOREIGN KEY (“user”) REFERENCES UserAccount(userID) ON DELETE CASCADE;
 
ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_section_fkey FOREIGN KEY (section) REFERENCES Section(sectionID) ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItemReason
	ADD CONSTRAINT DeletedItemReason_deletedNews_fkey FOREIGN KEY (deleted_NewsID) REFERENCES DeletedItems(newsID) ON DELETE CASCADE;
 
ALTER TABLE ONLY DeletedItemReason
	ADD CONSTRAINT DeletedItemReason_deletedComments_fkey FOREIGN KEY (deleted_CommentsID) REFERENCES DeletedItems(commentsID) ON DELETE CASCADE;
 
ALTER TABLE ONLY DeletedItemReason
	ADD CONSTRAINT DeletedItemReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reason(reasonID);


ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON DELETE CASCADE;
 
ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_source_fkey FOREIGN KEY (source) REFERENCES Source(sourceID) ON DELETE CASCADE;

ALTER TABLE ONLY Banned
	ADD CONSTRAINT Banned_admin_fkey FOREIGN KEY (admin) REFERENCES UserAccount (userID);

ALTER TABLE ONLY ReportItems
	ADD CONSTRAINT ReportItems_userID_fkey FOREIGN KEY (userID) REFERENCES UserAccount (userID);
ALTER TABLE ONLY ReportItems
	ADD CONSTRAINT ReportItems_newsID_fkey FOREIGN KEY (newsID) REFERENCES NEWS(newsID) ON DELETE CASCADE;
ALTER TABLE ONLY ReportItems
	ADD CONSTRAINT ReportItems_commentID_fkey FOREIGN KEY (commentID) REFERENCES Comment(ID) ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reasonID_fkey FOREIGN KEY (reasonID) REFERENCES Reason (reasonID);
ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reportNewsID_fkey FOREIGN KEY (userID, newsID, commentID) REFERENCES ReportNews;

