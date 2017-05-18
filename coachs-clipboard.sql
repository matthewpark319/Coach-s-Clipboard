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
  `team_id` int(10) unsigned NOT NULL,
  `text` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ancmt_coach_idx` (`coach_id`),
  KEY `fk_ancmt_team_idx` (`team_id`),
  CONSTRAINT `fk_ancmt_coach` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ancmt_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
INSERT INTO `announcement` VALUES (10,4,5,'Announcement','2017-05-15 15:10:31','2017-05-15 19:10:31','2017-05-15 19:10:31');
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
  `events` varchar(45) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `team` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_athlete_user_idx` (`user_id`),
  KEY `fk_athlete_team_idx` (`team`),
  CONSTRAINT `fk_athlete_team` FOREIGN KEY (`team`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_athlete_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `athlete`
--

LOCK TABLES `athlete` WRITE;
/*!40000 ALTER TABLE `athlete` DISABLE KEYS */;
INSERT INTO `athlete` VALUES (1,'Distance','Varsity',NULL,13,5,'2017-03-26 01:56:20','2017-03-26 01:56:20'),(2,'Sprints','Varsity',NULL,14,5,'2017-03-26 01:58:59','2017-03-26 01:58:59'),(3,'Hurdles','Varsity',NULL,15,5,'2017-03-26 02:05:15','2017-03-26 02:05:15'),(4,'Jumps','Varsity',NULL,16,5,'2017-03-26 02:11:53','2017-03-26 02:11:53'),(5,'Distance','Varsity',NULL,17,5,'2017-03-26 02:13:43','2017-03-26 02:13:43'),(6,'800m','Varsity',NULL,18,5,'2017-03-26 02:20:42','2017-03-26 02:20:42'),(7,'Distance events','JV',NULL,19,5,'2017-03-26 03:14:30','2017-03-26 03:14:30'),(8,'Distance','JV',NULL,20,5,'2017-03-27 06:35:41','2017-03-27 06:35:41'),(9,'Tennis','JV',NULL,23,6,'2017-03-27 17:14:08','2017-03-27 17:14:08'),(10,'Sprints','Varsity',NULL,24,6,'2017-03-28 05:00:59','2017-03-28 05:00:59'),(11,'Distance','Varsity',NULL,25,5,'2017-03-29 02:16:30','2017-03-29 02:16:30'),(12,'Distance','Varsity',NULL,26,5,'2017-04-03 04:03:06','2017-04-03 04:03:06'),(13,'Distance','Varsity',NULL,27,5,'2017-04-03 04:03:51','2017-04-03 04:03:51'),(14,'Distance','Varsity',NULL,28,5,'2017-04-03 04:04:26','2017-04-03 04:04:26'),(15,'Hurdles, sprints','Varsity',NULL,29,5,'2017-04-05 07:11:31','2017-04-05 07:11:31'),(16,'Distance','Varsity',NULL,30,5,'2017-04-05 07:34:48','2017-04-05 07:34:48'),(17,'Sprints, Long Jump','Varsity',NULL,31,5,'2017-04-05 22:39:05','2017-04-05 22:39:05'),(18,'Sprints','Varsity',NULL,32,5,'2017-04-06 18:50:01','2017-04-06 18:50:01'),(19,'Distance','Varsity',NULL,33,5,'2017-04-06 19:26:32','2017-04-06 19:26:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coach`
--

LOCK TABLES `coach` WRITE;
/*!40000 ALTER TABLE `coach` DISABLE KEYS */;
INSERT INTO `coach` VALUES (4,'Coach Test',8,5,NULL,'2017-03-25 23:29:40','2017-03-25 23:29:40'),(5,'Coach Test2',11,NULL,5,'2017-03-26 01:38:29','2017-03-26 01:38:29'),(6,'Coach Test3',21,NULL,5,'2017-03-27 06:40:15','2017-03-27 06:40:15'),(7,'Coach Test4',22,6,NULL,'2017-03-27 06:41:24','2017-03-27 06:41:24');
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
  `type` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'100','sprints',NULL,NULL),(2,'200','sprints',NULL,NULL),(3,'400','sprints',NULL,NULL),(4,'800','distance',NULL,NULL),(5,'1600','distance',NULL,NULL),(6,'3200','distance',NULL,NULL),(7,'400 Hurdles','sprints',NULL,NULL),(8,'High Hurdles','sprints',NULL,NULL),(10,'Shotput','field',NULL,NULL),(11,'Discus','field',NULL,NULL),(12,'Javelin','field',NULL,NULL),(13,'Long Jump','field',NULL,NULL),(14,'High Jump','field',NULL,NULL),(15,'Triple Jump','field',NULL,NULL),(16,'Pole Vault','field',NULL,NULL),(17,'4x100','relay',NULL,NULL),(18,'4x200','relay',NULL,NULL),(19,'4x400','relay',NULL,NULL),(20,'4x800','relay',NULL,NULL),(21,'4x1600','relay',NULL,NULL),(22,'Distance Medley','relay',NULL,NULL),(23,'Sprint Medley','relay',NULL,NULL);
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
  `event_type` varchar(45) DEFAULT NULL,
  `result` varchar(45) NOT NULL,
  `place` int(11) unsigned DEFAULT NULL,
  `athlete_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned NOT NULL,
  `meet_id` int(10) unsigned NOT NULL,
  `relay_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_performance_athlete_idx` (`athlete_id`),
  KEY `fk_performance_team_idx` (`team_id`),
  KEY `fk_performance_sched_idx` (`meet_id`),
  KEY `fk_performance_event_idx` (`event_id`),
  KEY `fk_performance_relay_idx` (`relay_id`),
  CONSTRAINT `fk_performance_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athlete` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_relay` FOREIGN KEY (`relay_id`) REFERENCES `relay` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_sched` FOREIGN KEY (`meet_id`) REFERENCES `schedule_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_performance_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performance`
--

LOCK TABLES `performance` WRITE;
/*!40000 ALTER TABLE `performance` DISABLE KEYS */;
INSERT INTO `performance` VALUES (36,5,NULL,'4:45',2,1,5,2,NULL,'2017-04-05 20:49:36','2017-04-05 20:49:36'),(37,5,NULL,'4:45',3,12,5,2,NULL,'2017-04-05 20:49:36','2017-04-05 20:49:36'),(38,4,NULL,'2:29',NULL,16,5,1,NULL,'2017-04-05 22:43:06','2017-04-05 22:43:06'),(39,4,NULL,'2:08',NULL,1,5,1,NULL,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(40,4,NULL,'2:13',NULL,12,5,1,NULL,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(41,4,NULL,'2:24',NULL,13,5,1,NULL,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(42,4,NULL,'2:23',NULL,14,5,1,NULL,'2017-04-05 22:44:07','2017-04-05 22:44:07'),(43,3,NULL,'52.8',1,18,5,2,NULL,'2017-04-06 18:51:41','2017-04-06 18:51:41'),(44,3,NULL,'53.2',2,17,5,2,NULL,'2017-04-06 18:51:41','2017-04-06 18:51:41'),(45,4,NULL,'2:17',NULL,19,5,2,NULL,'2017-04-06 19:28:26','2017-04-06 19:28:26'),(46,7,NULL,'58.4',1,15,5,2,NULL,'2017-04-07 23:22:46','2017-04-07 23:22:46'),(47,1,NULL,'11.20',1,18,5,10,NULL,'2017-04-17 18:15:31','2017-04-17 18:15:31'),(48,4,NULL,'2:05',2,1,5,10,NULL,'2017-04-17 18:15:53','2017-04-17 18:15:53'),(49,13,NULL,'20-0',1,17,5,10,NULL,'2017-04-17 18:22:37','2017-04-17 18:22:37'),(50,5,NULL,'4:43',NULL,12,5,7,NULL,'2017-04-17 18:23:46','2017-04-17 18:23:46'),(51,3,NULL,'57.0',NULL,1,5,7,NULL,'2017-04-17 18:24:10','2017-04-17 18:24:10'),(52,6,NULL,'10:19',2,12,5,10,NULL,'2017-04-17 18:27:44','2017-04-17 18:27:44'),(53,3,NULL,'59.0',1,15,5,10,NULL,'2017-04-17 21:33:46','2017-04-17 21:33:46'),(54,8,NULL,'15.7',2,15,5,10,NULL,'2017-04-18 18:08:17','2017-04-18 18:08:17'),(55,7,NULL,'58.8',1,15,5,11,NULL,'2017-04-26 02:04:01','2017-04-26 02:04:01'),(56,1,NULL,'11.60',2,18,5,11,NULL,'2017-04-26 02:04:34','2017-04-26 02:04:34'),(57,1,NULL,'11.62',3,17,5,11,NULL,'2017-04-26 02:04:34','2017-04-26 02:04:34'),(58,4,NULL,'2:10',2,1,5,11,NULL,'2017-04-26 02:04:59','2017-04-26 02:04:59'),(59,4,NULL,'2:23',NULL,19,5,11,NULL,'2017-04-26 02:04:59','2017-04-26 02:04:59'),(60,13,NULL,'20-0',3,17,5,11,NULL,'2017-05-15 19:15:45','2017-05-15 19:15:45'),(61,7,NULL,'59.00',1,15,5,11,NULL,'2017-05-15 19:18:08','2017-05-15 19:18:08');
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
  `event` varchar(45) DEFAULT NULL,
  `result` varchar(45) NOT NULL,
  `place` int(10) unsigned DEFAULT NULL,
  `meet_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_relay_meet_idx` (`meet_id`),
  CONSTRAINT `fk_relay_meet` FOREIGN KEY (`meet_id`) REFERENCES `schedule_event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relay`
--

LOCK TABLES `relay` WRITE;
/*!40000 ALTER TABLE `relay` DISABLE KEYS */;
/*!40000 ALTER TABLE `relay` ENABLE KEYS */;
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
  `importance` int(11) DEFAULT NULL,
  `complete` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sched_team_idx` (`team_id`),
  CONSTRAINT `fk_sched_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule_event`
--

LOCK TABLES `schedule_event` WRITE;
/*!40000 ALTER TABLE `schedule_event` DISABLE KEYS */;
INSERT INTO `schedule_event` VALUES (1,'Season Opener Invitational','River Dell HS','2017-04-01',5,1,1,'2017-03-30 06:10:55','2017-04-03 18:41:14'),(2,'Dual Meet vs Clifton','Clifton HS','2017-04-03',5,0,1,'2017-03-30 06:27:35','2017-04-04 20:32:56'),(7,'Comet Relays','Hackensack HS','2017-04-08',5,1,1,'2017-04-05 04:07:53','2017-04-12 23:25:04'),(8,'Dual Meet vs Passaic/Eastside','Passaic HS','2017-04-10',5,2,1,'2017-04-05 04:08:39','2017-04-12 23:25:08'),(10,'Dual Meet vs PCTI','Home','2017-04-13',5,2,1,'2017-04-12 23:27:06','2017-04-17 18:15:05'),(11,'Dual Meet vs Kennedy','Home','2017-04-18',5,1,1,'2017-04-13 19:15:09','2017-04-26 02:03:34'),(13,'Big North League Championship','Clifton HS','2017-05-03',5,2,0,'2017-04-26 02:06:36','2017-04-26 02:06:36'),(14,'Bergen County Championships','Old Tappan HS','2017-05-12',5,2,0,'2017-05-15 17:24:44','2017-05-15 17:24:44');
/*!40000 ALTER TABLE `schedule_event` ENABLE KEYS */;
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
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_UNIQUE` (`school`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (5,'Knights','Bergen Tech','2017-03-25 23:29:40','2017-03-25 23:29:40'),(6,'Yankees','New York','2017-03-27 06:41:23','2017-03-27 06:41:23');
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coach_or_athlete` tinyint(4) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `idx_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'Test','Coach','matpark@bergen.org',1,1,'$2y$10$boCpCt6YCkhi5C0256TuFu3Z88RP5XNHgDbSX.Jp/RFtwM.uwKJOy','mkyetptedP8OH3uBfdanIsA26ufy9uGUzrCJqSA6gHyJRaTMSFxflCshbrzj','2017-03-25 23:29:40','2017-03-25 23:29:40'),(11,'Test','Assistant','matpark2@bergen.org',1,1,'$2y$10$V6XNsBzSnBrCnnt.HgINXuc0nd808YoHkBKuIJgAJlF/muJdhbL/e',NULL,'2017-03-26 01:38:29','2017-03-26 01:38:29'),(13,'Matthew','Park','matpark3@bergen.org',0,1,'$2y$10$RwetV8mHO8ClPi4hYLiN5.0q1FHLZsU7hdRHYmTYgbeBogvDuNTlO','deI5RHFWVeWqO2HmZAcNXaJ6ZFGWDdYWFefELdLJ5wolqRbHbZRpJXJpQmiP','2017-03-26 01:56:20','2017-03-26 01:56:20'),(14,'Test','Athlete','matpark4@bergen.org',0,1,'$2y$10$KucHBCoyFLnAcyAT7OkztOxlazPWa1i7ekemxmF1Q6WeXJYBc4wyK',NULL,'2017-03-26 01:58:58','2017-03-26 01:58:58'),(15,'Test2','Athlete','matpark5@bergen.org',0,1,'$2y$10$9az1wOc6xNUrELiIMMD1g.UrK7un.FKsSK5dW11B.GwPuqFz6OfEy',NULL,'2017-03-26 02:05:15','2017-03-26 02:05:15'),(16,'Test3','Athlete','matpark6@bergen.org',0,1,'$2y$10$dtx28Vy5/JGKa0OWEipkDO9e3hrPc4Ox8Yg9v4IFEKur0zvh33ghO',NULL,'2017-03-26 02:11:53','2017-03-26 02:11:53'),(17,'Test4','Athlete','matpark7@bergen.org',0,1,'$2y$10$siyYvoXHTGXtXr2XCtIr/..rOdfZcoLwDes572U4d6Vd85ZuxRIrK',NULL,'2017-03-26 02:13:43','2017-03-26 02:13:43'),(18,'Matt','Teshome','mattes@bergen.org',0,1,'$2y$10$vQ/d6nmjaOSXHAgQb1lwdOshfL9rKPyW8WXGTXEX83fHtPPN8Lgo6','2OYltm11KZSJSmWPuPEwyrNHO2OJE0uytFkaT948qhr22S47DueydSKraUvG','2017-03-26 02:20:42','2017-03-26 02:20:42'),(19,'Test','User','test@gmail.com',0,1,'$2y$10$Y.q7.H5ryXHNz0TDU/8wUuv0UOB9pYSUkzNHBQp5Suz7A2tRppddW','zFYDFcrSfuRCrgRVYVg51hfe1QePJD6ZbfQvJbUG4wN6M79n9LhsawlkyNXp','2017-03-26 03:14:30','2017-03-26 03:14:30'),(20,'Test5','Athlete','matpark8@bergen.org',0,1,'$2y$10$LTOE2lnHuHqlgB/dqvpT5eOHv740FSRngsdKbl/7iTssfT8d5cPe2',NULL,'2017-03-27 06:35:41','2017-03-27 06:35:41'),(21,'Test6','Assistant','matpark9@bergen.org',1,1,'$2y$10$Mq0j.eLljui0Wx5pqHOwseVj7tlA/4ohPG3qvMYolwRBlryKbG51m',NULL,'2017-03-27 06:40:15','2017-03-27 06:40:15'),(22,'Test7','Coach','matpark10@bergen.org',1,1,'$2y$10$jXxBxvVOhO4sdwJvMaSQju2i7jxgim3JhhEqLYwZ8kE/IpRTa4UCW','5Ha8QpQ4GelrMsrrLYFrIhcy36CVEiwkRVGMH8jl5ZkwDv5kAQEy8MqQ3RIN','2017-03-27 06:41:23','2017-03-27 06:41:23'),(23,'Max','Alweiss','maxalw@bergen.org',0,1,'$2y$10$OaIrBi6kc0BN7anBilh6bOOlAHF1l3laGLpT3ZhZyHbH/c4FEitXO','671AtRm3N1j02n9EWwuey1Gg1cmbj2PGX6utk9WsUuDcayAX6M72yTSsW7ag','2017-03-27 17:14:08','2017-03-27 17:14:08'),(24,'Test8','Athlete','matpark11@bergen.org',0,1,'$2y$10$ltreESRAeeVEb4u8s/ybX.SBnEZz0H8j94DNG9p9OxsPtljhHVYqG',NULL,'2017-03-28 05:00:59','2017-03-28 05:00:59'),(25,'Evan','Lee','evalee@bergen.org',0,1,'$2y$10$yUhJgMp.A9Xck8pxCQ1g7e0ZSAd97R/LHRExdY9KiJRrHhUseEhNe',NULL,'2017-03-29 02:16:30','2017-03-29 02:16:30'),(26,'Anthony','Di Iorio','antdio@bergen.org',0,1,'$2y$10$G2ihRWFRVMnQ4YCK2zZhwOiJAlYk5MdKoV9Qw/HEy6egSVPiAtK/G','nlxOH7vXplc876ct0VBKVGmfqL7DdCajEaS6OSL4aAE2r3qO6KsPgA2KNE0l','2017-04-03 04:03:06','2017-04-03 04:03:06'),(27,'Christopher','Dugan','chrdug@bergen.org',0,1,'$2y$10$wS/WeCDmKk/yKjYsO6kCJOAOsX7Uu7NDV8zu.R9ixmxoO/j8iLx86',NULL,'2017-04-03 04:03:51','2017-04-03 04:03:51'),(28,'Elliot','Wehrle','ellweh@bergen.org',0,1,'$2y$10$CqE.X6qgtwFdDzeedvU0jOZQmx361qsUwOf3SmoEO.qH1fm.VUa5q',NULL,'2017-04-03 04:04:26','2017-04-03 04:04:26'),(29,'T\'Shawn','Jennings','tshjen@bergen.org',0,1,'$2y$10$8cmgk6lqGjskXOcbxIhPEO64/hWH5M3lbdZNAy1827hkWd0dwv.9S','m9JX2vyoTQGWIWAZJZsXT7HllWeq8XIacdEpSb88F0c5MtzoQUAl3OTTqMNi','2017-04-05 07:11:31','2017-04-05 07:11:31'),(30,'Sophia','Wolmer','sopwol@bergen.org',0,0,'$2y$10$nDmg.UWV3.fMJiYhYvJ2nOnli/tib4UI7/Q5E9gsIyQsgx1uw5JK.',NULL,'2017-04-05 07:34:48','2017-04-05 07:34:48'),(31,'Jayjoon','Sin','jaysin@bergen.org',0,1,'$2y$10$iR7dT1qRclsHtiuSTT11x.PFfjl840hIfbWwhQm42OP21p/VWcUk2','Knw3RQWCRwgmuAtZusBLAv6ouoyDx37E84E0P2SILMZC1c2FHUhgJ8m0LrF3','2017-04-05 22:39:05','2017-04-05 22:39:05'),(32,'Michael','Cai','miccai@bergen.org',0,1,'$2y$10$yXd5LDK60T/8KMSeHTXLy..PC1yDPoPgohym6whxAnM0cctNbj9dK',NULL,'2017-04-06 18:50:01','2017-04-06 18:50:01'),(33,'Aatif','Sayed','aatsay19@bergen.org',0,1,'$2y$10$auGKNiGaNodeOPIxul5jguXu1/vJXSVDJn4D2MMoCExxus/JQQSd.',NULL,'2017-04-06 19:26:32','2017-04-06 19:26:32');
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

-- Dump completed on 2017-05-15 20:31:34
