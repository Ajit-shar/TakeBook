-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `take_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Ajit Sharma', 'admin12@gmail.com', '$2y$10$H/6y4AAIYbLVluE8cR0AaeAo1QqjObKxrjeOPX44xfJV.aF.14d3m');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(2, 'Bachelor in Business Management'),
(1, 'Bachelor in Computer Application'),
(3, 'Bachelor of Science in Computer Science and Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `full_name`, `email`, `contact`, `address`, `password`) VALUES
(1, 'Ajit Sharma', 'ajitsharm1122@gmail.com', '9803530332', 'Kalanki, Kathmandu', '$2y$10$4KmxDviI2JZxNXHgajfw5eyBhxdk5SjEMUJ901N.iGypMhNXDvmN2'),
(2, 'Ajit Sharma', 'ajitsharma12@gmail.com', '9803530332', 'kalanki', '$2y$10$rrhN2c31Opo5hts2tNmTyuEb5L8VJ6tT8v/jbKx1bI3HECLi1iF0.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `Full_name` varchar(255) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(50) NOT NULL,
  `order_id` int(100) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `months` int(10) NOT NULL,
  `amount` double NOT NULL,
  `issued_date` date NOT NULL DEFAULT current_timestamp(),
  `return_till` date NOT NULL,
  `returned_date` date DEFAULT NULL,
  `return_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `semester_id` int(10) NOT NULL,
  `rent_price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `cat_id`, `semester_id`, `rent_price`, `image`, `stock`, `description`) VALUES
(1, 'Computer Fundamentals And Application', 1, 1, 100, 'IMG-20241006-WA0000[1].jpg', 4, 'Computer Fundamentals and Application is applicable for the students of BCA 1st semester.'),
(2, 'Mathematics II', 1, 2, 150, 'New_Doc_10-06-2024_13.39[1].jpg', 14, 'Mathematics II is applicable for the students of BCA 2nd semester.'),
(3, 'Society and Technology', 1, 1, 95, 'New_Doc_10-06-2024_13.39_(1)[1].jpg', 4, 'Society and Technology is applicable for the students of BCA 1st semester'),
(4, 'C Programming', 1, 2, 125, 'New_Doc_10-06-2024_13.39_(3)[1].jpg', 8, 'C Programming is applicable for the student of BCA 2nd semester.'),
(5, 'Microprocessor and Computer Architecture', 1, 2, 150, 'New_Doc_10-06-2024_13.39_(2)[1].jpg', 8, 'Microprocessor and Computer Architectre is applicable for student of BCA 2nd Semester.'),
(6, 'English II', 1, 2, 75, 'New_Doc_10-06-2024_13.39_(4)[1].jpg', 5, 'English II is applicable for student of BCA 2nd semester.'),
(7, 'Probability and Statistics', 1, 3, 175, 'New_Doc_10-06-2024_13.39_(5)[1].jpg', 12, 'Probability and Statistics is applicable for student of BCA 3rd Semester.'),
(8, 'Object Oriented Programming in JAVA', 1, 3, 125, '20240628_190904.jpg', 10, 'OOP in JAVA is applicable for students of BCA 3rd Semester.'),
(9, 'Data Structure and Algorithm', 1, 3, 125, 'New_Doc_10-06-2024_13.39_(7)[1].jpg', 10, 'Data structure and Algorithm is applicablefor the student of BCA 3rd semester.'),
(10, 'System Analysis and Design', 1, 3, 75, 'New_Doc_10-06-2024_13.39_(8)[1].jpg', 8, 'SAD is applicable for student of BCA 3rd semester.'),
(11, 'Web Technology', 1, 3, 100, 'New_Doc_10-06-2024_13.39_(11)[1].jpg', 15, 'Web Technology is applicable for student of BCA 3rd semester.'),
(12, 'Scripting Language', 1, 4, 125, 'New_Doc_10-06-2024_13.39_(9)[1].jpg', 15, 'Scripting Language is applicable for student of BCA 4th semester.'),
(13, 'Database Management System', 1, 4, 125, 'New_Doc_10-06-2024_13.39_(6)[1].jpg', 15, 'DBMS is applicable for student of BCA 4th Semester.'),
(14, 'Software Engineering', 1, 4, 75, 'New_Doc_10-06-2024_13.39_(10)[1].jpg', 8, 'Software Engineering is applicable for student of BCA 4th semester.'),
(15, 'Operating System', 1, 4, 125, '20240628_191048.jpg', 12, 'Operating System is applicable for BCA 4th Semester.'),
(16, 'Numerical Method', 1, 4, 150, 'New_Doc_10-06-2024_13.39_(12)[1].jpg', 15, 'Numerical Method is applicable for student of BCA 4th semester.'),
(17, 'Business Statistics', 2, 3, 125, 'photo_1_2024-06-30_07-44-48.jpg', 14, 'Business Statistics'),
(18, 'Cost Management Accounting', 2, 3, 120, 'photo_2_2024-06-30_07-44-48.jpg', 15, 'Cost Management Accounting'),
(19, 'Fundamental of Finance', 2, 3, 125, 'photo_3_2024-06-30_07-44-48.jpg', 8, 'Fundamental of Finance'),
(20, 'Business Communication', 2, 3, 150, 'photo_4_2024-06-30_07-44-48.jpg', 10, 'Business Communication'),
(21, 'Business Research Methods', 2, 4, 175, 'photo_2024-06-30_07-44-36.jpg', 15, 'Business Research Methods'),
(22, 'Taxation and Auditing', 2, 4, 75, 'photo_6_2024-06-30_07-44-19.jpg', 20, 'Taxation and Auditing'),
(23, 'Psychology', 2, 4, 175, 'photo_7_2024-06-30_07-44-19.jpg', 10, 'Psychology'),
(24, 'Legan Enviroment of Business in Nepal', 2, 4, 150, 'photo_3_2024-06-30_07-44-19.jpg', 15, 'Legan Enviroment of Business in Nepal'),
(25, 'Financial Management', 2, 4, 100, 'photo_4_2024-06-30_07-44-19.jpg', 12, 'Financial Management'),
(26, 'Fundamental of Marketing', 2, 5, 100, 'photo_9_2024-06-30_07-44-19.jpg', 11, 'Fundamental of Marketing'),
(27, 'Financial Markets and Services', 2, 5, 95, 'photo_8_2024-06-30_07-44-19.jpg', 22, 'Financial Markets and Services'),
(28, 'Operations Management', 2, 5, 175, 'photo_1_2024-06-30_07-44-19.jpg', 10, 'Operations Management'),
(29, 'Fundaments of Information Technology and Applications', 2, 5, 150, 'photo_5_2024-06-30_07-44-19.jpg', 20, 'Fundaments of Information Technology and Applications'),
(30, 'Banking Law and Regulations', 2, 5, 120, 'photo_2_2024-06-30_07-44-19.jpg', 15, 'Banking Law and Regulations');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`) VALUES
(1, 'First Semester'),
(2, 'Second Semester'),
(3, 'Third Semester'),
(4, 'Fourth Semester'),
(5, 'Fifth Semester'),
(6, 'Sixth Semester'),
(7, 'Seventh Semester'),
(8, 'Eigth Semester');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_orders` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_orderdetail` (`product_id`),
  ADD KEY `fk_order_orderdetail` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`cat_id`),
  ADD KEY `FK_semester_product` (`semester_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_orderdetail` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_product_orderdetail` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_semester_product` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`),
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
