-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: coffeeshop
-- ------------------------------------------------------
-- Server version	9.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

USE CoffeeShop;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
                             `id` int NOT NULL AUTO_INCREMENT,
                             `name` varchar(255) NOT NULL,
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
REPLACE INTO `countries` (`id`, `name`) VALUES (1,'Egypt'),(2,'USA');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drink_categories`
--

DROP TABLE IF EXISTS `drink_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drink_categories` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) NOT NULL,
                                    `icon` varchar(255) DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drink_categories`
--

LOCK TABLES `drink_categories` WRITE;
/*!40000 ALTER TABLE `drink_categories` DISABLE KEYS */;
REPLACE INTO `drink_categories` (`id`, `name`, `icon`) VALUES (1,'Coffee','public/assets/imgs/Americano.jpg'),(2,'Tea','public/assets/imgs/tea.png'),(3,'Desserts','public/assets/imgs/desserts.png');
/*!40000 ALTER TABLE `drink_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drink_sizes`
--

DROP TABLE IF EXISTS `drink_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drink_sizes` (
                               `drink_id` int NOT NULL,
                               `size` enum('small','medium','large') NOT NULL,
                               `price` decimal(5,2) NOT NULL,
                               `price_promo` decimal(5,2) DEFAULT NULL,
                               PRIMARY KEY (`drink_id`,`size`),
                               CONSTRAINT `fk_size_drink` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drink_sizes`
--

LOCK TABLES `drink_sizes` WRITE;
/*!40000 ALTER TABLE `drink_sizes` DISABLE KEYS */;
REPLACE INTO `drink_sizes` (`drink_id`, `size`, `price`, `price_promo`) VALUES (1,'small',2.50,NULL),(1,'medium',3.50,NULL),(1,'large',4.50,NULL),(2,'small',2.00,NULL),(2,'medium',3.00,NULL),(2,'large',4.00,NULL),(3,'small',2.50,NULL),(3,'medium',3.50,NULL),(3,'large',4.50,NULL),(4,'small',1.50,NULL),(4,'medium',2.50,NULL),(4,'large',3.50,NULL),(5,'small',2.00,NULL),(5,'medium',3.00,NULL),(5,'large',4.00,NULL),(6,'small',2.00,NULL),(6,'medium',3.00,NULL),(6,'large',4.00,NULL),(7,'small',2.50,NULL),(7,'medium',3.50,NULL),(7,'large',4.50,NULL),(8,'small',3.00,NULL),(8,'medium',4.00,NULL),(8,'large',5.00,NULL),(9,'small',2.50,NULL),(9,'medium',3.50,NULL),(9,'large',4.50,NULL);
/*!40000 ALTER TABLE `drink_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drinks`
--

DROP TABLE IF EXISTS `drinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drinks` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) NOT NULL,
                          `image` varchar(255) NOT NULL,
                          `category_id` int NOT NULL,
                          `description` text NOT NULL,
                          PRIMARY KEY (`id`),
                          UNIQUE KEY `name_UNIQUE` (`name`),
                          KEY `fk_drink_category_idx` (`category_id`),
                          CONSTRAINT `fk_drink_category` FOREIGN KEY (`category_id`) REFERENCES `drink_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drinks`
--

LOCK TABLES `drinks` WRITE;
/*!40000 ALTER TABLE `drinks` DISABLE KEYS */;
REPLACE INTO `drinks` (`id`, `name`, `image`, `category_id`, `description`) VALUES (1,'Latte','public/assets/imgs/latte.avif',1,'Latte'),(2,'Cappuccino','public/assets/imgs/cappuccino.avif',1,'Cappuccino'),(3,'Mocha','public/assets/imgs/Mocha.jpg',1,'Mocha'),(4,'Americano','public/assets/imgs/Americano.jpg',1,'Americano'),(5,'Flat White','public/assets/imgs/Flat White.jpg',1,'Flat White'),(6,'Cold Brew','public/assets/imgs/Cold Brew.avif',1,'Cold Brew'),(7,'Iced Latte','public/assets/imgs/Iced Latte.jpg',1,'Iced Latte'),(8,'Frappuccino','public/assets/imgs/frappuccino.avif',1,'Frappuccino'),(9,'Macchiato','public/assets/imgs/Macchiato.jpg',1,'Latte');
/*!40000 ALTER TABLE `drinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedbacks` (
                             `id` int NOT NULL AUTO_INCREMENT,
                             `name` varchar(255) NOT NULL,
                             `email` varchar(255) NOT NULL,
                             `message` text NOT NULL,
                             `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
REPLACE INTO `feedbacks` (`id`, `name`, `email`, `message`, `created_at`) VALUES (1,'ahmed mohammed','ahmed@test.com','Hello there!','2025-02-10 17:28:29');
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `order_id` int NOT NULL,
                               `drink_id` int NOT NULL,
                               `size` enum('small','medium','large') NOT NULL,
                               `quantity` int NOT NULL DEFAULT '1',
                               `price` decimal(5,2) NOT NULL,
                               PRIMARY KEY (`id`),
                               KEY `fk_order_item_order_idx` (`order_id`),
                               KEY `fk_order_item_drink_idx` (`drink_id`),
                               CONSTRAINT `fk_order_item_drink` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`id`),
                               CONSTRAINT `fk_order_item_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `user_id` int NOT NULL,
                          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `total_price` decimal(7,2) NOT NULL,
                          PRIMARY KEY (`id`),
                          KEY `fk_order_user_idx` (`user_id`),
                          CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) NOT NULL,
                          `country_id` int NOT NULL,
                          PRIMARY KEY (`id`),
                          KEY `fk_state_country_idx` (`country_id`),
                          CONSTRAINT `fk_state_country` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
REPLACE INTO `states` (`id`, `name`, `country_id`) VALUES (1,'Cairo',1),(2,'Alexandria',1),(3,'Washington',2),(4,'New York',2);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_favourite_categories`
--

DROP TABLE IF EXISTS `user_favourite_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_favourite_categories` (
                                             `user_id` int NOT NULL,
                                             `category_id` int NOT NULL,
                                             PRIMARY KEY (`user_id`,`category_id`),
                                             KEY `fk_user_favourite_category_category_idx` (`category_id`),
                                             CONSTRAINT `fk_user_favourite_category_category` FOREIGN KEY (`category_id`) REFERENCES `drink_categories` (`id`) ON DELETE CASCADE,
                                             CONSTRAINT `fk_user_favourite_category_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_favourite_categories`
--

LOCK TABLES `user_favourite_categories` WRITE;
/*!40000 ALTER TABLE `user_favourite_categories` DISABLE KEYS */;
REPLACE INTO `user_favourite_categories` (`user_id`, `category_id`) VALUES (2,1),(2,18);
/*!40000 ALTER TABLE `user_favourite_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `password` varchar(255) NOT NULL,
                         `first_name` varchar(255) DEFAULT NULL,
                         `last_name` varchar(255) DEFAULT NULL,
                         `email` varchar(255) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `state_id` int DEFAULT NULL,
                         `gender` enum('M','F') NOT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email_UNIQUE` (`email`),
                         KEY `fk_user_state_idx` (`state_id`),
                         CONSTRAINT `fk_user_state` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `password`, `first_name`, `last_name`, `email`, `created_at`, `state_id`, `gender`) VALUES (1,'$argon2i$v=19$m=65536,t=4,p=1$N0hOWVkuMy5MZS4vbGsyaQ$6oSInW5mgY6svKjQ8reFXFc3yjrIZ82yXgE/B890wOI','Test','Test2','test@test.com','2025-02-10 16:25:54',2,'M'),(2,'$argon2i$v=19$m=65536,t=4,p=1$bmlzZGtKQWV5MEgwdDRPQg$neYUK7wZ67NDHBMFKPdM2iM3ViigUVsHHf23XZ4gQEc','Ahmed','Shawqy','ahmed@test.com','2025-02-10 17:24:51',1,'M');
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

-- Dump completed on 2025-02-10 19:30:26
