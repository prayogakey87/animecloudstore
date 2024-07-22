-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: threaderz_store
-- ------------------------------------------------------
-- Server version	8.0.37-0ubuntu0.20.04.3

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (0,'admin','$2y$10$4IT9wYAmm/5rC6QpZiXhRukL4i3Ns/5l0zRKiIwsdPYvPBa2HLkSa');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `products_id` int NOT NULL,
  `ip_add` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `size` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `c_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (28,'2001:448a:2050:9d51:f479:15ab:4040:49e0',1,'Medium','2024-07-12 05:03:31','tyarasumarly@gmail.com'),(24,'180.252.169.164',1,'Large','2024-07-17 03:55:54','reinaldotest@gmail.com'),(33,'180.252.169.164',1,'Large','2024-07-17 03:57:37','reinaldotest@gmail.com');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_title` text COLLATE utf8mb4_general_ci NOT NULL,
  `cat_desc` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Men',' Latest and best outfits for men'),(2,'Women',' Latest and best outfits for women'),(3,'Kids',' Latest and best outfits for kids'),(4,'Unisex','Applicable for any gender');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_pass` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` varchar(400) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_contact` text COLLATE utf8mb4_general_ci NOT NULL,
  `customer_image` text COLLATE utf8mb4_general_ci,
  `customer_ip` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (38,'Paulus','paulus@gmail.com','$2y$10$wjEz7U9cv4tg5G2.5x8skO3X2d4KO/fo5GLbJEnv5gbnRkZ4DHXQ2','tangerang','081212342424',NULL,'111.94.199.109'),(39,'steven','steven@gmail.com','$2y$10$CYT9eyNsRES7THbJxh7e6.zbuFMHyUt4jPeZdaG6QXBqByQoYPaG6','Tangerang ','08815843849',NULL,'111.94.23.155'),(40,'Prayoga','prayogak81@gmail.com','$2y$10$5D1czkWngRSCi64dZ5aL/e2NDIEj7Yrn.LWNJnpHcK0uKpZWSuTby','tangerang','081212564065','HuTao3.jpg','::1'),(41,'testing','reinaldotest@gmail.com','$2y$10$ipNCqyHTPAFevvNUP6EIEOTcd1oaAbn2SapOzcLWASPPULKT2jA7e','buddhi dharma','0848484848488',NULL,'180.252.169.164');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_qty` int NOT NULL,
  `order_price` int NOT NULL,
  `c_id` int NOT NULL,
  `status` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bukti_tf` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`order_id`),
  KEY `fk_cid` (`c_id`),
  CONSTRAINT `fk_cid` FOREIGN KEY (`c_id`) REFERENCES `customer` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (22,1,255300,39,'Processed','2024-07-15 12:14:01','Twilio.png'),(23,1,255300,39,'Cancelled','2024-07-15 12:17:45',NULL),(24,2,1329780,39,'Cancelled','2024-07-15 12:39:36',NULL),(25,3,765900,39,'Cancelled','2024-07-15 12:45:54',NULL),(26,3,1661670,38,'Cancelled','2024-07-15 13:11:41',NULL),(27,1,888000,40,'Cancelled','2024-07-15 13:18:30',NULL),(28,1,255300,40,'Processed','2024-07-15 13:18:54','Twilio.png'),(29,1,255300,40,'Cancelled','2024-07-15 13:28:37',NULL),(30,1,888000,40,'Cancelled','2024-07-15 13:28:45',NULL),(31,1,255300,40,'Cancelled','2024-07-15 13:28:57',NULL),(32,1,255300,40,'Cancelled','2024-07-15 13:29:08',NULL),(35,2,244200,40,'Processed','2024-07-15 15:21:08','Twilio.png'),(36,1,122100,40,'Cancelled','2024-07-15 15:40:05',NULL),(37,1,133200,40,'New','2024-07-17 03:30:35',NULL),(38,1,255300,40,'New','2024-07-17 03:55:04',NULL),(39,1,255300,40,'New','2024-07-17 04:24:25',NULL),(40,2,1021200,40,'New','2024-07-17 04:25:05',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `placed_order`
--

DROP TABLE IF EXISTS `placed_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `placed_order` (
  `order_id` int NOT NULL,
  `products_id` int NOT NULL,
  `product_price` int NOT NULL,
  `ip_add` text COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `size` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  KEY `fk_orderid` (`order_id`),
  KEY `fk_products` (`products_id`),
  CONSTRAINT `fk_orderid` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_products` FOREIGN KEY (`products_id`) REFERENCES `products` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `placed_order`
--

LOCK TABLES `placed_order` WRITE;
/*!40000 ALTER TABLE `placed_order` DISABLE KEYS */;
INSERT INTO `placed_order` VALUES (22,28,230000,'::1',1,'Large','2024-07-15 12:26:27','steven@gmail.com'),(23,26,230000,'::1',1,'Large','2024-07-15 12:26:27','steven@gmail.com'),(24,29,499000,'::1',2,'XL','2024-07-15 12:39:36','steven@gmail.com'),(25,28,230000,'::1',3,'Large','2024-07-15 12:45:54','steven@gmail.com'),(26,29,499000,'::1',3,'Large','2024-07-15 13:11:41','paulus@gmail.com'),(27,3,800000,'::1',1,'Large','2024-07-15 13:18:30','prayogak81@gmail.com'),(28,26,230000,'::1',1,'XL','2024-07-15 13:18:54','prayogak81@gmail.com'),(29,26,230000,'::1',1,'Large','2024-07-15 13:28:37','prayogak81@gmail.com'),(30,3,800000,'::1',1,'XL','2024-07-15 13:28:45','prayogak81@gmail.com'),(31,28,230000,'::1',1,'Medium','2024-07-15 13:28:57','prayogak81@gmail.com'),(32,26,230000,'::1',1,'Medium','2024-07-15 13:29:08','prayogak81@gmail.com'),(35,34,100000,'::1',1,'Medium','2024-07-15 15:21:08','prayogak81@gmail.com'),(35,31,120000,'::1',1,'XL','2024-07-15 15:21:08','prayogak81@gmail.com'),(36,35,110000,'::1',1,'Large','2024-07-15 15:40:05','prayogak81@gmail.com'),(37,31,120000,'::1',1,'XL','2024-07-17 03:30:35','prayogak81@gmail.com'),(38,28,230000,'111.94.167.171',1,'Large','2024-07-17 03:55:04','prayogak81@gmail.com'),(39,28,230000,'111.94.167.171',1,'Large','2024-07-17 04:24:25','prayogak81@gmail.com'),(40,3,800000,'111.94.167.171',1,'Large','2024-07-17 04:25:05','prayogak81@gmail.com'),(40,33,120000,'111.94.167.171',1,'XL','2024-07-17 04:25:05','prayogak81@gmail.com');
/*!40000 ALTER TABLE `placed_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_insert_placed_order` BEFORE INSERT ON `placed_order` FOR EACH ROW BEGIN
  DECLARE prod_price INT(11);
  
  
  SELECT product_price INTO prod_price
  FROM products
  WHERE products_id = NEW.products_id;
  
  
  SET NEW.product_price = prod_price;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_categories` (
  `p_cat_id` int NOT NULL AUTO_INCREMENT,
  `p_cat_title` text COLLATE utf8mb4_general_ci NOT NULL,
  `p_cat_desc` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`p_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_categories`
--

LOCK TABLES `product_categories` WRITE;
/*!40000 ALTER TABLE `product_categories` DISABLE KEYS */;
INSERT INTO `product_categories` VALUES (1,'Jackets','Good quality custom made and casual wear jackets'),(2,'Tee-Shirts','Good and easy stuff designed Tee-Shirt '),(5,'Hoodies','Cool customized and colorful hoodies');
/*!40000 ALTER TABLE `product_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `products_id` int NOT NULL AUTO_INCREMENT,
  `p_cat_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `product_title` text COLLATE utf8mb4_general_ci NOT NULL,
  `product_img1` text COLLATE utf8mb4_general_ci NOT NULL,
  `product_img2` text COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_keywords` text COLLATE utf8mb4_general_ci NOT NULL,
  `product_desc` text COLLATE utf8mb4_general_ci NOT NULL,
  `stats` int DEFAULT NULL,
  PRIMARY KEY (`products_id`),
  KEY `fk_p_cat_id` (`p_cat_id`),
  KEY `fk_cat` (`cat_id`),
  CONSTRAINT `fk_cat` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_p_cat_id` FOREIGN KEY (`p_cat_id`) REFERENCES `product_categories` (`p_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,5,4,'2024-07-17 03:47:44','Dragon ball Z Hoodie','Hoodie.webp','Hoodie.webp',200000,'Dragon ball','<p>【Packing List】1 * Long Sleeve Hoodie\r\n【Material】High-quality Polyester, durable, fit your daily wear.\r\n【Sleeve style】Regular Long Sleeve\r\n【Pattern】3D Printed\r\n【Collar】O-neck\r\n【Features】stylish design makes you more attractive.\r\nPlease refer to the size chart info or check in the pictures,before purchasingthe order.The size details are of EU Sizes.</p>',1),(3,5,1,'2024-07-15 16:50:45','Japanese Hip-Hop Style Hoodie','Hoodie japanese.webp','hoodie japanese2.jpg',800000,'Japanese','<p>Sleeve Length(cm): Full\r\nMaterial: POLYESTER\r\nApplicable Season: Spring and Autumn\r\nStyle: HIP HOP\r\nApplicable Scene: Shopping\r\nOrigin: Mainland China</p>',1),(24,5,4,'2024-07-15 16:19:27','Japanese Hip-Hop Style Hoodie','Hoodie3.webp','Hoodie34.webp',560000,'Casual','<p>Brand Name: NoEnName_Null</p>\r\n<p>Sleeve Length(cm): Full</p>\r\n<p>Material: POLYESTER</p>\r\n<p>Applicable Season: Four Seasons</p>\r\n<p>Style: Casual</p>\r\n<p>Applicable Scene: Daily</p>\r\n<p>Origin: Mainland China</p>',1),(25,5,1,'2024-07-15 16:19:41','Japanese Loft Print Hoodie','Hoodie3343.webp','Hoodie322.webp',848000,'Loft Print','Japanase Love print',1),(26,2,2,'2024-07-15 16:19:57','NEZUKO DEMON SLAYER DS03','Nezuko.jpg','nezuko2.jpg',230000,'Demon Slayer','<p>Menggunakan Bahan Cotton Combed 30s Soft Premium</p>\r\n<p>&gt; 100% Sesuai Gambar</p>\r\n<p>&gt; Tipe Pria Dan Wanita Unisex</p>\r\n<p>&gt; Bahan tebal, namun tetap adem dan lembut</p>\r\n<p>&gt; Bahan kualitas STANDAR DISTRO EXPOR, nyaman dipakai</p>\r\n<p>&gt; Hight Quality</p>',1),(27,5,4,'2024-07-15 16:20:00','LILO & STITCH LS01','lilo.jpg','lilo2.jpg',120000,'Lilo','<p>Menggunakan Bahan Cotton Combed 30s Soft Premium</p>\r\n<p>100% Sesuai Gambar</p>\r\n<p>Tipe Pria Dan Wanita Unisex</p>\r\n<p>Bahan tebal, namun tetap adem dan lembut</p>\r\n<p>Bahan kualitas STANDAR DISTRO EXPOR, nyaman dipakai</p>\r\n<p>Hight Quality</p>',1),(28,1,2,'2024-07-15 16:50:03','Hitori Gotou Bocchi The Rock Costume','Bochi.jpg','bochi2.jpg',230000,'Kostum','<p>Judul Anime : Bocchi The Rock!</p>\r\n<p>Nama Karakter : Hitori Gotou</p>\r\n<p>&nbsp;</p>\r\n<p>Detail Produk :</p>\r\n<p>- Full Costume/Hanya Jaket</p>\r\n<p>- Pilihan (Jaket &amp; Rok)</p>\r\n<p>- Pilihan (Jaket &amp; Celana)</p>\r\n<p>- Pilihan (Hanya Jaket)</p>',1),(29,5,1,'2024-07-15 16:20:15','Stussy Basic Stock Logo White Hoodie - ORI FULLTAG','hoodie5.jpg','hoodie5.jpg',499000,'Hoodie','<p><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">Front and Back Printed Logo.</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">420gsm Heavyweight Fabric.</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">Brand New with Wash Label, Tag and Polybag.</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">Inner Fleece Material.</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">Material: 100% Cotton.</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">..</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">Size Chart (Euro Fit):</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">(Panjang x Lebar Dada x Lebar Bahu)</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">S (70 x 50 x 47 cm)</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">M (72 x 52 x 49 cm)</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">L (74 x 54 x 51 cm)</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">XL (76 x 56 x 53 cm)</span><br style=\"box-sizing: inherit; color: #212121; font-family: \'Open Sauce One\', sans-serif;\" /><span style=\"color: #212121; font-family: \'Open Sauce One\', sans-serif;\">XXL (78 x 58 x 55 cm)</span></p>',1),(30,2,3,'2024-07-15 16:20:18','T-Shirt DEMON SLAYER Kamaboko Squad','demons.jpg','demons.jpg',100000,'demon slayer','ANAK\r\nS 2-3 Tahun : LD 34cm x PB44cm\r\nM 4-5 Tahun : LD 36cm x PB45cm\r\nL 6-7 Tahun : LD 38cm x PB47cm\r\nXL 7-8 Tahun : LD 40 cm x PB 52cm\r\n\r\nDEWASA\r\nDEWASA S : LD 48cm x PB 62cm\r\nDEWASA M : LD 50cm x PB 65cm\r\nDEWASA L : LD 52cm x PB 68cm\r\nDEWASA XL : LD 54cm x PB 71cm',1),(31,2,2,'2024-07-15 16:20:21','Baju Kaos T-Shirt Anime Jepang SAILORMOON','Sailormoon.jpg','Sailormoon.jpg',120000,'demon slayer','ANAK\r\nS 2-3 Tahun : LD 34cm x PB44cm\r\nM 4-5 Tahun : LD 36cm x PB45cm\r\nL 6-7 Tahun : LD 38cm x PB47cm\r\nXL 7-8 Tahun : LD 40 cm x PB 52cm\r\n\r\nDEWASA\r\nDEWASA S : LD 48cm x PB 62cm\r\nDEWASA M : LD 50cm x PB 65cm\r\nDEWASA L : LD 52cm x PB 68cm\r\nDEWASA XL : LD 54cm x PB 71cm',1),(32,2,4,'2024-07-15 16:20:23','Kaos Anime Demon Slayer Kimetsu No Yaiba ZENITSU POP ART','zenitsusleep.jpg','zenitsusleep.jpg',100000,'demon slayer','[DETAILS]\r\n\r\nMaterial: 100% Cotton Combed 30s\r\n\r\nSablon: PLASTISOL\r\n\r\nWarna: NAVY\r\n\r\nPackaging: Zip Plastic Bag.',1),(33,2,4,'2024-07-15 16:20:24','KIMETSU NO YAIBA DEMONS SLAYER INOSUKE','Insoukee.png','Insoukee.png',120000,'demon slayer','ANAK\r\nS 2-3 Tahun : LD 34cm x PB44cm\r\nM 4-5 Tahun : LD 36cm x PB45cm\r\nL 6-7 Tahun : LD 38cm x PB47cm\r\nXL 7-8 Tahun : LD 40 cm x PB 52cm\r\n\r\nDEWASA\r\nDEWASA S : LD 48cm x PB 62cm\r\nDEWASA M : LD 50cm x PB 65cm\r\nDEWASA L : LD 52cm x PB 68cm\r\nDEWASA XL : LD 54cm x PB 71cm',1),(34,2,4,'2024-07-15 16:40:44','T-Shirt Anime Demon Slayer NINE HASHIRA','hashira.png','hashira2.png',100000,'demon slayer','Detail Produk:\r\n\r\nMaterial: 100% Cotton Combed 30s\r\n\r\nSablon: PLASTISOL\r\n\r\nWarna: HITAM\r\n\r\nPackaging: Zip Plastic Bag.',1),(35,2,2,'2024-07-15 16:21:55','T-shirt Anime Bocchi the Rock KESSOKU','bocchi.jpg','bocchi.jpg',110000,'bocchi','Detail Produk:\r\n\r\nMaterial: 100% Cotton Combed 30s\r\n\r\nSablon: PLASTISOL\r\n\r\nWarna: HITAM\r\n\r\nPackaging: Zip Plastic Bag.',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_products_update` AFTER UPDATE ON `products` FOR EACH ROW BEGIN
  UPDATE placed_order
  SET product_price = NEW.product_price
  WHERE products_id = NEW.products_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slider` (
  `slide_id` int NOT NULL AUTO_INCREMENT,
  `slide_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slide_image` text COLLATE utf8mb4_general_ci NOT NULL,
  `slide_heading` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `slide_text` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (1,'Slide 1','summer2.jpg','Summer Sale','Walk in for the Fashion, Stay in for the Style.'),(2,'Slide 2','slide_12.jpg','Black friday','Simply Eveything You Want.');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'threaderz_store'
--
/*!50106 SET @save_time_zone= @@TIME_ZONE */ ;
/*!50106 DROP EVENT IF EXISTS `update_order_status` */;
DELIMITER ;;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;;
/*!50003 SET character_set_client  = utf8mb4 */ ;;
/*!50003 SET character_set_results = utf8mb4 */ ;;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;;
/*!50003 SET @saved_time_zone      = @@time_zone */ ;;
/*!50003 SET time_zone             = '+00:00' */ ;;
/*!50106 CREATE*/ /*!50117 DEFINER=`root`@`localhost`*/ /*!50106 EVENT `update_order_status` ON SCHEDULE EVERY 1 HOUR STARTS '2024-07-09 09:06:53' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE orders
    SET status = 'Cancelled'
    WHERE status = 'New'
    AND bukti_tf IS NULL
    AND TIMESTAMPDIFF(HOUR, `date`, NOW()) > 24;
END */ ;;
/*!50003 SET time_zone             = @saved_time_zone */ ;;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;;
/*!50003 SET character_set_client  = @saved_cs_client */ ;;
/*!50003 SET character_set_results = @saved_cs_results */ ;;
/*!50003 SET collation_connection  = @saved_col_connection */ ;;
DELIMITER ;
/*!50106 SET TIME_ZONE= @save_time_zone */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-17  5:17:19
