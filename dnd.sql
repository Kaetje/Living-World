-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2019 at 07:21 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `dnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters`
(
    `ID`            int(11)      NOT NULL AUTO_INCREMENT,
    `CharacterName` varchar(255) NOT NULL,
    `PlayerName`    varchar(255) NOT NULL,
    `Race`          varchar(255) DEFAULT NULL,
    `Class`         varchar(255) DEFAULT NULL,
    `Status`        varchar(255) DEFAULT NULL,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `characters_xpevents`
--

DROP TABLE IF EXISTS `characters_xpevents`;
CREATE TABLE IF NOT EXISTS `characters_xpevents`
(
    `character_id` int(11) NOT NULL,
    `xpevent_id`   int(11) NOT NULL,
    UNIQUE KEY `character_id` (`character_id`, `xpevent_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level_ranges`
--

DROP TABLE IF EXISTS `level_ranges`;
CREATE TABLE IF NOT EXISTS `level_ranges`
(
    `ID`   int(11)      NOT NULL AUTO_INCREMENT,
    `Name` varchar(255) NOT NULL,
    `Min`  int(2)       NOT NULL,
    `Max`  int(2)       NOT NULL,
    PRIMARY KEY (`ID`),
    UNIQUE KEY `Min` (`Min`, `Max`) USING BTREE,
    UNIQUE KEY `Name` (`Name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players`
(
    `ID`         int(11)      NOT NULL AUTO_INCREMENT,
    `PlayerName` varchar(255) NOT NULL,
    PRIMARY KEY (`ID`),
    UNIQUE KEY `PlayerName` (`PlayerName`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players_characters`
--

DROP TABLE IF EXISTS `players_characters`;
CREATE TABLE IF NOT EXISTS `players_characters`
(
    `player_id`    int(11) NOT NULL,
    `character_id` int(11) NOT NULL,
    UNIQUE KEY `character_id` (`character_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions`
(
    `ID`                int(11)      NOT NULL AUTO_INCREMENT,
    `Session_date`      date         NOT NULL,
    `Level_rangeID`     int(11)      NOT NULL,
    `Mission`           varchar(255) NOT NULL,
    `Creation_datetime` datetime     NOT NULL,
    `Stamp_of_approval` tinyint(1)   NOT NULL,
    PRIMARY KEY (`ID`),
    KEY `Level_rangeID` (`Level_rangeID`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions_players`
--

DROP TABLE IF EXISTS `sessions_players`;
CREATE TABLE IF NOT EXISTS `sessions_players`
(
    `sessionID` int(11) NOT NULL,
    `playerID`  int(11) NOT NULL,
    `rol`       int(11) NOT NULL,
    KEY `playerID` (`playerID`),
    KEY `sessionID` (`sessionID`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xpevents`
--

DROP TABLE IF EXISTS `xpevents`;
CREATE TABLE IF NOT EXISTS `xpevents`
(
    `ID`            int(11)      NOT NULL AUTO_INCREMENT,
    `sessionnumber` int(11) DEFAULT NULL,
    `description`   varchar(255) NOT NULL,
    `xpamount`      int(11)      NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
    ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`Level_rangeID`) REFERENCES `level_ranges` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sessions_players`
--
ALTER TABLE `sessions_players`
    ADD CONSTRAINT `sessions_players_ibfk_1` FOREIGN KEY (`playerID`) REFERENCES `players` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `sessions_players_ibfk_2` FOREIGN KEY (`sessionID`) REFERENCES `sessions` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
