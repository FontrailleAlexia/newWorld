DROP TABLE if exists surType;
DROP TABLE if exists type;
DROP TABLE if exists produit;

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

DELETE FROM surType;
insert into surType
values
	(1,'légumes'),
	(2,'fruits'),
	(3,'viandes'),
	(4,'poissons'),
	(5,'lait'),
	(6,'crémerie'),
	(7,'fromages');

DELETE FROM type;
insert into type
values
	(1,'salade',1),
	(2,'pomme',2),
	(3,'boeuf',3),
	(4,'saumon',4),
	(5,'poisson pané',4),
	(6,'Crème',6),
	(7,'beurre',6),
	(8,'oeuf',6),
	(9,'Porc',3),
	(10,'Veau',3),
	(11,'Agneau',3),
	(12,'Fromage de vache',7),
	(13,'Fromage de brebis',7);

DELETE FROM produit;
insert into produit
values
	(1,'frisée',1,'2.50',5),
	(2,'golden',2,'2.50',6),
	(3,'reinette',2,'2.50',7),
	(4,'beurre moulé',6,'2.50',8),
	(5,'beurre plaqué demi sel',6,'2.50',9),
	(6,'oeuf frais de poule',6,'2.50',10),
	(7,'oeuf frais très gros',6,'2.50',9),
	(8,'bavette',3,'2.50',8),
	(9,'faux filet',3,'2.50',7),
	(10,'gigot d\'agneau',11,'2.50',6),
	(11,'cote d\'agneau',11,'2.50',5),
	(12,'emmental',12,'2.50',4),
	(13,'mozzarella',12,'2.50',5),
	(14,'roquefort',13,'2.50',6),
	(15,'pavé de saumon',4,'2.50',7);

ALTER TABLE lot
	add foreign key (noProduit) references produit(num);

ALTER TABLE produit
	add foreign key (noType) references type(no);

ALTER TABLE type
	add foreign key (noSurType) references surType(no);