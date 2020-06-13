CREATE TABLE users(
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name varchar(256) NOT NULL,
	uname varchar(256) NOT NULL UNIQUE,
	phnno varchar(10) NOT NULL UNIQUE,
	pwd varchar(256) NOT NULL
);