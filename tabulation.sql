-- MySQL dump 10.13  Distrib 5.7.20, for Win64 (x86_64)
--
-- Host: localhost    Database: tabulation
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `actid` int(11) NOT NULL AUTO_INCREMENT,
  `actname` varchar(45) NOT NULL,
  `actstartdate` varchar(15) NOT NULL,
  `actenddate` varchar(15) NOT NULL,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`actid`),
  KEY `FK_activities_1` (`userid`),
  CONSTRAINT `FK_activities_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'foundation 2018','03/22/2018','03/25/2018',1);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contestants`
--

DROP TABLE IF EXISTS `contestants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contestants` (
  `contestantid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `contestanttype` varchar(30) DEFAULT NULL,
  `eventid` int(10) unsigned NOT NULL DEFAULT '0',
  `departmentid` int(10) unsigned NOT NULL DEFAULT '0',
  `gender` enum('Male','Female') NOT NULL,
  PRIMARY KEY (`contestantid`),
  KEY `FK_contestants_1` (`eventid`),
  KEY `FK_contestants_2` (`departmentid`),
  CONSTRAINT `FK_contestants_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_contestants_2` FOREIGN KEY (`departmentid`) REFERENCES `departments` (`departmentid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contestants`
--

LOCK TABLES `contestants` WRITE;
/*!40000 ALTER TABLE `contestants` DISABLE KEYS */;
INSERT INTO `contestants` VALUES (9,'dfdsfs','qualified',1,1,'Male');
/*!40000 ALTER TABLE `contestants` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger qualified before insert on contestants
for each row
begin
set new.contestanttype = "qualified";
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criteria` (
  `criteriaid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `criterianame` varchar(50) NOT NULL DEFAULT '',
  `percentage` double NOT NULL DEFAULT '0',
  `eventid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`criteriaid`),
  KEY `FK_criteria_1` (`eventid`),
  CONSTRAINT `FK_criteria_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criteria`
--

LOCK TABLES `criteria` WRITE;
/*!40000 ALTER TABLE `criteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `criteria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `departmentid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departmentname` varchar(100) NOT NULL DEFAULT '',
  `departmentdesc` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`departmentid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'BSIT','Bachelor of Science in Information Technology'),(2,'BSHRM','Bachelor of Science in Hotel and Restaurant Management');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `eventid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventname` varchar(45) NOT NULL DEFAULT '',
  `eventdescription` varchar(100) NOT NULL DEFAULT '',
  `eventdate` varchar(45) NOT NULL DEFAULT '',
  `actid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Mr and Ms NEUST','pageant','03/23/2018',1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scores` (
  `scoreid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `criteriaid` int(10) unsigned NOT NULL DEFAULT '0',
  `score` double NOT NULL DEFAULT '0',
  `contestantid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`scoreid`),
  KEY `FK_scores_1` (`eventid`),
  KEY `FK_scores_2` (`userid`),
  KEY `FK_scores_3` (`criteriaid`),
  KEY `FK_scores_4` (`contestantid`),
  CONSTRAINT `FK_scores_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_scores_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_scores_3` FOREIGN KEY (`criteriaid`) REFERENCES `criteria` (`criteriaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_scores_4` FOREIGN KEY (`contestantid`) REFERENCES `contestants` (`contestantid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scores`
--

LOCK TABLES `scores` WRITE;
/*!40000 ALTER TABLE `scores` DISABLE KEYS */;
/*!40000 ALTER TABLE `scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useraccounts`
--

DROP TABLE IF EXISTS `useraccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useraccounts` (
  `accid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acctype` varchar(15) NOT NULL DEFAULT '',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`accid`),
  KEY `FK_useraccounts_1` (`userid`),
  CONSTRAINT `FK_useraccounts_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useraccounts`
--

LOCK TABLES `useraccounts` WRITE;
/*!40000 ALTER TABLE `useraccounts` DISABLE KEYS */;
INSERT INTO `useraccounts` VALUES (1,'admin',1);
/*!40000 ALTER TABLE `useraccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userfirstname` varchar(45) NOT NULL DEFAULT '',
  `usermiddlename` varchar(45) NOT NULL DEFAULT '',
  `userlastname` varchar(45) NOT NULL DEFAULT '',
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `userquestion` varchar(75) DEFAULT NULL,
  `useranswer` varchar(75) DEFAULT NULL,
  `eventid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_users_1` (`eventid`),
  CONSTRAINT `FK_users_1` FOREIGN KEY (`eventid`) REFERENCES `events` (`eventid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'joecon','cruz','luciano','joecon','caf1a3dfb505ffed0d024130f58c5cfa','Male','What is Your Favorite Color?','apple',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = cp850 */ ;
/*!50003 SET character_set_results = cp850 */ ;
/*!50003 SET collation_connection  = cp850_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger log_trig after insert on users
for each row
begin
insert into useraccounts (acctype, userid) values ("judge", new.userid);
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-21  5:05:56
