-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `access`;
CREATE TABLE `access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_access` (`user_id`,`permission_id`,`village_id`),
  KEY `permission_id` (`permission_id`),
  KEY `village_id` (`village_id`),
  CONSTRAINT `access_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`),
  CONSTRAINT `access_ibfk_3` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`),
  CONSTRAINT `access_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `access` (`id`, `user_id`, `permission_id`, `village_id`) VALUES
(129,	1,	1,	1),
(130,	1,	2,	1),
(131,	1,	2,	2),
(4,	2,	1,	2),
(3,	2,	2,	1),
(141,	3,	1,	1),
(6,	3,	1,	2),
(122,	3,	2,	1),
(123,	3,	2,	2),
(160,	19,	1,	1),
(161,	19,	2,	1),
(162,	19,	2,	2),
(178,	20,	1,	1),
(179,	20,	1,	2),
(180,	20,	2,	2);

DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `permission` (`id`, `name`) VALUES
(1,	'adresář'),
(2,	'vyhledávač');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  `isAdmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `user` (`id`, `name`, `isAdmin`) VALUES
(1,	'Adam',	1),
(2,	'Bob',	1),
(3,	'Cyril',	1),
(4,	'Derek',	0),
(19,	'Pepa',	1),
(20,	'Franta',	1);

DROP TABLE IF EXISTS `village`;
CREATE TABLE `village` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

INSERT INTO `village` (`id`, `name`) VALUES
(1,	'Praha'),
(2,	'Brno');

-- 2020-06-01 19:04:01
