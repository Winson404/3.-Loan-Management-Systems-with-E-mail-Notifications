-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 06:25 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `loan_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`emp_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Admin , 2=Employer, 3=Staff'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `dob`, `age`, `address`, `email`, `contact`, `password`, `image`, `date_registered`, `user_type`) VALUES
(1, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-04-06', 23, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'admin@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', 'sample3.jpg', '2022-04-17', 1),
(7, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-04-21', 432, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12fds@gmail.com', '35', '202cb962ac59075b964b07152d234b70', 'sample4.jpg', '2022-04-17', 4),
(10, 'Erwinewin', 'Cabag', 'Son', '', 'Male', '2022-04-07', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'admin@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', 'Screenshot (11).png', '2022-04-17', 2),
(11, '123', 'Cabag', 'Son', '', 'Female', '2022-04-21', 23, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12123@gmail.com', '2543', '21232f297a57a5a743894a0e4a801fc3', 'logo.png', '2022-04-18', 3),
(12, 'Erwinqwe', 'Cabag', 'Son', '', 'Male', '2022-04-07', 532543, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin1fsdfdsfs2@gmail.com', '5252', '0cc175b9c0f1b6a831c399e269772661', 'Screenshot (111).png', '2022-04-18', 3),
(15, 'Gordon', 'Lebron', 'James', '', 'Female', '2022-04-07', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwsdasadain12@gmail.com', '13442', '21232f297a57a5a743894a0e4a801fc3', 'sample3.jpg', '2022-04-19', 3),
(17, 'Mika', 'Mae', 'Rivera', '', 'Male', '2022-04-01', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'qqq@gmail.com', '3254', '4124bc0a9335c27f086f24ba207a4912', 'user.png', '2022-04-23', 3),
(18, 'John', 'Albert', 'Hero', '32', 'Male', '2022-04-13', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwinddd12@gmail.com', '09359428963', '1aabac6d068eef6a7bad3fdf50a05cc8', 'Screenshot (1).png', '2022-04-24', 3),
(19, 'Alan', 'Hill', 'Trillanes', 'sd', 'Male', '2022-04-27', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwinss12@gmail.com', '09359428963', '3691308f2a4c2f6983f2880d32e29c84', 'Screenshot (1).png', '2022-04-24', 3),
(20, 'Wade', 'Anthony', 'Pacman', '', 'Female', '2022-04-14', 12, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwinfsdfsd12@gmail.com', '09359428963', '202cb962ac59075b964b07152d234b70', 'Untitled-1.png', '2022-04-26', 3);

-- --------------------------------------------------------

--
-- Table structure for table `loan_list`
--

CREATE TABLE IF NOT EXISTS `loan_list` (
`loan_list_Id` int(30) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `loan_type_name` varchar(255) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `terms_of_loan` varchar(100) NOT NULL,
  `total_amount_to_pay` varchar(255) NOT NULL,
  `monthly_payable_amount` varchar(255) NOT NULL,
  `monthly_overdue_penalty` varchar(255) NOT NULL,
  `interest_rate` varchar(100) NOT NULL,
  `plan_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= pending, 1= approved, 2=released, 3=denied, 4=cancelled, 5=fully paid\r\n',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `loan_list`
--

INSERT INTO `loan_list` (`loan_list_Id`, `ref_no`, `loan_type_name`, `borrower_id`, `purpose`, `amount`, `terms_of_loan`, `total_amount_to_pay`, `monthly_payable_amount`, `monthly_overdue_penalty`, `interest_rate`, `plan_id`, `status`, `date_released`, `date_created`) VALUES
(72, '638f18947dd7f', 'Regular Loan', 39, 'Test 123', 20000, '12', '21300.00', '1775.00', '2400.00', '1300.00', 0, 5, '2022-12-06 00:00:00', '2022-12-06 18:36:34');

-- --------------------------------------------------------

--
-- Table structure for table `loan_plans`
--

CREATE TABLE IF NOT EXISTS `loan_plans` (
`plan_Id` int(11) NOT NULL,
  `plan` varchar(255) NOT NULL COMMENT 'months',
  `interest` varchar(255) NOT NULL COMMENT '%',
  `monthly_penalty` varchar(255) NOT NULL COMMENT '%'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `loan_plans`
--

INSERT INTO `loan_plans` (`plan_Id`, `plan`, `interest`, `monthly_penalty`) VALUES
(2, '3', '1', '1'),
(4, '12', '3', '3'),
(5, '5', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE IF NOT EXISTS `loan_types` (
`loan_Id` int(11) NOT NULL,
  `loan_image` varchar(255) NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `loan_description` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`loan_Id`, `loan_image`, `loan_name`, `loan_description`) VALUES
(13, '6207ad7e34af5.jpg', 'Regular Loan', 'Regular Loan Description'),
(14, 'Copy of Copy of Copy of Copy of 6 tips kung paano magkakaroon ng disinfection sa cell phones (1).png', 'Calamity Loan', 'Calamity Loan Description'),
(15, 'download.png', 'Medical Loan', 'Medical Loan Description'),
(16, '1.jpg', 'Grocery Loan', 'Grocery Loan Description'),
(17, 'images.jpg', 'Appliance Loan', 'Appliance Loan Description'),
(18, '570-5702622_stunning-free-loan-for-home-improvement-handyman-service.png', 'House Improvement Loan', 'House Improvement Loan Description'),
(19, '91806710-weight-of-capital.jpg', 'Share Capital', 'Share Capital Description'),
(20, 'loan-medical-emergency.png', 'Emer. Loan', 'Emer. Loan Description'),
(21, 'Education-Loan.jpg', 'Educational Loan', 'Educational Loan Description'),
(22, 'unnamed.png', 'Spec. Loan', 'Spec. Loan Description'),
(23, 'zavron_laptop_loan_uhsua6.jpg', 'Laptop Loan', 'Laptop Loan Description');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`payment_Id` int(11) NOT NULL,
  `borrower_Id` int(11) NOT NULL,
  `paid_amount` varchar(255) NOT NULL,
  `paid_date` date NOT NULL,
  `next_paid_date` date NOT NULL,
  `balance` int(11) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'ON'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_Id`, `borrower_Id`, `paid_amount`, `paid_date`, `next_paid_date`, `balance`, `payment_status`) VALUES
(99, 39, '5000', '2022-12-06', '2023-01-06', 16300, 'OFF'),
(100, 39, '', '0000-00-00', '0000-00-00', 21300, 'OFF'),
(101, 39, '5000', '2022-12-06', '2023-01-06', 16300, 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_Id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_registered` date NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `vkey` varchar(255) NOT NULL,
  `users_status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0=Approved, 1=Blocked'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_Id`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `dob`, `age`, `address`, `email`, `contact`, `password`, `image`, `date_registered`, `verified`, `vkey`, `users_status`) VALUES
(39, 'Erwin', 'Cabag', 'Son', 'Son', 'Male', '2022-05-11', 12, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'gerico26garalde@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', '6207ad7e34af5.jpg', '2022-05-26', 1, '628f94ec2f72b', '0'),
(41, 'Erwin', 'Cabag', 'Son', '', 'Male', '1994-02-09', 432, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin1fd2@gmail.com', '09359428963', '338d811d532553557ca33be45b6bde55', 'ali-pazani-9uaNYCqjDLw-unsplash.jpg', '2022-06-01', 0, '629704a36707a', '0'),
(42, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-06-14', 12, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'tatakmedellin@gmail.com', '09359428963', 'fca812f055d5fdcd3a355b63ceaad991', 'Screenshot (158).png', '2022-06-17', 0, '62abfeaeb3964', '0'),
(43, 'Erwin', 'Cabag', 'Son', '', 'Female', '2022-06-07', 43, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'tatakmedellin@gmail.com', '09359428963', '21232f297a57a5a743894a0e4a801fc3', 'Screenshot (158).png', '2022-06-17', 1, '62abff43d5002', '0'),
(44, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-06-22', 34, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12gdgf@gmail.com', '09359428963', 'fca812f055d5fdcd3a355b63ceaad991', 'Screenshot (158).png', '2022-06-17', 1, '62ac014b224e1', '1'),
(45, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-06-22', 32, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwinsg12@gmail.com', '09359428963', 'fca812f055d5fdcd3a355b63ceaad991', '4297150.jpg', '2022-06-17', 0, '62ac1460057dd', '2'),
(46, 'Erwin', 'Cabag', 'Son', '', 'Male', '2022-10-06', 23, 'Purok San Isidro, Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12ss@gmail.com', '09359428963', '3691308f2a4c2f6983f2880d32e29c84', 'art-hauntington-jzY0KRJopEI-unsplash.jpg', '2022-09-10', 0, '631c118ae3fb7', '0'),
(47, 'fdsfsd', 'fdsfsdf', 'sdfsdf', '', 'Male', '2022-12-15', 3, 'Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'Norldsadasngelig16@gmail.com', '09238893827', 'd57f21e6a273781dbf8b7657940f3b03', '318436618_525331266319539_8936511950738475752_n.jpg', '2022-12-11', 0, '6395640480744', '0'),
(48, 'gfd', 'gfd', 'gfd', '', 'Male', '2022-12-08', 23, 'Sitio Upper Landing, Daanlungsod, Medellin, Cebu', 'sonerwin12@gmail.com', '09238893827', 'b330cf2425c6ac1561c63f825e680a53', '318436618_525331266319539_8936511950738475752_n.jpg', '2022-12-11', 1, '63956439075ed', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`emp_Id`);

--
-- Indexes for table `loan_list`
--
ALTER TABLE `loan_list`
 ADD PRIMARY KEY (`loan_list_Id`);

--
-- Indexes for table `loan_plans`
--
ALTER TABLE `loan_plans`
 ADD PRIMARY KEY (`plan_Id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
 ADD PRIMARY KEY (`loan_Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`payment_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `emp_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `loan_list`
--
ALTER TABLE `loan_list`
MODIFY `loan_list_Id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `loan_plans`
--
ALTER TABLE `loan_plans`
MODIFY `plan_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
MODIFY `loan_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `payment_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
