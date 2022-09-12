-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table mythauth.auth_activation_attempts
CREATE TABLE IF NOT EXISTS `auth_activation_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_activation_attempts: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_activation_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_activation_attempts` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_groups
CREATE TABLE IF NOT EXISTS `auth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_groups: ~6 rows (approximately)
/*!40000 ALTER TABLE `auth_groups` DISABLE KEYS */;
INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
	(1, 'Superadmin', 'Super Admin lho'),
	(2, 'Admin', 'Admin'),
	(3, 'Manager', 'Manager'),
	(4, 'Staff', 'Staff'),
	(5, 'tessaja', 'tes saja'),
	(9, 'teshagsj', 'hjhgjhg');
/*!40000 ALTER TABLE `auth_groups` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_groups_permissions
CREATE TABLE IF NOT EXISTS `auth_groups_permissions` (
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `permission_id` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  KEY `group_id_permission_id` (`group_id`,`permission_id`),
  CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_groups_permissions: ~4 rows (approximately)
/*!40000 ALTER TABLE `auth_groups_permissions` DISABLE KEYS */;
INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 4),
	(2, 4);
/*!40000 ALTER TABLE `auth_groups_permissions` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_groups_users
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_groups_users: ~5 rows (approximately)
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
	(1, 2),
	(3, 1),
	(4, 3),
	(4, 4),
	(4, 5);
/*!40000 ALTER TABLE `auth_groups_users` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_logins
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_logins: ~22 rows (approximately)
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
	(1, '::1', 'admin', NULL, '2022-08-30 00:27:44', 0),
	(2, '::1', 'admin', NULL, '2022-08-30 00:27:56', 0),
	(3, '::1', 'admin@admin.com', NULL, '2022-08-30 00:29:07', 0),
	(4, '::1', 'admin@example.com', NULL, '2022-08-30 00:30:35', 0),
	(5, '::1', 'Aldi2', 2, '2022-08-30 00:31:15', 0),
	(6, '::1', 'aldi2@aldi.com', 2, '2022-08-30 00:31:37', 1),
	(7, '::1', 'aldi2@aldi.com', 2, '2022-09-01 16:14:46', 1),
	(8, '::1', 'aldi2@aldi.com', 2, '2022-09-02 17:15:06', 1),
	(9, '::1', 'aldi2@aldi.com', 2, '2022-09-02 18:04:28', 1),
	(10, '::1', 'aldi2@aldi.com', 2, '2022-09-02 20:38:25', 1),
	(11, '::1', 'aldi2@aldi.com', 2, '2022-09-03 08:51:45', 1),
	(12, '::1', 'aaa@aa.com', 3, '2022-09-03 12:52:22', 1),
	(13, '::1', 'aldi2@aldi.com', 2, '2022-09-03 19:40:26', 1),
	(14, '::1', 'aldi2@aldi.com', 2, '2022-09-04 02:49:58', 1),
	(15, '::1', 'aldi2@aldi.com', 2, '2022-09-06 08:09:50', 1),
	(16, '::1', 'aldi2@aldi.com', 2, '2022-09-06 14:19:32', 1),
	(17, '::1', 'aldi2@aldi.com', 2, '2022-09-07 20:22:30', 1),
	(18, '::1', 'aldi2@aldi.com', 2, '2022-09-08 11:34:44', 1),
	(19, '::1', 'aldi2@aldi.com', 2, '2022-09-09 08:27:19', 1),
	(20, '::1', 'aldi2@aldi.com', 2, '2022-09-09 08:30:15', 1),
	(21, '::1', 'aldi2@aldi.com', 2, '2022-09-09 08:36:17', 1),
	(22, '::1', 'aldi2@aldi.com', 2, '2022-09-09 20:09:34', 1),
	(23, '::1', 'aldi2@aldi.com', 2, '2022-09-12 10:53:34', 1),
	(24, '::1', 'aldi2@aldi.com', 2, '2022-09-12 22:54:07', 1);
/*!40000 ALTER TABLE `auth_logins` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_permissions
CREATE TABLE IF NOT EXISTS `auth_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_permissions: ~2 rows (approximately)
/*!40000 ALTER TABLE `auth_permissions` DISABLE KEYS */;
INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
	(1, 'user', 'Akses User'),
	(2, 'roles', 'Akses Role'),
	(3, 'roles.add', 'Ijin tambah Role s'),
	(4, 'equipment', 'Akses View Equipment');
/*!40000 ALTER TABLE `auth_permissions` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_reset_attempts
CREATE TABLE IF NOT EXISTS `auth_reset_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_reset_attempts: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_reset_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_reset_attempts` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_tokens
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_tokens_user_id_foreign` (`user_id`),
  KEY `selector` (`selector`),
  CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;

-- Dumping structure for table mythauth.auth_users_permissions
CREATE TABLE IF NOT EXISTS `auth_users_permissions` (
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `permission_id` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  KEY `user_id_permission_id` (`user_id`,`permission_id`),
  CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.auth_users_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_users_permissions` DISABLE KEYS */;
INSERT INTO `auth_users_permissions` (`user_id`, `permission_id`) VALUES
	(2, 1);
/*!40000 ALTER TABLE `auth_users_permissions` ENABLE KEYS */;

-- Dumping structure for table mythauth.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mythauth.ci_sessions: ~52 rows (approximately)
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('17uchnjrjqe3otqevlr5fk5ijgmo11uu', '::1', '2022-09-09 09:11:21', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638393438313B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('19o8tcu4dco21532stc9e9l3hvlu9l29', '::1', '2022-09-09 20:29:19', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323733303135393B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F726F6C6573223B6C6F676765645F696E7C733A313A2232223B),
	('2ru46tv27g3oa5i87ekooga2mb5iurtd', '::1', '2022-09-09 10:34:17', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639343435373B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('3qelchvh7tlhv0tb75nmvt9ssgtpq63l', '::1', '2022-09-09 06:14:10', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637383835303B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('3sos2m5ho3s0es7sa1jqvvhdeikjn5cs', '::1', '2022-09-09 06:04:20', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637383235393B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('40b7q0knvf5nl00a6mr0kbnvrar2jmjb', '::1', '2022-09-09 06:26:59', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637393631393B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('4tknvhtu85vc4b154ppqi0ueauap9t8h', '::1', '2022-09-09 07:42:09', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638343132393B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('6f93c914mo2s9marulmdvqok384krftf', '::1', '2022-09-09 06:04:10', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637383235303B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('6fb452prdhbusbomt9ei3vtj3rat21qa', '::1', '2022-09-09 05:52:47', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637373536373B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('6huch0ir9pjqitaaed4c38o8e4de1ak2', '::1', '2022-09-12 11:08:25', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323935353730353B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B6C6F676765645F696E7C733A313A2232223B),
	('6uvrrn3ofj0bv534ltca2cq0ncgeem82', '::1', '2022-09-09 11:33:16', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639373939363B5F63695F70726576696F75735F75726C7C733A34323A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F3131223B6C6F676765645F696E7C733A313A2232223B),
	('7469dihcuchacer417g7hdavvcajskqi', '::1', '2022-09-09 12:17:38', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323730303633383B5F63695F70726576696F75735F75726C7C733A34323A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F3131223B6C6F676765645F696E7C733A313A2232223B),
	('859hgoasdb7n691bqnptqlufc5dkd6t3', '::1', '2022-09-09 10:26:29', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639333938393B5F63695F70726576696F75735F75726C7C733A35363A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E742F6765745F616C6C5F73656374696F6E3F6F66667365743D35223B6C6F676765645F696E7C733A313A2232223B),
	('a4p3nvdooa8jhhl28714ftbout0ig6j1', '::1', '2022-09-09 08:27:19', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638363833393B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B72656469726563745F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('ak3eb8ml79460rk7km5p4veg0jpj2spn', '::1', '2022-09-09 05:47:38', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637373235383B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('alff9san6jb54nrh6ehm6dbmvk4h8tts', '::1', '2022-09-09 10:41:03', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639343836333B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('apgd2kibbvr4nvb3slio5iipq5eki3s5', '::1', '2022-09-09 09:33:26', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639303830363B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('b8j6orc0q89jc0ikco6qrb53a5d8nuce', '::1', '2022-09-09 08:26:32', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638363739323B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('bhnkrv3h7vq7jt8fms5547ijscs5ouu5', '::1', '2022-09-09 04:30:10', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637323631303B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('c68ucnmrcimc3tl5n7qa7k8i8mpmr29l', '::1', '2022-09-09 11:24:52', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639373439323B5F63695F70726576696F75735F75726C7C733A34323A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F3131223B6C6F676765645F696E7C733A313A2232223B),
	('cahl8tike7dnfucfso2na2e1oe2optut', '::1', '2022-09-12 22:55:46', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323939383034373B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F617264223B6C6F676765645F696E7C733A313A2232223B),
	('ck64u7mlnlii04f90hhtb30bkhtqsvdn', '::1', '2022-09-12 10:53:34', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323935343831343B72656469726563745F75726C7C733A32323A22687474703A2F2F6C6F63616C686F73743A383038302F223B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B),
	('ejhv4qrmr8qq6uleempo2ghq2h03icvq', '::1', '2022-09-09 20:30:16', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323733303135393B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('faajg79h5g4pfqium31c5pjsgg95mons', '::1', '2022-09-09 12:17:18', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323730303633383B5F63695F70726576696F75735F75726C7C733A34323A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F3131223B6C6F676765645F696E7C733A313A2232223B),
	('fltmhaicg55ppc2itmaitaakclbbb81b', '::1', '2022-09-09 09:02:47', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638383936373B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('fsnuj3e4umqvdh02ob2mm82h70up7ju3', '::1', '2022-09-09 06:21:38', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637393239383B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('g8vi0ru5ema8ra04fc54nfrdlr8vo5n0', '::1', '2022-09-09 10:20:41', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639333634313B5F63695F70726576696F75735F75726C7C733A3131383A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E743F6B6F64653D544553303031266E616D615F73656374696F6E3D4D61696E266C6F6B6173693D642669645F617265613D312669645F65717569706D656E743D32266465736372697074696F6E3D546572696D6169617368223B6C6F676765645F696E7C733A313A2232223B),
	('gka5acave85umf91mddk5568l3dvve6t', '::1', '2022-09-12 22:54:07', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323939383034373B72656469726563745F75726C7C733A32323A22687474703A2F2F6C6F63616C686F73743A383038302F223B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B),
	('go1fl5bee650cn62559be3ks8mjifmqv', '::1', '2022-09-09 09:16:22', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638393738323B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('goa50fg0s9l51v2d5ck7j09a0h897358', '::1', '2022-09-12 10:53:34', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323935343831343B72656469726563745F75726C7C733A32323A22687474703A2F2F6C6F63616C686F73743A383038302F223B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B),
	('govkhq3lq6k13h9oekmhc272nr7balb0', '::1', '2022-09-09 07:28:57', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638333333373B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('is7l1repvbg9t5ajq5r2o0bmk92f1per', '::1', '2022-09-09 09:36:25', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639303938353B72656469726563745F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B),
	('jdu2rb5q4h0dlqt6ms15fq0uiuk147b3', '::1', '2022-09-09 07:35:54', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638333735343B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('lkp3faorihfese2hodi53naud21vua5r', '::1', '2022-09-13 06:38:55', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636333032353933353B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('m0r3btgobs7jmvntnv04cgjvdeanvmc1', '::1', '2022-09-09 20:09:34', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323732383937343B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B72656469726563745F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('meiop7cptcnf8ovbouu1t77kvj4jbsv1', '::1', '2022-09-09 19:59:57', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323732383339373B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('nn72k7hjthu95hod6khtvlpr7772oko4', '::1', '2022-09-09 06:38:04', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638303238343B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('nttqpilf0tq3dfd4snf2vmonn74bfbeo', '::1', '2022-09-12 11:08:26', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323935353730353B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('oaaqt0vo6n4btj6q0gf922ta81e3msj7', '::1', '2022-09-09 10:14:52', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639333239323B5F63695F70726576696F75735F75726C7C733A3131383A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E743F6B6F64653D544553303031266E616D615F73656374696F6E3D4D61696E266C6F6B6173693D642669645F617265613D312669645F65717569706D656E743D32266465736372697074696F6E3D546572696D6169617368223B6C6F676765645F696E7C733A313A2232223B),
	('oj9ug5kp8mdka3g4kvfkqraai1rkpsqa', '::1', '2022-09-09 08:35:32', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638373333323B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F726F6C6573223B6C6F676765645F696E7C733A313A2232223B),
	('p7fttajqrpbckg6ijep8p14quq9sf3gf', '::1', '2022-09-09 11:13:22', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639363830323B5F63695F70726576696F75735F75726C7C733A34393A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E743F69643D3226617265613D426F676F722B73223B6C6F676765645F696E7C733A313A2232223B),
	('psj6ln70gu284d74p5kj5en3sj6gortm', '::1', '2022-09-09 19:54:31', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323732383037313B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('qtqhig88poi2m31jtn42s1ccccptop7v', '::1', '2022-09-09 05:38:15', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637363639353B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('rml1k6sj1cb4jbl7t64vih80inkvn6e8', '::1', '2022-09-09 08:36:17', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638373337373B72656469726563745F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F7573657273223B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B),
	('rpnmnk86tfba4ggcvj7ksggjhn0k19nm', '::1', '2022-09-09 06:43:31', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638303631313B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('s4e6s1m9adhtiudiojeef9onceacima7', '::1', '2022-09-09 10:49:45', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639353338353B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('stkdrdi69ots7bh2bq5n3r4b3024jc69', '::1', '2022-09-09 20:05:25', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323732383732353B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('tcv3b9jhnaclheuo209er94nmasds856', '::1', '2022-09-13 06:40:10', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636333032353731393B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('tr3mmiu4llkvsibi52an06fbe5u470g3', '::1', '2022-09-09 10:58:32', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639353931323B5F63695F70726576696F75735F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E74223B6C6F676765645F696E7C733A313A2232223B),
	('tv463b4htl340rlacvlfcldj7tjv0mr7', '::1', '2022-09-09 09:36:25', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639303938353B72656469726563745F75726C7C733A32323A22687474703A2F2F6C6F63616C686F73743A383038302F223B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B),
	('u377po1e9h3br7qavuji3munnoleojbh', '::1', '2022-09-09 08:30:15', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638373031353B72656469726563745F75726C7C733A33313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F617264223B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F6C6F67696E223B),
	('uaoq9eribg080938280vb2kdsb69d1vb', '::1', '2022-09-09 11:04:21', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323639363236313B5F63695F70726576696F75735F75726C7C733A34393A22687474703A2F2F6C6F63616C686F73743A383038302F65717569706D656E743F69643D3226617265613D426F676F722B73223B6C6F676765645F696E7C733A313A2232223B),
	('ucgnt5vnf1pacfqd63c4o2v49dfbkosg', '::1', '2022-09-09 05:28:39', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323637363131393B5F63695F70726576696F75735F75726C7C733A34313A22687474703A2F2F6C6F63616C686F73743A383038302F64617368626F6172642F73656374696F6E2F33223B),
	('v1of32aqdv75qtepv2ltn3dn795o8d43', '::1', '2022-09-09 08:42:03', _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313636323638373732333B5F63695F70726576696F75735F75726C7C733A32373A22687474703A2F2F6C6F63616C686F73743A383038302F726F6C6573223B6C6F676765645F696E7C733A313A2232223B);
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;

-- Dumping structure for table mythauth.data_area
CREATE TABLE IF NOT EXISTS `data_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(50) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='list Area';

-- Dumping data for table mythauth.data_area: ~4 rows (approximately)
/*!40000 ALTER TABLE `data_area` DISABLE KEYS */;
INSERT INTO `data_area` (`id`, `area`, `ket`) VALUES
	(1, 'Jakarta', NULL),
	(2, 'Bogor', NULL),
	(3, 'Cirebon', NULL),
	(4, 'Indramayu', NULL);
/*!40000 ALTER TABLE `data_area` ENABLE KEYS */;

-- Dumping structure for table mythauth.data_equipment
CREATE TABLE IF NOT EXISTS `data_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `rumus` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='list Equipment';

-- Dumping data for table mythauth.data_equipment: ~4 rows (approximately)
/*!40000 ALTER TABLE `data_equipment` DISABLE KEYS */;
INSERT INTO `data_equipment` (`id`, `nama`, `rumus`) VALUES
	(1, 'Vessel', NULL),
	(2, 'Pipeline', NULL),
	(3, 'Tank', NULL),
	(4, 'Piping', NULL);
/*!40000 ALTER TABLE `data_equipment` ENABLE KEYS */;

-- Dumping structure for table mythauth.data_field
CREATE TABLE IF NOT EXISTS `data_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab_group` varchar(100) DEFAULT NULL,
  `tab` varchar(100) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `look_up` varchar(100) DEFAULT NULL,
  `inCoding` varchar(100) DEFAULT NULL,
  `in_DB` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=199 DEFAULT CHARSET=latin1 COMMENT='Data Field';

-- Dumping data for table mythauth.data_field: ~198 rows (approximately)
/*!40000 ALTER TABLE `data_field` DISABLE KEYS */;
INSERT INTO `data_field` (`id`, `tab_group`, `tab`, `label`, `satuan`, `type`, `look_up`, `inCoding`, `in_DB`) VALUES
	(1, 'General Information', 'General', 'Plant', '', 'text_lookup', 'Plant', 'Plant', 'd_Plant'),
	(2, 'General Information', 'General', 'Location Field', '', 'text_lookup', 'LocationField', 'LocationField', 'd_LocationField'),
	(3, 'General Information', 'General', 'Asset Type', '', 'text_lookup', 'AssetType', 'AssetType', 'd_AssetType'),
	(4, 'General Information', 'General', 'Section', '', 'text', '', 'Section', 'd_Section'),
	(5, 'General Information', 'General', 'Pipeline Name', '', 'text', '', 'PipelineName', 'd_PipelineName'),
	(6, 'General Information', 'General', 'Description', '', 'text', '', 'Description', 'd_Description'),
	(7, 'General Information', 'General', 'Pipeline From', '', 'text', '', 'PipelineFrom', 'd_PipelineFrom'),
	(8, 'General Information', 'General', 'Pipeline To', '', 'text', '', 'PipelineTo', 'd_PipelineTo'),
	(9, 'General Information', 'General', 'Pipeline Type', '', 'text_lookup', 'PipelineType', 'PipelineType', 'd_PipelineType'),
	(10, 'Pipeline Description', 'General', 'Length', 'm', 'num', '', 'pipeLength', 'd_pipeLength'),
	(11, 'Pipeline Description', 'General', 'Nominal Diameter', 'inch', 'num', '', 'NominalDiameter', 'd_NominalDiameter'),
	(12, 'Pipeline Description', 'General', 'Pipeline Owner', '', 'text', '', 'PipelineOwner', 'd_PipelineOwner'),
	(13, 'Pipeline Description', 'General', 'Date Installed', '', 'date', '', 'DateInstalled', 'd_DateInstalled'),
	(14, 'Pipeline Description', 'General', 'Year of last internal inspection', '', 'num', '', 'YearoflastInternalInspection', 'd_YearoflastInternalInspection'),
	(15, 'Pipeline Description', 'General', 'Year of last external inspection', '', 'num', '', 'YearoflastExternalInspection', 'd_YearoflastExternalInspection'),
	(16, 'Pipeline Description', 'General', 'KP start', '', 'text', '', 'KPStart', 'd_KPStart'),
	(17, 'Pipeline Description', 'General', 'KP end', '', 'text', '', 'KPEnd', 'd_KPEnd'),
	(18, 'Pipeline Description', 'General', 'Pipeline Position', '', 'text_lookup', 'PipelinePosition', 'PipelinePosition', 'd_PipelinePosition'),
	(19, 'Pipeline Description', 'General', 'Piggable', '', 'Checked', '', 'Piggable', 'd_Piggable'),
	(20, 'Pipeline Description', 'General', 'River Crossing', '', 'Checked', '', 'RiverCrossing', 'd_RiverCrossing'),
	(21, 'Pipeline Description', 'General', 'Road Crossing', '', 'Checked', '', 'RoadCrossing', 'd_RoadCrossing'),
	(22, 'Licence Information', 'General', 'Licence Number', '', 'text', '', 'PipelineLicenceNumber', 'd_PipelineLicenceNumber'),
	(23, 'Licence Information', 'General', 'Licence Valid Until', '', 'text', '', 'LicenceValidUntil', 'd_LicenceValidUntil'),
	(24, 'Design and Construction', 'Design', 'Wall Thickness', 'Inch', 'num', '', 'WallThickness', 'd_WallThickness'),
	(25, 'Design and Construction', 'Design', 'API Material', '', 'text_lookup', 'materialType', 'materialType', 'd_materialType'),
	(26, 'Design and Construction', 'Design', 'SMYS', '', 'num', '', 'SMYS', 'd_SMYS'),
	(27, 'Design and Construction', 'Design', 'Design Temperature', 'deg F', 'num', '', 'DesignTemperature', 'd_DesignTemperature'),
	(28, 'Design and Construction', 'Design', 'Design Pressure', 'psig', 'num', '', 'DesignPressure', 'd_DesignPressure'),
	(29, 'Design and Construction', 'Design', 'Design Safety Factor', '', 'num', '', 'design_safety', 'd_design_safety'),
	(30, 'Design and Construction', 'Design', 'Pipeline Hydrotested ?', '', 'Checked', '', 'PipelineHydrotested', 'd_PipelineHydrotested'),
	(31, 'Design and Construction', 'Design', 'Hydrotest Pressure', '', 'num', '', 'HydrotestPressure', 'd_HydrotestPressure'),
	(32, 'Design and Construction', 'Design', 'Minimum Operating Temperature', '', 'num', '', 'MinimumOperatingTemperature', 'd_MinimumOperatingTemperature'),
	(33, 'Design and Construction', 'Design', 'Maximum Operating Temperature', '', 'num', '', 'MaximumOperatingTemperature', 'd_MaximumOperatingTemperature'),
	(34, 'Design and Construction', 'Design', 'Design life', 'year', 'num', '', 'DesignLife', 'd_DesignLife'),
	(35, 'Design and Construction', 'Design', 'Pipeline design code', '', 'text_lookup', 'Pipelinedesigncode', 'Pipelinedesigncode', 'd_Pipelinedesigncode'),
	(36, 'Design and Construction', 'Design', 'MAOP', 'psig', 'num', '', 'maop', 'd_maop'),
	(37, 'Design and Construction', 'Design', 'Corrosion Allowance', 'inch', 'num', '', 'CorrosionAllowance', 'd_CorrosionAllowance'),
	(38, 'Design and Construction', 'Design', 'Inlet MAOT', 'deg C', 'num', '', 'InletMAOT', 'd_InletMAOT'),
	(39, 'Design and Construction', 'Design', 'Oitlet MAOT', 'deg C', 'num', '', 'OitletMAOT', 'd_OitletMAOT'),
	(40, 'Design and Construction', 'Design', 'Relified', '', 'Checked', '', 'Relified', 'd_Relified'),
	(41, 'CP System', 'Design', 'Cathodic Protection System', '', 'text_lookup', 'CathodicProtectionSystem', 'CathodicProtectionSystem', 'd_CathodicProtectionSystem'),
	(42, 'CP System', 'Design', 'Backfilling methodology', '', 'text', '', 'Backfillingmethodology', 'd_Backfillingmethodology'),
	(43, 'Coating System', 'Design', 'Internal Coating ?', '', 'Checked', '', 'InternalCoating', 'd_InternalCoating'),
	(44, 'Coating System', 'Design', 'Internal Coating Type', '', 'text_lookup', 'Coating_Type', 'InternalCoatingType', 'd_InternalCoatingType'),
	(45, 'Coating System', 'Design', 'External Coating Type', '', 'text_lookup', 'Coating_Type', 'ExternalCoatingType', 'd_ExternalCoatingType'),
	(46, 'Coating System', 'Design', 'External Coating Thickness', '', 'num', '', 'ExternalCoatingThickness', 'd_ExternalCoatingThickness'),
	(47, 'Coating System', 'Design', 'Neoprene coating applied ', '', 'text', '', 'NeopreneCoatingapplied', 'd_NeopreneCoatingapplied'),
	(48, 'Coating System', 'Design', 'Splash zone coating', '', 'text', '', 'Splashzonecoating', 'd_Splashzonecoating'),
	(49, 'Coating System', 'Design', 'Concrete Coating Thickness', 'mm', 'num', '', 'ConcreteCoatingThickness', 'd_ConcreteCoatingThickness'),
	(50, 'Coating System', 'Design', 'Concrete Coating Density', 'kg mm3', 'num', '', 'ConcreteCoatingDensity', 'd_ConcreteCoatingDensity'),
	(51, 'Content Content', 'Operation', 'Fluid Contents', '', 'text_lookup', 'FluidContent', 'FluidContent', 'd_FluidContent'),
	(52, 'Content Content', 'Operation', 'Fluid Phase', '', 'text_lookup', 'FluidPhase', 'FluidPhase', 'd_FluidPhase'),
	(53, 'Content Content', 'Operation', 'Toxic ?', '', 'Checked', '', 'Toxic', 'd_Toxic'),
	(54, 'Content Content', 'Operation', 'Flammable ?', '', 'Checked', '', 'Flammable', 'd_Flammable'),
	(55, 'Content Content', 'Operation', 'Line Dry ?', '', 'Checked', '', 'LineDry', 'd_LineDry'),
	(56, 'Content Content', 'Operation', 'Corrosion Inhibition ?', '', 'Checked', '', 'CorrosionInhibition      ', 'd_CorrosionInhibition      '),
	(57, 'Content Content', 'Operation', 'Mole % water', '', 'num', '', 'MoleWater', 'd_MoleWater'),
	(58, 'Content Content', 'Operation', 'mole % CO2', '', 'num', '', 'moleCO2', 'd_moleCO2'),
	(59, 'Content Content', 'Operation', 'Mole % H2S', '', 'num', '', 'MoleH2S', 'd_MoleH2S'),
	(60, 'Content Content', 'Operation', 'O2 Concentration ', 'ppb', 'num', '', 'O2Concentration', 'd_O2Concentration'),
	(61, 'Content Content', 'Operation', 'Possiblle for inlet pressure exceed design P', '', 'Checked', '', 'posibletoPressure', 'd_posibletoPressure'),
	(62, 'Operational Properties', 'Operation', 'Gas Flowrate', 'mmscfd', 'num', '', 'gasFLowrate', 'd_gasFLowrate'),
	(63, 'Operational Properties', 'Operation', 'Oil Cond. Flowrate  ', 'bpd', 'num', '', 'OilFlowrate', 'd_OilFlowrate'),
	(64, 'Operational Properties', 'Operation', 'Water flowrate', 'bpd', 'num', '', 'WaterFlowrate', 'd_WaterFlowrate'),
	(65, 'Operational Properties', 'Operation', 'Daily Production Value for Gas $', '', 'num', '', 'DailyProductionGas$', 'd_DailyProductionGas$'),
	(66, 'Operational Properties', 'Operation', 'Daily Production value for Oil $', '', 'num', '', 'DailyProductionOil$', 'd_DailyProductionOil$'),
	(67, 'Operational Properties', 'Operation', 'DP', '', 'num', '', 'DPMAOP', 'd_DPMAOP'),
	(68, 'Operational Properties', 'Operation', 'Line Status', '', 'text_lookup', 'PipelineStatus', 'PipelineStatus', 'd_PipelineStatus'),
	(69, 'Operational Properties', 'Operation', 'Inhibition availability', '', 'num', '', 'Inhibition_availability', 'd_Inhibition_availability'),
	(70, 'Operational Properties', 'Operation', 'Fluid Density', 'kg m-3', 'num', '', 'FluidDensity', 'd_FluidDensity'),
	(71, 'Operational Properties', 'Operation', 'Associated prod losss', '', 'num', '', 'Associatedprodlosss', 'd_Associatedprodlosss'),
	(72, 'Operational Properties', 'Operation', 'Sand production Loss', 'kg/day', 'num', '', 'SandProdLoss', 'd_SandProdLoss'),
	(73, 'Pressure and Temperature', 'Operation', 'Operating Pressure', 'psi', 'num', '', 'OperatingPressure', 'd_OperatingPressure'),
	(74, 'Pressure and Temperature', 'Operation', 'Operating Temperature', 'deg F', 'num', '', 'OperatingTemperature', 'd_OperatingTemperature'),
	(75, 'Pressure and Temperature', 'Operation', 'Inlet Temperature ', 'Deg F', 'num', '', 'Inlet_Temperature', 'd_Inlet_Temperature'),
	(76, 'Pressure and Temperature', 'Operation', 'Outlet Temperature', 'Deg F', 'num', '', 'Outlet_Temperature', 'd_Outlet_Temperature'),
	(77, 'Pressure and Temperature', 'Operation', 'Inlet Pressure', 'psi', 'num', '', 'Inlet_Pressure', 'd_Inlet_Pressure'),
	(78, 'Pressure and Temperature', 'Operation', 'Outlet Pressure', 'psi', 'num', '', 'Outlet_Pressure', 'd_Outlet_Pressure'),
	(79, 'Pressure and Temperature', 'Operation', 'Operated Oiutside Design Paramter', '', 'Checked', '', 'OperatedOiutsideDesignParamter', 'd_OperatedOiutsideDesignParamter'),
	(80, 'Internal Corrosion', 'PoF General', 'CO2 > 1 Bar', '', 'Checked', '', 'CO21Bar', 'd_CO21Bar'),
	(81, 'Internal Corrosion', 'PoF General', 'MIC', '', 'Checked', '', 'mic', 'd_mic'),
	(82, 'Internal Corrosion', 'PoF General', 'O2 > 50 ppm', '', 'Checked', '', 'O250ppm', 'd_O250ppm'),
	(83, 'Internal Corrosion', 'PoF General', 'Water Vapour', '', 'Checked', '', 'WaterVapour', 'd_WaterVapour'),
	(84, 'Internal Corrosion', 'PoF General', 'Upset Condition', '', 'Checked', '', 'UpsetCondition', 'd_UpsetCondition'),
	(85, 'Internal Corrosion', 'PoF General', 'Biocide', '', 'Checked', '', 'Biocide', 'd_Biocide'),
	(86, 'Internal Corrosion', 'PoF General', 'Sour Nace', '', 'Checked', '', 'SourNace', 'd_SourNace'),
	(87, 'Internal Corrosion', 'PoF General', 'Solids in line', '', 'Checked', '', 'Solidsinline', 'd_Solidsinline'),
	(88, 'Internal Corrosion', 'PoF General', 'CRA lined (interval)', '', 'Checked', '', 'CRAlinedInternal', 'd_CRAlinedInternal'),
	(89, 'Internal Corrosion', 'PoF General', 'Water Droupout', '', 'Checked', '', 'WaterDroupout', 'd_WaterDroupout'),
	(90, 'Internal Corrosion', 'PoF General', 'Continous water Phase', '', 'Checked', '', 'ContinousWaterPhase', 'd_ContinousWaterPhase'),
	(91, 'Internal Corrosion', 'PoF General', 'SRB Content ', 'Colonoes per ml', 'num', '', 'SRB', 'd_SRB'),
	(92, 'Internal Corrosion', 'PoF General', 'Water', '', 'text_lookup', 'WaterPof', 'WaterPof', 'd_WaterPof'),
	(93, 'Internal Inspection', 'PoF General', 'Local Corrosion', '', 'text_lookup', 'LocalCorrosion', 'LocalCorrosion', 'd_LocalCorrosion'),
	(94, 'Internal Inspection', 'PoF General', 'Age Factor', '', 'text_lookup', 'AgerFactor', 'AgerFactor', 'd_AgerFactor'),
	(95, 'Internal Inspection', 'PoF General', 'Last Inspection Date for internal', '', 'date', '', 'LastInspectionDateforinternal', 'd_LastInspectionDateforinternal'),
	(96, 'Internal Inspection', 'PoF General', 'Internal Inspection Historical', '', 'text_lookup', 'InternalInspectionHistorical', 'InternalInspectionHistorical', 'd_InternalInspectionHistorical'),
	(97, 'Internal Inspection', 'PoF General', 'Result Acceptable ?', '', 'Checked', '', 'ResultAcceptable', 'd_ResultAcceptable'),
	(98, 'Internal Inspection', 'PoF General', 'Remedial action performed for internal inspection', '', 'Checked', '', 'Remedialaction', 'd_Remedialaction'),
	(99, 'Internal Inspection', 'PoF General', 'Internal Inspection factor', '', 'text_lookup', 'InternalInspectionfactor', 'InternalInspectionfactor', 'd_InternalInspectionfactor'),
	(100, 'External Inspection', 'PoF General', 'CP Reading', '', 'text_lookup', 'CPReading', 'CPReading', 'd_CPReading'),
	(101, 'External Inspection', 'PoF General', 'Cathodic Protection System', '', 'text_lookup', 'CPSystem', 'CPSystem', 'd_CPSystem'),
	(102, 'External Inspection', 'PoF General', 'Min CP Measured', '', 'num', '', 'MinCPMeasured', 'd_MinCPMeasured'),
	(103, 'External Inspection', 'PoF General', 'Anode Depletion', '', 'text', '', 'AnodeDepletion', 'd_AnodeDepletion'),
	(104, 'External Inspection', 'PoF General', 'Last CP Survey', '', 'date', '', 'LastCPSurvey', 'd_LastCPSurvey'),
	(105, 'External Inspection', 'PoF General', 'Cathodic Interference', '', 'text_lookup', 'CathodicInterference', 'CathodicInterference', 'd_CathodicInterference'),
	(106, 'External Inspection', 'PoF General', 'Know CP interference ?', '', 'Checked', '', 'KnowCPinterference', 'd_KnowCPinterference'),
	(107, 'External Inspection', 'PoF General', 'Last Inspection Date for external', '', 'date', '', 'LastInspectionDateforexternal', 'd_LastInspectionDateforexternal'),
	(108, 'External Inspection', 'PoF General', 'External Inspection Historical', '', 'text_lookup', 'ExternalInspectionHistorical', 'ExternalInspectionHistorical', 'd_ExternalInspectionHistorical'),
	(109, 'External Inspection', 'PoF General', 'CRA External', '', 'Checked', '', 'CRA', 'd_CRA'),
	(110, 'Leak History', 'PoF General', 'Leak History', '', 'text_lookup', 'LeakHistory', 'LeakHistory', 'd_LeakHistory'),
	(111, 'Leak History', 'PoF General', 'Number of corrosion realted leaks', '', 'num', '', 'NumOfCorrosionRelatedLeak', 'd_NumOfCorrosionRelatedLeak'),
	(112, 'Leak History', 'PoF General', 'Number of non-corrosion related leaks', '', 'num', '', 'NumOfOtherRelatedLeak', 'd_NumOfOtherRelatedLeak'),
	(113, 'Operation ', 'PoF General', 'Design', '', 'text_lookup', 'Design', 'Design', 'd_Design'),
	(114, 'Operation ', 'PoF General', 'Designed to recognized code ?', '', 'Checked', '', 'DesignCode', 'd_DesignCode'),
	(115, 'Operation ', 'PoF General', 'P, T, Flowrate and composition within Design', '', 'Checked', '', 'OpsWithinDesign', 'd_OpsWithinDesign'),
	(116, 'Operation ', 'PoF General', 'Threaded joints ?', '', 'Checked', '', 'ThreadedJoint', 'd_ThreadedJoint'),
	(117, 'Operation ', 'PoF General', 'Pigging plan in place and followed', '', 'Checked', '', 'Piggingplaninplaceandfollowed', 'd_Piggingplaninplaceandfollowed'),
	(118, 'Operation ', 'PoF General', 'Pigging plan in place and not follow', '', 'Checked', '', 'Piggingplaninplaceandnotfollow', 'd_Piggingplaninplaceandnotfollow'),
	(119, 'Operation ', 'PoF General', 'No Pigging plan in place and occasional pigging', '', 'Checked', '', 'NoPiggingplaninplaceandoccasionalpigging', 'd_NoPiggingplaninplaceandoccasionalpigging'),
	(120, 'Operation ', 'PoF General', 'Possiblle for inlet pressure exceed design P', '', 'Checked', '', 'PossiblleforinletpressureexceeddesignP', 'd_PossiblleforinletpressureexceeddesignP'),
	(121, 'Operation ', 'PoF General', 'Operational Pigging', '', 'text_lookup', 'PiggingOps', 'PiggingOps', 'd_PiggingOps'),
	(122, 'Operation ', 'PoF General', 'First Presure Protection System', '', 'text_lookup', 'PresureProtectionSystem', 'firstPress', 'd_firstPress'),
	(123, 'Operation ', 'PoF General', 'Second Pressure Protection System', '', 'text_lookup', 'PresureProtectionSystem', 'twoPress', 'd_twoPress'),
	(124, 'Operation ', 'PoF General', 'Pressure Cycling', '', 'text_lookup', 'PressureCycling', 'PressureCycling', 'd_PressureCycling'),
	(125, 'Operation ', 'PoF General', 'Number or pressure cyles > 10% MAOP per year', '', 'num', '', 'numPress', 'd_numPress'),
	(126, 'Operation ', 'PoF General', 'Temperature Cycling', '', 'text_lookup', 'TemperatureCycling', 'TemperatureCycling', 'd_TemperatureCycling'),
	(127, 'Operation ', 'PoF General', 'Number of temperature cycles > 50 deg c per year', '', 'num', '', 'numTemp', 'd_numTemp'),
	(128, 'Operation ', 'PoF General', 'Overpressure', '', 'text_lookup', 'Overpressure', 'Overpressure', 'd_Overpressure'),
	(129, 'Operation ', 'PoF General', 'Measure Corrosion Rate', 'mpy', 'num', '', 'MeasureCorrosionRate', 'd_MeasureCorrosionRate'),
	(130, 'Operation ', 'PoF General', 'Maximum Axial Defect Length', 'mm', 'num', '', 'MaximumAxialDefectLength', 'd_MaximumAxialDefectLength'),
	(131, 'Operation ', 'PoF General', 'Maximum Defect Length', 'mm', 'num', '', 'MaximumDefectLength', 'd_MaximumDefectLength'),
	(132, 'Third Party Interference', 'PoF General', 'Situation Stable ?', '', 'Checked', '', 'SituationStable', 'd_SituationStable'),
	(133, 'Third Party Interference', 'PoF General', 'Actual civil or military unrest ?', '', 'Checked', '', 'Actualcivilormilitaryunrest', 'd_Actualcivilormilitaryunrest'),
	(134, 'Third Party Interference', 'PoF General', 'Sabotage has occurred ?', '', 'Checked', '', 'Sabotagehasoccurred', 'd_Sabotagehasoccurred'),
	(135, 'Third Party Interference', 'PoF General', 'Sabotage Factor', '', 'text_lookup', 'sabotagefactor', 'sabotagefactor', 'd_sabotagefactor'),
	(136, 'Third Party Interference', 'PoF General', 'Report', '', 'File Upload', '', 'report', 'report'),
	(137, 'Third Party Interference', 'PoF Onshore', 'Buriad Depth ', '', 'num', '', 'buriadDepth', 'd_buriadDepth'),
	(138, 'Third Party Interference', 'PoF Onshore', 'Physical Protection', '', 'Checked', '', 'PhysicalProtection', 'd_PhysicalProtection'),
	(139, 'Third Party Interference', 'PoF Onshore', 'ROW recognisable as such ', '', 'Checked', '', 'ROWrecognisableassuch', 'd_ROWrecognisableassuch'),
	(140, 'Third Party Interference', 'PoF Onshore', 'Warning Tape ', '', 'Checked', '', 'warningType', 'd_warningType'),
	(141, 'Third Party Interference', 'PoF Onshore', 'Markers Vissible (proportion or route)', '', 'Checked', '', 'MarkersVissible', 'd_MarkersVissible'),
	(142, 'Third Party Interference', 'PoF Onshore', 'Land  Stability', '', 'text_lookup', 'LandStability', 'LandStability', 'd_LandStability'),
	(143, 'Third Party Interference', 'PoF Onshore', 'Land Slide across or under ROW', '', 'Checked', '', 'underROW', 'd_underROW'),
	(144, 'Third Party Interference', 'PoF Onshore', 'Land Slide across or under Pipeline', '', 'Checked', '', 'underPipeline', 'd_underPipeline'),
	(145, 'Third Party Interference', 'PoF Onshore', 'Right of Way Condition', '', 'text_lookup', 'rowCondition ', 'rowCondition ', 'd_rowCondition '),
	(146, 'Third Party Interference', 'PoF Onshore', 'Onshore pipeline cover factor', '', 'text_lookup', 'Onshorepipelinecoverfactor', 'Onshorepipelinecoverfactor', 'd_Onshorepipelinecoverfactor'),
	(147, 'Third Party Interference', 'PoF Onshore', 'Onshore population Density factor', '', 'text_lookup', 'Population_Density', 'OnshorepopulationDensityfactor', 'd_OnshorepopulationDensityfactor'),
	(148, 'Third Party Interference', 'PoF Onshore', 'Migas 300 K Class', 'm', 'text_lookup', 'MigasClass', 'MigasClass', 'd_MigasClass'),
	(149, 'External Inspection', 'PoF Onshore', 'Last CP Survey', '', 'date', '', 'LastCPSurvey', 'd_LastCPSurvey'),
	(150, 'External Inspection', 'PoF Onshore', 'CP Survey coverage', '', 'text_lookup', 'CPSurveycoverage', 'CPSurveycoverage', 'd_CPSurveycoverage'),
	(151, 'External Inspection', 'PoF Onshore', 'CP Survey', '', 'text_lookup', 'CPSurvey', 'CPSurvey', 'd_CPSurvey'),
	(152, 'External Inspection', 'PoF Onshore', 'CP Survey Inspection Type ', '', 'text_lookup', 'CPSurveyInspectionType', 'CPSurveyInspectionType', 'd_CPSurveyInspectionType'),
	(153, 'External Inspection', 'PoF Onshore', 'Last ROW or GVI Survey', '', 'date', '', 'LastROWGVISurvey', 'd_LastROWGVISurvey'),
	(154, 'External Inspection', 'PoF Onshore', 'ROW or GVI Survey Coverage', '', 'text_lookup', 'CPSurveycoverage', 'ROWorGVISurveyCoverage', 'd_ROWorGVISurveyCoverage'),
	(155, 'External Inspection', 'PoF Onshore', 'Remedial action performed for ROW or GVI ?', '', 'Checked', '', 'RemedialactionperformedforROWorGVI', 'd_RemedialactionperformedforROWorGVI'),
	(156, 'External Inspection', 'PoF Onshore', 'External Inspection Factor', '', 'text_lookup', 'externalfactor', 'externalfactor', 'd_externalfactor'),
	(157, 'External Inspection', 'PoF Onshore', 'Coating or Painting Condition', '', 'text_lookup', 'coatingCondition', 'coatingCondition', 'd_coatingCondition'),
	(158, 'External Inspection', 'PoF Onshore', 'External Demage', '', 'text_lookup', 'ExternalDemage', 'ExternalDemage', 'd_ExternalDemage'),
	(159, 'Financial', 'CoF Onshore', 'Override Financial Costs For Pinhole Leak($)', '', 'num', '', 'OverRideDailyProductionGas$', 'd_OverRideDailyProductionGas$'),
	(160, 'Financial', 'CoF Onshore', 'Override Financial Cost For Rupture Leas ($)', '', 'num', '', 'OverRideDailyProductionOil$', 'd_OverRideDailyProductionOil$'),
	(161, 'Financial', 'CoF Onshore', 'Financial', '', 'text_lookup', 'financialFactor', 'financialFactor', 'd_financialFactor'),
	(162, 'Environment', 'CoF Onshore', 'Fluid Type', '', 'text_lookup', 'FluidType', 'FluidType', 'd_FluidType'),
	(163, 'Environment', 'CoF Onshore', 'Environmental Sensitivity / Location Factor', '', 'text_lookup', 'LocationFactor', 'LocationFactor', 'd_LocationFactor'),
	(164, 'Environment', 'CoF Onshore', 'Release Quantity', '', 'text_lookup', 'ReleaseQuantity', 'ReleaseQuantity', 'd_ReleaseQuantity'),
	(165, 'Reputation', 'CoF Onshore', 'Reputation Rating', '', 'text_lookup', 'ReputationRatting', 'ReputationRatting', 'd_ReputationRatting'),
	(166, 'Safety', 'CoF Onshore', 'Flammability / Toxic', '', 'text_lookup', 'FlammabilityToxic', 'FlammabilityToxic', 'd_FlammabilityToxic'),
	(167, 'Safety', 'CoF Onshore', 'Population Number (people)', '', 'num', '', 'NumOfPopulation', 'd_NumOfPopulation'),
	(168, 'Safety', 'CoF Onshore', 'Leak Size', '', 'text_lookup', 'LeakSize', 'LeakSize', 'd_LeakSize'),
	(169, 'Third Party Interference', 'Pof Offshore', 'Water Depth ', 'm', 'num', '', 'WaterDepth', 'd_WaterDepth'),
	(170, 'Third Party Interference', 'Pof Offshore', 'Pipeline is stabe or buried?', '', 'yesno', '', 'Pipelineisstabeorburied', 'd_Pipelineisstabeorburied'),
	(171, 'Third Party Interference', 'Pof Offshore', 'Protected by patrol boat ?', '', 'yesno', '', 'Protectedbypatrolboat', 'd_Protectedbypatrolboat'),
	(172, 'Third Party Interference', 'Pof Offshore', 'Possiblle for inlet pressure exceed design P', '', 'yesno', '', 'posibletoPressure', 'd_posibletoPressure'),
	(173, 'Third Party Interference', 'Pof Offshore', 'Protectted by rock berm ?', '', 'yesno', '', 'Protecttedbyrockberm', 'd_Protecttedbyrockberm'),
	(174, 'Third Party Interference', 'Pof Offshore', 'Pipeline Contacts Beach or Platform ?', '', 'yesno', '', 'PipelineContactsBeachorPlatform', 'd_PipelineContactsBeachorPlatform'),
	(175, 'Third Party Interference', 'Pof Offshore', 'Pipeline Crosses high trafic area ?', '', 'Checked', '', 'PipelineCrosseshightraficarea', 'd_PipelineCrosseshightraficarea'),
	(176, 'Third Party Interference', 'Pof Offshore', 'Freespan recorded ?', '', 'yesno', '', 'Freespanrecorded', 'd_Freespanrecorded'),
	(177, 'Third Party Interference', 'Pof Offshore', 'Insidents or near misses reported ?', '', 'yesno', '', 'Insidentsornearmissesreported', 'd_Insidentsornearmissesreported'),
	(178, 'Third Party Interference', 'Pof Offshore', 'Instatbility or scouring onserved?', '', 'yesno', '', 'Instatbilityorscouringonserved', 'd_Instatbilityorscouringonserved'),
	(179, 'Third Party Interference', 'Pof Offshore', 'Fatigue Sisceptibility factor', '', 'text_lookup', 'FatigueSisceptibilityfactor', 'FatigueSisceptibilityfactor', 'd_FatigueSisceptibilityfactor'),
	(180, 'Third Party Interference', 'Pof Offshore', 'Pipeline cover factor', '', 'text_lookup', 'PipelinecoverOffshore', 'PipelinecoverOffshore', 'd_PipelinecoverOffshore'),
	(181, 'Third Party Interference', 'Pof Offshore', 'Seabed Stability Factor', '', 'text_lookup', 'SeabedStability', 'SeabedStability', 'd_SeabedStability'),
	(182, 'Third Party Interference', 'Pof Offshore', 'Third Party Demage ', '', 'text_lookup', 'ThirdPartyDemageOff', 'ThirdPartyDemageOff', 'd_ThirdPartyDemageOff'),
	(183, 'External Inspection', 'Pof Offshore', 'Last ROV or External Inspection Survey', '', 'Date', '', 'LastROVorExternal', 'd_LastROVorExternal'),
	(184, 'External Inspection', 'Pof Offshore', 'ROW or GVI Survey Coverage', '', 'text_lookup', 'CPSurveycoverage', 'ROWorGVISurveyCoverage', 'd_ROWorGVISurveyCoverage'),
	(185, 'External Inspection', 'Pof Offshore', 'Remedial action performed for ROW or Ex Insp.', '', 'yesno', '', 'Remedialactionperformed', 'd_Remedialactionperformed'),
	(186, 'External Inspection', 'Pof Offshore', 'CP Survey', '', 'text_lookup', 'CPSurvey_off', 'CPSurvey_off', 'd_CPSurvey_off'),
	(187, 'External Inspection', 'Pof Offshore', 'External Inspection Factor', '', 'text_lookup', 'externalfactorOff', 'externalfactorOff', 'd_externalfactorOff'),
	(188, 'Financial', 'Cof Offshore', 'Override Financial Costs For Pinhole Leak($)', '', 'Num', '', 'OverRideDailyProductionGas$_off', 'd_OverRideDailyProductionGas$_off'),
	(189, 'Financial', 'Cof Offshore', 'Override Financial Cost For Rupture Leas ($)', '', 'Num', '', 'OverRideDailyProductionOil$_off', 'd_OverRideDailyProductionOil$_off'),
	(190, 'Financial', 'Cof Offshore', 'Financial', '', 'text_lookup', 'financialFactor', 'financialFactor_off', 'd_financialFactor_off'),
	(191, 'Environment', 'Cof Offshore', 'Fluid Type', '', 'text_lookup', 'FluidType', 'FluidType_off', 'd_FluidType_off'),
	(192, 'Environment', 'Cof Offshore', 'Environmental Sensitivity / Location Factor', '', 'text_lookup', 'EnvironmentalSensitivity', 'EnvironmentalSensitivity_off', 'd_EnvironmentalSensitivity_off'),
	(193, 'Environment', 'Cof Offshore', 'Release Quantity', '', 'text_lookup', 'ReleaseQuantity', 'ReleaseQuantity_off', 'd_ReleaseQuantity_off'),
	(194, 'Reputation', 'Cof Offshore', 'Reputation Rating', '', 'text_lookup', 'ReputationRatting', 'ReputationRatting_off', 'd_ReputationRatting_off'),
	(195, 'Safety', 'Cof Offshore', 'Flammability / Toxic', '', 'text_lookup', 'FlammabilityToxic', 'FlammabilityToxic_off', 'd_FlammabilityToxic_off'),
	(196, 'Safety', 'Cof Offshore', 'Leak Size', '', 'text_lookup', 'LeakSize', 'LeakSizeOff_off', 'd_LeakSize_off'),
	(197, 'Safety', 'Cof Offshore', 'DNV Class / Polulation Density', '', 'text_lookup', 'dnv', 'dnv', 'd_dnv'),
	(198, 'Safety', 'Cof Offshore', 'Population Number (people)', '', 'num', '', 'NumOfPopulation_off', 'd_NumOfPopulation_off');
/*!40000 ALTER TABLE `data_field` ENABLE KEYS */;

-- Dumping structure for table mythauth.data_section
CREATE TABLE IF NOT EXISTS `data_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `nama_section` varchar(50) NOT NULL DEFAULT '0',
  `plant` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 Onshore, 2 offshore',
  `id_area` int(11) NOT NULL DEFAULT '0',
  `id_equipment` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipment` (`id_equipment`),
  KEY `fk_area` (`id_area`),
  CONSTRAINT `fk_area` FOREIGN KEY (`id_area`) REFERENCES `data_area` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_equipment` FOREIGN KEY (`id_equipment`) REFERENCES `data_equipment` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COMMENT='Section Data';

-- Dumping data for table mythauth.data_section: ~0 rows (approximately)
/*!40000 ALTER TABLE `data_section` DISABLE KEYS */;
INSERT INTO `data_section` (`id`, `kode`, `nama_section`, `plant`, `id_area`, `id_equipment`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'V-101', 'Main', '1', 1, 1, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(2, 'V-101', 'RoofTof', '1', 1, 1, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(3, 'Jkt01', 'Main', '1', 1, 2, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(4, 'Jkt01', '01JKT', '1', 1, 2, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(5, 'BGR01', 'Main', '1', 2, 2, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(6, 'BGR01', '01BGR', '1', 2, 2, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(7, 'T01', 'main', '2', 3, 3, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(8, 'T01', 'RoofTof', '2', 3, 3, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(9, 'P3', 'main', '2', 4, 4, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(10, 'P3-1', 'main', '2', 4, 4, '', '2022-08-30 17:01:30', '2022-08-30 17:01:30', NULL),
	(11, 'TES001', 'Main', '1', 1, 2, 'Deskripsi tes', '2022-09-09 09:38:33', '2022-09-09 09:38:33', NULL);
/*!40000 ALTER TABLE `data_section` ENABLE KEYS */;

-- Dumping structure for table mythauth.data_tab
CREATE TABLE IF NOT EXISTS `data_tab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table mythauth.data_tab: ~11 rows (approximately)
/*!40000 ALTER TABLE `data_tab` DISABLE KEYS */;
INSERT INTO `data_tab` (`id`, `tab`) VALUES
	(1, 'General'),
	(2, 'Design'),
	(3, 'Operation'),
	(4, 'Pof General'),
	(5, 'PoF Onshore'),
	(6, 'COF Onshore'),
	(7, 'Pof Offshore'),
	(8, 'Cof Offshore'),
	(9, 'Level 1 Onshore'),
	(10, 'Level 2 Onshore'),
	(11, 'Level 1 OffShore'),
	(12, 'Level 2 OffShore');
/*!40000 ALTER TABLE `data_tab` ENABLE KEYS */;

-- Dumping structure for table mythauth.data_value
CREATE TABLE IF NOT EXISTS `data_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL DEFAULT '0',
  `field_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1 COMMENT='input section and value';

-- Dumping data for table mythauth.data_value: ~117 rows (approximately)
/*!40000 ALTER TABLE `data_value` DISABLE KEYS */;
INSERT INTO `data_value` (`id`, `section_id`, `field_id`, `value`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, '1', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(2, 3, 2, '1', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(3, 3, 3, '1', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(4, 3, 4, 'Main', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(5, 3, 5, 'Jkt01', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(6, 3, 6, 'Ini Deskripsi', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(7, 3, 7, 'Aceh', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(8, 3, 8, 'Jakarta', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(9, 3, 9, '1', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(10, 3, 10, '800', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(11, 3, 11, '', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(12, 3, 12, '', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(13, 3, 13, '2022-09-12', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(14, 3, 14, '2022', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(15, 3, 15, '2033', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(16, 3, 16, '1', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(17, 3, 17, '2', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(18, 3, 18, '2', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(19, 3, 19, 'on', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(20, 3, 20, 'on', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(21, 3, 22, '3345', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(22, 3, 23, '2022', '2022-09-09 03:59:42', '2022-09-09 07:36:19'),
	(23, 3, 84, 'on', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(24, 3, 86, 'on', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(25, 3, 91, '6', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(26, 3, 92, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(27, 3, 93, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(28, 3, 94, '1', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(29, 3, 95, '2022-09-08', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(30, 3, 96, '1', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(31, 3, 99, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(32, 3, 100, '1', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(33, 3, 101, '4', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(34, 3, 102, '55', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(35, 3, 103, '', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(36, 3, 104, '2022-09-16', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(37, 3, 105, '1', '2022-09-09 04:09:55', '2022-09-09 04:35:35'),
	(38, 3, 107, '2022-09-13', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(39, 3, 108, '0.5', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(40, 3, 110, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(41, 3, 111, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(42, 3, 112, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(43, 3, 113, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(44, 3, 121, '1', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(45, 3, 122, '2', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(46, 3, 123, '2', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(47, 3, 124, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(48, 3, 125, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(49, 3, 126, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(50, 3, 127, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(51, 3, 128, '1', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(52, 3, 129, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(53, 3, 130, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(54, 3, 131, '', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(55, 3, 135, '5', '2022-09-09 04:09:55', '2022-09-09 04:35:36'),
	(56, 3, 24, '123', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(57, 3, 25, '240', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(58, 3, 26, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(59, 3, 27, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(60, 3, 28, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(61, 3, 29, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(62, 3, 31, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(63, 3, 32, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(64, 3, 33, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(65, 3, 34, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(66, 3, 35, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(67, 3, 36, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(68, 3, 37, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(69, 3, 39, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(70, 3, 40, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(71, 3, 42, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(72, 3, 44, 'Alloy 825', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(73, 3, 45, 'None', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(74, 3, 46, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(75, 3, 47, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(76, 3, 48, '', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(77, 3, 49, '34', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(78, 3, 50, '23', '2022-09-09 04:15:41', '2022-09-09 04:28:57'),
	(79, 3, 51, 'Clean Water', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(80, 3, 52, '418', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(81, 3, 53, 'on', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(82, 3, 54, 'on', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(83, 3, 57, '2', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(84, 3, 58, '4', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(85, 3, 59, '5', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(86, 3, 60, '23', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(87, 3, 62, '44', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(88, 3, 63, '34', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(89, 3, 64, '12', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(90, 3, 65, '23', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(91, 3, 66, '12', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(92, 3, 67, '22', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(93, 3, 68, '4', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(94, 3, 69, '3', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(95, 3, 70, '3', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(96, 3, 71, '', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(97, 3, 72, 'Off-Line (Product Filled)', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(98, 3, 73, '', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(99, 3, 74, '6', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(100, 3, 75, '4', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(101, 3, 76, '3', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(102, 3, 77, '', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(103, 3, 78, '3', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(104, 3, 79, 'on', '2022-09-09 04:31:29', '2022-09-09 04:31:29'),
	(105, 3, 80, 'on', '2022-09-09 04:32:14', '2022-09-09 04:35:35'),
	(106, 3, 97, 'on', '2022-09-09 04:32:14', '2022-09-09 04:35:35'),
	(107, 3, 137, '34', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(108, 3, 142, '5', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(109, 3, 145, '1', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(110, 3, 146, '2', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(111, 3, 147, '3', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(112, 3, 148, '3', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(113, 3, 149, '2022-09-12', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(114, 3, 150, 'Partial', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(115, 3, 151, '4', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(116, 3, 152, 'CIPS', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(117, 3, 153, '2022-09-14', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(118, 3, 154, '', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(119, 3, 156, '2', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(120, 3, 157, '4', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(121, 3, 158, '2', '2022-09-09 04:33:51', '2022-09-09 04:35:52'),
	(122, 3, 159, '4', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(123, 3, 160, '6', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(124, 3, 161, '2', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(125, 3, 162, '2', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(126, 3, 163, '4', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(127, 3, 164, '2', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(128, 3, 165, '3', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(129, 3, 166, '3', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(130, 3, 167, '2', '2022-09-09 04:34:43', '2022-09-09 04:34:43'),
	(131, 3, 168, '4', '2022-09-09 04:34:43', '2022-09-09 04:34:43');
/*!40000 ALTER TABLE `data_value` ENABLE KEYS */;

-- Dumping structure for table mythauth.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1661837244, 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table mythauth.tbl_look_up
CREATE TABLE IF NOT EXISTS `tbl_look_up` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `comment` text,
  `value` varchar(50) DEFAULT '',
  `category` varchar(50) DEFAULT NULL,
  `field` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=262 DEFAULT CHARSET=latin1;

-- Dumping data for table mythauth.tbl_look_up: ~261 rows (approximately)
/*!40000 ALTER TABLE `tbl_look_up` DISABLE KEYS */;
INSERT INTO `tbl_look_up` (`id`, `comment`, `value`, `category`, `field`) VALUES
	(1, 'Onshore', '1', 'list', 'Plant'),
	(2, 'Offshore', '2', 'list', 'Plant'),
	(3, 'Jakarta', '1', 'list', 'LocationField'),
	(4, 'Cirebon', '2', 'list', 'LocationField'),
	(5, 'Bandung', '3', 'list', 'LocationField'),
	(6, 'Surabaya', '4', 'list', 'LocationField'),
	(7, 'Cepu', '5', 'list', 'LocationField'),
	(8, 'Palembang', '6', 'list', 'LocationField'),
	(9, 'Natuna', '7', 'list', 'LocationField'),
	(10, 'Sacr Anode - SAPAMALUM III', '4', 'list', 'CPSystem'),
	(11, 'Sacr Anode - GALVANIUM III', '3', 'list', 'CPSystem'),
	(12, 'Sacr Anode - Aluminium Bracelet', '2', 'list', 'CPSystem'),
	(13, 'ICCP', '1', 'list', 'CPSystem'),
	(14, 'N/A', '0', 'list', 'CPSystem'),
	(15, 'Sacrificial Anodes', '2', 'list', 'CPSystem'),
	(16, 'No previous inspections performed to determine internal condition OR Basic (partial coverage) inspections performed, but outside of inspection period', '5', 'list', 'InternalInspectionfactor'),
	(17, 'Basic (partial coverage) inspections performed within inspection period, defects found requiring mitigation before next scheduled inspection OR  Detailed (full coverage) inspection performed outside planned period with defects requiring mitigation before next scheduled inspection (now overdue)', '4', 'list', 'InternalInspectionfactor'),
	(18, 'Basic (partial coverage) inspections performed within inspection period, No defects or Defects FFP until next scheduled inspection OR Detailed (full coverage) inspection performed outside planned period with no defects or Defects FFP until next scheduled inspection', '3', 'list', 'InternalInspectionfactor'),
	(19, 'Detailed (full coverage) inspection performed within planned period. Defects require mitigation before next scheduled inspection.', '2', 'list', 'InternalInspectionfactor'),
	(20, 'Detailed (full coverage) inspection performed within planned period. No defects OR defect FFP until next scheduled inspection. OR not available internal inspaction method due to CRA pipeline', '1', 'list', 'InternalInspectionfactor'),
	(21, 'P1', '1', 'list', 'coatingCondition'),
	(22, 'P2', '2', 'list', 'coatingCondition'),
	(23, 'P3', '3', 'list', 'coatingCondition'),
	(24, 'P4', '4', 'list', 'coatingCondition'),
	(25, 'P5', '5', 'list', 'coatingCondition'),
	(26, 'Pipeline regularly pigged in line with a recommended frequency based on regular assessment of the pigging requirements for the line (e.g. analysis of scale produced by pigging), or pigging is not required to ensure the integrity of the pipeline (e.g., pigging only performs flow assurance, hydrate or wax control function).', '1', 'list', 'PiggingOps'),
	(27, 'Pipeline pigged at less than a recommended frequency based on regular assessment of the pigging requirements for the line (e.g. analysis of scale produced by pigging).', '3', 'list', 'PiggingOps'),
	(28, 'Pipeline occasionally pigged but no recommended frequency for pigging.', '4', 'list', 'PiggingOps'),
	(29, 'Pipeline never pigged, but pigging is recommended to ensure the long-term integrity of the pipeline.', '5', 'list', 'PiggingOps'),
	(30, 'P5', '5', 'list', 'sabotagefactor'),
	(31, 'P4', '4', 'list', 'sabotagefactor'),
	(32, 'P3', '3', 'list', 'sabotagefactor'),
	(33, 'P2', '1', 'list', 'sabotagefactor'),
	(34, 'P1', '1', 'list', 'sabotagefactor'),
	(35, 'P5', '5', 'list', 'rowCondition '),
	(36, 'P4', '4', 'list', 'rowCondition '),
	(37, 'P2', '2', 'list', 'rowCondition '),
	(38, 'P1', '1', 'list', 'rowCondition '),
	(39, 'P1', '1', 'list', 'Onshorepipelinecoverfactor'),
	(40, 'P2', '2', 'list', 'Onshorepipelinecoverfactor'),
	(41, 'P3', '3', 'list', 'Onshorepipelinecoverfactor'),
	(42, 'P4', '4', 'list', 'Onshorepipelinecoverfactor'),
	(43, 'P5', '5', 'list', 'Onshorepipelinecoverfactor'),
	(44, 'Pipeline passes through areas of dense housing or large cities with more than 46 buildings and multi-storey buildings in a band 1.6km long and 0.4km wide running along, and over, the pipeline (MIGAS 300.K Class 4). Heavy traffic – Frequent use of road, all parties', '5', 'list', 'Population_Density'),
	(45, 'Pipeline passes through villages, traditional markets or small cities with more than 46 buildings in a band 1.6km long and 0.4km wide running along, and over, the pipeline (MIGAS 300.K Class 3). Medium traffic – Some public us of road', '4', 'list', 'Population_Density'),
	(46, 'Pipeline passes through farmland or villages with between 10 and 46 buildings in a band 1.6km long and 0.4km wide running along, and over, the pipeline (MIGAS 300.K Class 2). Light traffic – Service road and local traffic only', '3', 'list', 'Population_Density'),
	(47, 'Pipeline passes through jungle, mountain, sea or farmland with less than 10 buildings in a band 1.6km long and 0.4km running along, and over, the pipeline (MIGAS 300.K Class 1). Negligible traffic – Service road only', '1', 'list', 'Population_Density'),
	(48, 'Pipeline passes through farmland or villages with between 10 and 46 buildings in a band 1.6km long and 0.4km wide running along, and over, the pipeline (MIGAS 300.K Class 2).  Also includes areas of some environmental sensitivity (permeable soils, river crossing)', '', 'list', 'Population_Density'),
	(49, 'P1', '1', 'list', 'externalfactor'),
	(50, 'P2', '2', 'list', 'externalfactor'),
	(51, 'P3', '3', 'list', 'externalfactor'),
	(52, 'P4', '4', 'list', 'externalfactor'),
	(53, 'P5', '5', 'list', 'externalfactor'),
	(54, 'P1', '1', 'list', 'ReputationRatting'),
	(55, 'P2', '2', 'list', 'ReputationRatting'),
	(56, 'P3', '3', 'list', 'ReputationRatting'),
	(57, 'P4', '4', 'list', 'ReputationRatting'),
	(58, 'P5', '5', 'list', 'ReputationRatting'),
	(59, 'P1', '1', 'list', 'MigasClass'),
	(60, 'P2', '2', 'list', 'MigasClass'),
	(61, 'P3', '3', 'list', 'MigasClass'),
	(62, 'P4', '4', 'list', 'MigasClass'),
	(63, 'Flowline', '3', 'list', 'PipelineType'),
	(64, 'Trunkline', '1', 'list', 'PipelineType'),
	(65, 'DNV F101', 'DNV F101', 'list', 'Pipelinedesigncode'),
	(66, 'ASME B31.9', 'ASME B31.9', 'list', 'Pipelinedesigncode'),
	(67, 'ASME B31.8', 'ASME B31.8', 'list', 'Pipelinedesigncode'),
	(68, 'ASME B31.4', 'ASME B31.4', 'list', 'Pipelinedesigncode'),
	(69, 'ASME B31.10', 'ASME B31.10', 'list', 'Pipelinedesigncode'),
	(70, 'N/A', '', 'list', 'Pipelinedesigncode'),
	(71, 'A106-B', '240', 'list', 'materialType'),
	(72, 'A 106B', '240', 'list', 'materialType'),
	(73, 'A-106B', '240', 'list', 'materialType'),
	(74, 'B', '241', 'list', 'materialType'),
	(75, 'X42', '290', 'list', 'materialType'),
	(76, 'X46', '317', 'list', 'materialType'),
	(77, 'SML 360 I FDU', '358', 'list', 'materialType'),
	(78, 'API 5L-X52', '359', 'list', 'materialType'),
	(79, 'X52', '359', 'list', 'materialType'),
	(80, 'API 5L X52', '359', 'list', 'materialType'),
	(81, 'X56', '386', 'list', 'materialType'),
	(82, 'X60', '414', 'list', 'materialType'),
	(83, 'API 5L X60', '414', 'list', 'materialType'),
	(84, 'API 5L X65', '448', 'list', 'materialType'),
	(85, 'X65', '448', 'list', 'materialType'),
	(86, 'X70', '483', 'list', 'materialType'),
	(87, 'SML 415  FDU', '485', 'list', 'materialType'),
	(88, 'X80', '552', 'list', 'materialType'),
	(89, 'None', 'None', 'list', 'Coating_Type'),
	(90, 'Alloy 825', 'Alloy 825', 'list', 'Coating_Type'),
	(91, 'N/A', '', 'list', 'Coating_Type'),
	(92, 'Clean Water', 'Clean Water', 'list', 'FluidContent'),
	(93, 'Water', 'Clean Water', 'list', 'FluidContent'),
	(94, 'Condensate', 'Condensate', 'list', 'FluidContent'),
	(95, 'Crude', 'Crude', 'list', 'FluidContent'),
	(96, 'Gas', 'Gas', 'list', 'FluidContent'),
	(97, 'Heavy Fractionate', 'Heavy Fractionate', 'list', 'FluidContent'),
	(98, 'LNG', 'LNG', 'list', 'FluidContent'),
	(99, 'LPG', 'Liquid Petroleum Gas', 'list', 'FluidContent'),
	(100, 'Mixed Phase Gas/Condensate', 'Mixed Phase Gas/Condensate', 'list', 'FluidContent'),
	(101, 'Oil', 'Oil', 'list', 'FluidContent'),
	(102, 'Produced Gas', 'Produced Gas', 'list', 'FluidContent'),
	(103, 'Produced Water', 'Produced Water', 'list', 'FluidContent'),
	(104, 'Sweet Natural Gas', 'Sweet Gas', 'list', 'FluidContent'),
	(105, 'Condensate', '546', 'list', 'FluidPhase'),
	(106, 'Gas', '418', 'list', 'FluidPhase'),
	(107, 'Liquid', '419', 'list', 'FluidPhase'),
	(108, 'Off-Line', '', 'list', 'PipelineStatus'),
	(109, 'Off-Line (Inert Purged)', 'Off-Line (Inert Purged)', 'list', 'PipelineStatus'),
	(110, 'Off-Line (Product Filled)', 'Off-Line (Product Filled)', 'list', 'PipelineStatus'),
	(111, 'Off-Line (Water-Filled)', 'Off-Line (Water-Filled)', 'list', 'PipelineStatus'),
	(112, 'On-Line', 'On-Line', 'list', 'PipelineStatus'),
	(113, 'Partial', 'Partial', 'list', 'CPSurveycoverage'),
	(114, 'Full', 'Full', 'list', 'CPSurveycoverage'),
	(115, 'N/A', '', 'list', 'CPSurveycoverage'),
	(116, 'No', '', 'list', 'CPSurveycoverage'),
	(117, 'TP', 'TP', 'list', 'CPSurveyInspectionType'),
	(118, 'CIPS', 'CIPS', 'list', 'CPSurveyInspectionType'),
	(119, 'N/A', '0', 'list', 'CPSurveyInspectionType'),
	(120, 'PSV', '2', 'list', 'PresureProtectionSystem'),
	(121, 'ESDV', '1', 'list', 'PresureProtectionSystem'),
	(122, 'None', '0', 'list', 'PresureProtectionSystem'),
	(123, 'PMV', '0', 'list', 'PresureProtectionSystem'),
	(124, 'SCVD', '0', 'list', 'PresureProtectionSystem'),
	(125, 'SSCVD', '0', 'list', 'PresureProtectionSystem'),
	(126, 'PAF', '0', 'list', 'PresureProtectionSystem'),
	(127, 'ESD1&2', '0', 'list', 'PresureProtectionSystem'),
	(128, 'Offshore Buried', '4', 'list', 'PipelinePosition'),
	(129, 'Offshore Unburied', '3', 'list', 'PipelinePosition'),
	(130, 'Onshore Buried', '2', 'list', 'PipelinePosition'),
	(131, 'Onshore Unburied', '1', 'list', 'PipelinePosition'),
	(132, 'P5', '5', 'list', 'LandStability'),
	(133, 'P3', '3', 'list', 'LandStability'),
	(134, 'P1', '1', 'list', 'LandStability'),
	(135, 'P1', '1', 'list', 'AgerFactor'),
	(136, 'P2', '2', 'list', 'AgerFactor'),
	(137, 'P3', '3', 'list', 'AgerFactor'),
	(138, 'P4', '4', 'list', 'AgerFactor'),
	(139, 'P5', '5', 'list', 'AgerFactor'),
	(140, 'P5', '5', 'list', 'ExternalDemage'),
	(141, 'P4', '4', 'list', 'ExternalDemage'),
	(142, 'P3', '3', 'list', 'ExternalDemage'),
	(143, 'P2', '2', 'list', 'ExternalDemage'),
	(144, 'P1', '1', 'list', 'ExternalDemage'),
	(145, 'P1', '1', 'list', 'CPReading'),
	(146, 'P3', '3', 'list', 'CPReading'),
	(147, 'P5', '5', 'list', 'CPReading'),
	(148, 'P5', '5', 'list', 'CPSurvey'),
	(149, 'P4', '4', 'list', 'CPSurvey'),
	(150, 'P3', '3', 'list', 'CPSurvey'),
	(151, 'P2', '2', 'list', 'CPSurvey'),
	(152, 'P1', '1', 'list', 'CPSurvey'),
	(153, 'P1', '1', 'list', 'CathodicInterference'),
	(154, 'P2', '2', 'list', 'CathodicInterference'),
	(155, 'P3', '3', 'list', 'CathodicInterference'),
	(156, 'P4', '4', 'list', 'CathodicInterference'),
	(157, 'P5', '5', 'list', 'CathodicInterference'),
	(158, 'Carbon steel line with water is present in normal operation', '5', 'list', 'WaterPof'),
	(159, 'Carbon steel line typically has water, typically vapour phase, some dropout', '4', 'list', 'WaterPof'),
	(160, 'Carbon steel line occasionally has water, typically vapour phase', '3', 'list', 'WaterPof'),
	(161, 'Carbon steel line operates dry – but water may be present in upset situations or effectively inhibited, or CRA pipeline', '2', 'list', 'WaterPof'),
	(162, 'Carbon steel line operates dry - no water ever present', '1', 'list', 'WaterPof'),
	(163, 'Suspected corrosion due to presence of water and high dissolved oxygen', '5', 'list', 'LocalCorrosion'),
	(164, 'Solids in line.', '5', 'list', 'LocalCorrosion'),
	(165, 'Suspected MIC due to presence of water and high level of SRB', '5', 'list', 'LocalCorrosion'),
	(166, 'Suspected corrosion due to presence of water and sour service with PH2S > 0.01 barg (except CRA pipeline)', '5', 'list', 'LocalCorrosion'),
	(167, 'Suspected corrosion due to presence of water and CO2 with PCO2 > 0.09 barg (except CRA pipeline)', '5', 'list', 'LocalCorrosion'),
	(168, 'Unknown type of corrosion driving factor due to multiple content composition and presence of water(e.g CO2, H2S, O2, Cl, SRB)', '5', 'list', 'LocalCorrosion'),
	(169, 'No increased local corrosion risk factors OR due to CRA pipeline', '1', 'list', 'LocalCorrosion'),
	(170, 'Leak evidence but not properly documented', '5', 'list', 'LeakHistory'),
	(171, 'One corrosion leak or more than one leak caused by any mechanism', '4', 'list', 'LeakHistory'),
	(172, 'One leak caused by a third party OR One corrosion leak or more than one leak caused by any mechanism within 2 years', '3', 'list', 'LeakHistory'),
	(173, 'No leaks within 2 years', '1', 'list', 'LeakHistory'),
	(174, 'P5', '5', 'list', 'Design'),
	(175, 'P4', '4', 'list', 'Design'),
	(176, 'P3', '3', 'list', 'Design'),
	(177, 'P2', '2', 'list', 'Design'),
	(178, 'P1', '1', 'list', 'Design'),
	(179, 'Impossible to overpressurise pipeline e.g. design pressure greater than reservoir pressure or compressor maximum pressure', '1', 'list', 'Overpressure'),
	(180, 'Overpressure possible but pipeline protected by multiple overpressure protection systems (i.e. HIPPS and relief valves).', '2', 'list', 'Overpressure'),
	(181, 'Overpressure possible but pipeline protected by a single overpressure protection system', '3', 'list', 'Overpressure'),
	(182, 'Overpressure possible but pipeline not protected by an overpressure protection system', '5', 'list', 'Overpressure'),
	(183, 'More than 100 pressure cycles of >10% MAOP per year, or pressure cycles have been shown to exceed the basis of design of this pipeline by more than 10% (in terms of number, duration, or severity).', '5', 'list', 'PressureCycling'),
	(184, 'No data.', '4', 'list', 'PressureCycling'),
	(185, 'Between 10 and 100 pressure cycles of >10% MAOP per year, or pressure cycles have been shown to exceed the basis of design of this pipeline by less than 10% (in terms of number, duration, or severity).', '3', 'list', 'PressureCycling'),
	(186, 'Less than 10 pressure cycles of >10% MAOP per year, or pressure cycles are within the basis of design of this pipeline (in terms of number, duration, and severity.', '1', 'list', 'PressureCycling'),
	(187, 'More than 5 temperature cycles of >50°C per year,  or operational temperature ranges (including number of cycles and extreme values) have been known to exceed the  within the design limits of this pipeline by more than 20°C, or there have been more than 5 exceedances per year.', '5', 'list', 'TemperatureCycling'),
	(188, 'No data.', '4', 'list', 'TemperatureCycling'),
	(189, 'Between 1 and 5 temperature cycles of >50°C per year, or operational temperature ranges (including number of cycles and extreme values) have been known to exceed the  within the design limits of this pipeline by less than 20°C, or less than 5 exceedances per year.', '3', 'list', 'TemperatureCycling'),
	(190, '1 or no temperature cycles of >50°C per year, or operational temperature ranges (including number of cycles and extreme values) are within the design limits of this pipeline, if these are known and documented.', '1', 'list', 'TemperatureCycling'),
	(191, 'Negligible - No shutdown; less than $10k, immediate repairs', '1', 'list', 'financialFactor'),
	(192, 'Low - Unit shutdown, $10k - $100k, Planned repairs', '2', 'list', 'financialFactor'),
	(193, 'Medium - Partial shutdown, reduced production, short repair $100k - $1m', '3', 'list', 'financialFactor'),
	(194, 'High - Prod shutdown; prolonged repairs, $1m - $10m', '4', 'list', 'financialFactor'),
	(195, 'V High - Long term shut, extensive repairs, over $10m', '5', 'list', 'financialFactor'),
	(196, 'P5', '5', 'list', 'LocationFactor'),
	(197, 'P4', '4', 'list', 'LocationFactor'),
	(198, 'P3', '3', 'list', 'LocationFactor'),
	(199, 'P1', '1', 'list', 'LocationFactor'),
	(200, 'P5', '5', 'list', 'ReleaseQuantity'),
	(201, 'P4', '4', 'list', 'ReleaseQuantity'),
	(202, 'P3', '3', 'list', 'ReleaseQuantity'),
	(203, 'P2', '2', 'list', 'ReleaseQuantity'),
	(204, 'P1', '1', 'list', 'ReleaseQuantity'),
	(205, 'P1', '1', 'list', 'FlammabilityToxic'),
	(206, 'P2', '2', 'list', 'FlammabilityToxic'),
	(207, 'P3', '3', 'list', 'FlammabilityToxic'),
	(208, 'P4', '4', 'list', 'FlammabilityToxic'),
	(209, 'P5', '5', 'list', 'FlammabilityToxic'),
	(210, 'P5', '5', 'list', 'LeakSize'),
	(211, 'P3', '3', 'list', 'LeakSize'),
	(212, 'P2', '2', 'list', 'LeakSize'),
	(213, 'P1', '1', 'list', 'LeakSize'),
	(214, 'Water OR Air', '1', 'list', 'FluidType'),
	(215, 'Sweet Natural Gas', '2', 'list', 'FluidType'),
	(216, 'Toxic and/or flammable gases except sweet natural gas', '3', 'list', 'FluidType'),
	(217, 'Produced water and toxic and/or flammable liquids except crude oil and heavy fractionates', '4', 'list', 'FluidType'),
	(218, 'Crude oil and heavy fractionates', '5', 'list', 'FluidType'),
	(219, 'No external surveys performed', '0.5', 'list', 'ExternalInspectionHistorical'),
	(220, 'No full pipe-length external surveys have been undertaken within the last 2 years.', '0.625', 'list', 'ExternalInspectionHistorical'),
	(221, 'External inspections surveys have been undertaken within the last 1-2 years of partial sections only. Assessment of result and remedial actions performed as necessary.', '0.75', 'list', 'ExternalInspectionHistorical'),
	(222, 'External inspection surveys have been undertaken within the last 1-2 years of the full pipe length.  Assessment of result and remedial actions performed as necessary.', '0.875', 'list', 'ExternalInspectionHistorical'),
	(223, 'Routine external surveys are undertaken more than once a year of whole pipe length.  Assessment of result and remedial actions performed as necessary. ', '1', 'list', 'ExternalInspectionHistorical'),
	(224, 'Detailed (full coverage) inspection performed within planned period. No defects OR defect FFP until next scheduled inspection', '1', 'list', 'InternalInspectionHistorical'),
	(225, 'Detailed (full coverage) inspection performed within planned period. Defects require mitigation before next scheduled inspection', '0.875', 'list', 'InternalInspectionHistorical'),
	(226, 'Basic (partial coverage) inspections performed within inspection period, No defects or Defects FFP until next scheduled inspection OR Detailed (full coverage) inspection performed outside planned period with no defects or Defects FFP until next scheduled inspection', '0.75', 'list', 'InternalInspectionHistorical'),
	(227, 'Basic (partial coverage) inspections performed within inspection period, defects found requiring mitigation before next scheduled inspection OR  Detailed (full coverage) inspection performed outside planned period with defects requiring mitigation before next scheduled inspection (now overdue)', '0.625', 'list', 'InternalInspectionHistorical'),
	(228, 'No previous inspections performed to determine internal condition OR Basic (partial coverage) inspections performed, but outside of inspection period', '0.5', 'list', 'InternalInspectionHistorical'),
	(229, 'Pipeline', '1', 'list', 'AssetType'),
	(230, 'Vessel', '2', 'list', 'AssetType'),
	(231, 'Piping', '3', 'list', 'AssetType'),
	(232, 'Tank', '4', 'list', 'AssetType'),
	(233, 'P1', '1', 'list', 'FatigueSisceptibilityfactor'),
	(234, 'P2', '2', 'list', 'FatigueSisceptibilityfactor'),
	(235, 'P5', '5', 'list', 'FatigueSisceptibilityfactor'),
	(236, 'P5', '5', 'list', 'FatigueSisceptibilityfactor'),
	(237, 'P1', '1', 'list', 'PipelinecoverOffshore'),
	(238, 'P3', '3', 'list', 'PipelinecoverOffshore'),
	(239, 'P4', '4', 'list', 'PipelinecoverOffshore'),
	(240, 'P5', '5', 'list', 'PipelinecoverOffshore'),
	(241, 'Inadequate inspections to determine stability; pipeline unburied and not inspected within the last 5 years.', '5', 'list', 'SeabedStability'),
	(242, 'Anomalies such as localised lateral movement have been observed but not remediated OR pipeline has exhibited instability or scour, not assessed or follow up.', '4', 'list', 'SeabedStability'),
	(243, 'Pipeline has exhibited instability or scour, but anomalies have been assessed and remediated if required', '2', 'list', 'SeabedStability'),
	(244, 'Pipeline is stable and / or buried', '1', 'list', 'SeabedStability'),
	(245, 'Pipeline passes through multiple high traffic or threat areas (>10% of length).  Incidents (including near misses) reported in the past.', '5', 'list', 'ThirdPartyDemageOff'),
	(246, 'Pipeline passes through multiple high traffic or threat areas (>10% of length).  No incidents (including near misses) reported in the past.', '4', 'list', 'ThirdPartyDemageOff'),
	(247, 'Pipeline has some sections (<10%) passing through high traffic or threat areas (sea lanes or fishing grounds): Includes platform approach.', '3', 'list', 'ThirdPartyDemageOff'),
	(248, 'Pipeline does not contact platform or beach.', '1', 'list', 'ThirdPartyDemageOff'),
	(249, 'Full ROV pipeline surveys have been performed on the pipeline within the last 2 years.  Assessment of results and remedial actions performed as necessary.', '1', 'list', 'externalfactorOff'),
	(250, 'Partial ROV or SSS surveys have been performed on the pipeline within the last 2 years.  Assessment of results and remedial actions performed as necessary.', '2', 'list', 'externalfactorOff'),
	(251, 'Full ROV or SSS surveys have been performed on the pipeline within the last 2-5 years.  Assessment of results and remedial actions performed as necessary.', '3', 'list', 'externalfactorOff'),
	(252, 'An ROV or SSS survey has been performed on the pipeline within the last 10 years.  Assessment of results and remedial actions performed as necessary.', '4', 'list', 'externalfactorOff'),
	(253, 'No ROV or SSS survey has been performed on the pipeline within the last 10 years, or inspection results not assessed and remedial actions performed as necessary.', '5', 'list', 'externalfactorOff'),
	(254, 'Failure implies high environmental pollution consequences. This is the usual classification during operation in Location Class 2.', '5', 'list', 'EnvironmentalSensitivity'),
	(255, 'Failure implies significant environmental pollution consequences. This is the usual classification for operation outside the platform area (Location Class 1).', '3', 'list', 'EnvironmentalSensitivity'),
	(256, 'Failure implies minor environmental consequences.', '1', 'list', 'EnvironmentalSensitivity'),
	(257, 'The part of the pipeline / riser that in the near platform (manned) area or in areas with frequent human.', '', 'list', 'dnv'),
	(258, 'The area where no frequent human activity is located along the pipeline route.', '', 'list', 'dnv'),
	(259, 'Any CP survey conducted greater than 5 years ago, or CP not surveyed.', '5', 'list', 'CPSurvey_off'),
	(260, 'Full CP Survey conducted by ROV within the last 3 to 5 years. Assessment of results, but remedial actions not performed.', '4', 'list', 'CPSurvey_off'),
	(261, 'Full CP Survey conducted by ROV within the last 3 to 5 years. Assessment of results and remedial actions performed as necessary.', '3', 'list', 'CPSurvey_off');
/*!40000 ALTER TABLE `tbl_look_up` ENABLE KEYS */;

-- Dumping structure for table mythauth.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table mythauth.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `username`, `name`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'admin@example.com', 'Aldi', 'Aldi Bragi', '$2a$12$dcyYXzDT.W.zvCUxwvMxk.wZcI2sc0XzFvXZMTChuH44j360AjjVK', NULL, NULL, NULL, '09f9fff2f2d950219e1ee001b56fb39b', NULL, NULL, 1, 0, '2022-08-30 00:28:30', '2022-09-03 12:35:30', '2022-09-03 12:45:54'),
	(2, 'aldi2@aldi.com', 'Aldi2', 'Mas Aldi', '$2y$10$ut3PqwNNWeIV8WmbcKD9cu3IA8Fw5SgCIjnWkohrqLlnBDRtyo9Cu', NULL, NULL, NULL, '5217c0fdb309377cc1e5bc5d7a22c51b', NULL, NULL, 1, 0, '2022-08-30 00:31:01', '2022-08-30 00:31:01', NULL),
	(3, 'aaa@aa.com', 'Gaul', 'Aldi3', '$2y$10$zFDEy7qphP215/vAbSwTkefV8.utZomNTwL2w0f1mXMwpvkVQqOtq', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-09-03 10:32:27', '2022-09-03 12:52:03', NULL),
	(4, 'alidimyatiaz@gmail.com', 'aldi4', 'aldi5', '$2y$10$iVtEwgvD3AcXWZo.ATVdKuGabuQdUZOIby3aU7sx2mI3oZ3A9VQuO', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2022-09-03 10:45:01', '2022-09-03 12:35:49', NULL),
	(5, 'aldi6@aldi.com', 'aldi6', 'aldi6', '$2y$10$iSv31xBJnJbxWSS2oBx.cethiD8ranaYXcCirWu1dv6q5Q7cR.4m.', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2022-09-03 10:52:19', '2022-09-03 10:52:19', '2022-09-03 12:46:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
