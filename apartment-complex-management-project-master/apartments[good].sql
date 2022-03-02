-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2021 at 06:35 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartments`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_insert` (IN `BLOCK` VARCHAR(5), IN `APTNUM` VARCHAR(5), OUT `RESULT` INT)  BEGIN
	IF EXISTS(SELECT 1 FROM RESIDENT WHERE PREFERRED_BLOCK = BLOCK AND PREFERRED_APT = APTNUM) THEN
    	SET RESULT = -1;
    ELSE
    	SET RESULT = 1;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `SL_NO` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `TIMESTAMP` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`SL_NO`, `EMAIL`, `NAME`, `PASSWORD`, `TIMESTAMP`) VALUES
(1, 'abc@goo.com', 'Def', '8cb2237d0679ca88db6464eac60da96345513964', 1543566372),
(2, 'ankurramaswamy@gmail.com', 'Ankur Ramaswamy', 'b8c4cb3b3523dd3adfd125ad641519815f5e3611', 1636047251),
(3, 'archie.mui@gmail.com', 'Archie', 'ad9dfd8561c170a7d24242a75a608c7d9f6e4adb', 1543562639),
(4, 'arnav.kumar@gmail.com', 'Arnav Kumar', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 1543566608),
(5, 'mariorui@yahoo.co.uk', 'Mario Rui', '2356489604f8fa47680e950d8de0cc8fe2165a48', 0),
(6, 'ishani.becs.16@acharya.ac.in', 'Ishani Singh', '79b7a1f0e626743f30ab6572ba4561b60dc7ec29', 1572973132),
(7, 'djack@test.com', 'Big Brother', 'cc2f73a5ee4d1991bb41fa22166541cb33fb09c8', 1636047277);

-- --------------------------------------------------------

--
-- Table structure for table `apartment_details`
--

CREATE TABLE `apartment_details` (
  `BLOCK` varchar(5) NOT NULL,
  `APT_NUM` varchar(5) NOT NULL,
  `BHK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apartment_details`
--

INSERT INTO `apartment_details` (`BLOCK`, `APT_NUM`, `BHK`) VALUES
('A-1', '001', 3),
('A-1', '002', 3),
('A-1', '003', 3),
('A-1', '101', 3),
('A-1', '102', 3),
('A-1', '103', 3),
('A-1', '201', 3),
('A-1', '202', 3),
('A-1', '203', 3),
('A-2', '001', 3),
('A-2', '002', 3),
('A-2', '003', 3),
('A-2', '101', 3),
('A-2', '102', 3),
('A-2', '103', 3),
('A-2', '201', 3),
('A-2', '202', 3),
('A-2', '203', 3),
('A-3', '001', 3),
('A-3', '002', 3),
('A-3', '003', 3),
('A-3', '101', 3),
('A-3', '102', 3),
('A-3', '103', 3),
('A-3', '201', 3),
('A-3', '202', 3),
('A-3', '203', 3),
('B-1', '001', 4),
('B-1', '002', 4),
('B-1', '003', 4),
('B-1', '101', 4),
('B-1', '102', 4),
('B-1', '103', 4),
('B-1', '201', 4),
('B-1', '202', 4),
('B-1', '203', 4),
('B-2', '001', 4),
('B-2', '002', 4),
('B-2', '003', 4),
('B-2', '101', 4),
('B-2', '102', 4),
('B-2', '103', 4),
('B-2', '201', 4),
('B-2', '202', 4),
('B-2', '203', 4),
('B-3', '001', 4),
('B-3', '002', 4),
('B-3', '003', 4),
('B-3', '101', 4),
('B-3', '102', 4),
('B-3', '103', 4),
('B-3', '201', 4),
('B-3', '202', 4),
('B-3', '203', 4),
('C-1', '001', 2),
('C-1', '002', 2),
('C-1', '003', 2),
('C-1', '101', 2),
('C-1', '102', 2),
('C-1', '103', 2),
('C-1', '201', 2),
('C-1', '202', 2),
('C-1', '203', 2),
('C-2', '001', 2),
('C-2', '002', 2),
('C-2', '003', 2),
('C-2', '101', 2),
('C-2', '102', 2),
('C-2', '103', 2),
('C-2', '201', 2),
('C-2', '202', 2),
('C-2', '203', 2),
('C-3', '001', 2),
('C-3', '002', 2),
('C-3', '003', 2),
('C-3', '101', 2),
('C-3', '102', 2),
('C-3', '103', 2),
('C-3', '201', 2),
('C-3', '202', 2),
('C-3', '203', 2);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `COMPLAINT_ID` int(11) NOT NULL,
  `APT_BLOCK` varchar(5) NOT NULL,
  `APT_NUM` varchar(5) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `SUBJECT` varchar(15) NOT NULL,
  `COMP_BODY` text NOT NULL,
  `DATE_FILED` date NOT NULL,
  `COMP_STATUS` varchar(25) NOT NULL DEFAULT 'NOT RESOLVED',
  `TIMESTAMP` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`COMPLAINT_ID`, `APT_BLOCK`, `APT_NUM`, `NAME`, `SUBJECT`, `COMP_BODY`, `DATE_FILED`, `COMP_STATUS`, `TIMESTAMP`) VALUES
(8, 'A-1', '203', 'Herta Thao', 'General', 'Neighbours at 003 parties late into the night.', '2018-11-30', 'SCHEDULED FOR RESOLUTION', 1543566181),
(9, 'A-1', '003', 'Denis Herbert Sage', 'General', 'Resident at 001 lies about everything.', '2018-11-30', 'NOT RESOLVED', 1543562770),
(10, 'A-3', '201', 'Thomas Schumer', 'Dry Repairs', 'Cement getting scraped off at multiple places.', '2018-11-30', 'SCHEDULED FOR RESOLUTION', 1543600025),
(11, 'B-1', '002', 'Ravi Prasad', 'General', 'Ms. Mui has not been helpful at all. All my complaints have been turned a deaf ear to.', '2018-11-30', 'DROPPED', 1543566150),
(12, 'B-2', '102', 'Sonia Gandhi', 'Dry Repairs', 'Bedroom window broken.', '2018-11-30', 'RESOLVED', 1543594625),
(13, 'A-1', '002', 'Ankur Ramaswamy', 'Drinking Water', 'No pure water supply in my apartment.', '2018-11-30', 'SCHEDULED FOR RESOLUTION', 1572969802),
(14, 'A-1', '203', 'Herta Thao', 'Drinking Water', 'No supply of drinking water', '2018-11-30', 'NOT RESOLVED', 1543600177),
(15, 'A-1', '203', 'Herta Thao', 'Wet Repairs', 'Bathroom drainage broken.', '2018-12-02', 'SCHEDULED FOR RESOLUTION', 1572969703),
(16, 'C-1', '002', 'Rupa Ramaswamy', 'Dry Repairs', 'ABC', '2018-12-03', 'RESOLVED', 1543823679);

--
-- Triggers `complaints`
--
DELIMITER $$
CREATE TRIGGER `comp_on_resolution` AFTER UPDATE ON `complaints` FOR EACH ROW BEGIN
    IF EXISTS (SELECT 1 FROM complaints WHERE OLD.COMP_STATUS = 'SCHEDULED FOR RESOLUTION' AND NEW.COMP_STATUS = 'RESOLVED') THEN
    	DELETE FROM comp_resolution WHERE COMPLAINT_ID = OLD.COMPLAINT_ID;
    END IF; 
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comp_resolution`
--

CREATE TABLE `comp_resolution` (
  `COMPLAINT_ID` int(11) NOT NULL,
  `COMP_SUBJECT` text NOT NULL,
  `COMP_HANDLER` varchar(150) NOT NULL,
  `HANDLER_PHONE` bigint(20) NOT NULL,
  `TIMESTAMP` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comp_resolution`
--

INSERT INTO `comp_resolution` (`COMPLAINT_ID`, `COMP_SUBJECT`, `COMP_HANDLER`, `HANDLER_PHONE`, `TIMESTAMP`) VALUES
(8, 'General', 'Arnav Kumar', 978984798, 1543566181),
(10, 'Dry Repairs', 'Rajesh C', 9887756651, 1543600025),
(13, 'Drinking Water', 'Kumar Proteek', 6942069420, 1572969802),
(15, 'Wet Repairs', 'Prashanth', 6969696969, 1572969703);

--
-- Triggers `comp_resolution`
--
DELIMITER $$
CREATE TRIGGER `comp_on_resolve` AFTER INSERT ON `comp_resolution` FOR EACH ROW BEGIN
    	UPDATE complaints SET COMP_STATUS = "SCHEDULED FOR RESOLUTION", TIMESTAMP = NEW.TIMESTAMP WHERE COMPLAINT_ID = NEW.COMPLAINT_ID;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `formerresident`
--

CREATE TABLE `formerresident` (
  `RES_ID` int(11) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `PHONE_NO` bigint(20) NOT NULL,
  `EMAILID` varchar(150) NOT NULL DEFAULT 'OPTED OUT',
  `FEEDBACK` text DEFAULT NULL,
  `EXITTIMESTAMP` bigint(20) DEFAULT NULL,
  `DURATIONTIMESTAMP` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formerresident`
--

INSERT INTO `formerresident` (`RES_ID`, `NAME`, `PHONE_NO`, `EMAILID`, `FEEDBACK`, `EXITTIMESTAMP`, `DURATIONTIMESTAMP`) VALUES
(3, 'Angela Merkel', 5465478952, 'merkel@gmail.de', 'Null', 1541866034, 1383871),
(4, 'Joleen Coyne', 7945620130, 'OPTED OUT', 'The complex is perfect. No significant improvements whatsoever are required.', 1541926248, 97648),
(7, 'Ching Osburn', 1234559876, 'chingchong@bingbong.com', 'Null', 1541926811, 1321739),
(9, 'Lauri Chau', 9875623568, 'chau911@koreanmilitaryservices.org', 'Null', 1541932615, 1891022),
(11, 'Delilah Jones', 9785642364, 'delilah.9001@gmail.com', 'Null', 1541933426, 1316612),
(15, 'Ben Dovernaugh', 5465465465, 'bendover@outlook.uk', 'Solar panels need improvement.', 1542007563, 27),
(16, 'Mike Hunt', 9785512365, 'mike@w3wildhunt.com', 'Null', 1542021314, 77188),
(17, 'Arnav Kumar', 1234586558, 'OPTED OUT', 'The pipes around my building are too leaky. A lot of repairs and to no avail.', 1542098407, 1416974),
(19, 'Charles Dickens', 5648484799, 'charles@gmail.com', 'Have to improve on the drinking water supply.', 1543594458, 173641);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `GUID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `APT_BLOCK` varchar(10) NOT NULL,
  `APT_NUM` varchar(5) NOT NULL,
  `REASON` text NOT NULL,
  `PHONE` varchar(15) NOT NULL,
  `DATE_OE` varchar(15) NOT NULL,
  `TIME_OE` varchar(15) NOT NULL,
  `TIMESTAMP` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`GUID`, `NAME`, `APT_BLOCK`, `APT_NUM`, `REASON`, `PHONE`, `DATE_OE`, `TIME_OE`, `TIMESTAMP`) VALUES
(2, 'Mr. Abhay Partap Singh', 'A-1', '002', 'Vacation', '8897846547', '30-11-2018', '13:48', 1543565891),
(4, 'Ms. Herta Thao', 'A-1', '003', 'Debate', '9696969696', '30-11-2018', '13:50', 1543566057),
(6, 'Mr. Arnav', 'A-1', '002', 'Vacation', '8555555', '03-12-2018', '13:23', 1543823595),
(7, 'Ms. Grilz', 'A-1', '002', 'Murder', '9788564771', '05-11-2019', '21:36', 1572969963);

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `RES_ID` int(11) NOT NULL,
  `TITLE` varchar(5) NOT NULL,
  `FULLNAME` varchar(100) NOT NULL,
  `LNAME` varchar(100) NOT NULL,
  `DOB` varchar(15) NOT NULL,
  `PHONE_NO` bigint(20) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PREV_ADDRESS` varchar(100) NOT NULL,
  `PREFERRED_BLOCK` varchar(3) NOT NULL,
  `PREFERRED_APT` varchar(3) NOT NULL,
  `REG_TIMESTAMP` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`RES_ID`, `TITLE`, `FULLNAME`, `LNAME`, `DOB`, `PHONE_NO`, `EMAIL`, `PREV_ADDRESS`, `PREFERRED_BLOCK`, `PREFERRED_APT`, `REG_TIMESTAMP`) VALUES
(1, 'Mr. ', 'Ankur Ramaswamy', 'Ramaswamy', '1998-09-20', 8420266206, 'ankurramaswamy@gmail.com', 'Kolkata', 'A-1', '002', 1541859214),
(2, 'Mr. ', 'Thomas Schumer', 'Schumer', '1970-01-01', 4567891230, 'schumer@bizcorp.com', 'Houston', 'A-3', '201', 1541860074),
(5, 'Mrs. ', 'Herta Thao', 'Thao', '1990-08-20', 9988774455, 'herta.thao.90@gmail.com', 'Beijing', 'A-1', '203', 1541926500),
(6, 'Mr. ', 'Denis Herbert Sage', 'Sage', '1969-09-19', 8855452130, 'sage@herbertschildtcorp.org', 'London, UK', 'A-1', '003', 1541926739),
(8, 'Mr. ', 'Ravi Prasad', 'Prasad', '1956-02-01', 9788656412, 'raviprasad1911@gmail.com', 'Amritsar', 'B-1', '002', 1541926866),
(10, 'Mrs. ', 'Sonia Gandhi', 'Gandhi', '1962-05-10', 9778546231, 'sonia.gandhi.legit@gmail.com', 'New Delhi', 'B-2', '102', 1541932645),
(18, 'Mrs. ', 'Rupa Ramaswamy', 'Ramaswamy', '1969-01-10', 9855654225, 'rupar973@gmail.com', 'Kolkata', 'C-1', '002', 1543526094);

--
-- Triggers `resident`
--
DELIMITER $$
CREATE TRIGGER `resident_on_delete` AFTER DELETE ON `resident` FOR EACH ROW BEGIN
	INSERT INTO formerresident(RES_ID,NAME,PHONE_NO) VALUES(OLD.RES_ID,OLD.FULLNAME,OLD.PHONE_NO);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`SL_NO`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `apartment_details`
--
ALTER TABLE `apartment_details`
  ADD PRIMARY KEY (`BLOCK`,`APT_NUM`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`COMPLAINT_ID`),
  ADD KEY `Apt_Const` (`APT_BLOCK`,`APT_NUM`);

--
-- Indexes for table `comp_resolution`
--
ALTER TABLE `comp_resolution`
  ADD PRIMARY KEY (`COMPLAINT_ID`);

--
-- Indexes for table `formerresident`
--
ALTER TABLE `formerresident`
  ADD UNIQUE KEY `RES_ID` (`RES_ID`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`GUID`),
  ADD KEY `GID` (`APT_BLOCK`,`APT_NUM`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`RES_ID`),
  ADD UNIQUE KEY `PREFERRED_BLOCK` (`PREFERRED_BLOCK`,`PREFERRED_APT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `SL_NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `COMPLAINT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `GUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `RES_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `Apt_Const` FOREIGN KEY (`APT_BLOCK`,`APT_NUM`) REFERENCES `resident` (`PREFERRED_BLOCK`, `PREFERRED_APT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comp_resolution`
--
ALTER TABLE `comp_resolution`
  ADD CONSTRAINT `CRID` FOREIGN KEY (`COMPLAINT_ID`) REFERENCES `complaints` (`COMPLAINT_ID`) ON DELETE CASCADE;

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `GID` FOREIGN KEY (`APT_BLOCK`,`APT_NUM`) REFERENCES `resident` (`PREFERRED_BLOCK`, `PREFERRED_APT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resident`
--
ALTER TABLE `resident`
  ADD CONSTRAINT `BLAPT` FOREIGN KEY (`PREFERRED_BLOCK`,`PREFERRED_APT`) REFERENCES `apartment_details` (`BLOCK`, `APT_NUM`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
