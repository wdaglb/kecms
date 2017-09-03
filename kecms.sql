-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-09-04 00:56:33
-- 服务器版本： 5.5.56-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kecms`
--

-- --------------------------------------------------------

--
-- 表的结构 `ke_admin`
--

CREATE TABLE `ke_admin` (
  `id` int(11) NOT NULL,
  `useConfig` int(11) NOT NULL DEFAULT '0',
  `usr` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pmd` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `login_time` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `roles` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ke_admin`
--

INSERT INTO `ke_admin` (`id`, `useConfig`, `usr`, `pmd`, `token`, `create_time`, `login_time`, `name`, `roles`, `status`) VALUES
(1, 1, 'root', 'd93a5def7511da3d0f2d171d9c344e91', '638de608692d01e59152fd762e46e5c0', 1502826029, 1504435944, '超级管理员', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ke_article`
--

CREATE TABLE `ke_article` (
  `id` bigint(20) NOT NULL,
  `classid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `ke_class`
--

CREATE TABLE `ke_class` (
  `id` int(11) NOT NULL,
  `classid` int(11) NOT NULL DEFAULT '0',
  `module` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `px` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `keywords` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `money` int(11) NOT NULL DEFAULT '0',
  `pass` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ke_class`
--

INSERT INTO `ke_class` (`id`, `classid`, `module`, `name`, `title`, `content`, `px`, `create_time`, `status`, `keywords`, `description`, `money`, `pass`, `user`) VALUES
(1, 0, 'image', '', '测试栏目文章', '', 0, 1504365214, 0, '', '', 0, '', ''),
(2, 0, 'image', '', 'qwe', '', 1, 1504365375, 1, '', '', 1, '', ''),
(3, 1, 'image', '', '二级', '', 1, 1504368068, 1, '', '', 1, '', ''),
(4, 3, 'image', '', '三级', '', 1, 1504368074, 1, '', '', 1, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ke_config`
--

CREATE TABLE `ke_config` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `reg` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `icp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ke_config`
--

INSERT INTO `ke_config` (`id`, `status`, `reg`, `title`, `icp`, `keywords`, `description`) VALUES
(1, 1, 0, '默认站点2', '1234562', 'dsfgads', 'f');

-- --------------------------------------------------------

--
-- 表的结构 `ke_module`
--

CREATE TABLE `ke_module` (
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `src` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ke_module`
--

INSERT INTO `ke_module` (`name`, `src`, `title`, `create_time`, `status`) VALUES
('article', 'article', '文章', 0, 0),
('image', 'image', '图片', 0, 0),
('link', 'link', '友情链接', 0, 0),
('page', 'page', '页面', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ke_users`
--

CREATE TABLE `ke_users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nickname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `age` tinyint(3) NOT NULL DEFAULT '0',
  `reg_time` int(11) NOT NULL DEFAULT '0',
  `up_time` int(11) NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ke_users`
--

INSERT INTO `ke_users` (`id`, `username`, `nickname`, `password`, `token`, `sex`, `age`, `reg_time`, `up_time`, `group`, `delete`) VALUES
(1, 'wdaglb', 'king east', '9354eb61e9cb732694dbe052a4bb4658', '', 1, 25, 1503418432, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ke_admin`
--
ALTER TABLE `ke_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_article`
--
ALTER TABLE `ke_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_class`
--
ALTER TABLE `ke_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_config`
--
ALTER TABLE `ke_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ke_users`
--
ALTER TABLE `ke_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ke_admin`
--
ALTER TABLE `ke_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `ke_article`
--
ALTER TABLE `ke_article`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `ke_class`
--
ALTER TABLE `ke_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `ke_config`
--
ALTER TABLE `ke_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `ke_users`
--
ALTER TABLE `ke_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
