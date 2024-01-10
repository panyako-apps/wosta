-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: wostac
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.23.04.1

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
-- Table structure for table `callbacks`
--

DROP TABLE IF EXISTS `callbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `callbacks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `callbacks`
--

LOCK TABLES `callbacks` WRITE;
/*!40000 ALTER TABLE `callbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `callbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
  KEY `comments_user_id_foreign` (`user_id`),
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_values`
--

DROP TABLE IF EXISTS `core_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `core_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_values`
--

LOCK TABLES `core_values` WRITE;
/*!40000 ALTER TABLE `core_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `core_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '1',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_user_id_foreign` (`user_id`),
  KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`),
  CONSTRAINT `images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `likeable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`),
  CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_06_20_100949_create_images_table',1),(6,'2022_06_21_101600_create_post_categories_table',1),(7,'2022_06_21_102547_create_posts_table',1),(8,'2022_06_21_114411_create_views_table',1),(9,'2022_06_21_125404_create_likes_table',1),(10,'2022_06_21_125722_create_comments_table',1),(11,'2022_06_22_060139_create_service_categories_table',1),(12,'2022_06_22_060256_create_services_table',1),(13,'2022_06_27_140144_create_videos_table',1),(14,'2022_07_02_222338_create_roles_table',1),(15,'2022_07_02_222529_create_role_user_table',1),(16,'2022_11_25_190756_create_user_profiles_table',1),(17,'2023_04_17_132356_create_staff_table',1),(18,'2023_04_20_223046_create_rates_table',1),(19,'2023_04_26_181349_create_callbacks_table',1),(20,'2023_04_28_083336_create_pages_table',1),(21,'2023_05_09_212142_create_notifications_table',1),(22,'2023_08_16_270951_create_messages_table',1),(23,'2023_08_31_115201_create_slideshows_table',1),(24,'2023_08_31_115208_create_slides_table',1),(25,'2023_09_01_075513_create_site_settings_table',1),(26,'2023_09_01_084617_create_core_values_table',1),(27,'2024_01_08_080338_create_testimonials_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sections` json DEFAULT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_name_unique` (`name`),
  KEY `pages_user_id_foreign` (`user_id`),
  CONSTRAINT `pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,1,'home','[{\"name\": \"Section 1\", \"image\": \"about-section1.jpg\", \"intro\": \"Welcome to Wostac <span class=\\\"title-secondary\\\">Consult</span>.\", \"title\": \"Welcome\", \"footer\": \"\", \"points\": [\"Providers of top quality career counseling and advisory services\", \"Providers of best student placement opportunities\", \"Easy approval by choosing top visa consultant\"], \"description\": \"<p>Wosta Consult is a premier global agency for education, migration, and internship solutions. We specialize in guiding individuals towards their academic, professional, and personal goals on a global scale. Our expert team ensures a seamless transition into top-notch educational programs worldwide, providing comprehensive support for undergraduate and postgraduate studies, assisting in visa processes and connecting individuals with placements that align with their career goals.</p>\"}, {\"name\": \"Section 2\", \"image\": \"\", \"intro\": \"We provide expert <span class=\\\"title-secondary\\\">Services</span>.\", \"title\": \"Our Services\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 3\", \"image\": \"home-section3.jpg\", \"intro\": \"We provide expert advisory services on <span class=\\\"title-secondary\\\">work & study</span> placements.\", \"title\": \"What We Do\", \"footer\": \"\", \"points\": [], \"description\": \"<p>Wosta Consult, specializes in delivering expert advisory services on work and study placements. We are dedicated to guiding individuals through the intricate landscapes of international opportunities, smoothly blending academic pursuits with professional growth. Our team of seasoned advisors is committed to offering personalized insights, ensuring that every step of your journey towards work and study abroad is informed and strategically planned.</p>\"}, {\"name\": \"Section 4\", \"image\": \"\", \"intro\": \"Study in Your Dream <span class=\\\"title-secondary\\\">Country</span>.\", \"title\": \"Favourite Destinations\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 5\", \"image\": \"home-section3.jpg\", \"intro\": \"Feedback from <span class=\\\"title-secondary\\\">Clients</span>.\", \"title\": \"Testimonials\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 6\", \"image\": \"\", \"intro\": \"\", \"title\": \"\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 7\", \"image\": \"\", \"intro\": \"Get informed from our pool of <span class=\\\"title-secondary\\\">resourceful articles</span>.\", \"title\": \"Latest News\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 8\", \"image\": \"\", \"intro\": \"\", \"title\": \"\", \"footer\": \"\", \"description\": \"\"}]',0,NULL,NULL,'2024-01-09 01:29:23','2024-01-09 04:10:09'),(2,1,'about','[{\"name\": \"Section 1\", \"image\": \"about-section1.jpg\", \"intro\": \"Why choose Wostac <span class=\\\"title-secondary\\\">Consult</span>.\", \"title\": \"Why choose us\", \"footer\": \"\", \"points\": [\"Providers of top quality career counseling and advisory services\", \"Providers of best student placement opportunities\", \"Easy approval by choosing top visa consultant\"], \"description\": \"<p>Selecting Wosta Consult means opting for a dynamic and personalized approach to your international work and study experience. Our dedicated team ensures a smooth transition into top-notch academic programs, provides tailored migration services, and connects individuals with enriching work and internship opportunities worldwide. At Wosta Consult, we prioritize your unique aspirations, offering comprehensive support to shape a brighter future through a combined work and study abroad experience.&nbsp;</p>\"}, {\"name\": \"Section 2\", \"image\": \"\", \"intro\": \"We create solutions for your future <span class=\\\"title-secondary\\\">education & travel</span>\", \"title\": \"What we offer\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 3\", \"image\": \"\", \"intro\": \"Discover Wostac\'s <span class=\\\"title-secondary\\\">Experts</span>\", \"title\": \"Our Team Members\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 4\", \"image\": \"\", \"intro\": \"\", \"title\": \"\", \"footer\": \"\", \"description\": \"\"}, {\"name\": \"Section 5\", \"image\": \"\", \"intro\": \"\", \"title\": \"\", \"footer\": \"\", \"description\": \"\"}]',0,NULL,NULL,'2024-01-09 01:29:23','2024-01-09 03:55:55');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
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
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `parent_id` int DEFAULT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_categories_user_id_foreign` (`user_id`),
  CONSTRAINT `post_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (1,NULL,'Latest News','latest-news',NULL,NULL,NULL,1,NULL,NULL,NULL,'2024-01-09 01:29:20','2024-01-09 01:29:20');
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `post_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,1,'Navigating Visa Processes for International Students','Navigating Visa Processes for International Students\n                Studying abroad is an exciting and transformative experience for students around the world. However, before embarking on this journey, it\'s crucial for international students to navigate the visa application process successfully. In this comprehensive guide, we\'ll walk you through the key steps and requirements involved in obtaining a student visa.\n                \n                Understanding the Basics\n                What is a Student Visa?\n                A student visa is a legal document that allows foreign nationals to study in a specific country for a designated period. It is essential for international students planning to pursue academic programs, language courses, or research activities abroad.\n                \n                Types of Student Visas\n                Different countries may have various types of student visas, each tailored to specific academic pursuits. It\'s essential to identify the correct visa category based on your intended course of study.\n                \n                Steps to Obtain a Student Visa\n                1. Choose Your Destination\n                Research and select the country and educational institution that best aligns with your academic and personal goals. Each country may have unique visa application processes, so understanding your destination is crucial.\n                \n                2. Confirm Admission\n                Before applying for a student visa, ensure you have received admission to a recognized educational institution. Most countries require proof of acceptance as part of the visa application.\n                \n                3. Gather Required Documents\n                Compile all necessary documents, including proof of acceptance, a valid passport, financial statements, and any additional materials specified by the embassy or consulate. Thoroughly review the visa application requirements for your chosen destination.\n                \n                4. Financial Proof\n                Many countries require evidence of financial capability to cover tuition fees, living expenses, and other related costs. Prepare bank statements or sponsorship letters to demonstrate your financial readiness.\n                \n                5. Health Insurance\n                Some countries mandate international students to have health insurance coverage. Ensure you have the necessary health insurance documentation as part of your visa application.\n                \n                6. Language Proficiency\n                If your course of study is in a language other than your native language, you may need to provide proof of language proficiency through standardized tests like the TOEFL or IELTS.\n                \n                7. Visa Application Submission\n                Submit your visa application well in advance of your intended departure date. Pay attention to processing times and any additional requirements specified by the embassy or consulate.\n                \n                8. Attend Visa Interview\n                In some cases, a visa interview may be required. Be prepared to discuss your academic plans, financial stability, and other relevant details.\n                \n                9. Visa Approval\n                Once your visa is approved, you\'ll receive a stamped visa on your passport. Review the visa conditions and ensure compliance throughout your stay.\n                \n                Tips for a Successful Visa Application\n                Start Early: Begin the visa application process as soon as you receive your acceptance letter to avoid delays.\n                Double-Check Requirements: Thoroughly review the visa requirements for your chosen destination to avoid missing any essential documents.\n                Seek Guidance: Reach out to your chosen educational institution or local embassy for guidance on the visa application process.\n                Conclusion\n                Successfully navigating the visa application process is a crucial step for international students planning to study abroad. By understanding the requirements, gathering necessary documents, and following the application steps diligently, you can embark on your educational journey with confidence.\n                \n                Remember, each country\'s visa process may vary, so it\'s essential to stay informed and seek guidance from reliable sources. Best of luck on your study abroad adventure!','visa_process.jpg','navigating-visa-processes-for-international-students','visa, study-abroad, international-students',0,1,NULL,NULL,NULL,'2024-01-09 01:29:20','2024-01-09 01:29:20'),(2,1,1,'Passport Essentials: A Guide for Students Abroad','Passport Essentials: A Guide for Students Abroad\n                Embarking on a study abroad journey is a thrilling adventure that requires careful planning, and one essential element of that preparation is ensuring your passport is in order. Your passport is your key to the world, and having the right documentation is crucial for a smooth and successful study abroad experience. In this guide, we\'ll cover the passport essentials every student should know before heading abroad.\n                \n                Understanding the Basics\n                What is a Passport?\n                A passport is an official government document that certifies your identity and citizenship. It allows you to travel internationally and serves as a vital piece of identification when you are in a foreign country.\n                \n                Passport Types\n                There are various types of passports, including standard passports, diplomatic passports, and official passports. As a student, you will likely need a standard passport for personal travel.\n                \n                Passport Essentials for Students Abroad\n                1. Check Passport Expiry Date\n                Before making any travel plans, check the expiry date on your passport. Many countries require your passport to be valid for at least six months beyond your planned return date.\n                \n                2. Renew Your Passport if Necessary\n                If your passport is close to expiring or has already expired, consider renewing it well in advance. Renewal processes may vary by country, so be sure to check the requirements specific to your home country.\n                \n                3. Check Visa Requirements\n                Some countries require a visa in addition to a valid passport. Research and understand the visa requirements for your destination and initiate the application process early if needed.\n                \n                4. Make Copies of Important Pages\n                Before leaving, make photocopies or digital copies of the information page and any visa pages in your passport. Keep these copies separate from your actual passport; they can be invaluable in case of loss or theft.\n                \n                5. Passport Photos\n                Ensure you have recent passport-sized photos that meet the requirements of your home country and the country you will be studying in. These may be needed for visa applications or other official documentation.\n                \n                6. Check Entry and Exit Requirements\n                Some countries have specific entry and exit requirements, such as proof of vaccinations or travel insurance. Research and prepare any additional documents required by your destination.\n                \n                7. Keep Your Passport Secure\n                While abroad, keep your passport in a secure location, such as a hotel safe. Avoid carrying it unnecessarily, and consider using a money belt or neck pouch for added security.\n                \n                8. Emergency Contacts and Consulate Information\n                Write down the contact information for your country\'s embassy or consulate in the country you\'re visiting. This information can be crucial in case of an emergency.\n                \n                9. Digital Backup\n                Consider creating a digital backup of your passport. Save a scanned copy or take clear photos of all relevant pages and store them securely in cloud storage or email them to yourself.\n                \n                Conclusion\n                Ensuring your passport is in order is a fundamental step in the study abroad preparation process. By taking the time to check and fulfill these passport essentials, you\'ll contribute to a stress-free and enjoyable experience during your time studying in a foreign country.\n                \n                Remember, each country may have specific requirements, so it\'s crucial to research and plan accordingly. Safe travels and enjoy your study abroad adventure!','passport_guide.jpg','passport-essentials-guide-for-students-abroad','passport, study-abroad, students',0,1,NULL,NULL,NULL,'2024-01-09 01:29:20','2024-01-09 01:29:20'),(3,1,1,'Top Study Abroad Destinations for Global Students','Top Study Abroad Destinations for Global Students\n                Embarking on a journey to study abroad opens up a world of opportunities for personal growth, cultural enrichment, and academic excellence. Choosing the right destination is a crucial decision that can shape your entire experience. In this guide, we explore some of the top study abroad destinations that cater to the diverse needs and preferences of global students.\n                \n                1. United States\n                The United States consistently ranks among the top study abroad destinations, attracting students with its world-renowned universities, diverse academic programs, and vibrant cultural scene. From the bustling city life to serene campuses, the U.S. offers a broad spectrum of experiences for international students.\n                \n                2. United Kingdom\n                Known for its rich history, prestigious institutions, and cultural diversity, the United Kingdom remains a popular choice for global students. Whether you choose the historic streets of Oxford or the cosmopolitan atmosphere of London, the U.K. provides an excellent education and a chance to explore centuries-old traditions.\n                \n                3. Canada\n                Canada\'s welcoming environment, high-quality education, and stunning landscapes make it an attractive destination for global students. With a focus on inclusivity and innovation, Canadian universities offer a variety of programs to suit different academic interests.\n                \n                4. Australia\n                Home to world-class universities and a laid-back lifestyle, Australia is a top choice for those seeking a balance between academic excellence and outdoor adventures. The country\'s diverse ecosystems, vibrant cities, and friendly locals create an enriching environment for international students.\n                \n                5. Germany\n                Renowned for its engineering and technology programs, Germany attracts global students with its tuition-free or low-cost education system. With a strong emphasis on research and innovation, German universities provide a unique academic experience in the heart of Europe.\n                \n                6. Japan\n                For students interested in cutting-edge technology, traditional culture, and a unique study experience, Japan is an excellent destination. Japanese universities are known for their research contributions and the opportunity to immerse yourself in a captivating blend of old and new.\n                \n                7. Netherlands\n                With a high standard of living and a strong commitment to internationalization, the Netherlands is a top choice for global students. Dutch universities offer a wide range of English-taught programs, and the country\'s bike-friendly cities add to the overall appeal.\n                \n                8. Sweden\n                Sweden combines a high-quality education system with a focus on sustainability and innovation. The country\'s natural beauty, commitment to social equality, and progressive values make it an attractive destination for those seeking a unique study abroad experience.\n                \n                9. Singapore\n                As a global hub for business and technology, Singapore has emerged as a key player in higher education. Its strategic location, diverse population, and strong emphasis on research make it an exciting destination for global students.\n                \n                10. New Zealand\n                Known for its stunning landscapes and friendly locals, New Zealand offers a welcoming environment for global students. The country\'s universities provide a range of programs, and the outdoor adventures are an added bonus for those who love nature.\n                \n                Conclusion\n                Choosing a study abroad destination is a significant decision that involves considering academic offerings, cultural experiences, and personal preferences. Each of these top study abroad destinations has its unique charm and advantages, providing global students with an enriching and transformative educational experience.\n                \n                Whether you\'re drawn to the vibrant energy of the United States, the historical charm of the United Kingdom, or the innovative spirit of Germany, there\'s a perfect study abroad destination waiting to welcome you into its diverse and dynamic academic community. Explore, learn, and make the most of this exciting journey!','top_destinations.jpg','top-study-abroad-destinations-for-global-students','study-abroad, global-students, education',0,1,NULL,NULL,NULL,'2024-01-09 01:29:21','2024-01-09 01:29:21'),(4,1,1,'Student Visa Interviews: What to Expect','Student Visa Interviews: What to Expect\n                The student visa interview is a crucial step in the process of studying abroad. It\'s a chance for the immigration officials to get to know you better and ensure that you meet all the requirements for studying in their country. In this guide, we\'ll explore what to expect during a student visa interview and provide tips to help you prepare for this important conversation.\n                \n                Understanding the Purpose\n                Why a Visa Interview?\n                The primary purpose of the student visa interview is to assess the genuineness of your intentions to study abroad. Immigration officials want to ensure that you are a legitimate student with sincere plans to pursue your education and that you will comply with the rules and regulations of the host country.\n                \n                What to Expect During the Interview\n                1. Documentation Review\n                The interview will likely begin with the official reviewing your documentation, including your passport, visa application, acceptance letter from the educational institution, financial statements, and any other required documents. Make sure to organize your papers beforehand.\n                \n                2. Personal Questions\n                Be prepared to answer personal questions about your background, educational history, and reasons for choosing the specific course and institution. Immigration officials may ask about your future plans, career goals, and how the chosen program aligns with your aspirations.\n                \n                3. Financial Ability\n                Expect questions related to your financial capacity to fund your education and stay in the country. Be ready to discuss how you plan to cover tuition fees, living expenses, and any other financial obligations.\n                \n                4. Ties to Home Country\n                Immigration officials may inquire about your ties to your home country, such as family, property, or job commitments. They want assurance that you have reasons to return home after completing your studies.\n                \n                5. Language Proficiency\n                If your destination country has a language requirement, be prepared to demonstrate your language proficiency. This may involve answering questions or taking a language proficiency test.\n                \n                6. Study Plans\n                Articulate your study plans clearly. Be ready to discuss why you chose a particular course, how it aligns with your career goals, and why you selected that specific educational institution.\n                \n                Tips for a Successful Interview\n                1. Be Prepared\n                Thoroughly research the visa requirements and be familiar with the documents you need to present. Practice common interview questions and have concise, confident answers.\n                \n                2. Dress Professionally\n                Wear professional attire to convey a serious and respectful demeanor. First impressions matter, and dressing appropriately can leave a positive impact.\n                \n                3. Stay Calm and Confident\n                While the process can be nerve-wracking, try to remain calm and confident. Speak clearly and maintain eye contact. Remember that the officials are there to evaluate your suitability as a student, not to intimidate you.\n                \n                4. Be Honest\n                Honesty is crucial during the interview. Provide truthful and accurate information. If you don\'t know the answer to a question, it\'s okay to say so.\n                \n                5. Follow-Up Questions\n                Be prepared for follow-up questions based on your initial responses. Immigration officials may seek clarification or additional details.\n                \n                Conclusion\n                The student visa interview is a pivotal step in your journey to study abroad. By understanding what to expect and preparing thoroughly, you can increase your chances of a successful interview. Approach the process with confidence, honesty, and a genuine enthusiasm for your educational pursuits. Good luck!','visa_interview.jpg','student-visa-interviews-what-to-expect','visa, interview, students',0,1,NULL,NULL,NULL,'2024-01-09 01:29:21','2024-01-09 01:29:21'),(5,1,1,'Scholarship Opportunities for International Students Abroad','Scholarship Opportunities for International Students Abroad\n                Securing financial support for your international education is a key concern for many students. Scholarships provide an excellent avenue to alleviate the financial burden and make studying abroad more accessible. In this guide, we\'ll explore various scholarship opportunities available for international students and provide tips on how to enhance your chances of securing funding for your academic journey.\n                \n                Types of Scholarships\n                1. Merit-Based Scholarships\n                These scholarships are awarded based on academic achievements, such as high grades, standardized test scores, or outstanding achievements in a particular field.\n                \n                2. Need-Based Scholarships\n                Need-based scholarships take into account a student\'s financial need. Eligibility is often determined by factors like family income, assets, and other financial considerations.\n                \n                3. Country-Specific Scholarships\n                Many countries offer scholarships to attract international students. These may be funded by the government, educational institutions, or private organizations.\n                \n                4. Subject-Specific Scholarships\n                Some scholarships are specific to certain fields of study. If you excel in a particular subject or have a passion for a specific field, you may find scholarships tailored to your academic interests.\n                \n                5. Cultural Exchange Scholarships\n                Cultural exchange scholarships promote cross-cultural understanding by providing opportunities for students to study abroad and immerse themselves in a new cultural environment.\n                \n                Tips for Finding and Applying for Scholarships\n                1. Start Early\n                Begin your scholarship search well in advance of your intended study abroad date. Some scholarship deadlines may be months before the academic year begins.\n                \n                2. Research Extensively\n                Explore scholarship databases, university websites, and government programs to identify potential opportunities. Consider both local and international scholarship options.\n                \n                3. Check Eligibility Criteria\n                Carefully review the eligibility criteria for each scholarship. Ensure that you meet the academic, financial, and any other specific requirements.\n                \n                4. Prepare a Strong Application\n                Craft a compelling scholarship application that highlights your achievements, goals, and the impact studying abroad will have on your academic and personal development.\n                \n                5. Seek Guidance\n                Reach out to academic advisors, mentors, or scholarship counselors for guidance on the application process. They can provide valuable insights and help you present your best self in your application.\n                \n                6. Write a Stellar Personal Statement\n                Many scholarship applications require a personal statement. Use this opportunity to showcase your passion, aspirations, and the unique qualities that make you an ideal candidate.\n                \n                7. Apply to Multiple Scholarships\n                Cast a wide net by applying to multiple scholarships. This increases your chances of securing financial support and allows you to explore various opportunities.\n                \n                8. Follow Instructions Carefully\n                Adhere to all application instructions and deadlines. Submit a complete and error-free application to make a positive impression on scholarship committees.\n                \n                Conclusion\n                Scholarships play a vital role in making international education accessible to students from diverse backgrounds. By diligently researching, applying, and presenting your qualifications effectively, you can increase your chances of securing the financial support needed to pursue your academic goals abroad.\n                \n                Remember to stay proactive, leverage available resources, and showcase your unique strengths and accomplishments in your scholarship applications. Wishing you success in your pursuit of scholarship opportunities for your international education journey!','scholarship_opportunities.jpg','scholarship-opportunities-for-international-students-abroad','scholarship, international-students, education',0,1,NULL,NULL,NULL,'2024-01-09 01:29:21','2024-01-09 01:29:21');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rateable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rateable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rates_rateable_type_rateable_id_index` (`rateable_type`,`rateable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rates`
--

LOCK TABLES `rates` WRITE;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,NULL,NULL),(2,3,1,NULL,NULL),(3,1,2,NULL,NULL),(4,3,2,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrator',0,NULL,NULL,NULL,'2024-01-09 01:29:22','2024-01-09 01:29:22'),(2,'author',0,NULL,NULL,NULL,'2024-01-09 01:29:23','2024-01-09 01:29:23'),(3,'editor',0,NULL,NULL,NULL,'2024-01-09 01:29:23','2024-01-09 01:29:23');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_categories`
--

DROP TABLE IF EXISTS `service_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_categories_slug_unique` (`slug`),
  KEY `service_categories_user_id_foreign` (`user_id`),
  CONSTRAINT `service_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_categories`
--

LOCK TABLES `service_categories` WRITE;
/*!40000 ALTER TABLE `service_categories` DISABLE KEYS */;
INSERT INTO `service_categories` VALUES (1,1,NULL,'Core Services','core-services','coreservices.jpg','Our core services',1,NULL,NULL,NULL,'2024-01-09 01:29:21','2024-01-09 01:29:21');
/*!40000 ALTER TABLE `service_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `service_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  KEY `services_user_id_foreign` (`user_id`),
  CONSTRAINT `services_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,1,'Pre-Departure Counselling','pre-departure-counselling','We provide guidance and support to students planning to travel or move to a new country. The goal is to ensure that the students are well-informed and prepared for the transition,  practically and emotionally.\n\n                If you are anxious about settling in a new country.  we’re here to assist you to navigate all that.\n                \n                You are finally off to a great new adventure, congratulations! We know it seems a little daunting but trust us, the best is yet to come. And we are here to support you all the way.\n                \n                To help you  be prepared for life in a new country with new people, our session covers but is not limited to; From visiting to belonging, Insights into the local culture, Student life in your new country, Culture shock, Support and well-being in your new country, Banking and foreign exchange, Working while you study and advice on internships, Dealing with homesickness, Brush up on legalities among others\n                \n                We will help students feel more prepared and confident in their decision to travel or move to a new country. \n                \n                Join us for cultural growth opportunities while you’re abroad.','pre-departure-counselling.jpg','',1,1,NULL,NULL,NULL,'2024-01-09 01:29:21','2024-01-09 01:29:21'),(2,1,1,'Career pathway counselling','career-pathway-counselling','Career pathway consulting involves working to help you identify your career goals, assess their strengths and weaknesses, and develop a plan to achieve those goals.\n\n                As a career pathway consultant, our primary goal is to help you maximize your potential and find meaningful work that aligns with your interests, skills, and values.\n                \n                We listen and help individuals determine their possible career pathways based on personality traits and factors.\n                \n                We explore individual skills and strengths, consider education levels and give advice about continuing education and changing global career trends. We also determine interests and personality types suitable for an increasingly dynamic, highly competitive, and technology-driven modern career world.\n                \n                Overall, we seek a deep understanding of your goals, skills, and strengths, and are committed to providing ongoing support and resources to help you achieve your goals. ','career-pathway-counselling.jpg','',1,1,NULL,NULL,NULL,'2024-01-09 01:29:22','2024-01-09 01:29:22'),(3,1,1,'Documents verification','document-verification','We will guide and support you on how the correct format for documents such as reports, proposals, and resumes. \n\n                The goal is to ensure that the documents are visually appealing, easy to read and meet the standards and requirements of the intended audience.\n                \n                Document formatting plays a critical role in a student\'s success at immigration. In the documentation, we mainly prepare our students according to the requirements of targeted high Commissions or embassies. \n                \n                Mainly for student visas, embassies look for the financial status of the student’s guardian and whether they can afford living & tuition fees in the guest country. Bank statements or medical and police reports are vital documents that may be required. \n\n                We discuss all other documents with you and are here to guide students in presenting the necessary documents in the required format','document-verification.jpg','residential, transition, real estate',1,1,NULL,NULL,NULL,'2024-01-09 01:29:22','2024-01-09 01:29:22'),(4,1,1,'University Application','university-application','We provide guidance and support to students applying to colleges and universities. It helps students identify appropriate universities and programs, create effective application materials, and navigate the admissions process.\n\n                Our education consultants are qualified and knowledgeable in the complete university admissions process and can guarantee students admission to some of the best universities in the world. \n                \n                 Jewang Education Consultancy provides personalized guidance and support to students to navigate the complex and often stressful process of applying to universities. \n                \n                By providing expert advice and support, we help students achieve their academic and career goals and find a university that is the right fit for them.\n        \n                We do the necessary follow-up and secure admissions in the shortest possible time','university-application.jpg','residential, commercial, glass cleaning',1,1,NULL,NULL,NULL,'2024-01-09 01:29:22','2024-01-09 01:29:22'),(5,1,1,'Student Visa application','student-visa-application','The most integral part of your study-abroad dream plan is preparing for the visa application needed for your course of study. The exact process and requirements can vary depending on the country you\'re applying to and your individual circumstances\n\n                This process requires being familiar and well-researched with the visa procedures and policies of the country you are applying to. Having a university\\’s offer does not often mean that you will be granted a visa for your study unless you are well-prepared and ready for the visa interview process.\n                \n                At Jewang Education Consult we assist in all the steps of your visa application process, to make sure that you get the visa needed for your study and fulfilling your dream. Of key in our visa assistance process is advising you on the student visa procedures and rules of the country you are applying to, preparing you for the visa interview and helping you book the appointment for a successful outcome.\n                \n                Overall, We ensure that you are well-prepared to follow all the instructions and requirements. If you have any questions or concerns, don\'t hesitate to reach out. Good luck with your application!','student-visa-application.jpg','residential, fabric care, stain removal',1,1,NULL,NULL,NULL,'2024-01-09 01:29:22','2024-01-09 01:29:22');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_custom_id_unique` (`custom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'slogan','Slogan','Your guide to international hooks.',1,1,'2024-01-09 01:29:25',NULL,'2024-01-09 01:29:25','2024-01-09 01:29:25'),(2,'logo','Logo','logo.jpg',1,1,'2024-01-09 01:29:25',NULL,'2024-01-09 01:29:25','2024-01-09 01:29:25'),(3,'appname','App Name','Wostac',1,1,'2024-01-09 01:29:25',NULL,'2024-01-09 01:29:25','2024-01-09 01:29:25'),(4,'mission','Our Mission','<p>Our mission is to empower individuals to pursue international work and study opportunities, ensuring access to quality education and meaningful career pathways. We strive to be a trusted partner, guiding our clients through every step of their journey, from academic pursuits to professional placements.</p>',1,1,'2024-01-09 01:29:25',2,'2024-01-09 01:29:25','2024-01-09 04:03:42'),(5,'vision','Our Vision','<p>Our vision is to be a guiding force in transforming aspirations into tangible achievements, creating a global community of empowered individuals who thrive in diverse cultures and contribute meaningfully to the world.&nbsp;</p>',1,1,'2024-01-09 01:29:25',2,'2024-01-09 01:29:25','2024-01-09 04:01:40'),(6,'address','Location or Address','Westlands Drive Nairobi, Kenya',1,1,'2024-01-09 01:29:25',NULL,'2024-01-09 01:29:25','2024-01-09 01:29:25'),(7,'contact','Office Phone','(+254) 726 609 593 / (+254) 728 540 907',1,1,'2024-01-09 01:29:25',NULL,'2024-01-09 01:29:26','2024-01-09 01:29:26'),(8,'email','Email Address','info@wostac.com',1,1,'2024-01-09 01:29:25',NULL,'2024-01-09 01:29:26','2024-01-09 01:29:26');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `slideshow_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (1,1,1,'Grab an <span class=\"text-secondary\">opportunity to</span>','Study and Study <span class=\"title-secondary\">Abroad</span>.','slideshow1-1.jpg',1,1,'2024-01-09 01:29:24',2,'2024-01-09 01:29:24','2024-01-09 04:44:59'),(2,1,1,'Experience <span class=\"text-secondary\">firsthand</span>','Career-Focused <span class=\"title-secondary\">Counseling</span> for Success.','slideshow1-2.jpg',1,1,'2024-01-09 01:29:24',NULL,'2024-01-09 01:29:24','2024-01-09 01:29:24'),(3,1,1,'Professional <span class=\"text-secondary\">guidance on</span>','Visa & Passport <span class=\"title-secondary\">Processing</span>.','slideshow1-3.jpg',1,1,'2024-01-09 01:29:24',2,'2024-01-09 01:29:24','2024-01-09 04:46:17'),(4,1,1,'We <span class=\"text-secondary\">highlight</span>','Document Integrity to <span class=\"title-secondary\">Quicken</span> your Transition.','slideshow1-4.jpg',1,1,'2024-01-09 01:29:24',NULL,'2024-01-09 01:29:24','2024-01-09 01:29:24');
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slideshows`
--

DROP TABLE IF EXISTS `slideshows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slideshows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slideshows_name_unique` (`name`),
  UNIQUE KEY `slideshows_slug_unique` (`slug`),
  UNIQUE KEY `slideshows_position_unique` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slideshows`
--

LOCK TABLES `slideshows` WRITE;
/*!40000 ALTER TABLE `slideshows` DISABLE KEYS */;
INSERT INTO `slideshows` VALUES (1,1,'Featured Services','featured-services','homepage-hero-section','Will be placed at the home page, Hero section.',1,NULL,NULL,NULL,'2024-01-09 01:29:24','2024-01-09 01:29:24');
/*!40000 ALTER TABLE `slideshows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staffs_email_unique` (`email`),
  UNIQUE KEY `staffs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffs`
--

LOCK TABLES `staffs` WRITE;
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` VALUES (1,1,'Amina Nkosi','amina.nkosi@email.com','amina-nkosi','Ms.','A dedicated professional with a passion for excellence in education and societal reform.','amina.jpg','Educational Coordinator',1,1,NULL,NULL,NULL,'2024-01-09 01:29:26','2024-01-09 01:29:26'),(2,1,'Sekou Kamara','sekou.kamara@email.com','sekou-kamara','Mr.','Committed to empowering individuals through innovative educational initiatives.','sekou.jpg','Innovation Specialist',1,1,NULL,NULL,NULL,'2024-01-09 01:29:26','2024-01-09 01:29:26'),(3,1,'Zainab Abiodun','zainab.abiodun@email.com','zainab-abiodun','Ms.','Passionate about societal reform and advocating for positive change in communities.','zainab.jpg','Social Reformist',1,1,NULL,NULL,NULL,'2024-01-09 01:29:26','2024-01-09 01:29:26'),(4,1,'Kwame Osei','kwame.osei@email.com','kwame-osei','Mr.','Experienced in guiding individuals through successful international education journeys.','kwame.jpg','Education Advisor',1,1,NULL,NULL,NULL,'2024-01-09 01:29:27','2024-01-09 01:29:27');
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimony` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,1,'Kwame O. Addo','Mr.','Student','amina.jpg','\n                Thanks to this incredible company, my international education dreams are a reality. Their unwavering support, insightful counseling, and seamless assistance in visa and passport processes opened doors to endless opportunities.',1,1,NULL,NULL,NULL,'2024-01-09 01:29:27','2024-01-09 01:29:27'),(2,1,'Ama K. Mensah','Miss','College Student','mensah.jpg','Choosing this company was the best decision I made for my academic future. I\'m grateful for the doors this company has opened for me.',1,1,NULL,NULL,NULL,'2024-01-09 01:29:27','2024-01-09 01:29:27'),(3,1,'Chijioke M. Okonkwo','Mr.','High School Graduate','okonkwo.jpg','Embarking on my international academic journey was made possible with the incredible assistance of this company. I highly recommend placing your trust in this remarkable team!',1,1,NULL,NULL,NULL,'2024-01-09 01:29:27','2024-01-09 01:29:27');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profileimage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,1,NULL,'default-profileimage.jpg',NULL,NULL,NULL,'2024-01-09 01:29:19','2024-01-09 01:29:19'),(2,2,NULL,'default-profileimage.jpg',NULL,NULL,NULL,'2024-01-09 01:29:19','2024-01-09 01:29:20');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
INSERT INTO `users` VALUES (1,'Wostac Admin','user@wostac.com','2024-01-09 01:29:18','$2y$10$7OS.zQFO8X.CXfZKdRook.A9BW3Ig0fzdGbwR1IZ0UjiGule.H78e','PRNPqbGhRA','2024-01-09 01:29:18','2024-01-09 01:29:18'),(2,'Super Administrator','admin@wostac.com','2024-01-09 01:29:18','$2y$10$zUL9FQSwWQo42ivXWdmW/.GHdjdERSk2n82g7HTrnsGpUsE668X8e','Iq3Ff31lQ5','2024-01-09 01:29:19','2024-01-09 01:29:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFeatured` tinyint(1) NOT NULL DEFAULT '0',
  `isPublished` tinyint(1) NOT NULL DEFAULT '0',
  `published_by` int DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `videos_user_id_foreign` (`user_id`),
  CONSTRAINT `videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `views` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `viewable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewable_id` bigint unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `views_viewable_type_viewable_id_index` (`viewable_type`,`viewable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `views`
--

LOCK TABLES `views` WRITE;
/*!40000 ALTER TABLE `views` DISABLE KEYS */;
INSERT INTO `views` VALUES (1,'App\\Models\\Service',2,'http://127.0.0.1:8000/model-view','bpXM3zoqDSZbFBpvfzPXDwCh1XKkaVgXnPLfN7r5',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36','2024-01-09 03:04:11','2024-01-09 03:04:11');
/*!40000 ALTER TABLE `views` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-09 10:51:32
