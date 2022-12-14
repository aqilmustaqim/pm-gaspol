-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2022 at 08:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmgaspol`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_project`
--

CREATE TABLE `detail_project` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_project`
--

INSERT INTO `detail_project` (`id`, `id_project`, `id_users`) VALUES
(3, 1, 11),
(9, 1, 9),
(11, 2, 9),
(13, 2, 14),
(14, 10, 9),
(15, 10, 13),
(16, 10, 11),
(17, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `detail_task`
--

CREATE TABLE `detail_task` (
  `id` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_task`
--

INSERT INTO `detail_task` (`id`, `id_task`, `id_users`) VALUES
(1, 4, 9),
(3, 4, 11),
(4, 5, 9),
(5, 8, 9),
(6, 8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `detail_team`
--

CREATE TABLE `detail_team` (
  `id` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `id_project` int(11) DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_team`
--

INSERT INTO `detail_team` (`id`, `id_team`, `id_project`, `id_users`) VALUES
(14, 1, NULL, 11),
(19, 1, NULL, 9),
(28, 2, NULL, 14),
(35, 1, NULL, 13),
(36, 1, NULL, 14),
(37, 2, NULL, 9),
(39, 2, NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `list_task`
--

CREATE TABLE `list_task` (
  `id` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `list` varchar(225) NOT NULL,
  `status_list` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `list_task`
--

INSERT INTO `list_task` (`id`, `id_task`, `list`, `status_list`) VALUES
(1, 4, 'Create Ajax', 1),
(3, 4, 'CRUD Ajax', 1),
(4, 8, 'Add Plugin', 0),
(5, 8, 'Add Elementor', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-08-15-064415', 'App\\Database\\Migrations\\Users', 'default', 'App', 1660545996, 1),
(2, '2022-08-15-064426', 'App\\Database\\Migrations\\UserRole', 'default', 'App', 1660545996, 1),
(3, '2022-08-22-092822', 'App\\Database\\Migrations\\Position', 'default', 'App', 1661160572, 2),
(4, '2022-08-25-023821', 'App\\Database\\Migrations\\Team', 'default', 'App', 1661395203, 3),
(5, '2022-08-26-030703', 'App\\Database\\Migrations\\DetailTeam', 'default', 'App', 1661483432, 4),
(6, '2022-08-31-073127', 'App\\Database\\Migrations\\Project', 'default', 'App', 1661931332, 5),
(7, '2022-09-01-074631', 'App\\Database\\Migrations\\DetailProject', 'default', 'App', 1662018644, 6),
(8, '2022-09-08-054403', 'App\\Database\\Migrations\\Task', 'default', 'App', 1662615984, 7),
(9, '2022-09-08-090016', 'App\\Database\\Migrations\\DetailTask', 'default', 'App', 1662627738, 8),
(10, '2022-09-14-045013', 'App\\Database\\Migrations\\ListTask', 'default', 'App', 1663131129, 9);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `posisi`) VALUES
(1, 'Web Developer'),
(2, 'Designer');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `id_team` int(11) NOT NULL,
  `nama_project` varchar(225) NOT NULL,
  `deskripsi_project` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `status_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `id_team`, `nama_project`, `deskripsi_project`, `tanggal_mulai`, `batas_waktu`, `status_project`) VALUES
(1, 1, 'Gaspol Project', 'Versi Mobile Dan Website', '2022-09-01', '2022-09-30', 1),
(2, 2, 'APP Sekolah', 'Website Sekolah Dengan Wordpress', '2022-09-01', '2022-09-17', 1),
(10, 1, 'Sekolah Project', 'Membuat Website Sekolah Dengan Wordpress', '2022-09-07', '2022-09-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `nama_task` varchar(225) NOT NULL,
  `deskripsi_task` text NOT NULL,
  `tanggal_task` date NOT NULL,
  `batas_task` date NOT NULL,
  `status_task` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `id_project`, `nama_task`, `deskripsi_task`, `tanggal_task`, `batas_task`, `status_task`) VALUES
(4, 1, 'Fitur Sistem Login', 'Membuat Hak Akses Admin Dan Member', '2022-09-08', '2022-09-10', 0),
(5, 1, 'Fitur Team', 'Membuat CRUD Dan Pengelompokan Member Ke Team', '2022-09-08', '2022-09-18', 0),
(6, 1, 'Membuat Fitur Checklist Add Member', 'Membuat Add Member Dengan Centang Checklist Menggunakan Jquery AJAX', '2022-09-08', '2022-09-24', 0),
(7, 2, 'Fitur Task', 'Membuat Fitur Task Untung Masing Masing Member Sesuai Dengan Team nya', '2022-09-08', '2022-09-12', 0),
(8, 10, 'Install Wordpress', 'Menginstall', '2022-09-14', '2022-09-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `team` varchar(50) NOT NULL,
  `deskripsi_team` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `team`, `deskripsi_team`) VALUES
(1, 'DewaBiz', 'Dewabiz Gaspol'),
(2, 'Pasukan Langit', 'Testes'),
(3, 'sembarang wes', 'sembarang om'),
(4, 'Pasukan Telkom Surabaya', 'Anak Magang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `role_id` int(11) NOT NULL,
  `posisi_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `foto`, `role_id`, `posisi_id`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 'Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '1661049086_e48baacabdb6436d3616.jpg', 1, 1, 1, '2022-08-15 17:02:30', '2022-09-13 14:03:39'),
(9, 'Aqil', 'aqilmustaqim28@gmail.com', '05e48bd6ea6bbb9cf88ce1dd6ddf809d', '1661839947_392d1e09f434fff697ae.jpg', 2, 2, 1, '2022-08-16 11:34:46', '2022-09-13 14:06:33'),
(11, 'Nafi', 'sayanafi@gmail.com', 'b2f5091c7857d122e7ac1ff002fd028c', 'default.png', 3, 2, 1, '2022-08-23 14:05:36', '2022-09-13 14:07:06'),
(13, 'Sapril', 'sayasyahfril@gmail.com', '8f6bb3d2d692ae14f6cb80c69b8ecc01', 'default.png', 3, 1, 1, '2022-08-23 15:12:05', '2022-09-13 14:08:32'),
(14, 'Udennn', 'uden@gmail.com', 'b63c526ed128e72ef7828ca907485e16', 'default.png', 3, 1, 1, '2022-08-24 11:02:28', '2022-09-13 14:09:19'),
(15, 'Angga', 'sayaangga@gmail.com', '$2y$10$DcYMEc1BrWpmiGoINO4SsejOOYFd5/eSVRxxWlUxjLLxKL/HUru5i', 'default.png', 3, 1, 0, '2022-08-24 11:05:41', '2022-08-24 11:05:41'),
(17, 'asd', 'ads@gmail.com', '$2y$10$.ch4pTyd5YQiY/FIKYGIeOOCaho8IO6ZJMFwh.84Vt2kWik30xJGW', 'default.png', 3, 1, 0, '2022-08-24 11:52:22', '2022-08-24 11:52:22'),
(18, 'asdas', 'asd@gmail.com', '$2y$10$czEogViQXT5Uwkx8dHoqxubgSu09BtgHRl2C5lxioBljqXzwoH.JW', 'default.png', 3, 1, 0, '2022-08-24 11:53:06', '2022-08-24 11:53:06'),
(20, 'TesApi', 'tesapi@gmail.com', '$2y$10$cKOrYfRP8Hw6b2gY.54jleOvhEqptpxlsI82Td5m1MT4Z5k1cSJG6', 'default.png', 1, 1, 1, '2022-09-06 10:09:55', '2022-09-06 10:09:55'),
(23, 'Anang', 'anang@gmail.com', '7fea7781ab30e76ab041c7121eaa5cec', 'default.png', 3, 1, 1, '2022-09-13 13:47:58', '2022-09-13 13:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Leader'),
(3, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_project`
--
ALTER TABLE `detail_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_task`
--
ALTER TABLE `detail_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_team`
--
ALTER TABLE `detail_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_task`
--
ALTER TABLE `list_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posisi_id` (`posisi_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_project`
--
ALTER TABLE `detail_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_task`
--
ALTER TABLE `detail_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_team`
--
ALTER TABLE `detail_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `list_task`
--
ALTER TABLE `list_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`posisi_id`) REFERENCES `position` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
