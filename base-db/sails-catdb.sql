-- MySQL Sails Code-a-thon DB Script
-- Srirag Nair
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
-- Database: `sails-catdb`

CREATE USER 'sails_db'@'localhost' IDENTIFIED WITH mysql_native_password AS 'Sails1119'; GRANT USAGE ON *.* TO 'sails_db'@'localhost' REQUIRE NONE;

-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `sails-catdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sails-catdb`;

-- --------------------------------------------------------

--
-- Table structure for table `sc_users`
--

DROP TABLE IF EXISTS `sc_users`;
CREATE TABLE IF NOT EXISTS `sc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sc_users`
--

INSERT INTO `sc_users` (`id`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'Srirag', 'Nair', 'srirag', 'sails@123'),
(2, 'Pavan', 'Kumar', 'pavan', 'sails@123'),
(3, 'Kiran', 'AVK', 'avkkiran', 'sails@123'),
(4, 'Kiran', 'Sangita', 'kiran', 'sails@123');
