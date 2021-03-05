/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.6.42-84.2 : Database - homeshom_lyreco
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `business_units` */

DROP TABLE IF EXISTS `business_units`;

CREATE TABLE `business_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `is_hidden` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

/*Data for the table `business_units` */

insert  into `business_units`(`id`,`department_name`,`picture`,`is_hidden`,`created_at`,`updated_at`,`deleted_at`) values 
(13,'Finance','businessUnit/oOX4MbsTKS.png',0,'2020-12-25 19:23:46','2021-02-11 15:25:29',NULL),
(14,'Supply Chain','businessUnit/KEOnTDwPD9.png',0,'2020-12-25 19:23:46','2021-01-29 12:36:04',NULL),
(34,'QSS','businessUnit/4GLQKPCSmB.png',0,'2021-01-18 10:39:38','2021-02-08 10:39:13',NULL),
(39,'Business Services','businessUnit/HzZ4uLxI8e.png',0,'2021-01-29 09:25:42','2021-02-05 12:55:48',NULL),
(40,'Sales','businessUnit/yxlk2F5Mp2.png',0,'2021-01-29 09:27:22','2021-02-05 12:57:07',NULL),
(56,'Marketing','businessUnit/VaUlUcwe5B.png',0,'2021-02-05 12:58:15','2021-02-09 07:52:21',NULL),
(58,'People & Culture','businessUnit/EDj1odcnS2.png',0,'2021-02-09 08:51:25','2021-02-09 08:51:25',NULL);

/*Table structure for table `email_templates` */

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_code` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `template_subject` text,
  `template_content` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `email_templates` */

insert  into `email_templates`(`id`,`template_code`,`template_name`,`template_subject`,`template_content`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'sign_up','Sign Up Welcome Message','Lyreco Project Reporting Tool: Your login credentials','<p>Dear [RECEIVER NAME],<br /><br />welcome to the Lyreco Project Reporting Tool.<br /><br />Below please find your login credentials.<br /><strong>Username:</strong> [EMAIL] <br /><strong>Password:</strong> [PASSWORD]<br /><br /><strong>URL: </strong>[LINK]<br /><br />HAVE AN ENJOYABLE DAY!</p>\r\n<h5>Should you encounter any problems please, send an email to <a title=\"marcel.pflug@lyreco.com\" href=\"mailto:marcel.pflug@lyreco.com\">marcel.pflug@lyreco.com</a></h5>','2020-12-23 11:14:22','2021-02-09 09:02:17',NULL),
(2,'project_created','New Project Created','New project: [PROJECT TITLE]','<p>Dear [RECEIVER NAME],</p>\r\n<p>a new project with the title [PROJECT TITLE] has been created.</p>\r\n<p>For more details please click [PROJECT LINK]</p>','2020-12-23 16:57:41','2021-02-08 07:36:14',NULL),
(3,'update_status','Update Status For Project','Overdue update status for project [PROJECT TITLE]','<p>Dear [PROJECT MANAGER NAME],</p>\r\n<p>your update for project [PROJECT TITLE] is overdue.</p>\r\n<p>Please update the status by the end of the day.</p>\r\n<p>Please follow the link to update your status report: [PROJECT LINK]</p>\r\n<p>Many thanks,<br />Lyreco Project Management Office</p>\r\n<p>&nbsp;</p>\r\n<p>[PROJECT TITLE]</p>\r\n<p>[PROJECT MANAGER NAME]</p>','2021-01-04 18:07:49','2021-02-08 15:18:37',NULL),
(4,'reset_password','Reset Password Link','Password Reset Link','<p>Dear [RECEIVER NAME],</p>\r\n<p>please follow the link below to reset your password:</p>\r\n<p>[PASSWORD LINK]</p>\r\n<h5>Should you encounter any problems please, send an email to <a title=\"marcel.pflug@lyreco.com\" href=\"mailto:marcel.pflug@lyreco.com\">marcel.pflug@lyreco.com</a></h5>','2021-01-18 12:05:46','2021-02-08 04:52:58',NULL),
(5,'project_health_update','Project Health Update','Status change for project  [PROJECT TITLE]','<p>Dear [RECEIVER NAME],</p>\r\n<p>the status of [PROJECT TITLE] has changed and might need your attention.</p>\r\n<p>Please check the updated status here:[PROJECT LINK].</p>','2021-01-29 12:27:49','2021-02-08 07:38:28',NULL),
(6,'project_details_changed','Project Details Changed','Details of project  [PROJECT TITLE] updated','<p>Dear [RECEIVER NAME],</p>\r\n<p>the details of project [PROJECT TITLE] have been changed by [PROJECT MANAGER NAME].</p>\r\n<p>For more details please click [PROJECT LINK].</p>','2021-01-29 12:42:15','2021-02-08 07:33:57',NULL),
(7,'project_details_changed_sponsor','Project Details Changed (Sponsor Email)','Details of project  [PROJECT TITLE] updated','<p>Dear Sponsor [RECEIVER NAME],</p>\r\n<p>the details of project [PROJECT TITLE] have been changed.</p>\r\n<p style=\"text-align: left;\">[PROJECT LINK]</p>\r\n<p style=\"text-align: left;\">Note: Email to sponsor</p>','2021-02-03 10:39:33','2021-02-08 15:36:51',NULL),
(8,'done_but_active_reminder','Done But Active Reminder','Project [PROJECT TITLE] is no longer visible','<p>Dear [RECEIVER NAME],</p>\r\n<p>The end date of procect [PROJECT TITLE] has been<br />reached. As your project seems to be finished, it will no longer appear on<br />the front-end. Should your project still be active, please adjust the project<br />end date in your project settings.</p>\r\n<p>If your project is finished, please contact your sponsor or the PMO in order to archive the project.</p>\r\n<p>Many thanks,</p>\r\n<p>PMO</p>','2021-02-24 06:43:29','2021-02-25 09:32:16',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`email`,`token`,`created_at`) values 
('nastyaplisova@gmail.com','$2y$10$lrEyo9hjxsIZv040b/oreu4RD2AkDd8S9xmbw5XNMk.j4Vaf9tLKy','2021-01-18 13:16:12'),
('super@admin.com','$2y$10$rgwCe8HKLTZ/X1VgAyihie0JBD76uodj.58zHma.BQmwYMbPS/6b.','2021-01-19 05:49:20'),
('technodeviser05@gmail.com','$2y$10$k37xk4SaWHLkoYl28ZdXyuaXMQmwQ4vE0ogdCNSjRMZiLLPCAXL3O','2021-02-08 05:51:18'),
('guest@lyreco.com','$2y$10$IejCNLc3V2F4yuHqyy1VFeFtaYadwTYloxrPDbHWUX1DRWEGQiNzm','2021-02-18 11:03:26'),
('a@b.com','$2y$10$mWR2HME.69RjWIMB3KolnOuTRqH7ZxzIwS468iU0VvoSngysufRQy','2021-02-22 09:49:11'),
('technodeviser04@gmail.com','$2y$10$jGr93Q88JX6/Kq42Dm2V2et1pha2xk9EkSLSwyGAc8rzvjTR2yO.u','2021-03-03 07:50:01'),
('marcel@pflug.cc','$2y$10$hFVPr6wUw5DrheNfcFp4pe4oYnyRVFsyu7We2pB44Sv773RTtPYhC','2021-03-03 08:39:18');

/*Table structure for table `project_documents` */

DROP TABLE IF EXISTS `project_documents`;

CREATE TABLE `project_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(245) DEFAULT NULL,
  `fk_projectId` int(11) DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=latin1;

/*Data for the table `project_documents` */

insert  into `project_documents`(`id`,`document`,`fk_projectId`,`is_public`,`created_at`,`updated_at`) values 
(129,'time-icon.png',17,1,'2021-02-12 11:03:30','2021-02-12 11:03:30'),
(132,'2021 01 29 COS BIT PITCH.pptx',17,0,'2021-02-12 11:14:54','2021-02-12 11:14:54'),
(133,'Lyreco CoffeSolutions logo RGB.png',17,0,'2021-02-12 11:14:54','2021-02-12 11:14:54'),
(134,'COS.jpg',28,1,'2021-02-12 11:37:06','2021-02-12 11:37:06'),
(135,'Projekt XLR8.pdf',28,0,'2021-02-12 11:37:06','2021-02-12 11:37:06');

/*Table structure for table `project_members` */

DROP TABLE IF EXISTS `project_members`;

CREATE TABLE `project_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_projectId` int(11) DEFAULT NULL,
  `fk_username` varchar(200) NOT NULL,
  `fk_userId` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Data for the table `project_members` */

insert  into `project_members`(`id`,`fk_projectId`,`fk_username`,`fk_userId`,`created_at`,`updated_at`) values 
(13,14,'test',NULL,'2021-02-01 07:49:05','2021-02-01 07:49:05'),
(24,30,'Tony',NULL,'2021-02-02 08:28:18','2021-02-02 08:28:18'),
(25,30,'Martin',NULL,'2021-02-02 08:28:24','2021-02-02 08:28:24'),
(26,30,'Maria',NULL,'2021-02-02 08:28:30','2021-02-02 08:28:30'),
(27,30,'Mike',NULL,'2021-02-02 08:28:35','2021-02-02 08:28:35'),
(28,30,'Susan',NULL,'2021-02-02 08:28:41','2021-02-02 08:28:41'),
(32,17,'sfgsgfs',NULL,'2021-02-03 05:39:15','2021-02-03 05:39:15'),
(33,17,'sfsdf',NULL,'2021-02-03 05:39:17','2021-02-03 05:39:17'),
(34,17,'sfs',NULL,'2021-02-03 05:39:18','2021-02-03 05:39:18'),
(46,17,'Markus',NULL,'2021-02-03 11:06:03','2021-02-03 11:06:03'),
(47,17,'maria',NULL,'2021-02-03 11:06:09','2021-02-03 11:06:09'),
(48,17,'tony',NULL,'2021-02-03 11:06:15','2021-02-03 11:06:15'),
(53,13,'Axel Deibler',NULL,'2021-02-11 06:27:58','2021-02-11 06:27:58'),
(54,13,'Marco Muscarello',NULL,'2021-02-11 06:28:28','2021-02-11 06:28:28'),
(55,13,'Rahel Blattmann',NULL,'2021-02-11 06:28:38','2021-02-11 06:28:38'),
(56,28,'Rahel Blattmann',NULL,'2021-02-12 09:01:39','2021-02-12 09:01:39'),
(57,28,'Raoul Marechal',NULL,'2021-02-12 09:01:51','2021-02-12 09:01:51'),
(58,28,'Axel Deibler',NULL,'2021-02-12 09:02:06','2021-02-12 09:02:06'),
(59,28,'Marco Muscarello',NULL,'2021-02-12 09:02:15','2021-02-12 09:02:15'),
(60,28,'Reto Bucher',NULL,'2021-02-12 09:02:24','2021-02-12 09:02:24'),
(61,28,'Angelo Sebben',NULL,'2021-02-12 09:02:41','2021-02-12 09:02:41');

/*Table structure for table `project_status` */

DROP TABLE IF EXISTS `project_status`;

CREATE TABLE `project_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_projectId` int(11) DEFAULT NULL,
  `overall_status` text,
  `percentage_completion` int(11) DEFAULT '0',
  `real_start_date` date DEFAULT NULL,
  `realistic_end_date` date DEFAULT NULL,
  `current_quality` varchar(255) DEFAULT '3',
  `current_quality_explanation` text,
  `cost_situation` varchar(255) DEFAULT '3',
  `cost_situation_explanation` text,
  `time_planning` varchar(255) DEFAULT '3',
  `time_planning_explanation` text,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `project_status` */

insert  into `project_status`(`id`,`fk_projectId`,`overall_status`,`percentage_completion`,`real_start_date`,`realistic_end_date`,`current_quality`,`current_quality_explanation`,`cost_situation`,`cost_situation_explanation`,`time_planning`,`time_planning_explanation`,`updated_by`,`created_at`,`updated_at`,`deleted_at`) values 
(4,17,'What is the current overall status of the project?\r\nWhat is the current overall status of the project?\r\n\r\nWhat is the current overall status of the project?',0,'2021-01-28','2021-02-28','1','Why? What is needed to get back on track?','1','We have way to high costs. Lets plan a bank robbery.','2','Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\n\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\n\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\n\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\n\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\n\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?Why? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?\r\nWhy? What is needed to get back on track?',NULL,'2021-01-18 14:03:48','2021-02-15 05:00:31',NULL),
(10,13,'Die erste Marktsituation untermauert mit effektiven Zahlen plus diverse andere Analysen wurde an Walter am 19.12. präsentiert. Er war sehr zufrieden und wir sind auf dem richtigen Weg. \r\n\r\nErledigt\r\n- NBS Privatkunden wurden identifiziert, im GOP Bereich aus den Portfolios der GV genommen und in ein spezifischen Account verschoben, da diese für GOP nicht relevant sind.\r\n- 45 k CA Datensätze wurden in die Quarantäne verschoben und restliche 50 k an Bisnode für das Enrichment zugestellt\r\n- Geomapping der Segemente auf Karte abgebildet\r\n- Diverse Analysen getätigt\r\n- Postfachadressbereinigung seitens CS\r\n\r\nOn Going\r\n- Zusammenarbeit mit Bisnode im Aufbau der Lyreco/Bisnode Daten im BI Tool \r\n- Diverse Strategie Workshop im Gange',23,'2022-01-29','2023-01-29','1','Aufgrund knapper Ressourcen und hoher Dringlichkeit schleichen sich Fehler ein','1','Budget wird um 20% überschritten','2','3 Monate überfällig aufgrund Lieferschwierigkeiten von Server',NULL,'2021-01-29 06:18:10','2021-02-11 06:35:35',NULL),
(11,14,NULL,0,NULL,NULL,'3',NULL,'3',NULL,'3',NULL,NULL,'2021-01-29 06:18:14','2021-01-29 10:59:01',NULL),
(21,28,'Vorbereitungen für den Start sind abgeschlossen. Derzeit ist das \"GO\" seitens Gruppe noch ausstehend. Project Pitch ist für den 24.02.2021 vorgesehen. \r\n\r\nStart der \"Sprint Planning\" Workshops ist für Mai/Juni 2021 geplant. Vor dem Start der Workshops wird ein Refresher-Workshop stattfinden, um alle Projektmitglieder auf den gleichen Stand zu bringen.',5,'2021-06-16','2022-10-31','3','Anforderungen wurden mit Softwarepartner geklärt. Derzeit alles i.O.','3','Budgetiert. Finales \"GO\" seitens Gruppe noch ausstehend.','3','Zeitplan wurde komplett neu überarbeitet. Re-Start des Projektes im Mai/Juni 2021.',NULL,'2021-01-29 12:21:23','2021-02-22 07:04:27',NULL),
(23,30,NULL,0,NULL,NULL,'3',NULL,'3',NULL,'3',NULL,NULL,'2021-02-01 06:02:33','2021-02-01 06:02:33',NULL),
(51,58,'sfsdfsdsf',4,'2021-02-03','2021-03-10','3','fsdfd','3','gdfsgsgd','3','sdfsdf sfsdf sdfsdfsf',NULL,'2021-02-09 09:10:49','2021-03-03 05:34:47',NULL),
(52,59,NULL,0,NULL,NULL,'3',NULL,'3',NULL,'3',NULL,NULL,'2021-02-11 14:04:50','2021-02-11 14:04:50',NULL);

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(255) DEFAULT NULL,
  `fk_businessUnitId` int(11) DEFAULT NULL,
  `sponsor_name` varchar(255) DEFAULT NULL,
  `sponsor_email` varchar(255) DEFAULT NULL,
  `project_manager` int(11) DEFAULT NULL,
  `estimated_start_date` date DEFAULT NULL,
  `estimated_end_date` date DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `is_group` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT '0',
  `picture` varchar(255) DEFAULT NULL,
  `project_description` text,
  `current_situation` text,
  `project_objective` text,
  `prerequisite_dependencies_exclusions` text,
  `alternative_or_options` text,
  `milestones` text,
  `required_resources` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Data for the table `projects` */

insert  into `projects`(`id`,`project_title`,`fk_businessUnitId`,`sponsor_name`,`sponsor_email`,`project_manager`,`estimated_start_date`,`estimated_end_date`,`is_public`,`is_group`,`is_active`,`is_archive`,`picture`,`project_description`,`current_situation`,`project_objective`,`prerequisite_dependencies_exclusions`,`alternative_or_options`,`milestones`,`required_resources`,`created_at`,`updated_at`,`deleted_at`) values 
(13,'Coffee Operation Systems',14,'Sponsor 1','marcel@pflug.cc',15,'2021-02-04','2021-02-18',1,1,1,0,'projectFJC9MM6qiz.png','Aktuell operieren wir in den zwei \r\nVertriebsorganisationen Worksupplies (WS) und Nespresso Business Solution (NBS) mit  zwei Sales Forces; WS mit rund 60 Verkäufer/innen (national) und NBS mit rund 55 Verkäufer/innen (DE-CH). Zielgruppen bzw. Entscheider in den Unternehmen sind oft unterschiedlich, doch die Ziel-Unternehmensgrösse in beiden Organisationen gleich: 1-249 Mitarbeitende. Die Anforderungen an die Marktbearbeitung sind unterschiedlich (NBS: high-involvement product, Geschmackstest, Brand, vor Ort Erlebnis, sehr bewusste Entscheidung für oder gegen ein Coffee-Brand, schmales Produktsortiment / \'mono-Produkt\'. WS: low-involvement product, Bedarfsanalyse, breites (z.T. komplexes) Sortiment und hohe Vergleichbarkeit)','Die erste Marktsituation\r\n untermauert mit effektiven Zahlen plus diverse andere Analysen wurde an Walter am 19.12. präsentiert. Er war sehr zufrieden und wir sind auf dem richtigen Weg.','Alle bereits getätigten\r\n Analysen soweit aktualisieren und Präsentation für Marly aufbereiten. Je nach Entscheiden, werden weitere Analysen getätigt die für die Entscheidungsfindung relevant sind. \r\nCS/Doris hat den Auftrag Daten im System zu bereinigen, n/a','- Zusammenarbeit mit Bisnode im Aufbau der Lyreco/Bisnode Daten im BI Tool \r\n- Diverse Strategie Workshop im Gange','-Geomapping der Segemente auf Karte abgebildet\r\n- Diverse Analysen getätigt\r\n- Postfachadressbereinigung seitens CS','NBS Privatkunden wurden identifiziert,\r\n im GOP Bereich aus den Portfolios der GV genommen und in ein spezifischen Account verschoben, da diese für GOP nicht relevant sind.\r\n45 k CA Datensätze wurden in die Quarantäne verschoben und restliche 50 k an Bisnode für das Enrichment zugestellt','3 Personen Projektmitarbeit,  \r\n230k Software,  \r\nServerressourcen','2021-01-12 09:41:04','2021-02-12 04:49:19',NULL),
(14,'Coffee Operation Systems (Private)',14,'Sponsor 2','marcel.pflug@lyreco.com',15,'2021-01-21','2021-01-31',1,1,1,0,'projectQ0v3naXjP9.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-01-12 09:41:05','2021-02-25 08:46:22',NULL),
(17,'Austin Project',13,'Sponsor Named','markhurrley@gmail.com',3,'2021-01-19','2021-04-23',0,1,1,0,NULL,'jljljljl \r\njljljljl','esfded\r\n       esfded','Project objective(s) and expected benefits (Specific, Measurable, Accepted, Realistic, Timed)\r\n\r\nProject objective(s) and expected benefits (Specific, Measurable, Accepted, Realistic, Timed)','Prerequisites, dependencies and exclusions (if applicable)\r\nPrerequisites, dependencies and exclusions (if applicable)','Alternatives, Options\r\nAlternatives, Options Alternatives, Options','dfgdg\r\ndfgdg','45645\r\n45645','2021-01-18 13:35:55','2021-02-25 04:28:06',NULL),
(28,'XLR8',40,'Thomas Illi','marcel.pflug@lyreco.com',15,'2019-10-29','2021-01-29',1,0,1,0,'projectbp62YCrv7J.png','Schneller, effizienter, leistungsfähiger. Unsere Vending und Coffee Operating Services erhalten ein Update. Angepasste Prozesse und nagelneue Software helfen uns, unsere interne Abwicklung weiter zu professionalisieren und die Zufriedenheit unserer Vending Kunden stetig zu steigern. Durch die Anpassungen minimieren wir administrative Aufgaben, verschlanken unsere Abwicklung, erleichtern die abteilungs- und teamsübergreifende Zusammenarbeit und schaffen mehr Transparenz in der gesamten Wertschöpfungskette. Wir haben mehr Zeit um uns auf unsere wesentlichen Aufgaben zu fokussieren.','Aktuell verwenden wir verschiedenste Systeme zur Abwicklung unserer \"Coffee Operating Services\" (COS). Der Datenaustausch zwischen den Systemen und die Abwicklung der Prozesse verläuft in vielen Bereichen semi-automatisch oder manuell. Verzögerungen, Abwicklungsfehler, eingeschränkte Analyse- und Planungsmöglichkeiten machen das Handling schwerfällig. Der hohe administrative Aufwand zieht eine hohe Bindung von Ressourcen mit sich. Mit jedem neuen Kunden steigen die Kosten (über-)proportional.','Durch die angeschaffte Software und die Optimierung/Verschlankung der Prozesse sollen Synergien in allen involvierten Abteilungen freigesetzt werden. Wir erwarten eine deutliche Reduktion der administrativen Aufgaben und der Kosten. Durch die Prozessoptimierung und dem Einsatz professioneller Software können wir uns voll auf Wachstum in diesem Segment fokussieren und erwarten einen deutlichen Anstieg der Umsätze im COS.\r\n\r\n- Kosteneinsparungen von 65\'000 CHF in 2022 bis 325\'000 CHF in 2025\r\n- Reduktion der administrativen Aufwände um 60% in 2022 bis 80% in 2025\r\n- Umsatzwachstum um ca. 2 Mio. p.a. (2022 - 2025)','- Das Projekt wird mit agilen Projekmanagementmethoden durchgeführt. Dies bedingt insbesondere für die 3 Basis-Workshops eine physische Durchführung. Corona-Einreisebestimmungen müssen gelockert werden und Meetings von mehr als 5 Personen möglich sein.  \r\n- Sprints sind kurz und intensiv. Die bei den Sprints beteiligten Mitarbeiter müssen während Workshops 100% verfügbar sein und während der Sprint Phase mind. 50% pro Tag.\r\n- Erst mit Abschluss der 3 Basis-Workshops kann abschliessend evaluiert werden, ob die Durchführung des Projektes mit dem gewählten Partner und der gewählten Software möglich ist.\r\n- Die Sprints werden sequentiell abgearbeitet. Erst wenn eine Sprint abgeschlossen ist, kann mit dem nächsten Sprint begonnen werden.\r\n- Für die Integration einer automatischen FIBU Schnittstelle in SAP sind wir auf die Zusammenarbeit der Lyreco Gruppe angewiesen (RFD).','Beibehaltung der aktuellen Prozesse bei gleichzeitiger Einstellung eines zusätzlichen Backoffice-Mitarbeiters pro Jahr. Gefahr dass sich Kosten bei Verfolgung der Wachstumsziele überproportional erhöhen und Kundenzufriedenheit durch langatmige und fehleranfällige Prozesse sinkt.','- Durchführung der 3 Basis-Workshops\r\n- Kauf Lizenzen, Hardware, Software\r\n- Integration und Onboarding eines Pilot-Kunden\r\n- On-Boarding aller Kunden\r\n- Integration von automatischer Schnittstelle','- Finanziell: Initialinvestment 185k | laufende Kosten für Lizenzen, Schnittstellen, Hosting ca. 10k/mM\r\n- Personell: Kernprojektteam 6 Personen + 1 Projektleiter (100 % während Workshops / 40 % während Sprints (täglich)\r\n- Sachbezogen: Server, Hosting, Software (Initialinvestment: Software 4000 CHF | Laufende Kosten: 10k/M)','2021-01-29 12:21:23','2021-03-03 05:25:49',NULL),
(30,'WorldTradeCente WorldTradeCenter World Trade Center World Trade Center',13,'Developer','test@test.com',2,'2021-02-02','2021-02-16',1,1,0,0,'projectUSvt34DbiU.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-02-01 06:02:33','2021-03-02 05:13:39',NULL),
(58,'Digital Boardroom',13,'Dr. Marcel Pflug','marcel.pflug@lyreco.com',15,'2021-02-06','2021-03-31',0,0,0,1,'projectV0o1PXUVwp.png','sfdsff','sdfsf','sdfsf','sdf','sdfsd','sdfsf','sdf','2021-02-09 09:10:49','2021-03-04 10:30:20',NULL),
(59,'Neues Projekt',13,'Martin','marcel@pflug.cc',2,'2021-02-16','2021-02-26',1,1,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2021-02-11 14:04:50','2021-02-11 14:04:50',NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(240) NOT NULL,
  `admin_panel` tinyint(1) NOT NULL DEFAULT '0',
  `project_management_panel` tinyint(1) NOT NULL DEFAULT '0',
  `reporting_panel` tinyint(1) NOT NULL DEFAULT '0',
  `front_end_view_panel` tinyint(1) NOT NULL DEFAULT '0',
  `alerts` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`admin_panel`,`project_management_panel`,`reporting_panel`,`front_end_view_panel`,`alerts`,`is_active`,`created_at`,`updated_at`) values 
(1,'Super Admin',1,1,1,1,1,1,'2020-12-21 12:36:45','2021-01-19 07:17:01'),
(2,'Guest',0,0,0,0,0,1,'2020-12-24 10:43:53','2021-02-22 05:48:50'),
(3,'User',1,1,1,1,1,0,'2020-12-22 04:34:46','2021-02-18 05:13:31'),
(5,'Developer',0,0,1,1,0,0,'2021-01-06 05:59:15','2021-01-27 12:50:44'),
(6,'test',0,0,0,0,0,0,'2021-01-07 06:19:32','2021-01-26 14:34:32'),
(7,'test',1,1,1,1,1,0,'2021-01-07 06:25:55','2021-02-02 14:48:46'),
(11,'fsdfsdfsdfsdf',1,0,0,0,0,0,'2021-01-15 11:12:18','2021-01-18 09:58:00'),
(14,'Project Manager',0,1,0,0,0,1,'2021-01-18 13:24:45','2021-01-27 12:51:36'),
(16,'Admin',1,1,1,1,0,1,'2021-01-26 14:34:04','2021-02-08 12:07:30'),
(18,'Management',0,0,1,1,1,1,'2021-01-27 12:45:33','2021-02-09 13:42:39'),
(20,'Test Role',0,1,1,0,0,0,'2021-01-27 12:55:54','2021-01-27 13:07:21'),
(22,'Project Director',0,1,1,1,1,0,'2021-01-29 14:10:51','2021-02-09 08:52:23'),
(23,'Project Director',0,1,1,1,1,1,'2021-02-09 08:54:33','2021-02-09 08:54:33'),
(25,'Frontend',0,0,0,1,0,1,'2021-02-11 05:37:59','2021-02-18 09:46:36');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_title` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(30) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`avatar`,`job_title`,`role`,`email`,`is_active`,`email_verified_at`,`password`,`remember_token`,`language`,`created_at`,`updated_at`) values 
(1,'Super Admin','uJTZwtZFpz0tYjKoJNXMg53VH9Yvyz9QkFqyPnkq.png','IT Admin',1,'super@admin.com','1','2021-01-20 16:37:42','$2y$10$B9QVshvDzYn60vULFFB8U.gTYHteYWarSwJps2gbL58JGssurRcMq',NULL,'en','2020-12-17 02:53:46','2021-01-27 15:35:44'),
(2,'Lyrecaner',NULL,'Guest user',2,'lprt@lyreco.com','1',NULL,'$2y$10$XY40XyacgTbNwZi0ygB9hO.qbhKxUAZWKl9Ov5BoGADtXAQvx5vze','hwj4Wx3osX7MD28obeMAv0DdMvAbmItCcAUGF0d7pIdzV1HBOEvK6NAa3X0B','de',NULL,'2021-03-03 08:35:45'),
(3,'testUser','avatar/3Q1C7D1Fha.png','Quality Assurane',1,'technodeviser04@gmail.com','1','2020-09-22 16:37:47','$2y$10$LGDwsRDMO50nlpIjCufiM.dy9yulqlcnaFBpflO0RRlz2BJUMN5li','FxG0XvoAp2OHwqkWNQmW14hQIqeMyAyEpm06GhBiqK308acLXFX1TpnLlEr4','fr','2020-12-17 02:53:46','2021-03-04 11:48:08'),
(4,'Nastya','uJTZwtZFpz0tYjKoJNXMg53VH9Yvyz9QkFqyPnkq.png',NULL,23,'nastyaplisova@gmail.com','1',NULL,'$2y$10$B9QVshvDzYn60vULFFB8U.gTYHteYWarSwJps2gbL58JGssurRcMq',NULL,'en','2021-01-06 11:53:56','2021-02-12 11:23:42'),
(5,'daniel.zaino','uJTZwtZFpz0tYjKoJNXMg53VH9Yvyz9QkFqyPnkq.png',NULL,16,'daniel.zaino@lyreco.com','1',NULL,'$2a$04$TKnknCkEaKyHonBu4dhuI.mZImCw6EEmHBkebX3YhJy7y2kHFtwKK',NULL,'en','2021-01-08 13:27:12','2021-01-26 14:39:44'),
(6,'USER','uJTZwtZFpz0tYjKoJNXMg53VH9Yvyz9QkFqyPnkq.png',NULL,3,'User@gmail.com','0',NULL,'$2y$10$B9QVshvDzYn60vULFFB8U.gTYHteYWarSwJps2gbL58JGssurRcMq',NULL,'en','2021-01-12 06:41:13','2021-01-26 14:39:52'),
(7,'test',NULL,NULL,14,'technodeviser02@gmail.com','1',NULL,'$2y$10$VvgP/lwRDd/0nhyQSa.hDuFSLDlTjwZq0X5h/1ZoXYwTN6rCXQU.O',NULL,'en','2021-01-12 07:18:01','2021-02-08 13:12:37'),
(10,'new user','avatar/Jt4eZvfQe8.png',NULL,1,'technodeviser05@gmail.com','1',NULL,'$2y$10$fRvXRLSpERQcFYNt0OM56uyOdbA7mvM9/u4JAyyK.BQQxmenSWqQG','IC10rDNQqn4y16UHhQ76NKVFCDHiUGNHYlFxg2KAcSSKIkaN4Ehfrs7SfAmf','en','2021-01-12 08:21:49','2021-03-02 06:27:50'),
(11,'dz_test',NULL,NULL,5,'loniaz15@hotmail.com','0',NULL,'$2y$10$5Bg7REcs5Ip0mExoL8/YdOm7hNdHrcV2uEln.ghJDZrX651KNFbv.',NULL,'en','2021-01-14 10:07:19','2021-01-19 13:46:14'),
(12,'yhyt',NULL,NULL,18,'admin@gmail.com','0',NULL,'$2y$10$Xr9h8SoCBylMgGUmSSeoiel0JhnPzb5.TE69noinSA5vO92mWMUlK',NULL,'en','2021-01-18 07:38:50','2021-02-05 13:00:30'),
(13,'Developer Test','avatar/3wKSb0AYUI.png',NULL,18,'markhurrley@gmail.com','1',NULL,'$2y$10$oMiZ5X.F2cOs23pPjvb7r.TaI3/pwpXtiSLLy/hJpl9trvdG8.2Hu',NULL,'en','2021-01-18 13:28:24','2021-01-29 08:11:46'),
(14,'DZ',NULL,NULL,14,'daniel.zaino+1@lyreco.com','0',NULL,'$2y$10$Bq/A/b8ZYVvVGIF9kOKbguJODzR37LS/ZEUJ/r6As/kSwbNdVp3WS',NULL,'en','2021-01-19 13:44:53','2021-01-26 14:40:02'),
(15,'Marcel','avatar/aLQ8Y00DZZ.png','Head of Corporate Development',1,'marcel@pflug.cc','1',NULL,'$2y$10$XcvtlbWNcRxEWP9.6FGCq.dtvl4vZ/XT.BoeYCosJi5T9AgRKhk06','1QGsqmmcmfw2Acw1eUFpHRTIZSDmjf6s04oyZQOtHzElXlCL7y1dbZsBAFNO','de','2021-01-26 14:32:54','2021-03-03 08:39:08'),
(18,'sfsdf',NULL,NULL,18,'test@test.com','0',NULL,'$2y$10$b4ezxWRhJjmTAUWWavDU0O7Ou5jIgP/kU1nOrGhrWYjd/wZXl0rXq',NULL,'en','2021-01-27 13:32:53','2021-02-03 11:15:40'),
(19,'sdfdsf',NULL,NULL,16,'test@test','0',NULL,'$2y$10$6SeXjpELHG9NC7QWVXmVuuCKegkO0PfABYgZtmz9DwBHndwejS75W',NULL,'en','2021-01-27 13:37:23','2021-01-27 13:43:22'),
(21,'sdgfdgfdg',NULL,NULL,18,'tresdz@rt.com','0',NULL,'$2y$10$2zc.huR9ebAjyJkgyLmIP.QnnzJ/Iso/8blZY0YL1AufHYPZY1THC',NULL,'en','2021-02-01 07:36:35','2021-02-01 07:36:50'),
(23,'gfhdfhgh',NULL,NULL,16,'fghgfhfg@gmail','0',NULL,'$2y$10$i2CuPGK8TV5/DIa0AfnK2.JSj.jNk2zou7wKEDw5hnPtDD6GalVfy',NULL,'en','2021-02-02 07:47:21','2021-02-02 07:47:30'),
(24,'sgfgdfgdf',NULL,NULL,16,'admin@gmail.co.in','0',NULL,'$2y$10$kP2q8hSrbaeBb8aHhFdoxOcx07hJqJ987j68CMrADQ9qu1M1SZwMK',NULL,'en','2021-02-02 07:47:43','2021-02-03 08:04:00'),
(31,'JohnDoe 3','',NULL,2,'developertest.nomail@gmail.in','1',NULL,'$2y$10$YPkwP1GAIL6ivRFf226xwOTeGbhBWrZnJROc7VpX9cJR.ubfyDuse',NULL,'en','2021-02-08 13:50:04','2021-03-03 07:57:39'),
(34,'a',NULL,NULL,14,'a@b.com','1',NULL,'$2y$10$bdECet4nW8jiT3j.XHbrc.BcYVbeg.wh7nCMWWjn009AD.kqHX4Wm',NULL,'en','2021-02-09 06:12:01','2021-02-09 06:12:01'),
(36,'Marcel PM',NULL,'Head of Corporate Development',14,'pflug.marcel@gmail.com','1',NULL,'$2y$10$WHXKsvHLJ.xxLRVxuA6Rc.tr/x4GoaIEwy.93COGuDjMzknsVEgaa','UkeRX9azHKSWlAjC6BSF7Dk2fJ488IGVQPDmGmFI2b91Drubn2G32oeB8UgO','en','2021-02-09 07:42:51','2021-02-23 06:40:06'),
(38,'test',NULL,NULL,14,'abc@gmail.com','1',NULL,'$2y$10$y2cSiiMm6pGIXUdqx8J0.ejUvEXZsPkfnGqOD7VbOPVifS6.hV4gC',NULL,'en','2021-02-11 05:38:25','2021-02-11 05:39:18'),
(39,'text guest user',NULL,NULL,2,'guest@gmail.com','1',NULL,'$2y$10$e1fIsRsrL/p4rjJOL60LauIhFTlbMspqfYO2tAWTNV/RKAI43VCYC',NULL,'en','2021-02-22 05:03:50','2021-02-22 05:03:50'),
(42,'Guest User',NULL,NULL,2,'developertest.nomail@gmail.com','1',NULL,'$2y$10$aIlajCueD6LvenLGahjiT.BBDK1lxOQqogaI15MFnT0KqwqSIvEO.','Gkkj5CAD5YMrwn6XyekC8HvhK8TxRbS4Mg5m8pNcFn2XgHWtyAQgSILSmWFU','en','2021-02-22 05:17:30','2021-03-04 11:51:18');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
