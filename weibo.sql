-- MySQL dump 10.13  Distrib 5.6.25, for osx10.10 (x86_64)
--
-- Host: localhost    Database: weibo
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `assigned_roles`
--

DROP TABLE IF EXISTS `assigned_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_roles`
--

LOCK TABLES `assigned_roles` WRITE;
/*!40000 ALTER TABLE `assigned_roles` DISABLE KEYS */;
INSERT INTO `assigned_roles` VALUES (1,1,1),(2,2,2);
/*!40000 ALTER TABLE `assigned_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `business_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_mobile` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `business_card` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `business_card_bank` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` VALUES (1,2,'梅长苏','18677778888','1234567890','武汉市武昌区中南支行',1,'','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `loops_id` int(10) unsigned NOT NULL,
  `pictures_id` int(10) unsigned NOT NULL,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `profiles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `numbers` smallint(5) unsigned NOT NULL,
  `stocks` smallint(5) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,2,2,1,'商品名称1','商品介绍1',100.00,100,100,10,'admin','','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,2,2,1,'商品名称2','商品介绍2',50.00,10,10,1,'admin','','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,2,2,1,'商品名称3','商品介绍3',55.00,20,20,-1,'admin','','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,2,2,1,'商品名称4','商品介绍4',80.00,15,15,-2,'admin','不让通过审核','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_follows`
--

DROP TABLE IF EXISTS `goods_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_follows`
--

LOCK TABLES `goods_follows` WRITE;
/*!40000 ALTER TABLE `goods_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_pictures`
--

DROP TABLE IF EXISTS `goods_pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_pictures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL,
  `pictures_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_pictures`
--

LOCK TABLES `goods_pictures` WRITE;
/*!40000 ALTER TABLE `goods_pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops`
--

DROP TABLE IF EXISTS `loops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pictures_id` int(10) unsigned NOT NULL,
  `loops_tags_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `profiles` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `liveness` decimal(8,2) NOT NULL DEFAULT '0.00',
  `types` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `messaged_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loops_title_unique` (`title`),
  KEY `loops_loops_tags_id_foreign` (`loops_tags_id`),
  CONSTRAINT `loops_loops_tags_id_foreign` FOREIGN KEY (`loops_tags_id`) REFERENCES `loops_tags` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops`
--

LOCK TABLES `loops` WRITE;
/*!40000 ALTER TABLE `loops` DISABLE KEYS */;
INSERT INTO `loops` VALUES (1,1,'admin',1,NULL,'圈子助手','有问题找圈子助手',0.00,0,1,'2016-04-13 04:16:51','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,2,'user1',1,1,'精品手工','精品热门手工制品',0.00,1,0,'0000-00-00 00:00:00','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,2,'user1',1,1,'热门手工','热门手工制品',0.00,1,1,'0000-00-00 00:00:00','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,2,'user1',1,3,'木工手工','木工手工制品',0.00,1,1,'0000-00-00 00:00:00','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `loops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_authority`
--

DROP TABLE IF EXISTS `loops_authority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_authority` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `normal_img` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `active_img` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_authority`
--

LOCK TABLES `loops_authority` WRITE;
/*!40000 ALTER TABLE `loops_authority` DISABLE KEYS */;
INSERT INTO `loops_authority` VALUES (1,'圈子商品','xec11','','','cate-goods','admin/path',0,1,0,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,'圈子成员','xea38','','','cate-users','admin/path',0,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,'圈主日记','xec81','','','cate-diary','admin/path',0,1,2,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,'文字','xed59','widget://image/album1.png','widget://image/album2.png','my-text','admin/path',2,1,3,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(5,'图片','xeb04','widget://image/album1.png','widget://image/album2.png','my-img','admin/path',1,1,4,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(6,'照片','xec44','widget://image/album1.png','widget://image/album2.png','my-photo','admin/path',1,1,5,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(7,'商品','xeca0','widget://image/album1.png','widget://image/album2.png','my-goods','admin/path',1,1,6,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(8,'分享商品','xebe4','widget://image/album1.png','widget://image/album2.png','my-share','admin/path',1,1,7,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(9,'添加日记','xeb28','widget://image/album1.png','widget://image/album2.png','my-diary','admin/path',1,1,8,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `loops_authority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_diaries`
--

DROP TABLE IF EXISTS `loops_diaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_diaries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `loops_id` int(10) unsigned NOT NULL,
  `loops_messages_id` int(10) unsigned NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_diaries`
--

LOCK TABLES `loops_diaries` WRITE;
/*!40000 ALTER TABLE `loops_diaries` DISABLE KEYS */;
INSERT INTO `loops_diaries` VALUES (1,1,1,1,'日记1',1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,1,1,2,'日记2',1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `loops_diaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_follows`
--

DROP TABLE IF EXISTS `loops_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `loops_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_follows`
--

LOCK TABLES `loops_follows` WRITE;
/*!40000 ALTER TABLE `loops_follows` DISABLE KEYS */;
INSERT INTO `loops_follows` VALUES (1,2,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,3,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,4,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,5,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(5,6,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(6,7,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(7,8,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `loops_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_messages`
--

DROP TABLE IF EXISTS `loops_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `loops_id` int(10) unsigned NOT NULL,
  `loops_authority_id` int(10) unsigned NOT NULL,
  `contents` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pictures_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_node` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_messages`
--

LOCK TABLES `loops_messages` WRITE;
/*!40000 ALTER TABLE `loops_messages` DISABLE KEYS */;
INSERT INTO `loops_messages` VALUES (1,2,1,4,'消息测试内容1',0,1,'2016-02-07','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,2,1,5,'消息测试内容2',0,1,'2016-02-07','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,2,1,6,'消息测试内容3',0,1,'2016-02-08','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,2,1,7,'消息测试内容4',0,1,'2016-02-08','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(5,2,1,8,'消息测试内容5',0,1,'2016-02-09','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(6,2,1,9,'消息测试内容6',0,1,'2016-02-09','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(7,2,1,4,'消息测试内容7',0,1,'2016-04-13','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(8,2,1,5,'消息测试内容8',0,1,'2016-04-13','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(9,2,1,6,'消息测试内容9',0,1,'2016-04-13','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(10,2,1,7,'消息测试内容10',0,1,'2016-04-13','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(11,2,1,8,'消息测试内容11',0,1,'2016-04-13','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(12,2,1,9,'消息测试内容12',0,1,'2016-04-13','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `loops_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_sets`
--

DROP TABLE IF EXISTS `loops_sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_sets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loops_id` int(10) unsigned NOT NULL,
  `loops_authority_id` int(10) unsigned NOT NULL,
  `types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `loop_roles` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_sets`
--

LOCK TABLES `loops_sets` WRITE;
/*!40000 ALTER TABLE `loops_sets` DISABLE KEYS */;
/*!40000 ALTER TABLE `loops_sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_tags`
--

DROP TABLE IF EXISTS `loops_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loops_tags_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_tags`
--

LOCK TABLES `loops_tags` WRITE;
/*!40000 ALTER TABLE `loops_tags` DISABLE KEYS */;
INSERT INTO `loops_tags` VALUES (1,'热门',10,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,'关注',20,0,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,'手工',0,2,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,'金器',0,3,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `loops_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loops_users`
--

DROP TABLE IF EXISTS `loops_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loops_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loops_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loops_users`
--

LOCK TABLES `loops_users` WRITE;
/*!40000 ALTER TABLE `loops_users` DISABLE KEYS */;
INSERT INTO `loops_users` VALUES (1,1,1,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(2,1,2,0,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(3,2,2,1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(4,1,3,0,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(5,1,4,0,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(6,1,5,0,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(7,1,6,0,1,'2016-04-13 04:16:51','2016-04-13 04:16:51');
/*!40000 ALTER TABLE `loops_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages_pictures_follows`
--

DROP TABLE IF EXISTS `messages_pictures_follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_pictures_follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `messages_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `pictures_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages_pictures_follows`
--

LOCK TABLES `messages_pictures_follows` WRITE;
/*!40000 ALTER TABLE `messages_pictures_follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages_pictures_follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_12_28_171741_create_social_logins_table',1),('2015_12_29_015055_setup_access_tables',1),('2016_01_21_211940_create_jobs_table',1),('2016_01_21_212112_create_users_address_table',1),('2016_01_21_212246_create_pictures_table',1),('2016_01_21_212444_create_loops_tags_table',1),('2016_01_21_212518_create_loops_table',1),('2016_01_21_212619_create_loops_authority_table',1),('2016_01_21_212654_create_loops_sets_table',1),('2016_01_21_212731_create_loops_users_table',1),('2016_01_21_212821_create_loops_messages_table',1),('2016_01_21_212856_create_loops_diarys_table',1),('2016_01_21_212938_create_loops_follows_table',1),('2016_01_21_213024_create_goods_table',1),('2016_01_21_213058_create_goods_follows_table',1),('2016_01_21_213132_create_orders_table',1),('2016_02_18_222638_create_goods_pictures_table',1),('2016_02_18_223053_create_messages_pictures_follows_table',1),('2016_02_23_105040_create_business_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_numbers` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  `users_address_id` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `business_id` int(10) unsigned NOT NULL,
  `pay_types` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'201602080808999990',3,1,1,100.00,1,1,1,'请安全包装好1','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,'201602080808999991',4,1,2,100.00,10,1,1,'请安全包装好2','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,'201602080808999992',5,1,3,100.00,20,1,1,'请安全包装好3','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,'201602080808999993',6,1,4,100.00,80,1,1,'请安全包装好4','2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_dependencies`
--

DROP TABLE IF EXISTS `permission_dependencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_dependencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `dependency_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_dependencies_permission_id_foreign` (`permission_id`),
  KEY `permission_dependencies_dependency_id_foreign` (`dependency_id`),
  CONSTRAINT `permission_dependencies_dependency_id_foreign` FOREIGN KEY (`dependency_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_dependencies_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_dependencies`
--

LOCK TABLES `permission_dependencies` WRITE;
/*!40000 ALTER TABLE `permission_dependencies` DISABLE KEYS */;
INSERT INTO `permission_dependencies` VALUES (1,2,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(2,3,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(3,3,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(4,4,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(5,4,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(6,5,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(7,5,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(8,6,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(9,6,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(10,7,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(11,7,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(12,8,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(13,8,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(14,9,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(15,9,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(16,10,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(17,10,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(18,11,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(19,11,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(20,12,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(21,12,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(22,13,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(23,13,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(24,14,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(25,14,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(26,15,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(27,15,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(28,16,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(29,16,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(30,17,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(31,17,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(32,18,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(33,18,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(34,19,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(35,19,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(36,20,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(37,20,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(38,21,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(39,21,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(40,22,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(41,22,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(42,23,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(43,23,2,'2016-04-13 04:16:51','2016-04-13 04:16:51');
/*!40000 ALTER TABLE `permission_dependencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_groups`
--

LOCK TABLES `permission_groups` WRITE;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
INSERT INTO `permission_groups` VALUES (1,NULL,'Access','',1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(2,1,'User','',1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(3,1,'Role','',2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(4,1,'Permission','',3,'2016-04-13 04:16:51','2016-04-13 04:16:51');
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  KEY `permission_user_user_id_foreign` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,1,'view-backend','View Backend',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(2,1,'view-access-management','View Access Management',1,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(3,2,'create-users','Create Users',1,5,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(4,2,'edit-users','Edit Users',1,6,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(5,2,'delete-users','Delete Users',1,7,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(6,2,'change-user-password','Change User Password',1,8,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(7,2,'deactivate-users','Deactivate Users',1,9,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(8,2,'reactivate-users','Re-Activate Users',1,11,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(9,2,'undelete-users','Restore Users',1,13,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(10,2,'permanently-delete-users','Permanently Delete Users',1,14,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(11,2,'resend-user-confirmation-email','Resend Confirmation E-mail',1,15,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(12,3,'create-roles','Create Roles',1,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(13,3,'edit-roles','Edit Roles',1,3,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(14,3,'delete-roles','Delete Roles',1,4,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(15,4,'create-permission-groups','Create Permission Groups',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(16,4,'edit-permission-groups','Edit Permission Groups',1,2,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(17,4,'delete-permission-groups','Delete Permission Groups',1,3,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(18,4,'sort-permission-groups','Sort Permission Groups',1,4,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(19,4,'create-permissions','Create Permissions',1,5,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(20,4,'edit-permissions','Edit Permissions',1,6,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(21,4,'delete-permissions','Delete Permissions',1,7,'2016-04-13 04:16:51','2016-04-13 04:16:51');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foreign_id` int(10) unsigned NOT NULL,
  `path` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `types` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
INSERT INTO `pictures` VALUES (1,2,'http://7u2i5s.com1.z0.glb.clouddn.com/photo2.png','photo2.png',3,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(2,3,'http://7u2i5s.com1.z0.glb.clouddn.com/photo2.png','photo2.png',3,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(3,4,'http://7u2i5s.com1.z0.glb.clouddn.com/photo2.png','photo2.png',3,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(4,5,'http://7u2i5s.com1.z0.glb.clouddn.com/photo2.png','photo2.png',3,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(5,2,'http://7u2i5s.com1.z0.glb.clouddn.com/avatar.png','avatar.png',4,1,'2016-04-13 04:16:51','2016-04-13 04:16:51');
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51'),(2,'User',0,2,'2016-04-13 04:16:51','2016-04-13 04:16:51');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_logins`
--

DROP TABLE IF EXISTS `social_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `social_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_logins`
--

LOCK TABLES `social_logins` WRITE;
/*!40000 ALTER TABLE `social_logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `im_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headimgurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `loop_roles` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `business_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_token_unique` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@admin.com','dcddb75469b4b4875094e14561e573d8','OnAj14mj+KyT2MdrBmn8VKyyMrwDXa64MWV3iah+6ur4uV9niaU05gJQ9XgX7mSFv8sMVErIoSS+bwbSG1TNJw==','18088889990','$2y$10$ZvXsyOGsueWD9DyWtNIvR.hwrXA1cOtBn7uv9IQMlUPT2u2c0qK5K',1,'262548d6902acecc670caa534d9e343b',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,10,0,'2016-04-13 04:16:50','2016-04-13 04:16:50',NULL),(2,'user1','user1@user.com','4c68cea7e58591b579fd074bcdaff740','pEQo7r95MIU7icC7S51kqqyyMrwDXa64MWV3iah+6ur4uV9niaU05r2QdtTHmFtkncEXGoyEYEi+bwbSG1TNJw==','18088889991','$2y$10$4PXzz0SFag0SkoWYKbOc7.vQVOca7u4XIqZtw68s7oSHsPBsEEQI2',1,'fb15d9b6a74a9d72cfd7fe563aec6470',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,10,1,'2016-04-13 04:16:50','2016-04-13 04:16:50',NULL),(3,'user2','user2@user.com','db7282901da891bea2fcd73840caad1c','rYt0VWdSUn5ivZkp2JHq0vvqbh7SGufJG+8M5S5YFJLDgn3iGDZGzfYkWcT5SVdLSqyM1bBilfzEQ7zULdkZqA==','18088889992','$2y$10$UGSCmJgjV1yesQtdoIEvgOEoCpsGMuPUJSfwuqXXmIv96hZE2tz4C',1,'d75b1a7005a371dd7c67781ebdb579fc',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,0,0,'2016-04-13 04:16:50','2016-04-13 04:16:50',NULL),(4,'user3','user3@user.com','e08599ba76fe6afa2b5786d857b0f56e','ltarjh6qcf4El9zQlUf8Kvvqbh7SGufJG+8M5S5YFJLDgn3iGDZGzUXi0c7vtseIe745U566ZtHEQ7zULdkZqA==','18088889993','$2y$10$h2.pUedUx06rb1z4It0yweTeIWdmPFJzJZvgrNDaaYBPdTMuwo8jq',1,'dd34e4955bbaeb133ea600552fea96d3',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,0,0,'2016-04-13 04:16:50','2016-04-13 04:16:50',NULL),(5,'user4','user4@user.com','9cc16a0bb48e3e50c4fd9c79444b393b','0wgei7sPHvdrqPFo26XaPQoDrFOJwk/zSR6u2VdP5E5zR4ZvMnWSNV/6of73wsUP5UGlRWVmyUQ=','18088889994','$2y$10$fLworfLza6v30.nMF1CiEurFumrQXgQ2CrogtKIhuRVSQfNPKlikW',1,'442541475c601df25499b0ad5629c304',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,0,0,'2016-04-13 04:16:50','2016-04-13 04:16:50',NULL),(6,'user5','user5@user.com','e72581f8614727a152dec6fcfc739ad2','unVaLETZwfZlwoFR1pnJLfvqbh7SGufJG+8M5S5YFJLDgn3iGDZGzS0aikL8Z5zrp3LZkO4RvWvEQ7zULdkZqA==','18088889995','$2y$10$fznLtW.CB0zYqB4ZaotRz.7s9qU9UA7eVGGAah3hQR.932EesBh0i',1,'fbba2ed2c64b7177767b1bb3b32172e4',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,0,0,'2016-04-13 04:16:50','2016-04-13 04:16:50',NULL),(7,'user6','user6@user.com','7a77584182a904bb75558a6bc911dd6e','dDXwfj85BrWGJA3NaNjAQqyyMrwDXa64MWV3iah+6ur4uV9niaU05kIV7zlT2de3qGjJE196ewC+bwbSG1TNJw==','18088889996','$2y$10$WZulueUjQ0pgLLftZRGJq.VwKTQN5Lk6V47C4dCR32IRRdiuv5PA.',1,'a4c1a9e8b5fb110dfdcc7926625c8e6b',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,0,0,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(8,'user7','user7@user.com','3354cbe0f7e1dbc43916af419085f9c4','GadbhCRcy6WNhoypxzBVZ6yyMrwDXa64MWV3iah+6ur4uV9niaU05iATCgkpKQAcSLYFysOCVMe+bwbSG1TNJw==','18088889997','$2y$10$VtHM09abptiWalF3Jbo51.0/pwmzIvErcHnH7M40a7ceQ80LTO6nu',1,'5293a5b19e3dce1937cfbe5ce577d510',1,NULL,0,'','http://wx.qlogo.cn/mmopen/1dCSBBR6ecduibqSsd6zRHOVUdbkLyzuiaQDZynScbXmmuLR96k43RcibDvm7WlddTexAzdSy1KXfggGbabznYSKjeNaYcUHtYD/0','','','',0,0,0,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_address`
--

DROP TABLE IF EXISTS `users_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` int(10) unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `types` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_address`
--

LOCK TABLES `users_address` WRITE;
/*!40000 ALTER TABLE `users_address` DISABLE KEYS */;
INSERT INTO `users_address` VALUES (1,3,'湖北省武汉市武昌区楚河汉街1','123456',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(2,4,'湖北省武汉市武昌区楚河汉街2','123456',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(3,5,'湖北省武汉市武昌区楚河汉街3','123456',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL),(4,6,'湖北省武汉市武昌区楚河汉街4','123456',1,1,'2016-04-13 04:16:51','2016-04-13 04:16:51',NULL);
/*!40000 ALTER TABLE `users_address` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-13 12:20:51
