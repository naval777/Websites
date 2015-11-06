DROP TABLE IF EXISTS messages;
CREATE TABLE  messages (
  id int(11) NOT NULL AUTO_INCREMENT,
  sentById          INT(6) NOT NULL,
  sentToId          INT(6) NOT NULL,
  sentByUserId      INT(6) NOT NULL, 
  message           varchar(100) NOT NULL,
  icon_link         varchar(250) NOT NULL,
  date_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ip_address varchar(40) NOT NULL,
  PRIMARY KEY (id)
) 