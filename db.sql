DROP DATABASE ActorManager;
CREATE DATABASE ActorManager;
USE ActorManager;


Create Table GAME(
	id  int auto_increment primary key,
	name varchar(50),
	ruleSet varchar(50),
	description text
);

Create Table WORLD(
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	gameId int,
	foreign key (gameId) REFERENCES game(id)
);

Create Table CONTINENT(
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	worldId int,
	foreign key (worldId) REFERENCES WORLD(id)
	
);

Create Table NATION (
	id  int auto_increment primary key,
	name varchar(50),
	description text
);

Create Table CONTINENTNATION(
	continentId int,
	nationId int,
	foreign key (continentId) REFERENCES CONTINENT(id),
	foreign key (nationId) REFERENCES NATION(id)
);

Create Table CITY (
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	nationId int,
	foreign key (nationId) REFERENCES NATION(id)
);

Create Table ORGANISATION(
	id  int auto_increment primary key,
	name varchar(50),
	description text
);


Create Table CITYORGANISATION(
	cityId int,
	organisationId int,
	foreign key (cityId) REFERENCES CITY(id),
	foreign key (organisationId) REFERENCES ORGANISATION(id)
);


Create Table ACTOR(
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	inventory int
);



create table DISCIPLINEGROUPVM(
	id  int auto_increment primary key,	
	name varchar(15),
	masqueradeThreat varchar(15),
	description text,
	resonance varchar(50)
);

create table DISCIPLINEVM(
	id  int auto_increment primary key,	
	name varchar(20),
	description varchar(600),
	dicePools varchar(600),
	cost varchar(600),
	mechanics varchar(600),
	disciplineGroupVMId int,
	duration varchar(150),
	foreign key (disciplineGroupVMId) REFERENCES DISCIPLINEGROUPVM(id)
);

create table ATTRIBUTEVM (
	id  int auto_increment primary key,	
	name varchar(50)
); 


create table SKILLVM(
	id  int auto_increment primary key,
	name varchar(15)
);

create table CLANVM(
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	bane text
);

create table PREDVM(
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	features text
);

create table GENVM(
	generationNum int(4) UNIQUE primary key,
	name varchar(50),
	description text
);

create table RESOVM(
	id  int auto_increment primary key,
	name varchar(50),
	description text
);

create table COUNTERVM(
	id  int auto_increment primary key,
	hun int(1),
	hum int(1),
	bloPo int(2),
	hp int(2), 
	supHp int(2),
	aggHp int(2),
	wp int(2),
	supWp int(2),
	aggWp int(2)
);

create table EXPVM(
	id  int auto_increment primary key,
	name varchar(50),
	total int(4),
	spent int(4)
	); 

create table advantageVM(
	id  int auto_increment primary key,
	name varchar(50),
	description text,
	point int(1)
	); 



create table CHARINFOVM(
	id  int auto_increment primary key,
	name varchar(50),
	conc varchar(15),
	predVMId int,
	ambi varchar(15),
	clanVMId int,
	sire varchar(50),
	des varchar(50),
	generationNum int(2),
	resoVMId int,
	truA int(4),
	appA int(3),
	datBir datetime,
	datDea datetime,
	app text,
	disFea text,
	his text,
	notes text,
	foreign key (predVMId) REFERENCES predVM(id),
	foreign key (clanVMId) REFERENCES CLANVM(id),
	foreign key (generationNum) REFERENCES GENVM(generationNum),
	foreign key (resoVMId) REFERENCES RESOVM(id)	
);




Create Table STATBlOCKVM(
	id  int auto_increment primary key,
	charInfoVMId int not null,
	counterVMId int not null,
	expVMId int not null,
	foreign key (charInfoVMId)REFERENCES CHARINFOVM(id),
	foreign key (counterVMId) REFERENCES COUNTERVM(id),
	foreign key (expVMId) REFERENCES expvm(id)
	);


create table STATBlOCKVMDISCIPLINE(
	statBlockVMId int not null,
	disciplineVMId int not null,
	disciplineGroupVMId int not null,
	dots int(1) not null,
	foreign key (statBlockVMId) REFERENCES STATBlOCKVM(id),
	foreign key (disciplineVMId) REFERENCES DISCIPLINEVM(id),
	foreign key (disciplineGroupVMId) REFERENCES DISCIPLINEGROUPVM(id)
);

create table STATBLOCKVMATTRIBUTE(
	statBlockVMId int not null,	
	attributeVMId int not null,
	dots int(1) not null,
	foreign key (attributeVMId) REFERENCES ATTRIBUTEVM(id),
	foreign key (statBlockVMId) REFERENCES STATBlOCKVM(id)
);

create table advantagecharacterVM(
	statBlockVMId int,
	advantageVMId int,
	foreign key (statBlockVMId) REFERENCES statblockvm(id),
	foreign key (advantageVMId) REFERENCES advantageVM(id)
	); 


Create Table STATBLOCKDND(
	id  int auto_increment primary key
	);

Create Table STATS(
	actorId int,
	statBlockVMId int,
	statBlockDNDId int,
	foreign key (statBlockVMId) REFERENCES STATBlOCKVM(id),
	foreign key (statBlockDNDId) REFERENCES STATBLOCKDND(id)
);


CREATE TABLE POWER(
	id  int auto_increment primary key,
	name varchar(30),
	description text,
	powerLevel int(3)
);

CREATE TABLE POWERPYRAMID(
	organisationId int,
	actorId int,
	powerId int,
	superior int,
	foreign key (organisationId) REFERENCES organisation(id),
	foreign key (actorId) REFERENCES actor(id),
	foreign key (powerId) REFERENCES power(id),
	foreign key (superior) REFERENCES POWERPYRAMID(actorId)
);

CREATE TABLE STATBLOCKVMSKILL(
	statBlockVMId int not null,
	skillVMId int not null,
	dots int(1) not null,
	speciality char(50),
	foreign key (statBlockVMId) REFERENCES STATBLOCKVM(id),
	foreign key (skillVMId) REFERENCES SKILLVM(id)
);
INSERT INTO GAME (name, ruleSet, description) VALUES ("Vampire the Masquerade: Belgium Ball", "Vampire Masquerade 5th edition", 
"In the heart of the European Union there's a world of darkness and intrigue.");

INSERT INTO GAME (name, ruleSet, description) VALUES ("dummy", "Dummy set", 
"this is a dummy game");

INSERT INTO WORLD (name, description, gameId) VALUES ("Earth", "A very nice place, most of the time.", 1);

INSERT INTO CONTINENT (name, description, worldId) VALUES ("Europe", "Also known as civilisation", 1);

INSERT INTO NATION (name, description) VALUES ("Belgium", "It doesn't exist");

INSERT INTO CONTINENTNATION (continentId, nationId) VALUES (1,1);

INSERT INTO CITY (name, description, nationId) VALUES ("Brussels", "The heart of the European Union", 1);

INSERT INTO ORGANISATION (name, description) VALUES ("The Eastern Wolves", "Russian Mafia");

INSERT INTO ORGANISATION (name, description) VALUES ("Independent", "Unaligned");

INSERT INTO CITYORGANISATION (cityId, organisationId) VALUES (1,1);

INSERT INTO CITYORGANISATION (cityId, organisationId) VALUES (1,2);

INSERT INTO ACTOR (name, description) VALUES ("Francois Ferdinand", "Wants to come across as a sophisticated frenchman. An Instagram model with sunglasses that are always on. Wears a leather jacket. Facial features that everyone wants to have.");

INSERT INTO ACTOR (name, description) VALUES ("Pietr Matvei Savelievich ‘The Mad Russian’", "Leader of the Russian Mafia in northern Brussels. He’s known for his outrageously violent methods and being viciously paranoid of his allies. He got his name by butchering one of his allies, Justin Demets, after he’d double-crossed him. Then, he put his remains in a box and shipped him to his allies via national mail (‘Soy Italian’ was one of them). 
The Mad Russian’s mafia, known as ‘Eastern Wolves,’ has been on the scene since the early 80s and was originally founded by the Mad Russian’s father, Bykov Adam Savelievich. ");

INSERT INTO POWER (name, description, powerLevel) Values ("Independent MotherF'er", "He does what he wants", 10);

INSERT INTO POWER (name, description, powerLevel) Values ("Mafiaso", "He leads the Eastern Wolves", 100);

INSERT INTO POWERPYRAMID (organisationId, actorId, powerId) VALUES (2, 1, 1);


INSERT INTO POWERPYRAMID (organisationId, actorId, powerId) VALUES (1, 2, 2);

insert into advantageVM(name, description, point) VALUES ("Addiction (FLAW)", "Lose one dice from all pools 
when the last person you fed from was not on your 
drug, except pools for actions that will immediately 
obtain your drug.", 1);

INSERT INTO EXPVM(name, total, spent) VALUES ("Neonate", 15, 0);

INSERT INTO COUNTERVM(hun, hum, bloPo, hp, wp) VALUES (1, 7, 2, 6, 5);

INSERT INTO CLANVM (name, description, bane) VALUES ("Brujah", "The dream of the learned clan is a world 
	where all injustice has been eliminated 
	and the living and the undead can coexist 
	in peace. They say it is for love of the mortals that they lead them against their masters. In truth, 
	they may simply rage against a distant or non-existent 
	God they can never fight, against a curse they can 
	never end. Theirs is a dream that poisons everything 
	it touches. As they infiltrate or instigate revolutions, 
	their hunger and passion ensure that blood will flow, 
	innocents die, and peace never be attained.", "The Blood of the Brujah simmers 
	with barely contained rage, exploding at the slightest provocation. 
	Subtract dice equal to the Bane Severity of the Brujah from any roll 
	to resist fury frenzy. This cannot 
	take the pool below one die.");
INSERT INTO PREDVM(name, description, features) VALUES ("Alleycat", "A combative assault-feeder, you 
	stalk, overpower, and drink from 
	whomever you can, when you 
	can. You may or may not attempt 
	to threaten or Dominate victims 
	into silence or mask the feeding as 
	a robbery. Think about how you COREBOOK CHARACTERS
	176
	arrived at this direct approach to 
	feeding and what makes you com
	-
	fortable with an unlife of stalking, 
	attacking, feeding, and escaping. 
	You could have been homeless, an 
	SAS soldier, a cartel hit-man, or a 
	big-game hunter", "Add a specialty: Intimidation 
	(Stickups) or Brawl (Grappling), gain one dot of Celerity or 
	Potence, lose one dot of Humanity, gain three dots of criminal 
	Contacts");
insert into GENVM ( generationNum, name, description) VALUES (16, "Thin-bloods", "Many Kindred scholars look with 
	fear on the flood of these generations, so far from Caine that both 
	curse and gifts weaken into nothingness. The Book of Nod speaks of the 
	“Time of Thin Blood” as precursor to 
	Gehenna, the rising of the Antediluvians, and the end of vampire-kind.");

insert into GENVM ( generationNum, name, description) VALUES (15, "Thin-bloods", "Many Kindred scholars look with 
	fear on the flood of these generations, so far from Caine that both 
	curse and gifts weaken into nothingness. The Book of Nod speaks of the 
	“Time of Thin Blood” as precursor to 
	Gehenna, the rising of the Antediluvians, and the end of vampire-kind.");

insert into GENVM (generationNum, name, description) VALUES (14, "Thin-bloods", "Many Kindred scholars look with 
	fear on the flood of these generations, so far from Caine that both 
	curse and gifts weaken into nothingness. The Book of Nod speaks of the 
	“Time of Thin Blood” as precursor to 
	Gehenna, the rising of the Antediluvians, and the end of vampire-kind.");

insert into GENVM (generationNum, name, description) VALUES (13, "Neonate", "Even more than the generations 
	just below them, the 12th and 13th 
	Generations dwindled slowly for 
	centuries before exploding in modern nights. Most members of these 
	generations have relatively little experience of the curse of vampirism, 
	but slightly more understanding 
	of technological and social change. 
	Stodgy Camarilla elders blame 
	the renewed Anarch Revolt on the 
	influx of these generation.");

INSERT INTO RESOVM (name, description) VALUES ("Choleric", "Angry, violent, bullying, 
	passionate, envious.");

INSERT INTO DISCIPLINEGROUPVM(name, description, masqueradeThreat, resonance) VALUES ("Animalism", "You speak with animals.", "low-medium", "animal blood");

INSERT INTO DISCIPLINEVM(name, description, dicePools, cost, mechanics, disciplineGroupVMId) VALUES ("Bond Fanumulus", "When Blood Bonding an animal, 
	the vampire can make it a famulus, 
	forming a mental link with it and 
	facilitating the use of other Animalism powers. While this power 
	alone does not allow two-way communication with the animal, it can 
	follow simple verbal instructions 
	such as 'stay' and 'come here.' It 
	attacks in defense of itself and its 
	master but cannot otherwise be 
	persuaded to fight something it 
	would not normally attack.", 
	"Charisma + Animal Ken", 
	"Without the use of 
	Feral Whispers, below, giving commands to the animal 
	requires a Charisma + Animal 
	Ken roll (Difficulty 2); increase 
	Difficulty for more complex orders. A vampire can only have 
	one famulus, but can get a new 
	one if the current one dies. A 
	vampire can use Feral Whispers 
	(Animalism 2) and Subsume 
	the Spirit (Animalism 4) on 
	their famulus for free.", 
	"Only death releases a 
	famulus once bound. As long as 
	it receives vampire Blood on a 
	regular basis, the famulus does 
	not age.", 1 );

INSERT INTO ATTRIBUTEVM (name) VALUES ("Strength"), ("Dexterity"), ("Stamina"), ("Charisma"), ("Manipulation"), ("Composure"), ("Intelligence"), ("Wits"), ("Resolve");

INSERT INTO SKILLVM (name) VALUES ("Athletics"), ("Brawl"), ("Craft"), ("Drive"), ("Firearms"), ("Larceny"), ("Melee"), ("Stealth"), ("Survival"), ("Animal Ken"), ("Etiquette"), ("Insight"), ("Intimidation"), ("Leadership"), ("Performance"), ("Persuasion"), ("Streetwise"), ("Subterfuge"), ("Academics"), ("Awareness"), ("Finance"), ("Investigation"), ("Medicine"), ("Occult");
INSERT INTO SKILLVM (name) VALUES ("Politics"), ("Science"), ("Technology");

INSERT INTO CHARINFOVM (name, conc, predVMId, ambi, clanVMId, sire, des, generationNum) VALUES ("Desmond", "badass", 1, "Become the best", 1, "Yo mama", "Be freeh", 13);

INSERT INTO STATBLOCKVM(charInfoVMId, counterVMId, expVMId) VALUES (1, 1, 1);

INSERT INTO STATBLOCKVMSKILL(statBlockVMId, skillVMId, dots) VALUES (1,1,5), (1,2,4), (1,5,2), (1,4,2), (1,7,5), (1,12,2), (1,9,5), (1,8,5), (1,12,4), (1,18,4), (1,17,4);

insert INTO STATBLOCKVMATTRIBUTE(statBlockVMId, attributeVMId, dots) VALUES (1,1, 4), (1, 2, 3), (1, 3, 3), (1,4,2), (1,5,2), (1,6,3), (1,7,1), (1,8,2), (1,9,2);

INSERT INTO STATBlOCKVMDISCIPLINE(statBlockVMId, disciplineVMId, disciplineGroupVMId) VALUES (1,1,1);

INSERT INTO ACTOR(name, description) VALUES ("Desmond Keiner", "A fine looking man");

INSERT INTO STATS(actorId, statBlockVMId) VALUES (3, 1);

INSERT INTO POWERPYRAMID(organisationId, actorId, powerId, superior) VALUES (1,3,1,1);

