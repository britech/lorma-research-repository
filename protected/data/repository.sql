-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for research_repository
DROP DATABASE IF EXISTS `research_repository`;
CREATE DATABASE IF NOT EXISTS `research_repository` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `research_repository`;


-- Dumping structure for table research_repository.tbl_dept
DROP TABLE IF EXISTS `tbl_dept`;
CREATE TABLE IF NOT EXISTS `tbl_dept` (
  `key_dept` int(10) NOT NULL AUTO_INCREMENT,
  `fld_code` varchar(10) NOT NULL,
  `fld_name` tinytext NOT NULL,
  PRIMARY KEY (`key_dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_folder_group
DROP TABLE IF EXISTS `tbl_folder_group`;
CREATE TABLE IF NOT EXISTS `tbl_folder_group` (
  `key_folder_group` int(10) NOT NULL AUTO_INCREMENT,
  `fld_group_name` tinytext NOT NULL,
  `fld_description` text,
  `fld_order` int(11) NOT NULL,
  PRIMARY KEY (`key_folder_group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_library
DROP TABLE IF EXISTS `tbl_library`;
CREATE TABLE IF NOT EXISTS `tbl_library` (
  `key_library` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key_pub` int(10) NOT NULL,
  `key_user` int(10) NOT NULL,
  PRIMARY KEY (`key_library`),
  KEY `FK_tbl_library_tbl_pub` (`key_pub`),
  KEY `FK_tbl_library_tbl_user` (`key_user`),
  CONSTRAINT `FK_tbl_library_tbl_pub` FOREIGN KEY (`key_pub`) REFERENCES `tbl_pub` (`key_pub`) ON DELETE CASCADE,
  CONSTRAINT `FK_tbl_library_tbl_user` FOREIGN KEY (`key_user`) REFERENCES `tbl_user` (`key_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_pub
DROP TABLE IF EXISTS `tbl_pub`;
CREATE TABLE IF NOT EXISTS `tbl_pub` (
  `key_pub` int(10) NOT NULL AUTO_INCREMENT,
  `fld_pub_title` tinytext NOT NULL,
  `fld_txt_page` int(10) NOT NULL,
  `fld_no_page` int(10) NOT NULL,
  `fld_location` tinytext,
  `key_dept` int(10) NOT NULL,
  `fld_date_stored` date NOT NULL,
  `fld_format_type` varchar(50) DEFAULT NULL,
  `fld_is_visible` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`key_pub`),
  KEY `FK_tbl_pub_tbl_dept` (`key_dept`),
  CONSTRAINT `FK_tbl_pub_tbl_dept` FOREIGN KEY (`key_dept`) REFERENCES `tbl_dept` (`key_dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_pub_author
DROP TABLE IF EXISTS `tbl_pub_author`;
CREATE TABLE IF NOT EXISTS `tbl_pub_author` (
  `key_author` int(10) NOT NULL AUTO_INCREMENT,
  `fld_lname` varchar(50) NOT NULL,
  `fld_fname` varchar(50) NOT NULL,
  `fld_mname` varchar(50) NOT NULL,
  `key_dept` int(10) NOT NULL,
  `key_pub` int(10) NOT NULL,
  `fld_designation` tinytext,
  PRIMARY KEY (`key_author`),
  KEY `FK_tbl_pub_author_tbl_dept` (`key_dept`),
  KEY `FK_tbl_pub_author_tbl_pub` (`key_pub`),
  CONSTRAINT `FK_tbl_pub_author_tbl_dept` FOREIGN KEY (`key_dept`) REFERENCES `tbl_dept` (`key_dept`),
  CONSTRAINT `FK_tbl_pub_author_tbl_pub` FOREIGN KEY (`key_pub`) REFERENCES `tbl_pub` (`key_pub`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_pub_file
DROP TABLE IF EXISTS `tbl_pub_file`;
CREATE TABLE IF NOT EXISTS `tbl_pub_file` (
  `key_pub_file` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fld_file_title` tinytext NOT NULL,
  `key_folder_group` int(10) NOT NULL,
  `fld_file_position` tinyint(4) NOT NULL,
  `key_pub` int(10) NOT NULL,
  `fld_dload_restriction` varchar(5) NOT NULL,
  `fld_filename` tinytext NOT NULL,
  PRIMARY KEY (`key_pub_file`),
  KEY `FK_tbl_pub_files_tbl_pub` (`key_pub`),
  KEY `FK_tbl_pub_files_tbl_folder_group` (`key_folder_group`),
  CONSTRAINT `FK_tbl_pub_files_tbl_folder_group` FOREIGN KEY (`key_folder_group`) REFERENCES `tbl_folder_group` (`key_folder_group`),
  CONSTRAINT `FK_tbl_pub_files_tbl_pub` FOREIGN KEY (`key_pub`) REFERENCES `tbl_pub` (`key_pub`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_pub_folder
DROP TABLE IF EXISTS `tbl_pub_folder`;
CREATE TABLE IF NOT EXISTS `tbl_pub_folder` (
  `key_pub_folder` int(11) NOT NULL AUTO_INCREMENT,
  `key_pub` int(11) NOT NULL,
  `key_folder_group` int(11) NOT NULL,
  PRIMARY KEY (`key_pub_folder`),
  KEY `FK_tbl_pub_folder_tbl_pub` (`key_pub`),
  KEY `FK_tbl_pub_folder_tbl_folder_group` (`key_folder_group`),
  CONSTRAINT `FK_tbl_pub_folder_tbl_folder_group` FOREIGN KEY (`key_folder_group`) REFERENCES `tbl_folder_group` (`key_folder_group`),
  CONSTRAINT `FK_tbl_pub_folder_tbl_pub` FOREIGN KEY (`key_pub`) REFERENCES `tbl_pub` (`key_pub`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_pub_keyword
DROP TABLE IF EXISTS `tbl_pub_keyword`;
CREATE TABLE IF NOT EXISTS `tbl_pub_keyword` (
  `key_pub_keyword` int(10) NOT NULL AUTO_INCREMENT,
  `fld_keyword` varchar(150) NOT NULL,
  `key_pub` int(10) NOT NULL,
  PRIMARY KEY (`key_pub_keyword`),
  KEY `FK_tbl_pub_topic_tbl_pub` (`key_pub`),
  CONSTRAINT `FK_tbl_pub_topic_tbl_pub` FOREIGN KEY (`key_pub`) REFERENCES `tbl_pub` (`key_pub`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_pub_note
DROP TABLE IF EXISTS `tbl_pub_note`;
CREATE TABLE IF NOT EXISTS `tbl_pub_note` (
  `key_pub_note` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_user` int(10) NOT NULL,
  `key_pub` int(10) NOT NULL,
  `fld_note_type` varchar(5) NOT NULL,
  `fld_note_txt` tinytext,
  `fld_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_pub_note`),
  KEY `FK_tbl_pub_note_tbl_user` (`key_user`),
  KEY `FK_tbl_pub_note_tbl_pub` (`key_pub`),
  CONSTRAINT `FK_tbl_pub_note_tbl_pub` FOREIGN KEY (`key_pub`) REFERENCES `tbl_pub` (`key_pub`) ON DELETE CASCADE,
  CONSTRAINT `FK_tbl_pub_note_tbl_user` FOREIGN KEY (`key_user`) REFERENCES `tbl_user` (`key_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table research_repository.tbl_user
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `key_user` int(10) NOT NULL AUTO_INCREMENT,
  `fld_name` tinytext NOT NULL,
  `fld_username` varchar(50) NOT NULL,
  `fld_password` varchar(50) NOT NULL,
  `fld_email_address` tinytext NOT NULL,
  `fld_restrictions` varchar(50) DEFAULT NULL,
  `fld_user_stat` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`key_user`),
  UNIQUE KEY `fld_username` (`fld_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
