DROP TABLE IF EXISTS images;
CREATE TABLE images
(
  id            smallint unsigned NOT NULL auto_increment,
  type           VARCHAR(20) NOT NULL,
  typeId         INT(10) NOT NULL, 
  imageName      VARCHAR(100) NOT NULL,
  imageType      text NOT NULL,
  imageLocation  text NOT NULL,

  PRIMARY KEY     (id)
);
 