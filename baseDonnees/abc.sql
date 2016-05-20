drop table if exists lot;
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