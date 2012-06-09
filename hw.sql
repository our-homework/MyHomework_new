-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 06 月 09 日 10:07
-- 服务器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hw`
--

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `gid` int(8) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(25) NOT NULL,
  `leader_id` varchar(8) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`gid`, `group_name`, `leader_id`) VALUES
(1, 'hello', '09388312'),
(2, 'ufo', '09388337'),
(3, 'php', '09388337'),
(4, 'php', '09388337'),
(5, 'php', '09388337'),
(6, 'mei', '09388337');

-- --------------------------------------------------------

--
-- 表的结构 `group_user`
--

CREATE TABLE IF NOT EXISTS `group_user` (
  `gid` int(8) NOT NULL,
  `uid` varchar(8) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `group_user`
--

INSERT INTO `group_user` (`gid`, `uid`) VALUES
(1, '09388337'),
(2, '09388333'),
(1, '09388345');

-- --------------------------------------------------------

--
-- 表的结构 `homework`
--

CREATE TABLE IF NOT EXISTS `homework` (
  `hid` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `author` varchar(25) CHARACTER SET utf8 NOT NULL,
  `create_time` date NOT NULL,
  `edit_time` date NOT NULL,
  `deadline` date NOT NULL,
  `content` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `homework`
--

INSERT INTO `homework` (`hid`, `title`, `author`, `create_time`, `edit_time`, `deadline`, `content`) VALUES
(1, 'h1', 'ly', '2012-06-06', '2012-06-08', '2012-06-21', 'once again!'),
(2, 'h1', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', 'deadline'),
(3, 'h2', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '123'),
(4, 'h2', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '123'),
(5, 'h2', 'ly', '2012-06-07', '2012-06-08', '2012-12-21', 'dfg\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\ndfgsdfgs'),
(6, 'h2', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '123'),
(7, 'h2', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '123'),
(8, 'h2', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '123'),
(9, '会', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '213'),
(10, '会', 'ly', '2012-06-07', '2012-06-07', '2012-12-21', '213'),
(11, '\\(^o^)/~', 'ly', '2012-06-07', '2012-06-07', '0000-00-00', '345'),
(12, 'WER', 'ly', '2012-06-07', '2012-06-07', '2012-06-10', 'WER'),
(37, 'h10', 'ly', '2012-06-08', '2012-06-08', '2011-12-21', 'test deadline'),
(38, 'projects', 'ly', '2012-06-08', '2012-06-08', '2012-12-12', 'No projects!!!!!!!'),
(39, 'deadline', 'ly', '2012-06-08', '2012-06-08', '2012-06-07', 'deadline is coming!'),
(40, '\\(^o^)/~', 'ly', '2012-06-09', '2012-06-09', '2011-12-21', '士大夫撒个');

-- --------------------------------------------------------

--
-- 表的结构 `hw_user`
--

CREATE TABLE IF NOT EXISTS `hw_user` (
  `hid` int(8) NOT NULL,
  `uid` varchar(8) CHARACTER SET utf8 NOT NULL,
  `src` varchar(50) DEFAULT NULL,
  `grade` int(3) DEFAULT NULL,
  `group_rank` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `hw_user`
--

INSERT INTO `hw_user` (`hid`, `uid`, `src`, `grade`, `group_rank`) VALUES
(12, '09388337', 'homework_upload/12/12_09388337.jpg', 99, 0),
(11, '09388337', 'homework_upload/11/11_09388337.jpg', NULL, 0),
(6, '09388337', 'homework_upload/6/6_09388337.jpg', NULL, 0),
(3, '09388337', 'homework_upload/3/3_09388337.jpg', NULL, 0),
(1, '09388337', 'homework_upload/1/1_09388337.jpg', NULL, 0),
(39, '09388337', 'homework_upload/39/39_09388337.txt', NULL, 3),
(39, '09388333', 'homework_upload/39/39_09388333.css', NULL, 1),
(39, '09388345', 'homework_upload/39/39_09388345.txt', NULL, 2);

-- --------------------------------------------------------

--
-- 表的结构 `lockgroup`
--

CREATE TABLE IF NOT EXISTS `lockgroup` (
  `is_lock` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `lockgroup`
--

INSERT INTO `lockgroup` (`is_lock`) VALUES
(0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` varchar(8) CHARACTER SET utf8mb4 NOT NULL,
  `user_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `password` varchar(8) CHARACTER SET utf8mb4 NOT NULL,
  `role` varchar(25) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `user_name`, `password`, `role`) VALUES
('09388312', 'ly', '09388312', 'ta'),
('09388313', '杨帆', '09388313', 'ta'),
('09388333', '0abc', '09388333', 'student'),
('09388335', '嘉靖', '09388335', 'teacher'),
('09388337', 'jh', '09388337', 'student'),
('09388345', 'test', '09388345', 'student'),
('34t', '345', '34t', 'student');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
