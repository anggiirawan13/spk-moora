-- MySQL dump 10.13  Distrib 5.7.21, for Win64 (x86_64)
--
-- Host: localhost    Database: spk_moora
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `alternative_values`
--

DROP TABLE IF EXISTS `alternative_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternative_values` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alternative_id` bigint(20) unsigned NOT NULL,
  `criteria_id` bigint(20) unsigned NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alternative_values_alternative_id_foreign` (`alternative_id`),
  KEY `alternative_values_criteria_id_foreign` (`criteria_id`),
  CONSTRAINT `alternative_values_alternative_id_foreign` FOREIGN KEY (`alternative_id`) REFERENCES `alternatives` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alternative_values_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternative_values`
--

LOCK TABLES `alternative_values` WRITE;
/*!40000 ALTER TABLE `alternative_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `alternative_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alternatives`
--

DROP TABLE IF EXISTS `alternatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternatives` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatives`
--

LOCK TABLES `alternatives` WRITE;
/*!40000 ALTER TABLE `alternatives` DISABLE KEYS */;
/*!40000 ALTER TABLE `alternatives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `license_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `manufacture_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merek` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` int(11) NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas_mesin` int(11) NOT NULL,
  `tipe_car` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_count` int(11) NOT NULL,
  `transmission_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_available` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cars_license_plate_unique` (`license_plate`),
  UNIQUE KEY `cars_nama_unique` (`nama`),
  UNIQUE KEY `cars_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,'B 1234 XYZ','Alphard SC Audioless AT 2012 Hitam','alphard-2012','alphard.jpg',320000000,'2012','Toyota',100000,'Bensin',2400,'MPV',7,'AT','Hitam','Budi Santoso','Jakarta','Mobil dalam kondisi baik','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(2,'B 5678 ABC','Audi A6 2.0 TFSi AT 2012 Putih','audi-a6-2012','audi-a6.jpg',290000000,'2012','Audi',90000,'Bensin',2000,'Sedan',5,'AT','Putih','Andi Wijaya','Bandung','Mesin halus, pajak hidup','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(3,'B 9012 DEF','Avanza Veloz Q TSS AT 2022 Putih','avanza-veloz-2022','avanza.jpg',240000000,'2022','Toyota',20000,'Bensin',1500,'MPV',7,'AT','Putih','Siti Rahma','Surabaya','Kondisi masih sangat baru','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(4,'B 3456 GHI','Ayla X MT 2017 Putih','ayla-2017','ayla.jpg',110000000,'2017','Daihatsu',50000,'Bensin',1000,'Hatchback',5,'MT','Putih','Rudi Hartono','Bekasi','Mobil irit BBM','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(5,'B 7890 JKL','CX 9 GT Facelift AT 2012 Putih','cx9-gt-2012','cx9.jpg',350000000,'2012','Mazda',110000,'Bensin',3700,'SUV',7,'AT','Putih','Joko Susilo','Tangerang','SUV premium dengan kenyamanan maksimal','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(6,'B 1357 MNO','CX7 GT AT 2011 Putih','cx7-gt-2011','cx7.jpg',180000000,'2011','Mazda',120000,'Bensin',2300,'SUV',5,'AT','Putih','Dewi Lestari','Depok','Mobil terawat dengan baik','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(7,'B 2468 PQR','CX9 GT AT 2011 Putih','cx9-gt-2011','cx9-2011.jpg',320000000,'2011','Mazda',130000,'Bensin',3700,'SUV',7,'AT','Putih','Agus Riyadi','Bogor','Siap pakai, mesin halus','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(8,'B 3690 STU','Honda CRV 2.0 AT 2008 Silver','crv-2008','crv.jpg',160000000,'2008','Honda',150000,'Bensin',2000,'SUV',5,'AT','Silver','Slamet Widodo','Yogyakarta','Mobil bekas, kondisi bagus','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(9,'B 7412 VWX','HRV E AT 2016 Silver','hrv-2016','hrv.jpg',240000000,'2016','Honda',70000,'Bensin',1800,'SUV',5,'AT','Silver','Indra Pratama','Semarang','Kondisi mesin terawat','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(10,'B 8523 YZA','Mazda Biante 2.0 Skyactiv AT 2013 Silver','biante-2013','biante.jpg',210000000,'2013','Mazda',90000,'Bensin',2000,'MPV',7,'AT','Silver','Teguh Ramadhan','Malang','Mobil keluarga yang nyaman','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(11,'B 9634 BCD','Mazda Biante 2.0 Skyactiv AT 2017 Hitam','biante-2017','biante-2017.jpg',260000000,'2017','Mazda',60000,'Bensin',2000,'MPV',7,'AT','Hitam','Rizky Aditya','Solo','Kondisi siap jalan','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(12,'B 1745 EFG','Mazda CX5 GT AT 2013 Silver','cx5-gt-2013','cx5.jpg',230000000,'2013','Mazda',100000,'Bensin',2500,'SUV',5,'AT','Silver','Faisal Rahman','Bali','Mobil tangguh dan nyaman','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(13,'B 2856 HIJ','Nissan Teana 2.5 XV CVT 2015 Hitam','teana-2015','teana.jpg',230000000,'2015','Nissan',80000,'Bensin',2500,'Sedan',5,'CVT','Hitam','Sari Dewi','Medan','Mobil mewah dengan CVT','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(14,'B 3967 KLM','Nissan Xtrail 2.0 AT 2014 Hitam','xtrail-2014','xtrail.jpg',200000000,'2014','Nissan',90000,'Bensin',2000,'SUV',5,'AT','Hitam','Denny Wahyu','Makassar','SUV nyaman dan tangguh','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(15,'B 4078 NOP','Teana 2.5 XV AT 2012 Hitam','teana-2012','teana-2012.jpg',210000000,'2012','Nissan',120000,'Bensin',2500,'Sedan',5,'AT','Hitam','Ari Saputra','Pontianak','Mobil sedan premium','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(16,'B 3452 XYZ','Terios TS AT 2017 Hitam','terios-ts-at-2017-hitam','terios_ts_2017.jpg',170000000,'2017','Daihatsu',80000,'Bensin',1500,'SUV',7,'AT','Hitam','Budi Santoso','Jakarta','Terios dalam kondisi baik, siap pakai.','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(17,'B 3452 ABC','Vellfire ZG Premium Sound AT 2012 Hitam','vellfire-zg-premium-sound-at-2012-hitam','vellfire_zg_2012.jpg',450000000,'2012','Toyota',110000,'Bensin',2400,'MPV',7,'AT','Hitam','Andi Wijaya','Bandung','Vellfire full original, premium sound system.','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(18,'B 8345 DEF','VW Tiguan 1.4 TFSi AT 2015 Putih','vw-tiguan-1-4-tfsi-at-2015-putih','vw_tiguan_2015.jpg',260000000,'2015','Volkswagen',80000,'Bensin',1400,'SUV',5,'AT','Putih','Dewi Lestari','Surabaya','VW Tiguan nyaman dan irit bahan bakar.','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(19,'B 7459 GHI','Xtrail 2.0 CVT 2011 Silver','xtrail-2-0-cvt-2011-silver','xtrail_2011_silver.jpg',160000000,'2011','Nissan',130000,'Bensin',2000,'SUV',5,'CVT','Silver','Rudi Hartono','Semarang','Xtrail dengan transmission_type CVT, performa masih bagus.','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(20,'B 7458 JKL','Xtrail 2.5 CVT 2015 Putih','xtrail-2-5-cvt-2015-putih','xtrail_2015_putih.jpg',230000000,'2015','Nissan',90000,'Bensin',2500,'SUV',5,'CVT','Putih','Siti Rahmawati','Medan','Nissan Xtrail siap jalan, kondisi mulus.','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22'),(21,'B 7485 MNO','Xtrail Autech 2.5 AT 2011 Silver','xtrail-autech-2-5-at-2011-silver','xtrail_autech_2011.jpg',200000000,'2011','Nissan',140000,'Bensin',2500,'SUV',5,'AT','Silver','Agus Setiawan','Yogyakarta','Xtrail Autech edisi spesial, kondisi masih prima.','Tersedia','2025-03-27 08:29:22','2025-03-27 08:29:22');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterias`
--

DROP TABLE IF EXISTS `criterias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `atribut` enum('Benefit','Cost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `criterias_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterias`
--

LOCK TABLES `criterias` WRITE;
/*!40000 ALTER TABLE `criterias` DISABLE KEYS */;
/*!40000 ALTER TABLE `criterias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_03_25_031333_create_users_table',1),(2,'2025_03_25_031433_create_cars_table',1),(3,'2025_03_25_031509_create_criterias_table',1),(4,'2025_03_25_031547_create_alternatives_table',1),(5,'2025_03_25_031751_create_personal_access_tokens_table',1),(6,'2025_03_25_031818_create_failed_jobs_table',1),(7,'2025_03_25_031847_create_password_resets_table',1),(8,'2025_03_27_071013_create_alternative_values_table',1);
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'aldi','aldi@admin.com',NULL,'$2y$10$efqQcOlJd5lrUDiFk/nrcOoz8Df4nU/JY9X7vFHEUCS3/MY/1jyuG',1,NULL,'2025-03-27 01:32:33','2025-03-27 01:32:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'spk_moora'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-27 15:39:25
