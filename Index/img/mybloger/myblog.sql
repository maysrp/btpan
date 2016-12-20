-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-22 19:51:50
-- 服务器版本： 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_post`
--

CREATE TABLE `blog_post` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `text` longtext CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `time` int(11) NOT NULL,
  `retime` int(11) NOT NULL,
  `tag` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `tid` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `view` int(11) NOT NULL,
  `re` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `blog_repost`
--

CREATE TABLE `blog_repost` (
  `rid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `lc` int(11) NOT NULL,
  `ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `blog_shelves`
--

CREATE TABLE `blog_shelves` (
  `vid` int(11) NOT NULL,
  `info` longtext CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `blog_shelves`
--

INSERT INTO `blog_shelves` (`vid`, `info`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- 表的结构 `blog_site`
--

CREATE TABLE `blog_site` (
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '1',
  `page` int(11) NOT NULL DEFAULT '10',
  `keywords` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `niming` int(11) NOT NULL DEFAULT '0',
  `other` int(11) NOT NULL DEFAULT '0',
  `footer` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `javascript` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `background-attachment` varchar(32) NOT NULL,
  `background-repeat` varchar(32) NOT NULL,
  `logo` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `blog_site`
--

INSERT INTO `blog_site` (`sid`, `uid`, `page`, `keywords`, `description`, `niming`, `other`, `footer`, `javascript`, `image`, `background-attachment`, `background-repeat`, `logo`, `name`) VALUES
(1, 1, 3, '                sadasd,sadasd            ', '        222222222222      ', 1, 0, '																																																																																																																																																																																																																																																																	<h4>友情链接</h4>\r\n		<p><a href="http://git.oschina.net/supercell/mybloger">mybloger</a></p>\r\n<p><a href="http://www.thinkphp.cn/">ThinkPHP</a></p>\r\n		<p><a href="http://v3.bootcss.com/">bootstrap</a></p>\r\n		<p><a href="http://jquery.com/">JQuery</a></p>\r\n		<p><a href="https://cnmoe.com">博客</a></p>\r\n\r\n<small><p class="text-muted"><i>时间戳:<span id="s_time"></span></i></P></small>\r\n\r\n\r\n<script>\r\nsetInterval("clock()",250);\r\nfunction clock(){\r\n    var dat=new Date();\r\n    var m_time=dat.getTime();\r\n    var s_time=Math.floor(m_time/1000);\r\n  \r\n    $("#s_time").text(s_time);\r\n}\r\n\r\n</script>\r\n\r\n\r\n																																																																																																																																																																																																																									', '																																											', '', 'fixed', 'no-repeat', 'http://git.oschina.net/logo.svg', '博客');

-- --------------------------------------------------------

--
-- 表的结构 `blog_tag`
--

CREATE TABLE `blog_tag` (
  `tid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `tag` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `post` text NOT NULL,
  `num` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `blog_user`
--

CREATE TABLE `blog_user` (
  `uid` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `password` varchar(128) NOT NULL,
  `image` varchar(200) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `time` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `repost` int(11) NOT NULL,
  `login_history` longtext NOT NULL,
  `info` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `cookie` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `blog_user`
--

INSERT INTO `blog_user` (`uid`, `name`, `password`, `image`, `salt`, `ip`, `time`, `post`, `repost`, `login_history`, `info`, `cookie`) VALUES
(1, 'admin', '15ab8357abeb6eacf1b591a1b5b1aedd', '/Uploads/tx/m_57e40d18e76e8.jpg', '1', '127.0.0.1', 1474558464, 0, 0, '[{"time":1474105752,"ip":"127.0.0.1"},{"time":1474105756,"ip":"127.0.0.1"},{"time":1474210017,"ip":"127.0.0.1"},{"time":1474275816,"ip":"127.0.0.1"},{"time":1474310314,"ip":"127.0.0.1"},{"time":1474310343,"ip":"127.0.0.1"},{"time":1474317949,"ip":"127.0.0.1"},{"time":1474374361,"ip":"127.0.0.1"},{"time":1474374374,"ip":"127.0.0.1"},{"time":1474374723,"ip":"127.0.0.1"},{"time":1474376492,"ip":"127.0.0.1"},{"time":1474427957,"ip":"127.0.0.1"},{"time":1474535426,"ip":"127.0.0.1"},{"time":1474558464,"ip":"127.0.0.1"}]', '[{"name":"59059903_p0_master1200.jpg","type":"image\\/jpeg","size":475643,"key":"image","extension":"jpg","savepath":".\\/Uploads\\/tx\\/","savename":"57e40b4655060.jpg","hash":"2d02d3f0dbad9c8ec711402ac6caeaae"}]', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `blog_repost`
--
ALTER TABLE `blog_repost`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `blog_shelves`
--
ALTER TABLE `blog_shelves`
  ADD PRIMARY KEY (`vid`);

--
-- Indexes for table `blog_site`
--
ALTER TABLE `blog_site`
  ADD UNIQUE KEY `sid` (`sid`);

--
-- Indexes for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD UNIQUE KEY `tid` (`tid`);

--
-- Indexes for table `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- 使用表AUTO_INCREMENT `blog_repost`
--
ALTER TABLE `blog_repost`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `blog_shelves`
--
ALTER TABLE `blog_shelves`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `blog_site`
--
ALTER TABLE `blog_site`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `blog_tag`
--
ALTER TABLE `blog_tag`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- 使用表AUTO_INCREMENT `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
