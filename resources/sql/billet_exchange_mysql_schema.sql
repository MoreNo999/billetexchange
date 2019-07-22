-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2019 at 05:59 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_billetexch`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE `Accounts` (
  `UserID` int(255) NOT NULL,
  `Username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Passwd` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LastName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Rank` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Unit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PhoneNumber` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PASCode` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `BilletEntry`
--

CREATE TABLE `BilletEntry` (
  `ID` int(255) NOT NULL,
  `OwnerID` int(255) NOT NULL,
  `OutAFSC` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `OutRank` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `OutSEI` varchar(25) COLLATE utf32_unicode_ci DEFAULT NULL,
  `OutSkillLevel` int(1) DEFAULT NULL,
  `InAFSC` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `InRank` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `InSEI` varchar(25) COLLATE utf32_unicode_ci DEFAULT NULL,
  `InSkillLevel` int(1) DEFAULT NULL,
  `PositionNumber` varchar(25) COLLATE utf32_unicode_ci DEFAULT NULL,
  `Description` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `DatePosted` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `Views` int(255) NOT NULL,
  `Clicks` int(255) NOT NULL,
  `Status` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `ID` int(255) NOT NULL,
  `Type` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ParentID` int(255) NOT NULL,
  `PosterID` int(255) NOT NULL,
  `PostDate` datetime(6) NOT NULL,
  `PostContent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Views` int(255) NOT NULL,
  `Clicks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Matches`
--

CREATE TABLE `Matches` (
  `ID` int(255) NOT NULL,
  `PostAKey` int(255) NOT NULL,
  `PostBKey` int(255) NOT NULL,
  `MatchDate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `MatchDetails` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `BilletEntry`
--
ALTER TABLE `BilletEntry`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Owner ID` (`OwnerID`) USING BTREE;

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Parent ID` (`ParentID`),
  ADD UNIQUE KEY `Poster ID` (`PosterID`);

--
-- Indexes for table `Matches`
--
ALTER TABLE `Matches`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Post A Key` (`PostAKey`) USING BTREE,
  ADD KEY `Post B Key` (`PostBKey`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Accounts`
--
ALTER TABLE `Accounts`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `BilletEntry`
--
ALTER TABLE `BilletEntry`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Matches`
--
ALTER TABLE `Matches`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1269;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
