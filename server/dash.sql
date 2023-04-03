-- --------------------------------------------------------
-- Хост:                         172.16.0.11
-- Версия сервера:               10.3.38-MariaDB-0ubuntu0.20.04.1 - Ubuntu 20.04
-- Операционная система:         debian-linux-gnu
-- HeidiSQL Версия:              12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица test.dashdata
CREATE TABLE IF NOT EXISTS `dashdata` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `rdzv` char(255) NOT NULL,
  `termina` char(255) NOT NULL,
  `trade_place` char(255) NOT NULL,
  `trade_date` int(10) NOT NULL,
  `nal` float(10,2) NOT NULL,
  `beznal` float(10,2) NOT NULL,
  `oper_type` int(1) NOT NULL COMMENT 'Приход 0, Расход 1',
  `reciept_id` varchar(255) DEFAULT NULL,
  `wo_time` varchar(255) DEFAULT NULL,
  `quant` int(10) NOT NULL,
  `field1` varchar(255) NOT NULL DEFAULT ' ',
  `is_correct` varchar(255) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`id`),
  UNIQUE KEY `unique_reciept_id` (`reciept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4465884 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица test.ticket_items
CREATE TABLE IF NOT EXISTS `ticket_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `quant` float(10,2) NOT NULL,
  `sum` float(10,0) NOT NULL,
  `sum_bnal` float(10,0) NOT NULL,
  `ticket_id` varchar(255) NOT NULL,
  UNIQUE KEY `unique_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4796182 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Экспортируемые данные не выделены.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
