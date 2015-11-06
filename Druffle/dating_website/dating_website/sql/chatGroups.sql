DROP TABLE IF EXISTS chatGroups;
CREATE TABLE chatGroups
(
  id                smallint unsigned NOT NULL auto_increment,
  group1Id          INT(10) NOT NULL,
  group2Id          INT(10) NOT NULL,  
  status            VARCHAR(50) NOT NULL,
  
  
 
  PRIMARY KEY     (id)
);