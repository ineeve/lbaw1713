-- POPULATE TABLES

-- Notifications

INSERT INTO Notifications ("date", type, target_user_id, was_read, user_id) VALUES (21/03/2018, 'FollowMe', 1, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'FollowedPublish', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'VoteMyPost', 1, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, user_id) VALUES (21/03/2018, 'FollowMe', 1, FALSE, 3);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 1, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'FollowedPublish', 1, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'VoteMyPost', 1, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, user_id) VALUES (21/03/2018, 'FollowMe', 2, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 2, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'FollowedPublish', 2, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'VoteMyPost', 2, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, user_id) VALUES (21/03/2018, 'FollowMe', 3, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'FollowedPublish', 3, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'VoteMyPost', 3, FALSE, 1);
INSERT INTO Notifications ("date", type, target_user_id, was_read, user_id) VALUES (21/03/2018, 'FollowMe', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'FollowedPublish', 3, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'VoteMyPost', 3, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, user_id) VALUES (21/03/2018, 'FollowMe', 5, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'CommentMyPost', 5, FALSE, 4);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'FollowedPublish', 5, FALSE, 2);
INSERT INTO Notifications ("date", type, target_user_id, was_read, news_id) VALUES (21/03/2018, 'VoteMyPost', 5, FALSE, 1);

-- Votes

INSERT INTO Votes (user_id, news_id, type) VALUES (1, 1, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 2, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 3, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 4, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 5, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 6, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 7, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 8, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 9, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 10, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 11, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 12, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 13, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 14, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 15, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 16, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 17, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 18, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 19, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (1, 20, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 1, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 2, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 3, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 4, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 5, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 6, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 7, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 8, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 9, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 10, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 11, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 12, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 13, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 14, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 15, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 16, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 17, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 18, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 19, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (2, 20, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 1, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 2, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 3, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 4, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 5, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 6, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 7, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 8, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 9, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 10, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (3, 11, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (4, 1, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (5, 2, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (6, 3, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (6, 4, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (7, 5, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (7, 1, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (7, 2, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (8, 3, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (9, 4, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (10, 5, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (10, 1, TRUE);
INSERT INTO Votes (user_id, news_id, type) VALUES (10, 2, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (11, 3, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (12, 4, FALSE);
INSERT INTO Votes (user_id, news_id, type) VALUES (13, 5, TRUE);

-- Bans

INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (10, 1, 21/03/2018, 'Offensive');
INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (35, 1, 21/03/2018, 'Troll');
INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (45, 1, 21/03/2018, 'Offensive');
INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (69, 1, 21/03/2018, 'pineapples');
INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (70, 1, 21/03/2018, 'Scammer');
INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (101, 1, 21/03/2018, 'Scammer');
INSERT INTO Bans (banned_user_id, admin_user_id, "date", reason) VALUES (103, 1, 21/03/2018, 'Offensive');

-- ReportedItems

INSERT INTO ReportedItems (user_id, news_id, description) VALUES (1, 1, 'Test report');
INSERT INTO ReportedItems (user_id, news_id, description) VALUES (3, 1, ' ');
INSERT INTO ReportedItems (user_id, comment_id, description) VALUES (3, 3, 'Report');
INSERT INTO ReportedItems (user_id, news_id, description) VALUES (3, 5, 'I find this piece of news ridiculously false.');
INSERT INTO ReportedItems (user_id, comment_id, description) VALUES (5, 11, 'Self-explanatory.');
INSERT INTO ReportedItems (user_id, comment_id) VALUES (6, 13);
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 14, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 15, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 16, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 17, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 18, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 19, "News Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 24, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 25, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 26, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 27, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 28, "Report");
INSERT INTO ReportedItems (user_id, news_id) VALUES (6, 29, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 14, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 15, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 16, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 17, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 18, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 19, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 24, "Comment Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 25, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 26, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 27, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 28, "Report");
INSERT INTO ReportedItems (user_id, comment_id) VALUES (11, 29, "Report");

-- ReasonsForReport

INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (1, 1, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 1, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 1, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (1, 2, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 2, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 2, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 1, 2);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 1, 3);
