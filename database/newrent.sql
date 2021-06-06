-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 08:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newrent`
--

-- --------------------------------------------------------

--
-- Table structure for table `broker`
--

CREATE TABLE `broker` (
  `broker_id` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '0000000000',
  `pan_card_no` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `registration_no` varchar(12) NOT NULL,
  `profile_img` varchar(200) DEFAULT NULL,
  `role` varchar(6) NOT NULL,
  `status` enum('Active','Deactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `broker`
--

INSERT INTO `broker` (`broker_id`, `state`, `city`, `address`, `fullname`, `gender`, `username`, `email`, `mobile`, `pan_card_no`, `password`, `registration_no`, `profile_img`, `role`, `status`) VALUES
(3, 'Gujarat', 'Ahmedabad', 'Jai Hind Nagar Street no. 6 New Colony', 'Nishant Jain', 'Male', 'nishant27', 'nj27nishant@gmail.com', '9521681348', 'BRKPJ9087L', 'nishant27', 'AD2929292929', 'uploads\\profile\\broker6.jpg', 'broker', 'Active'),
(6, 'Rajasthan', 'Udaipur', 'DelhiGate', 'Jay Mehta', 'Male', 'Jay', 'Jay.mehta@gmaill.com', '9458796523', 'BROSK2321J', 'Jay@123', 'QW2384726347', 'uploads\\profile\\broker9.jpg', 'broker', 'Active'),
(7, 'Gujarat', 'Ahmedabad', 'Nehru Nagar', 'Nayshree Pachori', 'Female', 'Nayshree', 'nayshreepachori@gmail.com', '9954342345', 'BWRSH2347H', 'Nayshree@123', 'DS2345675432', 'uploads\\profile\\broker10.jpg', 'broker', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `cmps`
--

CREATE TABLE `cmps` (
  `name` varchar(20) NOT NULL,
  `cmp` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room_rental_registrations`
--

CREATE TABLE `room_rental_registrations` (
  `id` int(10) NOT NULL,
  `owner fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plot_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacant` enum('Yes','No','','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `broker_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_rental_registrations`
--

INSERT INTO `room_rental_registrations` (`id`, `owner fullname`, `owner mobile`, `owner email`, `state`, `city`, `landmark`, `rent`, `deposit`, `plot_number`, `room no`, `address`, `accommodation`, `description`, `image`, `vacant`, `created_at`, `updated_at`, `broker_id`) VALUES
(1, 'Mr. Rohan Gupta', '9743271826', 'Rohan.gupta@gmail.com', 'Gujarat', 'Ahmedabad', 'Navrangpura ', '100000', '10000', '101', '200', 'Infront of Bus stand', 'AC\r\nWiFi\r\nFridge', 'Nice Property', 'uploads\\tenament\\ten1.jpg', 'Yes', '2021-01-11 14:56:20', '2021-01-11 14:56:20', 3),
(2, 'Mr. Pradeep Jain', '9271782911', 'Pradeep.jain@gmail.com', 'Gujarat', 'Vadodara', 'Sayaji Baug', '50000', '1000', '302', '230', 'Infront of Sayaji Baug', 'WiFi\r\nLaundry\r\nAC', 'Must Visit Property', 'uploads\\tenament\\ten2.jpg', 'Yes', '2021-01-11 18:37:50', '2021-01-11 18:37:50', 7);

-- --------------------------------------------------------

--
-- Table structure for table `room_rental_registrations_apartment`
--

CREATE TABLE `room_rental_registrations_apartment` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plot_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_number_of_flat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room no` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacant` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `broker_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_rental_registrations_apartment`
--

INSERT INTO `room_rental_registrations_apartment` (`id`, `owner fullname`, `owner mobile`, `owner email`, `state`, `city`, `landmark`, `rent`, `deposit`, `plot_number`, `apartment_name`, `ap_number_of_flat`, `room no`, `floor`, `address`, `accommodation`, `description`, `image`, `vacant`, `created_at`, `updated_at`, `broker_id`) VALUES
(1, 'Mahesh Kumar', '9324132345', 'Mahesh.kumar@gmail.com', 'Gujarat', 'Ahmedabad', 'Dev Corporate', '200000', '20000', '402', 'Royal Apartment ', '4021', '221', '4', 'C G Road ', 'AC\r\nWiFi\r\nLaundry \r\nTelevision', 'Good Property', 'uploads\\apartment\\apartment1.jpg', 1, '2021-01-11 15:04:15', '2021-01-11 15:04:15', 3),
(6, 'Mahant Parikh', '8824385743', 'Mahant.Parikh@gmail.com', 'Rajasthan', 'Udaipur', 'JMB MIshthan Bhandar', '50000', '3500', '232', 'Jayant Apartment', '43', '220', '2', 'Delhi Gate', 'WiFi ', 'Well Furnished Property', 'uploads\\apartment\\apartment2.jpg', 1, '2021-01-11 19:01:04', '2021-01-11 19:01:04', 6);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Arunachal Pradesh'),
(3, 'Assam'),
(4, 'Bihar'),
(5, 'Chhattisgarh'),
(6, 'Goa'),
(7, 'Gujarat'),
(8, 'Haryana'),
(9, 'Himachal Pradesh'),
(10, 'Jharkhand'),
(11, 'Karnataka'),
(12, 'Kerala'),
(13, 'Madhya Pradesh'),
(14, 'Maharashtra'),
(15, 'Manipur'),
(16, 'Meghalaya'),
(17, 'Mizoram'),
(18, 'Nagaland'),
(19, 'Odisha'),
(20, 'Punjab'),
(21, 'Rajasthan'),
(22, 'Sikkim'),
(23, 'Tamil Nadu'),
(24, 'Telangana'),
(25, 'Tripura'),
(26, 'Uttar Pradesh'),
(27, 'Uttarakhand'),
(28, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `profile_img` varchar(200) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `state`, `city`, `address`, `fullname`, `gender`, `mobile`, `username`, `email`, `password`, `profile_img`, `role`, `status`) VALUES
(1, 'NULL', 'NULL', 'NULL', 'ADMIN', 'Male', '0000000000', 'Admin', 'Admin.BrokersBunch@gmail.com', 'Admin', 'uploads\\profile\\user2.jpg', 'admin', 'Active'),
(2, 'Rajasthan', 'Dungarpur', 'Jai Hind Nagar Street no. 6 New Colony', 'Nishant Jain', 'Male', '9784154632', 'nishant2000', 'nishant.nj4@gmail.co', 'nishant2000', 'uploads\\profile\\user3.jpg', 'user', 'Active'),
(8, 'Gujarat', 'Vadodara', 'Sayaji Baug', 'Raman', 'Male', '9778412345', 'Raman', 'Raman@gmail.com', 'Raman@123', 'uploads\\profile\\user7.jpg', 'user', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broker`
--
ALTER TABLE `broker`
  ADD PRIMARY KEY (`broker_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `room_rental_registrations`
--
ALTER TABLE `room_rental_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`owner email`),
  ADD KEY `broker_id` (`broker_id`),
  ADD KEY `broker_id_2` (`broker_id`);

--
-- Indexes for table `room_rental_registrations_apartment`
--
ALTER TABLE `room_rental_registrations_apartment`
  ADD UNIQUE KEY `email` (`owner email`),
  ADD KEY `broker_id` (`broker_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`),
  ADD UNIQUE KEY `state_name` (`state_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broker`
--
ALTER TABLE `broker`
  MODIFY `broker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
