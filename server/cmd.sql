CREATE TABLE users(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(256) NOT NULL,
	uname varchar(256) NOT NULL UNIQUE,
	phnno varchar(10) NOT NULL UNIQUE,
	pwd varchar(256) NOT NULL
);

CREATE TABLE admins(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(256) NOT NULL,
	uname varchar(256) NOT NULL UNIQUE,
	phnno varchar(10) NOT NULL UNIQUE,
	pwd varchar(256) NOT NULL
);

CREATE TABLE players(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(256) NOT NULL,
	age int(3) NOT NULL,
	team varchar(30) NOT NULL,
	batting_style varchar(30) NOT NULL,
	bowling_style varchar(30) NOT NULL,
	pool varchar(30) NOT NULL,
	cost int(11) NOT NULL
);