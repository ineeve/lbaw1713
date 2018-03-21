var fs = require('fs');
var crypto = require('crypto');

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


let usersArray = createUsers();
printSQL(usersArray);

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

function createUsers(){
    let usersArray = [];
    for (let i = 0; i < 100; i++){
        const hash = crypto.createHash('sha256');
        let rndNum = Math.random();
        let user = getNewUser();
        user.username = possibleUsernames[i];
        user.email = user.username + possibleEmails[i % possibleEmails.length];
        user.gender = (rndNum < 0.05) ? genders[2] : (rndNum < 0.5) ? genders[1] : genders[0];
        user.country = Math.floor(rndNum * 100);
        user.picture = user.username + ".png"; 
        user.password = hash.update(user.username).digest('hex');
        user.points = Math.floor(rndNum * 1000 * Math.random());
        user.permission = (rndNum < 0.05) ? permissions[2] : (rndNum < 0.2) ?  permissions[1] : permissions[0];
        usersArray.push(user);
    }
    return usersArray;
}

function printSQL(usersArray){
    let outputString = "";
    usersArray.forEach(user => {
        outputString += "INSERT INTO users (username,email,gender,country_id,picture,password,points,permission) VALUES (" 
        + "'" + user.username + "'" + ","
        + "'" + user.email+ "'" + ","
        + "'" + user.gender+ "'" + ","
        + user.country + ","
        + "'" + user.picture+ "'" + ","
        + "'" + user.password+ "'" + ","
        + user.points + ","
        + "'" + user.permission+ "'"
        + ");\n"
    });
    let stream = fs.createWriteStream("InsertUsers.sql");
    stream.once('open', () => {
        stream.write(outputString);
        stream.end();
    });
}