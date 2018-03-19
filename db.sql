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
DROP TABLE IF EXISTS Achievements CASCADE;
DROP TABLE IF EXISTS DeletedItems CASCADE;
DROP TABLE IF EXISTS Follows CASCADE;
DROP TABLE IF EXISTS UserInterests CASCADE;
DROP TABLE IF EXISTS DeletedItemsReason CASCADE;
DROP TABLE IF EXISTS NewsSource CASCADE;

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
	votes INTEGER NOT NULL DEFAULT 0,
	section_id INTEGER NOT NULL,
	author_id INTEGER NOT NULL
);

CREATE TABLE Comments(
	id SERIAL,
	“text” text NOT NULL,
	“date” TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator_user_id INTEGER NOT NULL,
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
	badge_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL
);

CREATE TABLE DeletedItems (
	news_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	comment_id INTEGER NOT NULL,
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

CREATE TABLE DeletedItemsReason (
	deleted_news_id INTEGER NOT NULL,
	deleted_comment_id INTEGER NOT NULL,
	reason INTEGER NOT NULL
);
CREATE TABLE NewsSources (
	news_id INTEGER NOT NULL,
	source_id INTEGER NOT NULL
);

CREATE TABLE Bans (
	banned_user_id, -- primary key does not need NN
	admin_user_id INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	reason text NOT NULL
);


CREATE TABLE ReportedItems (
	user_id INTEGER, -- pkey
	news_id INTEGER, -- pkey
	comment_id INTEGER, -- pkey
	description text,
	CONSTRAINT reported_items_attr CHECK (news_id NULL OR comment_id NULL),
);

CREATE TABLE ReasonsForReport (
	reason_id INTEGER, --pkey
	user_id INTEGER, -- pkey
	news_id INTEGER, -- pkey
	comment_id INTEGER --pkey
	CONSTRAINT reasons_for_report_attr CHECK (news_id NULL OR comment_id NULL),
);

-- PRIMARY KEYS AND UNIQUES


ALTER TABLE ONLY Users
	ADD CONSTRAINT Users_pkey PRIMARY KEY(id);
ALTER TABLE ONLY Users
	ADD CONSTRAINT Users_username_key UNIQUE(username);
ALTER TABLE ONLY Users
	ADD CONSTRAINT Users_email_key UNIQUE(email);

ALTER TABLE ONLY News
	ADD CONSTRAINT News_pkey PRIMARY KEY(id);

ALTER TABLE ONLY Comments
	ADD CONSTRAINT Comment_pkey PRIMARY KEY(id);

ALTER TABLE ONLY Reasons
	ADD CONSTRAINT Reason_pkey PRIMARY KEY(id);

ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_pkey PRIMARY KEY(id);

ALTER TABLE ONLY Badges
	ADD CONSTRAINT Badges_pkey PRIMARY KEY(id);

ALTER TABLE ONLY FAQs
	ADD CONSTRAINT FAQ_faqID_pkey PRIMARY KEY (id);
ALTER TABLE ONLY FAQs
	ADD CONSTRAINT FAQ_question_key UNIQUE (question);

ALTER TABLE ONLY Countries
	ADD CONSTRAINT Countries_countryID_pkey PRIMARY KEY (id);
ALTER TABLE ONLY Countries
	ADD CONSTRAINT Countries_name_key UNIQUE (name);

ALTER TABLE ONLY Sources
	ADD CONSTRAINT Sources_sourceID_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Sections
	ADD CONSTRAINT Section_sectionID_pkey PRIMARY KEY (id);
ALTER TABLE ONLY Sections
	ADD CONSTRAINT Section_name_key UNIQUE (name);

ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_notificationID_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_user_id_news_id_pkey PRIMARY KEY (user_id, news_id);

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_pkey PRIMARY KEY (badge_id, user_id);

ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_pkey PRIMARY KEY (news_id,comment_id);

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_pkey PRIMARY KEY (follower_user_id, followed_user_id);

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_pkey PRIMARY KEY (user_id, section_id);

ALTER TABLE ONLY DeletedItemsReason
	ADD CONSTRAINT DeletedItemsReason_pkey PRIMARY KEY (news_id, comment_id, reason);

ALTER TABLE ONLY NewsSource
	ADD CONSTRAINT NewsSource_pkey PRIMARY KEY (news_id, source_id);

ALTER TABLE ONLY Bans
	ADD CONSTRAINT Bans_banned_user_id_pkey PRIMARY KEY (banned_user_id);


ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_ReportItemsID_pkey PRIMARY KEY (user_id,news_id,comment_id);

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reasonsForReporNewsID_pkey PRIMARY KEY (reason_id,user_id,news_id,comment_id);


-- FOREIGN KEYS


ALTER TABLE ONLY Users
	ADD CONSTRAINT Users_country_fkey FOREIGN KEY (country) REFERENCES Countries;

ALTER TABLE ONLY News
	ADD CONSTRAINT News_section_fkey FOREIGN KEY (section) REFERENCES Sections;
ALTER TABLE ONLY News
	ADD CONSTRAINT News_author_fkey FOREIGN KEY (author) REFERENCES Users;

ALTER TABLE ONLY Comments
	ADD CONSTRAINT Comment_creator_fkey FOREIGN KEY (creator) REFERENCES Users;
ALTER TABLE ONLY Comments
 ADD CONSTRAINT Comment_targetNews_fkey FOREIGN KEY (targetNews) REFERENCES News ON DELETE CASCADE;

ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_creator_fkey FOREIGN KEY (creator) REFERENCES Users;
ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_news_fkey FOREIGN KEY (news) REFERENCES News;
ALTER TABLE ONLY ModeratorComment
	ADD CONSTRAINT ModeratorComment_comment_fkey FOREIGN KEY (news) REFERENCES Comments;

ALTER TABLE ONLY Badges
	ADD CONSTRAINT Badges_creator_fkey FOREIGN KEY (creator) REFERENCES Users;

ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_targetUser_fkey FOREIGN KEY (targetUser) REFERENCES Users;
ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_user_fkey FOREIGN KEY (user_id) REFERENCES Users;
ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_news_fkey FOREIGN KEY (news_id) REFERENCES News;

ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users;
ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_news_id_fkey FOREIGN KEY (news_id) REFERENCES News;

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_badges_fkey FOREIGN KEY (badgesID) REFERENCES Badges;

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_user_fkey FOREIGN KEY (user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_news_fkey FOREIGN KEY (news) REFERENCES News ON DELETE CASCADE;
ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_comment_fkey FOREIGN KEY (comment_id) REFERENCES Comments ON DELETE CASCADE;
ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_user_fkey FOREIGN KEY (“user”) REFERENCES Users;

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_follower_user_id_fkey FOREIGN KEY (follower_user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_followed_user_id_fkey FOREIGN KEY (followed_user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_user_fkey FOREIGN KEY (“user”) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_section_fkey FOREIGN KEY (section) REFERENCES Sections ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItemsReason
	ADD CONSTRAINT DeletedItemsReason_deletedNews_fkey FOREIGN KEY (deleted_NewsID) REFERENCES DeletedItems ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItemsReason
	ADD CONSTRAINT DeletedItemsReason_deletedComments_fkey FOREIGN KEY (deleted_CommentsID) REFERENCES DeletedItems ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItemsReason
	ADD CONSTRAINT DeletedItemsReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reason;

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_news_fkey FOREIGN KEY (news) REFERENCES News ON DELETE CASCADE;

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_source_fkey FOREIGN KEY (source) REFERENCES Sources ON DELETE CASCADE;

ALTER TABLE ONLY Bans
	ADD CONSTRAINT Bans_admin_fkey FOREIGN KEY (admin) REFERENCES Users;


ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users;
ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_news_id_fkey FOREIGN KEY (news_id) REFERENCES News ON DELETE CASCADE;
ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportItems_comment_id_fkey FOREIGN KEY (comment_id) REFERENCES Comments ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reasonID_fkey FOREIGN KEY (reasonID) REFERENCES Reasons;
ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reportNewsID_fkey FOREIGN KEY (user_id, news_id, comment_id) REFERENCES ReportNews;
