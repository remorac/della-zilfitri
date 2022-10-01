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


DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pasien`;
CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simulasi_id` int(11) NOT NULL,
  `nama_pasien` varchar(255) DEFAULT NULL,
  `waktu_kedatangan` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `simulasi_id` (`simulasi_id`),
  CONSTRAINT `pasien_ibfk_4` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pasien` (`id`, `simulasi_id`, `nama_pasien`, `waktu_kedatangan`) VALUES
(1,	1,	'A',	'08:12:00'),
(2,	1,	'B',	'08:13:00'),
(4,	1,	'C',	'08:15:00'),
(5,	9,	'A',	'08:01:00'),
(6,	9,	'B',	'08:03:00'),
(7,	9,	'C',	'08:10:00');

DROP TABLE IF EXISTS `pasien_poli`;
CREATE TABLE `pasien_poli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) NOT NULL,
  `poli_id` int(11) NOT NULL,
  `waktu_kedatangan` time DEFAULT NULL,
  `waktu_dilayani` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `poli_id` (`poli_id`),
  CONSTRAINT `pasien_poli_ibfk_3` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pasien_poli_ibfk_4` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pasien_poli` (`id`, `pasien_id`, `poli_id`, `waktu_kedatangan`, `waktu_dilayani`, `waktu_selesai`) VALUES
(4,	1,	6,	NULL,	NULL,	NULL),
(5,	1,	3,	NULL,	NULL,	NULL),
(6,	1,	5,	NULL,	NULL,	NULL),
(7,	2,	6,	NULL,	NULL,	NULL),
(8,	2,	3,	NULL,	NULL,	NULL),
(10,	2,	4,	NULL,	NULL,	NULL),
(11,	1,	4,	NULL,	NULL,	NULL),
(13,	4,	6,	NULL,	NULL,	NULL),
(14,	4,	5,	NULL,	NULL,	NULL),
(15,	4,	4,	NULL,	NULL,	NULL),
(16,	5,	8,	NULL,	NULL,	NULL),
(17,	5,	12,	NULL,	NULL,	NULL),
(18,	5,	13,	NULL,	NULL,	NULL),
(19,	6,	8,	NULL,	NULL,	NULL),
(20,	6,	9,	NULL,	NULL,	NULL),
(21,	6,	11,	NULL,	NULL,	NULL),
(22,	6,	13,	NULL,	NULL,	NULL),
(23,	7,	8,	NULL,	NULL,	NULL),
(24,	7,	11,	NULL,	NULL,	NULL),
(25,	7,	10,	NULL,	NULL,	NULL),
(26,	7,	13,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `poli`;
CREATE TABLE `poli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simulasi_id` int(11) DEFAULT NULL,
  `nama_poli` varchar(255) NOT NULL,
  `jumlah_loket` int(11) DEFAULT NULL,
  `waktu_buka` time DEFAULT NULL,
  `waktu_tutup` time DEFAULT NULL,
  `waktu_mulai_istirahat` time DEFAULT NULL,
  `waktu_selesai_istirahat` time DEFAULT NULL,
  `durasi_pelayanan_min` int(11) NOT NULL,
  `durasi_pelayanan_max` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `simulasi_id` (`simulasi_id`),
  CONSTRAINT `poli_ibfk_2` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `poli` (`id`, `simulasi_id`, `nama_poli`, `jumlah_loket`, `waktu_buka`, `waktu_tutup`, `waktu_mulai_istirahat`, `waktu_selesai_istirahat`, `durasi_pelayanan_min`, `durasi_pelayanan_max`) VALUES
(2,	1,	'Poli Anak',	1,	'08:30:00',	'15:00:00',	'12:30:00',	'01:30:00',	5,	15),
(3,	1,	'Poli Umum',	2,	'08:30:00',	'16:00:00',	'12:30:00',	'01:30:00',	10,	15),
(4,	1,	'Apotek',	1,	'09:00:00',	'17:00:00',	'12:30:00',	'01:30:00',	2,	5),
(5,	1,	'Poli Penyakit Dalam',	1,	'08:30:00',	'15:00:00',	'12:30:00',	'01:30:00',	10,	20),
(6,	1,	'Pendaftaran',	3,	'08:00:00',	'11:00:00',	'12:30:00',	'01:30:00',	1,	10),
(8,	9,	'Pendaftaran',	NULL,	NULL,	NULL,	NULL,	NULL,	2,	12),
(9,	9,	'Poli Umum',	NULL,	NULL,	NULL,	NULL,	NULL,	5,	15),
(10,	9,	'Poli Anak',	NULL,	NULL,	NULL,	NULL,	NULL,	10,	20),
(11,	9,	'Poli Penyakit Dalam',	NULL,	NULL,	NULL,	NULL,	NULL,	10,	30),
(12,	9,	'Poli Gigi',	NULL,	NULL,	NULL,	NULL,	NULL,	5,	15),
(13,	9,	'Apotek',	NULL,	NULL,	NULL,	NULL,	NULL,	2,	7);

DROP TABLE IF EXISTS `simulasi`;
CREATE TABLE `simulasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `simulasi` (`id`, `nama`, `tanggal`, `keterangan`) VALUES
(1,	'Simulasi 1',	'2022-09-01',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(9,	'Simulasi 2',	'2022-09-02',	'asdfghjkl zxcvbnm'),
(10,	'Simulasi 3',	'2022-09-03',	'Percobaan kondisi pasien ramai pada siang hari');

DROP TABLE IF EXISTS `timeline`;
CREATE TABLE `timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `simulasi_id` int(11) NOT NULL,
  `waktu` time DEFAULT NULL,
  `poli_id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = datang, 2 = dilayani, 3 = selesai',
  `durasi` int(11) DEFAULT NULL,
  `jumlah_antri` int(11) DEFAULT NULL,
  `jumlah_dilayani` int(11) DEFAULT NULL,
  `jumlah_selesai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `simulasi_id` (`simulasi_id`),
  KEY `poli_id` (`poli_id`),
  KEY `pasien_id` (`pasien_id`),
  CONSTRAINT `timeline_ibfk_1` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`),
  CONSTRAINT `timeline_ibfk_2` FOREIGN KEY (`poli_id`) REFERENCES `poli` (`id`),
  CONSTRAINT `timeline_ibfk_3` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `timeline` (`id`, `simulasi_id`, `waktu`, `poli_id`, `pasien_id`, `status`, `durasi`, `jumlah_antri`, `jumlah_dilayani`, `jumlah_selesai`) VALUES
(199,	1,	'08:12:00',	6,	1,	1,	0,	1,	0,	0),
(200,	1,	'08:12:00',	6,	1,	2,	1,	0,	1,	0),
(201,	1,	'08:13:00',	6,	1,	3,	NULL,	0,	0,	1),
(202,	1,	'08:14:00',	3,	1,	1,	0,	1,	0,	0),
(203,	1,	'08:14:00',	3,	1,	2,	11,	0,	1,	0),
(204,	1,	'08:25:00',	3,	1,	3,	NULL,	1,	0,	1),
(205,	1,	'08:26:00',	5,	1,	1,	0,	1,	0,	0),
(206,	1,	'08:26:00',	5,	1,	2,	18,	0,	1,	0),
(207,	1,	'08:44:00',	5,	1,	3,	NULL,	1,	0,	1),
(208,	1,	'08:45:00',	4,	1,	1,	0,	1,	0,	1),
(209,	1,	'08:45:00',	4,	1,	2,	5,	0,	1,	1),
(210,	1,	'08:50:00',	4,	1,	3,	NULL,	0,	0,	2),
(211,	1,	'08:13:00',	6,	2,	1,	1,	1,	0,	1),
(212,	1,	'08:14:00',	6,	2,	2,	9,	0,	1,	1),
(213,	1,	'08:23:00',	6,	2,	3,	NULL,	1,	0,	2),
(214,	1,	'08:24:00',	3,	2,	1,	2,	1,	1,	0),
(215,	1,	'08:26:00',	3,	2,	2,	14,	0,	1,	1),
(216,	1,	'08:40:00',	3,	2,	3,	NULL,	0,	0,	2),
(217,	1,	'08:41:00',	4,	2,	1,	0,	1,	0,	0),
(218,	1,	'08:41:00',	4,	2,	2,	2,	0,	1,	0),
(219,	1,	'08:43:00',	4,	2,	3,	NULL,	0,	0,	1),
(220,	1,	'08:15:00',	6,	4,	1,	9,	1,	1,	1),
(221,	1,	'08:24:00',	6,	4,	2,	7,	0,	1,	2),
(222,	1,	'08:31:00',	6,	4,	3,	NULL,	0,	0,	3),
(223,	1,	'08:32:00',	5,	4,	1,	13,	1,	1,	0),
(224,	1,	'08:45:00',	5,	4,	2,	17,	0,	1,	1),
(225,	1,	'09:02:00',	5,	4,	3,	NULL,	0,	0,	2),
(226,	1,	'09:03:00',	4,	4,	1,	0,	1,	0,	2),
(227,	1,	'09:03:00',	4,	4,	2,	5,	0,	1,	2),
(228,	1,	'09:08:00',	4,	4,	3,	NULL,	0,	0,	3),
(328,	9,	'08:01:00',	8,	5,	1,	0,	1,	0,	0),
(329,	9,	'08:01:00',	8,	5,	2,	12,	0,	1,	0),
(330,	9,	'08:13:00',	8,	5,	3,	NULL,	2,	0,	1),
(331,	9,	'08:14:00',	12,	5,	1,	0,	1,	0,	0),
(332,	9,	'08:14:00',	12,	5,	2,	15,	0,	1,	0),
(333,	9,	'08:29:00',	12,	5,	3,	NULL,	0,	0,	1),
(334,	9,	'08:30:00',	13,	5,	1,	0,	1,	0,	0),
(335,	9,	'08:30:00',	13,	5,	2,	3,	0,	1,	0),
(336,	9,	'08:33:00',	13,	5,	3,	NULL,	0,	0,	1),
(337,	9,	'08:03:00',	8,	6,	1,	11,	1,	1,	0),
(338,	9,	'08:14:00',	8,	6,	2,	11,	1,	1,	1),
(339,	9,	'08:25:00',	8,	6,	3,	NULL,	1,	0,	2),
(340,	9,	'08:26:00',	9,	6,	1,	0,	1,	0,	0),
(341,	9,	'08:26:00',	9,	6,	2,	9,	0,	1,	0),
(342,	9,	'08:35:00',	9,	6,	3,	NULL,	0,	0,	1),
(343,	9,	'08:36:00',	11,	6,	1,	28,	1,	1,	0),
(344,	9,	'09:04:00',	11,	6,	2,	15,	0,	1,	1),
(345,	9,	'09:19:00',	11,	6,	3,	NULL,	0,	0,	2),
(346,	9,	'09:20:00',	13,	6,	1,	0,	1,	0,	1),
(347,	9,	'09:20:00',	13,	6,	2,	5,	0,	1,	1),
(348,	9,	'09:25:00',	13,	6,	3,	NULL,	0,	0,	2),
(349,	9,	'08:10:00',	8,	7,	1,	16,	2,	1,	0),
(350,	9,	'08:26:00',	8,	7,	2,	6,	0,	1,	2),
(351,	9,	'08:32:00',	8,	7,	3,	NULL,	0,	0,	3),
(352,	9,	'08:33:00',	11,	7,	1,	0,	1,	0,	0),
(353,	9,	'08:33:00',	11,	7,	2,	30,	0,	1,	0),
(354,	9,	'09:03:00',	11,	7,	3,	NULL,	1,	0,	1),
(355,	9,	'09:04:00',	10,	7,	1,	0,	1,	0,	0),
(356,	9,	'09:04:00',	10,	7,	2,	20,	0,	1,	0),
(357,	9,	'09:24:00',	10,	7,	3,	NULL,	0,	0,	1),
(358,	9,	'09:25:00',	13,	7,	1,	1,	1,	0,	2),
(359,	9,	'09:26:00',	13,	7,	2,	5,	0,	1,	2),
(360,	9,	'09:31:00',	13,	7,	3,	NULL,	0,	0,	3);

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
(1,	'user',	'j3WuNTW9lnmySl68a-yqzQfbIkrasjAJ',	'$2y$13$eVAx/Zqmqlvf4whmxop.aeFV9p8ptg/vhiLeeaKbMNwb/MYQp.zg6',	NULL,	'user@example.com',	10,	1663067525,	1663067525,	'iiFETQVtz7wpYTCmd1uqF7Jmy2asp4Gi_1663067525');

-- 2022-10-01 18:02:39
