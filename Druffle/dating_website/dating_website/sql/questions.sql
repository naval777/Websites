DROP TABLE IF EXISTS questions;
CREATE TABLE questions
(
  id                smallint unsigned NOT NULL auto_increment,
  userId            int(10) NOT NULL,
  question          VARCHAR(50) NOT NULL,
  answer            VARCHAR(250) NOT NULL,
  
  
 
  PRIMARY KEY     (id)
);