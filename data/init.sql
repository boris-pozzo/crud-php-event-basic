CREATE DATABASE test;

use test;

CREATE TABLE event (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(30) NOT NULL,
	surname VARCHAR(30) NOT NULL,
	passwordd PASSWORD(30) NOT NULL
);
