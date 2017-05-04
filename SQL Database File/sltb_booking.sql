-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2014 at 09:32 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sltb_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_bus`
--

CREATE TABLE IF NOT EXISTS `assign_bus` (
  `assign_bus_no` int(5) NOT NULL AUTO_INCREMENT COMMENT 'this is primary key',
  `userName` varchar(10) NOT NULL COMMENT 'System User Name',
  `busNo` varchar(10) NOT NULL COMMENT 'Bus Route Number',
  `date` date NOT NULL COMMENT 'Route assing Date',
  `sql` varchar(1) NOT NULL,
  PRIMARY KEY (`assign_bus_no`),
  KEY `userName` (`userName`,`busNo`),
  KEY `routeNo` (`busNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is store who is assing Route for Bus' AUTO_INCREMENT=25 ;

--
-- Dumping data for table `assign_bus`
--

INSERT INTO `assign_bus` (`assign_bus_no`, `userName`, `busNo`, `date`, `sql`) VALUES
(9, 'Nevil', 'NB6079', '2014-05-22', 'I'),
(10, 'Nevil', 'ND2345', '2014-05-22', 'I'),
(11, 'Nevil', 'JD4530', '2014-05-22', 'I'),
(12, 'Nevil', 'NA6890', '2014-05-22', 'I'),
(13, 'Nevil', 'NB1290', '2014-05-22', 'I'),
(14, 'Nevil', 'NB1290', '2014-05-22', 'U'),
(15, 'Nevil', 'NB1290', '2014-05-22', 'D'),
(16, 'Nevil', 'qwer', '2014-09-24', 'I'),
(17, 'Nevil', 'qwe', '2014-09-24', 'U'),
(18, 'Nevil', 'qwe', '2014-09-24', 'U'),
(19, 'Nevil', 'qwe', '2014-09-24', 'U'),
(20, 'Nevil', 'qw', '2014-09-24', 'U'),
(21, 'Nevil', 'qw', '2014-09-24', 'U'),
(22, 'Nevil', 'qwe', '2014-09-24', 'U'),
(23, 'Nevil', 'qwe', '2014-10-01', 'D'),
(24, 'Nevil', 'JD4530', '2014-10-01', 'U');

-- --------------------------------------------------------

--
-- Table structure for table `assign_coductor`
--

CREATE TABLE IF NOT EXISTS `assign_coductor` (
  `assingConductorNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is primary key',
  `userName` varchar(10) NOT NULL COMMENT 'System User Name',
  `conductorNo` varchar(10) NOT NULL COMMENT 'Conductor Number',
  `date` date NOT NULL COMMENT 'Conductor assing Date',
  PRIMARY KEY (`assingConductorNo`),
  KEY `userName` (`userName`,`conductorNo`),
  KEY `userName_2` (`userName`),
  KEY `conductorNo` (`conductorNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is store who is assing conductor for Bus' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `assign_coductor`
--

INSERT INTO `assign_coductor` (`assingConductorNo`, `userName`, `conductorNo`, `date`) VALUES
(3, 'Nevil', 'CB0023412', '2014-05-22'),
(4, 'Nevil', 'CB0023423', '2014-05-22'),
(5, 'Nevil', 'CB0023456', '2014-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `available_seat`
--

CREATE TABLE IF NOT EXISTS `available_seat` (
  `seatNo` int(2) NOT NULL COMMENT 'Bus Seat Number',
  `busNo` varchar(10) NOT NULL COMMENT 'SLTB Bus Number',
  `journeyNo` varchar(10) NOT NULL,
  `status` varchar(2) NOT NULL COMMENT 'Seat Status',
  `date` date NOT NULL COMMENT 'Status Date',
  `time` time NOT NULL,
  PRIMARY KEY (`seatNo`,`busNo`,`journeyNo`,`date`),
  KEY `seatNo` (`seatNo`,`busNo`),
  KEY `busNo` (`busNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is current Stauts a Bus Seat';

--
-- Dumping data for table `available_seat`
--

INSERT INTO `available_seat` (`seatNo`, `busNo`, `journeyNo`, `status`, `date`, `time`) VALUES
(1, 'NA6890', 'BCA057002', 'B', '2014-10-01', '16:12:46'),
(2, 'NA6890', 'BCA057002', 'B', '2014-10-01', '16:12:46'),
(3, 'NA6890', 'BCA057002', 'B', '2014-10-01', '16:12:46'),
(3, 'ND2345', 'BAC057001', 'B', '2014-10-11', '21:20:57'),
(4, 'ND2345', 'BAC057001', 'B', '2014-10-11', '14:35:25'),
(5, 'ND2345', 'BAC057001', 'B', '2014-10-11', '14:35:25'),
(7, 'ND2345', 'BAC057001', 'B', '2014-10-11', '09:25:32'),
(36, 'JD4530', 'ACA015001', 'B', '2014-10-01', '16:14:14'),
(36, 'JD4530', 'ACA015001', 'B', '2014-10-11', '09:28:08'),
(36, 'ND2345', 'BAC057001', 'B', '2014-10-07', '12:32:41'),
(36, 'ND2345', 'BAC057001', 'B', '2014-10-11', '09:27:11'),
(37, 'JD4530', 'ACA015001', 'B', '2014-10-01', '16:14:14'),
(37, 'JD4530', 'ACA015001', 'B', '2014-10-11', '09:28:13'),
(38, 'ND2345', 'BAC057001', 'B', '2014-10-11', '21:17:50'),
(39, 'ND2345', 'BAC057001', 'B', '2014-10-11', '21:17:50'),
(40, 'ND2345', 'BAC057001', 'B', '2014-10-11', '21:17:50'),
(45, 'NA6890', 'BCA057002', 'B', '2014-10-01', '16:11:47'),
(46, 'NA6890', 'BCA057002', 'B', '2014-10-01', '16:11:47'),
(49, 'NA6890', 'BCA057002', 'B', '2014-10-07', '16:19:04');

-- --------------------------------------------------------

--
-- Table structure for table `booker`
--

CREATE TABLE IF NOT EXISTS `booker` (
  `bookerNICNo` varchar(10) NOT NULL COMMENT 'Bus Booker NIC Number',
  `bookerName` varchar(20) NOT NULL COMMENT 'Booker Short Name',
  `bookerMNo` varchar(10) NOT NULL COMMENT 'Booker Mobile Number',
  PRIMARY KEY (`bookerNICNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Master Table is store Bus Booker Data';

--
-- Dumping data for table `booker`
--

INSERT INTO `booker` (`bookerNICNo`, `bookerName`, `bookerMNo`) VALUES
('435672894v', 'kalam', '0112345678'),
('782423567v', 'kamal', '0784325678'),
('881239472v', 'saman', '0752234567'),
('881691035v', 'nevil', '0717226079'),
('881691036v', 'Ranathunge', '1234567890'),
('8923435638', 'sunil', '0213456789'),
('901234353v', 'saman', '0372345678'),
('903456721v', 'sanath', '0717226079'),
('987654325v', 'wimal', '0717226079');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `bookingID` varchar(25) NOT NULL COMMENT 'Bus Ticket Number',
  `bookerNICNo` varchar(10) NOT NULL COMMENT 'Bus Booker NIC Number',
  `busNo` varchar(10) NOT NULL COMMENT 'Bus Number',
  `journeyNo` varchar(10) NOT NULL,
  `no_of_seat` int(2) NOT NULL,
  `entryPointNo` int(2) NOT NULL,
  `ammount` float NOT NULL COMMENT 'Total Amount of Bus ticket',
  `date` date NOT NULL COMMENT 'Ticket receive Date',
  `payment_status` varchar(2) NOT NULL DEFAULT 'P',
  `s_bookin_time` time NOT NULL,
  PRIMARY KEY (`bookingID`),
  KEY `bookerNICNo` (`bookerNICNo`,`busNo`),
  KEY `bookerNICNo_2` (`bookerNICNo`),
  KEY `busNo` (`busNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is store Receive booking invoice';

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `bookerNICNo`, `busNo`, `journeyNo`, `no_of_seat`, `entryPointNo`, `ammount`, `date`, `payment_status`, `s_bookin_time`) VALUES
('JD4530ACA01500114100100', '881691035v', 'JD4530', 'ACA015001', 2, 1, 1800, '2014-10-01', 'Ok', '16:25:14'),
('JD4530ACA01500114101100', '881691035v', 'JD4530', 'ACA015001', 1, 8, 900, '2014-10-11', 'Ok', '09:39:13'),
('JD4530ACA01500114101101', '881691036v', 'JD4530', 'ACA015001', 1, 7, 900, '2014-10-11', 'Ok', '09:39:08'),
('NA6890BCA05700214100100', '881691035v', 'NA6890', 'BCA057002', 2, 15, 1500, '2014-10-01', 'Ok', '16:22:47'),
('NA6890BCA05700214100101', '881691036v', 'NA6890', 'BCA057002', 3, 14, 2250, '2014-10-01', 'Ok', '16:23:46'),
('NA6890BCA05700214100700', '881691035v', 'NA6890', 'BCA057002', 1, 15, 750, '2014-10-07', 'Ok', '16:30:04'),
('ND2345BAC05700114100701', '881691036v', 'ND2345', 'BAC057001', 1, 11, 750, '2014-10-07', 'Ok', '12:43:41'),
('ND2345BAC05700114101100', '881691036v', 'ND2345', 'BAC057001', 3, 1, 2250, '2014-10-11', 'Ok', '21:28:50'),
('ND2345BAC05700114101101', '881691035v', 'ND2345', 'BAC057001', 1, 9, 750, '2014-10-11', 'Ok', '21:31:57'),
('ND2345BAC05700114101102', '881691035v', 'ND2345', 'BAC057001', 1, 1, 750, '2014-10-11', 'Ok', '09:36:32'),
('ND2345BAC05700114101103', '881691036v', 'ND2345', 'BAC057001', 1, 1, 750, '2014-10-11', 'Ok', '09:38:11'),
('ND2345BAC05700114101104', '881691036v', 'ND2345', 'BAC057001', 2, 1, 1500, '2014-10-11', 'Ok', '14:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `busNo` varchar(10) NOT NULL COMMENT 'Bus Number',
  `busModel` varchar(15) NOT NULL COMMENT 'Bus Model',
  `numberOfSeat` int(2) NOT NULL COMMENT 'Number Of Seat',
  PRIMARY KEY (`busNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Master Table is store Bus Data';

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busNo`, `busModel`, `numberOfSeat`) VALUES
('JD4530', 'TATA', 40),
('NA6890', 'TATA', 49),
('NB6079', 'TATA', 49),
('ND2345', 'TATA', 40);

-- --------------------------------------------------------

--
-- Table structure for table `conductor`
--

CREATE TABLE IF NOT EXISTS `conductor` (
  `conductorNo` varchar(10) NOT NULL COMMENT 'Conductor Number',
  `conductorName` varchar(20) NOT NULL COMMENT 'Conductor Name',
  `conductorMNo` varchar(10) NOT NULL COMMENT 'Conductor Mobile Number',
  `busNo` varchar(10) DEFAULT NULL COMMENT 'Assing Bus No',
  PRIMARY KEY (`conductorNo`),
  KEY `busNo` (`busNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Master Table is store Conductor Data';

--
-- Dumping data for table `conductor`
--

INSERT INTO `conductor` (`conductorNo`, `conductorName`, `conductorMNo`, `busNo`) VALUES
('CB0023412', 'Jagath', '0712776979', 'JD4530'),
('CB0023423', 'Sumith', '0712776979', 'NA6890'),
('CB0023456', 'Anil', '0712776979', 'ND2345');

-- --------------------------------------------------------

--
-- Table structure for table `entrypoint_for_journey`
--

CREATE TABLE IF NOT EXISTS `entrypoint_for_journey` (
  `entryPoint_for_journeyNo` int(3) NOT NULL AUTO_INCREMENT COMMENT 'this is primary key',
  `journeyNo` varchar(10) NOT NULL COMMENT 'Bus Route Number',
  `entryPointNo` int(2) NOT NULL COMMENT 'Bus Entry Point Number',
  PRIMARY KEY (`entryPoint_for_journeyNo`),
  KEY `entryPointNo` (`entryPointNo`),
  KEY `journeyNo` (`journeyNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is assing Entry Point for Bus Route' AUTO_INCREMENT=79 ;

--
-- Dumping data for table `entrypoint_for_journey`
--

INSERT INTO `entrypoint_for_journey` (`entryPoint_for_journeyNo`, `journeyNo`, `entryPointNo`) VALUES
(40, 'AAC057001', 15),
(41, 'AAC057001', 14),
(42, 'AAC057001', 12),
(43, 'AAC057001', 13),
(44, 'ACA015001', 1),
(45, 'ACA015001', 7),
(46, 'ACA015001', 8),
(47, 'ACA015001', 11),
(48, 'ACA057001', 1),
(49, 'ACA057001', 7),
(50, 'ACA057001', 8),
(51, 'ACA057002', 1),
(52, 'ACA057002', 11),
(53, 'ACA057003', 1),
(54, 'ACA057003', 8),
(55, 'ACA057003', 11),
(56, 'ACJ057001', 15),
(57, 'ACJ057001', 1),
(58, 'ACJ057001', 11),
(59, 'BAC057001', 1),
(60, 'BAC057001', 11),
(61, 'BAC057001', 9),
(62, 'BCA015001', 15),
(63, 'BCA015001', 14),
(64, 'BCA015001', 17),
(65, 'BCA015001', 11),
(66, 'BCA057001', 15),
(67, 'BCA057001', 14),
(68, 'BCA057001', 12),
(69, 'BCA057001', 13),
(70, 'BCA057002', 15),
(71, 'BCA057002', 14),
(72, 'BCA057002', 12),
(73, 'BCA057003', 15),
(74, 'BCA057003', 14),
(75, 'BCA057003', 12),
(76, 'BCA057003', 13),
(77, 'BCJ057001', 15),
(78, 'BCJ057001', 19);

-- --------------------------------------------------------

--
-- Table structure for table `entry_point`
--

CREATE TABLE IF NOT EXISTS `entry_point` (
  `entryPointNo` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Bus Entry Point No',
  `entryPoint` varchar(15) NOT NULL COMMENT 'Bus Entry Point Name',
  PRIMARY KEY (`entryPointNo`),
  KEY `entryPoint` (`entryPoint`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Master Table is store Entry Point for bus Route' AUTO_INCREMENT=20 ;

--
-- Dumping data for table `entry_point`
--

INSERT INTO `entry_point` (`entryPointNo`, `entryPoint`) VALUES
(15, 'Anuradhapu'),
(1, 'Colombo'),
(17, 'Dabulla'),
(19, 'Jaffna'),
(16, 'Kakirawa'),
(7, 'Kalaniya'),
(8, 'Kiribathgoda'),
(11, 'Kurunagala'),
(18, 'Maradankadawala'),
(14, 'New Town'),
(9, 'Nittabuwa'),
(6, 'Paligoda'),
(12, 'Talawa'),
(13, 'Thabuththagama'),
(10, 'Warakapola');

-- --------------------------------------------------------

--
-- Table structure for table `journey`
--

CREATE TABLE IF NOT EXISTS `journey` (
  `journeyNo` varchar(10) NOT NULL,
  `routeNo` varchar(5) NOT NULL COMMENT 'Bus Route Number',
  `journeyFrom` varchar(10) NOT NULL COMMENT 'Bus Route Start Point',
  `journeyTo` varchar(10) NOT NULL COMMENT 'Bus Route End Point',
  `departureTime` time NOT NULL COMMENT 'Bus Departure Time',
  `arrivalTime` time NOT NULL COMMENT 'Bus Arrival Time',
  `price` float NOT NULL COMMENT 'Bus Ticket Price',
  PRIMARY KEY (`journeyNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Master Table is store Bus Route Data';

--
-- Dumping data for table `journey`
--

INSERT INTO `journey` (`journeyNo`, `routeNo`, `journeyFrom`, `journeyTo`, `departureTime`, `arrivalTime`, `price`) VALUES
('AAC057001', '57', 'Anuradhapu', 'Colombo', '20:15:00', '01:00:00', 750),
('ACA015001', '15', 'Colombo', 'Anuradhapu', '14:10:00', '20:15:00', 900),
('ACA057001', '57', 'Colombo', 'Anuradhapu', '06:15:00', '12:45:00', 750),
('ACA057002', '57', 'Colombo', 'Anuradhapu', '02:05:00', '07:00:00', 750),
('ACA057003', '57', 'Colombo', 'Anuradhapu', '18:05:00', '23:30:00', 750),
('ACJ057001', '57', 'Colombo', 'Jaffna', '20:00:00', '03:45:00', 1300),
('BAC057001', '57', 'Colombo', 'Anuradhapu', '23:55:00', '05:20:00', 750),
('BCA015001', '15', 'Anuradhapu', 'Colombo', '01:00:00', '06:00:00', 900),
('BCA057001', '57', 'Anuradhapu', 'Colombo', '14:15:00', '20:15:00', 750),
('BCA057002', '57', 'Anuradhapu', 'Colombo', '20:20:00', '24:00:00', 750),
('BCA057003', '57', 'Anuradhapu', 'Colombo', '22:15:00', '04:15:00', 750),
('BCJ057001', '57', 'Jaffna', 'Colombo', '13:15:00', '20:20:00', 1300);

-- --------------------------------------------------------

--
-- Table structure for table `journey_for_bus`
--

CREATE TABLE IF NOT EXISTS `journey_for_bus` (
  `journey_for_bus_No` int(3) NOT NULL AUTO_INCREMENT,
  `busNo` varchar(10) NOT NULL,
  `journeyNo` varchar(10) NOT NULL,
  PRIMARY KEY (`journey_for_bus_No`),
  KEY `busNo` (`busNo`),
  KEY `journeyNo` (`journeyNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `journey_for_bus`
--

INSERT INTO `journey_for_bus` (`journey_for_bus_No`, `busNo`, `journeyNo`) VALUES
(30, 'NA6890', 'ACA057002'),
(31, 'NA6890', 'BCA057002'),
(32, 'JD4530', 'ACA015001'),
(33, 'JD4530', 'BCA015001'),
(34, 'NB6079', 'BCJ057001'),
(35, 'NB6079', 'ACJ057001'),
(36, 'ND2345', 'AAC057001'),
(37, 'ND2345', 'BAC057001');

-- --------------------------------------------------------

--
-- Table structure for table `manual_booking`
--

CREATE TABLE IF NOT EXISTS `manual_booking` (
  `manualBookingNo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is primary key',
  `userName` varchar(10) NOT NULL COMMENT 'System User Name',
  `bookingID` varchar(20) NOT NULL,
  `date` date NOT NULL COMMENT 'ManualBooking Date',
  PRIMARY KEY (`manualBookingNo`),
  KEY `userName` (`userName`,`bookingID`),
  KEY `bookerNICNo` (`bookingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is store who is manual booking Booker' AUTO_INCREMENT=18 ;

--
-- Dumping data for table `manual_booking`
--

INSERT INTO `manual_booking` (`manualBookingNo`, `userName`, `bookingID`, `date`) VALUES
(16, 'Kasun', 'NA6890CA5714052203', '2014-05-22'),
(17, 'Kasun', 'ND2345BAC05700114100', '2014-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `receive_ticke`
--

CREATE TABLE IF NOT EXISTS `receive_ticke` (
  `ticketNo` varchar(25) NOT NULL,
  `passengerName` varchar(25) NOT NULL COMMENT 'Passenger Name',
  `seatNo` int(2) NOT NULL COMMENT 'Bus Seat Number',
  `gender` varchar(1) NOT NULL COMMENT 'Passenger Gender',
  `bookingID` varchar(25) NOT NULL,
  PRIMARY KEY (`ticketNo`),
  KEY `bookerNICNo` (`passengerName`),
  KEY `seatNo` (`seatNo`),
  KEY `ticketNo` (`ticketNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Transaction Table is store booking data';

--
-- Dumping data for table `receive_ticke`
--

INSERT INTO `receive_ticke` (`ticketNo`, `passengerName`, `seatNo`, `gender`, `bookingID`) VALUES
('JD4530ACA01500114100136', 'Usre1', 36, 'M', 'JD4530ACA01500114100100'),
('JD4530ACA01500114100137', 'User2', 37, 'M', 'JD4530ACA01500114100100'),
('JD4530ACA01500114101136', 'User1', 36, 'M', 'JD4530ACA01500114101101'),
('JD4530ACA01500114101137', 'Usre1', 37, 'M', 'JD4530ACA01500114101100'),
('NA6890BCA0570021410011', 'user2', 1, 'F', 'NA6890BCA05700214100101'),
('NA6890BCA0570021410012', 'nevil', 2, 'M', 'NA6890BCA05700214100101'),
('NA6890BCA0570021410013', 'user3', 3, 'M', 'NA6890BCA05700214100101'),
('NA6890BCA05700214100145', 'nevil', 45, 'M', 'NA6890BCA05700214100100'),
('NA6890BCA05700214100146', 'user2', 46, 'M', 'NA6890BCA05700214100100'),
('NA6890BCA05700214100749', 'Usre1', 49, 'M', 'NA6890BCA05700214100700'),
('ND2345BAC05700114100736', 'Usre1', 36, 'M', 'ND2345BAC05700114100701'),
('ND2345BAC0570011410113', 'Usre1', 3, 'M', 'ND2345BAC05700114101101'),
('ND2345BAC05700114101136', 'User1', 36, 'M', 'ND2345BAC05700114101103'),
('ND2345BAC05700114101138', 'User3', 38, 'M', 'ND2345BAC05700114101100'),
('ND2345BAC05700114101139', 'User2', 39, 'M', 'ND2345BAC05700114101100'),
('ND2345BAC0570011410114', 'User1', 4, 'M', 'ND2345BAC05700114101104'),
('ND2345BAC05700114101140', 'User1', 40, 'M', 'ND2345BAC05700114101100'),
('ND2345BAC0570011410115', 'User2', 5, 'F', 'ND2345BAC05700114101104'),
('ND2345BAC0570011410117', 'Usre1', 7, 'M', 'ND2345BAC05700114101102');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE IF NOT EXISTS `seat` (
  `seatNo` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Bus Seat Number',
  PRIMARY KEY (`seatNo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Master Table is store Bus Seat Number' AUTO_INCREMENT=50 ;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seatNo`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49);

-- --------------------------------------------------------

--
-- Table structure for table `system_user`
--

CREATE TABLE IF NOT EXISTS `system_user` (
  `userName` varchar(10) NOT NULL COMMENT 'User Name for login to System',
  `empolyeeNo` varchar(8) NOT NULL COMMENT 'Empoyee Number of System User',
  `empolyeeName` varchar(20) NOT NULL COMMENT 'oyee Name of System User',
  `empolyeeMNo` varchar(10) NOT NULL COMMENT 'oyee Mobile Number of System User',
  `password` varchar(250) DEFAULT NULL COMMENT 'Password for login to system',
  `privilege` varchar(8) NOT NULL DEFAULT 'Not User',
  PRIMARY KEY (`userName`),
  KEY `empoyeeName` (`empolyeeName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This Master Table is store System User Data and Login Data';

--
-- Dumping data for table `system_user`
--

INSERT INTO `system_user` (`userName`, `empolyeeNo`, `empolyeeName`, `empolyeeMNo`, `password`, `privilege`) VALUES
('Admin', '001', 'Ranathinge', '0717226079', '2377cfe2fbef92859e299f9272f96e82', 'Admin'),
('Kasun', '003', 'Kasun ', '0717226079', '3fdcf478e92daaf3b2616c58bf1c848a', 'Booker'),
('Nevil', '002', 'Nevil', '0717226079', 'f36792e15aa77db3929334ba62d0974b', 'Operator'),
('Sumith', '004', 'Sumith', '1234567890', '67be81b88c81b956642548553defcff8', 'Conduct');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_bus`
--
ALTER TABLE `assign_bus`
  ADD CONSTRAINT `assign_bus_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `system_user` (`userName`);

--
-- Constraints for table `assign_coductor`
--
ALTER TABLE `assign_coductor`
  ADD CONSTRAINT `assign_coductor_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `system_user` (`userName`),
  ADD CONSTRAINT `assign_coductor_ibfk_2` FOREIGN KEY (`conductorNo`) REFERENCES `conductor` (`conductorNo`);

--
-- Constraints for table `available_seat`
--
ALTER TABLE `available_seat`
  ADD CONSTRAINT `available_seat_ibfk_1` FOREIGN KEY (`seatNo`) REFERENCES `seat` (`seatNo`),
  ADD CONSTRAINT `available_seat_ibfk_2` FOREIGN KEY (`busNo`) REFERENCES `bus` (`busNo`);

--
-- Constraints for table `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`busNo`) REFERENCES `bus` (`busNo`);

--
-- Constraints for table `entrypoint_for_journey`
--
ALTER TABLE `entrypoint_for_journey`
  ADD CONSTRAINT `entrypoint_for_journey_ibfk_2` FOREIGN KEY (`entryPointNo`) REFERENCES `entry_point` (`entryPointNo`),
  ADD CONSTRAINT `entrypoint_for_journey_ibfk_3` FOREIGN KEY (`journeyNo`) REFERENCES `journey` (`journeyNo`);

--
-- Constraints for table `journey_for_bus`
--
ALTER TABLE `journey_for_bus`
  ADD CONSTRAINT `journey_for_bus_ibfk_1` FOREIGN KEY (`busNo`) REFERENCES `bus` (`busNo`),
  ADD CONSTRAINT `journey_for_bus_ibfk_2` FOREIGN KEY (`journeyNo`) REFERENCES `journey` (`journeyNo`);

--
-- Constraints for table `manual_booking`
--
ALTER TABLE `manual_booking`
  ADD CONSTRAINT `manual_booking_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `system_user` (`userName`);

--
-- Constraints for table `receive_ticke`
--
ALTER TABLE `receive_ticke`
  ADD CONSTRAINT `receive_ticke_ibfk_2` FOREIGN KEY (`seatNo`) REFERENCES `seat` (`seatNo`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `expires_booking_seat_delete` ON SCHEDULE EVERY 60 SECOND STARTS '2014-04-22 17:20:29' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM available_seat WHERE (NOW()>addtime(time,'00:11:00') AND status="P")$$

CREATE DEFINER=`root`@`localhost` EVENT `expires_booking_ticke_delete` ON SCHEDULE EVERY 60 SECOND STARTS '2014-04-22 17:20:46' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM booking WHERE (NOW()>s_bookin_time AND payment_status="P")$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
