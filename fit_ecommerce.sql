-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 07:24 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL,
  `cat_description` varchar(255) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `Is_Active`, `cat_description`, `PostingDate`, `UpdationDate`) VALUES
(2, ' grains', 1, '', '2021-05-01 20:53:44', '2021-05-03 16:12:19'),
(3, 'vegetables & ice cream', 1, 'this', '2021-05-01 20:53:44', '2021-05-03 16:43:08'),
(5, 'Dairy ', 1, '', '2021-05-01 20:53:44', '2021-05-01 20:53:44'),
(7, 'Seeds', 1, '', '2021-05-01 20:53:44', '2021-05-03 16:50:35'),
(9, 'Spices & sauces', 1, '', '2021-05-01 20:53:44', '2021-05-01 20:53:44'),
(11, 'Juices & Drinks', 1, '', '2021-05-01 20:53:44', '2021-05-01 20:53:44'),
(13, 'Dessert', 1, '', '2021-05-01 20:53:44', '2021-05-01 20:53:44'),
(14, 'Meal', 1, '', '2021-05-01 20:53:44', '2021-05-02 14:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `comment`, `added_on`) VALUES
(1, 'Vishal', 'vishal@gmail.com', '1234567890', 'Test Query', '2020-01-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `o_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Delivary_date` date NOT NULL,
  `bill` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `Post_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Post_detail` varchar(255) NOT NULL,
  `PostingDate` datetime NOT NULL,
  `Is_Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `product_details` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `product_name`, `product_price`, `qty`, `image`, `short_desc`, `product_details`, `status`, `Is_Active`) VALUES
(6, 2, 'QUAKER INSTANT OATMEAL JAR 1KG', 400, 6, 'https://www.cellsii.com/images/thumbnails/1133/1133/detailed/23/Quaker-Instant-Oatmeal-Jar-1Kg-Price-in-Bd.jpg', '', 'kfdjgisd mn jhv ,zxmcoei zxncesjiw', 1, 1),
(8, 7, 'sadafs', 1234, 9, 'https://www.cellsii.com/images/thumbnails/1133/1133/detailed/23/Quaker-Instant-Oatmeal-Jar-1Kg-Price-in-Bd.jpg', '', 'aCCa  fdsczdxv vdf vv', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `id` int(11) NOT NULL,
  `postId` char(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `postId`, `name`, `email`, `comment`, `postingDate`, `status`) VALUES
(2, '12', 'Test user', 'test@gmail.com', 'This is sample text for testing.', '2018-11-21 11:25:56', 1),
(3, '7', 'ABC', 'abc@test.com', 'This is sample text for testing.', '2018-11-21 11:27:06', 1),
(4, '15', 'S. M. Ashraf Kabir', 'ashrafkabir95@gmail.com', 'something', '2019-04-02 12:55:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`) VALUES
(13, 'Redmi Note 7', 8, 12, '<p><b>Manufacturer:</b> Xiaomi</p><p><b>Model:</b> Xiaomi Redmi Note 7</p><p><b>launch date (global):</b> 28-02-2019</p><p><b>operating system:</b> Android</p><p><b>os version:</b> 9</p><p><b>Type</b>: Smartphone</p><p><b>Status:</b> Launched</p><p><b>Colors:</b> Sapphire Blue Onyx Black Ruby Red</p><p><b>Product Name:</b> Xiaomi Redmi Note 7</p>', '2019-04-02 12:48:19', NULL, 1, 'Redmi-Note-7', 'bb635433865c9dfd90e50f706d4a2c0cjpeg'),
(14, 'Samsung Galaxy S10', 8, 10, '<div class=\"co8aDb gsrt\" aria-level=\"3\" role=\"heading\" style=\"margin-bottom: 15px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 16px;\"><b><b>Samsung Galaxy S10 specs</b></b></div><div class=\"RqBzHd\" style=\"padding: 0px 20px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 16px;\"><ul class=\"i8Z77e\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px;\"><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\"><b>Weight</b>: 157g.</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">Dimensions: 149.9 x 70.4 x 7.8mm.</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">OS: Android 9.</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">Screen size: 6.1-inch.</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">Resolution: QHD+</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">CPU: Octa-core chipset.</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">RAM: 8GB.</li><li class=\"TrT0Xe\" style=\"margin: 0px 0px 4px; padding: 0px; border: 0px; list-style-type: disc;\">Storage: 128/512GB</li></ul></div>', '2019-04-02 12:50:57', NULL, 1, 'Samsung-Galaxy-S10', '60a3e0112bee1f74a8af0559685121f1jpeg'),
(15, 'iPhone X', 9, 16, '<table style=\"table-layout: fixed; width: 598px; color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: small; background-color: rgb(255, 255, 255);\"><tbody><tr class=\"ztXv9\" style=\"border-bottom: 1px solid rgb(235, 235, 235);\"><th style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; color: rgb(0, 0, 0); font-weight: bolder;\"></th><th style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px; color: rgb(0, 0, 0); font-weight: bolder;\"><br></th><th style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px; color: rgb(0, 0, 0); font-weight: bolder;\"><b>iPhone X</b></th></tr><tr style=\"border-bottom: 1px solid rgb(235, 235, 235);\"><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px;\">Screen</td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\"><br></td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\">5.8-inch OLED Super Retina HD display</td></tr><tr style=\"border-bottom: 1px solid rgb(235, 235, 235);\"><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px;\">Resolution</td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\"><br></td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\">2,436&nbsp;<b>x</b>&nbsp;1,125 pixels (458 ppi)</td></tr><tr style=\"border-bottom: 1px solid rgb(235, 235, 235);\"><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px;\">OS</td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\"><br></td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\">iOS 12</td></tr><tr style=\"border-bottom: 1px solid rgb(235, 235, 235);\"><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px;\">Storage</td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\"><br></td><td style=\"overflow-wrap: normal; height: 26px; padding-right: 10px; padding-left: 10px;\">64, 256GB</td></tr></tbody></table>', '2019-04-02 12:54:47', NULL, 1, 'iPhone-X', '24f7de50f0ceec39d1b4005f30e206b7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `usertype` int(11) NOT NULL DEFAULT 0,
  `address` varchar(255) NOT NULL,
  `nutrition_edu` varchar(255) NOT NULL,
  `nutri_experience` varchar(255) NOT NULL,
  `type_user_name` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `Is_Active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `phone`, `added_on`, `usertype`, `address`, `nutrition_edu`, `nutri_experience`, `type_user_name`, `username`, `Is_Active`) VALUES
(2, 'Admin Mozza', 'admin', 'admin@gmail.com', '', '2021-04-29 05:08:55', 1, '', '', '', 'Admin', 'admin', 1),
(4, 'Muna', 'Muna', 'Muna@gmail.com', '1234567', '2021-04-29 05:11:39', 0, '2,neitujorfi,efjgujtr,Dhaka', '', '', 'Customer', 'Muna', 1),
(5, 'Dr Abu1', 'Abu1', 'Abu@gmail.com', '000000000', '2021-04-29 05:11:39', 2, '4,udruittui,Hostpial rnhnvru,Dhaka', 'Bachelor’s degree in Nutritional Science, Dietetics, or relevant field.In-depth knowledge of biochemistry, research methods, and human physiology.', 'A minimum of 2 years’ experience as a professional nutritionist.', 'Nutritionist', 'Abu', 1),
(8, '', 'J', 'J@gmail.com', '1903371766', '0000-00-00 00:00:00', 0, '4,N circuit house Road, Dhaka', '', '', '', 'J', 1),
(12, 'Dr KKR', 'KKR', 'KKR@gmail.com', '12345678', '2021-05-07 05:18:27', 2, 'Chennai,aBXSAJK,34,INDIA', '34,gfhdgh,hjjgfh', '5year,gcbfc,gfncndgf', 'Nutritionist', 'KKR', 1),
(13, 'Dr Hena', 'Hena', 'Hena@gmail.com', '123456', '2021-05-07 05:27:27', 2, 'Hena sabckw,asgwuys,Dhaka', '5 year,xhab,anxKLA,CWNIUWI', 'XSUQWYU,7,BSJXNKSA.SMX.SAL', 'Nutritionist', 'Hena', 1),
(14, '', 'K', 'K@gmail.com', '801903371766', '2021-05-07 07:02:14', 0, '4,N circuit house Road, Dhaka', '', '', '', 'K', 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `Video_id` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `video_link` varchar(255) NOT NULL,
  `Video_description` varchar(255) NOT NULL,
  `calorie` varchar(255) NOT NULL,
  `Tiitle` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Video_id`, `Customer_ID`, `video_link`, `Video_description`, `calorie`, `Tiitle`, `active`) VALUES
(1, 4, 'https://www.youtube.com/watch?v=QYcw8QbYj8o', 'Weight Loss Tomato Soup Recipe - Oil Free Skinny Recipes - Weight Loss Diet Soup - Immune Boosting', '100', 'Soup', 0),
(2, 4, 'https://www.youtube.com/watch?v=lyg6XfP5r0M', 'Fat Burner Soup | Low calorie, high fibre fat burning soup | Essential part of a controlled diet\r\n', '60', 'Carrot', 0),
(3, 5, 'https://www.youtube.com/watch?v=WoftcZDfeoQ', 'ntjfnhlih', '343', 'Problem', 0),
(6, 8, 'https://www.youtube.com/watch?v=WoftcZDfeoQ', ' scnkjdcnd', '1234', 'mmm', 1),
(8, 4, 'https://www.youtube.com/watch?v=WoftcZDfeoQ', ' problem', '12', 'hksajhq', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Post_ID`),
  ADD KEY `Product_ID` (`Product_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Video_id`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `Post_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `Videos_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
