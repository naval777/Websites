DROP TABLE IF EXISTS groups;
CREATE TABLE groups
(
  id                smallint unsigned NOT NULL auto_increment,
  name              VARCHAR(50) NOT NULL,
  caption           VARCHAR(50) NOT NULL,
  adminId           INT(10) NOT NULL,
  per2Id            INT(10) NOT NULL,  
  per3Id            INT(10) NOT NULL,
  icon_link         VARCHAR(20) NOT NULL, 
  status            VARCHAR(50) NOT NULL,
  
  
 
  PRIMARY KEY     (id)
);