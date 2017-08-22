SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `prefix` varchar(30),
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `suffix` varchar(30),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `properties`
-- ----------------------------
DROP TABLE IF EXISTS `properties`;
CREATE TABLE `properties` (
  `id` varchar(36) NOT NULL,
  `number` int(16) NOT NULL,
  `name` varchar(64) NOT NULL,
  `number_of_beds` tinyint(2) NOT NULL,
  `location` varchar(64) NOT NULL,
  `allow_smoking` tinyint(1) NOT NULL,
  `allow_pets` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
