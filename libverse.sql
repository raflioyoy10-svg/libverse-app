-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 19, 2026 at 01:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL DEFAULT '1',
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `kategori_id`, `stok`, `gambar`, `link_pdf`, `created_at`, `updated_at`, `is_active`) VALUES
(2, 'Si Kancil Pencuri Timun emas', 'Wikipedia', 2, 2, '1764857944_kancil.jfif', 'http://127.0.0.1:8000/storage/pdf/sikancil.pdf', NULL, NULL, 0),
(4, 'Empat langkah Pengampunan', 'wikipedia', 1, 0, '1765419561_Pengampunan.jpg', 'http://127.0.0.1:8000/storage/pdf/Pengampunan.pdf', NULL, NULL, 0),
(5, 'Madilog', 'Tan Malaka', 1, 2, '1768401408_Madilog tan Malaka.jfif', NULL, NULL, NULL, 1),
(6, 'Si Kancil Pencuri Timun emas', 'wikipedia', 2, 1, '1768144302_1764857944_kancil.jfif', NULL, NULL, NULL, 1),
(7, 'Alice in Wonderland', 'wikipedia', 2, 2, '1768220895_Alice in Wonderland.jfif', NULL, NULL, NULL, 1),
(8, 'Kancil Raja Rimba', 'wikipedia', 2, 2, '1768220939_kancil raja rimba.jfif', NULL, NULL, NULL, 1),
(9, 'Dongeng si Domba', 'wikipedia', 2, 2, '1768220967_dongeng domba.jfif', NULL, NULL, NULL, 1),
(10, 'Dongeng anak Nusantara', 'wikipedia', 2, 2, '1768220999_dongeng anak nusantara.jfif', NULL, NULL, NULL, 1),
(11, 'Dongeng Putri Salju', 'wikipedia', 2, 2, '1768221049_dongeng putri salju.jfif', NULL, NULL, NULL, 1),
(12, 'Bintang dan Planet', 'AntariksaID', 1, 2, '1768221299_p. Bintang Dan Pelanet.jfif', NULL, NULL, NULL, 1),
(13, 'Langit dan Cuaca', 'wikipedia', 1, 2, '1768221334_p. Langit dan Cuaca.jfif', NULL, NULL, NULL, 1),
(14, 'Ilmu Pengetahuan Budaya', 'wikipedia', 1, 2, '1768221378_p.Ilmu pengetahuan budaya.jfif', NULL, NULL, NULL, 1),
(15, 'Filsafat', 'Thales', 1, 2, '1768221438_p.Filsafat.jfif', NULL, NULL, NULL, 1),
(16, 'Sejarah Pengetahuan Abad 20', 'wikipedia', 1, 2, '1768221471_p. Sejarah % Pengetahuan Abad 20.jfif', NULL, NULL, NULL, 1),
(17, 'FERALS', 'wikipedia', 3, 2, '1768221745_1. FERALS.jfif', NULL, NULL, NULL, 1),
(18, 'Into The Wild', 'Wikipedia', 3, 1, '1768221769_1. Into the Wild.jfif', NULL, NULL, NULL, 1),
(19, 'Into The Wild', 'Wikipedia', 3, 2, '1768221770_1. Into the Wild.jfif', NULL, NULL, NULL, 0),
(20, 'Petualangan di Gedung Aneh', 'wikipedia', 3, 2, '1768221809_1. Petualangan di gedung aneh.jfif', NULL, NULL, NULL, 1),
(21, 'The Wizards of Once', 'wikipedia', 3, 2, '1768221851_1.The wizards of once.jfif', NULL, NULL, NULL, 1),
(22, 'Tom Swayer Adventure', 'wikipedia', 3, 2, '1768221876_1.Tom sawayer.jfif', NULL, NULL, NULL, 1),
(23, 'Petualangan Meru di Tanah Papua', 'wikipedia', 3, 2, '1768221905_1. Petualangan Meru di tanah papua.jfif', NULL, NULL, NULL, 1),
(24, 'Petualangan di Lembah Maut', 'wikipedia', 3, 2, '1768221933_1. Petualangan dilembah maut.jfif', NULL, NULL, NULL, 1),
(25, 'Sumur Sebuah Cerita', 'wikipedia', 4, 2, '1768400861_N.Sumur sebuah Cerita.jfif', NULL, NULL, NULL, 1),
(26, 'Cantik itu Luka', 'Eka Kurniawan', 4, 2, '1768400898_N.cantik itu Luka EKA KURNIAWAN.jfif', NULL, NULL, NULL, 1),
(27, 'Seribu Wajah Ayah', 'wikipedia', 4, 2, '1768400937_N.Seribu wajah ayah.jfif', NULL, NULL, NULL, 1),
(28, 'Layangan Putus', 'MOMMY ASF', 4, 1, '1768400980_N.Layangan putus MOMMY ASF.jfif', NULL, NULL, NULL, 1),
(29, 'Pulang Pergi', 'wikipedia', 4, 2, '1768401196_N.Pulang Pergi Tere Liye.jfif', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1, 'Pengetahuan'),
(2, 'Dongeng'),
(3, 'Petualangan'),
(4, 'Novel'),
(5, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_25_120658_create_kategori_table', 1),
(5, '2025_11_25_120758_create_buku_table', 1),
(6, '2025_11_25_120834_create_pinjam_table', 1),
(7, '2025_11_25_120859_create_pengembalian_table', 1),
(8, '2025_11_25_120932_create_ulasan_table', 1),
(9, '2025_11_26_134036_add_timestamps_to_users_table', 2),
(10, '2025_12_02_124055_add_gambar_to_buku_table', 3),
(11, '2025_12_02_133205_add_file_buku_to_buku_table', 4),
(12, '2025_12_02_135038_add_timestamps_to_buku_table', 5),
(13, '2026_01_07_144214_create_notifikasi_table', 6),
(14, '2026_01_09_033121_drop_file_buku_from_buku_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pesan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `pesan`, `dibaca`, `created_at`, `updated_at`) VALUES
(1, 7, '⛔ Masa pinjam buku \"Si Kancil Pencuri Timun\" telah HABIS', 0, '2026-01-07 18:11:37', '2026-01-07 18:11:37'),
(2, 5, '✅ Peminjaman buku \"Empat Langkah Pengampunan\" disetujui admin', 1, '2026-01-11 07:38:02', '2026-01-14 07:10:42'),
(3, 5, '✅ Peminjaman buku \"Si Kancil Pencuri Timun emas\" disetujui admin', 1, '2026-01-11 08:05:10', '2026-01-14 07:10:42'),
(4, 5, '✅ Peminjaman buku \"Si Kancil Pencuri Timun\" disetujui admin', 1, '2026-01-11 08:14:17', '2026-01-14 07:10:42'),
(5, 7, '✅ Peminjaman buku \"Empat Langkah Pengampunan\" disetujui admin', 0, '2026-01-11 08:16:03', '2026-01-11 08:16:03'),
(6, 7, '✅ Peminjaman buku \"Si Kancil Pencuri Timun\" disetujui admin', 0, '2026-01-11 09:53:11', '2026-01-11 09:53:11'),
(7, 5, '⛔ Masa pinjam buku \"Si Kancil Pencuri Timun\" telah HABIS', 1, '2026-01-11 17:58:37', '2026-01-14 07:10:42'),
(8, 7, '⛔ Masa pinjam buku \"Empat Langkah Pengampunan\" telah HABIS', 0, '2026-01-11 17:58:38', '2026-01-11 17:58:38'),
(9, 5, '✅ Peminjaman buku \"Si Kancil Pencuri Timun\" disetujui admin', 1, '2026-01-11 17:59:49', '2026-01-14 07:10:42'),
(10, 6, '✅ Peminjaman buku \"Empat Langkah Pengampunan\" disetujui admin', 0, '2026-01-11 23:02:13', '2026-01-11 23:02:13'),
(11, 5, '✅ Peminjaman buku \"Tom Swayer Adventure\" disetujui admin', 1, '2026-01-12 06:17:16', '2026-01-14 07:10:42'),
(12, 6, '✅ Peminjaman buku \"FERALS\" disetujui admin', 0, '2026-01-12 06:19:26', '2026-01-12 06:19:26'),
(13, 7, '✅ Peminjaman buku \"Filsafat\" disetujui admin', 0, '2026-01-12 06:19:30', '2026-01-12 06:19:30'),
(14, 5, '✅ Peminjaman buku \"Sejarah Pengetahuan Abad 20\" disetujui admin', 1, '2026-01-13 00:40:28', '2026-01-14 07:10:42'),
(15, 5, '✅ Peminjaman buku \"Kancil Raja Rimba\" disetujui admin', 1, '2026-01-13 00:47:10', '2026-01-14 07:10:42'),
(16, 7, '✅ Peminjaman buku \"Kancil Raja Rimba\" disetujui admin', 0, '2026-01-13 00:47:12', '2026-01-13 00:47:12'),
(17, 8, '✅ Peminjaman buku \"Dongeng si Domba\" disetujui admin', 1, '2026-01-14 06:24:52', '2026-01-14 07:05:56'),
(18, 8, '✅ Peminjaman buku \"Into The Wild\" disetujui admin', 1, '2026-01-14 07:10:26', '2026-01-14 07:11:22'),
(19, 8, '⏰ Masa pinjam buku \"Dongeng si Domba\" telah HABIS. Segera kembalikan ke admin.', 0, '2026-01-16 05:05:30', '2026-01-16 05:05:30'),
(20, 5, '✅ Peminjaman buku \"Layangan Putus\" disetujui admin', 0, '2026-01-16 06:46:41', '2026-01-16 06:46:41'),
(21, 9, '✅ Peminjaman buku \"Si Kancil Pencuri Timun emas\" disetujui admin', 1, '2026-01-18 03:19:34', '2026-01-18 03:35:01');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint UNSIGNED NOT NULL,
  `pinjam_id` bigint UNSIGNED NOT NULL,
  `tgl_dikembalikan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id`, `user_id`, `buku_id`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
(24, 5, 4, '2026-01-08', '2026-01-15', 'selesai'),
(25, 5, 5, '2026-01-09', '2026-01-16', 'selesai'),
(26, 5, 5, '2026-01-11', '2026-01-18', 'selesai'),
(27, 7, 5, '2026-01-11', '2026-01-18', 'selesai'),
(28, 5, 5, '2026-01-11', '2026-01-13', 'ditolak'),
(29, 5, 5, '2026-01-11', '2026-01-12', 'selesai'),
(30, 5, 2, '2026-01-11', '2026-01-12', 'selesai'),
(31, 5, 6, '2026-01-11', '2026-01-12', 'selesai'),
(32, 7, 5, '2026-01-11', '2026-01-12', 'selesai'),
(33, 7, 6, '2026-01-11', '2026-01-13', 'selesai'),
(34, 5, 6, '2026-01-12', '2026-01-14', 'selesai'),
(35, 6, 5, '2026-01-12', '2026-01-13', 'selesai'),
(36, 5, 22, '2026-01-12', '2026-01-13', 'selesai'),
(37, 6, 17, '2026-01-12', '2026-01-13', 'selesai'),
(38, 7, 15, '2026-01-12', '2026-01-14', 'selesai'),
(39, 5, 16, '2026-01-13', '2026-01-15', 'selesai'),
(40, 5, 8, '2026-01-13', '2026-01-16', 'selesai'),
(41, 7, 8, '2026-01-13', '2026-01-16', 'selesai'),
(42, 8, 9, '2026-01-14', '2026-01-16', 'selesai'),
(43, 8, 18, '2026-01-14', '2026-01-17', 'denda'),
(44, 5, 28, '2026-01-16', '2026-01-17', 'denda'),
(45, 9, 6, '2026-01-18', '2026-01-20', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `buku_id`, `user_id`, `komentar`) VALUES
(1, 2, 5, 'suka banget sama buku nya menarik banget'),
(2, 4, 6, 'i liked'),
(3, 4, 5, 'josss bukunnya'),
(4, 2, 7, 'wawww aku suka ceritanya menarik bangettt'),
(5, 6, 7, 'aku suka buku inii nagus bangettt'),
(6, 5, 6, 'suka banget sama buku ini menarikkk dapat menambah wawasan'),
(7, 16, 5, 'Sumpahhhh menarik bangettt tauuu gyuss!! rekomend banget');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'Admin', 'admin@gmail.com', '$2y$12$9YAwnXn/F4479LSsT6BH9eTNxfoudywWQfRc1H.Cko4Dn.Mz41E9G', 'admin', NULL, NULL),
(4, 'Member', 'member@gmail.com', '$2y$12$dVn6r36t.AbnocAYnvFdxuntoaeKFLYpLcUTzyVHm96sBxmYxCdt6', 'member', NULL, NULL),
(5, 'rafli', 'rafli@gmail.com', '$2y$12$lNF5oAdD2FLq8ogK82oqAONL.2.Np.6Pcv/9cMc.S2/WglPAhOWA2', 'member', '2025-11-26 06:56:47', '2025-11-26 06:56:47'),
(6, 'siva', 'siva@gmail.com', '$2y$12$dIJrSusVYeTEMCqdxAObeOzZxuM3w9WngzyHmNg1d1VY4P3vxmGvS', 'member', '2025-12-24 21:43:51', '2025-12-24 21:43:51'),
(7, 'jhon', 'jhon@gmail.com', '$2y$12$gml6Mkf4XyptbA2hBeJ61efdTXTW/xBPOhfdItKNkt7nBOJZhcB9K', 'member', '2025-12-24 21:44:49', '2025-12-24 21:44:49'),
(8, 'Madeva wibi A.', 'made@gmail.com', '$2y$12$2nxxe.EN3y3FJlfTkdlNk.BfrR/yspE8Np6VPRily4pS5oyMnwyL.', 'member', '2026-01-13 07:11:25', '2026-01-13 07:11:25'),
(9, 'achmad baharudin', 'bahar@gmail.com', '$2y$12$Pot4SzHg/dKFIpXk0uv/WekDUkEXRPSLyj4ohfjMZsF.yEUEneV.q', 'member', '2026-01-18 03:15:04', '2026-01-18 03:15:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasi_user_id_foreign` (`user_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_pinjam_id_foreign` (`pinjam_id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjam_user_id_foreign` (`user_id`),
  ADD KEY `pinjam_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ulasan_buku_id_foreign` (`buku_id`),
  ADD KEY `ulasan_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_pinjam_id_foreign` FOREIGN KEY (`pinjam_id`) REFERENCES `pinjam` (`id`);

--
-- Constraints for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `pinjam_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `ulasan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
