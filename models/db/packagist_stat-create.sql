CREATE TABLE `packagist_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) DEFAULT NULL,
  `download` int(11) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
SELECT * FROM `heroku-app`.packagist_stat;
