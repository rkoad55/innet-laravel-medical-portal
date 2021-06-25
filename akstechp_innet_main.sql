-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2020 at 05:05 AM
-- Server version: 5.6.49
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akstechp_innet_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `innet_admin_users`
--

CREATE TABLE `innet_admin_users` (
  `id` double DEFAULT NULL,
  `name` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `country` double DEFAULT NULL,
  `state` double DEFAULT NULL,
  `address` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` double DEFAULT NULL,
  `password` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `innet_admin_users`
--

INSERT INTO `innet_admin_users` (`id`, `name`, `middle_name`, `last_name`, `email`, `email_verified_at`, `country`, `state`, `address`, `image`, `contact_no`, `hash`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(31, 'Sulaiman', 'J', 'Jawaid', 'sulaimanj_.spout@gmail.com', '2020-06-27 05:46:33', NULL, NULL, NULL, '/images/doctor/myimagek5ZvxkP8oC.png', '03463229942', 'i80fsFwqsImPEoasBxfkRm8Jw419w0rEdl8qgzNo', 1, '$2y$10$FxTToWI.W/Bm9uQ1HOVJK.zNRPzP7NCVc74ZLokCK0QwfbGr2oqUS', 'k4L0muliKG4Pv3gFobZq92vEnUqOjSHlek6frt74jVWsEOwStHJazWPxsDDa', '2020-06-27 05:09:06', '2020-07-10 20:28:07'),
(32, 'ali', NULL, NULL, 'ali@gmail.com', '2020-06-29 23:32:48', NULL, NULL, NULL, NULL, '03463229942', '02gJ9OfpUpbCRM5oKjQkvrSAh7Z9iLkl6yVoGcRM', 1, '$2y$10$uceYXC5UsnLXZRuO1xl5feB4DcQM348zNUVIG/LKd8S4Ujnwzzep2', '8wyp7du35WoxOhCqWWn7MCRG0FuOrWJhpFZvH7E5bbq2YiKKdUnkXfT6teGz', '2020-06-29 23:32:30', '2020-07-01 03:16:25'),
(34, 'adnan', NULL, NULL, 'adnan@gmail.com', '2020-07-08 22:10:04', NULL, NULL, NULL, NULL, NULL, 'EIibCfqQsCQcsyiAgcQu4m8BLOhVMcXybgOZmypK', 1, '$2y$10$f./ovOpZMtfu9k3wZcU7/OqiNW/3tQwx8kT5IEy.AedswDMuFRvVS', NULL, '2020-07-08 22:09:23', '2020-07-08 22:10:04'),
(35, 'sualiman jawaid', '', '', 'sulaimanj.spout@gmail.com', '2020-07-29 14:56:18', 1, 4, 'Town 32, Street No 15, House No 500', '/images/admin/myimageh699LSCgqS.png', '03463229942', 'WrO4fKkcF8o34SckRRetzBZuKm3PN6Vwz6e6eKb3', 1, '$2y$10$KDVWqgS1TbUU9C1qTEWTm.tnSzMTfsmXDcK52T.bf3dgHrJ93GDMa', NULL, '2020-07-14 16:32:05', '2020-07-29 23:56:18'),
(36, 'sualiman jawaid', NULL, NULL, 'sulaimanj00.spout@gmail.com', '2020-07-29 13:41:17', NULL, NULL, NULL, NULL, NULL, 'cdMkFCd5g8mkyoFs9yxbjU5W7aZtAYqxZXgKiV4X', 1, '$2y$10$5N9JYeYzoAtPlAh5khafV.Y9wxx/p1lJmE.IlQQ1RxEN9SLYI5ve.', NULL, '2020-07-14 16:52:20', '2020-07-14 16:52:20'),
(37, 'sualiman jawaid', NULL, NULL, 'ali1@gmail.com', '2020-07-29 13:41:17', NULL, NULL, NULL, NULL, NULL, '81n4ASG18gsSsIigGnNVnG6pS0iyMDL3E8QsJOtV', 1, '$2y$10$Lm5AC72J5tjK/JWZ7p9QzOPvfTDMf4vSM847EURbwmwH0YAnEVGA.', NULL, '2020-07-14 17:06:26', '2020-07-14 17:06:26'),
(38, 'sualiman jawaid', NULL, NULL, 'ali0099@gmail.com', '2020-07-29 13:41:17', NULL, NULL, NULL, NULL, NULL, 'PjP62JmZS7bp8vfy7EKgOghgU0WiALNhY4V4f10H', 1, '$2y$10$5oYjy6BPJ1l6geDLcho8ce/cdB76DbQWvkU6gvT9Rhj3HG4fVcvw.', NULL, '2020-07-14 17:07:38', '2020-07-14 17:07:38'),
(39, 'sualiman jawaid', NULL, NULL, 'ali01@gmail.com', '2020-07-14 18:19:41', NULL, NULL, NULL, NULL, NULL, 'crJcrwAdj6sW6w5Pk0NZpOW9XMT63A9OECsZe7YX', 1, '$2y$10$/EvnbVHV/qelcLz.wuN87O5qPfS6urXvChebMqamtZQP6qbn5icvK', NULL, '2020-07-14 17:14:42', '2020-07-14 18:19:41');

-- --------------------------------------------------------

--
-- Table structure for table `innet_appointments`
--

CREATE TABLE `innet_appointments` (
  `appointment_id` int(10) NOT NULL,
  `doctor_id` int(10) NOT NULL,
  `patient_id` int(10) NOT NULL,
  `entry_url` varchar(255) DEFAULT NULL,
  `date_time_start` varchar(255) DEFAULT NULL,
  `date_time_end` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_appointments`
--

INSERT INTO `innet_appointments` (`appointment_id`, `doctor_id`, `patient_id`, `entry_url`, `date_time_start`, `date_time_end`, `status`, `created_at`, `updated_at`) VALUES
(4, 31, 31, 'https://coviu.com/session/596a7660-4529-44f7-b59b-3a6f16d833c2', '07/07/2020 01:05 PM', '07/07/2020 01:30 PM', 0, '2020-07-07 13:02:31', '2020-07-07 13:02:31'),
(8, 31, 58, 'https://coviu.com/session/e3c4de14-d635-4898-9260-0fecfc2512b1', '07/08/2020 03:00 PM', '07/08/2020 03:30 PM', 1, '2020-07-08 14:43:01', '2020-07-08 14:43:04'),
(9, 31, 58, 'https://coviu.com/session/ee7bd525-0a7a-4237-a027-995489b9bcbd', '07/08/2020 02:50 PM', '07/08/2020 04:00 PM', 1, '2020-07-08 14:45:43', '2020-07-08 14:45:46'),
(10, 31, 31, 'https://coviu.com/session/0a61f87e-9160-4723-8890-cf9e402ff215', '07/08/2020 05:00 PM', '07/08/2020 05:30 PM', 1, '2020-07-08 16:54:04', '2020-07-08 16:54:06'),
(11, 31, 31, 'https://coviu.com/session/7a122fa3-e7aa-4a5a-b620-ad08be7fa505', '07/08/2020 06:00 PM', '07/08/2020 06:30 PM', 1, '2020-07-08 17:43:20', '2020-07-08 17:43:23'),
(12, 31, 31, 'https://coviu.com/session/b048aa9f-99be-47f4-a6de-9aa75459bf70', '07/10/2020 12:00 PM', '07/10/2020 12:30 PM', 1, '2020-07-10 11:34:55', '2020-07-10 11:34:58'),
(13, 31, 31, 'https://coviu.com/session/5ddcfc09-5192-45c9-8fa5-3792292273c1', '07/10/2020 02:30 PM', '07/10/2020 03:00 PM', 1, '2020-07-10 14:25:45', '2020-07-10 14:25:47'),
(14, 31, 31, 'https://coviu.com/session/173ed82e-8210-4f2c-afd9-ff9eb752e8c4', '07/10/2020 03:00 PM', '07/10/2020 03:30 PM', 1, '2020-07-10 14:26:16', '2020-07-10 14:26:19'),
(15, 31, 31, 'https://coviu.com/session/aacaf374-439c-4b05-9164-51b7ca0520d7', '07/10/2020 05:00 PM', '07/10/2020 05:30 PM', 1, '2020-07-10 16:39:49', '2020-07-10 16:39:52'),
(16, 31, 31, 'https://coviu.com/session/56fc21e6-b1f0-4319-b6ba-c813e5813d8e', '07/10/2020 05:30 PM', '07/10/2020 06:00 PM', 1, '2020-07-10 16:41:19', '2020-07-10 16:41:21'),
(17, 31, 31, 'https://coviu.com/session/c6d7b2a2-05e5-4717-a942-769404913615', '07/10/2020 06:00 PM', '07/10/2020 06:30 PM', 1, '2020-07-10 16:43:55', '2020-07-10 16:43:57'),
(18, 31, 31, 'https://coviu.com/session/a6d66cae-8bcf-44f7-b239-844db0c5a675', '07/10/2020 06:30 PM', '07/10/2020 07:00 PM', 0, '2020-07-10 16:45:32', '2020-07-10 16:45:32'),
(19, 31, 31, 'https://coviu.com/session/b74fdb34-5f0c-44c6-b814-81d724f56cd8', '07/10/2020 06:30 PM', '07/10/2020 07:00 PM', 0, '2020-07-10 16:46:07', '2020-07-10 16:46:07'),
(20, 31, 31, 'https://coviu.com/session/7ebbf516-1260-4602-b484-4af980df5ace', '07/10/2020 06:30 PM', '07/10/2020 07:00 PM', 0, '2020-07-10 16:47:10', '2020-07-10 16:47:10'),
(21, 31, 31, 'https://coviu.com/session/40883102-7741-43f7-9c49-a5e4e6b2348b', '07/10/2020 06:30 PM', '07/10/2020 07:00 PM', 0, '2020-07-10 16:49:51', '2020-07-10 16:49:51'),
(22, 31, 31, 'https://coviu.com/session/9367f351-5fe7-4a07-a3fe-3c1d4fc7a58a', '07/10/2020 06:30 PM', '07/10/2020 07:00 PM', 0, '2020-07-10 16:50:06', '2020-07-10 16:50:06'),
(23, 36, 34, 'https://coviu.com/session/dc0b9c2d-3ce2-43a0-ab6d-fd62a7f04c68', '07/16/2020 07:30 PM', '07/16/2020 08:00 PM', 1, '2020-07-16 19:26:56', '2020-07-16 19:26:57'),
(24, 36, 33, 'https://coviu.com/session/9128468e-9034-4bcb-9db4-fde5b0ee1af0', '07/16/2020 09:00 PM', '07/16/2020 09:30 PM', 1, '2020-07-16 20:52:12', '2020-07-16 20:52:13'),
(25, 31, 36, 'https://coviu.com/session/d324da86-897a-4cc2-afdd-6c0ffcbbcfb2', '07/17/2020 12:00 PM', '07/17/2020 12:30 PM', 1, '2020-07-17 11:35:16', '2020-07-17 11:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `innet_card_detail`
--

CREATE TABLE `innet_card_detail` (
  `id` double DEFAULT NULL,
  `patient_id` double DEFAULT NULL,
  `cc_number` varchar(765) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cvv_number` double DEFAULT NULL,
  `valid_date` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `innet_card_detail`
--

INSERT INTO `innet_card_detail` (`id`, `patient_id`, `cc_number`, `cvv_number`, `valid_date`, `created_at`, `updated_at`) VALUES
(1, 31, '4716 1089 9971 6531', 123, '03/23', '2020-07-16 16:59:16', '2020-07-16 17:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `innet_countries_states`
--

CREATE TABLE `innet_countries_states` (
  `id` int(10) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `child_id` int(10) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_countries_states`
--

INSERT INTO `innet_countries_states` (`id`, `title`, `child_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'United States', NULL, 1, NULL, NULL, NULL),
(2, 'California', 1, 1, NULL, NULL, NULL),
(3, 'Los Angeles', 1, 1, NULL, NULL, NULL),
(4, 'Washington', 1, 1, NULL, NULL, NULL),
(5, 'Texas', 1, 1, NULL, NULL, NULL),
(6, 'Italy', NULL, 1, NULL, NULL, NULL),
(7, 'Trentino', 3, 1, NULL, NULL, NULL),
(8, 'South Tyrol', 3, 1, NULL, NULL, NULL),
(9, 'Province of Verona', 3, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `innet_doctors`
--

CREATE TABLE `innet_doctors` (
  `id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `hr_approval` int(2) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `specialization_id` varchar(100) DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state` int(10) DEFAULT NULL,
  `city` int(10) DEFAULT NULL,
  `experience` int(10) DEFAULT NULL,
  `current_job` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `address` text,
  `note` text,
  `hash` varchar(255) NOT NULL,
  `status` int(2) DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_doctors`
--

INSERT INTO `innet_doctors` (`id`, `name`, `middle_name`, `last_name`, `email`, `hr_approval`, `email_verified_at`, `specialization_id`, `country`, `state`, `city`, `experience`, `current_job`, `image`, `contact_no`, `address`, `note`, `hash`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(31, 'Sulaiman', 'J', 'Jawaid', 'sulaimanj_.spout@gmail.com', 0, '2020-06-27 05:46:33', '2,3', 1, 2, 7, 2, 'software engineer', '/images/doctor/myimagek5ZvxkP8oC.png', '03463229942', 'Town 32, Street No 15, House No 50', '<strong>B.S</strong>. in Computer Science from MAJU and i am currently working as Sr. web developer at Akseer Technologies.', 'i80fsFwqsImPEoasBxfkRm8Jw419w0rEdl8qgzNo', 1, '$2y$10$FxTToWI.W/Bm9uQ1HOVJK.zNRPzP7NCVc74ZLokCK0QwfbGr2oqUS', 'Ep8LmV6tZZSlN2N2vEmcw5sjv2oIEapLhEE84N5pu8wJjsMkN1HvbcXloZsH', '2020-06-27 05:09:06', '2020-07-10 20:28:07'),
(32, 'ali', NULL, NULL, 'ali@gmail.com', 0, '2020-06-29 23:32:48', '1,2,3', 1, 2, 7, 6, 'software engineer', NULL, '03463229942', NULL, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown', '02gJ9OfpUpbCRM5oKjQkvrSAh7Z9iLkl6yVoGcRM', 1, '$2y$10$uceYXC5UsnLXZRuO1xl5feB4DcQM348zNUVIG/LKd8S4Ujnwzzep2', '8wyp7du35WoxOhCqWWn7MCRG0FuOrWJhpFZvH7E5bbq2YiKKdUnkXfT6teGz', '2020-06-29 23:32:30', '2020-07-01 03:16:25'),
(34, 'adnan', NULL, NULL, 'adnan@gmail.com', 0, '2020-07-08 22:10:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EIibCfqQsCQcsyiAgcQu4m8BLOhVMcXybgOZmypK', 1, '$2y$10$f./ovOpZMtfu9k3wZcU7/OqiNW/3tQwx8kT5IEy.AedswDMuFRvVS', NULL, '2020-07-08 22:09:23', '2020-07-08 22:10:04'),
(35, 'sualiman jawaid', NULL, NULL, 'sulaimanj09.spout@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GXWtXl4QBJkCAdFOwc9ApKnkDnqzK0sgaobXUuwp', 1, '$2y$10$Mqy22N3MITDidY52r7xtde24ypl6eFmcj1S/E237H.VCcoyk8D0Vy', NULL, '2020-07-12 16:12:02', '2020-07-12 16:12:02'),
(36, 'sualiman jawaid', '', '', 'sulaimanj.spout@gmail.com', 0, '2020-07-12 16:26:55', '1,3', 1, 2, NULL, NULL, 'software engineer', '/images/doctor/myimageY3BE1Uj5E5.png', '03463229942', 'Town 32, Street No 15, House No 50', '', 'b7nrWFQR125hgHHjNvJ3DKoQ6d2wS0vFpgDz3P6D', 1, '$2y$10$uhaNrXFEz/EFJQDqM3Yb8eYpm9jv5ZBTqhaYfvW3jhwTDQx9LDtSq', NULL, '2020-07-12 16:15:09', '2020-07-16 23:06:27'),
(37, 'Amna', '', '', 'amna.danish@akseertechnologies.com', 0, '2020-07-17 15:23:17', '2', 1, 2, NULL, NULL, 'no', NULL, '000000', '1st Floor, Shaheen Chambers, Sharah-e-Faisal', '', 'kN3nsKL0GAM43kb49cTaXdnG6NaePqWaBX3fbH5X', 0, '$2y$10$REZrebYWEAtMkRb0TQVFYuGtAPtQoFB67/SB8ejoUEipKuyodq1Iu', NULL, '2020-07-17 15:15:22', '2020-07-30 00:49:33'),
(38, 'Rakesh kumar Oad', NULL, NULL, 'rakeshoad268@gmail.com', 0, '2020-12-22 00:36:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Irj6FyKYwXRSXHyTCMlUyWIiZ4IcbqxjUlDei37L', 1, '$2y$10$mANl1L2E.PipokkqJkVXzOQXgIwUG3qLznoVvindMLXtPtV.Kdv0O', NULL, '2020-12-22 00:35:31', '2020-12-22 00:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `innet_doctor_avalibility`
--

CREATE TABLE `innet_doctor_avalibility` (
  `id` int(100) NOT NULL,
  `doctor_id` int(100) NOT NULL,
  `monday` int(100) DEFAULT NULL,
  `monday_start_at` varchar(255) DEFAULT NULL,
  `monday_end_at` varchar(255) DEFAULT NULL,
  `tuesday` int(10) DEFAULT NULL,
  `tuesday_start_at` varchar(255) DEFAULT NULL,
  `tuesday_end_at` varchar(255) DEFAULT NULL,
  `wednesday` int(10) DEFAULT NULL,
  `wednesday_start_at` varchar(255) DEFAULT NULL,
  `wednesday_end_at` varchar(255) DEFAULT NULL,
  `thursday` int(10) DEFAULT NULL,
  `thursday_start_at` varchar(255) DEFAULT NULL,
  `thursday_end_at` varchar(255) DEFAULT NULL,
  `friday` int(10) DEFAULT NULL,
  `friday_start_at` varchar(255) DEFAULT NULL,
  `friday_end_at` varchar(255) DEFAULT NULL,
  `saturday` int(10) DEFAULT NULL,
  `saturday_start_at` varchar(255) DEFAULT NULL,
  `saturday_end_at` varchar(255) DEFAULT NULL,
  `sunday` int(10) DEFAULT NULL,
  `sunday_start_at` varchar(255) DEFAULT NULL,
  `sunday_end_at` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_doctor_avalibility`
--

INSERT INTO `innet_doctor_avalibility` (`id`, `doctor_id`, `monday`, `monday_start_at`, `monday_end_at`, `tuesday`, `tuesday_start_at`, `tuesday_end_at`, `wednesday`, `wednesday_start_at`, `wednesday_end_at`, `thursday`, `thursday_start_at`, `thursday_end_at`, `friday`, `friday_start_at`, `friday_end_at`, `saturday`, `saturday_start_at`, `saturday_end_at`, `sunday`, `sunday_start_at`, `sunday_end_at`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 31, 1, '12:00 AM', '12:30 AM', 1, '01:30 AM', '02:30 PM', 1, '01:00 PM', '08:00 PM', 1, '12:00 AM', '01:00 AM', 1, '12:00 AM', '11:30 PM', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-07-03 12:35:06', '2020-07-10 16:38:25', NULL),
(3, 34, 1, '12:00 AM', '05:00 PM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-07-08 18:12:21', '2020-07-08 18:12:51', NULL),
(4, 36, 1, '07:00 PM', '11:30 PM', 1, '12:00 AM', '11:30 PM', NULL, NULL, NULL, 1, '07:00 PM', '11:30 PM', 1, '07:00 PM', '11:30 PM', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-07-16 19:05:59', '2020-07-16 19:05:59', NULL),
(5, 37, 1, '12:00 AM', '03:30 AM', 1, '12:00 AM', '02:00 AM', 1, '12:00 AM', '02:00 AM', 1, '12:00 AM', '10:00 AM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-07-17 11:24:32', '2020-07-17 11:24:32', NULL),
(6, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-12-21 20:07:29', '2020-12-21 20:07:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `innet_password_resets`
--

CREATE TABLE `innet_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_password_resets`
--

INSERT INTO `innet_password_resets` (`email`, `token`, `created_at`) VALUES
('sulaimanj.spout@gmail.com', '$2y$10$2N/DksbLJot7imclQimReebHh1LDxWRwlvr2Z0qweJJV4Q8/7d8f.', '2020-07-12 16:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `innet_patients`
--

CREATE TABLE `innet_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `hr_approval` int(2) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `depart_id` varchar(100) DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state` int(10) DEFAULT NULL,
  `city` int(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `current_job` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `note` text,
  `hash` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_patients`
--

INSERT INTO `innet_patients` (`id`, `name`, `middle_name`, `last_name`, `email`, `hr_approval`, `email_verified_at`, `depart_id`, `country`, `state`, `city`, `address`, `dob`, `current_job`, `image`, `contact_no`, `note`, `hash`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(31, 'sualiman jawaid', NULL, NULL, 'sulaimanj_.spout@gmail.com', 0, '2020-06-27 05:46:33', '1', 1, 3, NULL, 'town 32, street no 15, house no 50', '2020-04-04', NULL, '/images/patient/myimageLciUpN2wts.png', '03463229942', NULL, 'i80fsFwqsImPEoasBxfkRm8Jw419w0rEdl8qgzNo', '$2y$10$z93EPA7Y85vTTbSXN6oMt..jtlvgnrvo4Or01rNlgadCnVV52wtnS', 'oWOabH8ksiPe62apVGt10cKEWlpFJDfLLa86rJnsynLjUTfVl06PJlXGMNaw', 1, '2020-06-27 05:09:06', '2020-07-29 23:00:37'),
(32, 'ali', NULL, NULL, 'ali@gmail.com', 0, '2020-06-29 23:32:48', '1,2,3', 1, 2, 7, NULL, '0000-00-00', 'software engineer', NULL, '03463229942', 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown', '02gJ9OfpUpbCRM5oKjQkvrSAh7Z9iLkl6yVoGcRM', '$2y$10$M9r7gZ27dLgXNg4Zj9Euye/pXocH8ccy.1ic5BAwWrqlwGlXp178K', 'VBRvGqv0HzcYW7szr7Jge88n5Z8ZclpNAjlrrHXUg6eTsFIPBGrbmVMDG0T5', 1, '2020-06-29 23:32:30', '2020-07-29 23:00:41'),
(33, 'Amna TEST', '', '', 'amna.danish@akseertechnologies.com', 0, '2020-07-14 13:23:03', '2,10', 1, 2, NULL, 'test', '1970-01-01', NULL, NULL, '000000', NULL, '1zE88qPaj19P8zxEWHULVgZYoMOtKV2YWhpaadwV', '$2y$10$Acs0bJOrDr6NxcpQbhbqF.BPEGwMjqf.ac5nyj13pnB8z.y.yQAqG', 'Vm2JuHZqVeL7Ufrmad9lmdlbbojVxubHFaKBTCubbDNPpk8JW2ZIryUow2UR', 1, '2020-07-14 12:51:14', '2020-07-29 23:00:44'),
(34, 'sualiman jawaid', NULL, NULL, 'sulaimanj.spout@gmail.com', 0, '2020-07-14 22:19:25', '1,2', 1, 3, NULL, 'town 32, street no 15, house no 50', '1992-04-04', NULL, '/images/patient/myimages6PjsqFGuu.png', '03463229942', NULL, 'WG8JRUu31vuXuCStiO272SyIgsaVabX4smQIHame', '$2y$10$/42xDaNoOzXLhNDVPdyVzOJDQLTpyzOwGqj.zv3tCv1vO/WPLSuBu', NULL, 1, '2020-07-14 22:07:39', '2020-07-29 23:00:50'),
(35, 'jobs', NULL, NULL, 'jobs@akseertechnologies.com', 0, '2020-07-17 13:31:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9VwD0bKzw9f6W0QCrLEm9BDIPOSFYWZdDgG7u98o', '$2y$10$7yZTZjxEGTUmLQmZzs8fz.9XHY0br06v1W/kfIagPbiAeeRr4D2BC', NULL, 1, '2020-07-17 13:27:22', '2020-07-29 23:00:55'),
(36, 'Ali', '', '', 'bd1@akseertechnologies.com', 0, '2020-07-17 15:31:23', '5', 1, 5, NULL, '1st Floor, Shaheen Chambers, Sharah-e-Faisal', '1994-01-01', NULL, '/images/patient/105769048_797751840965472_3711409524233424008_oC1R1U5l240.jpg', '923132822282', NULL, 'VIq6CprafxUFDvBzzDMnpcQYy6xLBNOgt5OfQdfC', '$2y$10$gU5iDWE53YIOi29kTvnCOeiV2fKq7jDaSHbqDtcZva8PPoHFfs5nq', NULL, 1, '2020-07-17 15:30:41', '2020-07-29 23:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `innet_payments`
--

CREATE TABLE `innet_payments` (
  `id` int(100) NOT NULL,
  `patient_id` int(100) DEFAULT NULL,
  `cc_number` varchar(255) NOT NULL,
  `cvv_number` varchar(100) NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_payments`
--

INSERT INTO `innet_payments` (`id`, `patient_id`, `cc_number`, `cvv_number`, `amount`, `transaction_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 31, '4111111111111111', '1010', '50.00', '5480510031', '2020-07-07 13:02:33', '2020-07-07 13:02:33', NULL),
(7, 31, '4111111111111111', '1010', '50.00', '5480514359', '2020-07-07 13:06:14', '2020-07-07 13:06:14', NULL),
(8, 31, '4111111111111111', '1010', '50.00', '5480533402', '2020-07-07 13:24:18', '2020-07-07 13:24:18', NULL),
(9, 31, '4111111111111111', '1010', '50.00', '5480712670', '2020-07-07 15:50:40', '2020-07-07 15:50:40', NULL),
(10, 56, '4111111111111111', '1010', '50.00', '5480727955', '2020-07-07 16:09:21', '2020-07-07 16:09:21', NULL),
(11, 31, '4111111111111111', '1010', '50.00', '5480789680', '2020-07-07 17:12:39', '2020-07-07 17:12:39', NULL),
(12, 31, '4111111111111111', '1010', '50.00', '5480797637', '2020-07-07 17:17:55', '2020-07-07 17:17:55', NULL),
(13, 31, '4111111111111111', '1010', '50.00', '5482690019', '2020-07-08 13:22:53', '2020-07-08 13:22:53', NULL),
(14, 31, '4111111111111111', '1010', '50.00', '5482742940', '2020-07-08 13:54:44', '2020-07-08 13:54:44', NULL),
(15, 58, '4111111111111111', '1010', '50.00', '5482765305', '2020-07-08 14:17:36', '2020-07-08 14:17:36', NULL),
(16, 58, '4111111111111111', '1010', '50.00', '5482810304', '2020-07-08 14:43:04', '2020-07-08 14:43:04', NULL),
(17, 58, '4111111111111111', '1010', '50.00', '5482814327', '2020-07-08 14:45:46', '2020-07-08 14:45:46', NULL),
(18, 31, '4111111111111111', '1010', '50.00', '5482926993', '2020-07-08 16:54:06', '2020-07-08 16:54:06', NULL),
(19, 31, '4111111111111111', '1010', '50.00', '5482990057', '2020-07-08 17:43:23', '2020-07-08 17:43:23', NULL),
(20, 31, '4111111111111111', '1010', '50.00', '5487007463', '2020-07-10 11:34:58', '2020-07-10 11:34:58', NULL),
(21, 31, '4111111111111111', '1010', '50.00', '5487265748', '2020-07-10 14:25:47', '2020-07-10 14:25:47', NULL),
(22, 31, '4111111111111111', '1010', '50.00', '5487266561', '2020-07-10 14:26:19', '2020-07-10 14:26:19', NULL),
(23, 31, '4111111111111111', '1010', '50.00', '5487542397', '2020-07-10 16:39:52', '2020-07-10 16:39:52', NULL),
(24, 31, '4111111111111111', '1010', '50.00', '5487545969', '2020-07-10 16:41:21', '2020-07-10 16:41:21', NULL),
(25, 31, '4111111111111111', '1010', '50.00', '5487552025', '2020-07-10 16:43:57', '2020-07-10 16:43:57', NULL),
(26, 34, '4111111111111111', '1010', '50.00', '5501764254', '2020-07-16 19:26:57', '2020-07-16 19:26:57', NULL),
(27, 33, '4111111111111111', '1010', '50.00', '5501953641', '2020-07-16 20:52:13', '2020-07-16 20:52:13', NULL),
(28, 36, '4111111111111111', '1010', '50.00', '5503377299', '2020-07-17 11:35:18', '2020-07-17 11:35:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `innet_specilizations`
--

CREATE TABLE `innet_specilizations` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `innet_specilizations`
--

INSERT INTO `innet_specilizations` (`id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Hepatobiliary', NULL, 1, NULL, NULL),
(3, 'Gastroenterology', NULL, 0, NULL, '2020-07-30 09:46:53'),
(4, 'Ophthalmology', NULL, 1, NULL, NULL),
(5, 'Psychiatry', NULL, 1, NULL, NULL),
(6, 'General Surgery', NULL, 0, NULL, '2020-07-30 15:17:27'),
(7, 'Interventional Radiology', NULL, 1, NULL, NULL),
(8, 'Pediatric Intensivist', NULL, 1, NULL, NULL),
(9, 'Palliative Care', NULL, 1, NULL, NULL),
(10, 'Oral Surgery', NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `innet_appointments`
--
ALTER TABLE `innet_appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `innet_countries_states`
--
ALTER TABLE `innet_countries_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innet_doctors`
--
ALTER TABLE `innet_doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `innet_doctor_avalibility`
--
ALTER TABLE `innet_doctor_avalibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innet_password_resets`
--
ALTER TABLE `innet_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `innet_patients`
--
ALTER TABLE `innet_patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `innet_payments`
--
ALTER TABLE `innet_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `innet_specilizations`
--
ALTER TABLE `innet_specilizations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `innet_appointments`
--
ALTER TABLE `innet_appointments`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `innet_countries_states`
--
ALTER TABLE `innet_countries_states`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `innet_doctors`
--
ALTER TABLE `innet_doctors`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `innet_doctor_avalibility`
--
ALTER TABLE `innet_doctor_avalibility`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `innet_patients`
--
ALTER TABLE `innet_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `innet_payments`
--
ALTER TABLE `innet_payments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `innet_specilizations`
--
ALTER TABLE `innet_specilizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
