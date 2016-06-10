-- phpMyAdmin SQL Dump
-- version 4.2.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2015 at 09:48 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oqolat`
--

-- --------------------------------------------------------

--
-- Table structure for table `acct_managers`
--

CREATE TABLE IF NOT EXISTS `acct_managers` (
`acct_manager_id` int(11) NOT NULL,
  `acct_manager` varchar(150) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acct_managers`
--

INSERT INTO `acct_managers` (`acct_manager_id`, `acct_manager`, `create_time`) VALUES
(1, 'mangr1', '2015-01-19 09:29:02'),
(20, 'mngr2', '2015-01-22 10:01:56'),
(21, 'mngr3', '2015-01-22 10:02:01'),
(23, '**/@__', '2015-01-22 10:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
`campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(150) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`campaign_id`, `campaign_name`, `create_time`) VALUES
(1, 'Capetown Campaign', '2015-01-16 09:31:22'),
(6, 'John''sburg Campaign', '2015-01-22 12:39:02'),
(7, 'Bryanston Campaign', '2015-01-22 12:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
`client_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `physical_address_1` varchar(150) DEFAULT NULL,
  `physical_address_2` varchar(150) DEFAULT NULL,
  `physical_address_3` varchar(150) DEFAULT NULL,
  `post_address_1` varchar(150) DEFAULT NULL,
  `post_address_2` varchar(150) DEFAULT NULL,
  `post_address_3` varchar(150) DEFAULT NULL,
  `pcode` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `client_status` int(11) NOT NULL,
  `client_type` int(11) NOT NULL,
  `client_discount` int(5) DEFAULT NULL,
  `product_id` int(150) DEFAULT NULL,
  `acct_manager` int(11) DEFAULT NULL,
  `campaign_id` int(150) DEFAULT NULL,
  `target_audience_id` varchar(150) DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `physical_address_1`, `physical_address_2`, `physical_address_3`, `post_address_1`, `post_address_2`, `post_address_3`, `pcode`, `phone`, `mobile`, `email`, `client_status`, `client_type`, `client_discount`, `product_id`, `acct_manager`, `campaign_id`, `target_audience_id`, `create_time`) VALUES
(13, 'dlp', '', '', '', '', '', '', '', '23425', '6345353', 'dd@mail.com', 1, 3, 100, 71, 20, 1, '1:3:10', '2015-03-09 09:06:30'),
(14, 'Deepa', 'j;k;l', '', '', '', '', '', '', '9812931931', '3242424', 'deepa@mail.com', 1, 154, 1221, 73, 1, 1, '3', '2015-03-11 13:40:22'),
(49, 'Dileep U Nar', 'Cherat(H)', 'Thrissur', 'India', 'Thalore(PO)', 'Kerala', '', '', '+919497802956', '+9104872351956', 'dileep.cherat@gmail.com', 1, 3, 1000, 71, 20, 1, '1:3:10:14', '2015-03-16 10:36:37'),
(71, 'Test client', '', '', '', '', '', '', '', '', '', 'test@mail.com', 2, 154, 0, 71, 21, 1, '3:10', '2015-03-11 14:18:39'),
(74, 'dlpnew', 'sdsf', 'sdfs', 'dfs', 'fsfs', 'fdsfs', 'fdsf', '4564', '454545', '454545', 'test@mail.com', 1, 3, 0, 71, 1, 1, NULL, '2015-03-12 15:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `client_status`
--

CREATE TABLE IF NOT EXISTS `client_status` (
`status_id` int(11) NOT NULL,
  `status_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_status`
--

INSERT INTO `client_status` (`status_id`, `status_name`) VALUES
(1, 'active'),
(2, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `client_type`
--

CREATE TABLE IF NOT EXISTS `client_type` (
`type_id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_type`
--

INSERT INTO `client_type` (`type_id`, `type_name`) VALUES
(1, 'Client'),
(2, 'Account'),
(3, 'Client Account'),
(154, 'dpa');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
`id` int(11) NOT NULL,
  `contract_no` varchar(45) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `order_no` varchar(150) DEFAULT NULL,
  `contact` varchar(150) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `client_discount` float DEFAULT NULL,
  `acct_discount` float DEFAULT NULL,
  `notes` text,
  `acct_manager` int(11) DEFAULT NULL,
  `posted` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `contract_no`, `status`, `client`, `account`, `order_no`, `contact`, `description`, `product`, `start`, `end`, `discount`, `client_discount`, `acct_discount`, `notes`, `acct_manager`, `posted`) VALUES
(149, '1149', 1, 14, NULL, '789', '', '', NULL, '2015-03-12 00:00:00', '2015-03-28 00:00:00', 78, NULL, 45, '', NULL, 0),
(150, '1150', 1, 13, 3, '', '', '', NULL, '1970-01-01 00:00:00', '1970-01-01 00:00:00', 0, NULL, 0, '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contract_lines`
--

CREATE TABLE IF NOT EXISTS `contract_lines` (
`id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `quantity` float NOT NULL,
  `line_total` float DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_lines`
--

INSERT INTO `contract_lines` (`id`, `contract_id`, `platform_id`, `type_id`, `start_time`, `end_time`, `description`, `duration`, `rate`, `quantity`, `line_total`, `create_time`) VALUES
(22, 149, 22, 6, '19:00:00', '23:00:00', '0', 0, 78, 100, 7800, '2015-03-12 10:27:02'),
(23, 150, 22, 5, '03:00:00', '19:00:00', '0', 0, 0, 0, 3500, '2015-04-23 15:20:34'),
(24, 149, 23, 6, '05:00:00', '09:00:00', '0', 0, 0, 0, 0, '2015-03-13 15:11:01'),
(25, 149, 22, 6, '08:00:00', '15:00:00', NULL, NULL, NULL, 0, 3200, '2015-04-22 12:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `contract_line_types`
--

CREATE TABLE IF NOT EXISTS `contract_line_types` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_line_types`
--

INSERT INTO `contract_line_types` (`id`, `name`, `description`) VALUES
(5, 'cntrctline1', 'cntrtlin1_description'),
(6, 'cntrtlin2', 'cntrtlin2_description'),
(9, 'cntrtlin3', 'cntrtlin3_description'),
(10, 'cntrtlin4', 'cntrtlin4_description');

-- --------------------------------------------------------

--
-- Table structure for table `contract_status`
--

CREATE TABLE IF NOT EXISTS `contract_status` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `proposal` varchar(150) NOT NULL,
  `submitted` varchar(150) NOT NULL,
  `contract` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract_status`
--

INSERT INTO `contract_status` (`id`, `name`, `description`, `proposal`, `submitted`, `contract`) VALUES
(1, 'Active', NULL, '', '', 0),
(2, 'Inactive', NULL, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dataTable_view`
--

CREATE TABLE IF NOT EXISTS `dataTable_view` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(250) DEFAULT NULL,
  `table_order` varchar(200) DEFAULT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dataTable_view`
--

INSERT INTO `dataTable_view` (`id`, `user_id`, `table_name`, `table_order`, `update_time`) VALUES
(2, 5, 'user_data', '6', '2015-02-12 10:28:42'),
(3, 5, 'client_data', '6', '2015-03-03 13:36:39'),
(6, 7, 'client_data', '7,8', '2015-01-14 13:54:44'),
(7, 5, 'contracts_data', '8,9,10', '2015-02-27 12:36:43'),
(8, 7, 'contracts_data', '1,8,9,10', '2015-02-16 09:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `graph`
--

CREATE TABLE IF NOT EXISTS `graph` (
`id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graph`
--

INSERT INTO `graph` (`id`, `month`, `year`) VALUES
(20, 4, 2015);

-- --------------------------------------------------------

--
-- Table structure for table `password_change`
--

CREATE TABLE IF NOT EXISTS `password_change` (
`id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `activation_id` varchar(500) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_change`
--

INSERT INTO `password_change` (`id`, `email`, `activation_id`, `time`) VALUES
(7, 'bivindamodharn@yahoo.in', 'fbJNh68qY2ZJKmgd', '2015-05-12 14:52:21'),
(11, 'vivekmanghat@gmail.com', 'PRDejkoAVj2oLNZZ', '2015-05-13 09:25:38'),
(12, 'vivek.s@vanillanetworks.com', 'QGaaNQCmIULrXSOq', '2015-05-13 09:27:29'),
(25, 'vivek.dovecor@gmail.com', 'tO5y1h0b7MhB3WFj', '2015-05-14 14:42:31');

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
`id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`id`, `name`, `description`) VALUES
(22, 'pfm1', 'pfm1description'),
(23, 'pfm2', 'pfm2 description'),
(24, 'pfm3', 'pfm3ds'),
(25, 'pfm4', 'pfm4des'),
(29, 'New', 'Test Platform');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`product_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `create_time`) VALUES
(71, 'pdct2', '2015-01-20 14:34:02'),
(72, 'pdct3', '2015-01-20 14:34:07'),
(73, 'pdct4', '2015-01-20 14:34:13'),
(75, 'pdct5', '2015-01-20 16:12:49'),
(84, '*****/fsdss_', '2015-01-21 10:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `radio_stations`
--

CREATE TABLE IF NOT EXISTS `radio_stations` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `radio_stations`
--

INSERT INTO `radio_stations` (`id`, `name`, `url`, `status`) VALUES
(1, '5FM', 'http://archive.audiostore.co.za/5FM', '1'),
(2, '702', 'http://archive.audiostore.co.za/702', '1'),
(3, '947', 'http://archive.audiostore.co.za/947', '1'),
(4, 'ALG', 'http://archive.audiostore.co.za/ALG', '1'),
(5, 'ECR', 'http://archive.audiostore.co.za/ECR', '1'),
(6, 'GHFM', 'http://archive.audiostore.co.za/GHFM', '1'),
(7, 'JAC', 'http://archive.audiostore.co.za/JAC', '1'),
(8, 'JOZIFM', 'http://archive.audiostore.co.za/JOZIFM', '1'),
(9, 'KAYAFM', 'http://archive.audiostore.co.za/KAYAFM', '1'),
(10, 'LOTUS', 'http://archive.audiostore.co.za/LOTUS', '1'),
(11, 'METRO', 'http://archive.audiostore.co.za/METRO', '1'),
(12, 'RSG', 'http://archive.audiostore.co.za/RSG', '1'),
(13, 'SAFM', 'http://archive.audiostore.co.za/SAFM', '1'),
(14, 'UKHOZI', 'http://archive.audiostore.co.za/UKHOZI', '1'),
(15, 'UMHLOBO', 'http://archive.audiostore.co.za/UMHLOBO', '1'),
(16, 'YFM', 'http://archive.audiostore.co.za/YFM', '1'),
(17, 'LESEDI', 'http://archive.audiostore.co.za/LESEDI', '1'),
(18, 'MOTSWEDING', 'http://archive.audiostore.co.za/MOTSWEDING', '1'),
(19, 'THOBELA', 'http://archive.audiostore.co.za/THOBELA', '1'),
(20, 'IKWEKWEZI', 'http://archive.audiostore.co.za/IKWEKWEZI', '1'),
(21, 'LIGWALA', 'http://archive.audiostore.co.za/702', '1'),
(22, 'TUKSFM', 'http://archive.audiostore.co.za/TUKSFM', '1'),
(23, 'PUKFM', 'http://archive.audiostore.co.za/PUKFM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `radio_stations_subscribers`
--

CREATE TABLE IF NOT EXISTS `radio_stations_subscribers` (
`id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `radio_stations_subscribers`
--

INSERT INTO `radio_stations_subscribers` (`id`, `station_id`, `user_id`) VALUES
(17, 9, 9),
(18, 17, 9),
(21, 11, 7),
(22, 15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `target_audience`
--

CREATE TABLE IF NOT EXISTS `target_audience` (
`target_audience_id` int(11) NOT NULL,
  `target_audience` varchar(150) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `target_audience`
--

INSERT INTO `target_audience` (`target_audience_id`, `target_audience`, `create_time`) VALUES
(1, 'Kids', '2015-01-16 09:54:49'),
(3, 'Youngsters', '2015-01-16 09:55:06'),
(10, 'Adults', '2015-01-22 14:56:14'),
(14, 'Women', '2015-03-09 15:29:58'),
(15, 'Men', '2015-03-09 15:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fname` varchar(150) DEFAULT NULL,
  `lname` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `add1` varchar(150) DEFAULT NULL,
  `add2` varchar(150) DEFAULT NULL,
  `add3` varchar(150) DEFAULT NULL,
  `pcode` varchar(150) DEFAULT NULL,
  `users_company` int(11) DEFAULT NULL,
  `users_status` int(11) DEFAULT NULL,
  `users_role` int(11) NOT NULL,
  `tel_number` varchar(45) DEFAULT NULL,
  `mob_number` varchar(45) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `userTable_view` varchar(300) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fname`, `lname`, `email`, `password`, `add1`, `add2`, `add3`, `pcode`, `users_company`, `users_status`, `users_role`, `tel_number`, `mob_number`, `create_time`, `userTable_view`) VALUES
(5, 'dovecor', 'Frank', 'Shiltz', 'admin@dovecor.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Bryanston', 'South SA', 'South Africa', '234568412', 1, 1, 2, '+234545345', '9528742589', '2014-12-30 16:15:24', '4,5,6'),
(7, 'shaun', 'Shaun', 'dippnall', 'shaun@mail.com', '4173ef70a34785e0d27b066e457a2223', 'Melbourne', 'Melbourne', '23', '454', 1, 1, 5, '845', '+465456645', '2014-12-30 16:22:00', NULL),
(9, 'jimmy', 'Jimmy', 'James', 'jimmy@mail.com', 'c2fe677a63ffd5b7ffd8facbf327dad0', 'New Delhi', 'IInd street', 'Rajkhat', '9807621', 1, 1, 5, '032424', '2342342', '2015-01-14 10:36:24', NULL),
(10, 'regro', 'Regro', '', 'regro@mail.in', '1a1dc91c907325c69271ddf0c944bc72', '345353', '', '', '345353', 1, 1, 5, '', '4354353', '2015-02-18 11:37:23', NULL),
(15, 'vivek', NULL, NULL, 'vivek.dovecor@gmail.com', 'a9f855d73c241427179ce4a73ab315eb', NULL, NULL, NULL, NULL, NULL, 1, 4, NULL, NULL, '2015-05-05 16:17:05', NULL),
(16, 'bivindamodharn', NULL, NULL, 'bivindamodharn@yahoo.in', 'c1672fd237233e8a41efb8bb80cdcb56', NULL, NULL, NULL, NULL, NULL, 1, 4, NULL, NULL, '2015-05-05 16:22:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
`roles_id` int(11) NOT NULL,
  `roles_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`roles_id`, `roles_name`) VALUES
(1, 'Registered user(role allocation pending)'),
(2, 'Admin'),
(3, 'Sales'),
(4, 'Traffic'),
(5, 'Analytics'),
(13, 'dileepdeepadinesh');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE IF NOT EXISTS `user_status` (
`status_id` int(11) NOT NULL,
  `status_name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`status_id`, `status_name`) VALUES
(1, 'ON'),
(2, 'OFF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acct_managers`
--
ALTER TABLE `acct_managers`
 ADD PRIMARY KEY (`acct_manager_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
 ADD PRIMARY KEY (`campaign_id`), ADD KEY `campaign_name` (`campaign_name`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`client_id`), ADD KEY `client_status` (`client_status`), ADD KEY `client_type` (`client_type`), ADD KEY `account_manager` (`product_id`), ADD KEY `campaign_name` (`campaign_id`), ADD KEY `target_audience` (`target_audience_id`), ADD KEY `acct_manager` (`acct_manager`);

--
-- Indexes for table `client_status`
--
ALTER TABLE `client_status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `client_type`
--
ALTER TABLE `client_type`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `contract_no` (`contract_no`), ADD KEY `status` (`status`), ADD KEY `client` (`client`);

--
-- Indexes for table `contract_lines`
--
ALTER TABLE `contract_lines`
 ADD PRIMARY KEY (`id`), ADD KEY `type_id` (`type_id`), ADD KEY `platform_id` (`platform_id`), ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `contract_line_types`
--
ALTER TABLE `contract_line_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_status`
--
ALTER TABLE `contract_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dataTable_view`
--
ALTER TABLE `dataTable_view`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `graph`
--
ALTER TABLE `graph`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_change`
--
ALTER TABLE `password_change`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`product_id`), ADD KEY `product_name` (`product_name`);

--
-- Indexes for table `radio_stations`
--
ALTER TABLE `radio_stations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `radio_stations_subscribers`
--
ALTER TABLE `radio_stations_subscribers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `target_audience`
--
ALTER TABLE `target_audience`
 ADD PRIMARY KEY (`target_audience_id`), ADD KEY `target_audience` (`target_audience`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD KEY `users_users_status_idx` (`users_status`), ADD KEY `users_user_roles_idx` (`users_role`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
 ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
 ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acct_managers`
--
ALTER TABLE `acct_managers`
MODIFY `acct_manager_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `client_status`
--
ALTER TABLE `client_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_type`
--
ALTER TABLE `client_type`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `contract_lines`
--
ALTER TABLE `contract_lines`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `contract_line_types`
--
ALTER TABLE `contract_line_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `contract_status`
--
ALTER TABLE `contract_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dataTable_view`
--
ALTER TABLE `dataTable_view`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `graph`
--
ALTER TABLE `graph`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `password_change`
--
ALTER TABLE `password_change`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `radio_stations`
--
ALTER TABLE `radio_stations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `radio_stations_subscribers`
--
ALTER TABLE `radio_stations_subscribers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `target_audience`
--
ALTER TABLE `target_audience`
MODIFY `target_audience_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`client_status`) REFERENCES `client_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `clients_ibfk_10` FOREIGN KEY (`acct_manager`) REFERENCES `acct_managers` (`acct_manager_id`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `clients_ibfk_11` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`campaign_id`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `clients_ibfk_15` FOREIGN KEY (`client_type`) REFERENCES `client_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `clients_ibfk_9` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`status`) REFERENCES `contract_status` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `contracts_ibfk_3` FOREIGN KEY (`client`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contract_lines`
--
ALTER TABLE `contract_lines`
ADD CONSTRAINT `contract_lines_ibfk_2` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `contract_lines_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `contract_line_types` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
ADD CONSTRAINT `contract_lines_ibfk_5` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dataTable_view`
--
ALTER TABLE `dataTable_view`
ADD CONSTRAINT `dataTable_view_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`users_status`) REFERENCES `user_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`users_role`) REFERENCES `user_roles` (`roles_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
