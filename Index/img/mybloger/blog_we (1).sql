-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-09-26 22:06:49
-- 服务器版本： 5.5.42-log
-- PHP Version: 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_we`
--

CREATE TABLE IF NOT EXISTS `blog_we` (
  `we` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `wekey` text NOT NULL,
  `fromusername` varchar(128) NOT NULL,
  `is_join` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog_we`
--

INSERT INTO `blog_we` (`we`, `token`, `wekey`, `fromusername`, `is_join`, `time`) VALUES
(1, 'hjk', 'ddfd', 'o49fcwc2_NP9DQQlC1A_HiulolH4', 1, 1474883287);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_we`
--
ALTER TABLE `blog_we`
  ADD PRIMARY KEY (`we`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_we`
--
ALTER TABLE `blog_we`
  MODIFY `we` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
