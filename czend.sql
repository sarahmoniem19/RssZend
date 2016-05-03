-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2016 at 03:36 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `czend`
--

-- --------------------------------------------------------

--
-- Table structure for table `rss`
--

CREATE TABLE IF NOT EXISTS `rss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rss`
--

INSERT INTO `rss` (`id`, `name`, `description`, `url`, `created_at`, `modified_at`, `user_id`) VALUES
(2, 'sara', '1234', 'http://rss.cnn.com/rss/edition_meast.rss', '2016-05-02 13:30:06', '2016-04-30 12:44:17', 3),
(3, 'Youm7', 'hhhhhhhh', 'http://www.youm7.com/rss/SectionRss?SectionID=97', '2016-05-02 13:30:56', '2016-05-02 09:21:51', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `password_salt` varchar(32) DEFAULT NULL,
  `real_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `password_salt`, `real_name`) VALUES
(1, 'sarah', 'sara@gmail.com', '202cb962ac59075b964b07152d234b70', NULL, NULL),
(3, 'sara2', 'keep@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL),
(10, '', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rss`
--
ALTER TABLE `rss`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
