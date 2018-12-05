-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2018 at 06:54 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traffic_v3.3`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_panel_user`
--

CREATE TABLE `c_panel_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_panel_user`
--

INSERT INTO `c_panel_user` (`id`, `username`, `name`, `password`) VALUES
(2, 'amiamitswe', 'Amit Samadder', '121212'),
(3, 'amiabirswe', 'Abir Samadder', '121212');

-- --------------------------------------------------------

--
-- Table structure for table `driver_occurrence_details`
--

CREATE TABLE `driver_occurrence_details` (
  `id` int(11) NOT NULL,
  `case_id` varchar(40) NOT NULL,
  `fine` int(11) NOT NULL,
  `comment` text NOT NULL,
  `image_name` varchar(500) NOT NULL,
  `image` longblob NOT NULL,
  `confirm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_offence`
--

CREATE TABLE `driver_offence` (
  `id` int(11) NOT NULL,
  `case_id` varchar(40) NOT NULL,
  `offence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_owner_details`
--

CREATE TABLE `driver_owner_details` (
  `id` int(11) NOT NULL,
  `case_number` varchar(50) NOT NULL,
  `traffic_police_id` int(11) NOT NULL,
  `driver_name` varchar(255) NOT NULL,
  `driver_address` text NOT NULL,
  `driver_mobile` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `occurrence_place` varchar(255) NOT NULL,
  `occurrence_date` date NOT NULL,
  `occurrence_time` varchar(30) NOT NULL,
  `last_appo_date` date NOT NULL,
  `police_station` varchar(100) NOT NULL,
  `confrim_check` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `given_prove`
--

CREATE TABLE `given_prove` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(30) NOT NULL,
  `prove_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offence`
--

CREATE TABLE `offence` (
  `id` int(11) NOT NULL,
  `law_no` int(11) NOT NULL,
  `law_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offence`
--

INSERT INTO `offence` (`id`, `law_no`, `law_details`) VALUES
(1, 200, '137 : General fine 200 Tk.'),
(2, 100, '139 : Using hydrolic horn 100 Tk.'),
(3, 500, '140 : Disobey police order, refusal to cooperate 500 Tk.'),
(4, 510, '140 : Disobeying red signal 510 Tk (Same as special fine).'),
(5, 300, '142 : Careless driving 300 Tk.'),
(6, 520, '146 : Accident related fine 520 Tk.'),
(7, 350, '149 : Driving without safety 350 Tk.'),
(8, 150, '150 : Black smoke emission 150 Tk.'),
(9, 1250, '151 : Modification of car and sale without permission 1250 Tk.'),
(10, 700, '152 : Driving without registration, fitness, or route permit 700 Tk.'),
(11, 470, '154 : Overloading the car 470 Tk.'),
(12, 480, '155 : Driving without insurance 480 Tk.'),
(13, 490, '156 : Driving without permission 490 TK.'),
(14, 250, '157 : Blocking road or public place 250 Tk.'),
(15, 280, '158 Unauthorized touch/use of car 280 Tk.'),
(16, 1000, '000 : Lane violation 1,000 Tk.');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `police_user_id` int(11) NOT NULL,
  `case_number` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_at_date` date NOT NULL,
  `payment_at_time` varchar(30) NOT NULL,
  `paid_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proves`
--

CREATE TABLE `proves` (
  `id` int(11) NOT NULL,
  `prove_id` int(11) NOT NULL,
  `prove_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proves`
--

INSERT INTO `proves` (`id`, `prove_id`, `prove_details`) VALUES
(1, 111, 'Driving Licence'),
(2, 112, 'Car Licence'),
(3, 113, 'Car Insurance'),
(4, 114, 'Driving Insurance'),
(5, 115, 'On Test Paper'),
(6, 116, 'Route Permission'),
(7, 117, 'Tex Token'),
(8, 118, 'Car Fitness Certificate'),
(9, 119, 'C.S'),
(10, 120, 'Nothing');

-- --------------------------------------------------------

--
-- Table structure for table `traffic_police`
--

CREATE TABLE `traffic_police` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `police_id_no` varchar(255) NOT NULL,
  `police_user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `save_date` varchar(20) NOT NULL,
  `update_on_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traffic_police`
--

INSERT INTO `traffic_police` (`id`, `full_name`, `email_id`, `phone_number`, `police_id_no`, `police_user_id`, `password`, `save_date`, `update_on_date`) VALUES
(49, 'Amit Samadder', 'amiamitswe@gmail.com', 1917784210, 'AAA12', 123456, 'e10adc3949ba59abbe56e057f20f883e', '19.04.2018 12:13:18', '08.05.2018 12:24:33'),
(50, 'Abir Samadder', 'amiamit787@gmail.com', 1917784210, 'Barisal-12345', 456789, '93279e3308bdbbeed946fc965017f67a', '19.04.2018 12:46:48', '19.04.2018 12:46:48');

-- --------------------------------------------------------

--
-- Table structure for table `victims_claim`
--

CREATE TABLE `victims_claim` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `case_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `police_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `detials` text COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `check_confrom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_panel_user`
--
ALTER TABLE `c_panel_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_occurrence_details`
--
ALTER TABLE `driver_occurrence_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `driver_offence`
--
ALTER TABLE `driver_offence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `driver_owner_details`
--
ALTER TABLE `driver_owner_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_number` (`case_number`),
  ADD KEY `traffic_police_id` (`traffic_police_id`);

--
-- Indexes for table `given_prove`
--
ALTER TABLE `given_prove`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prove_id` (`prove_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `offence`
--
ALTER TABLE `offence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `police_user_id` (`police_user_id`),
  ADD KEY `case_number` (`case_number`);

--
-- Indexes for table `proves`
--
ALTER TABLE `proves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traffic_police`
--
ALTER TABLE `traffic_police`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `police_user_id` (`police_user_id`);

--
-- Indexes for table `victims_claim`
--
ALTER TABLE `victims_claim`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_panel_user`
--
ALTER TABLE `c_panel_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `driver_occurrence_details`
--
ALTER TABLE `driver_occurrence_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `driver_offence`
--
ALTER TABLE `driver_offence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT for table `driver_owner_details`
--
ALTER TABLE `driver_owner_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `given_prove`
--
ALTER TABLE `given_prove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `offence`
--
ALTER TABLE `offence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `proves`
--
ALTER TABLE `proves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `traffic_police`
--
ALTER TABLE `traffic_police`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `victims_claim`
--
ALTER TABLE `victims_claim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_occurrence_details`
--
ALTER TABLE `driver_occurrence_details`
  ADD CONSTRAINT `driver_occurrence_details_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `driver_owner_details` (`case_number`);

--
-- Constraints for table `driver_offence`
--
ALTER TABLE `driver_offence`
  ADD CONSTRAINT `driver_offence_ibfk_1` FOREIGN KEY (`case_id`) REFERENCES `driver_owner_details` (`case_number`);

--
-- Constraints for table `driver_owner_details`
--
ALTER TABLE `driver_owner_details`
  ADD CONSTRAINT `driver_owner_details_ibfk_1` FOREIGN KEY (`traffic_police_id`) REFERENCES `traffic_police` (`police_user_id`);

--
-- Constraints for table `given_prove`
--
ALTER TABLE `given_prove`
  ADD CONSTRAINT `given_prove_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver_owner_details` (`case_number`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`police_user_id`) REFERENCES `traffic_police` (`police_user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`case_number`) REFERENCES `driver_owner_details` (`case_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
