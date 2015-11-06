-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2014 at 05:51 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dating`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatgroups`
--

CREATE TABLE IF NOT EXISTS `chatgroups` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group1Id` int(10) NOT NULL,
  `group2Id` int(10) NOT NULL,
  `icon_link` varchar(250) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `chatgroups`
--

INSERT INTO `chatgroups` (`id`, `group1Id`, `group2Id`, `icon_link`, `status`) VALUES
(4, 12, 16, 'upload/04928_2009_Lamborghini_Gallardo-1920x1080.jpg', 'online');

-- --------------------------------------------------------

--
-- Table structure for table `chatrequests`
--

CREATE TABLE IF NOT EXISTS `chatrequests` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `sentById` int(6) NOT NULL,
  `sentToGroupId` int(6) NOT NULL,
  `sentToUserId` int(6) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `chatrequests`
--

INSERT INTO `chatrequests` (`id`, `type`, `sentById`, `sentToGroupId`, `sentToUserId`, `status`) VALUES
(4, 'chat', 12, 16, 4, 'accepted'),
(5, 'chat', 12, 16, 6, 'accepted'),
(6, 'chat', 12, 16, 7, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `daterequests`
--

CREATE TABLE IF NOT EXISTS `daterequests` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `shopId` int(6) NOT NULL,
  `sentById` int(6) NOT NULL,
  `sentToGroupId` int(6) NOT NULL,
  `sentToUserId` int(6) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `daterequests`
--

INSERT INTO `daterequests` (`id`, `type`, `shopId`, `sentById`, `sentToGroupId`, `sentToUserId`, `status`, `date`) VALUES
(1, 'date', 1, 12, 14, 2, 'successful', '0000-00-00'),
(2, 'date', 1, 12, 14, 1, 'accepted', '0000-00-00'),
(3, 'date', 1, 12, 14, 6, 'accepted', '0000-00-00'),
(4, 'date', 3, 12, 14, 2, 'pending', '0000-00-00'),
(5, 'date', 3, 12, 14, 1, 'pending', '0000-00-00'),
(6, 'date', 3, 12, 14, 6, 'pending', '0000-00-00'),
(7, 'date', 3, 12, 16, 4, 'pending', '2014-08-12'),
(8, 'date', 3, 12, 16, 6, 'pending', '2014-08-12'),
(9, 'date', 3, 12, 16, 7, 'pending', '2014-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `adminId` int(10) NOT NULL,
  `per2Id` int(10) NOT NULL,
  `per3Id` int(10) NOT NULL,
  `icon_link` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `caption`, `adminId`, `per2Id`, `per3Id`, `icon_link`, `status`) VALUES
(12, 'testgroup', '...', 1, 2, 6, 'upload/04915_BMW_X5_2010-1920x1080.jpg', 'online'),
(13, 'testgroup2', 'ng', 1, 2, 5, 'upload/default.jpg', 'pending'),
(14, 'testgroup1', 'ng', 2, 1, 6, 'upload/default.jpg', 'online'),
(15, 'testgroup3', 'testing', 1, 6, 4, 'upload/default.jpg', 'online'),
(16, 'testgroup5', 'testing', 4, 6, 7, 'upload/default.jpg', 'online'),
(17, 'sfd', 'xg', 1, 5, 8, 'upload/default.jpg', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `typeId` int(10) NOT NULL,
  `imageName` varchar(100) NOT NULL,
  `imageType` text NOT NULL,
  `imageLocation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `type`, `typeId`, `imageName`, `imageType`, `imageLocation`) VALUES
(1, '', 0, 'Emma-Watson-Actress-Celebrity-Model-Wallpaper-100.jpg', 'image/jpeg', 'upload/Emma-Watson-Actress-Celebrity-Model-Wallpaper-100.jpg'),
(2, '', 0, 'Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861301.jpg', 'image/jpeg', 'upload/Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861301.jpg'),
(3, '', 0, 'Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861444.jpg', 'image/jpeg', 'upload/Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861444.jpg'),
(4, '0', 12, '04895_Mercedes-Benz_Classe_E_2010-1920x1080.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x1080.jpg'),
(5, 'group', 12, '04915_BMW_X5_2010-1920x1080.jpg', 'image/jpeg', 'upload/04915_BMW_X5_2010-1920x1080.jpg'),
(6, 'chatGroup', 4, '04928_2009_Lamborghini_Gallardo-1920x1080.jpg', 'image/jpeg', 'upload/04928_2009_Lamborghini_Gallardo-1920x1080.jpg'),
(7, 'shop', 6, '04895_Mercedes-Benz_Classe_E_2010-1920x10801407003984.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x10801407003984.jpg'),
(8, 'shop', 7, '04895_Mercedes-Benz_Classe_E_2010-1920x10801407004008.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x10801407004008.jpg'),
(9, 'shop', 8, '04895_Mercedes-Benz_Classe_E_2010-1920x10801407004022.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x10801407004022.jpg'),
(10, 'shop', 9, '04895_Mercedes-Benz_Classe_E_2010-1920x10801407004035.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x10801407004035.jpg'),
(11, 'shop', 10, '04895_Mercedes-Benz_Classe_E_2010-1920x108014070039841407004150.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x108014070039841407004150.jpg'),
(12, 'shop', 11, '04895_Mercedes-Benz_Classe_E_2010-1920x108014070039841407004229.jpg', 'image/jpeg', 'upload/04895_Mercedes-Benz_Classe_E_2010-1920x108014070039841407004229.jpg'),
(13, 'verification', 1, 'Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861444.jpg', 'image/jpeg', 'IdPics/Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861444.jpg'),
(14, 'user', 2, '04928_2009_Lamborghini_Gallardo-1920x10801407047882.jpg', 'image/jpeg', 'upload/04928_2009_Lamborghini_Gallardo-1920x10801407047882.jpg'),
(15, 'user', 2, '04928_2009_Lamborghini_Gallardo-1920x10801407047909.jpg', 'image/jpeg', 'upload/04928_2009_Lamborghini_Gallardo-1920x10801407047909.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sentById` int(6) NOT NULL,
  `sentToId` int(6) NOT NULL,
  `sentByUserId` int(6) NOT NULL,
  `icon_link` varchar(250) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sentById`, `sentToId`, `sentByUserId`, `icon_link`, `message`, `date_time`, `ip_address`) VALUES
(27, 12, 16, 1, 'default', 'as', '2014-08-02 10:20:33', '127.0.0.1'),
(28, 12, 16, 1, 'default', 'asa', '2014-08-02 11:06:35', '127.0.0.1'),
(29, 12, 16, 1, 'default', 'asq', '2014-08-02 11:56:11', '127.0.0.1'),
(30, 12, 16, 1, 'default', 'asqq', '2014-08-02 11:56:17', '127.0.0.1'),
(31, 12, 16, 1, 'default', 'asqq', '2014-08-02 12:03:19', '127.0.0.1'),
(32, 12, 16, 1, 'default', 'asdq', '2014-08-02 12:03:24', '127.0.0.1'),
(33, 12, 16, 1, 'default', 'aq', '2014-08-02 12:04:04', '127.0.0.1'),
(34, 12, 16, 4, 'default', 'as', '2014-08-02 16:10:01', '127.0.0.1'),
(35, 12, 16, 6, 'default', 'asd', '2014-08-02 16:10:07', '127.0.0.1'),
(36, 12, 16, 1, 'default', 'fs', '2014-08-06 16:04:12', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `question` varchar(50) NOT NULL,
  `answer` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `userId`, `question`, `answer`) VALUES
(1, 0, 'asd?', 'null'),
(2, 0, 'how was your life?', 'null'),
(3, 1, 'asd?', 'nope'),
(4, 1, 'how was your life?', 'yoo');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `sentById` int(6) NOT NULL,
  `sentToId` int(6) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `type`, `sentById`, `sentToId`, `status`) VALUES
(14, 'accept', 12, 2, 'accepted'),
(15, 'accept', 12, 6, 'accepted'),
(16, 'accept', 13, 2, 'accepted'),
(17, 'accept', 13, 5, 'declined'),
(18, 'accept', 14, 1, 'accepted'),
(19, 'accept', 14, 6, 'accepted'),
(20, 'accept', 15, 6, 'accepted'),
(21, 'accept', 15, 4, 'accepted'),
(22, 'accept', 16, 6, 'accepted'),
(23, 'accept', 16, 7, 'accepted'),
(24, 'accept', 17, 5, 'pending'),
(25, 'accept', 17, 8, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `icon_link` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `address`, `icon_link`) VALUES
(1, 'dominos', 'chennai', ''),
(2, 'pizzaHut', 'chennai', ''),
(3, 'pizzacorner', 'chennai', 'upload/default.jpg'),
(8, 'pizzahut1', 'chennai', 'upload/default.jpg'),
(9, 'pizzacorner', 'chennai', 'upload/default.jpg'),
(10, 'testbirthday', 'chennai', 'upload/default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `college` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `icon_link` varchar(250) NOT NULL,
  `aboutMe` text NOT NULL,
  `id_link` varchar(250) NOT NULL,
  `verification` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `birthday`, `age`, `gender`, `college`, `password`, `phone`, `email`, `icon_link`, `aboutMe`, `id_link`, `verification`) VALUES
(1, 'genuser', '8/3/1999', 15, 'male', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112561', 'testuser1@gmail.com', 'upload/default.jpg', 'ntg', 'IdPics/Emma-Watson-Actress-Celebrity-Model-Wallpaper-1001406861444.jpg', 'verified'),
(2, 'testedUser', '5/5/1989', 25, 'male', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.kUUPjL.czY1ZQY6U6l416gxqhb4qKSe', '8999923455', 'testuser2@gmail.com', 'upload/04928_2009_Lamborghini_Gallardo-1920x10801407047909.jpg', 'ntg', '', 'verified'),
(3, 'realuser', '3/10/1984', 30, 'male', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112563', 'testuser3@gmail.com', 'upload/default.jpg', 'ntg', '', ''),
(4, 'fakeuser', '12/16/1997', 17, 'female', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112564', 'testuser4@gmail.com', 'upload/default.jpg', 'ntg', '', ''),
(5, 'testtestuser', '12/11/1994', 20, 'female', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112565', 'testuser5@gmail.com', 'upload/default.jpg', 'ntg', '', ''),
(6, 'testrealuser', '11/17/1996', 18, 'female', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112566', 'testuser6@gmail.com', 'upload/default.jpg', 'ntg', '', ''),
(7, 'testbirthday', '6/28/1998', 16, 'female', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112569', 'testuser7@gmail.com', 'upload/default.jpg', 'ntg', '', ''),
(8, 'testimage', '8/31/1994', 19, 'female', 'IITM', '$2a$10$aPL1ci6zeH54c0deV2jsd.n0/kaeka5pHIUN4TUV1lmlYqoLN/rZ.', '9884112568', 'testuser9@gmail.com', 'upload/default.jpg', 'i don''t know much', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
