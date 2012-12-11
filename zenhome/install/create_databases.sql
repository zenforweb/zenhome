/*
 *
 *	Core Database Install
 *		-Alix F
 */
/* USER SECURE */
CREATE TABLE `user_secure` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1a


/* USER INFORMATION */
CREATE TABLE `user_information` (
  `user_id` mediumint(8) unsigned NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `user_icon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1

/* USER APPS SETTINGS */
CREATE TABLE `user_apps_settings` (
  `setting_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(30) NOT NULL,
  `setting_value` varchar(255) NOT NULL,
  `user_id` smallint(5) unsigned NOT NULL,
  `app_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

/* USER ACCESS*/
CREATE TABLE `user_access` (
  `row_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `login_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `ix_unique_user` (`user_id`,`login_ts`),
  KEY `ix_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

/* ACL SYSTEM */
CREATE TABLE `acl_app` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `restore` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

 CREATE TABLE `acl_permissions` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `permKey` varchar(30) NOT NULL,
  `permName` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `permKey` (`permKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `acl_role_perms` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `roleID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `roleID_2` (`roleID`,`permID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `acl_roles` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleName` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `roleName` (`roleName`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1

 CREATE TABLE `acl_user_perms` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userID` bigint(20) NOT NULL,
  `permID` bigint(20) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `addDate` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `userID` (`userID`,`permID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `acl_user_roles` (
  `userID` bigint(20) NOT NULL,
  `roleID` bigint(20) NOT NULL,
  `addDate` datetime NOT NULL,
  UNIQUE KEY `userID` (`userID`,`roleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 


/* APPS INFO */
CREATE TABLE `apps_info` (
  `row_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pretty_name` varchar(75) DEFAULT NULL,
  `slug_name` varchar(25) DEFAULT NULL,
  `enabled` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1