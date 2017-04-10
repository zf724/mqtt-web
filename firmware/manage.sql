-- --------------------------------------------------------
-- 主机:                           192.168.1.59
-- 服务器版本:                        5.6.35 - MySQL Community Server (GPL)
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  9.3.0.5056
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出  表 bracelet.accounts 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- 正在导出表  bracelet.accounts 的数据：~3 rows (大约)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `name`, `password`, `phone`, `birthday`, `weight`, `height`) VALUES
	(1, 'wcy', '123456', '112', '2012-04-01', 77.1, 111.5),
	(2, 'xwl', '123456', '112', '2012-04-01', 33.1, 77.1),
	(3, 'shq', '123456', '112', '2012-04-01', 45.1, 78.1),
	(4, 'mm', '123456', '112', '2012-04-01', 78.1, 96.1),
	(5, 'wa', '123456', '112', '2012-04-01', 120.1, 131.5),
	(6, 'zx', '123456', '112', '2012-04-01', 160.1, 151.5),
	(7, '22', '123456', '112', '2012-04-01', 58.1, 191.5),
	(8, 'ty', '123456', '112', '2012-04-01', 96.1, 11.5),
	(9, 'vv', '123456', '112', '2012-04-01', 77.1, 31.5),	
	(10, 'x7l', '123456', '112', '2012-04-01', 137, 71.5),	
	(11, 'x5', '123456', '112', '2012-04-01', 99, 41.5),
	(12, 'er', '1234', '1234', '2017-02-02', 60, 123),
	(13, 'zf', '12345', '0', '2000-11-01', 78, 3);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- 导出  表 bracelet.firmware 结构
CREATE TABLE IF NOT EXISTS `firmware` (
  `version` char(50) NOT NULL COMMENT '版本号',
  `url` char(255) NOT NULL COMMENT '下载地址',
  `enabled` int(11) NOT NULL COMMENT '是否禁用',
  PRIMARY KEY (`version`),
  UNIQUE KEY `version` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='固件下载';

-- 导出  表 bracelet.user 结构
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

-- 正在导出表  bracelet.user 的数据：2 rows
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `account`, `password`, `email`, `remark`, `status`) VALUES
	(1, 'admin', '1111', 'zf@oqsmart.com.cn', 'admin', 1),
	(56, 'zf', 'zf', '1@2.c', ' gggg', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
