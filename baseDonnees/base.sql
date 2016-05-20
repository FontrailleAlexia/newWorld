-- Supprimer les tables si elles existent

DROP TABLE if exists proposerA;
DROP TABLE if exists lot;
DROP TABLE if exists pointDeVente;
DROP TABLE if exists choisir;
DROP TABLE if exists question;
DROP TABLE if exists utilisateur;
DROP TABLE if exists produit;
DROP TABLE if exists type;
DROP TABLE if exists surType;
DROP TABLE if exists localites;
DROP TABLE if exists typeUtilisateur;

-- Creation de la table utilisateur
CREATE TABLE utilisateur(
	idUser smallint,
	nomUser varchar(30),
	prenomUser varchar(30),
	dateNaiss date,
	telUser varchar(10),
	emailUser varchar(40),
	rue1User varchar(50),
	rue2User varchar(50),
	CP varchar(5),
	ville varchar(50),
	pseudoUser varchar(25),
	mdpUser varchar(20),
	typeUser tinyint,
	-- 1=acheteur, 2=vendeur, 3=producteur, 4=prod/vendeur
	PRIMARY KEY(idUser)
	)engine=innodb charset=utf8;

-- Création de la table lot
CREATE TABLE lot(
	idLot smallint,
	dateLot date,
	modeProductionLot varchar(15),
	nbJourConservationLot int,
	prixLot float,
	qttMinimaleLot float,
	uniteMesure varchar(20),
	noProduit smallint,
	noUser smallint,
	PRIMARY KEY(idLot)
	)engine=innodb charset=utf8;

-- Création de la table pointDeVente
CREATE TABLE pointDeVente(
	id smallint,
	libelle varchar(20),
	activite varchar(20),
	nom varchar(30),
	prenom varchar(30),
	rue1 varchar(20),
	rue2 varchar(20),
	tel varchar(10),
	email varchar(20),
	localites int,
	PRIMARY KEY(id)
)engine=innodb charset=utf8;

-- Création de la table produit
CREATE TABLE produit(
	num smallint,
	libelleProd varchar(30),
	noType smallint,
	prixProd float,
	qteProd smallint,
	PRIMARY KEY(num)
)engine=innodb charset=utf8;

-- Création de la table type
CREATE TABLE type(
	no smallint,
	libelleType varchar(20),
	noSurType smallint,
	PRIMARY KEY(no)
)engine=innodb charset=utf8;

-- Création de la table surType
CREATE TABLE surType(
	no smallint,
	libelleSurType varchar(20),
	PRIMARY KEY(no)
)engine=innodb charset=utf8;

-- Création de la table localités
CREATE TABLE localites(
	nInsee int,
	CP varchar(5),
	ville varchar(20),
	bureauDistributeur varchar(50),
	PRIMARY KEY(nInsee,CP)
)engine=innodb charset=utf8;

-- Création de la table choisir
CREATE TABLE choisir(
	idQuestion smallint,
	idUser smallint NOT NULL,
	reponse varchar(50),
	PRIMARY KEY(idQuestion)
)engine=innodb charset=utf8;

-- Création de la table question
CREATE TABLE question(
	no smallint NOT NULL,
	questions varchar(100),
	PRIMARY KEY(no)
)engine=innodb charset=utf8;

-- Création de la table proposerA
CREATE TABLE proposerA(
	noLot smallint,
	noPointDeVente smallint,
	PRIMARY KEY(noLot,noPointDeVente)
)engine=innodb charset=utf8;

-- Création de la table typeVendeur
CREATE TABLE typeUtilisateur(
	noType tinyint,
	libelleType varchar(15),
	PRIMARY KEY(noType)
)engine=innodb charset=utf8;

-- Création des clefs étrangères
ALTER TABLE proposerA
	add foreign key(noLot) references lot(idLot),
	add foreign key(noPointDeVente) references pointDeVente(id);

ALTER TABLE utilisateur
	add foreign key(typeUser) references typeUtilisateur(noType);

/*ALTER TABLE utilisateur
	add foreign key(nInsee) references localites(nInsee);

ALTER TABLE pointDeVente
	add foreign key(localites) references localites(nInsee);*/

ALTER TABLE lot
	add foreign key (noUser) references utilisateur(idUser);

ALTER TABLE choisir
	add foreign key(idQuestion) references question(no),
	add foreign key (idUser) references utilisateur(idUser);

ALTER TABLE lot
	add foreign key (noProduit) references produit(num);

ALTER TABLE produit
	add foreign key (noType) references type(no);

ALTER TABLE type
	add foreign key (noSurType) references surType(no);
