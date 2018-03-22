-- POPULATE TABLES

--Reasons
INSERT INTO Reasons(name) VALUES ('Rude or Abusive');
INSERT INTO Reasons(name) VALUES ('Scam/Spam');
INSERT INTO Reasons(name) VALUES ('Sexually Inappropiate');

--Countries
INSERT INTO Countries(name) VALUES
('Afghanistan'),
('Albania'),
('Algeria'),
('Andorra'),
('Angola'),
('Antigua and Barbuda'),
('Argentina'),
('Armenia'),
('Australia'),
('Austria'),
('Azerbaijan'),
('Bahamas, The'),
('Bahrain'),
('Bangladesh'),
('Barbados'),
('Belarus'),
('Belgium'),
('Belize'),
('Benin'),
('Bhutan'),
('Bolivia'),
('Bosnia and Herzegovina'),
('Botswana'),
('Brazil'),
('Brunei'),
('Bulgaria'),
('Burkina Faso'),
('Burma'),
('Burundi'),
('Cambodia'),
('Cameroon'),
('Canada'),
('Cape Verde'),
('Central Africa'),
('Chad'),
('Chile'),
('China'),
('Colombia'),
('Comoros'),
('Congo, Democratic Republic of the'),
('Costa Rica'),
('Cote dIvoire'),
('Crete'),
('Croatia'),
('Cuba'),
('Cyprus'),
('Czech Republic'),
('Denmark'),
('Djibouti'),
('Dominican Republic'),
('East Timor'),
('Ecuador'),
('Egypt'),
('El Salvador'),
('Equatorial Guinea'),
('Eritrea'),
('Estonia'),
('Ethiopia'),
('Fiji'),
('Finland'),
('France'),
('Gabon'),
('Gambia, The'),
('Georgia'),
('Germany'),
('Ghana'),
('Greece'),
('Grenada'),
('Guadeloupe'),
('Guatemala'),
('Guinea'),
('Guinea-Bissau'),
('Guyana'),
('Haiti'),
('Holy See'),
('Honduras'),
('Hong Kong'),
('Hungary'),
('Iceland'),
('India'),
('Indonesia'),
('Iran'),
('Iraq'),
('Ireland'),
('Israel'),
('Italy'),
('Ivory Coast'),
('Jamaica'),
('Japan'),
('Jordan'),
('Kazakhstan'),
('Kenya'),
('Kiribati'),
('Korea, North'),
('Korea, South'),
('Kosovo'),
('Kuwait'),
('Kyrgyzstan'),
('Laos'),
('Latvia'),
('Lebanon'),
('Lesotho'),
('Liberia'),
('Libya'),
('Liechtenstein'),
('Lithuania'),
('Macau'),
('Macedonia'),
('Madagascar'),
('Malawi'),
('Malaysia'),
('Maldives'),
('Mali'),
('Malta'),
('Marshall Islands'),
('Mauritania'),
('Mauritius'),
('Mexico'),
('Micronesia'),
('Moldova'),
('Monaco'),
('Mongolia'),
('Montenegro'),
('Morocco'),
('Mozambique'),
('Namibia'),
('Nauru'),
('Nepal'),
('Netherlands'),
('New Zealand'),
('Nicaragua'),
('Niger'),
('Nigeria'),
('North Korea'),
('Norway'),
('Oman'),
('Pakistan'),
('Palau'),
('Panama'),
('Papua New Guinea'),
('Paraguay'),
('Peru'),
('Philippines'),
('Poland'),
('Portugal'),
('Qatar'),
('Romania'),
('Russia'),
('Rwanda'),
('Saint Lucia'),
('Saint Vincent and the Grenadines'),
('Samoa'),
('San Marino'),
('Sao Tome and Principe'),
('Saudi Arabia'),
('Scotland'),
('Senegal'),
('Serbia'),
('Seychelles'),
('Sierra Leone'),
('Singapore'),
('Slovakia'),
('Slovenia'),
('Solomon Islands'),
('Somalia'),
('South Africa'),
('South Korea'),
('Spain'),
('Sri Lanka'),
('Sudan'),
('Suriname'),
('Swaziland'),
('Sweden'),
('Switzerland'),
('Syria'),
('Taiwan'),
('Tajikistan'),
('Tanzania'),
('Thailand'),
('Tibet'),
('Timor-Leste'),
('Togo'),
('Tonga'),
('Trinidad and Tobago'),
('Tunisia'),
('Turkey'),
('Turkmenistan'),
('Tuvalu'),
('Uganda'),
('Ukraine'),
('United Arab Emirates'),
('United Kingdom'),
('United States'),
('Uruguay'),
('Uzbekistan'),
('Vanuatu'),
('Venezuela'),
('Vietnam'),
('Yemen'),
('Zambia'),
('Zimbabwe');

--Badges

INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Enthusiast', 'Voted on 100 news', 100, 0, 0, 29);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Disseminator!', 'Posted 100 news', 0, 100, 0, 57);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Intervener', 'Made 200 comments', 0, 0, 200, 69);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Active!', 'Voted on 500 news', 500, 0, 0, 29);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Judge', 'Voted on 1000 news', 1000, 0, 0, 29);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Explorer', 'Posted 5000 news', 0, 500, 0, 29);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Nosy', 'Made 500 comments', 0, 0, 500, 57);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Wise', 'Posted 2000 news', 0, 2000, 0, 69);
INSERT INTO Badges(name, brief, votes, articles, comments, creator_user_id) VALUES ('Revolution', 'Made 1500 comments', 0, 0, 1500, 57);

--FAQs

INSERT INTO FAQs(question, answer) VALUES ('Do I need an account on the Photon News?', 'No, to comment all you need is a Facebook account.');
INSERT INTO FAQs(question, answer) VALUES ('What does it mean to comment to an article through Facebook?', 'When you comment on a Photon News article,
   your comment will be published through Facebook. Please be sure to review Facebook''s Privacy Policy here:https://www.facebook.com/note.php?note_id=%20322194465300.
    Please note that each comment will also appear on your Facebook wall unless you uncheck the "post to profile" or "also post on facebook" box for that comment.
     If you uncheck this box for a comment, it will not appear on your Facebook feed.');
INSERT INTO FAQs(question, answer) VALUES (' I don''t want to post through Facebook.', 'Due to changing trends in public communication, all article comments will
   be submitted through Facebook going forward. If you do not want your comment to appear on your Facebook wall, simply un-check "post to profile" or "also post to facebook"
    below the comment box. For more information, you can read about this change here:
http://www.photonnews.com/otto-toth/were-moving-the-conversation_b_5423675.html');
INSERT INTO FAQs(question, answer) VALUES ('I already have a Photon News account, what will happen to it?', 'You are still able to log in to your Photon News account to follow other
   users and bloggers, and you will be able to view your post history for comments made prior to the move to Facebook comments. Comments left through the Facebook platform will not
    be visible in your post history.');
INSERT INTO FAQs(question, answer) VALUES ('Where can I create an account and login?', 'There is a login prompt at the top right corner of every page on the site, or visit:
   http://www.photonnews.com/users/login/');
INSERT INTO FAQs(question, answer) VALUES ('Where can I change my screen name?', 'Unfortunately, you cannot change your screen name once you have registered; nor can we.
   Every screen name is associated with one email address. If you need help with an existing account, please reach out to us.');
INSERT INTO FAQs(question, answer) VALUES ('Where can I change my password, personal information or biography?', 'Edit information on the preferences page: http://www.photonnews.com/users/preferences');
INSERT INTO FAQs(question, answer) VALUES ('Can I include a link in my comment?', 'Yes. But any comment that contains a link to an inappropriate site may not be displayed on the Photon News site.');
INSERT INTO FAQs(question, answer) VALUES ('What is the "Follow/Fan" link on Photon News user accounts?', 'When you find a user you like, you can press the Follow/Fan link in his profile page. This way you can keep track of the articles he posts.');
INSERT INTO FAQs(question, answer) VALUES ('Where can I sign up for news alerts and other notifications?', 'http://www.phtonnews.com/signup');

--Sources

INSERT INTO Sources(link, author, consultation_date) VALUES ('http://www.bbc.com/news/world-europe-43504396', 'Lawton Le Jean','2017-04-29'),
('https://www.reuters.com/article/us-usa-china-trade-mofcom/china-blames-u-s-for-staggering-trade-surplus-as-tariffs-loom-idUSKBN1GX3DM','Vidovik Renshall','2017-04-26'),
('https://www.afp.com/en/news/23/bale-nets-hat-trick-wales-smash-sorry-china-6-0-doc-12z9051', 'Wyatan Lindley','2018-02-22'),
('https://www.upi.com/Top_News/US/2018/03/22/Police-find-bombing-target-list-suspects-family-devastated/4751521629599/?utm_source=fp&utm_campaign=ls&utm_medium=1', 'Betti Castellani','2017-04-01'),
('https://www.reuters.com/article/us-facebook-cambridge-analytica-stocks/facebook-investors-fret-over-costs-as-zuckerberg-apologizes-idUSKBN1GY1GI', 'Berkly Durtnal','2017-08-11'),
('http://www.bbc.com/news/world-us-canada-43497364', 'Mallory Lincey','2017-09-21'),
('https://www.afp.com/en/news/23/russian-media-boycott-parliament-over-sex-scandal-doc-12z3jv2', 'Findlay Gawler','2017-08-08'),
('https://www.upi.com/Entertainment_News/2018/03/22/Prince-Harry-Meghan-Markle-send-out-wedding-invitations/5991521731627/?utm_source=fp&utm_campaign=ts_en&utm_medium=7', 'Sayre Wildbore','2018-01-09'),
('https://widerimage.reuters.com/story/journey-to-antarctica-seals-penguins-and-glacial-beauty?utm_campaign=web-app-launch&utm_medium=banner&utm_source=rcom&utm_content=ros', 'Agretha Oiseau','2017-10-19'),
('http://www.bbc.com/news/av/world-africa-43487852/ghana-computer-teacher-s-chalkboard-microsoft-word-inspires', 'Ewart Puttrell','2017-12-11');

--Sections

INSERT INTO sections(name, icon) VALUES ('Travel', 'fas fa-plane'),
('Sport', 'fas fa-basketball-ball'),
('Culture', 'fas fa-users'),
('Food', 'fas fa-utensils'),
('Nature', 'fas fa-leaf'),
('Weather', 'fas fa-sun'),
('Fututre', 'far fa-clock'),
('Shop', 'fas fa-shopping-cart'),
('TV', 'fas fa-tv'),
('Music', 'fas fa-music'),
('Arts', 'fas fa-paint-brush'),
('Science', 'fas fa-flask'),
('Health', 'fas fa-user-md');

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

-- Achievements
-- TODO repeted
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,75);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,85);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,94);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,75);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,76);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,58);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,22);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,75);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,81);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,71);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,100);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,53);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,65);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,21);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,88);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,30);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,75);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,34);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,14);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,20);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,98);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,44);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,46);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,24);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,20);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,9);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,75);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,66);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,43);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,6);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,93);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,17);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,66);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,17);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,99);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,17);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,58);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,29);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,10);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,73);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,74);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,43);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,30);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,15);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,99);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,9);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,43);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,19);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,93);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,63);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,5);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,26);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,2);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,95);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,69);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,7);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,15);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,51);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,84);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,63);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,25);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,13);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,61);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,69);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,32);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,1);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,54);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,14);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,44);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,86);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,51);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,25);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,77);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,78);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,70);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,37);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,47);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,43);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,25);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,92);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,70);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,6);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,96);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,33);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,65);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,11);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,24);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,100);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,88);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,100);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,43);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,65);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,100);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,12);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,25);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,63);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,62);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,50);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,80);
INSERT INTO "Achievements" (badge_id,user_id) VALUES (1,75);

-- FOllows

INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (9,36);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (98,74);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (68,6);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (38,80);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (21,87);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (90,34);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (3,95);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (26,91);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (11,73);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (29,58);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (10,61);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (15,49);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (15,35);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (72,8);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (28,4);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (86,17);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (59,29);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (22,65);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (13,2);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (31,7);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (22,22);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (41,38);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (92,73);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (64,27);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (95,20);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (67,10);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (63,76);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (16,28);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (31,86);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (5,48);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (70,46);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (84,93);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (2,50);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (9,9);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (99,40);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (29,21);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (41,89);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (5,40);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (35,38);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (71,78);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (58,37);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (17,85);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (13,59);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (2,28);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (2,39);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (76,69);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (57,54);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (29,14);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (15,11);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (90,37);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (82,49);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (91,70);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (64,90);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (67,13);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (16,19);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (7,11);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (39,94);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (98,51);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (70,1);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (21,42);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (92,66);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (69,8);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (41,26);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (19,10);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (39,4);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (7,94);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (54,83);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (43,15);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (14,39);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (44,23);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (23,50);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (27,53);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (20,43);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (76,12);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (15,23);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (36,44);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (16,78);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (94,8);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (89,82);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (65,70);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (15,13);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (20,29);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (4,84);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (33,19);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (47,20);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (30,21);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (5,13);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (11,14);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (12,4);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (5,71);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (28,68);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (14,93);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (91,30);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (24,51);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (21,26);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (19,83);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (45,62);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (85,37);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (69,12);
INSERT INTO "Follows" (follower_user_id,followed_user_id) VALUES (89,12);

--User interested

INSERT INTO "UserInterests" (user_id,section_id) VALUES (84,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (98,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (61,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (55,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (91,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (100,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (51,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (33,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (13,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (14,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (65,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (87,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (85,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (39,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (81,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (78,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (73,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (32,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (73,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (54,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (71,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (23,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (94,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (98,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (89,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (38,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (19,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (48,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (58,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (73,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (15,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (81,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (96,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (28,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (21,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (22,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (55,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (99,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (60,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (31,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (53,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (91,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (28,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (94,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (60,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (89,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (32,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (24,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (36,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (19,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (66,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (30,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (100,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (63,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (16,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (57,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (3,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (7,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (71,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (44,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (93,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (32,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (42,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (42,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (90,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (29,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (54,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (66,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (42,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (82,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (85,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (88,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (57,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (87,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (21,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (28,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (99,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (79,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (1,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (7,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (59,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (87,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (79,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (42,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (6,4);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (53,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (22,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (35,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (33,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (34,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (18,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (66,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (62,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (64,3);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (84,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (23,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (89,1);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (9,2);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (20,5);
INSERT INTO "UserInterests" (user_id,section_id) VALUES (56,4);
