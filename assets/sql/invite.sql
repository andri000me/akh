DROP TABLE IF EXISTS `invite`;
CREATE TABLE `tf_team_invite` (
  `tf_tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to_email` varchar(255) DEFAULT NULL,
  `from_member` varchar(255) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `accepted` varchar(255) DEFAULT NULL,
  `status` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`tf_tid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;