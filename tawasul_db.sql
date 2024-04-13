-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 07:05 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tawasul_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tawasul_comments`
--

CREATE TABLE `tawasul_comments` (
  `id` int(11) NOT NULL,
  `c_author` varchar(200) NOT NULL,
  `c_post_id` int(200) NOT NULL,
  `c_content` varchar(5000) NOT NULL,
  `c_edited` int(200) NOT NULL,
  `c_time_edited` int(200) NOT NULL,
  `c_time` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tawasul_follow`
--

CREATE TABLE `tawasul_follow` (
  `id` int(200) NOT NULL,
  `acc1` varchar(200) NOT NULL,
  `acc2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tawasul_follow`
--

INSERT INTO `tawasul_follow` (`id`, `acc1`, `acc2`) VALUES
(4, 'ahmedhatem', 'youssefsameh'),
(13, 'youssefsameh', 'ahmedhatem');

-- --------------------------------------------------------

--
-- Table structure for table `tawasul_likes`
--

CREATE TABLE `tawasul_likes` (
  `id` int(200) NOT NULL,
  `post_id` int(200) NOT NULL,
  `liker` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tawasul_likes`
--

INSERT INTO `tawasul_likes` (`id`, `post_id`, `liker`) VALUES
(34, 21, 'ahmedhatem');

-- --------------------------------------------------------

--
-- Table structure for table `tawasul_posts`
--

CREATE TABLE `tawasul_posts` (
  `id` int(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `p_content` varchar(5000) NOT NULL,
  `hashtags` varchar(200) NOT NULL,
  `p_date` date NOT NULL,
  `p_likes` int(200) NOT NULL,
  `p_replies` int(200) NOT NULL,
  `p_reposts` int(200) NOT NULL,
  `p_views` int(200) NOT NULL,
  `p_privacy` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tawasul_posts`
--

INSERT INTO `tawasul_posts` (`id`, `author`, `p_content`, `hashtags`, `p_date`, `p_likes`, `p_replies`, `p_reposts`, `p_views`, `p_privacy`) VALUES
(21, 'youssefsameh', 'hi and welcome sir #welcome_new_users', '', '0000-00-00', 1, 0, 0, 0, 'public'),
(22, 'ahmedhatem', 'Hi, Everyone This is tawasul website where you can post your threads and communicate with others', '', '0000-00-00', 0, 0, 0, 0, 'public'),
(31, 'youssefsameh', 'hey everyone i love you all', '', '0000-00-00', 0, 0, 0, 0, 'public');

-- --------------------------------------------------------

--
-- Table structure for table `tawasul_tags`
--

CREATE TABLE `tawasul_tags` (
  `post_id` bigint(20) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tawasul_users`
--

CREATE TABLE `tawasul_users` (
  `id` int(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `cover_pic` varchar(200) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `followers_num` int(200) NOT NULL,
  `following_num` int(200) NOT NULL,
  `verified` int(200) NOT NULL,
  `online` int(200) NOT NULL,
  `forgot_password_token` varchar(200) NOT NULL,
  `forgot_password_token_expires` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tawasul_users`
--

INSERT INTO `tawasul_users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `country`, `gender`, `dob`, `profile_pic`, `cover_pic`, `bio`, `followers_num`, `following_num`, `verified`, `online`, `forgot_password_token`, `forgot_password_token_expires`) VALUES
(4, 'Youssef', 'Sameh', 'youssefsameh', 'youssefbusiness2003@gmail.com', '78e8f2938f2383e1a95001f586bb49cde343554b', 'EG', 'male', '2003-08-29', '/profile_pic/image.png', '', '', 1, 1, 0, 0, 'ee9f2a8255d541b0adc743800bd9ff9b', '2023-08-29 18:00:59.000000'),
(5, 'Ahmed', 'Hatem', 'ahmedhatem', 'thenikoteams@gmail.com', '78e8f2938f2383e1a95001f586bb49cde343554b', 'AL', 'male', '1995-09-11', '/profile_pic/image.png', '', '', 1, 1, 1, 0, '', '0000-00-00 00:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tawasul_comments`
--
ALTER TABLE `tawasul_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawasul_follow`
--
ALTER TABLE `tawasul_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawasul_likes`
--
ALTER TABLE `tawasul_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawasul_posts`
--
ALTER TABLE `tawasul_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawasul_tags`
--
ALTER TABLE `tawasul_tags`
  ADD PRIMARY KEY (`post_id`,`tag`);

--
-- Indexes for table `tawasul_users`
--
ALTER TABLE `tawasul_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tawasul_comments`
--
ALTER TABLE `tawasul_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tawasul_follow`
--
ALTER TABLE `tawasul_follow`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tawasul_likes`
--
ALTER TABLE `tawasul_likes`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tawasul_posts`
--
ALTER TABLE `tawasul_posts`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tawasul_users`
--
ALTER TABLE `tawasul_users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
