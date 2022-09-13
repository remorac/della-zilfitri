-- Adminer 4.8.1 MySQL 5.5.5-10.8.3-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  CONSTRAINT `auth_assignment_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
('user',	'1',	1661585346,	NULL,	NULL,	NULL),
('user',	'2',	1661586779,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `name` (`name`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `auth_item_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  CONSTRAINT `auth_item_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
('/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/assignment/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/assignment/assign',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/assignment/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/assignment/revoke',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/assignment/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/default/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/default/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/menu/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/menu/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/menu/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/menu/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/menu/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/menu/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/assign',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/get-users',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/remove',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/permission/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/assign',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/get-users',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/remove',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/role/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/route/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/route/assign',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/route/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/route/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/route/refresh',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/route/remove',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/rule/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/rule/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/rule/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/rule/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/rule/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/rule/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/activate',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/change-password',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/login',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/logout',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/request-password-reset',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/reset-password',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/signup',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/acf/user/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/default/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/default/db-explain',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/default/download-mail',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/default/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/default/toolbar',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/default/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/user/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/user/reset-identity',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/debug/user/set-identity',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gap/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gap/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gap/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gap/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gap/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gap/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/default/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/default/action',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/default/diff',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/default/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/default/preview',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/gii/default/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/kriteria/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/kriteria/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/kriteria/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/kriteria/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/kriteria/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/kriteria/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/laporan/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/laporan/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/pemeriksaan-create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/pemeriksaan-delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/pemeriksaan-update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/pemeriksaan-view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/pasien/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/about',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/captcha',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/contact',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/error',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/login',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/logout',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/request-password-reset',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/resend-verification-email',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/reset-password',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/signup',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/site/verify-email',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/user/*',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/user/create',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/user/delete',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/user/index',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/user/update',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('/user/view',	2,	NULL,	NULL,	NULL,	1661585307,	1661585307,	NULL,	NULL),
('user',	1,	NULL,	NULL,	NULL,	1661585326,	1661585326,	NULL,	NULL);

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('user',	'/*');

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `gap`;
CREATE TABLE `gap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selisih` int(11) NOT NULL,
  `bobot` double NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gap` (`id`, `selisih`, `bobot`, `keterangan`) VALUES
(1,	0,	5,	'Tidak ada selisih (kriteria sesuai dengan yang ketentuan)'),
(2,	1,	4.5,	'Kriteria individu kelebihan 1 tingkat/level'),
(3,	-1,	4,	'Kriteria individu kekurangan 1 tingkat/level'),
(4,	2,	3.5,	'Kriteria individu kelebihan 2 tingkat/level'),
(5,	-2,	3,	'Kriteria individu kekurangan 2 tingkat/level'),
(6,	3,	2.5,	'Kriteria individu kelebihan 3 tingkat/level'),
(7,	-3,	2,	'Kriteria individu kekurangan 3 tingkat/level'),
(8,	4,	1.5,	'Kriteria individu kelebihan 4 tingkat/level');

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kriteria` (`id`, `nama`, `jenis`) VALUES
(1,	'Demam',	1),
(3,	'Batuk',	2),
(4,	'Test 2',	1);

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1661062005),
('m130524_201442_init',	1661062808),
('m190124_110200_add_verification_token_column_to_user_table',	1661062809);

DROP TABLE IF EXISTS `pasien`;
CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pasien` (`id`, `nama`, `umur`, `alamat`) VALUES
(1,	'Isaac Newton',	34,	'asdfghjkl'),
(2,	'Nikola Tesla',	44,	'qwertyuioplkjhgfdsazxcvbnm');

DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE `pemeriksaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pemeriksaan` (`id`, `pasien_id`, `tanggal`) VALUES
(2,	1,	'2022-08-30'),
(3,	1,	'2022-08-24'),
(4,	2,	'2022-08-30');

DROP TABLE IF EXISTS `pemeriksaan_kriteria`;
CREATE TABLE `pemeriksaan_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemeriksaan_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `subkriteria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subkriteria_id` (`subkriteria_id`),
  KEY `pemeriksaan_id` (`pemeriksaan_id`),
  KEY `kriteria_id` (`kriteria_id`),
  CONSTRAINT `pemeriksaan_kriteria_ibfk_2` FOREIGN KEY (`subkriteria_id`) REFERENCES `subkriteria` (`id`),
  CONSTRAINT `pemeriksaan_kriteria_ibfk_3` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pemeriksaan_kriteria_ibfk_4` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pemeriksaan_kriteria` (`id`, `pemeriksaan_id`, `kriteria_id`, `subkriteria_id`) VALUES
(4,	2,	1,	6),
(5,	2,	4,	2),
(6,	2,	3,	9),
(7,	3,	1,	4),
(8,	3,	4,	1),
(9,	3,	3,	8),
(10,	4,	1,	5),
(11,	4,	4,	2),
(12,	4,	3,	9);

DROP TABLE IF EXISTS `subkriteria`;
CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kriteria_id` (`kriteria_id`),
  CONSTRAINT `subkriteria_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `subkriteria` (`id`, `kriteria_id`, `nama`, `nilai`, `target`) VALUES
(1,	4,	'skjfhgjkdf',	3,	1),
(2,	4,	'sdfd',	2,	0),
(3,	4,	'sdfsdfds',	1,	0),
(4,	1,	'jdahfgsjdh',	3,	1),
(5,	1,	'sdmnfdkj',	2,	0),
(6,	1,	'sjhrgkjd',	1,	0),
(8,	3,	'skjhgkf',	2,	1),
(9,	3,	'cnkjrdghke',	1,	0);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1,	'user',	'fNZPhUb_jfJonh46xkcckgF9__UHW-xo',	'$2y$13$Ce//.4NmLtAcwRrX6Yutu.1orUWtlxMIU8I9LNJD.n.VWfbCqaFvC',	NULL,	'user@email.com',	10,	1661062822,	1661062822,	'st59FFJZxqRoL8q3t2cRf60uHxDuF6kA_1661062822'),
(2,	'user2',	'R0lLUI6qjscbAiP5cob05eeB62Dh-trU',	'$2y$13$sYrAiUD4sbyNAa7Mkf767OXPlfTBFmMX4l.2XPGhm1KPHaA1ZGIUi',	NULL,	'user2@example.com',	10,	NULL,	NULL,	NULL);

-- 2022-08-27 07:53:33
