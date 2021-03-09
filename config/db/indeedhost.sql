/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.6.42-84.2 : Database - seller_indeedhost
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `addons` */

DROP TABLE IF EXISTS `addons`;

CREATE TABLE `addons` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addon_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `db_table` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = Active, 0 = Un-Active',
  `visibility` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 = Published, 0 = Unpublished',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `addons` */

/*Table structure for table `applied_codes` */

DROP TABLE IF EXISTS `applied_codes`;

CREATE TABLE `applied_codes` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `hosting_plan_id` int(30) NOT NULL,
  `hosting_plan_name` int(30) DEFAULT NULL,
  `offer_code` varchar(350) NOT NULL,
  `offer_discount` varchar(100) NOT NULL,
  `discount_amount` varchar(100) NOT NULL,
  `user_id` text NOT NULL,
  `offer_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `applied_codes` */

insert  into `applied_codes`(`id`,`hosting_plan_id`,`hosting_plan_name`,`offer_code`,`offer_discount`,`discount_amount`,`user_id`,`offer_name`,`created_at`,`updated_at`) values 
(17,4,NULL,'23423ASD','11','132','11','asdas','2021-03-02 11:51:23','2021-03-02 11:51:23'),
(18,1,NULL,'PEINAM','10','3120','19','Pei Nam','2021-03-02 12:12:19','2021-03-02 12:12:19'),
(19,6,NULL,'PEINAM','10','450','19','Pei Nam','2021-03-02 12:12:19','2021-03-02 12:12:19');

/*Table structure for table `contact_page_detail` */

DROP TABLE IF EXISTS `contact_page_detail`;

CREATE TABLE `contact_page_detail` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `address` text NOT NULL,
  `phone` int(15) NOT NULL,
  `email` varchar(300) NOT NULL,
  `website` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `contact_page_detail` */

insert  into `contact_page_detail`(`id`,`user_id`,`address`,`phone`,`email`,`website`,`created_at`,`updated_at`) values 
(1,11,'198 West 21th Street, Suite 721 New York NY 10016',1235235598,'info@yoursite.com','https://www.indeedhost.seller2seller.com',NULL,'2021-02-19 11:50:22');

/*Table structure for table `contactus` */

DROP TABLE IF EXISTS `contactus`;

CREATE TABLE `contactus` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(400) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `contactus` */

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `iso` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nicename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonecode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `countries` */

/*Table structure for table `email_templates` */

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `id` int(11) DEFAULT NULL,
  `template_code` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_name` varchar(765) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_subject` text COLLATE utf8_unicode_ci,
  `template_content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `email_templates` */

insert  into `email_templates`(`id`,`template_code`,`template_name`,`template_subject`,`template_content`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'sign_up','sign_up','Login details','<p>Dear [RECEIVER NAME],</p>\r\n<p>Your login details are:</p>\r\n<p>Email: [EMAIL]</p>\r\n<p>Password: [PASSWORD]</p>\r\n<p>Url: <a href=\"http://lyreco.homeshom.com/\">http://lyreco.homeshom.com/</a></p>','2020-12-23 11:14:22','2021-01-12 07:16:23','2021-01-22 07:55:05'),
(2,'project_created','Test Email Template','New Project Created','<p>Dear [RECEIVER NAME], a new project with the title [PROJECT TITLE] has been created.</p>\r\n<p>For more details please click <a href=\"/admin/email/template/detail/[PROJECT LINK]\">HERE</a>.</p>','2020-12-23 16:57:41','2021-01-19 12:11:10','2021-01-22 07:55:05'),
(3,'update_status','Update Status For Project','Please update status for project.\r\n','Dear [projectManagerName], your weekly update for project for project  [projectTitle] is overdue. Please update the status as soon as possible.\r\nGo to [PASSWORD LINK].','2021-01-04 18:07:49','2021-01-18 12:38:39','2021-01-22 07:55:05'),
(4,'planExpired','planExpired','Expiration Reminders','<p>Dear [RECEIVER NAME], The emails remind users that your [PLAN NAME] is expiring soon.</p>','2021-01-22 09:39:38','2021-01-19 11:47:17','2021-01-22 07:55:05');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `features` */

DROP TABLE IF EXISTS `features`;

CREATE TABLE `features` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `image` text NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `features` */

insert  into `features`(`id`,`user_id`,`image`,`title`,`description`,`created_at`,`updated_at`) values 
(6,11,'cloud-2.png','Auto Updates','Don\'t be distracted by criticism. Remember the only taste of success some people.','2021-02-11 12:49:09','2021-02-11 13:11:58'),
(7,11,'cloud-3.png','Optimized Software','Don\'t be distracted by criticism. Remember the only taste of success some people.','2021-02-11 12:49:25','2021-02-11 13:06:19'),
(8,11,'cloud-2.png','Daily Backups','Don\'t be distracted by criticism. Remember the only taste of success some people.','2021-02-11 12:49:44','2021-02-11 13:06:07'),
(9,11,'cloud-3.png','Wide Networking','Don\'t be distracted by criticism. Remember the only taste of success some people.','2021-02-11 12:50:08','2021-02-11 13:06:23'),
(10,11,'cloud-2.png','Protected','Don\'t be distracted by criticism. Remember the only taste of success some people.','2021-02-11 12:50:23','2021-02-11 13:06:14'),
(11,11,'cloud-3.png','Free Support','Don\'t be distracted by criticism. Remember the only taste of success some people.','2021-02-11 12:50:40','2021-02-11 13:06:29');

/*Table structure for table `hosting_plans` */

DROP TABLE IF EXISTS `hosting_plans`;

CREATE TABLE `hosting_plans` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_duration` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bandwidth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `db` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emails` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `support` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `hosting_plans` */

insert  into `hosting_plans`(`id`,`title`,`plan_duration`,`discount`,`type`,`price`,`per`,`website`,`storage`,`bandwidth`,`ram`,`db`,`emails`,`support`,`created_at`,`updated_at`) values 
(1,'Aluminum plan','[\"1\",\"12\",\"24\",\"36\"]','[\"8\",\"7\",\"10\",\"8\"]','[\"percentage\",\"percentage\",\"percentage\",\"percentage\"]','[\"2700\",\"2600\",\"2500\",\"2200\"]','1','1','50','70','1','3','3','limited','2021-01-22 09:45:02','2021-03-02 06:14:37'),
(4,'Silver plan','[\"1\",\"12\",\"24\",\"36\"]','[\"90\",\"10\",\"10\",\"10\"]','[\"percentage\",\"percentage\",\"percentage\",\"percentage\"]','[\"1200\",\"1150\",\"1100\",\"1050\"]','1','3','100','70','3','15','10','Unlimited','2021-01-22 09:45:15','2021-03-01 06:55:55'),
(5,'Golden Plan','[\"1\",\"12\",\"24\",\"36\"]','[\"10\",\"12\",\"15\",\"18\"]','[\"percentage\",\"percentage\",\"percentage\",\"percentage\"]','[\"3200\",\"3100\",\"3000\",\"2600\"]','1','6','500','150','5','20','20','Unlimited','2021-01-22 05:17:48','2021-03-01 08:27:42'),
(6,'Diamond Plan','[\"1\",\"12\",\"24\",\"36\"]','[\"10\",\"15\",\"16\",\"20\"]','[\"percentage\",\"percentage\",\"percentage\",\"percentage\"]','[\"4500\",\"4400\",\"4300\",\"4200\"]','1','20','800','160','6','40','20','Unlimited','2021-01-22 05:56:50','2021-03-01 08:27:49'),
(7,'Copper plan','[\"1\",\"12\",\"24\",\"36\"]','[\"12\",\"10\",\"8\",\"9\"]','[\"percentage\",\"percentage\",\"percentage\",\"percentage\"]','[\"1500\",\"1400\",\"1300\",\"1200\"]',NULL,'1','100','100','3','5','10','limited',NULL,'2021-03-01 08:28:17'),
(9,'sdf','[\"1\",\"12\",\"24\",\"36\"]','[\"10\",\"10\",\"5\",\"5\"]','[\"percentage\",\"percentage\",\"percentage\",\"percentage\"]','[\"200\",\"150\",\"100\",\"50\"]',NULL,'23','234','243','234','243','43','sdf','2021-02-26 11:33:56','2021-03-01 08:28:28');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2020_07_15_054356_create_orders_table',1),
(5,'2020_12_03_061439_create_hosting_plans_table',1),
(6,'2020_12_04_124017_create_countries_table',1),
(7,'2020_12_08_080128_create_order_items_table',1),
(8,'2020_12_09_114814_create_addons_table',1),
(9,'2020_12_10_061039_create_routesmanagers_table',1),
(10,'2020_12_10_072710_create_userroles_table',1),
(11,'2020_12_10_101236_create_user_permissions_table',1);

/*Table structure for table `offers` */

DROP TABLE IF EXISTS `offers`;

CREATE TABLE `offers` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `type` enum('fixed','percentage') NOT NULL DEFAULT 'fixed',
  `code` varchar(300) NOT NULL,
  `start_date` date NOT NULL DEFAULT '2021-02-25',
  `expiry_date` date NOT NULL,
  `min_package_amount` varchar(100) NOT NULL,
  `max_discount` varchar(100) NOT NULL,
  `specific_item` varchar(100) NOT NULL,
  `restricted_item` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `offers` */

insert  into `offers`(`id`,`name`,`description`,`type`,`code`,`start_date`,`expiry_date`,`min_package_amount`,`max_discount`,`specific_item`,`restricted_item`,`created_at`,`updated_at`) values 
(7,'Saturday Offer','Offer will be valid on Saturday.','percentage','GRABSTATURSDAY','2021-02-25','2021-02-28','1200','30','[\"7\",\"5\"]','[\"6\"]','2021-02-24 04:22:47','2021-02-24 13:31:13'),
(8,'Pei Nam','Pei NamPei NamPei NamPei Nam','percentage','PEINAM','2021-02-25','2021-03-04','100','10','','[\"4\"]','2021-02-24 04:24:16','2021-03-01 08:06:21'),
(9,'dfs','sdfsdf','percentage','SDF','2021-02-25','2021-03-05','324','234','[\"5\"]','[\"4\"]','2021-02-24 11:28:00','2021-02-24 11:28:00'),
(10,'dfgd','dgdg','fixed','DFGDFGDFG','2021-02-25','2021-03-11','324234','324234','[\"5\"]','[\"7\",\"5\"]','2021-02-24 11:40:52','2021-02-24 13:31:01'),
(11,'asdas','asd','percentage','23423ASD','2021-02-25','2021-03-24','12','11','[\"4\",\"6\",\"7\"]','[\"1\",\"5\"]','2021-03-01 13:52:26','2021-03-01 13:59:42');

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hosting_plan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'plan name',
  `item_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taxrate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discountRate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('process','completed','cancel') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'process',
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_items` */

insert  into `order_items`(`id`,`hosting_plan_id`,`order_id`,`user_id`,`item_name`,`item_price`,`total_price`,`taxrate`,`discountRate`,`username`,`password`,`domain`,`status`,`duration`,`expired_at`,`created_at`,`updated_at`) values 
(156,'9','112','19','sdf','2400','2400','0',NULL,'username','zaq','domain','completed','24','2023-03-02 13:11:03','2021-03-02 13:04:54','2021-03-02 13:11:03');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` double(8,2) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon` double(8,2) DEFAULT NULL,
  `total_amount` double(8,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `payment_method` enum('razorpay','paypal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `address2` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `orders` */

insert  into `orders`(`id`,`order_id`,`razorpay_signature`,`user_id`,`sub_total`,`payment_id`,`coupon`,`total_amount`,`quantity`,`payment_method`,`payment_status`,`name`,`email`,`phone`,`country`,`post_code`,`address`,`address2`,`created_at`,`updated_at`) values 
(112,'pay_GhnNVOIRMGWcqP','9bf96472e4cbdf2f50073f514cc61d3eef5f657ac2730df26ede9bbb3611cf12','19',2280.00,'pay_GhnNVOIRMGWcqP',NULL,NULL,NULL,'razorpay','paid','Nastya','nastyaplisova@gmail.com',NULL,NULL,NULL,NULL,NULL,'2021-03-02 13:04:54','2021-03-02 13:05:07');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('markhurrley@gmail.com','$2y$10$nqC01Es8MQ/dKhuP1lQYgucVD1i9R/VwIhv6gXNsgRGnHoRSWElky','2021-01-06 09:43:55'),
('technodeviser007@gmail.com','$2y$10$.Efd8kB9rkWjq3WRqMgAA.hekCFEFoFy9MZlfqnaN.eL3myZ.91WO','2021-02-11 06:44:40');

/*Table structure for table `routesmanagers` */

DROP TABLE IF EXISTS `routesmanagers`;

CREATE TABLE `routesmanagers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_slag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `routesmanagers` */

insert  into `routesmanagers`(`id`,`route_name`,`route_slag`,`route_url`,`module_name`,`route_action`,`created_at`,`updated_at`) values 
(1,'admin.home',NULL,'admin','dashboard','View',NULL,'2021-02-12 12:13:16'),
(2,'admin.hostings.index',NULL,'admin/hostings','hostings','View',NULL,NULL),
(3,'admin.hostings.create',NULL,'admin/hostings/create','hostings','Add',NULL,NULL),
(4,'admin.users.create',NULL,'admin/users/create','users','Add',NULL,NULL);

/*Table structure for table `sliders` */

DROP TABLE IF EXISTS `sliders`;

CREATE TABLE `sliders` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `image` text NOT NULL,
  `heading_first` varchar(300) NOT NULL,
  `heading_second` varchar(300) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `sliders` */

insert  into `sliders`(`id`,`user_id`,`image`,`heading_first`,`heading_second`,`text`,`created_at`,`updated_at`) values 
(7,11,'6309_2.png','The Best Web Hosting','Starting at $12.95/month*','Everything you will EVER need to Host and Manage your Website!','2021-02-11 11:23:55','2021-02-11 11:23:55'),
(9,11,'1890_1.png','The Best Web Hosting','Starting at $12.95/month*','Everything you will EVER need to Host and Manage your Website!','2021-02-12 06:30:11','2021-02-12 06:31:31');

/*Table structure for table `user_permissions` */

DROP TABLE IF EXISTS `user_permissions`;

CREATE TABLE `user_permissions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_permissions` */

insert  into `user_permissions`(`id`,`user_id`,`route_id`,`created_at`,`updated_at`) values 
(1,'9','1','2020-12-17 13:42:43','2020-12-17 13:42:43');

/*Table structure for table `userroles` */

DROP TABLE IF EXISTS `userroles`;

CREATE TABLE `userroles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `userroles` */

insert  into `userroles`(`id`,`role_name`,`created_at`,`updated_at`) values 
(1,'developer',NULL,NULL),
(2,'test',NULL,NULL),
(5,'testimonials',NULL,NULL),
(6,'newtest',NULL,NULL),
(7,'newtest2',NULL,NULL),
(8,'newtest3',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `user_role` bigint(20) NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`phone_number`,`primary_number`,`address`,`city`,`country`,`postal_code`,`email`,`email_verified_at`,`is_admin`,`user_role`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(11,'Testuser','1234567890','1234567980','Unnamed Road, Azad Nagar, Jagir Ammapalayam, Salem, Tamil Nadu 636302, India','Rohtak','India','124001','technodeviser04@gmail.com',NULL,1,1,'$2y$10$iPSk6qEr6r84Y45vECBXXOtRBHojJrqg9tz35taLwjGQ8w3AIts7W',NULL,'2021-01-18 07:09:04','2021-03-02 07:12:47'),
(19,'Nastya',NULL,'1234657980','chandigarh','Chandigarh','India','124001','nastyaplisova@gmail.com',NULL,NULL,0,'$2y$10$M6o1qttiI2GnUNMaw1eWD.kfmermtfrTiIgN7iqrWXTSR0u3lUqWe',NULL,'2021-03-02 10:37:16','2021-03-02 13:06:41');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
