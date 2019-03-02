-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2019 pada 09.32
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
(1, 1, 'About', '', 'menu-icon fa fa-question', 'About', '', '2019-01-10 01:37:11', NULL),
(2, 2, 'Master', '', 'menu-icon fa fa-file', '#', '', '2019-01-10 01:37:11', NULL),
(3, 3, 'Kas Baznas', '', 'menu-icon fa fa-money', '#', '', '2019-01-10 01:38:58', NULL),
(4, 4, 'Mutasi Uang', '', 'menu-icon fa fa-arrow-right', 'Mutasi_uang', '', '2019-01-10 01:38:58', NULL),
(5, 5, 'Laporan', '', 'menu-icon fa fa-book', '#', '', '2019-01-10 01:39:46', NULL),
(6, 6, 'Setting', '', 'menu-icon fa fa-gear', 'Setting', '', '2019-01-10 01:39:46', NULL),
(7, 7, 'Import', '', 'menu-icon fa fa-file', '#', '', '2019-01-16 05:58:08', NULL);

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
(1, 'User', 2, '', '', 'User', '', '2019-01-10 01:50:43', NULL),
(2, 'Tempat ZIS', 2, '', '', 'Zis', '', '2019-01-10 01:50:47', NULL),
(3, 'Infaq', 2, '', '', 'Infaq', '', '2019-01-10 01:50:52', NULL),
(4, 'Zakat Fitrah', 2, '', '', 'Zakat_fitrah', '', '2019-01-10 01:50:56', NULL),
(5, 'Zakat Maal', 2, '', '', 'Zakat_maal', '', '2019-01-10 01:50:59', NULL),
(6, 'Kas Keluar', 3, '', '', 'Kas_keluar', '', '2019-01-10 01:51:03', NULL),
(7, 'Kas Masuk', 3, '', '', 'Kas_masuk', '', '2019-01-10 01:51:06', NULL),
(8, 'Laporan Infaq', 5, '', '', 'Laporan_infaq', '', '2019-01-10 01:46:55', NULL),
(9, 'Laporan Zakat Fitrah', 5, '', '', 'Laporan_zakat_fitrah', '', '2019-01-10 01:46:55', NULL),
(10, 'Laporan Zakat Maal', 5, '', '', 'Laporan_zakat_maal', '', '2019-01-10 01:47:11', NULL),
(11, 'Import Infaq', 7, '', '', 'Import_infaq', '', '2019-01-19 05:23:24', NULL),
(12, 'Import Zakat Fitrah', 7, '', '', 'Import_fitrah', '', '2019-01-19 05:23:24', NULL),
(13, 'Import Zakat Maal', 7, '', '', 'Import_maal', '', '2019-01-19 05:23:56', NULL);

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
(1, 1, 1, 0, 1, 0, 0, '2019-01-10 01:40:21', ''),
(2, 2, 1, 0, 1, 0, 0, '2019-01-10 01:40:21', ''),
(3, 3, 1, 0, 1, 0, 0, '2019-01-10 01:40:48', ''),
(4, 4, 1, 0, 1, 0, 0, '2019-01-10 01:40:48', ''),
(5, 5, 1, 0, 1, 0, 0, '2019-01-10 01:41:09', ''),
(6, 6, 1, 0, 1, 0, 0, '2019-01-10 01:41:09', ''),
(7, 5, 3, 0, 1, 0, 0, '2019-01-10 03:47:40', ''),
(8, 7, 1, 0, 1, 0, 0, '2019-01-16 05:59:04', '');

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
(1, 1, 1, 0, 1, 0, 0, '2019-01-10 01:47:45', ''),
(2, 2, 1, 0, 1, 0, 0, '2019-01-10 01:47:45', ''),
(3, 3, 1, 0, 1, 0, 0, '2019-01-10 01:48:02', ''),
(4, 4, 1, 0, 1, 0, 0, '2019-01-10 01:48:02', ''),
(5, 5, 1, 0, 1, 0, 0, '2019-01-10 01:48:41', ''),
(6, 6, 1, 0, 1, 0, 0, '2019-01-10 01:48:41', ''),
(7, 7, 1, 0, 1, 0, 0, '2019-01-10 01:48:56', ''),
(8, 8, 1, 0, 1, 0, 0, '2019-01-10 01:48:56', ''),
(9, 9, 1, 0, 1, 0, 0, '2019-01-10 01:49:26', ''),
(10, 10, 1, 0, 1, 0, 0, '2019-01-10 01:49:26', ''),
(11, 8, 3, 0, 1, 0, 0, '2019-01-10 03:48:07', ''),
(12, 9, 3, 0, 1, 0, 0, '2019-01-10 03:48:07', ''),
(13, 10, 3, 0, 1, 0, 0, '2019-01-10 03:48:38', ''),
(14, 11, 1, 0, 1, 0, 0, '2019-01-19 05:24:29', ''),
(15, 12, 1, 0, 1, 0, 0, '2019-01-19 05:24:29', ''),
(16, 13, 1, 0, 1, 0, 0, '2019-01-19 05:24:38', '');

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

--
-- Dumping data untuk tabel `tb_about`
--

INSERT INTO `tb_about` (`id_about`, `about_logo`, `about_deskripsi`, `id_admin`, `nama_bank`, `nomor_rekening`, `atas_nama`, `terakhir_diperbarui`) VALUES
(1, '676.jpg', '<p>Baznas adalah Badan Amil Zakat Nasional</p>', 1, 'BCA Syariah', '009892726', 'Baznas Badung', '2019-01-19 05:50:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_infaq`
--

CREATE TABLE `tb_infaq` (
  `id_infaq` varchar(34) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `telp_pengirim` varchar(20) NOT NULL,
  `bank_pengirim` varchar(50) NOT NULL,
  `pemilik_rekening` varchar(50) NOT NULL,
  `norek_pengirim` varchar(20) NOT NULL,
  `jumlah_infaq` double NOT NULL,
  `tanggal_infaq` datetime NOT NULL,
  `bukti_infaq` text NOT NULL,
  `status_infaq` enum('Menunggu Konfirmasi','Valid','Tidak Valid') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `status_uang` enum('Kas Baznas','Sudah Terdistribusi') NOT NULL DEFAULT 'Kas Baznas',
  `diperbarui_oleh` int(11) DEFAULT NULL,
  `terakhir_diperbarui` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_zis` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_infaq`
--

INSERT INTO `tb_infaq` (`id_infaq`, `nama_pengirim`, `telp_pengirim`, `bank_pengirim`, `pemilik_rekening`, `norek_pengirim`, `jumlah_infaq`, `tanggal_infaq`, `bukti_infaq`, `status_infaq`, `status_uang`, `diperbarui_oleh`, `terakhir_diperbarui`, `id_zis`) VALUES
('t20c8769cb52ffedfeb41e57a3e20595af', 'Sujidwo', '231', 'BRA', 'Sujidwo', '282992929', 100000, '2019-01-21 14:24:00', '', 'Valid', 'Sudah Terdistribusi', 9, '2019-01-21 07:05:02', 't1d9c94cc7ebadcc88925b14422d7d97f1'),
('t29424cddc434c15d1675b5147aeafd779', 'Hubo', '929', 'BRE', 'Hubo', '2930230', 100000, '2019-01-28 14:08:00', '', 'Valid', 'Sudah Terdistribusi', 9, '2019-01-21 07:09:07', 't1b2bd404dbec2412813b940257ef32d63'),
('t2e0e9ad330afa170fa6b4218137060c60', 'Tedjo', '085872', 'BRI', 'Tedjo', '23920302', 100000, '2019-01-21 14:22:00', '', 'Valid', 'Kas Baznas', 9, '2019-01-21 07:02:39', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kasbas`
--

CREATE TABLE `tb_kasbas` (
  `id_kasbas` bigint(20) NOT NULL,
  `tanggal_kasbas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_kasbas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kasbas`
--

INSERT INTO `tb_kasbas` (`id_kasbas`, `tanggal_kasbas`, `total_kasbas`) VALUES
(1, '2019-01-21 07:02:40', 100000),
(2, '2019-01-21 07:04:44', 200000),
(3, '2019-01-21 07:06:42', 100000),
(4, '2019-01-21 07:08:58', 200000),
(5, '2019-01-21 07:09:07', 100000),
(6, '2019-01-21 07:30:00', 160000),
(7, '2019-01-21 07:34:57', 100000),
(8, '2019-01-21 07:35:38', 190000),
(9, '2019-01-21 07:38:45', 250000),
(10, '2019-01-21 07:39:28', 190000),
(11, '2019-01-21 08:16:59', 390000),
(12, '2019-01-21 08:27:24', 190000),
(13, '2019-01-21 08:29:18', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kaskel`
--

CREATE TABLE `tb_kaskel` (
  `id_kaskel` bigint(20) NOT NULL,
  `tanggal_kaskel` datetime NOT NULL,
  `keperluan_kaskel` text NOT NULL,
  `id_zis` varchar(34) NOT NULL,
  `jumlah_kaskel` double NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `terakhir_diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kaskel`
--

INSERT INTO `tb_kaskel` (`id_kaskel`, `tanggal_kaskel`, `keperluan_kaskel`, `id_zis`, `jumlah_kaskel`, `dibuat_oleh`, `terakhir_diperbarui`) VALUES
(1, '2019-01-21 02:05:02', 'Mutasi sebesar Rp. 100.000', 't1d9c94cc7ebadcc88925b14422d7d97f1', 100000, 9, '2019-01-21 07:05:02'),
(2, '2019-01-21 02:09:07', 'Mutasi sebesar Rp. 100.000', 't1b2bd404dbec2412813b940257ef32d63', 100000, 9, '2019-01-21 07:09:07'),
(3, '2019-01-21 02:34:57', 'Mutasi sebesar Rp. 60.000', 't1b2bd404dbec2412813b940257ef32d63', 60000, 9, '2019-01-21 07:34:57'),
(4, '2019-01-21 14:39:28', 'Mutasi sebesar Rp. 60,000', 't1b2bd404dbec2412813b940257ef32d63', 60000, 9, '2019-01-21 07:39:28'),
(5, '2019-01-21 03:27:23', 'Mutasi sebesar Rp. 200.000', 't1b2bd404dbec2412813b940257ef32d63', 200000, 9, '2019-01-21 08:27:23'),
(6, '2019-01-21 15:30:00', 'Bangun Kamar Mandi', 't1d9c94cc7ebadcc88925b14422d7d97f1', 90000, 9, '2019-01-21 08:29:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kasmas`
--

CREATE TABLE `tb_kasmas` (
  `id_kasmas` bigint(20) NOT NULL,
  `tanggal_kasmas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `asal_kasmas` enum('Infaq','Zakat Fitrah','Zakat Maal') NOT NULL,
  `id_asal` varchar(34) NOT NULL,
  `jumlah_kasmas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kasmas`
--

INSERT INTO `tb_kasmas` (`id_kasmas`, `tanggal_kasmas`, `asal_kasmas`, `id_asal`, `jumlah_kasmas`) VALUES
(1, '2019-01-21 07:02:40', 'Infaq', 't2e0e9ad330afa170fa6b4218137060c60', 100000),
(2, '2019-01-21 07:04:44', 'Infaq', 't20c8769cb52ffedfeb41e57a3e20595af', 100000),
(3, '2019-01-21 07:08:58', 'Infaq', 't29424cddc434c15d1675b5147aeafd779', 100000),
(4, '2019-01-21 07:29:59', 'Zakat Fitrah', 't33826c6f09822078e6b2a78e88acfdf5e', 60000),
(5, '2019-01-21 07:35:38', 'Zakat Fitrah', 't38606e15df3e430f13095c4aa3798fc13', 90000),
(6, '2019-01-21 07:38:45', 'Zakat Fitrah', 't38hasd8hdsah', 60000),
(7, '2019-01-21 08:16:59', 'Zakat Maal', 't467870947ce0995ba69428c88ed856b43', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_setting`
--

CREATE TABLE `tb_setting` (
  `id_setting` bigint(20) NOT NULL,
  `tahun` int(11) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_setting`
--

INSERT INTO `tb_setting` (`id_setting`, `tahun`, `meta_key`, `meta_value`) VALUES
(1, 2019, 'nominal_zakat_fitrah', '30000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_zakat_fitrah`
--

CREATE TABLE `tb_zakat_fitrah` (
  `id_zakat_fitrah` varchar(34) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `telp_pengirim` varchar(20) NOT NULL,
  `bank_pengirim` varchar(50) NOT NULL,
  `pemilik_rekening` varchar(50) NOT NULL,
  `norek_pengirim` varchar(20) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `harga_zakat` double NOT NULL,
  `total_zakat` double NOT NULL,
  `tanggal_zakat` datetime NOT NULL,
  `bukti_zakat` text NOT NULL,
  `status_zakat` enum('Menunggu Konfirmasi','Valid','Tidak Valid') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `status_uang_zakat` enum('Kas Baznas','Sudah Terdistribusi') NOT NULL DEFAULT 'Kas Baznas',
  `diperbarui_oleh` int(11) DEFAULT NULL,
  `terakhir_diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_zis` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_zakat_fitrah`
--

INSERT INTO `tb_zakat_fitrah` (`id_zakat_fitrah`, `nama_pengirim`, `telp_pengirim`, `bank_pengirim`, `pemilik_rekening`, `norek_pengirim`, `jumlah_orang`, `harga_zakat`, `total_zakat`, `tanggal_zakat`, `bukti_zakat`, `status_zakat`, `status_uang_zakat`, `diperbarui_oleh`, `terakhir_diperbarui`, `id_zis`) VALUES
('t33826c6f09822078e6b2a78e88acfdf5e', 'Madi', '002920', 'BRA', 'Rozy', '239279423', 2, 30000, 60000, '2019-01-28 14:29:00', '', 'Valid', 'Sudah Terdistribusi', 9, '2019-01-21 07:34:57', 't1b2bd404dbec2412813b940257ef32d63'),
('t38606e15df3e430f13095c4aa3798fc13', 'Musfiqon 3', '000000', 'BRA ID', 'Musfiqon4', '0239029302930', 3, 30000, 90000, '2019-01-21 14:30:00', 'i38606e15df3e430f13095c4aa3798fc13.png', 'Valid', 'Kas Baznas', 9, '2019-01-21 07:37:06', '0'),
('t38hasd8hdsah', 'Tesi', '2039203290', 'BRE', 'Tesu', '0202020', 2, 30000, 60000, '2019-01-21 06:00:00', '', 'Valid', 'Sudah Terdistribusi', NULL, '2019-01-21 07:39:28', 't1b2bd404dbec2412813b940257ef32d63');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_zakat_maal`
--

CREATE TABLE `tb_zakat_maal` (
  `id_maal` bigint(20) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `telp_pengirim` varchar(20) NOT NULL,
  `bank_pengirim` varchar(50) NOT NULL,
  `pemilik_rekening` varchar(50) NOT NULL,
  `norek_pengirim` varchar(20) NOT NULL,
  `jumlah_maal` double NOT NULL,
  `tanggal_maal` datetime NOT NULL,
  `bukti_maal` text NOT NULL,
  `status_maal` enum('Menunggu Konfirmasi','Valid','Tidak Valid') NOT NULL DEFAULT 'Menunggu Konfirmasi',
  `status_uang` enum('Kas Baznas','Sudah Terdistribusi') NOT NULL DEFAULT 'Kas Baznas',
  `diperbarui_oleh` int(11) NOT NULL,
  `terakhir_diperbarui` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_zis` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_zakat_maal`
--

INSERT INTO `tb_zakat_maal` (`id_maal`, `nama_pengirim`, `telp_pengirim`, `bank_pengirim`, `pemilik_rekening`, `norek_pengirim`, `jumlah_maal`, `tanggal_maal`, `bukti_maal`, `status_maal`, `status_uang`, `diperbarui_oleh`, `terakhir_diperbarui`, `id_zis`) VALUES
(1, 'Nirwanto', '2390239', 'BRA', 'Nirwanto', '02020202', 200000, '2019-01-28 15:15:00', 'i4e0f010c90ea4899109b14d874c454878.jpg', 'Valid', 'Sudah Terdistribusi', 9, '2019-01-21 08:27:23', 't1b2bd404dbec2412813b940257ef32d63');

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
('0', 'Baznas', '<p>Badung</p>', 'Badung1', 'Badung2', 't1aede53f384ee6dfe30e8747addb521c9.png', 6, 9, '2019-01-21 07:02:00'),
('t1b2bd404dbec2412813b940257ef32d63', 'Panti Asuhan', '<p>Testing.</p>', 'Jawe', 'Juo', 't1b2bd404dbec2412813b940257ef32d63.png', 5, 9, '2019-01-21 07:08:16'),
('t1d9c94cc7ebadcc88925b14422d7d97f1', 'Masjid A', '<p>Test</p>', 'Test B', 'Test C', 't1d9c94cc7ebadcc88925b14422d7d97f1.png', 10, 9, '2019-01-21 02:15:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tm_user`
--

CREATE TABLE `tm_user` (
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
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

INSERT INTO `tm_user` (`id_user`, `nama`, `nomor_hp`, `email`, `foto`, `password`, `nama_rek_user`, `no_rek_user`, `bank_rek_user`, `view_password`, `admin_level`, `id`) VALUES
('administrator', 'Administrator', '', 'admin@gmail.com', NULL, '200ceb26807d6bf99fd6f4f0d1ca54d4', 'admin bahaudin', '009876543241', 'BRI', 'administrator', 2, 2),
('fuad', 'Fuad', '', 'fuad@gmail.com', NULL, 'd0b0caa56fee5e734ca286516b5885dc', 'Jhon Fuad', '008232323232', 'BNI', 'fuad', 3, 3),
('nirwan', 'Nirwan', '', 'nirwan@gmail.com', NULL, '28e47f714c1fcb538a669b971ee6ce46', 'Moch Nirwan', '0089623242', 'BRI', 'nirwan', 3, 4),
('habibi', 'Habibi', '', 'habibi@gmail.com', NULL, '91a47ceb597e7e6f65335dbb063c26c2', 'Habobi', '008764353543', 'BRI', 'habibi', 3, 5),
('baznas', 'Baznas', '', 'baznas@gmail.com', NULL, '596abd832ae81066c4cf716f6f70243c', 'Baznas Indonesia', '009876543', 'BNI Syariah', 'baznas', 3, 6),
('super', 'Super', '09922', 'super@gmail.com', NULL, '1b3231655cebb7a1f783eddf27d254ca', 'Super', '02929000', 'BRI', 'super', 1, 9),
('nugroho', 'Nugroho', '121323', 'nugroho@gmail.com', NULL, '5588432fffd3b845fe662e6e9e9ea924', 'Nugroho', '2302323', 'BRI', 'nugroho', 3, 10);

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
(1, 'Super', ''),
(2, 'Administrator', ''),
(3, 'Pengurus ZIS', '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_mutasi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_mutasi` (
`id_zis` varchar(34)
,`nama_zis` varchar(100)
,`kas_masuk` double
,`kas_keluar` double
,`sisa_kas` double
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_mutasi`
--
DROP TABLE IF EXISTS `v_mutasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mutasi`  AS  select `z`.`id_zis` AS `id_zis`,`z`.`nama_zis` AS `nama_zis`,((coalesce((select sum(`i`.`jumlah_infaq`) from `tb_infaq` `i` where ((`i`.`status_infaq` = 'Valid') and (`i`.`id_zis` = `z`.`id_zis`))),0) + coalesce((select sum(`zm`.`jumlah_maal`) from `tb_zakat_maal` `zm` where ((`zm`.`status_maal` = 'Valid') and (`zm`.`id_zis` = `z`.`id_zis`))),0)) + coalesce((select sum(`zf`.`total_zakat`) from `tb_zakat_fitrah` `zf` where ((`zf`.`status_zakat` = 'Valid') and (`zf`.`id_zis` = `z`.`id_zis`))),0)) AS `kas_masuk`,((coalesce((select sum(`i`.`jumlah_infaq`) from `tb_infaq` `i` where ((`i`.`status_infaq` = 'Valid') and (`i`.`status_uang` = 'Sudah Terdistribusi') and (`i`.`id_zis` = `z`.`id_zis`))),0) + coalesce((select sum(`zm`.`jumlah_maal`) from `tb_zakat_maal` `zm` where ((`zm`.`status_maal` = 'Valid') and (`zm`.`status_uang` = 'Sudah Terdistribusi') and (`zm`.`id_zis` = `z`.`id_zis`))),0)) + coalesce((select sum(`zf`.`total_zakat`) from `tb_zakat_fitrah` `zf` where ((`zf`.`status_zakat` = 'Valid') and (`zf`.`status_uang_zakat` = 'Sudah Terdistribusi') and (`zf`.`id_zis` = `z`.`id_zis`))),0)) AS `kas_keluar`,(((coalesce((select sum(`i`.`jumlah_infaq`) from `tb_infaq` `i` where ((`i`.`status_infaq` = 'Valid') and (`i`.`id_zis` = `z`.`id_zis`))),0) + coalesce((select sum(`zm`.`jumlah_maal`) from `tb_zakat_maal` `zm` where ((`zm`.`status_maal` = 'Valid') and (`zm`.`id_zis` = `z`.`id_zis`))),0)) + coalesce((select sum(`zf`.`total_zakat`) from `tb_zakat_fitrah` `zf` where ((`zf`.`status_zakat` = 'Valid') and (`zf`.`id_zis` = `z`.`id_zis`))),0)) - ((coalesce((select sum(`i`.`jumlah_infaq`) from `tb_infaq` `i` where ((`i`.`status_infaq` = 'Valid') and (`i`.`status_uang` = 'Sudah Terdistribusi') and (`i`.`id_zis` = `z`.`id_zis`))),0) + coalesce((select sum(`zm`.`jumlah_maal`) from `tb_zakat_maal` `zm` where ((`zm`.`status_maal` = 'Valid') and (`zm`.`status_uang` = 'Sudah Terdistribusi') and (`zm`.`id_zis` = `z`.`id_zis`))),0)) + coalesce((select sum(`zf`.`total_zakat`) from `tb_zakat_fitrah` `zf` where ((`zf`.`status_zakat` = 'Valid') and (`zf`.`status_uang_zakat` = 'Sudah Terdistribusi') and (`zf`.`id_zis` = `z`.`id_zis`))),0))) AS `sisa_kas` from `tb_zis` `z` ;

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
  ADD KEY `id_zis` (`id_zis`),
  ADD KEY `diperbarui_oleh` (`diperbarui_oleh`);

--
-- Indeks untuk tabel `tb_kasbas`
--
ALTER TABLE `tb_kasbas`
  ADD PRIMARY KEY (`id_kasbas`);

--
-- Indeks untuk tabel `tb_kaskel`
--
ALTER TABLE `tb_kaskel`
  ADD PRIMARY KEY (`id_kaskel`),
  ADD KEY `id_zis` (`id_zis`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indeks untuk tabel `tb_kasmas`
--
ALTER TABLE `tb_kasmas`
  ADD PRIMARY KEY (`id_kasmas`);

--
-- Indeks untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tb_zakat_fitrah`
--
ALTER TABLE `tb_zakat_fitrah`
  ADD PRIMARY KEY (`id_zakat_fitrah`),
  ADD KEY `diperbarui_oleh` (`diperbarui_oleh`),
  ADD KEY `id_zis` (`id_zis`);

--
-- Indeks untuk tabel `tb_zakat_maal`
--
ALTER TABLE `tb_zakat_maal`
  ADD PRIMARY KEY (`id_maal`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_level` (`admin_level`);

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
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_mainmenu`
--
ALTER TABLE `tab_akses_mainmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_submenu`
--
ALTER TABLE `tab_akses_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kasbas`
--
ALTER TABLE `tb_kasbas`
  MODIFY `id_kasbas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_kaskel`
--
ALTER TABLE `tb_kaskel`
  MODIFY `id_kaskel` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_kasmas`
--
ALTER TABLE `tb_kasmas`
  MODIFY `id_kasmas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_zakat_maal`
--
ALTER TABLE `tb_zakat_maal`
  MODIFY `id_maal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tm_user`
--
ALTER TABLE `tm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_infaq`
--
ALTER TABLE `tb_infaq`
  ADD CONSTRAINT `tb_infaq_ibfk_1` FOREIGN KEY (`id_zis`) REFERENCES `tb_zis` (`id_zis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_infaq_ibfk_2` FOREIGN KEY (`diperbarui_oleh`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kaskel`
--
ALTER TABLE `tb_kaskel`
  ADD CONSTRAINT `tb_kaskel_ibfk_1` FOREIGN KEY (`id_zis`) REFERENCES `tb_zis` (`id_zis`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_kaskel_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_zakat_fitrah`
--
ALTER TABLE `tb_zakat_fitrah`
  ADD CONSTRAINT `tb_zakat_fitrah_ibfk_1` FOREIGN KEY (`diperbarui_oleh`) REFERENCES `tm_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_zakat_fitrah_ibfk_2` FOREIGN KEY (`id_zis`) REFERENCES `tb_zis` (`id_zis`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_zis`
--
ALTER TABLE `tb_zis`
  ADD CONSTRAINT `tb_zis_ibfk_1` FOREIGN KEY (`pengurus_zis`) REFERENCES `tm_user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tb_zis_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `tm_user` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tm_user`
--
ALTER TABLE `tm_user`
  ADD CONSTRAINT `tm_user_ibfk_1` FOREIGN KEY (`admin_level`) REFERENCES `user_type` (`user_type_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
