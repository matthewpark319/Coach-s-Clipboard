-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: clipboard
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coach_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ancmt_coach_idx` (`coach_id`),
  KEY `fk_ancmt_team_idx` (`team_id`),
  KEY `fk_ancmt_season_idx` (`season_id`),
  CONSTRAINT `fk_ancmt_coach` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ancmt_season` FOREIGN KEY (`season_id`) REFERENCES `season` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ancmt_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
INSERT INTO `announcement` VALUES (13,4,1,5,'Announcement','2017-06-06 01:38:34','2017-06-06 05:38:34','2017-06-06 05:38:34'),(14,4,1,5,'Announcement','2017-06-06 01:38:42','2017-06-06 05:38:42','2017-06-06 05:38:42'),(15,4,1,5,'New announcement','2017-06-06 01:42:31','2017-06-06 05:42:31','2017-06-06 05:42:31');
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `athlete`
--

DROP TABLE IF EXISTS `athlete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `athlete` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grad_year` year(4) NOT NULL,
  `events` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_athlete_user_idx` (`user_id`),
  KEY `fk_athlete_team_idx` (`team_id`),
  CONSTRAINT `fk_athlete_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_athlete_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `athlete`
--

LOCK TABLES `athlete` WRITE;
/*!40000 ALTER TABLE `athlete` DISABLE KEYS */;
INSERT INTO `athlete` VALUES (1,2017,'Distance','Varsity',13,5,'2017-03-26 01:56:20','2017-03-26 01:56:20'),(2,2018,'Sprints','Varsity',14,5,'2017-03-26 01:58:59','2017-03-26 01:58:59'),(3,2018,'Hurdles','Varsity',15,5,'2017-03-26 02:05:15','2017-03-26 02:05:15'),(4,2018,'Jumps','Varsity',16,5,'2017-03-26 02:11:53','2017-03-26 02:11:53'),(5,2018,'Distance','Varsity',17,5,'2017-03-26 02:13:43','2017-03-26 02:13:43'),(6,2018,'800m','Varsity',18,5,'2017-03-26 02:20:42','2017-03-26 02:20:42'),(7,2018,'Distance events','JV',19,5,'2017-03-26 03:14:30','2017-03-26 03:14:30'),(8,2018,'Distance','JV',20,5,'2017-03-27 06:35:41','2017-03-27 06:35:41'),(9,2018,'Tennis','JV',23,6,'2017-03-27 17:14:08','2017-03-27 17:14:08'),(10,2018,'Sprints','Varsity',24,6,'2017-03-28 05:00:59','2017-03-28 05:00:59'),(11,2018,'Distance','Varsity',25,5,'2017-03-29 02:16:30','2017-03-29 02:16:30'),(12,2018,'Distance','Varsity',26,5,'2017-04-03 04:03:06','2017-04-03 04:03:06'),(13,2018,'Distance','Varsity',27,5,'2017-04-03 04:03:51','2017-04-03 04:03:51'),(14,2018,'Distance','Varsity',28,5,'2017-04-03 04:04:26','2017-04-03 04:04:26'),(15,2018,'Hurdles, sprints','Varsity',29,5,'2017-04-05 07:11:31','2017-04-05 07:11:31'),(16,2018,'Distance','Varsity',30,5,'2017-04-05 07:34:48','2017-04-05 07:34:48'),(17,2018,'Sprints, Long Jump, 4x400','Varsity',31,5,'2017-04-05 22:39:05','2017-06-16 04:49:34'),(18,2018,'Sprints','Varsity',32,5,'2017-04-06 18:50:01','2017-04-06 18:50:01'),(19,2018,'Distance','Varsity',33,5,'2017-04-06 19:26:32','2017-04-06 19:26:32'),(20,2018,'400, 800','Varsity',34,5,'2017-05-18 19:17:09','2017-05-18 19:17:09'),(21,2018,'Jumps, Hurdles','Varsity',35,5,'2017-05-19 02:31:42','2017-05-19 02:31:42'),(22,2018,'800','Varsity',36,5,'2017-05-29 20:51:51','2017-05-29 20:51:51'),(23,2018,'Distance','Varsity',37,5,'2017-05-29 20:53:07','2017-05-29 20:53:07'),(24,2018,'Sprints','Freshman',38,5,'2017-05-30 05:58:19','2017-05-30 05:58:19'),(25,2018,'Distance','Varsity',40,7,'2017-05-31 19:25:19','2017-05-31 19:25:19'),(26,2018,'Distance','Freshman',44,5,'2017-06-01 01:21:58','2017-06-01 01:21:58'),(27,2019,'Distance','Varsity',46,10,'2017-06-01 01:27:53','2017-06-01 01:27:53'),(28,2017,'Distance','Varsity',47,10,'2017-06-01 01:32:49','2017-06-01 01:32:49'),(29,2018,'Distance','Varsity',48,10,'2017-06-01 01:33:47','2017-06-01 01:33:47'),(30,2017,'400, 800','Varsity',49,10,'2017-06-01 01:35:00','2017-06-01 01:35:00'),(31,2019,'Distance','Varsity',50,10,'2017-06-01 01:49:56','2017-06-01 01:49:56'),(32,2019,'Sprints, Long Jump','Varsity',51,10,'2017-06-01 02:11:29','2017-06-01 02:11:29'),(33,2018,'Jumps','JV',52,7,'2017-06-01 17:48:35','2017-06-01 17:48:35'),(34,2018,'Distance','Freshman',60,7,'2017-06-01 18:26:48','2017-06-01 18:26:48'),(35,2018,NULL,NULL,61,7,'2017-06-01 23:17:58','2017-06-01 23:17:58'),(38,2018,'Distance','Freshman',66,5,'2017-06-08 07:32:40','2017-06-08 07:32:40'),(39,2018,'Sprints','JV',67,5,'2017-06-08 19:15:15','2017-06-13 05:16:32'),(40,2018,'Distance','Freshman',68,5,'2017-06-08 19:15:29','2017-06-08 19:15:29'),(41,2018,'Distance','Varsity',69,5,'2017-06-08 19:18:25','2017-06-08 19:18:25'),(42,2018,'Distance','JV',70,5,'2017-06-08 19:18:38','2017-06-08 19:18:38'),(43,2018,'Pole Vault','JV',71,5,'2017-06-08 19:18:54','2017-06-08 19:18:54'),(45,2018,NULL,NULL,73,5,'2017-06-08 20:25:37','2017-06-08 20:25:37'),(46,2018,NULL,NULL,75,5,'2017-06-08 20:29:49','2017-06-08 20:29:49'),(47,2018,'Sprints','JV',81,5,'2017-06-10 01:39:41','2017-06-10 01:39:41'),(48,2018,'Sprints','JV',82,5,'2017-06-10 01:41:07','2017-06-10 01:41:07'),(49,2018,'Sprints','JV',83,5,'2017-06-10 01:41:30','2017-06-10 01:41:30'),(50,2018,'Sprints','JV',84,5,'2017-06-10 08:14:59','2017-06-10 08:14:59'),(51,2018,'Sprints','JV',85,5,'2017-06-10 08:24:43','2017-06-10 08:24:43'),(52,2018,'Sprints','Freshman',86,5,'2017-06-10 08:25:10','2017-06-10 08:25:10'),(53,2018,'Sprints','Freshman',87,5,'2017-06-10 08:28:51','2017-06-10 08:28:51'),(54,2018,'Sprints','Freshman',88,5,'2017-06-10 08:38:36','2017-06-10 08:38:36'),(55,2018,'Sprints','Freshman',89,5,'2017-06-10 08:53:25','2017-06-10 08:53:25'),(56,2018,'Sprints','JV',90,5,'2017-06-10 09:04:15','2017-06-10 09:04:15'),(57,2019,'Jumps','JV',91,5,'2017-06-19 18:10:49','2017-06-19 18:10:49'),(58,2020,'Sprints','Freshman',92,13,'2017-06-20 02:12:41','2017-06-20 02:12:41'),(59,2021,'Jumps','Freshman',93,13,'2017-06-20 02:13:41','2017-06-20 02:13:41'),(60,2021,'Jumps','Freshman',94,13,'2017-06-20 02:15:27','2017-06-20 02:15:27');
/*!40000 ALTER TABLE `athlete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coach`
--

DROP TABLE IF EXISTS `coach`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coach` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `head_coach_of` int(10) unsigned DEFAULT NULL,
  `asst_coach_of` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_coach_user_idx` (`user_id`),
  KEY `fk_hc_team_idx` (`head_coach_of`),
  KEY `fk_ac_team_idx` (`asst_coach_of`),
  CONSTRAINT `fk_ac_team` FOREIGN KEY (`asst_coach_of`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_coach_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hc_team` FOREIGN KEY (`head_coach_of`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coach`
--

LOCK TABLES `coach` WRITE;
/*!40000 ALTER TABLE `coach` DISABLE KEYS */;
INSERT INTO `coach` VALUES (4,'Coach Test',8,5,NULL,'2017-03-25 23:29:40','2017-03-25 23:29:40'),(5,'Coach Test2',11,NULL,5,'2017-03-26 01:38:29','2017-03-26 01:38:29'),(6,'Coach Test3',21,NULL,5,'2017-03-27 06:40:15','2017-03-27 06:40:15'),(7,'Coach Test4',22,6,NULL,'2017-03-27 06:41:24','2017-03-27 06:41:24'),(8,'Coach test',39,7,NULL,'2017-05-31 19:18:15','2017-05-31 19:18:15'),(9,'test',43,9,NULL,'2017-05-31 21:31:17','2017-05-31 21:31:17'),(10,'Coach Mykytok',45,10,NULL,'2017-06-01 01:24:51','2017-06-01 01:24:51'),(11,'Coach Test',59,NULL,7,'2017-06-01 18:23:02','2017-06-01 18:23:02'),(12,'Coach Test',62,NULL,7,'2017-06-01 23:18:37','2017-06-01 23:18:37'),(14,'Coach Test',80,13,NULL,'2017-06-08 22:11:41','2017-06-08 22:11:41');
/*!40000 ALTER TABLE `coach` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `type` int(11) NOT NULL,
  `open` int(11) NOT NULL,
  `event_first_leg` int(10) unsigned DEFAULT NULL,
  `event_second_leg` int(10) unsigned DEFAULT NULL,
  `event_third_leg` int(10) unsigned DEFAULT NULL,
  `event_fourth_leg` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event_first_leg_idx` (`event_first_leg`),
  KEY `fk_event_second_leg_idx` (`event_second_leg`),
  KEY `fk_event_third_leg_idx` (`event_third_leg`),
  KEY `fk_event_fourth_leg_idx` (`event_fourth_leg`),
  CONSTRAINT `fk_event_first_leg` FOREIGN KEY (`event_first_leg`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_fourth_leg` FOREIGN KEY (`event_fourth_leg`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_second_leg` FOREIGN KEY (`event_second_leg`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_third_leg` FOREIGN KEY (`event_third_leg`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'100',0,1,NULL,NULL,NULL,NULL,NULL,NULL),(2,'200',0,1,NULL,NULL,NULL,NULL,NULL,NULL),(3,'400',0,1,NULL,NULL,NULL,NULL,NULL,NULL),(4,'800',1,1,NULL,NULL,NULL,NULL,NULL,NULL),(5,'1600',1,1,NULL,NULL,NULL,NULL,NULL,NULL),(6,'3200',1,1,NULL,NULL,NULL,NULL,NULL,NULL),(7,'400 Hurdles',0,1,NULL,NULL,NULL,NULL,NULL,NULL),(8,'High Hurdles',0,1,NULL,NULL,NULL,NULL,NULL,NULL),(10,'Shotput',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(11,'Discus',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(12,'Javelin',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(13,'Long Jump',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(14,'High Jump',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(15,'Triple Jump',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(16,'Pole Vault',2,1,NULL,NULL,NULL,NULL,NULL,NULL),(17,'4x100',3,0,1,1,1,1,NULL,NULL),(18,'4x200',3,0,2,2,2,2,NULL,NULL),(19,'4x400',3,0,3,3,3,3,NULL,NULL),(20,'4x800',3,0,4,4,4,4,NULL,NULL),(21,'4x1600',3,0,5,5,5,5,NULL,NULL),(22,'Distance Medley',3,0,24,3,4,5,NULL,NULL),(23,'Sprint Medley',3,0,3,2,2,4,NULL,NULL),(24,'1200',1,0,NULL,NULL,NULL,NULL,NULL,NULL),(25,'Short Sprint Medley',3,0,2,1,1,3,NULL,NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_03_24_135501_create_team_table',2),(4,'2017_03_24_235715_create_sessions_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('matpark@bergen.org','$2y$10$NtGctvADeqoRDRQBr4dM0OMiWdUnMwZtN137D.4bRU7YadlWmcQua','2017-05-30 02:43:42');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performance`
--

DROP TABLE IF EXISTS `performance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `performance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `result` varchar(45) NOT NULL,
  `place` int(11) unsigned DEFAULT NULL,
  `athlete_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `meet_id` int(10) unsigned NOT NULL,
  `relay_leg` varchar(45) DEFAULT NULL,
  `has_splits` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_performance_athlete_idx` (`athlete_id`),
  KEY `fk_performance_team_idx` (`team_id`),
  KEY `fk_performance_sched_idx` (`meet_id`),
  KEY `fk_performance_event_idx` (`event_id`),
  CONSTRAINT `fk_performance_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athlete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_sched` FOREIGN KEY (`meet_id`) REFERENCES `schedule_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performance`
--

LOCK TABLES `performance` WRITE;
/*!40000 ALTER TABLE `performance` DISABLE KEYS */;
INSERT INTO `performance` VALUES (36,5,'4:45',2,1,5,2,NULL,0,'2017-04-05 20:49:36','2017-04-05 20:49:36'),(37,5,'4:45',3,12,5,2,NULL,0,'2017-04-05 20:49:36','2017-04-05 20:49:36'),(39,4,'2:08',NULL,1,5,1,NULL,0,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(40,4,'2:13',NULL,12,5,1,NULL,0,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(41,4,'2:24',NULL,13,5,1,NULL,0,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(42,4,'2:23',NULL,14,5,1,NULL,0,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(43,3,'52.8',1,18,5,2,NULL,0,'2017-04-06 18:51:41','2017-04-06 18:51:41'),(44,3,'53.2',2,17,5,2,NULL,0,'2017-04-06 18:51:41','2017-04-06 18:51:41'),(45,4,'2:17',NULL,19,5,2,NULL,0,'2017-04-06 19:28:26','2017-04-06 19:28:26'),(46,7,'58.4',1,15,5,2,NULL,0,'2017-04-07 23:22:46','2017-04-07 23:22:46'),(47,1,'11.20',1,18,5,10,NULL,0,'2017-04-17 18:15:31','2017-04-17 18:15:31'),(48,4,'2:05',2,1,5,10,NULL,0,'2017-04-17 18:15:53','2017-04-17 18:15:53'),(49,13,'20-0',1,17,5,10,NULL,0,'2017-04-17 18:22:37','2017-04-17 18:22:37'),(52,6,'10:19',2,12,5,10,NULL,0,'2017-04-17 18:27:44','2017-04-17 18:27:44'),(54,8,'15.7',2,15,5,10,NULL,0,'2017-04-18 18:08:17','2017-04-18 18:08:17'),(55,7,'58.8',1,15,5,11,NULL,0,'2017-04-26 02:04:01','2017-04-26 02:04:01'),(56,1,'11.60',2,18,5,11,NULL,0,'2017-04-26 02:04:34','2017-04-26 02:04:34'),(57,1,'11.62',3,17,5,11,NULL,0,'2017-04-26 02:04:34','2017-04-26 02:04:34'),(58,4,'2:10',2,1,5,11,NULL,0,'2017-04-26 02:04:59','2017-04-26 02:04:59'),(59,4,'2:23',NULL,19,5,11,NULL,0,'2017-04-26 02:04:59','2017-04-26 02:04:59'),(60,13,'20-0',3,17,5,11,NULL,0,'2017-05-15 19:15:45','2017-05-15 19:15:45'),(63,6,'11:35.5',1,12,5,11,NULL,0,'2017-05-17 04:36:48','2017-05-17 04:36:48'),(64,6,'10:37.5',6,14,5,11,NULL,0,'2017-05-17 04:37:33','2017-05-17 04:37:33'),(81,24,'3:21',NULL,1,5,15,'first',0,'2017-05-19 17:35:22','2017-05-19 17:35:22'),(82,3,'51.6',NULL,18,5,15,'second',0,'2017-05-19 17:35:22','2017-05-19 17:35:22'),(83,4,'2:06',NULL,20,5,15,'third',0,'2017-05-19 17:35:22','2017-05-19 17:35:22'),(84,6,'4:41',NULL,12,5,15,'anchor',0,'2017-05-19 17:35:22','2017-05-19 17:35:22'),(85,24,'3:43',NULL,13,5,7,'first',0,'2017-05-19 19:30:33','2017-05-19 19:30:33'),(86,3,'57.0',NULL,1,5,7,'second',0,'2017-05-19 19:30:33','2017-05-19 19:30:33'),(87,4,'2:20',NULL,14,5,7,'third',0,'2017-05-19 19:30:33','2017-05-19 19:30:33'),(88,6,'4:43',NULL,12,5,7,'anchor',0,'2017-05-19 19:30:34','2017-05-19 19:30:34'),(89,3,'54.1',NULL,17,5,15,'first',0,'2017-05-19 20:10:12','2017-05-19 20:10:12'),(90,3,'52.7',NULL,15,5,15,'second',0,'2017-05-19 20:10:12','2017-05-19 20:10:12'),(91,3,'53.5',NULL,20,5,15,'third',0,'2017-05-19 20:10:12','2017-05-19 20:10:12'),(92,3,'51.8',NULL,18,5,15,'anchor',0,'2017-05-19 20:10:12','2017-05-19 20:10:12'),(93,5,'4:47',NULL,1,5,11,NULL,0,'2017-05-24 20:24:58','2017-05-24 20:24:58'),(94,5,'5:00',NULL,5,5,10,NULL,0,'2017-05-25 05:15:48','2017-05-25 05:15:48'),(100,4,'2:20',NULL,6,5,10,'first',0,'2017-05-26 07:34:39','2017-05-26 07:34:39'),(114,4,'2:21',NULL,5,5,2,NULL,1,'2017-05-26 18:46:09','2017-05-26 18:46:10'),(115,3,'53',NULL,17,5,13,'first',0,'2017-05-29 20:43:42','2017-05-29 20:43:42'),(116,3,'53',NULL,15,5,13,'second',0,'2017-05-29 20:43:42','2017-05-29 20:43:42'),(117,3,'53',NULL,20,5,13,'third',0,'2017-05-29 20:43:42','2017-05-29 20:43:42'),(118,3,'53',NULL,18,5,13,'anchor',0,'2017-05-29 20:43:42','2017-05-29 20:43:42'),(119,4,'2:04.8',NULL,1,5,17,'first',1,'2017-05-29 21:25:43','2017-05-29 21:25:44'),(120,4,'2:03.8',NULL,20,5,17,'second',1,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(121,4,'2:08.8',NULL,22,5,17,'third',1,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(122,4,'2:05.6',NULL,12,5,17,'anchor',1,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(123,3,'54',NULL,20,5,2,'first',0,'2017-05-30 05:50:48','2017-05-30 05:50:48'),(124,3,'54',NULL,17,5,2,'second',0,'2017-05-30 05:50:48','2017-05-30 05:50:48'),(125,3,'54',NULL,18,5,2,'third',0,'2017-05-30 05:50:48','2017-05-30 05:50:48'),(126,3,'54',NULL,15,5,2,'anchor',0,'2017-05-30 05:50:48','2017-05-30 05:50:48'),(127,4,'2:04.75',NULL,28,10,18,'first',1,'2017-06-01 01:40:12','2017-06-01 01:40:12'),(128,4,'2:03.89',NULL,30,10,18,'second',1,'2017-06-01 01:40:12','2017-06-01 01:40:13'),(129,4,'2:08.47',NULL,27,10,18,'third',1,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(130,4,'2:05.39',NULL,29,10,18,'anchor',1,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(131,4,'2:06.29',23,28,10,18,NULL,1,'2017-06-01 01:42:41','2017-06-01 01:42:41'),(132,6,'9:54.71',8,29,10,18,NULL,1,'2017-06-01 01:45:42','2017-06-01 01:45:43'),(133,6,'11:27.95',6,31,10,18,NULL,0,'2017-06-01 01:53:05','2017-06-01 01:53:05'),(134,2,'23.48',12,32,10,18,NULL,0,'2017-06-01 02:12:01','2017-06-01 02:12:01'),(135,4,'2:15',NULL,6,5,21,'first',0,'2017-06-19 18:22:24','2017-06-19 18:22:24'),(136,4,'2:15',NULL,14,5,21,'second',0,'2017-06-19 18:22:24','2017-06-19 18:22:24'),(137,4,'2:15',NULL,22,5,21,'third',0,'2017-06-19 18:22:24','2017-06-19 18:22:24'),(138,4,'2:15',NULL,19,5,21,'anchor',0,'2017-06-19 18:22:24','2017-06-19 18:22:24');
/*!40000 ALTER TABLE `performance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relay`
--

DROP TABLE IF EXISTS `relay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `result` varchar(45) NOT NULL,
  `place` int(10) unsigned DEFAULT NULL,
  `meet_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `first_leg` int(10) unsigned NOT NULL,
  `second_leg` int(10) unsigned NOT NULL,
  `third_leg` int(10) unsigned DEFAULT NULL,
  `fourth_leg` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relay_meet_idx` (`meet_id`),
  KEY `fk_relay_event_idx` (`event_id`),
  KEY `fk_first_leg_idx` (`first_leg`),
  KEY `fk_second_leg_idx` (`second_leg`),
  KEY `fk_third_leg_idx` (`third_leg`),
  KEY `fk_fourth_leg_idx` (`fourth_leg`),
  KEY `fk_relay_team_idx` (`team_id`),
  CONSTRAINT `fk_first_leg` FOREIGN KEY (`first_leg`) REFERENCES `performance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fourth_leg` FOREIGN KEY (`fourth_leg`) REFERENCES `performance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relay_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relay_meet` FOREIGN KEY (`meet_id`) REFERENCES `schedule_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_relay_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_second_leg` FOREIGN KEY (`second_leg`) REFERENCES `performance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_third_leg` FOREIGN KEY (`third_leg`) REFERENCES `performance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relay`
--

LOCK TABLES `relay` WRITE;
/*!40000 ALTER TABLE `relay` DISABLE KEYS */;
INSERT INTO `relay` VALUES (5,22,'10:59',3,15,5,81,82,83,84,'2017-05-19 17:35:22','2017-05-19 17:35:22'),(6,22,'11:40',3,7,5,85,86,87,88,'2017-05-19 19:30:34','2017-05-19 19:30:34'),(7,19,'3:32',4,15,5,89,90,91,92,'2017-05-19 20:10:12','2017-05-19 20:10:12'),(10,19,'3:33',1,13,5,115,116,117,118,'2017-05-29 20:43:42','2017-05-29 20:43:42'),(11,20,'8:22.70',6,17,5,119,120,121,122,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(12,19,'3:40',2,2,5,123,124,125,126,'2017-05-30 05:50:48','2017-05-30 05:50:48'),(13,20,'8:22.70',6,18,10,127,128,129,130,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(14,20,'9:00',5,21,5,135,136,137,138,'2017-06-19 18:22:24','2017-06-19 18:22:24');
/*!40000 ALTER TABLE `relay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roster_spot`
--

DROP TABLE IF EXISTS `roster_spot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roster_spot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `athlete_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rs_athlete_idx` (`athlete_id`),
  KEY `fk_rs_season_idx` (`season_id`),
  CONSTRAINT `fk_rs_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athlete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rs_season` FOREIGN KEY (`season_id`) REFERENCES `season` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roster_spot`
--

LOCK TABLES `roster_spot` WRITE;
/*!40000 ALTER TABLE `roster_spot` DISABLE KEYS */;
INSERT INTO `roster_spot` VALUES (1,1,1,NULL,NULL),(2,2,1,NULL,NULL),(3,3,1,NULL,NULL),(4,4,1,NULL,NULL),(6,6,1,NULL,NULL),(7,7,1,NULL,NULL),(8,8,1,NULL,NULL),(9,11,1,NULL,NULL),(10,12,1,NULL,NULL),(11,13,1,NULL,NULL),(12,14,1,NULL,NULL),(13,15,1,NULL,NULL),(14,16,1,NULL,NULL),(15,17,1,NULL,NULL),(16,18,1,NULL,NULL),(17,19,1,NULL,NULL),(18,20,1,NULL,NULL),(19,21,1,NULL,NULL),(20,22,1,NULL,NULL),(21,23,1,NULL,NULL),(25,38,1,'2017-06-08 07:32:40','2017-06-08 07:32:40'),(26,39,1,'2017-06-08 19:15:15','2017-06-08 19:15:15'),(27,40,1,'2017-06-08 19:15:29','2017-06-08 19:15:29'),(28,41,1,'2017-06-08 19:18:25','2017-06-08 19:18:25'),(29,42,1,'2017-06-08 19:18:38','2017-06-08 19:18:38'),(30,43,1,'2017-06-08 19:18:54','2017-06-08 19:18:54'),(31,46,1,'2017-06-08 20:30:23','2017-06-08 20:30:23'),(129,19,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(130,12,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(131,13,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(132,14,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(133,22,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(134,11,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(135,20,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(136,17,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(137,6,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(138,18,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(139,38,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(140,39,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(141,40,29,'2017-06-10 09:04:18','2017-06-10 09:04:18'),(142,41,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(143,42,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(144,43,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(145,23,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(146,16,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(147,21,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(148,15,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(149,2,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(150,46,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(151,7,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(152,56,29,'2017-06-10 09:04:19','2017-06-10 09:04:19'),(153,57,29,'2017-06-19 18:10:49','2017-06-19 18:10:49'),(156,27,2,NULL,NULL),(157,28,2,NULL,NULL),(158,29,2,NULL,NULL),(159,30,2,NULL,NULL),(160,31,2,NULL,NULL),(161,32,2,NULL,NULL),(162,58,4,'2017-06-20 02:12:41','2017-06-20 02:12:41'),(163,60,30,'2017-06-20 02:15:38','2017-06-20 02:15:38'),(164,59,30,'2017-06-20 02:15:38','2017-06-20 02:15:38');
/*!40000 ALTER TABLE `roster_spot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule_event`
--

DROP TABLE IF EXISTS `schedule_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned DEFAULT NULL,
  `importance` int(11) DEFAULT NULL,
  `complete` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sched_team_idx` (`team_id`),
  KEY `fk_sched_season_idx` (`season_id`),
  CONSTRAINT `fk_sched_season` FOREIGN KEY (`season_id`) REFERENCES `season` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sched_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_event`
--

LOCK TABLES `schedule_event` WRITE;
/*!40000 ALTER TABLE `schedule_event` DISABLE KEYS */;
INSERT INTO `schedule_event` VALUES (1,'Season Opener Invitational','River Dell HS','2017-04-01',5,1,1,1,'2017-03-30 06:10:55','2017-04-03 18:41:14'),(2,'Dual Meet vs Clifton','Clifton HS','2017-04-03',5,1,0,1,'2017-03-30 06:27:35','2017-04-04 20:32:56'),(7,'Comet Relays','Hackensack HS','2017-04-08',5,1,1,1,'2017-04-05 04:07:53','2017-04-12 23:25:04'),(8,'Dual Meet vs Passaic/Eastside','Passaic HS','2017-04-10',5,1,2,1,'2017-04-05 04:08:39','2017-04-12 23:25:08'),(10,'Dual Meet vs PCTI','Home','2017-04-13',5,1,2,1,'2017-04-12 23:27:06','2017-04-17 18:15:05'),(11,'Dual Meet vs Kennedy','Home','2017-04-18',5,1,1,1,'2017-04-13 19:15:09','2017-04-26 02:03:34'),(13,'Big North League Championship','Clifton HS','2017-05-03',5,1,2,1,'2017-04-26 02:06:36','2017-05-29 20:42:29'),(14,'Bergen County Championships','Old Tappan HS','2017-05-12',5,1,2,1,'2017-05-15 17:24:44','2017-05-18 19:34:10'),(15,'Bergen County Relays','River','2017-04-21',5,1,1,1,'2017-05-18 19:15:48','2017-05-18 19:15:55'),(16,'Holmdel Twighlight Royal Rumble','Holmdel HS','2017-05-18',5,1,1,1,'2017-05-19 21:34:18','2017-05-19 21:34:25'),(17,'State Sectionals','Randolph HS','2017-05-26',5,1,2,1,'2017-05-29 20:42:20','2017-05-29 20:42:27'),(18,'State Sectionals','Randolph HS','2017-05-25',10,2,2,1,'2017-06-01 01:30:31','2017-06-01 01:30:38'),(19,'New Balance Nationals','Greensboro, NC','2017-06-15',5,NULL,1,0,'2017-06-06 19:59:45','2017-06-06 19:59:45'),(21,'Season Opener','FDU','2018-01-06',5,29,0,1,'2017-06-19 18:21:24','2017-06-19 18:21:28');
/*!40000 ALTER TABLE `schedule_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `season`
--

DROP TABLE IF EXISTS `season`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `season` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `name` varchar(45) NOT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `current` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_season_team_idx` (`team_id`),
  CONSTRAINT `fk_season_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `season`
--

LOCK TABLES `season` WRITE;
/*!40000 ALTER TABLE `season` DISABLE KEYS */;
INSERT INTO `season` VALUES (1,2017,'Outdoor Track',5,0,NULL,NULL),(2,2017,'Outdoor Track',10,1,NULL,NULL),(4,2017,'Outdoor Track',13,1,'2017-06-08 22:11:41','2017-06-08 22:11:41'),(29,2018,'Indoor Track',5,1,'2017-06-10 09:03:38','2017-06-10 09:03:38'),(30,2018,'Indoor Track',13,0,'2017-06-20 02:13:00','2017-06-20 02:13:00');
/*!40000 ALTER TABLE `season` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `split`
--

DROP TABLE IF EXISTS `split`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `split` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `performance_id` int(10) unsigned NOT NULL,
  `time` varchar(45) NOT NULL,
  `lap` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_split_performance_idx` (`performance_id`),
  CONSTRAINT `fk_split_performance` FOREIGN KEY (`performance_id`) REFERENCES `performance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `split`
--

LOCK TABLES `split` WRITE;
/*!40000 ALTER TABLE `split` DISABLE KEYS */;
INSERT INTO `split` VALUES (34,114,'1:10',1,'2017-05-26 18:46:09','2017-05-26 18:46:09'),(35,114,'1:11',2,'2017-05-26 18:46:09','2017-05-26 18:46:09'),(36,119,'1:00',1,'2017-05-29 21:25:43','2017-05-29 21:25:43'),(37,119,'1:04.8',2,'2017-05-29 21:25:43','2017-05-29 21:25:43'),(38,120,'57.0',1,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(39,120,'1:06',2,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(40,121,'1:00',1,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(41,121,'1:08',2,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(42,122,'1:00',1,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(43,122,'1:05',2,'2017-05-29 21:25:44','2017-05-29 21:25:44'),(44,127,'1:00.96',1,'2017-06-01 01:40:12','2017-06-01 01:40:12'),(45,127,'1:03.79',2,'2017-06-01 01:40:12','2017-06-01 01:40:12'),(46,128,'56.73',1,'2017-06-01 01:40:12','2017-06-01 01:40:12'),(47,128,'1:06.80',2,'2017-06-01 01:40:12','2017-06-01 01:40:12'),(48,129,'59.29',1,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(49,129,'1:09.18',2,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(50,130,'59.76',1,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(51,130,'1:05.63',2,'2017-06-01 01:40:13','2017-06-01 01:40:13'),(52,131,'1:02.66',1,'2017-06-01 01:42:41','2017-06-01 01:42:41'),(53,131,'1:03.63',2,'2017-06-01 01:42:41','2017-06-01 01:42:41'),(54,132,'1:11.13',1,'2017-06-01 01:45:42','2017-06-01 01:45:42'),(55,132,'1:15.03',2,'2017-06-01 01:45:43','2017-06-01 01:45:43'),(56,132,'1:13.97',3,'2017-06-01 01:45:43','2017-06-01 01:45:43'),(57,132,'1:16.76',4,'2017-06-01 01:45:43','2017-06-01 01:45:43'),(58,132,'1:15.25',5,'2017-06-01 01:45:43','2017-06-01 01:45:43'),(59,132,'1:16.05',6,'2017-06-01 01:45:43','2017-06-01 01:45:43'),(60,132,'1:14.34',7,'2017-06-01 01:45:43','2017-06-01 01:45:43'),(61,132,'1:13.83',8,'2017-06-01 01:45:43','2017-06-01 01:45:43');
/*!40000 ALTER TABLE `split` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (5,'Knights','Bergen Tech','$2y$10$wl6CUDCDwf2asakrm3oCEup5vhF.COt4TcgiMvAOYMBmlnlmoMRTS','2017-03-25 23:29:40','2017-03-25 23:29:40'),(6,'Yankees','New York','$2y$10$euWes8hbxLNs0T8Xi.kPceLbpLqQOcruFCzjqSWsG1TDIiZHTwbBS','2017-03-27 06:41:23','2017-03-27 06:41:23'),(7,'Test','Test','$2y$10$BUbqiUIAQ/WYgpW5JvG6h.njMaREIOmBWrj5fZsb6ONtod9ko0KuO','2017-05-31 19:18:15','2017-05-31 19:18:15'),(9,'Test','Test','$2y$10$uknqOUGgbbtA.xYAMcVwhOfBArheY31OuD7EeJEyD2sG.pmx9KShy','2017-05-31 21:31:16','2017-05-31 21:31:16'),(10,'Knights','Bergen Tech','$2y$10$2/0iR.37/ucNc.x8GPDbdeVJ48nwbJ05U7Qo/5gd6f67GujuzBYqq','2017-06-01 01:24:51','2017-06-01 01:24:51'),(13,'Bears','Test High School','$2y$10$D1Ky8mbZer/aavKQGMB8fuewK2Qz6VuCnDVJUEXlOybxBL/ILmF8y','2017-06-08 22:11:41','2017-06-08 22:11:41');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coach_or_athlete` tinyint(4) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`username`),
  KEY `idx_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'Test','Coach','matpark@bergen.org',1,1,'$2y$10$boCpCt6YCkhi5C0256TuFu3Z88RP5XNHgDbSX.Jp/RFtwM.uwKJOy','ILFwNheerTsESRljnaRX0cBj0LdzLbPGPtFr7OxTp9zU5FweO4aw7eSJonCa','2017-03-25 23:29:40','2017-03-25 23:29:40'),(11,'Test','Assistant','matpark2@bergen.org',1,1,'$2y$10$V6XNsBzSnBrCnnt.HgINXuc0nd808YoHkBKuIJgAJlF/muJdhbL/e','juOMkxu40BbLqaqhQKdHAcTtFkxZb8Jvq483Uw6R6iqpwifc93qmfNMG6sbF','2017-03-26 01:38:29','2017-03-26 01:38:29'),(13,'Matthew','Park','matpark3@bergen.org',0,1,'$2y$10$RwetV8mHO8ClPi4hYLiN5.0q1FHLZsU7hdRHYmTYgbeBogvDuNTlO','deI5RHFWVeWqO2HmZAcNXaJ6ZFGWDdYWFefELdLJ5wolqRbHbZRpJXJpQmiP','2017-03-26 01:56:20','2017-03-26 01:56:20'),(14,'Test','Athlete','matpark4@bergen.org',0,1,'$2y$10$KucHBCoyFLnAcyAT7OkztOxlazPWa1i7ekemxmF1Q6WeXJYBc4wyK',NULL,'2017-03-26 01:58:58','2017-03-26 01:58:58'),(15,'Test2','Athlete','matpark5@bergen.org',0,1,'$2y$10$9az1wOc6xNUrELiIMMD1g.UrK7un.FKsSK5dW11B.GwPuqFz6OfEy',NULL,'2017-03-26 02:05:15','2017-03-26 02:05:15'),(16,'Test3','Athlete','matpark6@bergen.org',0,1,'$2y$10$dtx28Vy5/JGKa0OWEipkDO9e3hrPc4Ox8Yg9v4IFEKur0zvh33ghO',NULL,'2017-03-26 02:11:53','2017-03-26 02:11:53'),(17,'Test4','Athlete','matpark7@bergen.org',0,1,'$2y$10$siyYvoXHTGXtXr2XCtIr/..rOdfZcoLwDes572U4d6Vd85ZuxRIrK',NULL,'2017-03-26 02:13:43','2017-03-26 02:13:43'),(18,'Matt','Teshome','mattes@bergen.org',0,1,'$2y$10$vQ/d6nmjaOSXHAgQb1lwdOshfL9rKPyW8WXGTXEX83fHtPPN8Lgo6','2OYltm11KZSJSmWPuPEwyrNHO2OJE0uytFkaT948qhr22S47DueydSKraUvG','2017-03-26 02:20:42','2017-03-26 02:20:42'),(19,'Test','User','test@gmail.com',0,1,'$2y$10$Y.q7.H5ryXHNz0TDU/8wUuv0UOB9pYSUkzNHBQp5Suz7A2tRppddW','zFYDFcrSfuRCrgRVYVg51hfe1QePJD6ZbfQvJbUG4wN6M79n9LhsawlkyNXp','2017-03-26 03:14:30','2017-03-26 03:14:30'),(20,'Test5','Athlete','matpark8@bergen.org',0,1,'$2y$10$LTOE2lnHuHqlgB/dqvpT5eOHv740FSRngsdKbl/7iTssfT8d5cPe2',NULL,'2017-03-27 06:35:41','2017-03-27 06:35:41'),(21,'Test6','Assistant','matpark9@bergen.org',1,1,'$2y$10$Mq0j.eLljui0Wx5pqHOwseVj7tlA/4ohPG3qvMYolwRBlryKbG51m',NULL,'2017-03-27 06:40:15','2017-03-27 06:40:15'),(22,'Test7','Coach','matpark10@bergen.org',1,1,'$2y$10$jXxBxvVOhO4sdwJvMaSQju2i7jxgim3JhhEqLYwZ8kE/IpRTa4UCW','5Ha8QpQ4GelrMsrrLYFrIhcy36CVEiwkRVGMH8jl5ZkwDv5kAQEy8MqQ3RIN','2017-03-27 06:41:23','2017-03-27 06:41:23'),(23,'Max','Alweiss','maxalw@bergen.org',0,1,'$2y$10$OaIrBi6kc0BN7anBilh6bOOlAHF1l3laGLpT3ZhZyHbH/c4FEitXO','671AtRm3N1j02n9EWwuey1Gg1cmbj2PGX6utk9WsUuDcayAX6M72yTSsW7ag','2017-03-27 17:14:08','2017-03-27 17:14:08'),(24,'Test8','Athlete','matpark11@bergen.org',0,1,'$2y$10$ltreESRAeeVEb4u8s/ybX.SBnEZz0H8j94DNG9p9OxsPtljhHVYqG',NULL,'2017-03-28 05:00:59','2017-03-28 05:00:59'),(25,'Evan','Lee','evalee@bergen.org',0,1,'$2y$10$yUhJgMp.A9Xck8pxCQ1g7e0ZSAd97R/LHRExdY9KiJRrHhUseEhNe',NULL,'2017-03-29 02:16:30','2017-03-29 02:16:30'),(26,'Anthony','Di Iorio','antdio@bergen.org',0,1,'$2y$10$G2ihRWFRVMnQ4YCK2zZhwOiJAlYk5MdKoV9Qw/HEy6egSVPiAtK/G','L3rmO3WVu3BH5vyICdkuyvDIfrCZsimXxoe84ElsVigWz1FDspBABU2KjSOf','2017-04-03 04:03:06','2017-04-03 04:03:06'),(27,'Christopher','Dugan','chrdug@bergen.org',0,1,'$2y$10$wS/WeCDmKk/yKjYsO6kCJOAOsX7Uu7NDV8zu.R9ixmxoO/j8iLx86',NULL,'2017-04-03 04:03:51','2017-04-03 04:03:51'),(28,'Elliot','Wehrle','ellweh@bergen.org',0,1,'$2y$10$CqE.X6qgtwFdDzeedvU0jOZQmx361qsUwOf3SmoEO.qH1fm.VUa5q',NULL,'2017-04-03 04:04:26','2017-04-03 04:04:26'),(29,'T\'Shawn','Jennings','tshjen@bergen.org',0,1,'$2y$10$8cmgk6lqGjskXOcbxIhPEO64/hWH5M3lbdZNAy1827hkWd0dwv.9S','m9JX2vyoTQGWIWAZJZsXT7HllWeq8XIacdEpSb88F0c5MtzoQUAl3OTTqMNi','2017-04-05 07:11:31','2017-04-05 07:11:31'),(30,'Sophia','Wolmer','sopwol@bergen.org',0,0,'$2y$10$nDmg.UWV3.fMJiYhYvJ2nOnli/tib4UI7/Q5E9gsIyQsgx1uw5JK.',NULL,'2017-04-05 07:34:48','2017-04-05 07:34:48'),(31,'Jayjoon','Sin','jaysin@bergen.org',0,1,'$2y$10$iR7dT1qRclsHtiuSTT11x.PFfjl840hIfbWwhQm42OP21p/VWcUk2','Knw3RQWCRwgmuAtZusBLAv6ouoyDx37E84E0P2SILMZC1c2FHUhgJ8m0LrF3','2017-04-05 22:39:05','2017-04-05 22:39:05'),(32,'Michael','Cai','miccai@bergen.org',0,1,'$2y$10$yXd5LDK60T/8KMSeHTXLy..PC1yDPoPgohym6whxAnM0cctNbj9dK',NULL,'2017-04-06 18:50:01','2017-04-06 18:50:01'),(33,'Aatif','Sayed','aatsay19@bergen.org',0,1,'$2y$10$auGKNiGaNodeOPIxul5jguXu1/vJXSVDJn4D2MMoCExxus/JQQSd.',NULL,'2017-04-06 19:26:32','2017-04-06 19:26:32'),(34,'Jason','Kemly','jaskem@bergen.org',0,1,'$2y$10$KtzpzbXyFFysOXuTX5cOruRmt7eiL6HaIk.BcCQUSGeg0Mr7hg4Z.',NULL,'2017-05-18 19:17:09','2017-05-18 19:17:09'),(35,'Stephen','Shields','steshi@bergen.org',0,1,'$2y$10$tgAQkhlDoaNYrWWfxZskhONbGcwlII0GsxXp3nGIJdPqoYVv0Ieaq',NULL,'2017-05-19 02:31:42','2017-05-19 02:31:42'),(36,'Evan','Demoleas','evadem@bergen.org',0,1,'$2y$10$1w5QOmK8ydTvLQftjIvPXu4lWYUia6h5ZCqQTmHJokr7gKWYaspBi','aYRK3PbnWyZ4iUofui248eR3VLRmQX46hpcMi8LsdVJPbqBi7yD5ml3hwooT','2017-05-29 20:51:51','2017-05-29 20:51:51'),(37,'Shannon','Clancy','shacla@bergen.org',0,0,'$2y$10$SUzzXn6yiy.QUmgy2Pdcz.YEIpzU/x.j6kBZ9IQeJJwsDY9pOPhXW',NULL,'2017-05-29 20:53:07','2017-05-29 20:53:07'),(38,'Test','Test','Test',0,1,'$2y$10$Fp1E6TetzEhJVQRULZlvZOiCLkR5O.eTV007YdBNTP7Y.48TCk79m',NULL,'2017-05-30 05:58:19','2017-05-30 05:58:19'),(39,'Test','Coach','test1',1,1,'$2y$10$o2OAfEU4xAt7bejJzA6lmO8o41kqnXJzJuzAglxfbKvXj0UZUS26S',NULL,'2017-05-31 19:18:15','2017-05-31 19:18:15'),(40,'Test','Test','test2',0,1,'$2y$10$euhJleDqowpyGi4rBwl0Yu9KIn7D4ZvbWz4Ccd0jzCRswoiKZLdHm',NULL,'2017-05-31 19:25:19','2017-05-31 19:25:19'),(41,'Test','Test','test3',1,1,'$2y$10$9WyMoBU6EREkts.ApyKQze58FhnUGi0qPBAVpAWVjbGXeYBFIJmXW',NULL,'2017-05-31 21:25:33','2017-05-31 21:25:33'),(42,'Test','Test','test4',1,1,'$2y$10$QKjC/BIK4AMAjG9jIjx6EubBgi3FERlg.IKPvJDyVon4YgmnkaH1K',NULL,'2017-05-31 21:29:51','2017-05-31 21:29:51'),(43,'Test','Test','test5',1,1,'$2y$10$FP92MZPolxWYCtDuNFFzJOY9tDVDxbFNAIO9hjWumj6rY5nDC91Wm',NULL,'2017-05-31 21:31:16','2017-05-31 21:31:16'),(44,'Test','Test','test6',0,1,'$2y$10$VCeHQzeljhZN8A8jLtiqrOCloYPHRq5qz..tssL5VhayeLzhQm/0O',NULL,'2017-06-01 01:21:58','2017-06-01 01:21:58'),(45,'Mike','Mykytok','mjmykytok',1,1,'$2y$10$5RExVLwM5U3t6PAQ4Aji7Of3sy4vo5u7D9HFvLK7ddKyfZaPNPEGe','waADUssRfZXuApm66VFdD3zztcGUuiW5Bfd1Z8C959vjkh8bod8gXrETVuvX','2017-06-01 01:24:51','2017-06-01 01:24:51'),(46,'Evan','Demoleas','demoleas715',0,1,'$2y$10$NA4XJAr9vrvEtURABiDTJu0fZhL2ptG8ptd7umoqeUQ1/zuUS6JlK',NULL,'2017-06-01 01:27:53','2017-06-01 01:27:53'),(47,'Matthew','Park','matpark',0,1,'$2y$10$DzqkkTDmaPDFMoSCCd5jfe.JxDO/vfF.5dBdS9l50qNWQHmeJxidy',NULL,'2017-06-01 01:32:48','2017-06-01 01:32:48'),(48,'Anthony','Di Iorio','antdii',0,1,'$2y$10$gDDAXCY.QFZ4CFuQZl9LhesJMTuap6X2YtmjAJiepwRfF8kiPr1VO',NULL,'2017-06-01 01:33:47','2017-06-01 01:33:47'),(49,'Jason','Kemly','preyingmantis',0,1,'$2y$10$/LjX88b6QaBeuCuY4ktrKu2A6d7EH8B8NVPi4nRexw0haV7AvkPKO',NULL,'2017-06-01 01:34:59','2017-06-01 01:34:59'),(50,'Sophia','Wolmer','sophia_wolmer',0,0,'$2y$10$H4lFlDDhWnDuIYNaH/VwGOVzq7lfURQZL4b7rc9vOKnSFWg0HtMFa','l1EAYdkHjLoHdiIVbAlsTebgKpk5CKLuvb1eIjZgT3l3KKPKn0NuzJkRBAgI','2017-06-01 01:49:56','2017-06-01 01:49:56'),(51,'Jayjoon','Sin','jayjoon0512',0,1,'$2y$10$eJI660lEhXhTMiizYXjGT.Sz9sO/aN46wNeycLI9uIg.i4NELDMaO',NULL,'2017-06-01 02:11:29','2017-06-01 02:11:29'),(52,'Test','Test','test7',0,1,'$2y$10$4Myp0nzMYJ/ALOWtoJxFdOnDb8dcBc15Y35DBw5deYbs.DSuy9bse','J0eEwfWzCuXfLgHrgH8v3HL1INrlqOx4B08X07z3lRcd6GiTJlz2HK4yBIp5','2017-06-01 17:48:35','2017-06-01 17:48:35'),(53,'Test','Test','test8',1,1,'$2y$10$3kLA2r3K4iYbYCWApW6hgu5ZJmoRuR3GiRmWhByJ3V0loPsoWmAAW','95wkrztH0jo99IHCjolKIslqjO0Zf1xVO8AdEwW1htf9DaZOGMfzgsfMA08i','2017-06-01 17:49:34','2017-06-01 17:49:34'),(54,'Test','Test','test9',1,1,'$2y$10$QeFXCbYWktwukGe4Fz2/Ous0lIYpINbQPHX.2PwaEETXHUPcn1r9m',NULL,'2017-06-01 17:53:07','2017-06-01 17:53:07'),(55,'Test','Test','test10',1,1,'$2y$10$fU8CeC5M9b1cUYw37oUQk.NszyA0qispWCSjenHXjtp1wgR6T7AjO',NULL,'2017-06-01 18:09:01','2017-06-01 18:09:01'),(57,'Test','Test','test11',1,1,'$2y$10$AR6o2dePrcE80tkbARiKy.DcWUDJ6ZTuAiXwlnVzc2N0GyadZoYN6','sGTHx0NGIFoRodtN7ZtxhIlDiBZm5UVTShks7whBNkz8T2XJCbgaalVQvGOL','2017-06-01 18:12:04','2017-06-01 18:12:04'),(58,'Test','Test','test12',1,1,'$2y$10$o2Z5KMhdsCqtTIsg5R4J8O2JsP/kRpANAIUwoWPZL0smYaAQoxfY2',NULL,'2017-06-01 18:13:40','2017-06-01 18:13:40'),(59,'Test','Test','test13',1,1,'$2y$10$6f6yG47sgBos5fM9Jea3Eeg6oZUQ2B.4OnDtOr9KGiTEaWViq5vkS','rLBLX3fNiWZlaCAqm043Hh7k7MAHRgVviiGBYgXpFRuoouIulx7UaTzBy8ti','2017-06-01 18:23:02','2017-06-01 18:23:02'),(60,'Test','Test','test14',0,1,'$2y$10$COr.V76nySPXwpzpX7YwWuZH2ufCLGVdqO7irFsfCXVQ1AJVa3vfe',NULL,'2017-06-01 18:26:48','2017-06-01 18:26:48'),(61,'Test','Test','test15',0,1,'$2y$10$GzXJG/Y.9bh0dRfKkSK90.QWsHbC6XSttx93M9N/IMIlZVZb4.oTC',NULL,'2017-06-01 23:17:58','2017-06-01 23:17:58'),(62,'Test','Test','test16',1,1,'$2y$10$9Ra/hsI6EW2VB18wGmsGke9xv4W/4.DIZy9lJxGDoyp0Pb6Ybjqnm',NULL,'2017-06-01 23:18:37','2017-06-01 23:18:37'),(66,'Random','Athlete','random',0,1,'$2y$10$FipE5BjN.f2eFOCMh1Gay./8uG39qgzUh2fnX8HZHOv8nQoeAnFHO',NULL,'2017-06-08 07:32:39','2017-06-08 19:10:46'),(67,'Random','Athlete2','random2',0,1,'$2y$10$nRHPG4.RZVnI7UoYjCZvqe8Z7e.FRwV55oOLYvXBzJDvP1NvQb9iS',NULL,'2017-06-08 19:15:15','2017-06-08 19:16:09'),(68,'Random','Athlete3','random3',0,1,'$2y$10$kkWmwBCuLQyxgPD0eucbVOjXDRDZglf74EzvlYVFLNvGlnTfpM79m',NULL,'2017-06-08 19:15:29','2017-06-08 19:16:52'),(69,'Random','Athlete4','random4',0,1,'$2y$10$2.oVsS61FWRiefkm.hm3tOvJkYT3SDrSvK4yNBntHWmzkbWoXE4pa','XnfqapBvWtQ4aESz9EnfwJ5RbiPNITlTs9mFFqIynKo10PElSzKC4vlIcBdl','2017-06-08 19:18:25','2017-06-08 19:19:29'),(70,'Random','Athlete5','random5',0,1,'$2y$10$KyKAIXhX9nezfdQadUcMUOKIBLC94ZXNAho8nZ4ITiIsF1suHEteK',NULL,'2017-06-08 19:18:38','2017-06-08 19:48:32'),(71,'Random','Athlete6','random6',0,1,'$2y$10$KIvTus5oPefg729vXoZgiOx.oQHsv6iu1wdPx3BHbEe.Vcuu/7eOm',NULL,'2017-06-08 19:18:54','2017-06-08 20:45:08'),(72,'Test','Athlete7','test17',0,1,'$2y$10$GRjdEb4WHyKts2XcsLToyubETBrlV5vLgRlFv.YGxIi2qeonK2Tqu',NULL,'2017-06-08 20:15:04','2017-06-08 20:15:04'),(73,'Test','Athlete18','test18',0,1,'$2y$10$pm0.2EuchMIGm768kv4ireJ5bY0g.eSBk2qCcIw6s9zpzyTiZYFNu',NULL,'2017-06-08 20:25:37','2017-06-08 20:25:37'),(75,'Test','Athlete19','test19',0,1,'$2y$10$nWImrH1bg9BDPtOgUuij6./Wxkb8zV373jbynvGRtr4OjfY9Tfl9C',NULL,'2017-06-08 20:29:49','2017-06-08 20:29:49'),(80,'Test','Coach','test21',1,1,'$2y$10$UyNaPs2BUOOHkh33yfeKJOxqfJHcLxqwJrU/xomqP08uBeFsGAKvy','lZHxlfzip6qCRfEHt8XeLEGsppjgzq3CBmkOBpQ5ny0AmqhvH7z55ncBbrB9','2017-06-08 22:11:41','2017-06-08 22:11:41'),(81,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 01:39:41','2017-06-10 01:39:41'),(82,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 01:41:06','2017-06-10 01:41:06'),(83,'Random','Athlete20',NULL,0,0,NULL,NULL,'2017-06-10 01:41:30','2017-06-10 01:41:30'),(84,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 08:14:59','2017-06-10 08:14:59'),(85,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 08:24:43','2017-06-10 08:24:43'),(86,'Random','Athlete2',NULL,0,1,NULL,NULL,'2017-06-10 08:25:10','2017-06-10 08:25:10'),(87,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 08:28:51','2017-06-10 08:28:51'),(88,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 08:38:36','2017-06-10 08:38:36'),(89,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 08:53:25','2017-06-10 08:53:25'),(90,'Random','Athlete',NULL,0,1,NULL,NULL,'2017-06-10 09:04:15','2017-06-10 09:04:15'),(91,'New','Athlete',NULL,0,1,NULL,NULL,'2017-06-19 18:10:49','2017-06-19 18:10:49'),(92,'New','Athlete',NULL,0,1,NULL,NULL,'2017-06-20 02:12:41','2017-06-20 02:12:41'),(93,'New','Athlete2',NULL,0,1,NULL,NULL,'2017-06-20 02:13:41','2017-06-20 02:13:41'),(94,'New','Athlete2',NULL,0,1,NULL,NULL,'2017-06-20 02:15:26','2017-06-20 02:15:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-19 20:02:38
