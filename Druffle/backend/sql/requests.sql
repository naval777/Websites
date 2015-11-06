DROP TABLE IF EXISTS requests;
CREATE TABLE requests
(
  id                smallint unsigned NOT NULL auto_increment,
  type              VARCHAR(50) NOT NULL,
  sentById          INT(6) NOT NULL,
  sentToId          INT(6) NOT NULL,
  status           VARCHAR(50) NOT NULL,  
 
  
  
 
  PRIMARY KEY     (id)
);
 