-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-02-26 16:58:53
-- 服务器版本： 5.7.26-log
-- PHP 版本： 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `bappdemmo`
--

-- --------------------------------------------------------

--
-- 表的结构 `bapp_admin`
--

CREATE TABLE IF NOT EXISTS `bapp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '用户名',
  `pass` varchar(255) NOT NULL COMMENT '密码',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `bapp_admin`
--

TRUNCATE TABLE `bapp_admin`;
--
-- 转存表中的数据 `bapp_admin`
--

INSERT INTO `bapp_admin` (`id`, `name`, `pass`, `create_time`, `update_time`) VALUES
(1, 'admin', 'b89fb0638b62af9e79c8412245bdac4d8ca654ce', '2022-02-21 23:12:15', '2022-02-21 23:12:15');

-- --------------------------------------------------------

--
-- 表的结构 `bapp_banners`
--

CREATE TABLE IF NOT EXISTS `bapp_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) NOT NULL COMMENT '图片地址',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '点击后跳转的地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `bapp_banners`
--

TRUNCATE TABLE `bapp_banners`;
--
-- 转存表中的数据 `bapp_banners`
--

INSERT INTO `bapp_banners` (`id`, `pic`, `create_time`, `update_time`, `url`) VALUES
(1, 'https://bossaudioandcomic-1252317822.image.myqcloud.com/activity/document/d080c591ff088fab85044dde7b0efc0b.jpg', '2022-02-08 11:02:42', '2022-02-08 11:02:42', ''),
(2, 'https://bossaudioandcomic-1252317822.image.myqcloud.com/activity/document/2c1ad692591aec7062855aaf1c46601a.jpg', '2022-02-08 11:02:42', '2022-02-08 11:02:42', ''),
(3, 'https://bossaudioandcomic-1252317822.image.myqcloud.com/activity/document/e52dcc5e4053d900b0da952c1927646e.jpg', '2022-02-08 11:03:06', '2022-02-08 11:03:06', ''),
(4, 'https://bossaudioandcomic-1252317822.image.myqcloud.com/activity/document/8fdf5eebfd99f05cc7298ad6ccbd528c.jpg', '2022-02-08 11:03:06', '2022-02-08 11:03:06', ''),
(6, 'http://bapp.wonyes.org/storage/topic/20220222/bab3dd1f5dcefe2ed557fac3299e9c04.jpeg', '2022-02-22 20:59:31', '2022-02-22 20:59:31', '3'),
(7, 'http://bapp.wonyes.org/storage/topic/20220222/ddbd4cf39f661cbdef75f57d3c4d801b.jpg', '2022-02-22 20:59:43', '2022-02-22 20:59:43', '4');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `bapp_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `groupid` tinyint(2) NOT NULL DEFAULT '1' COMMENT '群组等级',
  `balance` int(11) NOT NULL DEFAULT '0' COMMENT '余额',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '头像图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='app会员表';

--
-- 表的结构 `bapp_books`
--

CREATE TABLE IF NOT EXISTS `bapp_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '书名',
  `zjnums` int(10) NOT NULL DEFAULT '0' COMMENT '章节数量',
  `author` varchar(64) NOT NULL DEFAULT '' COMMENT '作者名字',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  `update_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=连载中，1=已完结',
  `pic` varchar(255) NOT NULL DEFAULT '' COMMENT '封面地址',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '阅读数量',
  `summary` text COMMENT '图书简介',
  `c_name` char(64) NOT NULL DEFAULT '玄幻' COMMENT '分类名字',
  `length` int(11) NOT NULL DEFAULT '0' COMMENT '字数',
  `cid` int(11) NOT NULL DEFAULT '1' COMMENT '分类id',
  PRIMARY KEY (`id`),
  KEY `c_name` (`c_name`(9))
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bapp_categorys`
--

CREATE TABLE IF NOT EXISTS `bapp_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(64) NOT NULL DEFAULT '' COMMENT '分类名称',
  `booknums` int(11) NOT NULL DEFAULT '0' COMMENT '拥有图书数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 插入之前先把表清空（truncate） `bapp_categorys`
--

TRUNCATE TABLE `bapp_categorys`;
--
-- 转存表中的数据 `bapp_categorys`
--

INSERT INTO `bapp_categorys` (`id`, `name`, `booknums`) VALUES
(1, '玄幻', 0),
(2, '修真', 0),
(3, '仙侠', 0),
(4, '都市', 0),
(5, '网游', 0),
(6, '科幻', 0),
(7, '恐怖', 0),
(8, '历史', 0),
(9, '女生', 0),
(10, '男生', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
