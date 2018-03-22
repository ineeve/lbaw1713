-- DROP TABLES

DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS News CASCADE;
DROP TABLE IF EXISTS Comments CASCADE;
DROP TABLE IF EXISTS Reasons CASCADE;
DROP TABLE IF EXISTS ModeratorComments CASCADE;
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
DROP TABLE IF EXISTS ReasonsForDelete CASCADE;
DROP TABLE IF EXISTS NewsSources CASCADE;

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
	"text" text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator_user_id INTEGER NOT NULL,
	target_news_id INTEGER NOT NULL
);

CREATE TABLE Reasons(
	id SERIAL,
	name text NOT NULL
);


CREATE TABLE ModeratorComments(
	id SERIAL,
	"text" text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator_user_id INTEGER NOT NULL,
	news_id INTEGER,
	comment_id INTEGER,
	CONSTRAINT moderator_comment_attr_null CHECK ((news_id IS NULL OR comment_id IS NULL) AND news_id != comment_id)
);

CREATE TABLE Badges(
	id SERIAL,
	name text NOT NULL,
	brief text,
	votes INTEGER,
	articles INTEGER,
	comments INTEGER,
	creator_user_id INTEGER NOT NULL,
	CONSTRAINT notification_attr_null CHECK (votes IS NOT NULL OR articles IS NOT NULL OR comments IS NOT NULL)
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


CREATE TABLE Notifications (
   id SERIAL,
   "date" DATE NOT NULL DEFAULT now(),
   type Text NOT NULL,
   target_user_id INTEGER,
   was_read BOOLEAN DEFAULT false,
   user_id INTEGER,
   news_id INTEGER,
   CONSTRAINT notification_type_attr CHECK ((type = 'FollowMe' AND news_id IS NULL) OR user_id IS NULL),
   CONSTRAINT notification_attr_null CHECK ((news_id IS NULL OR user_id IS NULL) AND news_id != user_id),
   CONSTRAINT notification_type CHECK (type = ANY(ARRAY['FollowMe','CommentMyPost', 'FollowedPublish', 'VoteMyPost']::text[]))
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

CREATE TABLE Follows (
	follower_user_id INTEGER NOT NULL,
	followed_user_id INTEGER NOT NULL
);
CREATE TABLE UserInterests (
	user_id INTEGER NOT NULL,
	section_id INTEGER NOT NULL
);

CREATE TABLE NewsSources (
	news_id INTEGER NOT NULL,
	source_id INTEGER NOT NULL
);

CREATE TABLE Bans (
	banned_user_id INTEGER, -- primary key does not need NN
	admin_user_id INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	reason text NOT NULL
);

CREATE TABLE ReasonsForDelete (
	deleted_news_id INTEGER NOT NULL,
	deleted_comment_id INTEGER NOT NULL,
	reason_id INTEGER NOT NULL,
	CONSTRAINT deleted_items_reason_null CHECK
	( (deleted_news_id IS NULL OR deleted_comment_id IS NULL) AND deleted_news_id != deleted_comment_id)
);

CREATE TABLE ReasonsForReport (
	reason_id INTEGER, --pkey
	user_id INTEGER, -- pkey
	news_id INTEGER, -- pkey
	comment_id INTEGER --pkey
	CONSTRAINT reasons_for_report_attr CHECK ((news_id IS NULL OR comment_id IS NULL) AND news_id != comment_id)
);

CREATE TABLE DeletedItems (
	news_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	comment_id INTEGER NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	brief TEXT
);

CREATE TABLE ReportedItems (
	user_id INTEGER, -- pkey
	news_id INTEGER, -- pkey
	comment_id INTEGER, -- pkey
	description text,
	CONSTRAINT reported_items_attr CHECK ((news_id IS NULL OR comment_id IS NULL) AND news_id != comment_id)
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
	ADD CONSTRAINT Reasons_pkey PRIMARY KEY(id);

ALTER TABLE ONLY ModeratorComments
	ADD CONSTRAINT ModeratorComments_pkey PRIMARY KEY(id);

ALTER TABLE ONLY Badges
	ADD CONSTRAINT Badges_pkey PRIMARY KEY(id);

ALTER TABLE ONLY FAQs
	ADD CONSTRAINT FAQs_pkey PRIMARY KEY (id);
ALTER TABLE ONLY FAQs
	ADD CONSTRAINT FAQs_question_key UNIQUE (question);

ALTER TABLE ONLY Countries
	ADD CONSTRAINT Countries_pkey PRIMARY KEY (id);
ALTER TABLE ONLY Countries
	ADD CONSTRAINT Countries_name_key UNIQUE (name);

ALTER TABLE ONLY Sources
	ADD CONSTRAINT Sources_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Sections
	ADD CONSTRAINT Section_pkey PRIMARY KEY (id);
ALTER TABLE ONLY Sections
	ADD CONSTRAINT Section_name_key UNIQUE (name);

ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_pkey PRIMARY KEY (id);

ALTER TABLE ONLY Votes
	ADD CONSTRAINT Votes_pkey PRIMARY KEY (user_id, news_id);

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_pkey PRIMARY KEY (badge_id, user_id);

ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_pkey PRIMARY KEY (news_id,comment_id);

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_pkey PRIMARY KEY (follower_user_id, followed_user_id);

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_pkey PRIMARY KEY (user_id, section_id);

ALTER TABLE ONLY ReasonsForDelete
	ADD CONSTRAINT ReasonsForDelete_pkey PRIMARY KEY (deleted_news_id, deleted_comment_id, reason_id);

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_pkey PRIMARY KEY (news_id, source_id);

ALTER TABLE ONLY Bans
	ADD CONSTRAINT Bans_pkey PRIMARY KEY (banned_user_id);


ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportedItems_pkey PRIMARY KEY (user_id,news_id,comment_id);

ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_pkey PRIMARY KEY (reason_id,user_id,news_id,comment_id);


-- FOREIGN KEYS


ALTER TABLE ONLY Users
	ADD CONSTRAINT Users_country_id_fkey FOREIGN KEY (country_id) REFERENCES Countries;

ALTER TABLE ONLY News
	ADD CONSTRAINT News_section_id_fkey FOREIGN KEY (section_id) REFERENCES Sections;
ALTER TABLE ONLY News
	ADD CONSTRAINT News_author_id_fkey FOREIGN KEY (author_id) REFERENCES Users;

ALTER TABLE ONLY Comments
	ADD CONSTRAINT Comment_creator_user_id_fkey FOREIGN KEY (creator_user_id) REFERENCES Users;
ALTER TABLE ONLY Comments
 ADD CONSTRAINT Comment_target_news_id_fkey FOREIGN KEY (target_news_id) REFERENCES News ON DELETE CASCADE;

ALTER TABLE ONLY ModeratorComments
	ADD CONSTRAINT ModeratorComment_creator_user_id_fkey FOREIGN KEY (creator_user_id) REFERENCES Users;
ALTER TABLE ONLY ModeratorComments
	ADD CONSTRAINT ModeratorComment_news_id_fkey FOREIGN KEY (news_id) REFERENCES News;
ALTER TABLE ONLY ModeratorComments
	ADD CONSTRAINT ModeratorComment_comment_id_fkey FOREIGN KEY (comment_id) REFERENCES Comments;

ALTER TABLE ONLY Badges
	ADD CONSTRAINT Badges_creator_user_id_fkey FOREIGN KEY (creator_user_id) REFERENCES Users;

ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_target_user_id_fkey FOREIGN KEY (target_user_id) REFERENCES Users;
ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users;
ALTER TABLE ONLY Notifications
	ADD CONSTRAINT Notification_news_id_fkey FOREIGN KEY (news_id) REFERENCES News;

ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users;
ALTER TABLE ONLY Votes
	ADD CONSTRAINT Vote_news_id_fkey FOREIGN KEY (news_id) REFERENCES News;

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_badge_id_fkey FOREIGN KEY (badge_id) REFERENCES Badges;

ALTER TABLE ONLY Achievements
	ADD CONSTRAINT Achievements_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_news_id_fkey FOREIGN KEY (news_id) REFERENCES News ON DELETE CASCADE;
ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_comment_id_fkey FOREIGN KEY (comment_id) REFERENCES Comments ON DELETE CASCADE;
ALTER TABLE ONLY DeletedItems
	ADD CONSTRAINT DeletedItems_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users;

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_follower_user_id_fkey FOREIGN KEY (follower_user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY Follows
	ADD CONSTRAINT Follows_followed_user_id_fkey FOREIGN KEY (followed_user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
	ADD CONSTRAINT UserInterests_section_id_fkey FOREIGN KEY (section_id) REFERENCES Sections ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForDelete
	ADD CONSTRAINT ReasonsForDelete_deleted_items_fkey FOREIGN KEY (deleted_news_id,deleted_comment_id) REFERENCES DeletedItems ON DELETE CASCADE;

ALTER TABLE ONLY ReasonsForDelete
	ADD CONSTRAINT ReasonsForDelete_reason_id_fkey FOREIGN KEY (reason_id) REFERENCES Reasons;

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_news_id_fkey FOREIGN KEY (news_id) REFERENCES News ON DELETE CASCADE;

ALTER TABLE ONLY NewsSources
	ADD CONSTRAINT NewsSources_source_id_fkey FOREIGN KEY (source_id) REFERENCES Sources ON DELETE CASCADE;

ALTER TABLE ONLY Bans
	ADD CONSTRAINT Bans_admin_user_id_fkey FOREIGN KEY (admin_user_id) REFERENCES Users;


ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportedItems_user_id_fkey FOREIGN KEY (user_id) REFERENCES Users;
ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportedItems_news_id_fkey FOREIGN KEY (news_id) REFERENCES News ON DELETE CASCADE;
ALTER TABLE ONLY ReportedItems
	ADD CONSTRAINT ReportedItems_comment_id_fkey FOREIGN KEY (comment_id) REFERENCES Comments ON DELETE CASCADE;

-- Table Reasons for report has cols: reason_id, user_id, news_id, comment_id
ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_reason_id_fkey FOREIGN KEY (reason_id) REFERENCES Reasons;
ALTER TABLE ONLY ReasonsForReport
	ADD CONSTRAINT ReasonsForReport_user_news_comment_fkey FOREIGN KEY (user_id, news_id, comment_id) REFERENCES ReportedItems;