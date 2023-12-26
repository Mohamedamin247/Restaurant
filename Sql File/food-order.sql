-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 12:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Mostafa Amin', 'mustafaAmin125', '6948ae50e4fd6825490bd8d43718ae21cb1ab752'),
(8, 'Muhammed Ameen', 'muhammed_amin247', '33cd47a72beb330d128f4b12a9bd1ccef224833d'),
(9, 'Mostafa Amin', 'mustafaAmin25', '73643f14d365c2ea68443690cda8d13af4ad872a'),
(10, 'Lana Del Rey', 'lana258', '36a8effdfbad39641ad36732066570201c88089a'),
(11, 'Jennifer Lawrence', 'jennifer125', '6c1d006e3e146d4ee8af5981b8d84e1fe9e38b6c'),
(12, 'Monica Bellucci', 'monica21', '97ef30b919ff7e5d7fdc19967a31387fa22ce42e'),
(13, 'Jenna Ortega', 'jenna78', '40c5169448af7279279c2b4041455ee4b0ab5cd1'),
(14, 'Julia Ann', 'julia666', '05962ad33b64478ff569e9c75509d66a623b0537'),
(15, 'Admin', 'Administrator', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(18, 'Jennifer Aniston', 'jennifer188', 'b7ed088190c204b31cd71484e6a1c538986b5f77');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(2, 'Pizza', 'Food_Category_398.jpg', 'Yes', 'Yes'),
(5, 'Burger', 'Food_Category_671.jpg', 'Yes', 'Yes'),
(6, 'Drinks', 'Food_Category_100.webp', 'yes', 'yes'),
(7, 'Salad', 'Food_Category_106.jpg', 'Yes', 'No'),
(8, 'Hot Drinks', 'Food_Category_250.jpg', 'Yes', 'Yes'),
(9, 'Desserts', 'Food_Category_236.webp', 'yes', 'yes'),
(10, 'Momo', 'Food_Category_409.jpg', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `img_name`, `category_id`, `featured`, `active`) VALUES
(1, 'Vegetable Salad', 'Vegetable Salad:\r\ntomato, cucumber and lettuce', '10.00', 'Food-Name-8642.jpg', 2, 'NO', 'Yes'),
(4, 'Traditional Italian Pizza..', 'The most common Pizza in Italy..', '50.00', 'Food-Name-556.jpg', 2, 'Yes', 'Yes'),
(5, 'Cheese Burger', 'Cheese Burger With beef chuck roast', '19.00', 'Food-Name-946.jpg', 5, 'Yes', 'Yes'),
(6, 'Best Burger', 'Burger With Ham, Pineapple and lots of cheese.', '45.00', 'Food-Name-941.jpg', 5, 'Yes', 'Yes'),
(7, 'Dumpling Specials', 'Chicken Dumpling with herbs from mountains..', '100.00', 'Food-Name-7316.jpg', 10, 'Yes', 'Yes'),
(8, 'Smoky BBQ Pizza', 'Best Firewood Pizza in town', '60.00', 'Food-Name-137.jpg', 2, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Best Burger', '45.00', 4, '180.00', '2023-09-12 01:13:57', 'Cancelled', 'Muhammed Amin Khattab ', '01112136061', 'muhamed.amin@gmail.com', 'Benha'),
(2, 'Dumpling Specials', '100.00', 3, '300.00', '2023-09-12 01:17:25', 'Delivered', 'Mustafa Amin', '01100200400', 'mostafa999@gmail.com', 'Benha'),
(3, 'Cheese Burger', '19.00', 6, '114.00', '2023-09-12 01:39:41', 'On Delivery', 'Lana Del Rey', '01112135051', 'lanadel125@yahoo.com', 'New Jersy\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
