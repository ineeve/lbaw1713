

INSERT INTO reporteditems (user_id, news_id, description) VALUES (1, 1, 'Test report');
INSERT INTO reporteditems (user_id, news_id, description) VALUES (3, 1, ' ');
INSERT INTO reporteditems (user_id, comment_id, description) VALUES (3, 3, 'Report');
INSERT INTO reporteditems (user_id, news_id, description) VALUES (3, 5, 'I find this piece of news ridiculously false.');
INSERT INTO reporteditems (user_id, comment_id, description) VALUES (5, 11, 'Self-explanatory.');
INSERT INTO reporteditems (user_id, comment_id) VALUES (6, 13);
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 14, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 15, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 16, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 17, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 18, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 19, "News Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 24, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 25, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 26, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 27, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 28, "Report");
INSERT INTO reporteditems (user_id, news_id) VALUES (6, 29, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 14, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 15, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 16, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 17, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 18, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 19, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 24, "Comment Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 25, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 26, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 27, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 28, "Report");
INSERT INTO reporteditems (user_id, comment_id) VALUES (11, 29, "Report");

-- ReasonsForReport

INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (1, 1, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 1, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 1, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (1, 2, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 2, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 2, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 1, 2);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 1, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 1, 2);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 1, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (1, 3, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 3, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 3, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (1, 3, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 3, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 4, 1);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 5, 2);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 6, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 6, 2);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 10, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (3, 11, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 12, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 15, 3);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (2, 12, 10);
INSERT INTO ReasonsForReport (reason_id, user_id, comment_id) VALUES (2, 12, 25);
INSERT INTO ReasonsForReport (reason_id, user_id, news_id) VALUES (3, 12, 3);

-- DeletedItems, ReasonsForDelete, ReasonsForReport, ReportedItems
