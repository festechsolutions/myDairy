-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2021 at 07:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `milk-mgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `billno`
--

CREATE TABLE `billno` (
  `sno` int(11) NOT NULL,
  `subscriber_count` int(11) NOT NULL,
  `orders_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billno`
--

INSERT INTO `billno` (`sno`, `subscriber_count`, `orders_count`) VALUES
(1, 6, 89),
(2, 3, 13);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `active`) VALUES
(1, 'Milk', 1),
(2, 'Curd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'Milk Management', '30.00', '0', 'Chengicherla,Hyderabad', '234234235', 'India', '<b>Milk Management Portal</b>', 'INR');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Super Administrator', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createStore\";i:9;s:11:\"updateStore\";i:10;s:9:\"viewStore\";i:11;s:11:\"deleteStore\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:13:\"createProduct\";i:17;s:16:\"updateProProduct\";i:18;s:11:\"viewProduct\";i:19;s:13:\"deleteProduct\";i:20;s:18:\"createSubscription\";i:21;s:18:\"updateSubscription\";i:22;s:16:\"viewSubscription\";i:23;s:18:\"deleteSubscription\";i:24;s:11:\"createOrder\";i:25;s:11:\"updateOrder\";i:26;s:9:\"viewOrder\";i:27;s:11:\"deleteOrder\";i:28;s:14:\"createPayments\";i:29;s:14:\"updatePayments\";i:30;s:12:\"viewPayments\";i:31;s:14:\"deletePayments\";i:32;s:10:\"viewReport\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}'),
(2, 'Admin', 'a:25:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:11:\"createStore\";i:4;s:11:\"updateStore\";i:5;s:9:\"viewStore\";i:6;s:14:\"createCategory\";i:7;s:14:\"updateCategory\";i:8;s:12:\"viewCategory\";i:9;s:13:\"createProduct\";i:10;s:16:\"updateProProduct\";i:11;s:11:\"viewProduct\";i:12;s:18:\"createSubscription\";i:13;s:18:\"updateSubscription\";i:14;s:16:\"viewSubscription\";i:15;s:11:\"createOrder\";i:16;s:11:\"updateOrder\";i:17;s:9:\"viewOrder\";i:18;s:14:\"createPayments\";i:19;s:14:\"updatePayments\";i:20;s:12:\"viewPayments\";i:21;s:10:\"viewReport\";i:22;s:13:\"updateCompany\";i:23;s:11:\"viewProfile\";i:24;s:13:\"updateSetting\";}'),
(3, 'User', 'a:2:{i:0;s:11:\"viewProfile\";i:1;s:13:\"updateSetting\";}');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `paid_date` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `modified_datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `date`, `time`, `paid_date`, `net_amount`, `user_id`, `paid_status`, `store_id`, `modified_datetime`) VALUES
(1, 'VNKN-2021032067', '1616178600', '11:15:59am', NULL, '49.00', 6, 1, 1, '1616861683'),
(2, 'VNKN-2021032068', '1616178600', '11:16:00am', NULL, '26.00', 7, 1, 1, ''),
(3, 'VNKN-2021032069', '1616178600', '11:16:00am', NULL, '50.00', 8, 1, 1, '1616219160'),
(4, 'VNKN-2021032270', '1616351400', '10:40:35am', NULL, '26.00', 6, 1, 1, ''),
(5, 'VNKN-2021032271', '1616351400', '10:40:35am', NULL, '26.00', 7, 1, 1, ''),
(6, 'VNKN-2021032272', '1616351400', '10:40:36am', NULL, '50.00', 8, 1, 1, '1616389836'),
(7, 'PNDY-202103228', '1616351400', '10:40:38am', NULL, '376.00', 9, 1, 2, ''),
(11, 'PNDY-202103279', '1616783400', '11:02:17pm', NULL, '375.00', 9, 2, 2, ''),
(12, 'VNKN-2021032776', '1616783400', '11:03:16pm', NULL, '25.00', 6, 2, 1, ''),
(13, 'VNKN-2021032777', '1616783400', '11:05:02pm', NULL, '49.00', 8, 2, 1, '1616866502'),
(14, 'VNKN-2021041778', '1618597800', '12:38:53pm', NULL, '25.00', 6, 2, 1, ''),
(15, 'VNKN-2021041779', '1618597800', '12:38:53pm', NULL, '25.00', 7, 2, 1, ''),
(16, 'VNKN-2021041780', '1618597800', '12:38:54pm', NULL, '49.00', 8, 2, 1, '1618643334'),
(17, 'PNDY-2021041710', '1618597800', '12:39:44pm', NULL, '375.00', 9, 2, 2, ''),
(18, 'VNKN-2021041981', '1618770600', '10:26:04am', NULL, '25.00', 6, 2, 1, ''),
(19, 'VNKN-2021041982', '1618770600', '10:26:05am', NULL, '25.00', 7, 2, 1, ''),
(20, 'VNKN-2021041983', '1618770600', '10:26:05am', NULL, '49.00', 8, 2, 1, '1618808165'),
(21, 'PNDY-2021041911', '1618770600', '10:26:08am', NULL, '375.00', 9, 2, 2, ''),
(22, 'VNKN-2021042084', '1618857000', '09:34:03am', NULL, '73.00', 6, 2, 1, '1618891586'),
(23, 'VNKN-2021042085', '1618857000', '09:34:03am', NULL, '25.00', 7, 2, 1, ''),
(24, 'VNKN-2021042086', '1618857000', '09:34:03am', NULL, '49.00', 8, 2, 1, '1618891444'),
(25, 'PNDY-2021042012', '1618857000', '09:34:06am', NULL, '375.00', 9, 2, 2, ''),
(26, 'VNKN-2021050287', '1619893800', '02:47:19pm', NULL, '25.00', 6, 2, 1, ''),
(27, 'VNKN-2021050288', '1619893800', '02:47:20pm', NULL, '25.00', 7, 2, 1, ''),
(28, 'VNKN-2021050289', '1619893800', '02:47:20pm', NULL, '49.00', 8, 2, 1, '1619947040'),
(29, 'PNDY-2021050213', '1619893800', '02:47:23pm', NULL, '375.00', 9, 2, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `is_subscribed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `category_id`, `product_id`, `product_name`, `qty`, `amount`, `date`, `store_id`, `is_subscribed`) VALUES
(2, 2, 1, 2, 'Arokya Milk', '1', '25.00', '19-03-2021', 1, 1),
(3, 3, 1, 1, 'Vijaya Milk', '1', '24.00', '19-03-2021', 1, 1),
(4, 3, 1, 2, 'Arokya Milk', '1', '25.00', '19-03-2021', 1, 1),
(5, 4, 1, 2, 'Arokya Milk', '1', '25.00', '22-03-2021', 1, 1),
(6, 5, 1, 2, 'Arokya Milk', '1', '25.00', '22-03-2021', 1, 1),
(7, 6, 1, 2, 'Arokya Milk', '1', '25.00', '22-03-2021', 1, 1),
(8, 6, 1, 1, 'Vijaya Milk', '1', '24.00', '22-03-2021', 1, 1),
(9, 7, 1, 2, 'Arokya Milk', '15', '375.00', '22-03-2021', 2, 1),
(16, 11, 1, 2, 'Arokya Milk', '15', '375.00', '27-03-2021', 2, 1),
(17, 12, 1, 2, 'Arokya Milk', '1', '25.00', '27-03-2021', 1, 1),
(18, 13, 1, 2, 'Arokya Milk', '1', '25.00', '27-03-2021', 1, 1),
(19, 13, 1, 1, 'Vijaya Milk', '1', '24.00', '27-03-2021', 1, 1),
(20, 14, 1, 2, 'Arokya Milk', '1', '25.00', '17-04-2021', 1, 1),
(21, 15, 1, 2, 'Arokya Milk', '1', '25.00', '17-04-2021', 1, 1),
(22, 16, 1, 2, 'Arokya Milk', '1', '25.00', '17-04-2021', 1, 1),
(23, 16, 1, 1, 'Vijaya Milk', '1', '24.00', '17-04-2021', 1, 1),
(24, 17, 1, 2, 'Arokya Milk', '15', '375.00', '17-04-2021', 2, 1),
(25, 18, 1, 2, 'Arokya Milk', '1', '25.00', '19-04-2021', 1, 1),
(26, 19, 1, 2, 'Arokya Milk', '1', '25.00', '19-04-2021', 1, 1),
(27, 20, 1, 1, 'Vijaya Milk', '1', '24.00', '19-04-2021', 1, 1),
(28, 20, 1, 2, 'Arokya Milk', '1', '25.00', '19-04-2021', 1, 1),
(29, 21, 1, 2, 'Arokya Milk', '15', '375.00', '19-04-2021', 2, 1),
(30, 22, 1, 2, 'Arokya Milk', '1', '25.00', '20-04-2021', 1, 1),
(31, 23, 1, 2, 'Arokya Milk', '1', '25.00', '20-04-2021', 1, 1),
(32, 24, 1, 2, 'Arokya Milk', '1', '25.00', '20-04-2021', 1, 1),
(33, 24, 1, 1, 'Vijaya Milk', '1', '24.00', '20-04-2021', 1, 1),
(34, 25, 1, 2, 'Arokya Milk', '15', '375.00', '20-04-2021', 2, 1),
(35, 22, 1, 1, 'Vijaya Milk', '2', '48.00', '20-04-2021', 1, 0),
(36, 26, 1, 2, 'Arokya Milk', '1', '25.00', '02-05-2021', 1, 1),
(37, 27, 1, 2, 'Arokya Milk', '1', '25.00', '02-05-2021', 1, 1),
(38, 28, 1, 2, 'Arokya Milk', '1', '25.00', '02-05-2021', 1, 1),
(39, 28, 1, 1, 'Vijaya Milk', '1', '24.00', '02-05-2021', 1, 1),
(40, 29, 1, 2, 'Arokya Milk', '15', '375.00', '02-05-2021', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `payment_date` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_no`, `invoice_date`, `year`, `month`, `gross_amount`, `service_charge_value`, `net_amount`, `payment_date`, `payment_mode`, `user_id`, `store_id`, `payment_status`) VALUES
(1, '18202146', '02-05-2021', '2021', '4', '123.00', '30.00', '153.00', NULL, NULL, 6, 1, 2),
(2, '91202147', '02-05-2021', '2021', '4', '75.00', '30.00', '105.00', NULL, NULL, 7, 1, 2),
(3, '43202148', '02-05-2021', '2021', '4', '147.00', '30.00', '177.00', '02-05-2021', 'UPI/Money Transfer', 8, 1, 1),
(4, '90202149', '02-05-2021', '2021', '4', '1,125.00', '30.00', '1,155.00', '02-05-2021', 'Cash', 9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `active`) VALUES
(1, 1, 'Vijaya Milk', '24', 1),
(2, 1, 'Arokya Milk', '25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `type`, `code`, `active`) VALUES
(1, 'Venkatadhri Nagar', 1, 'VNKN', 1),
(2, 'Pandey Store', 2, 'PNDY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `subscribe_no` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `last_modified` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `subscribe_no`, `user_id`, `store_id`, `net_amount`, `last_modified`, `active`) VALUES
(1, 'VNKN/00001', 6, 1, '25.00', '11:02:48 17-02-2021', 1),
(4, 'VNKN/00004', 8, 1, '49.00', '10:02:11 20-02-2021', 1),
(5, 'PNDY/00001', 9, 2, '375.00', '12:03:22 11-03-2021', 1),
(9, 'VNKN/00006', 7, 1, '25.00', '08:03:04 15-03-2021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_items`
--

CREATE TABLE `subscribed_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribed_items`
--

INSERT INTO `subscribed_items` (`id`, `order_id`, `category_id`, `product_id`, `product_name`, `qty`, `amount`) VALUES
(1, 1, 1, 2, 'Arokya Milk', '1', '25.00'),
(21, 4, 1, 2, 'Arokya Milk', '1', '25.00'),
(22, 4, 1, 1, 'Vijaya Milk', '1', '24.00'),
(27, 5, 1, 2, 'Arokya Milk', '15', '375.00'),
(31, 9, 1, 2, 'Arokya Milk', '1', '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `subscribed` int(11) DEFAULT 2,
  `advance_amount` varchar(255) NOT NULL DEFAULT '0',
  `pending_amount` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `phone`, `address`, `store_id`, `subscribed`, `advance_amount`, `pending_amount`) VALUES
(1, 'admin', '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'Swakhil', 'M', '9848124934', '', 1, 2, '0', '0'),
(6, 'mswakhil_vkn', '$2y$10$i0xtu7LXsQi3RANrJBqfAeb8AxHftWxfPdjzuc7EZEs7PYY/HZgUS', 'Swakhil', 'Rao', '9876543246', '', 1, 1, '0', '0'),
(7, 'myamini_vkn', '$2y$10$NyqcfnrFMZKASDhPnCp8lO8UcJzv1hTE3ZvDDNow36/dloKFlBk.K', 'Yamini', '', '9876543257', '', 1, 1, '0', '0'),
(8, 'test_vkn', '$2y$10$HkUuptbnU.xwTLEJNhoi5.xfRE/LuuLfZTXjrb.bh/jYmKAClim.q', 'test', 'test', '9876543267', '', 1, 1, '0', '0'),
(9, 'mainuser', '$2y$10$UeyW3m08Oy4p6Ny4OzJbkelECM/ZiB.ba1G32C5kqZIGvgwA221iK', 'Main', 'user', '9876543246', '', 2, 1, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(13, 10, 3),
(14, 11, 3),
(15, 2, 3),
(16, 6, 3),
(17, 7, 3),
(18, 8, 3),
(19, 9, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billno`
--
ALTER TABLE `billno`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed_items`
--
ALTER TABLE `subscribed_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billno`
--
ALTER TABLE `billno`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subscribed_items`
--
ALTER TABLE `subscribed_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;