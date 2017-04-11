-- --------------------------------------------------------
-- 主机:                           192.168.1.56
-- 服务器版本:                        5.7.17 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  9.3.0.5056
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 mqtt.accounts 结构
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL COMMENT '用户名',
  `password` char(50) NOT NULL COMMENT '密码',
  `phone` char(50) DEFAULT NULL COMMENT '电话',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `weight` float DEFAULT NULL COMMENT '体重',
  `height` float DEFAULT NULL COMMENT '身高',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- 正在导出表  mqtt.accounts 的数据：~13 rows (大约)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- 导出  表 mqtt.firmware 结构
CREATE TABLE IF NOT EXISTS `firmware` (
  `version` char(50) NOT NULL COMMENT '版本号',
  `url` char(255) NOT NULL COMMENT '下载地址',
  `enabled` int(11) NOT NULL COMMENT '是否禁用',
  PRIMARY KEY (`version`),
  UNIQUE KEY `version` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='固件下载';

-- 正在导出表  mqtt.firmware 的数据：~0 rows (大约)
/*!40000 ALTER TABLE `firmware` DISABLE KEYS */;
/*!40000 ALTER TABLE `firmware` ENABLE KEYS */;

-- 导出  表 mqtt.host 结构
CREATE TABLE IF NOT EXISTS `host` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `host` varchar(50) NOT NULL,
  `port` int(10) unsigned NOT NULL,
  `client` char(50) NOT NULL,
  `user` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 正在导出表  mqtt.host 的数据：~1 rows (大约)
/*!40000 ALTER TABLE `host` DISABLE KEYS */;
INSERT INTO `host` (`id`, `host`, `port`, `client`, `user`, `password`) VALUES
	(1, 'mosquitto', 1883, 'mtk-test', 'Publisher', '1111');
/*!40000 ALTER TABLE `host` ENABLE KEYS */;

-- 导出  表 mqtt.message 结构
CREATE TABLE IF NOT EXISTS `message` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `topic` char(255) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- 正在导出表  mqtt.message 的数据：~4 rows (大约)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;

-- 导出  表 mqtt.user 结构
CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- 正在导出表  mqtt.user 的数据：2 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `account`, `password`, `email`, `remark`, `status`) VALUES
	(1, 'admin', '1111', 'zf@oqsmart.com.cn', 'admin', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
