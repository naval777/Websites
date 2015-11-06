DROP TABLE IF EXISTS shops;
CREATE TABLE shops
(
  id                smallint unsigned NOT NULL auto_increment,
  name              VARCHAR(50) NOT NULL,
  address           VARCHAR(250) NOT NULL,
  
  
 
  PRIMARY KEY     (id)
);