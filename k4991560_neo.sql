-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2019 pada 04.28
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k4991560_neo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mainmenu`
--

CREATE TABLE `mainmenu` (
  `seq` int(11) NOT NULL,
  `idmenu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `active_menu` varchar(50) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `link_menu` varchar(50) NOT NULL,
  `menu_akses` varchar(12) NOT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mainmenu`
--

INSERT INTO `mainmenu` (`seq`, `idmenu`, `nama_menu`, `active_menu`, `icon_class`, `link_menu`, `menu_akses`, `entry_date`, `entry_user`) VALUES
(1, 1, 'Dashboard', '', 'menu-icon fa fa-tachometer', 'Dashboard', '', '2018-11-01 20:54:49', NULL),
(24, 11, 'Master', '', 'menu-icon fa fa-file', '#', '', '2019-01-03 08:45:55', NULL),
(27, 12, 'Tentang', '', 'menu-icon fa fa-question', 'About', '', '2019-01-03 08:47:29', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `id_sub` int(11) NOT NULL,
  `nama_sub` varchar(50) NOT NULL,
  `mainmenu_idmenu` int(11) NOT NULL,
  `active_sub` varchar(20) NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `link_sub` varchar(50) NOT NULL,
  `sub_akses` varchar(12) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`id_sub`, `nama_sub`, `mainmenu_idmenu`, `active_sub`, `icon_class`, `link_sub`, `sub_akses`, `entry_date`, `entry_user`) VALUES
(21, 'Infaq', 11, '', '', 'Infaq', '', '2019-01-04 02:30:51', NULL),
(20, 'User Type', 11, '', '', 'User_type', '', '2019-01-03 09:11:36', NULL),
(19, 'User', 11, '', '', 'User', '', '2019-01-03 09:11:40', NULL),
(18, 'ZIS', 11, '', '', 'Zis', '', '2019-01-03 06:49:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_akses_mainmenu`
--

CREATE TABLE `tab_akses_mainmenu` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `c` int(11) DEFAULT '0',
  `r` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tab_akses_mainmenu`
--

INSERT INTO `tab_akses_mainmenu` (`id`, `id_menu`, `id_level`, `c`, `r`, `u`, `d`, `entry_date`, `entry_user`) VALUES
(45, 11, 6, 0, 1, 0, 0, '2019-01-03 09:15:52', ''),
(44, 12, 6, 0, 1, 0, 0, '2019-01-03 09:26:47', ''),
(43, 11, 5, 0, 1, 0, 0, '2019-01-03 06:55:46', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tab_akses_submenu`
--

CREATE TABLE `tab_akses_submenu` (
  `id` int(11) NOT NULL,
  `id_sub_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `c` int(11) DEFAULT '0',
  `r` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tab_akses_submenu`
--

INSERT INTO `tab_akses_submenu` (`id`, `id_sub_menu`, `id_level`, `c`, `r`, `u`, `d`, `entry_date`, `entry_user`) VALUES
(39, 21, 5, 0, 1, 0, 0, '2019-01-04 02:32:04', ''),
(38, 20, 6, 0, 1, 0, 0, '2019-01-03 09:12:40', ''),
(37, 19, 6, 0, 1, 0, 0, '2019-01-03 09:12:40', ''),
(36, 18, 5, 0, 1, 0, 0, '2019-01-03 06:56:55', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_about`
--

CREATE TABLE `tb_about` (
  `id_about` int(11) NOT NULL,
  `about_logo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `about_deskripsi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `id_admin` int(11) DEFAULT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `nomor_rekening` varchar(20) NOT NULL,
  `atas_nama` varchar(50) NOT NULL,
  `terakhir_diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_infaq`
--

CREATE TABLE `tb_infaq` (
  `id_infaq` varchar(34) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `bank_pengirim` varchar(50) NOT NULL,
  `norek_pengirim` varchar(20) NOT NULL,
  `jumlah_infaq` double NOT NULL,
  `tanggal_infaq` datetime NOT NULL,
  `bukti_infaq` text NOT NULL,
  `status_infaq` enum('Menunggu Konfirmasi','Valid','Tidak Valid') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `status_uang` enum('Belum Dikirim','Sudah Dikirim') NOT NULL DEFAULT 'Belum Dikirim',
  `id_zis` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_infaq`
--

INSERT INTO `tb_infaq` (`id_infaq`, `nama_pengirim`, `bank_pengirim`, `norek_pengirim`, `jumlah_infaq`, `tanggal_infaq`, `bukti_infaq`, `status_infaq`, `status_uang`, `id_zis`) VALUES
('t20b48307e07badba7dbd62bc74a93c0b0', 'Katri S', 'BRI Syariah', '12345', 78000, '2018-12-31 08:00:01', '', 'Tidak Valid', 'Sudah Dikirim', '891b20728831a55f795b43b9032df89e'),
('t2511e824b277a9fcd0f75c96ef64fb423', 'Muhadi', 'BNI', '0923093092037029', 290000, '2018-12-01 09:00:00', 'retro-3d-robot-wallpaper-49975-51660-hd-wallpapers.jpg', 'Valid', 'Belum Dikirim', 't15e427ce64ac8a5f248787903d39256d1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_zis`
--

CREATE TABLE `tb_zis` (
  `id_zis` varchar(34) NOT NULL,
  `nama_zis` varchar(100) NOT NULL,
  `alamat_zis` text NOT NULL,
  `kelurahan_zis` varchar(50) NOT NULL,
  `kecamatan_zis` varchar(50) NOT NULL,
  `qrcode_zis` text NOT NULL,
  `pengurus_zis` int(11) DEFAULT NULL,
  `dibuat_oleh` int(11) DEFAULT NULL,
  `terakhir_diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_zis`
--

INSERT INTO `tb_zis` (`id_zis`, `nama_zis`, `alamat_zis`, `kelurahan_zis`, `kecamatan_zis`, `qrcode_zis`, `pengurus_zis`, `dibuat_oleh`, `terakhir_diperbarui`) VALUES
('891b20728831a55f795b43b9032df89e', 'Al Kodir', '<p>Test</p>', 'Lowokwaru', 'Mojolangu', '891b20728831a55f795b43b9032df89e.png', 26, 22, '2019-01-04 01:03:22'),
('t15e427ce64ac8a5f248787903d39256d1', 'Baznas', '<p>Test</p>', 'Test', 'Test', 't15e427ce64ac8a5f248787903d39256d1.png', 26, 22, '2019-01-04 02:30:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_user`
--

CREATE TABLE `tm_user` (
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` text,
  `password` varchar(100) NOT NULL,
  `nama_rek_user` varchar(255) NOT NULL,
  `no_rek_user` varchar(255) NOT NULL,
  `bank_rek_user` varchar(255) NOT NULL,
  `view_password` varchar(100) DEFAULT NULL,
  `admin_level` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tm_user`
--

INSERT INTO `tm_user` (`id_user`, `nama`, `email`, `foto`, `password`, `nama_rek_user`, `no_rek_user`, `bank_rek_user`, `view_password`, `admin_level`, `id`) VALUES
('baznas', 'Baznas', 'baznas@gmail.com', NULL, '596abd832ae81066c4cf716f6f70243c', '', '', '', 'baznas', 5, 22),
('super', 'Super', 'super@gmail.com', NULL, '1b3231655cebb7a1f783eddf27d254ca', '', '', '', 'super', 6, 24),
('Nirwan', 'Nirwan', 'nirwan@gmail.com', NULL, '28e47f714c1fcb538a669b971ee6ce46', 'Nirwansyah', '1234567890', 'BRI', 'nirwan', 5, 25),
('usman', 'Usman', 'usman@gmail.com', NULL, '2f1fed5365c79d8fea7859dcc8788d77', 'Usman', '123456789', 'BNI', 'usman', 7, 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`, `nama`) VALUES
(5, 'Administrator', NULL),
(6, 'Super Admin', NULL),
(7, 'Pengurus ZIS', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mainmenu`
--
ALTER TABLE `mainmenu`
  ADD PRIMARY KEY (`seq`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `tab_akses_mainmenu`
--
ALTER TABLE `tab_akses_mainmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tab_akses_submenu`
--
ALTER TABLE `tab_akses_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indeks untuk tabel `tb_infaq`
--
ALTER TABLE `tb_infaq`
  ADD PRIMARY KEY (`id_infaq`),
  ADD KEY `id_zis` (`id_zis`);

--
-- Indeks untuk tabel `tb_zis`
--
ALTER TABLE `tb_zis`
  ADD PRIMARY KEY (`id_zis`),
  ADD UNIQUE KEY `nama_zis` (`nama_zis`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`),
  ADD KEY `pengurus_zis` (`pengurus_zis`);

--
-- Indeks untuk tabel `tm_user`
--
ALTER TABLE `tm_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mainmenu`
--
ALTER TABLE `mainmenu`
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_mainmenu`
--
ALTER TABLE `tab_akses_mainmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_submenu`
--
ALTER TABLE `tab_akses_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tm_user`
--
ALTER TABLE `tm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_infaq`
--
ALTER TABLE `tb_infaq`
  ADD CONSTRAINT `tb_infaq_ibfk_1` FOREIGN KEY (`id_zis`) REFERENCES `tb_zis` (`id_zis`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_zis`
--
ALTER TABLE `tb_zis`
  ADD CONSTRAINT `tb_zis_ibfk_1` FOREIGN KEY (`pengurus_zis`) REFERENCES `tm_user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tb_zis_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `tm_user` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
