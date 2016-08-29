CREATE DATABASE IF NOT EXISTS news;

USE news;
CREATE TABLE if not exists `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `author` varchar(16) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;