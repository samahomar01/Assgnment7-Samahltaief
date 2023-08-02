-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 05:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense trackeer`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `category_id` int(50) NOT NULL,
  `category_name` char(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `budjet` varchar(10) NOT NULL,
  `date_created` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`category_id`, `category_name`, `user_id`, `budjet`, `date_created`) VALUES
(1, 'Housing expenses', 2, '54', '4/6/6666'),
(5, 'Health expenses', 2, '34', '4/6/6666'),
(6, 'Personal care expenses', 2, '77', '4/6/6666'),
(56, 'Housing expenses', 3, '53', '4/6/6666'),
(61, 'food', 3, '95', '4/6/6666'),
(112, 'Housing expenses', 1, '100', '2023-07-08'),
(113, 'food', 1, '50', '2023-07-08'),
(115, 'Housing expenses', 4, '50', '2023-07-19'),
(116, 'food', 4, '67', '2023-07-09'),
(117, 'Clothing expenses', 1, '159', '2023-07-09'),
(118, 'Housing expenses', 34, '100', '2023-07-09'),
(143, 'food', 9, '200', '4/6/6666'),
(144, 'Clothing expenses', 9, '200', '4/6/6666'),
(145, 'may', 9, '300', '4/6/6666'),
(148, 'Clothing expenses', 3, '243', '2023-07-22'),
(151, 'Housing expenses', 35, '15', '2023-07-23'),
(152, 'Clothing expenses', 35, '1026', '2023-07-23'),
(153, 'food', 35, '2067', '2023-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `ex_table`
--

CREATE TABLE `ex_table` (
  `ex_id` int(11) NOT NULL,
  `expense_amount` varchar(11) NOT NULL,
  `note` text NOT NULL,
  `payment_method` varchar(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `expense_name` varchar(100) NOT NULL,
  `category_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ex_table`
--

INSERT INTO `ex_table` (`ex_id`, `expense_amount`, `note`, `payment_method`, `date`, `expense_name`, `category_id`) VALUES
(21, '8', '0', '0', '0', 'خبزة', 143),
(23, '1', '0', '0', '0', 'خبزة', 143),
(38, '77', 'لا توجد فاتورة', 'cash', '2023-07-20', 'خبزة', 118),
(40, '2', 'لا توجد فاتورة', 'cash', '2023-07-20', 'water', 118),
(41, '2', 'لا توجد فاتورة', 'cash', '2023-07-20', 'water', 118),
(42, '2', 'لا توجد فاتورة', 'cash', '2023-07-20', 'water', 118),
(53, '15', 'no', 'cash', '2023-07-21', 'water', 112),
(61, '5', 'no', 'cash', '2023-07-22', 'water', 56),
(62, '50', 'no', 'cash', '2023-07-22', 'jumpsut', 148),
(63, '5', 'no', 'cash', '2023-07-23', 'water', 56),
(64, '5', 'no', 'cash', '2023-07-23', 'water', 56),
(65, '5', 'no', 'cash', '2023-07-23', 'water', 61),
(66, '3', 'no', 'cash', '2023-07-23', 'jumpsut', 148),
(67, '5', 'no', 'cash', '2023-07-23', 'water', 56),
(68, '4', 'no', 'cash', '2023-07-23', 'jumpsut', 148),
(69, '5', 'no', 'cash', '2023-07-23', 'water', 56),
(70, '5', 'markit', 'cash', '2023-07-23', 'jumpsut', 56),
(71, '200', 'NO', 'Cash', '2023-07-23', 'water', 151),
(72, '100', 'no', 'Cash', '2023-07-23', 'Electricity', 151),
(73, '31', 'no', 'Cash', '2023-07-23', 'water', 151),
(76, '6', 'no', 'cash', '2023-07-23', 'water', 56),
(77, '6', 'no', 'cash', '2023-07-23', 'water', 56),
(79, '49', 'no', 'Cash', '2023-07-28', 'water', 151);

-- --------------------------------------------------------

--
-- Table structure for table `invoice__image`
--

CREATE TABLE `invoice__image` (
  `invoice_image` int(20) NOT NULL,
  `user_id` int(10) NOT NULL,
  `image_date` varchar(10) NOT NULL,
  `url` varchar(100) NOT NULL,
  `size_kb` double NOT NULL,
  `physical_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice__image`
--

INSERT INTO `invoice__image` (`invoice_image`, `user_id`, `image_date`, `url`, `size_kb`, `physical_path`) VALUES
(7, 1, '30/5/2023', 'https://harmash.com/uploaded/photos/6546842.PNG', 1234, 'uploaded/photos/6546842.PNG'),
(8, 2, '20/5/2023', 'https://harmash.com/uploaded/photos/5324654.PNG', 1567, 'uploaded/photos/5324654.PNG'),
(9, 3, '16/5/2023', '	https://harmash.com/uploaded/photos/5878942.PNG', 1245, 'uploaded/photos/5878942.PNG'),
(10, 5, '8/5/2023', 'https://harmash.com/uploaded/photos/8789354.PNG', 1245, '	uploaded/photos/8789354.PNG'),
(11, 8, '30/5/2023', 'https://harmash.com/uploaded/photos/8789354.PNG', 1245, '	uploaded/photos/4578515.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `Payment_method` int(10) NOT NULL,
  `categroy_name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`Payment_method`, `categroy_name`) VALUES
(1, 'Cash'),
(2, 'Credit'),
(3, 'Mobile Payments'),
(4, 'Checks');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating`, `comment`, `user_id`) VALUES
(2, 5, 'ممتاز', 35),
(4, 5, 'تطبيق رائع', 34),
(5, 4, 'good', 35);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_table`
--

CREATE TABLE `sub_category_table` (
  `sub_cat_id` int(20) NOT NULL,
  `categroy_id` int(50) NOT NULL,
  `sub_cat_name` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category_table`
--

INSERT INTO `sub_category_table` (`sub_cat_id`, `categroy_id`, `sub_cat_name`) VALUES
(1, 1, 'electricity'),
(2, 1, 'water'),
(3, 1, ' gas'),
(4, 4, ' Costs for travel'),
(5, 4, 'games'),
(6, 5, 'Gym Memberships'),
(7, 5, 'Medical Bills'),
(8, 5, 'Wellness Services');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfers_id` int(100) NOT NULL,
  `transfer_amount` int(100) NOT NULL,
  `from_cat` int(100) NOT NULL,
  `to_cat` int(100) NOT NULL,
  `comment` text NOT NULL,
  `date_transfer` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`transfers_id`, `transfer_amount`, `from_cat`, `to_cat`, `comment`, `date_transfer`) VALUES
(25, 50, 153, 151, 'شراء مايكوريف', '2023-08-02'),
(26, 12, 151, 152, 'شراء قبعة', '2023-08-02'),
(27, 50, 151, 153, 'زردة من الاصدقاء', '2023-08-02'),
(28, 12, 152, 151, 'hat', '2023-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `user_id` int(10) NOT NULL,
  `user_name` char(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `phone_number` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`user_id`, `user_name`, `password`, `phone_number`) VALUES
(1, 'FAYROUZ', 'sa098', 912222222),
(2, 'FAYROUZ', 'saaa1', 913333333),
(3, 'samah', 'mo01', 914444444),
(4, 'FAYROUZ', 'om68', 915555555),
(5, 'haifa', 'ha73', 916666666),
(6, 'hisham', 'password123', 95555555),
(7, 'ahmed', 'password7896', 98888888),
(8, 'ali', 'password789', 910078917),
(9, 'fay', 'fay4321', 91234323),
(12, 'mohamedddd', '12!@asdfghjKA', 1234567890),
(14, 'omaimalyyy', '12!@asdfghjKA', 1234567890),
(16, 'noiqunoiqu', '12!@asdfghjKA', 1234567890),
(18, 'samahhhuuuu', '12!@asdfghjKA', 925458230),
(21, 'mohamedddd', '12!@asdfghjKA', 925458230),
(27, 'samahhhuuuu', '12!@asdfghjKA', 925458230),
(28, 'samahhhuuuu', '12!@asdfghjKA', 1234567895),
(29, 'hamzahamza', '12!@asdfghjKA', 1234567890),
(30, 'qwertyuiop', '12!@asdfghjKA', 910078917),
(31, 'osamaosama', '12!@asdfghjKA', 910078917),
(32, 'fayroozzzz', '12!@asdfghjKA', 876654322),
(33, 'samahhhuuuu', '12!@asdfghjKA', 925458230),
(34, 'noor', '12!@asdfghjKA', 910078917),
(35, 'Samah Omar Ltaief', '12!@asdfghjKA', 910078917);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ex_table`
--
ALTER TABLE `ex_table`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `payment_method` (`payment_method`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `invoice__image`
--
ALTER TABLE `invoice__image`
  ADD PRIMARY KEY (`invoice_image`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`Payment_method`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sub_category_table`
--
ALTER TABLE `sub_category_table`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `categroy_id` (`categroy_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfers_id`),
  ADD KEY `from_cat` (`from_cat`),
  ADD KEY `to_cat` (`to_cat`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `category_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `ex_table`
--
ALTER TABLE `ex_table`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `invoice__image`
--
ALTER TABLE `invoice__image`
  MODIFY `invoice_image` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `Payment_method` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_category_table`
--
ALTER TABLE `sub_category_table`
  MODIFY `sub_cat_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfers_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`);

--
-- Constraints for table `ex_table`
--
ALTER TABLE `ex_table`
  ADD CONSTRAINT `ex_table_ibfk_4` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`category_id`);

--
-- Constraints for table `invoice__image`
--
ALTER TABLE `invoice__image`
  ADD CONSTRAINT `invoice__image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_table` (`user_id`);

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`from_cat`) REFERENCES `expense_categories` (`category_id`),
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`to_cat`) REFERENCES `expense_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
