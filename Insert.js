var fs = require('fs');
var crypto = require('crypto');

const NUM_USERS = 100;
const NUM_NEWS = 1000;
const NUM_COMMENTS = 10000;
const NUM_SECTIONS = 10;

var possibleUsernames  = [
    'WelshmanM','wsvrtativ','hemeanbeanX','rastejarrA','Dealer7L','mrexesz1','verpstas6K','eliteksouljafO','profizmus2L','JarovDl','xmyonly1xYR',
'rondloopM4','anjoleti9','zlatariAv','bitibajk5h','terpentinCb','SmrjankahJJ','EsaqandaDs','CimignagK','leigeil7D','piolenOr','u2s1u2tmw','cekust0D',
'mbu4r4dA','recludanohK','solanhetO3','tolovajej9','herrunumSQ','delantePd','madryckiG5','zoppyeaselOJ','z2o3tr45q','ljetnjih8O','leahnatashaxVR',
'CaxCaxunpagueSj','radiantbabyjW','knuttiesLU','taucliniaM9','insane34JB','GeskGriffLy','clyd3robertpM','veselitorvS','Stanticnu','ge1ra2m1qh',
'esmarlatsk9','StenglZx','czesuczamR','spiralnahd','ymostyngagD','sfibratoZz','AlannoaZ','ZeramonenobRx','degustatsLx','Trossinhh','silviaporraspP',
'YstumtueniP','PansinwS','popnbabygv','roggiaYm','kokcidieu8','excarseClelaybm','EsaqandawF','goncearwB','socarrimGh','piacatqD','VapylaurlB0',
'lanouoceaneiq','pineiroGl','ovimbelePf','wievenfL','guskovomrp','ramuluss7269yh','Tetauerlr','NeufeldenLw','napletaj43','uptownx001Kl','chacaouilK',
'zodic08OX','xarsenal96fp','pariraQZ','challa2x','barsacavang','kenny41089hC','typeintareeLQ','oor5sto8J','jmbobozw','speedtraps0m','kraljeval0N',
'DerickIo','forreJO','itfreekzonebR','ampresatZ5','lizard248347','ramejavaDK','kisdamou','LigorinoGP','lollapaloozaD9','kodeskeyYE','msukumizi86',
'lospequelibesdw'
]

var possibleEmails = [
    '@gmail.com','@hotmail.com','@live.com','@sapo.pt','@yahoo.com'
]

var genders = ['Male','Female','Other'];

var permissions = ['Normal','Moderator','Admin'];

var newsBody = [];
newsBody[0] = "<div><div><div><iframe src='https://www.youtube.com/embed/QixTsqn7RBE' frameborder='0' allowfullscreen=''></iframe>    </div></div><header class='article__header article__headerinline'><h1 class='article__headline'>This wearable brain scanner could transform our understanding of how neurons ‘talk’</h1><p>By <a href='/author/michael-price'>Michael Price</a><time>Mar. 21, 2018 , 2:20 PM</time></p></header><p>Mapping the chattering of neurons is a tricky undertaking. Arguably the best tool for eavesdropping in real time—by detecting the weak magnetic fields emitted by communicating neurons—comes with a huge caveat: Participants must keep their heads absolutely still inside an enormous scanner. That makes the method, magnetoencephalography (MEG), a no-go for young children, and it nixes studying brain behavior while people are moving. Now, scientists have developed the first device to solve those problems, a masklike instrument that can transmit brain signals even when the wearer is moving.</p><p>Despite some limits on how much of the brain’s activity can be mapped at once, neuroscientists are excited. “This is remarkable,” says MEG researcher Matti Hamalainen of Massachusetts General Hospital in Boston, who wasn’t involved in the study. “MEG is moving forward conceptually into a new era.”</p><p>When neurons interact with one another, their weak electrical current generates a tiny magnetic field. To measure it with conventional MEG, scientists have people stick their heads inside a scanner like an “old-style hair dryer at a salon,” explains physicist Richard Bowtell of the University of Nottingham in the United Kingdom. Inside the scanner are superconductors, loops of ultrasensitive magnetic sensors that need to be kept extremely cold by liquid helium.</p><p>It’s an incredibly powerful technology, Bowtell says, but a person moving just 5 millimeters will ruin any attempt to read their brain activity. To study the brain during motion-related tasks, MEG researchers have devised ingenious ways to simulate movement in virtual reality.</p><p>To work around such workarounds, Bowtell’s team created a wearable 3D-printed mask that, instead of using superconductors as sensors, relies on 13 small glass cubes filled with vaporized rubidium. These optically pumped magnetometers (OPMs) get to work when a laser pulses through the vapor, lining up the atoms in its path. When neural current from the brain generates a small magnetic field, it knocks the atoms out of formation. A sensor on the other side measures fluctuations in the light from the laser to paint a map of brain activity.</p><p>Elena Boto, a physicist at the University of Nottingham, was the first to try the mask out. To compare it to a conventional scanner, she performed a series of tasks—including bending and pointing her finger, drinking from a cup, and bouncing a ball on a paddle—while using both devices. Even though her head bobbed to and fro in the mask, the brain activity recorded <a href='https://www.nature.com/articles/nature26147'>was practically identical to that of the fixed scanner</a>, the researchers report today in <cite>Nature</cite>.</p><p>Some challenges remain. To counteract interference from Earth’s magnetic field, researchers had to set up two large panels with magnetic coils on either side of the mask, limiting Boto’s range of motion. Expanding the range of motion to allow for something like walking is a technically difficult chore.</p><p>But the biggest hurdle is cost. The OPM sensors, designed and manufactured by QuSpin of Louisville, Colorado, are expensive, each costing about $7000. The 13 sensors in the current mask could target only one region of the brain at a time—many dozens more would be needed to give scientists full-brain coverage. The cost of doing that, nearly $1 million, would be prohibitively expensive for many researchers, Bowtell says, though he expects the price to drop as the technology matures.</p><p>But Timothy Roberts, a neuroradiologist who works with children with autism at the Children’s Hospital of Philadelphia in Pennsylvania, says MEG masks like this one would be worth it. Neuroscientists could one day use them to track early brain development or to record brain signals in adults with movement disorders like Parkinson’s disease. Or, says Roberts, to finally get a good look at the brain activity of his often fidgety patients. “Asking a child with autism to sit still is not very easy. Asking a toddler to sit still is impossible. … I think this work is transformative.”</p><span content='This wearable brain scanner could transform our understanding of how neurons ‘talk’' class='rdf-meta element-hidden'></span></div>"
newsBody[1] = "<div>The introduction of the new pink-walled hypersoft as the softest tyre has taken Pirelli’s range of slick F1 tyres to seven, while it has also brought in new specifications of the ultrasoft, supersoft, soft and hard compounds. Asked by Motorsport.com what impact this would have on teams’ understanding of the new tyres in the early races, Isola said: “I am sure there are some details we don't know. “The compounds are more or less all new, except for the medium – that is the soft coming from last year. “We tested last year, we had a test in Abu Dhabi, we have a test [in Barcelona], but you cannot say that you know [every] detail of any compound with two tests. “So, the hypersoft is a compound that we need to understand where we can use it, and all the rest also. “I think that we start to know, really know the compounds, mid-season, not before. Before mid-season, the learning process is quite a steep curve.”Teams committed to their early-race allocations some time ago, then found the usability of certain compounds ruined by cold weather during pre-season testing at Barcelona.</div>"
newsBody[2] = "<div><h1>Preparing the world’s largest experiment</h1>– I believe we could start in a decade, if there’s global agreement. It’s a lot closer than many people think, says Helene Muri, squinting at the sun.Clouds obscure parts of the sky over Oslo this day, but from time to time, the sun shines through. Right now, the score seems to be even up there, but if Helene’s research is put into practice, the clouds will win. Day and night, all year round.Helene Muri is a cloud research meteorologist at the University of Oslo (Institute of Geosciences, Department of Meteorology and Oceanography), and one of an increasing number of scientists trying to find an emergency solution to the climate challenge.Together, the scientists are preparing what could be the largest experiment on Earth, with the whole planet as a laboratory; an experiment we won’t know the result of – until we’re right in the middle of it.This is the story of how this experiment is edging closer to reality. Among the players are the world’s richest man, Bill Gates – and an innocent balloon that sparked global outrage.It also raises one of the greatest dilemmas, not just for climate researchers, but for you and me as well: Should the world really consider something as extreme as tinkering with the weather? Will the majority ever welcome Helene Muri’s artificial clouds in the sky?</div>"

var newsTitles = [
    "A dusting of salt could cool the planet", 
    "Neutron star mergers may create much of the universe’s gold",
    "Google takes on fake news with $300 million News Initiative",
    "New wearable brain scanner",
    "New F1 tyres won't be understood until mid-season"
];

var commentsText = [
    "Greate news, love it!",
    "This is completely fake. I am a forensic scientist and I know what I am talking about. Believe me, this makes no sense. ",
    "I think everyone must take a step back! I shared this news out of respect and it’s become a world wide argument! Rhinos are going extinct it’s a fact! Respect that and do something to change it!",
    "I expect F1 to have a great season <3",
    "Those scientists are really crazy. A salt cloud? ahahaha",
    "Really? I have 2 neutron stars in my garage. How can I merge them to make some gold?",
    "Google has no change against Photon News. Google should buy it."
]


let usersArray = createUsers();
printUsersSQL(usersArray);
let newsArray = createNews();
printNewsSql(newsArray);
let commentsArray = createComments();
printCommentsSQL(commentsArray);

function getNewUser(){
    return {
        username: null,
        email: null,
        gender: null,
        country: null,
        picture: null,
        password: null,
        points: null,
        permission: null,
    }
}

function getNewNews(){
    return {
        title: null,
        body: null,
        image: null,
        votes: null,
        section_id : null,
        author_id: null
    }
}

function getNewComment(){
    return {
        text: null,
        creator_user_id: null,
        target_news_id: null
    }
}


function createUsers(){
    let usersArray = [];
    const numPossibleUsernames = possibleUsernames.length;
    for (let i = 0; i < NUM_USERS; i++){
        let cycle = Math.floor(i/NUM_USERS);
        const hash = crypto.createHash('sha256');
        let rndNum = Math.random();
        let user = getNewUser();
        user.username = possibleUsernames[i%numPossibleUsernames];
        if (cycle > 0) user.username += cycle;
        user.email = user.username + possibleEmails[i % possibleEmails.length];
        user.gender = (rndNum < 0.05) ? genders[2] : (rndNum < 0.5) ? genders[1] : genders[0];
        user.country = Math.floor(rndNum * NUM_USERS);
        user.picture = user.username + ".png"; 
        user.password = hash.update(user.username).digest('hex');
        user.points = Math.floor(rndNum * 1000 * Math.random());
        user.permission = (rndNum < 0.05) ? permissions[2] : (rndNum < 0.2) ?  permissions[1] : permissions[0];
        usersArray.push(user);
    }
    return usersArray;
}

function createNews(){
    let newsArray = [];
    const numNewsTitles = newsTitles.length;
    const numNewsBodies = newsBody.length;
    for (let i = 0; i < NUM_NEWS; i++){
        let rndNum = Math.random();
        let news = getNewNews();
        news.title = newsTitles[i%numNewsTitles];
        news.body = newsBody[i%numNewsBodies];
        news.image = i + ".png";
        news.votes = Math.floor(rndNum * 150 - 50);
        news.section_id = Math.floor(rndNum * NUM_SECTIONS);
        news.author_id = Math.floor(rndNum * NUM_USERS);
        newsArray.push(news);
    }
    return newsArray;
}

function createComments(){
    let commentsArray = [];
    for(let i = 0; i< NUM_COMMENTS; i++){
        let rndNum = Math.random();
        let comment = getNewComment();
        comment.text = commentsText[Math.floor(rndNum * commentsText.length)];
        comment.creator_user_id = 1 + Math.floor(rndNum * NUM_USERS);
        comment.target_news_id = 1 + Math.floor(rndNum * NUM_COMMENTS);
        commentsArray.push(comment);
    }
    return commentsArray;
}

function writeToFile(filename, outputString){
    let stream = fs.createWriteStream(filename);
    stream.once('open', () => {
        stream.write(outputString);
        stream.end();
    });
}

function printCommentsSQL(commentsArray){
    let outputString = "";
    commentsArray.forEach(comment => {
        outputString += "INSERT INTO comments (text, creator_user_id, target_news_id) VALUES ("
        + "'" + comment.text + "',"
        + comment.creator_user_id + ","
        + comment.target_news_id
        + ");\n"
    });
    writeToFile("InsertComments.sql",outputString);
}


function printNewsSql(newsArray){
    let outputString = "";
    newsArray.forEach(news => {
        outputString += "INSERT INTO news (title,body,image,votes,section_id,author_id) VALUES ("
        + '"' + news.title + '",'
        + '"' + news.body + '",'
        + '"' + news.image + '",'
        + news.votes + ","
        + news.section_id + ","
        + news.author_id
        + ");\n"
    })
    writeToFile("InsertNews.sql",outputString);
}

function printUsersSQL(usersArray){
    let outputString = "";
    usersArray.forEach(user => {
        outputString += "INSERT INTO users (username,email,gender,country_id,picture,password,points,permission) VALUES (" 
        + "'" + user.username + "',"
        + "'" + user.email+ "',"
        + "'" + user.gender+ "',"
        + user.country + ","
        + "'" + user.picture+ "',"
        + "'" + user.password+ "',"
        + user.points + ","
        + "'" + user.permission+ "'"
        + ");\n"
    });
    writeToFile("InsertUsers.sql",outputString);
}