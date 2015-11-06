DROP TABLE IF EXISTS users;
CREATE TABLE users
(
  id                smallint unsigned NOT NULL auto_increment,
  name              VARCHAR(50) NOT NULL,
  birthday          VARCHAR(50) NOT NULL,
  gender            VARCHAR(6) NOT NULL,
  college           VARCHAR(50) NOT NULL,  
  password          VARCHAR(60) NOT NULL,
  phone             VARCHAR(20) NOT NULL UNIQUE, 
  email             VARCHAR(50) NOT NULL UNIQUE,
  icon_link         VARCHAR(250) NOT NULL,
  aboutMe           TEXT NOT NULL,
  
  
 
  PRIMARY KEY     (id)
);
 