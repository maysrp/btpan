-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-12-20 20:16:16
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `torrent`
--

-- --------------------------------------------------------

--
-- 表的结构 `tr_commont`
--

CREATE TABLE IF NOT EXISTS `tr_commont` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `text` varchar(254) CHARACTER SET utf8 NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tr_file`
--

CREATE TABLE IF NOT EXISTS `tr_file` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `filename` text CHARACTER SET utf8 NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `tid` int(11) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tr_torrent`
--

CREATE TABLE IF NOT EXISTS `tr_torrent` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(64) NOT NULL,
  `magnet` varchar(128) NOT NULL,
  `uid` int(11) NOT NULL,
  `encoding` varchar(32) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `file` longtext CHARACTER SET utf8 NOT NULL,
  `size` int(11) NOT NULL,
  `createby` varchar(128) CHARACTER SET utf8 NOT NULL,
  `ms` longtext CHARACTER SET utf8 NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `time` varchar(64) NOT NULL,
  `filecount` int(11) NOT NULL,
  `tag` text CHARACTER SET utf8 NOT NULL,
  `commont` int(11) NOT NULL,
  `torrent` varchar(254) NOT NULL,
  `up_ip` varchar(128) NOT NULL,
  `up_time` int(11) NOT NULL,
  `title` varchar(254) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `tr_user`
--

CREATE TABLE IF NOT EXISTS `tr_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(128) NOT NULL,
  `salt` int(11) NOT NULL,
  `image` varchar(128) NOT NULL,
  `cookie` varchar(128) NOT NULL,
  `join_ip` varchar(128) NOT NULL,
  `join_time` int(11) NOT NULL,
  `login_info` longtext NOT NULL,
  `torrent` int(11) NOT NULL,
  `my` text CHARACTER SET utf8 NOT NULL,
  `point` int(11) NOT NULL,
  `fans` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
