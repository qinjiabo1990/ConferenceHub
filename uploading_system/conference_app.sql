-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-10-28 10:52:57
-- 服务器版本： 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conference_app`
--

-- --------------------------------------------------------

--
-- 表的结构 `ADMIN`
--

CREATE TABLE `ADMIN` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Name` varchar(100) NOT NULL,
  `Admin_Password` varchar(100) NOT NULL,
  `Admin_Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `ADMIN`
--

INSERT INTO `ADMIN` (`Admin_ID`, `Admin_Name`, `Admin_Password`, `Admin_Email`) VALUES
(1, 'admin', 'admin', 'conference.uq@gmail.com'),
(2, 'test', '1234', 'test@163.com'),
(3, 'owner', '1234', 'owner@gmail.com');

-- --------------------------------------------------------

--
-- 表的结构 `CONFERENCE_INFO`
--

CREATE TABLE `CONFERENCE_INFO` (
  `Con_ID` int(11) NOT NULL,
  `Con_Name` varchar(100) NOT NULL,
  `Con_Date` varchar(100) NOT NULL,
  `Con_Address` varchar(100) NOT NULL,
  `Con_Abstract` varchar(5000) NOT NULL,
  `Con_Image` varchar(1000) NOT NULL,
  `Con_Description` varchar(5000) NOT NULL,
  `Admin_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `CONFERENCE_INFO`
--

INSERT INTO `CONFERENCE_INFO` (`Con_ID`, `Con_Name`, `Con_Date`, `Con_Address`, `Con_Abstract`, `Con_Image`, `Con_Description`, `Admin_ID`) VALUES
(2, 'Test conference', '2018-11-12', 'the university of Queensland', 'testing', 'https://imgur.com/eJWjlBx.png', 'this is used to test the whole system', 2),
(3, 'WWW/Internet 2018 Conference', '21-23/10/2018', 'Budapest, Hungary', 'The WWW/Internet 2018 Conference aims to address the main issues of concern within WWW/Internet.', 'https://infs3202-17f1ea70.uqcloud.net/image/www.png', 'WWW and Internet had a huge development in recent years. Aspects of concern are no longer just technical anymore but other aspects have arisen. This conference aims to cover both technological as well as non-technological issues related to these developments.', 3);

-- --------------------------------------------------------

--
-- 表的结构 `EXHIBITORS`
--

CREATE TABLE `EXHIBITORS` (
  `Exhibitors_ID` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL,
  `Exhibitors_Name` varchar(100) NOT NULL,
  `Exhibitors_Description` varchar(100) NOT NULL,
  `Exhibitors_Website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `EXHIBITORS`
--

INSERT INTO `EXHIBITORS` (`Exhibitors_ID`, `Con_ID`, `Exhibitors_Name`, `Exhibitors_Description`, `Exhibitors_Website`) VALUES
(4, 2, 'Google', 'IT company', 'www.google.com'),
(5, 3, 'No Exhibitors', 'Null', 'Null');

-- --------------------------------------------------------

--
-- 表的结构 `FEEDBACK`
--

CREATE TABLE `FEEDBACK` (
  `Feedback_ID` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Feedback_Content` varchar(500) NOT NULL,
  `Feedback_Time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `FEEDBACK`
--

INSERT INTO `FEEDBACK` (`Feedback_ID`, `Con_ID`, `id`, `Feedback_Content`, `Feedback_Time`) VALUES
(1, 2, 1, 'Welcome guys', '2018-10-21'),
(2, 2, 2, 'Hello, everyone!', 'Mon Oct 22 2018 01:34:59 GMT+1000 (AEST)'),
(3, 2, 2, 'Good morning!', 'Mon Oct 22 2018 16:23:18 GMT+1000 (AEST)'),
(4, 2, 4, 'hi ', 'Mon Oct 22 2018 20:24:21 GMT+0800 (CST)'),
(5, 2, 4, 'im so happy', 'Tue Oct 23 2018 17:48:17 GMT+0800 (CST)'),
(6, 3, 3, 'Welcome guys', '2018-10-28'),
(7, 3, 5, 'Hello everyone!', 'Sun Oct 28 2018 20:44:43 GMT+1000 (AEST)');

-- --------------------------------------------------------

--
-- 表的结构 `OTHER_INFO`
--

CREATE TABLE `OTHER_INFO` (
  `Info_ID` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL,
  `Info_Location` varchar(1000) NOT NULL,
  `Info_Address` varchar(500) NOT NULL,
  `Info_Latitude` double NOT NULL,
  `Info_Longitude` double NOT NULL,
  `Info_LatitudeDelta` double NOT NULL,
  `Info_LongitudeDelta` double NOT NULL,
  `Info_WIFI` varchar(1000) NOT NULL,
  `Info_Other` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `OTHER_INFO`
--

INSERT INTO `OTHER_INFO` (`Info_ID`, `Con_ID`, `Info_Location`, `Info_Address`, `Info_Latitude`, `Info_Longitude`, `Info_LatitudeDelta`, `Info_LongitudeDelta`, `Info_WIFI`, `Info_Other`) VALUES
(1, 2, 'Brisbane City Hall', '208, Carmody', -27.468857, 153.023245, 0.1, 0.1, 'it is free', 'nothing'),
(2, 3, 'Novotel Budapest Centrum, Budapest, Hungary.', 'Rakoczi ut 43-45 1088 Budapest, Hungary', 47.49742, 19.072094, 0.1, 0.1, 'No information', 'For more information: http://internet-conf.org/venuehotel-info/');

-- --------------------------------------------------------

--
-- 表的结构 `SCHEDULE`
--

CREATE TABLE `SCHEDULE` (
  `Schedule_ID` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL,
  `Schedule_Title` varchar(500) NOT NULL,
  `Schedule_Description` varchar(1000) NOT NULL,
  `Schedule_Location` varchar(1000) NOT NULL,
  `Schedule_StartTime` varchar(100) NOT NULL,
  `Schedule_EndTime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `SCHEDULE`
--

INSERT INTO `SCHEDULE` (`Schedule_ID`, `Con_ID`, `Schedule_Title`, `Schedule_Description`, `Schedule_Location`, `Schedule_StartTime`, `Schedule_EndTime`) VALUES
(1, 2, 'meeting one', 'test meeting one', 'room 200', '2018-11-12T12:00:00', '2018-11-12T13:00:00'),
(2, 2, 'meeting two', 'test meeting two', 'room 202', '2018-11-12T14:00:00', '2018-11-12T16:00:00'),
(3, 3, 'Welcome Desk', 'closes for lunch - 13:00 to 14:15', 'Room Board', '8:15-21/10/2018', '19:20-21/10/2018'),
(4, 3, 'Session O – Opening Session', 'Profs. Pedro Isaías and Hans Weghorn', 'Room Zsolnay III', '09:45-21/10/2018', '10:00-21/10/2018'),
(5, 3, 'Session KL1 – Keynote Presentation', 'NEW TRENDS OF COMPUTING PLATFORMS: CONVERGENCE VS. DIVERSIFICATION', 'Room Zsolnay III', '10:00-21/10/2018', '11:00-21/10/2018'),
(6, 3, 'Coffee Break', 'take a break', 'Cafe', '11:00-21/10/2018', '11:30-21/10/2018');

-- --------------------------------------------------------

--
-- 表的结构 `SPEAKERS`
--

CREATE TABLE `SPEAKERS` (
  `Speakers_ID` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL,
  `Speakers_Name` varchar(100) NOT NULL,
  `Speakers_Description` varchar(1000) NOT NULL,
  `Speakers_Company` varchar(1000) NOT NULL,
  `Speakers_Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `SPEAKERS`
--

INSERT INTO `SPEAKERS` (`Speakers_ID`, `Con_ID`, `Speakers_Name`, `Speakers_Description`, `Speakers_Company`, `Speakers_Email`) VALUES
(1, 2, 'Tom', 'professor', 'Google', 'tom@gmail.com'),
(2, 2, 'Lily', 'manager', 'Facebook', 'lily@google.com'),
(3, 3, 'Dr. Róbert Lovas', 'Keynote Speaker', 'Deputy Head of Laboratory, Laboratory of Parallel and Distributed Systems, Hungarian Academy of Sciences, Hungary', 'Null');

-- --------------------------------------------------------

--
-- 表的结构 `SPONSORS`
--

CREATE TABLE `SPONSORS` (
  `Sponsors_ID` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL,
  `Sponsors_Name` varchar(100) NOT NULL,
  `Sponsors_Description` varchar(100) NOT NULL,
  `Sponsors_Website` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `SPONSORS`
--

INSERT INTO `SPONSORS` (`Sponsors_ID`, `Con_ID`, `Sponsors_Name`, `Sponsors_Description`, `Sponsors_Website`) VALUES
(1, 2, 'ANZ', 'Bank', 'www.anz.com'),
(2, 2, 'Commonwealth', 'Bank', 'www.can.com'),
(3, 3, 'iadis', 'International Association for Development of the Information Society', 'http://www.iadisportal.org');

-- --------------------------------------------------------

--
-- 表的结构 `USERS_ATTENDANCE`
--

CREATE TABLE `USERS_ATTENDANCE` (
  `Attendance_ID` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Con_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `USERS_ATTENDANCE`
--

INSERT INTO `USERS_ATTENDANCE` (`Attendance_ID`, `id`, `Con_ID`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 4, 2),
(4, 3, 3),
(5, 5, 3);

-- --------------------------------------------------------

--
-- 表的结构 `USERS_INFO`
--

CREATE TABLE `USERS_INFO` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `USERS_INFO`
--

INSERT INTO `USERS_INFO` (`id`, `username`, `password`, `email`) VALUES
(1, 'test', '1234', 'test@163.com'),
(2, 'Test', '1234', 'Test@google.com'),
(3, 'onwer', '1234', 'owner@gmail.com'),
(4, 'bob', '1234', 'bob@gmail.com'),
(5, 'Qin', '1234', 'Qin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `CONFERENCE_INFO`
--
ALTER TABLE `CONFERENCE_INFO`
  ADD PRIMARY KEY (`Con_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `EXHIBITORS`
--
ALTER TABLE `EXHIBITORS`
  ADD PRIMARY KEY (`Exhibitors_ID`),
  ADD KEY `Con_ID` (`Con_ID`);

--
-- Indexes for table `FEEDBACK`
--
ALTER TABLE `FEEDBACK`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `Con_ID` (`Con_ID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `OTHER_INFO`
--
ALTER TABLE `OTHER_INFO`
  ADD PRIMARY KEY (`Info_ID`),
  ADD KEY `Con_ID` (`Con_ID`);

--
-- Indexes for table `SCHEDULE`
--
ALTER TABLE `SCHEDULE`
  ADD PRIMARY KEY (`Schedule_ID`),
  ADD KEY `Con_ID` (`Con_ID`);

--
-- Indexes for table `SPEAKERS`
--
ALTER TABLE `SPEAKERS`
  ADD PRIMARY KEY (`Speakers_ID`),
  ADD KEY `Con_ID` (`Con_ID`);

--
-- Indexes for table `SPONSORS`
--
ALTER TABLE `SPONSORS`
  ADD PRIMARY KEY (`Sponsors_ID`),
  ADD KEY `Con_ID` (`Con_ID`);

--
-- Indexes for table `USERS_ATTENDANCE`
--
ALTER TABLE `USERS_ATTENDANCE`
  ADD PRIMARY KEY (`Attendance_ID`),
  ADD KEY `Con_ID` (`Con_ID`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `USERS_INFO`
--
ALTER TABLE `USERS_INFO`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `ADMIN`
--
ALTER TABLE `ADMIN`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `EXHIBITORS`
--
ALTER TABLE `EXHIBITORS`
  MODIFY `Exhibitors_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `FEEDBACK`
--
ALTER TABLE `FEEDBACK`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `OTHER_INFO`
--
ALTER TABLE `OTHER_INFO`
  MODIFY `Info_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `SCHEDULE`
--
ALTER TABLE `SCHEDULE`
  MODIFY `Schedule_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `SPEAKERS`
--
ALTER TABLE `SPEAKERS`
  MODIFY `Speakers_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `SPONSORS`
--
ALTER TABLE `SPONSORS`
  MODIFY `Sponsors_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `USERS_ATTENDANCE`
--
ALTER TABLE `USERS_ATTENDANCE`
  MODIFY `Attendance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `USERS_INFO`
--
ALTER TABLE `USERS_INFO`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 限制导出的表
--

--
-- 限制表 `CONFERENCE_INFO`
--
ALTER TABLE `CONFERENCE_INFO`
  ADD CONSTRAINT `conference_info_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `ADMIN` (`Admin_ID`) ON DELETE CASCADE;

--
-- 限制表 `EXHIBITORS`
--
ALTER TABLE `EXHIBITORS`
  ADD CONSTRAINT `exhibitors_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE;

--
-- 限制表 `FEEDBACK`
--
ALTER TABLE `FEEDBACK`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`id`) REFERENCES `USERS_INFO` (`id`);

--
-- 限制表 `OTHER_INFO`
--
ALTER TABLE `OTHER_INFO`
  ADD CONSTRAINT `other_info_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE;

--
-- 限制表 `SCHEDULE`
--
ALTER TABLE `SCHEDULE`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE;

--
-- 限制表 `SPEAKERS`
--
ALTER TABLE `SPEAKERS`
  ADD CONSTRAINT `speakers_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE;

--
-- 限制表 `SPONSORS`
--
ALTER TABLE `SPONSORS`
  ADD CONSTRAINT `sponsors_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE;

--
-- 限制表 `USERS_ATTENDANCE`
--
ALTER TABLE `USERS_ATTENDANCE`
  ADD CONSTRAINT `users_attendance_ibfk_1` FOREIGN KEY (`Con_ID`) REFERENCES `CONFERENCE_INFO` (`Con_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_attendance_ibfk_2` FOREIGN KEY (`id`) REFERENCES `USERS_INFO` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
