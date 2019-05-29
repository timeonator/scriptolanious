create database quest;
use quest;
grant all privileges on quest.* to 'smarty'@'localhost' identified by 'epiq20day'

CREATE TABLE users (
  user_id INT(11) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255),
  last_name VARCHAR(255),
  email VARCHAR(255),
  username VARCHAR(255),
  user_role varchar(255),
  last_login datetime,
  hashed_password VARCHAR(255),
  PRIMARY KEY (user_id)
);

ALTER TABLE users ADD INDEX index_username (username);
