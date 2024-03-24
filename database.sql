-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: hr3
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employee_jobs`
--

DROP TABLE IF EXISTS `employee_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_jobs`
--

LOCK TABLES `employee_jobs` WRITE;
/*!40000 ALTER TABLE `employee_jobs` DISABLE KEYS */;
INSERT INTO `employee_jobs` VALUES (5,'Software developer','2024-03-23 19:14:42','2024-03-23 19:14:42'),(6,'Backend developer','2024-03-23 19:14:48','2024-03-23 19:14:48'),(7,'Frontend developer','2024-03-23 19:14:53','2024-03-23 19:14:53'),(9,'Full-Stack Developer','2024-03-23 19:15:05','2024-03-23 19:15:05'),(24,'Founder','2024-03-24 02:21:18',NULL);
/*!40000 ALTER TABLE `employee_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_logs`
--

DROP TABLE IF EXISTS `employee_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `employee_id` bigint unsigned DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_logs`
--

LOCK TABLES `employee_logs` WRITE;
/*!40000 ALTER TABLE `employee_logs` DISABLE KEYS */;
INSERT INTO `employee_logs` VALUES (3,NULL,3,'POST','Employee created at User POST endpoint','2024-03-23 19:10:54','2024-03-23 19:10:54'),(9,NULL,9,'POST','Employee created at User POST endpoint','2024-03-23 19:11:42','2024-03-23 19:11:42'),(10,NULL,10,'POST','Employee created at User POST endpoint','2024-03-23 19:11:47','2024-03-23 19:11:47'),(16,NULL,16,'POST','Employee created at User POST endpoint','2024-03-23 19:13:53','2024-03-23 19:13:53'),(53,12,52,'POST','Employee created','2024-03-23 21:41:46','2024-03-23 21:41:46'),(54,NULL,53,'POST','Bulk employee insertion By CSV file',NULL,NULL),(55,NULL,54,'POST','Bulk employee insertion By CSV file',NULL,NULL),(56,NULL,55,'POST','Bulk employee insertion By CSV file',NULL,NULL),(57,NULL,56,'POST','Bulk employee insertion By CSV file',NULL,NULL),(58,NULL,57,'POST','Bulk employee insertion By CSV file',NULL,NULL),(59,NULL,58,'POST','Bulk employee insertion By CSV file',NULL,NULL),(60,NULL,59,'POST','Bulk employee insertion By CSV file',NULL,NULL),(61,NULL,60,'POST','Bulk employee insertion By CSV file',NULL,NULL),(62,NULL,61,'POST','Bulk employee insertion By CSV file',NULL,NULL),(63,NULL,62,'POST','Bulk employee insertion By CSV file',NULL,NULL),(64,NULL,63,'POST','Bulk employee insertion By CSV file',NULL,NULL),(65,12,77,'POST','Employee created','2024-03-23 21:49:43','2024-03-23 21:49:43'),(66,12,NULL,'GET','Download Employee records as CSV file','2024-03-23 21:52:08','2024-03-23 21:52:08'),(67,12,3,'GET','Get Employees by id','2024-03-23 21:52:34','2024-03-23 21:52:34'),(68,12,79,'POST','Employee created','2024-03-23 22:54:07','2024-03-23 22:54:07'),(69,12,81,'POST','Employee created','2024-03-23 22:54:37','2024-03-23 22:54:37'),(70,12,82,'POST','Employee created','2024-03-23 22:55:44','2024-03-23 22:55:44'),(71,12,83,'POST','Employee created','2024-03-23 22:55:46','2024-03-23 22:55:46'),(72,12,84,'POST','Employee created','2024-03-23 22:55:47','2024-03-23 22:55:47'),(73,12,86,'POST','Employee created','2024-03-23 22:56:06','2024-03-23 22:56:06'),(74,12,88,'POST','Employee created','2024-03-23 22:56:22','2024-03-23 22:56:22'),(75,12,90,'POST','Employee created','2024-03-23 22:56:47','2024-03-23 22:56:47'),(76,12,91,'POST','Employee created','2024-03-23 22:57:06','2024-03-23 22:57:06'),(77,12,92,'POST','Employee created','2024-03-23 22:57:29','2024-03-23 22:57:29'),(78,NULL,94,'POST','Employee created at User POST endpoint','2024-03-23 23:02:06','2024-03-23 23:02:06'),(79,46,94,'PATCH','Update Employee','2024-03-23 23:03:34','2024-03-23 23:03:34'),(80,46,94,'PATCH','Update Employee','2024-03-23 23:03:52','2024-03-23 23:03:52'),(81,46,94,'PATCH','Update Employee','2024-03-23 23:08:27','2024-03-23 23:08:27'),(82,46,94,'PATCH','Update Employee','2024-03-23 23:08:44','2024-03-23 23:08:44'),(83,46,94,'PATCH','Update Employee','2024-03-23 23:10:12','2024-03-23 23:10:12'),(84,46,94,'PATCH','Update Employee','2024-03-23 23:10:17','2024-03-23 23:10:17'),(85,46,94,'PATCH','Update Employee','2024-03-23 23:10:49','2024-03-23 23:10:49'),(86,46,94,'PATCH','Update Employee','2024-03-23 23:10:58','2024-03-23 23:10:58'),(87,46,94,'PATCH','Update Employee','2024-03-23 23:11:06','2024-03-23 23:11:06');
/*!40000 ALTER TABLE `employee_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manager_id` bigint unsigned DEFAULT NULL,
  `employee_job_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_manager_id_foreign` (`manager_id`),
  KEY `employees_employee_job_id_foreign` (`employee_job_id`),
  CONSTRAINT `employees_employee_job_id_foreign` FOREIGN KEY (`employee_job_id`) REFERENCES `employee_jobs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (79,'James.Mary',99999.00,'2024-03-23 22:54:07','2024-03-23 22:54:07',NULL,24),(81,'Robert.Patricia',33.00,'2024-03-23 22:54:37','2024-03-23 22:54:37',NULL,7),(82,'David.Elizabeth',6000.00,'2024-03-23 22:55:44','2024-03-23 22:55:44',79,9),(83,'Michael.Linda',33.00,'2024-03-23 22:55:45','2024-03-23 22:55:45',NULL,5),(84,'John.Jennifer',33.00,'2024-03-23 22:55:47','2024-03-23 22:55:47',NULL,5),(86,'William.Barbara',3000.00,'2024-03-23 22:56:06','2024-03-23 22:56:06',82,6),(88,'Richard.Susan',33.00,'2024-03-23 22:56:22','2024-03-23 22:56:22',NULL,7),(90,'Joseph.Jessica',33.00,'2024-03-23 22:56:46','2024-03-23 22:56:46',NULL,9),(91,'Thomas.Sarah',33.00,'2024-03-23 22:57:06','2024-03-23 22:57:06',NULL,9),(92,'Charles.Lisa',33.00,'2024-03-23 22:57:29','2024-03-23 22:57:29',NULL,5),(94,'john.doe',2000.00,'2024-03-23 23:02:06','2024-03-23 23:11:06',86,6);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_employee_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_reset_tokens_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_03_21_182803_add_employee_id_to_users_table',1),(6,'2024_03_21_212520_add_manager_id_to_employees_table',1),(7,'2024_03_22_120423_create_employee_jobs_table',1),(8,'2024_03_22_120621_add_employee_job_id_to_employees_table',1),(9,'2024_03_22_193301_create_employee_logs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (4,'App\\Models\\User',3,'myapptoken','50f6ea07820622d99c7fed5cbbd669891e6a34e90333635999cf9da9d3c31dc7','[\"*\"]',NULL,NULL,'2024-03-23 19:10:54','2024-03-23 19:10:54'),(8,'App\\Models\\User',7,'myapptoken','5777d13e881aa80b82f7be47e9ad9baff891f942a26b720c5200bd23482c9012','[\"*\"]',NULL,NULL,'2024-03-23 19:11:42','2024-03-23 19:11:42'),(9,'App\\Models\\User',8,'myapptoken','f2dfe4e3e73a8de979a04a82de770fcb388d0a4c479d21b267c89882e33d8f46','[\"*\"]',NULL,NULL,'2024-03-23 19:11:47','2024-03-23 19:11:47'),(13,'App\\Models\\User',12,'myapptoken','b36faabdac63a43e55d7f17d84132c8c84a169216b568016edfd858d6618d75b','[\"*\"]',NULL,NULL,'2024-03-23 19:13:53','2024-03-23 19:13:53'),(14,'App\\Models\\User',12,'myapptoken','3ae97483ae4c4297aab268f0c3b51bd312e8b0e2184338346f5b8c8cbffab41a','[\"*\"]','2024-03-23 22:57:29',NULL,'2024-03-23 19:14:01','2024-03-23 22:57:29'),(36,'App\\Models\\User',46,'myapptoken','88762a76baf0edcd0b579392cd3028d679e7bec4e2dbc7c3e507fb4a853d4495','[\"*\"]',NULL,NULL,'2024-03-23 23:02:06','2024-03-23 23:02:06'),(37,'App\\Models\\User',46,'myapptoken','f43d15ed418f2e788e677da6cf1d0b52d9eec0f8dd5c012d7165df4fdee31834','[\"*\"]','2024-03-23 23:11:08',NULL,'2024-03-23 23:02:57','2024-03-23 23:11:08'),(38,'App\\Models\\User',46,'myapptoken','5ac5a152a07713c3dead6dc7a646cf0d246f0a56a63670ada6a195e39966c44a','[\"*\"]',NULL,NULL,'2024-03-23 23:03:12','2024-03-23 23:03:12');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_employee_id_foreign` (`employee_id`),
  CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (36,'James.Mary@gmail.com',NULL,'$2y$12$xN7dmDvuGKbFW.9nNyVIP.V4OTp4XtiTMvbQa0QyOYnr5V.77nNFa',NULL,'2024-03-23 22:54:07','2024-03-23 22:54:07',79),(37,'Robert.Patricia@gmail.com',NULL,'$2y$12$ywPZJREaoqDuuYETJx3NF.itFFymuvlNaUnY.OkS1EntakBHE3K5i',NULL,'2024-03-23 22:54:37','2024-03-23 22:54:37',81),(38,'David.Elizabeth@gmail.com',NULL,'$2y$12$Pdg8RZ4wUETMJ4gmAFsOX.mFqtB58/We9y9N9vMvPNTrhtrG2sWYm',NULL,'2024-03-23 22:55:44','2024-03-23 22:55:44',82),(39,'Michael.Linda@gmail.com',NULL,'$2y$12$78Rierlv32EIu5XoRMwWj.Ln0fHJhSkp.DIShM05RFOvaQg1dXomm',NULL,'2024-03-23 22:55:46','2024-03-23 22:55:46',83),(40,'John.Jennifer@gmail.com',NULL,'$2y$12$gKQdpR8Yts8wlSRDc.XGKOQfmaJeqxzpiL9gX5ADhMdKnVVDnQ5ai',NULL,'2024-03-23 22:55:47','2024-03-23 22:55:47',84),(41,'William.Barbara@gmail.com',NULL,'$2y$12$gqiT1xhit77YGy/303MfGeIUi1jFUWZHLtow8UX9eSoORsNV7GjPO',NULL,'2024-03-23 22:56:06','2024-03-23 22:56:06',86),(42,'Richard.Susan@gmail.com',NULL,'$2y$12$aLQ7st6Je/Vhqsodh6gbQeLaBqfek7vc5.A4SmPLDTQ9FTzWWgwcq',NULL,'2024-03-23 22:56:22','2024-03-23 22:56:22',88),(43,'Joseph.Jessica @gmail.com',NULL,'$2y$12$S0fZxpzBPBp3Rgu.NURm2.8A5eKFAG.86rX3qwO1x.ET7Xo785E6e',NULL,'2024-03-23 22:56:47','2024-03-23 22:56:47',90),(44,'Thomas.Sarah@gmail.com',NULL,'$2y$12$kRBxPFIPv.DrxmdxEPsMPutDxPurraIhWGsVmRXbS1GwejPx2WN9e',NULL,'2024-03-23 22:57:06','2024-03-23 22:57:06',91),(45,'Charles.Lisa@gmail.com',NULL,'$2y$12$DFkksCkPyZrG9ompiDunq.5L0opaso6PWNieezFrHuXJbYHlXVcu.',NULL,'2024-03-23 22:57:29','2024-03-23 22:57:29',92),(46,'john.doe@mail.com',NULL,'$2y$12$pM7NXzxxVcZzRc9diRmbHuaLSodw3UxeVRJ5CbeV0wbRrj78p0jmW',NULL,'2024-03-23 23:02:06','2024-03-23 23:11:06',94);
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

-- Dump completed on 2024-03-24  5:28:04
