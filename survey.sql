grant all privileges on heroku_3245f05205413bf.* to 'b0b865ef0d38b8'@'us-cdbr-iron-east-05.cleardb.net' identified by '9f60b0e1';

use heroku_3245f05205413bf;

CREATE TABLE `participants` (
  `part_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_fullname` varchar(128) NOT NULL,
  `part_age` int(11) NOT NULL,
  `part_student` char(1) NOT NULL,
  PRIMARY KEY (`part_id`)
);


CREATE TABLE `responses` (
  `resp_id` int(11) NOT NULL AUTO_INCREMENT,
  `resp_part_id` int(11) NOT NULL,
  `resp_product` varchar(100) NOT NULL,
  `resp_how_purchased` varchar(50) NOT NULL,
  `resp_satisfied` int(11) NOT NULL,
  `resp_recommend` varchar(10) NOT NULL,
  PRIMARY KEY (`resp_id`)
)