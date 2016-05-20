DROP TABLE if exists modeProd;
CREATE TABLE modeProd(
	id smallint,
	mode varchar(10),
	PRIMARY KEY(id)
	)engine=innodb charset=utf8;

DELETE FROM modeProd;
insert into modeProd
values
	(1,"bio"),
	(2,"naturel");