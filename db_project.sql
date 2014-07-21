-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2014 at 12:40 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE IF NOT EXISTS `account_tbl` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `debit` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0= inactive; 1=active; 13 = delete',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`id`, `sale_id`, `product_id`, `debit`, `credit`, `balance`, `status`) VALUES
(1, 1, 1, '115000', '125000', '10000', 1),
(2, 2, 7, '135000', '150000', '15000', 1),
(3, 3, 7, '315000', '350000', '35000', 1),
(4, 4, 10, '102000', '105000', '3000', 1),
(5, 5, 4, '85000', '90000', '5000', 1),
(6, 6, 8, '585000', '616500', '31500', 1),
(7, 7, 2, '90000', '96000', '6000', 1),
(8, 8, 10, '51000', '52500', '1500', 1),
(9, 9, 8, '26000', '27400', '1400', 1),
(10, 10, 4, '68000', '72000', '4000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `serial` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `last_action_date` datetime NOT NULL,
  `last_action_user` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=inactive, 1=active, 13=delete',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `serial`, `image`, `last_action_date`, `last_action_user`, `status`) VALUES
(1, 0, 'Mobile', 5, '', '2012-11-02 23:48:30', 7, 1),
(2, 1, 'Nokia', 5, '', '2012-11-02 23:51:27', 7, 1),
(3, 1, 'Samsung', 10, '', '2012-11-02 23:51:43', 7, 1),
(4, 1, 'Sony Ericson', 15, 'border.png', '2012-11-02 23:52:06', 7, 1),
(6, 1, 'Samphony', 20, '', '2013-07-26 22:06:21', 7, 1),
(11, 2, 'ASA - 100', 5, '', '2013-07-25 22:10:03', 7, 13);

-- --------------------------------------------------------

--
-- Table structure for table `customer_information`
--

CREATE TABLE IF NOT EXISTS `customer_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `cus_address` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customer_information`
--

INSERT INTO `customer_information` (`id`, `sale_id`, `cus_name`, `cus_email`, `contact_no`, `cus_address`) VALUES
(1, 1, 'Md. Fahad Hossain', 'fahad@gmail.com', '01908796547', 'Nayabazar, Dhaka -1000'),
(2, 2, 'Md. Alim Dar', 'alim@gmail.com', '01908796547', 'Mirpur, Dhaka - 1300'),
(3, 3, 'Md. Amiul Islam', 'aminu090@gmail.com', '987000000', 'Banani Dhaka.'),
(4, 4, 'Md. Salim Ullah', 'asmil@yahoo.com', '99999999', 'Savar, Dhaka'),
(5, 5, 'Aeon Khan', 'aeon@live.com', '8898089080', 'Gulsan- 1, Dhaka'),
(6, 6, 'Syed Ahmed', 'syed@gmail.com', '01908796547', 'Palton, Dhaka'),
(7, 7, 'Shajib Hasan', 'david@hasan.me', '01908796547', 'Nevada, USA'),
(8, 8, 'Habibul Hoque', 'habib@yahoo.com', '01718990078', 'Lion Lane, Patuatiloy, Naranyanjong, Bangladesh'),
(9, 9, 'Moinul Khan', 'moniul@gmail.com', '01890879008', 'Banani, Dhaka'),
(10, 10, 'Md kamruzzaman', 'kamruzzaman@yahoo.com', '01915771331', 'Mirpur -12, Dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `customer_support`
--

CREATE TABLE IF NOT EXISTS `customer_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `problem` longtext NOT NULL,
  `eng_id` int(11) NOT NULL,
  `eng_comments` text NOT NULL,
  `return_date` date NOT NULL,
  `total_amount` decimal(14,2) NOT NULL,
  `last_action_date` datetime NOT NULL,
  `last_action_user` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=inactive, 1=active, 13=delete',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer_support`
--

INSERT INTO `customer_support` (`id`, `customer_id`, `invoice_id`, `cus_name`, `cus_email`, `cus_address`, `contact_no`, `problem`, `eng_id`, `eng_comments`, `return_date`, `total_amount`, `last_action_date`, `last_action_user`, `status`) VALUES
(1, 6, '140302AA1', 'Syed Ahmed', 'syed@gmail.com', 'Palton, Dhaka', '01908796547', 'Another problem found', 20, 'a', '2014-03-02', 500.00, '2014-03-03 07:30:58', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_info`
--

CREATE TABLE IF NOT EXISTS `module_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `module_info`
--

INSERT INTO `module_info` (`id`, `name`) VALUES
(2, 'Category'),
(3, 'Product'),
(4, 'Sale Product'),
(5, 'Customer Support'),
(20, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `serial` int(11) NOT NULL,
  `ime_no` varchar(12) NOT NULL,
  `model_no` varchar(12) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `made` varchar(15) NOT NULL,
  `price` varchar(255) NOT NULL,
  `price_buy` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `in_stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `publish_date` date NOT NULL,
  `last_action_date` datetime NOT NULL,
  `last_action_user` int(11) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0= inactive; 1=active; 13 = delete',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `cid`, `scid`, `name`, `serial`, `ime_no`, `model_no`, `made`, `price`, `price_buy`, `quantity`, `in_stock`, `image`, `details`, `publish_date`, `last_action_date`, `last_action_user`, `status`) VALUES
(1, 1, 2, 'Nokia N8', 509876, '098765435-11', 'N-8', 'USA', '25000', '23000', 100, 95, 'controls3.png', '<p>\n	Nokia N8</p>\n', '2012-11-20', '2013-08-30 11:49:38', 7, 1),
(2, 1, 2, 'N95', 134987, '2342342342', 'N95', 'India', '32000', '30000', 100, 94, 'adust_logo.png', '<p>\n	Details about N95 added later.</p>\n', '2012-11-23', '2013-08-30 04:55:10', 7, 1),
(3, 1, 3, 'Sam- T 100', 567898, '0987678U8', 'S- T 100', 'BD', '17500', '17000', 500, 500, '', '<p>\n	Details about ST-100 added later.</p>\n', '2012-11-23', '2013-08-30 11:45:48', 7, 1),
(4, 1, 3, 'SAM- 100', 124587, '098765435-11', 'W987145', 'Brasil', '18000', '17000', 100, 91, '', '<p>\n	dummy</p>\n', '2012-11-30', '2013-12-27 03:43:52', 7, 1),
(6, 1, 2, 'ASA 300', 987657, '998879U89', 'A-300', 'China', '6000', '5000', 10, 10, '', '<p>\n	Details about ASA 300 will added later.</p>\n', '2012-11-30', '2013-08-30 11:47:27', 7, 1),
(7, 1, 2, 'Nokia - Lumia G4', 879765, '876578909', 'Lumia G4', 'Bangladesh', '50000', '45000', 100, 90, '', '<p>\n	details added later.</p>\n', '2012-11-30', '2013-08-30 11:53:38', 7, 1),
(8, 1, 4, 'Sony E-09', 879464, '098765435-11', 'E - 09', 'USA', '13700', '13000', 5000, 4951, '', '<p>\n	Dummy text</p>\n', '2012-12-28', '2014-01-03 04:23:10', 7, 1),
(9, 1, 6, 'Samphony 100', 98765456, '987654', '100', 'China', '13000', '12000', 100, 100, '', '<p>\n	ZxZx</p>\n', '2013-07-26', '2013-08-30 11:48:03', 7, 1),
(10, 1, 2, 'C3 - 100', 134987, '0987678U8', 'C3 - 100', 'Brasil', '17500', '17000', 300, 291, '', '<p>\n	Details will be add later.</p>\n', '2013-07-26', '2013-12-05 10:33:51', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_sale`
--

CREATE TABLE IF NOT EXISTS `product_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `scid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_id` varchar(14) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `quantity` int(5) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `sale_date` date NOT NULL,
  `warranty_start` date NOT NULL,
  `warranty_end` date NOT NULL,
  `last_action_date` datetime NOT NULL,
  `last_action_user` int(2) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1=Active, 0=Inactive, 13=Delete;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product_sale`
--

INSERT INTO `product_sale` (`id`, `cid`, `scid`, `product_id`, `invoice_id`, `product_price`, `quantity`, `total_amount`, `sale_date`, `warranty_start`, `warranty_end`, `last_action_date`, `last_action_user`, `status`) VALUES
(1, 1, 2, 1, '130830AA1', '25000', 5, '125000', '2013-08-30', '2013-08-30', '2013-11-30', '2013-08-30 11:49:38', 7, 1),
(2, 1, 2, 7, '130830AA2', '50000', 3, '150000', '2013-08-20', '2013-08-30', '2014-07-31', '2013-08-30 04:55:10', 7, 1),
(3, 1, 2, 7, '130830AA3', '50000', 7, '350000', '2013-08-22', '2013-08-30', '2014-03-13', '2013-08-30 11:53:38', 7, 1),
(4, 1, 2, 10, '130830AA4', '17500', 6, '105000', '2013-08-23', '2013-08-30', '2014-06-14', '2013-08-30 11:55:19', 7, 1),
(5, 1, 3, 4, '130830AA5', '18000', 5, '90000', '2013-08-30', '2013-08-30', '0000-00-00', '2013-08-30 11:57:47', 7, 1),
(6, 1, 4, 8, '130830AA6', '13700', 45, '616500', '2013-08-24', '2013-08-30', '2013-10-10', '2013-08-30 12:06:20', 7, 1),
(7, 1, 2, 2, '130830AA7', '32000', 3, '96000', '2013-08-18', '2013-08-30', '2013-12-28', '2013-08-30 04:39:03', 7, 1),
(8, 1, 2, 10, '131205AA8', '17500', 3, '52500', '2013-12-05', '2013-12-05', '2015-06-05', '2013-12-05 10:33:51', 7, 1),
(9, 1, 4, 8, '140103AA9', '13700', 2, '27400', '2013-12-05', '2013-12-05', '2014-12-05', '2014-01-03 04:23:10', 7, 1),
(10, 1, 3, 4, '140518AA10', '18000', 4, '72000', '2013-12-27', '2013-12-27', '2014-08-30', '2014-05-18 11:15:51', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `login_id` varchar(96) NOT NULL,
  `password` varchar(96) NOT NULL,
  `type` int(1) NOT NULL,
  `last_login_date` datetime NOT NULL,
  `last_login_ip` varchar(255) NOT NULL,
  `user_status` int(1) NOT NULL COMMENT '1=power / super user; 2 = normal user',
  `status` int(11) NOT NULL COMMENT '0= inactive; 1=active; 13 = delete',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `login_id`, `password`, `type`, `last_login_date`, `last_login_ip`, `user_status`, `status`) VALUES
(7, 'admin', 'admin', '46f86faa6bbf9ac94a7e459509a20ed0', 1, '2014-05-18 10:57:29', '127.0.0.1', 1, 1),
(14, 'Sharif Ul islam', 'sharif', '585a097e7ec1f2ba93c7d066d6f7fc5e', 2, '2013-06-07 05:36:56', '127.0.0.1', 2, 1),
(15, 'Aminul Islam', 'aminul', 'd41d8cd98f00b204e9800998ecf8427e', 1, '2013-06-06 23:01:25', '127.0.0.1', 1, 1),
(16, 'Travid Jones', 'travid', '8f4a10e1c07f99d8e6159ec3429cfc75', 3, '2014-03-02 05:25:04', '', 2, 1),
(17, 'Nahid Mahmood', 'nahid', '53c8f03f8cd8947ab96c056a8dd69fab', 2, '2013-12-27 03:51:13', '127.0.0.1', 2, 1),
(18, 'Andru Rasel', 'rasel', 'd515518a1715bae5fbfc59d2458de532', 2, '2013-06-06 22:27:38', '', 2, 1),
(19, 'Rabeo Juan', 'rabeo', '2a58d069b8f275f0955489245fefbf84', 2, '2013-06-06 22:28:12', '', 2, 1),
(20, 'David Cournally', 'david', '', 2, '2014-05-18 23:09:23', '192.168.1.121', 2, 1),
(21, 'thhhhh', 'david', 'a3aca2964e72000eea4c56cb341002a4', 1, '2013-08-26 23:47:23', '', 2, 13),
(22, 'thhhhh', 'david', 'a3aca2964e72000eea4c56cb341002a4', 1, '2013-08-26 23:47:36', '', 2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_privileges`
--

CREATE TABLE IF NOT EXISTS `user_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `user_privileges`
--

INSERT INTO `user_privileges` (`id`, `user_id`, `module_id`) VALUES
(34, 13, 8),
(33, 13, 7),
(32, 13, 6),
(31, 13, 5),
(30, 13, 4),
(29, 13, 3),
(28, 13, 2),
(27, 13, 1),
(94, 16, 4),
(87, 14, 5),
(86, 7, 20),
(89, 22, 2),
(85, 15, 2),
(90, 17, 5),
(77, 18, 5),
(78, 19, 5),
(96, 20, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
