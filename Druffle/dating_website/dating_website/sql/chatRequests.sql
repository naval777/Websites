DROP TABLE IF EXISTS chatRequests;
CREATE TABLE chatRequests
(
  id                smallint unsigned NOT NULL auto_increment,
  type              VARCHAR(50) NOT NULL,
  sentById          INT(6) NOT NULL,
  sentToGroupId     INT(6) NOT NULL,
  sentToUserId      INT(6) NOT NULL,
  status            VARCHAR(50) NOT NULL,  
 
  
  
 
  PRIMARY KEY     (id)
);
 