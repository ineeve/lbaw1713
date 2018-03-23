var fs = require('fs');
var crypto = require('crypto');

const NUM_USERS = 100;
const NUM_NEWS = 1000;
const NUM_COMMENTS = 10000;
const NUM_SECTIONS = 13;
const NUM_MODERATOR_COMMENTS = 100;

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
newsBody[0] = "<div><div><div><iframe src=''https://www.youtube.com/embed/QixTsqn7RBE''></iframe>    </div></div><header class=''article__header article__headerinline''><h1 class=''article__headline''>This wearable brain scanner could transform our understanding of how neurons ‘talk’</h1><p>By <a href=''/author/michael-price''>Michael Price</a><time>Mar. 21, 2018 , 2:20 PM</time></p></header><p>Mapping the chattering of neurons is a tricky undertaking. Arguably the best tool for eavesdropping in real time—by detecting the weak magnetic fields emitted by communicating neurons—comes with a huge caveat: Participants must keep their heads absolutely still inside an enormous scanner. That makes the method, magnetoencephalography (MEG), a no-go for young children, and it nixes studying brain behavior while people are moving. Now, scientists have developed the first device to solve those problems, a masklike instrument that can transmit brain signals even when the wearer is moving.</p><p>Despite some limits on how much of the brain’s activity can be mapped at once, neuroscientists are excited. “This is remarkable,” says MEG researcher Matti Hamalainen of Massachusetts General Hospital in Boston, who wasn’t involved in the study. “MEG is moving forward conceptually into a new era.”</p><p>When neurons interact with one another, their weak electrical current generates a tiny magnetic field. To measure it with conventional MEG, scientists have people stick their heads inside a scanner like an “old-style hair dryer at a salon,” explains physicist Richard Bowtell of the University of Nottingham in the United Kingdom. Inside the scanner are superconductors, loops of ultrasensitive magnetic sensors that need to be kept extremely cold by liquid helium.</p><p>It’s an incredibly powerful technology, Bowtell says, but a person moving just 5 millimeters will ruin any attempt to read their brain activity. To study the brain during motion-related tasks, MEG researchers have devised ingenious ways to simulate movement in virtual reality.</p><p>To work around such workarounds, Bowtell’s team created a wearable 3D-printed mask that, instead of using superconductors as sensors, relies on 13 small glass cubes filled with vaporized rubidium. These optically pumped magnetometers (OPMs) get to work when a laser pulses through the vapor, lining up the atoms in its path. When neural current from the brain generates a small magnetic field, it knocks the atoms out of formation. A sensor on the other side measures fluctuations in the light from the laser to paint a map of brain activity.</p><p>Elena Boto, a physicist at the University of Nottingham, was the first to try the mask out. To compare it to a conventional scanner, she performed a series of tasks—including bending and pointing her finger, drinking from a cup, and bouncing a ball on a paddle—while using both devices. Even though her head bobbed to and fro in the mask, the brain activity recorded <a href=''https://www.nature.com/articles/nature26147''>was practically identical to that of the fixed scanner</a>, the researchers report today in <cite>Nature</cite>.</p><p>Some challenges remain. To counteract interference from Earth’s magnetic field, researchers had to set up two large panels with magnetic coils on either side of the mask, limiting Boto’s range of motion. Expanding the range of motion to allow for something like walking is a technically difficult chore.</p><p>But the biggest hurdle is cost. The OPM sensors, designed and manufactured by QuSpin of Louisville, Colorado, are expensive, each costing about $7000. The 13 sensors in the current mask could target only one region of the brain at a time—many dozens more would be needed to give scientists full-brain coverage. The cost of doing that, nearly $1 million, would be prohibitively expensive for many researchers, Bowtell says, though he expects the price to drop as the technology matures.</p><p>But Timothy Roberts, a neuroradiologist who works with children with autism at the Children’s Hospital of Philadelphia in Pennsylvania, says MEG masks like this one would be worth it. Neuroscientists could one day use them to track early brain development or to record brain signals in adults with movement disorders like Parkinson’s disease. Or, says Roberts, to finally get a good look at the brain activity of his often fidgety patients. “Asking a child with autism to sit still is not very easy. Asking a toddler to sit still is impossible. … I think this work is transformative.”</p><span content=''This wearable brain scanner could transform our understanding of how neurons ‘talk’'' class=''rdf-meta element-hidden''></span></div>"
newsBody[1] = "<div>The introduction of the new pink-walled hypersoft as the softest tyre has taken Pirelli’s range of slick F1 tyres to seven, while it has also brought in new specifications of the ultrasoft, supersoft, soft and hard compounds. Asked by Motorsport.com what impact this would have on teams’ understanding of the new tyres in the early races, Isola said: “I am sure there are some details we don''t know. “The compounds are more or less all new, except for the medium – that is the soft coming from last year. “We tested last year, we had a test in Abu Dhabi, we have a test [in Barcelona], but you cannot say that you know [every] detail of any compound with two tests. “So, the hypersoft is a compound that we need to understand where we can use it, and all the rest also. “I think that we start to know, really know the compounds, mid-season, not before. Before mid-season, the learning process is quite a steep curve.”Teams committed to their early-race allocations some time ago, then found the usability of certain compounds ruined by cold weather during pre-season testing at Barcelona.</div>"
newsBody[2] = "<div><h1>Preparing the world’s largest experiment</h1>– I believe we could start in a decade, if there’s global agreement. It’s a lot closer than many people think, says Helene Muri, squinting at the sun.Clouds obscure parts of the sky over Oslo this day, but from time to time, the sun shines through. Right now, the score seems to be even up there, but if Helene’s research is put into practice, the clouds will win. Day and night, all year round.Helene Muri is a cloud research meteorologist at the University of Oslo (Institute of Geosciences, Department of Meteorology and Oceanography), and one of an increasing number of scientists trying to find an emergency solution to the climate challenge.Together, the scientists are preparing what could be the largest experiment on Earth, with the whole planet as a laboratory; an experiment we won’t know the result of – until we’re right in the middle of it.This is the story of how this experiment is edging closer to reality. Among the players are the world’s richest man, Bill Gates – and an innocent balloon that sparked global outrage.It also raises one of the greatest dilemmas, not just for climate researchers, but for you and me as well: Should the world really consider something as extreme as tinkering with the weather? Will the majority ever welcome Helene Muri’s artificial clouds in the sky?</div>"
newsBody[3] = "<div><p><em>Update 3/23/18 12:39am ET: The Senate votes in favor of the omnibus, 65-32. It now goes to the White House for the President''s signature.<br /></em></p><p><em>Update 3/22/18: The House of Representatives just passed the omnibus, 256-to-167</em>.</p><p>Last month, Congress <a href=''https://www.politico.com/story/2018/02/07/government-shutdown-senate-budget-deal-395984''>reached a broad budget deal</a> that lifted self-imposed spending caps&mdash;the ''sequester''&mdash;for the next two years. Yesterday, we saw the fruit of that deal with the release of the <em>Consolidated Appropriations Act of 2018</em>, a bill that would fund nearly all government agencies through the remainder of this fiscal year (which ends September 30). NASA&mdash;and science in general&mdash;did very well in this legislation. Congress thoroughly rejected every major cut proposed to NASA and other science agencies by the Trump Administration, often providing them with funding increases instead. This is arguably the best budget for national science investment in a decade.</p><p>Should this legislation pass, NASA would receive a $1.1 billion increase to $20.7 billion in fiscal year 2018. This is a far better outcome than the White House''s original proposal, which would have cut NASA by 1 percent to $19.1 billion. Adjusting for inflation, this is NASA''s best budget since 2009, when it received a temporary $1 billion boost from the economic stimulus bill.</p><p>And it wasn''t just NASA. As <a href=''http://www.sciencemag.org/news/2018/03/science-gets-major-boost-2018-us-spending-deal''>Science Magazine points</a> out, every federal science program maintained or grew its budget. The National Science Foundation, NOAA, the Department of Energy''s Office of Science&mdash;all will receive budget increases. Basically, Congress grew the size of the pie, so nearly everyone was able to take a bigger slice.</p><p>Several Planetary Society funding priorities were contained in this bill. First and foremost, the robotic Mars Exploration Program receives a $75 million increase with specific directions to ''support the Mars Sample return mission and orbiter'', in line with our recommendations and as a consequence of our <a href=''http://planetary.s3.amazonaws.com/assets/pdfs/advocacy/2017/Mars-in-Retrograde---The-Planetary-Society---2017.pdf''><em>Mars in Retrograde </em>report</a> released last year.</p><p>Planetary defense has been another major area of work for our Advocacy team this year, and we were very pleased to see NEOCam&mdash;a proposed space telescope for detecting near-Earth objects&mdash;funded at $35 million. While not ideal, this amount will help maintain critical production lines for sensors needed by this mission.</p><p>And then there''s Europa, the mission The Planetary Society and its members have worked so hard to support over the years. It stands to receive $595 million in 2018, not just for the Clipper spacecraft, but for work on a lander as well. The legislation reiterates that the mission launch in 2022 on a Space Launch System rocket. NASA has stated it wants to launch the Clipper in 2025 on a commercial rocket.</p><p>The Planetary Society and its members worked hard for these goals in addition to larger budgets for NASA and science in general. Congress listened, and key members of the appropriations committees really came through for these important priorities. They also explicitly supported the priorities recommended by the scientific community through the decadal survey process&mdash;another commendable action and important to a stable future of space science and exploration.</p><p>Okay, let''s break things down.</p></div>";
newsBody[4] = "<div><div class=''img-caption-box'' style=''width: 840px;''><a href=''http://www.planetary.org/multimedia/space-images/saturn/crisp-views-of-titans.html''><img alt=''Crisp views of Titan''s northern lakes and equatorial dunefields'' class=''img840'' src=''http://planetary.s3.amazonaws.com/assets/images/6-saturn/2016/20160912_28997333814_b7d1dcae36_o_f840.png'' /></a><p class=''photo_credit''><em>NASA / JPL / SSI / Ian Regan</em></p><h5>Crisp views of Titan''s northern lakes and equatorial dunefields</h5>A near-global view of Titan shows its surface from the north polar lakes to the equatorial dune fields of Fensal-Aztlan and Senkyo. The center image shows Titan approximately as it would appear to the human eye, its surface hidden by haze and its north pole experiencing a summer ''hood''. On the right, surface details are revealed by looking at Titan in an infrared wavelength (''CB3'') at which methane is relatively transparent, and correcting for the affect of the methane in the atmosphere by dividing that image by one taken in a wavelength where methane absorbs light. On the left, the enhanced surface image has been colorized using data from methane filters in a way that mimics the natural color of Titan.</div></div><p>There was a full session devoted to Cassini on Monday (<a href=''https://www.sciencenews.org/article/5-things-about-saturn-cassini-mission''>Lisa Grossman wrote up a nice summary here</a>), but then on Tuesday, another morning session focused entirely on Titan, called &ldquo;<a href=''https://www.hou.usra.edu/meetings/lpsc2018/pdf/sess203.pdf''>Titan Is Terrific</a>&rdquo;. (That link will take you to a PDF program for the session, with links to two-page abstracts on all the talks.) Project scientist Linda Spilker told me that the organizing committee received so many Titan submissions that the mission asked the meeting to create a second session devoted to the complex moon. I found three of the talks to be particularly thought-provoking.</p><p>It kicked off with Chris Glein talking about how a nasty gas &ndash; hydrogen cyanide (HCN) &ndash; behaves in Titan&rsquo;s atmosphere, and what that might mean for the search for the fossil record of the beginnings of life on Earth. &ldquo;Something strange and wonderful is happening with nitrogen fractionation in HCN,&rdquo; he said. His standards for &ldquo;wonderful&rdquo; might be different from yours, but what he was talking about is that at Titan, the heavier isotope of nitrogen, nitrogen-15, is far more abundant in HCN than it is in the much more common nitrogen-carrying atmospheric gas, regular old molecular nitrogen (N2). The reasons I won&rsquo;t go into because I don&rsquo;t want to get sidetracked. Glein&rsquo;s point is that the same process could very well have happened on the very earliest Earth&rsquo;s atmosphere. And HCN is an incredibly important precursor molecule to sticking nitrogen into prebiotic compounds like amino acids. So any incredibly early life would likely have been drawing this highly fractionated nitrogen from HCN in the atmosphere. The organic materials from 4-billion-year-old organisms, if they existed, has long ago been turned into graphite or other inorganic-looking materials in rocks. But we could go looking at the nitrogen in those rocks and see what the isotopic ratios are. If there&rsquo;s an excess of nitrogen-15, it could&rsquo;ve come from HCN in Earth&rsquo;s atmosphere, processed by early life into proteins. [<a href=''https://www.hou.usra.edu/meetings/lpsc2018/pdf/2182.pdf''>Abstract 2812</a>]</p><div id=''item-863121240'' style=''display: inline;''>   <div class=''img-caption-box'' style=''width: 840px;''><a href=''http://www.planetary.org/blogs/emily-lakdawalla/2007/images/20170911_PIA08630_bottom_f840.jpg''><img alt=''Probable lakes near Titan''s north pole'' class=''img840'' src=''http://planetary.s3.amazonaws.com/assets/images/6-saturn/2017/20170911_PIA08630_bottom_f840.jpg'' /></a><p class=''photo_credit''><em></em></p><h5>Bathtubs and rings on Titan</h5>Many of Titan''s polar lakes are closed basins with rounded shapes that look like sinkholes or glacial lakes. The areas around them are often light-colored. One hypothesis for the light areas around the dark lakes is that they are made of solids that evaporated out of the lake liquid (or formed some other way, like frost or solidified ''sea spray'').</div></div><p>Then Morgan Cable gave a talk about &ldquo;Molecular Minerals on Titan.&rdquo; Titan is a place where the atmosphere creates large quantities of small organic molecules like ethane, acetylene, propane, and so on. These fall out onto the surface with methane and ethane rain, and some of them accumulate in lakes. Around the edges of lakes scientists have observed &ldquo;bathtub rings&rdquo;, bright-colored haloes around the lakes. We don&rsquo;t know for sure but it&rsquo;s possible that these are made of materials deposited as lakes evaporate, leaving behind evaporite deposits, like salts form around evaporating lakes on Earth. The materials that form evaporites will be the least soluble materials. In a Titan lake, Cable said, the first thing you&rsquo;d expect to fall out of solution would be benzene. But it wouldn&rsquo;t just be benzene; when benzene forms crystals, it readily incorporates ethane into its crystal structure, forming a &ldquo;co-crystal&rdquo;. If it&rsquo;s a crystal and it forms solid deposits, what you&rsquo;ve got is a mineral &ndash; and the beginning of the science of Titan petrology. Cable said they looked around for other small molecules and found that acetylene readily forms lots of different co-crystals, notably with ammonia. They formed their co-crystals in the lab and tried wetting them (raining on it) with a mix of methane and ethane, and the solids stayed &ndash; suggesting they&rsquo;d persist as solid deposits on Titan. One unusual thing about these minerals is that when they warm, they experience a lot of thermal expansion. So if you formed this material on Titan&rsquo;s surface, and then buried it (either by subduction or just by covering it with other stuff), it could expand as it warmed with depth, causing stresses that might produce physical evidence on the surface. [<a href=''https://www.hou.usra.edu/meetings/lpsc2018/pdf/2717.pdf''>Abstract #2717</a>]</p><p>If you like Titan petrology, how about Titan seismology? Mark Panning&rsquo;s talk was about that, motivated by the <a href=''http://dragonfly.jhuapl.edu/''>Dragonfly mission concept</a> and its plans for a seismic instrument. Seismic data (recordings of ground motion caused by earthquake waves) can tell scientists about the internal structure of a world regardless of what it&rsquo;s made of. Titan would have regular icequakes caused by the flexing of its crust due to tides with every Saturn orbit. When kids are taught about seismology, they learn about P and S and surface waves, and Titan would have all of those. But because it has an ice shell over a liquid ocean, there would also be some other interesting kinds of lower-frequency waves moving through the ice shell. For example, there&rsquo;s a flexural wave, in which the whole ice shell bends back and forth slowly. There are Crary waves, which are waves trapped within the ice shell whose frequency is sensitive to the thickness of the ice shell. Panning used Apollo seismic data for the Moon (which also has quakes caused mostly by tidal forces) to make some predictions about how common quakes of different sizes would be on Titan. Then he asked questions like: how sensitive does the seismic instrument need to be to detect several quakes over the course of the mission? (The answer: medium-sensitive compared to off-the-shelf Earth seismometers.) How bad is atmospheric noise? (The answer: wind will be pretty noisy, but the bigger events should still be detectable.) Would waves on lakes cause noise? (The answer: they can, but if the instrument is close to the equator, it won&rsquo;t be an issue.) And: is there any spot on Titan that&rsquo;s more likely than anywhere else to have large quakes? (The answer: they&rsquo;re expected to be fairly uniformly distributed, except that the sub-Saturn and anti-Saturn points have less quakes than everywhere else, so aiming near the leading or trailing points would be best for seismic studies.) [<a href=''https://www.hou.usra.edu/meetings/lpsc2018/pdf/1662.pdf''>Abstract #1662</a>]</p><p>There were a lot more cool talks on Titan landscape features: dissected domes! New impact craters! Ridges around lakes! --and if you''re dying to read more, check out the <a href=''https://www.hou.usra.edu/meetings/lpsc2018/pdf/sess203.pdf''>session abstracts</a>.</p></div>";


var newsTitles = [
    "A dusting of salt could cool the planet", 
    "Neutron star mergers may create much of the universe''s gold",
    "Google takes on fake news with $300 million News Initiative",
    "New wearable brain scanner",
    "New F1 tyres won''t be understood until mid-season"
];

var commentsText = [
    "Greate news, love it!",
    "This is completely fake. I am a forensic scientist and I know what I am talking about. Believe me, this makes no sense. ",
    "I think everyone must take a step back! I shared this news out of respect and it''s become a world wide argument! Rhinos are going extinct it''s a fact! Respect that and do something to change it!",
    "I expect F1 to have a great season <3",
    "Those scientists are really crazy. A salt cloud? ahahaha",
    "Really? I have 2 neutron stars in my garage. How can I merge them to make some gold?",
    "Google has no change against Photon News. Google should buy it."
]

var moderatorComments = [
    "This article has been reported for racism, unsure if I should act on it.",
    "I do not see any reason as to how this is racism, it should be disregarded.",
    "I agree with jonhy97. I consider it to be offensive to many people therefore it should be banned.",
    "I will report to an admin",
    "I consider this news to be spam therefore it should be banned in my opinion.",
    "If we accept comments like this we might be facing law problems."
]

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
        news.section_id = 1 + Math.floor(rndNum * NUM_SECTIONS);
        news.author_id = 1 + Math.floor(rndNum * NUM_USERS);
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
        comment.target_news_id = 1 + Math.floor(rndNum * NUM_NEWS);
        commentsArray.push(comment);
    }
    return commentsArray;
}
function getNewModComment(){
    return {
        text:null,
        creator_user_id: null,
        news_id: null,
        comment_id: null,
    }
}

var admins = [3,59,]
var mods = [2,13,17,21,22,39,44,51,52,58,73,87,89];

function createModeratorComments(){
    let moderatorCommentsArray = [];
    for (let i = 0; i < NUM_MODERATOR_COMMENTS; i++){
        let rndNum = Math.random();
        let modComment = getNewModComment();
        modComment.text = moderatorComments[i % moderatorComments.length];
        modComment.creator_user_id = mods[i % mods.length];
        if (i%2 == 0){
            modComment.news_id = Math.floor(rndNum * NUM_NEWS) + 1;
            modComment.comment_id = 'NULL';
        }else{
            modComment.news_id = 'NULL';
            modComment.comment_id = Math.floor(rndNum * NUM_COMMENTS) + 1;
        }
        moderatorCommentsArray.push(modComment);
    }
    return moderatorCommentsArray;
}

function writeToFile(filename, outputString){
    let stream = fs.createWriteStream(filename);
    stream.once('open', () => {
        stream.write(outputString);
        stream.end();
    });
}

function createModeratorCommentsSQL(commentsArray){
    let outputString = "";
    commentsArray.forEach(comment => {
        outputString += "INSERT INTO ModeratorComments (text, creator_user_id, news_id, comment_id) VALUES ("
        + "'" + comment.text + "',"
        + comment.creator_user_id + ","
        + comment.news_id + ","
        + comment.comment_id
        + ");\n"
    });
    writeToFile("InsertModeratorComments.sql",outputString);
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
        + "'" + news.title + "',"
        + "'" + news.body + "',"
        + "'" + news.image + "',"
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

let newsArray = createNews();
printNewsSql(newsArray);

/*let commentsArray = createModeratorComments();
createModeratorCommentsSQL(commentsArray);*/
