/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 11.0.2-MariaDB : Database - pet_saathi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pet_saathi` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;

USE `pet_saathi`;

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL DEFAULT 0,
  `product_id` int(10) unsigned NOT NULL DEFAULT 0,
  `quantity` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*Data for the table `order_items` */

insert  into `order_items`(`id`,`order_id`,`product_id`,`quantity`,`created_at`,`updated_at`) values 
(1,1,1,2,NULL,NULL),
(2,1,2,1,'2026-08-11 16:23:39','2026-08-11 16:23:45');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT '0',
  `total_amount` double unsigned NOT NULL DEFAULT 0,
  `total_shipping_charge` double unsigned NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `shipping_status` varchar(255) NOT NULL DEFAULT '0',
  `shipping_remark` varchar(191) DEFAULT NULL,
  `utr_no` varchar(191) DEFAULT NULL,
  `shipping_name` varchar(191) DEFAULT NULL,
  `shipping_email` varchar(191) DEFAULT NULL,
  `shipping_mobile` varchar(191) DEFAULT NULL,
  `shipping_address` varchar(191) DEFAULT NULL,
  `shipping_country` varchar(191) DEFAULT NULL,
  `shipping_state` varchar(191) DEFAULT NULL,
  `shipping_city` varchar(191) DEFAULT NULL,
  `shipping_zip_code` varchar(191) DEFAULT NULL,
  `payment_status` int(10) unsigned NOT NULL DEFAULT 0,
  `place_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shop_orders_user` (`user_id`),
  CONSTRAINT `fk_shop_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`user_id`,`payment_method`,`total_amount`,`total_shipping_charge`,`status`,`shipping_status`,`shipping_remark`,`utr_no`,`shipping_name`,`shipping_email`,`shipping_mobile`,`shipping_address`,`shipping_country`,`shipping_state`,`shipping_city`,`shipping_zip_code`,`payment_status`,`place_time`,`created_at`,`updated_at`) values 
(1,2,'cash',500,80,'approved','dispatch','Your order is on the way','098765','mukul','mukul@gmail.com','9988776655','EN 432, Rasta Mohalla, near phagwada gate','india','punjab','jalandhar','144001',0,'2026-08-07 16:18:20','2026-08-07 16:18:24','2026-08-07 16:18:27');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
