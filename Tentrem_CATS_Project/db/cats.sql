-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 06:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cats`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenanceid` int(11) NOT NULL,
  `vehicletype` varchar(50) NOT NULL,
  `vehicleid` int(11) DEFAULT NULL,
  `maintenancedate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rentalid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `vehicletype` varchar(50) NOT NULL,
  `vehicleid` int(11) DEFAULT NULL,
  `stationid` int(11) DEFAULT NULL,
  `starttime` timestamp NULL DEFAULT NULL,
  `endtime` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rentalid`, `userid`, `vehicletype`, `vehicleid`, `stationid`, `starttime`, `endtime`, `status`) VALUES
(21, 22523264, 'E-Scooter', 209, 107, '2023-12-14 04:43:34', '2023-12-14 04:44:03', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `reviewdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewid`, `userid`, `rating`, `comment`, `reviewdate`) VALUES
(2, 22523264, 5, 'dsadasd', '2023-12-11 06:50:57'),
(3, 22523264, 5, 'dsadasd', '2023-12-11 06:51:00'),
(4, 22523264, 4, 'dsadasd', '2023-12-11 07:13:18'),
(6, 22523264, 4, 'With supporting text below as a natural lead-in to additional content.', '2023-12-11 07:28:00'),
(7, 22523264, 5, 'With supporting text below as a natural lead-in to additional content.', '2023-12-11 07:28:06'),
(8, 22523264, 3, 'dsadasd', '2023-12-11 07:40:55'),
(11, 123123, 5, 'With supporting text below as a natural lead-in to additional content.', '2023-12-12 11:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE `stations` (
  `stationid` int(11) NOT NULL,
  `stationname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`stationid`, `stationname`, `location`) VALUES
(21, 'Ace Partadiredja Station', 'Fakultas Bisnis dan Ekonomika Front Gate'),
(101, 'Prof. Mr. H. Mohammad Yamin. Station', 'Faculty Law front gate'),
(103, 'Dr Soekiman Wirjosandjojo. Station', 'Faculty of Psychology and Social and Cultural Sciences front gate'),
(104, 'DR. H. Mohammad Natsir.', 'Faculty of Civil Engineering and Planning Front Gate'),
(105, 'K.H. Mas Mansur. Station', 'industrial Technology Faculty front gate'),
(106, 'Ace Partadiredja Station', 'Faculty of Business and Economics front gate'),
(107, 'Prof. Zanzawi Soejoeti. Station', 'Faculty of Mathematics and Natural Sciences front gate'),
(108, 'Muhammad Adnan. Station', 'Faculty of Diploma III FBE UII front gate'),
(109, 'GBPH Prabuningrat Station', 'UII Rectorate front gate'),
(110, 'Mohammad Hatta Station', 'Campus UII Main Library Front Gate'),
(111, 'Prof. KH. Abdulkahar Mudzakkir Station', 'Campus UII Main Auditorim'),
(213, 'Gedung Baru Fakultas Hukum', 'Fakultas Hukum Front Gate');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Student',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fullname`, `role`, `email`, `password`) VALUES
(123123, 'ikip', 'Student', 'asdasd@gfdg.gdf', '4297f44b13955235245b2497399d7a93'),
(212121, 'khun d', 'Staff', 'juan@email.com', '4297f44b13955235245b2497399d7a93'),
(22523002, 'rifqi', 'Staff', 'rifki@mail.com', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(22523264, 'khun', 'Student', 'Khun@gmail.com', '4297f44b13955235245b2497399d7a93');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleid` int(11) NOT NULL,
  `vehicletype` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `stationid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleid`, `vehicletype`, `status`, `stationid`) VALUES
(201, 'E-Scooter', 'Ready', 108),
(202, 'E-Scooter', 'Ready', 213),
(203, 'E-Scooter', 'Ready', 213),
(204, 'E-Scooter', 'Ready', 21),
(205, 'E-Scooter', 'Ready', 21),
(206, 'E-Scooter', 'Ready', 101),
(207, 'E-Scooter', 'Ready', 103),
(208, 'E-Scooter', 'Ready', 101),
(209, 'E-Scooter', 'Ready', 107),
(210, 'E-Scooter', 'Ready', 104),
(211, 'E-Scooter', 'Ready', 103),
(212, 'E-Scooter', 'Ready', 104),
(213, 'E-Scooter', 'Ready', 105),
(214, 'E-Scooter', 'Ready', 105),
(215, 'E-Scooter', 'Ready', 106),
(216, 'E-Scooter', 'Ready', 107),
(217, 'E-Scooter', 'Ready', 107),
(218, 'E-Scooter', 'Ready', 108),
(219, 'E-Scooter', 'Ready', 109),
(220, 'E-Scooter', 'Ready', 109),
(221, 'E-Scooter', 'Ready', 110),
(222, 'E-Scooter', 'Ready', 111),
(224, 'E-Scooter', 'Ready', 111),
(225, 'E-Scooter', 'Ready', 213),
(301, 'Bike', 'Ready', 110),
(302, 'Bike', 'Ready', 110),
(303, 'Bike', 'Ready', 111),
(304, 'Bike', 'Ready', 111),
(305, 'Bike', 'Ready', 213),
(306, 'Bike', 'Ready', 21),
(307, 'Bike', 'Ready', 21),
(308, 'Bike', 'Ready', 101),
(309, 'Bike', 'Ready', 101),
(310, 'Bike', 'Ready', 103),
(311, 'Bike', 'Ready', 103),
(312, 'Bike', 'Ready', 104),
(313, 'Bike', 'Ready', 105),
(314, 'Bike', 'Ready', 105),
(315, 'Bike', 'Ready', 106),
(316, 'Bike', 'Ready', 107),
(317, 'Bike', 'Ready', 107),
(318, 'Bike', 'Ready', 108),
(319, 'Bike', 'Ready', 108),
(320, 'Bike', 'Ready', 109),
(321, 'Bike', 'Ready', 110),
(322, 'Bike', 'Ready', 110),
(323, 'Bike', 'Ready', 111),
(324, 'Bike', 'Ready', 213),
(325, 'Bike', 'Ready', 213);

--
-- Triggers `vehicle`
--
DELIMITER $$
CREATE TRIGGER `trg_after_update_vehicle_status` AFTER UPDATE ON `vehicle` FOR EACH ROW BEGIN
    IF NEW.status = 'Maintenance' THEN
        INSERT INTO Maintenance (vehicletype, vehicleid, maintenancedate)
        VALUES (NEW.vehicletype, NEW.vehicleid, NOW());
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_update_vehicle_status_delete_maintenance` AFTER UPDATE ON `vehicle` FOR EACH ROW BEGIN
    IF NEW.Status = 'Ready' THEN
        DELETE FROM maintenance
        WHERE vehicleid = NEW.vehicleid AND vehicletype = NEW.vehicletype;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenanceid`),
  ADD KEY `vehicleid` (`vehicleid`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rentalid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `vehicleid` (`vehicleid`),
  ADD KEY `stationid` (`stationid`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`stationid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleid`),
  ADD KEY `fk_vehicle_station` (`stationid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenanceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rentalid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`vehicleid`) REFERENCES `vehicle` (`vehicleid`);

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`vehicleid`) REFERENCES `vehicle` (`vehicleid`),
  ADD CONSTRAINT `rentals_ibfk_3` FOREIGN KEY (`stationid`) REFERENCES `stations` (`stationid`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `fk_vehicle_station` FOREIGN KEY (`stationid`) REFERENCES `stations` (`stationid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
