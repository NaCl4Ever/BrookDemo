-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2017 at 07:25 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `description` varchar(144) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `description`) VALUES
(1, 'Schools K4-12'),
(2, 'Colleges & Universities'),
(3, 'Worship'),
(4, 'Retail'),
(5, 'Public Works'),
(6, 'Restaurants & Hospitality'),
(7, 'Hospitals & Medical Facilities'),
(8, 'Casinos'),
(9, 'Banks & Business Offices'),
(11, 'Sample'),
(12, 'JB');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `category_id` int(11) NOT NULL,
  `scope` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `category_id`, `scope`) VALUES
(68, 'Look at me', 4, '<p>Whoa this is cool</p>\n'),
(69, 'Whoa this is a cool test', 2, '<p>Exmaple of shiz</p>\n'),
(70, 'example three hundred', 4, '<p>test ne</p>\n'),
(71, 'Jesus plz', 2, '<p>Lorem Ipsum sonnn</p>\n');

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` int(11) NOT NULL,
  `name` varchar(144) NOT NULL,
  `path` varchar(255) NOT NULL,
  `display_picture` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_images`
--

INSERT INTO `project_images` (`id`, `name`, `path`, `display_picture`, `project_id`) VALUES
(55, 'office.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/68/office.jpg', 1, 68),
(56, 'mechanic.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/69/mechanic.jpg', 0, 69),
(57, 'office.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/69/office.jpg', 0, 69),
(58, 'rearTractor.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/69/rearTractor.jpg', 1, 69),
(59, 'mechanic.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/70/mechanic.jpg', 1, 70),
(60, 'office.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/70/office.jpg', 0, 70),
(61, 'rearTractor.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/70/rearTractor.jpg', 0, 70),
(62, 'mechanic.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/71/mechanic.jpg', 0, 71),
(63, 'office.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/71/office.jpg', 0, 71),
(64, 'rearTractor.jpg', '/home/vagrant/shared_data/cakephp/app/webroot/media/71/rearTractor.jpg', 1, 71);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
