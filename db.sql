/* DROP TYPE IF EXISTS NotificationType;
DROP TYPE IF EXISTS VoteType;

DROP TABLE IF EXISTS FAQ;
DROP TABLE IF EXISTS Country;
DROP TABLE IF EXISTS Source;
DROP TABLE IF EXISTS Section;
DROP TABLE IF EXISTS Notification;
DROP TABLE IF EXISTS Vote; */

CREATE TYPE NotificationType AS ENUM ('');
CREATE TYPE VoteType AS ENUM('Positive', 'Negative');

CREATE TABLE Utilizador (
	userID SERIAL NOT NULL,
	username text NOT NULL,
	email text NOT NULL,
	gender text,
	country INTEGER,
	picture text,
	password text NOT NULL,
	points INTEGER NOT NULL,
	permission text NOT NULL,
	CONSTRAINT gender CHECK ((gender = ANY (ARRAY['Male'::text, 'Female'::text, 'Other'::text]))),
	CONSTRAINT points CHECK ((points >= 0)),
	CONSTRAINT permission CHECK ((permission = ANY (ARRAY['Admin':text,'Mod'::text,'Normal'::text])))
);


CREATE TABLE News (
	newsID SERIAL NOT NULL,
	title text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
	body text NOT NULL,
	image text NOT NULL,
	votes INTEGER NOT NULL,
	section INTEGER NOT NULL,
	author INTEGER NOT NULL
);

CREATE TABLE Comment(
	commentID SERIAL NOT NULL,
	text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator INTEGER NOT NULL,
	targetNews INTEGER NOT NULL
);

CREATE TABLE Reason(
	reasonID SERIAL NOT NULL,
	name text NOT NULL
);


CREATE TABLE ModeratorComment(
	moderatorCommentID SERIAL NOT NULL,
	"text" text NOT NULL,
	"date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
	creator INTEGER NOT NULL,
	news INTEGER,
	comment INTEGER
);

CREATE TABLE Badge(
	id SERIAL NOT NULL,
	name text NOT NULL,
	brief text,
	votes INTEGER,
	articles INTEGER,
	comments INTEGER,
	creator INTEGER NOT NULL
);


CREATE TABLE FAQ (
    faqID SERIAL NOT NULL PRIMARY KEY,
    question TEXT NOT NULL UNIQUE,
    answer TEXT NOT NULL
);

CREATE TABLE Country (
    countryID SERIAL NOT NULL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE Source (
    sourceID SERIAL NOT NULL PRIMARY KEY,
    link TEXT NOT NULL,
    author TEXT NOT NULL,
    consultationDate DATE NOT NULL
);

CREATE TABLE Section (
    sectionID SERIAL NOT NULL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE Notification (
    notificationID SERIAL NOT NULL PRIMARY KEY,
    link TEXT NOT NULL,
    votesNum INTEGER,
    date DATE NOT NULL DEFAULT now(),
    type NotificationType NOT NULL,
    targetUser INTEGER REFERENCES Utilizador,
    wasRead BOOLEAN,
    user INTEGER REFERENCES Utilizador
);

CREATE TABLE Vote (
    userID INTEGER REFERENCES Utilizador,
    newsID INTEGER REFERENCES News,
    type VoteType NOT NULL,
    PRIMARY KEY (userID, newsID)
);

CREATE TABLE Achievements (
    badgesID INTEGER NOT NULL,
    userID INTEGER NOT NULL
);
CREATE TABLE DeletedNews (
    news INTEGER NOT NULL,
    user INTEGER NOT NULL,
    date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    brief TEXT
);
CREATE TABLE Follows (
    follower INTEGER NOT NULL,
    followed INTEGER NOT NULL
);
CREATE TABLE UserInterests (
    user INTEGER NOT NULL,
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
ALTER TABLE ONLY Achievements
    ADD CONSTRAINT Achievements_pkey PRIMARY KEY (badgesID, userID);

ALTER TABLE ONLY DeletedNews
    ADD CONSTRAINT DeletedNews_pkey PRIMARY KEY (news);
    
ALTER TABLE ONLY Follows
    ADD CONSTRAINT Follows_pkey PRIMARY KEY (follower, followed);

ALTER TABLE ONLY UserInterests
    ADD CONSTRAINT UserInterests_pkey PRIMARY KEY (user, section);

ALTER TABLE ONLY DeletedNewsReason
    ADD CONSTRAINT DeletedNewsReason_pkey PRIMARY KEY (deleted, reason);
    
ALTER TABLE ONLY NewsSource
    ADD CONSTRAINT NewsSource_pkey PRIMARY KEY (news, source);

ALTER TABLE ONLY DeletedCommentReason
    ADD CONSTRAINT DeletedCommentReason_pkey PRIMARY KEY (reason, comment);
    
ALTER TABLE ONLY Achievements
    ADD CONSTRAINT Achievements_badges_fkey FOREIGN KEY (badgesID) REFERENCES Badge(badgesID) ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY Achievements
    ADD CONSTRAINT Achievements_user_fkey FOREIGN KEY (userID) REFERENCES Utilizador(userID) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNews
    ADD CONSTRAINT DeletedNews_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY DeletedNews
    ADD CONSTRAINT DeletedNews_user_fkey FOREIGN KEY (user) REFERENCES Utilizador(userID) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY Follows
    ADD CONSTRAINT Follows_follower_fkey FOREIGN KEY (follower) REFERENCES Utilizador(userID) ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY Follows
    ADD CONSTRAINT Follows_followed_fkey FOREIGN KEY (followed) REFERENCES Utilizador(userID) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY UserInterests
    ADD CONSTRAINT UserInterests_user_fkey FOREIGN KEY (user) REFERENCES Utilizador(userID) ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY UserInterests
    ADD CONSTRAINT UserInterests_section_fkey FOREIGN KEY (section) REFERENCES Section(sectionID) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ONLY DeletedNewsReason
    ADD CONSTRAINT DeletedNewsReason_deleted_fkey FOREIGN KEY (deleted) REFERENCES DeletedNews(news) ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY DeletedNewsReason
    ADD CONSTRAINT DeletedNewsReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reason(reasonID) ON UPDATE CASCADE ON DELETE CASCADE;




ALTER TABLE ONLY NewsSource
    ADD CONSTRAINT NewsSource_news_fkey FOREIGN KEY (news) REFERENCES News(newsID) ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY NewsSource
    ADD CONSTRAINT NewsSource_source_fkey FOREIGN KEY (source) REFERENCES Source(sourceID) ON UPDATE CASCADE ON DELETE CASCADE;



ALTER TABLE ONLY DeletedCommentReason
    ADD CONSTRAINT DeletedCommentReason_reason_fkey FOREIGN KEY (reason) REFERENCES Reason(reasonID)  ON UPDATE CASCADE ON DELETE CASCADE;
 
ALTER TABLE ONLY DeletedCommentReason
    ADD CONSTRAINT DeletedCommentReason_comment_fkey FOREIGN KEY (comment) REFERENCES DelectedComment(delectedCommentID) ON UPDATE CASCADE ON DELETE CASCADE;




CREATE TABLE Banned (
    banned INTEGER PRIMARY KEY REFERENCES Utilizador,
    admin INTEGER NOT NULL REFERENCES Utilizador,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    reason text NOT NULL
);

CREATE TABLE ReportNews (
    userID INTEGER REFERENCES Utilizador,
    newsID INTEGER REFERENCES News,
    CONSTRAINT reportNewsID PRIMARY KEY (userID,newsID),
    description text
);

CREATE TABLE ReasonsForReportNews (
    reasonID INTEGER REFERENCES Reason,
    userID INTEGER,
    newsID INTEGER,
    CONSTRAINT reportNewsID FOREIGN KEY (userID, newsID)
    REFERENCES ReportNews,
    CONSTRAINT reasonsForReportNewsID PRIMARY KEY (reasonID, reportNewsID)
);

CREATE TABLE ReportComment (
  userID INTEGER REFERENCES Utilizador,
  commentID INTEGER REFERENCES Comment,
  CONSTRAINT reportCommentID PRIMARY KEY (userID,commentID),
  description text
);

CREATE TABLE ReasonsForReportComment (
    reasonID INTEGER REFERENCES Reason,
    userID INTEGER,
    commentID INTEGER,
    CONSTRAINT reportCommentID FOREIGN KEY (userID, commentID)
    REFERENCES ReportComment,
    CONSTRAINT reasonsForReportCommentID PRIMARY KEY (reasonID, reportCommentID)
);

CREATE TABLE DeletedComment (
    commentID INTEGER PRIMARY KEY REFERENCES Comment,
    userID INTEGER NOT NULL REFERENCES Utilizador,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    brief text
);