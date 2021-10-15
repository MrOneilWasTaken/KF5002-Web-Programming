DROP TABLE IF EXISTS `copy_student`;
CREATE TABLE IF NOT EXISTS `copy_student` (
  `studentid` varchar(8) NOT NULL DEFAULT '',
  `forename` varchar(60) DEFAULT NULL,
  `surname` varchar(40) DEFAULT NULL,
  `coursecode` varchar(14) NOT NULL DEFAULT '',
  `stage` smallint(6) NOT NULL DEFAULT '0',
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`studentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;