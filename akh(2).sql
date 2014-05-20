-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2014 at 10:01 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `akh`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE IF NOT EXISTS `aplikasi` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `created` int(10) NOT NULL,
  `modified` int(10) NOT NULL,
  `tasks` varchar(200) NOT NULL,
  `result` varchar(200) NOT NULL,
  `option` mediumint(8) NOT NULL,
  `modul` enum('admin','seller','buyer') NOT NULL,
  `gambar_id` mediumint(8) DEFAULT NULL,
  `user_id` mediumint(8) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option` (`option`),
  KEY `gambar_id` (`gambar_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `created`, `modified`, `tasks`, `result`, `option`, `modul`, `gambar_id`, `user_id`) VALUES
(2, 131313, 131313, '313131', '3131313', 2, 'seller', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `banksoal`
--

CREATE TABLE IF NOT EXISTS `banksoal` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `soal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `banksoal`
--


-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE IF NOT EXISTS `gambar` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `ket` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id`, `ket`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'unregistered'),
(3, 'staff', 'karyawan'),
(4, 'it', 'Admin sistem'),
(5, 'bos', 'Manager/ Direktur ');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `banksoal_id` mediumint(8) NOT NULL,
  `option` char(1) NOT NULL,
  `ket` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banksoal_id` (`banksoal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jawaban`
--


-- --------------------------------------------------------

--
-- Table structure for table `jawaban_user`
--

CREATE TABLE IF NOT EXISTS `jawaban_user` (
  `id` mediumint(8) NOT NULL,
  `banksoal_id` mediumint(8) NOT NULL,
  `kuisoner_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `banksoal_id` (`banksoal_id`),
  KEY `kuisoner_id` (`kuisoner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `kuisoner`
--

CREATE TABLE IF NOT EXISTS `kuisoner` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `ket` varchar(255) NOT NULL,
  `created` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kuisoner`
--

INSERT INTO `kuisoner` (`id`, `ket`, `created`) VALUES
(1, 'Sifat', 11111111);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `lang` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `title`, `text`, `lang`) VALUES
(1, 'title english', 'Content English', 'en'),
(2, 'title french', 'content french', 'fr'),
(3, 'title id', 'content of id', 'id');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `uat`
--

CREATE TABLE IF NOT EXISTS `uat` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `nama_test` varchar(255) DEFAULT NULL,
  `langkah_test` text,
  `kriteria_hasil` text,
  `refferensi` text NOT NULL,
  `status` mediumint(8) NOT NULL COMMENT 'menentukan warna',
  `user_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `uat`
--

INSERT INTO `uat` (`id`, `created`, `modified`, `nama_test`, `langkah_test`, `kriteria_hasil`, `refferensi`, `status`, `user_id`) VALUES
(1, 11111111, 11111111, 'Menambah data user/ admin', '1. User mengklik menu admin\n2. User mengklik tambah data', 'kriteria', 'refrensi', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1393386814, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '127.0.0.1', 'endang', '175fadd0aca32dc34f946d1dfaea4576d6fae5f1', NULL, 'endang@gmail.com', NULL, NULL, NULL, NULL, 1391696439, 1391696493, 1, 'endangs', 'soekamti', 'admin', '08989018913'),
(3, '127.0.0.1', 'ersa', 'de332d34e1fa5ab5e5a5dd7bddd74aa28d75c917', NULL, 'ersa@gmail.com', NULL, NULL, NULL, NULL, 1391696866, 1391696886, 1, 'ersa', 'soekamti', 'buyer', '08989018913'),
(4, '127.0.0.1', 'desta', 'f45e0c5f0b35a4a2184774f9beafc8e6aa135e5b', NULL, 'desta.08b@gmail.com', NULL, NULL, NULL, NULL, 1391696972, 1393401699, 1, 'desta', 'fadilah', 'dokumentasi', '083898973731'),
(5, '127.0.0.1', 'moey', 'c2afd930508fc4c046f9c6fcf527ffb00c2eed68', NULL, 'moey@gmail.com', NULL, NULL, NULL, NULL, 1391697034, 1391697034, 1, 'moey', 'soekamti', 'seller', '08989018913'),
(6, '127.0.0.1', 'brian', '10ecb7cfa609747d50c36571757d1ca3d9b299c2', NULL, 'brian@gmail.com', NULL, NULL, NULL, NULL, 1391697064, 1391697064, 1, 'brian', 'soekamti', 'it support', '08989018913');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(3, 2, 3),
(4, 3, 3),
(5, 4, 3),
(6, 5, 3),
(7, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `warna`
--

CREATE TABLE IF NOT EXISTS `warna` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `warna` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `warna`
--

INSERT INTO `warna` (`id`, `warna`, `code`, `ket`) VALUES
(1, 'hijau', '#00FF00', 'FINISH'),
(2, 'kuning', '#FFFF00', 'PROGRESS'),
(3, 'merah', '#FF0000', 'PENDING');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD CONSTRAINT `aplikasi_ibfk_1` FOREIGN KEY (`option`) REFERENCES `warna` (`id`),
  ADD CONSTRAINT `aplikasi_ibfk_2` FOREIGN KEY (`gambar_id`) REFERENCES `gambar` (`id`),
  ADD CONSTRAINT `aplikasi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`banksoal_id`) REFERENCES `banksoal` (`id`);

--
-- Constraints for table `jawaban_user`
--
ALTER TABLE `jawaban_user`
  ADD CONSTRAINT `jawaban_user_ibfk_1` FOREIGN KEY (`banksoal_id`) REFERENCES `banksoal` (`id`),
  ADD CONSTRAINT `jawaban_user_ibfk_2` FOREIGN KEY (`kuisoner_id`) REFERENCES `kuisoner` (`id`);

--
-- Constraints for table `uat`
--
ALTER TABLE `uat`
  ADD CONSTRAINT `uat_ibfk_1` FOREIGN KEY (`status`) REFERENCES `warna` (`id`),
  ADD CONSTRAINT `uat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
