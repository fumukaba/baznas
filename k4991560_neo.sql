-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jan 2019 pada 07.07
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

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
(1, 1, 'Dashboard', '', 'menu-icon fa fa-dashboard', 'Dashboard', '', '2019-01-04 08:22:30', NULL),
(2, 2, 'Master', '', 'menu-icon fa fa-file', '#', '', '2019-01-04 08:22:30', NULL),
(3, 3, 'About', '', 'menu-icon fa fa-question', 'About', '', '2019-01-04 08:31:13', NULL),
(4, 4, 'Setting', '', 'menu-icon fa fa-gear', 'Setting', '', '2019-01-05 02:49:07', NULL),
(5, 5, 'Kas', '', 'menu-icon fa fa-money', '#', '', '2019-01-05 08:46:05', NULL);

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
(2, 'User', 2, '', '', 'User', '', '2019-01-04 08:23:35', NULL),
(3, 'Tempat ZIS', 2, '', '', 'Zis', '', '2019-01-05 02:32:33', NULL),
(4, 'Infaq', 2, '', '', 'Infaq', '', '2019-01-04 08:24:13', NULL),
(6, 'Zakat Fitrah', 2, '', '', 'Zakat_fitrah', '', '2019-01-05 04:17:05', NULL),
(7, 'Kas Keluar', 5, '', '', 'Kas_keluar', '', '2019-01-05 08:47:14', NULL),
(8, 'Zakat Maal', 2, '', '', 'Zakat_maal', '', '2019-01-05 09:32:31', NULL);

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
(1, 2, 1, 0, 1, 0, 0, '2019-01-04 08:25:54', ''),
(2, 3, 1, 0, 1, 0, 0, '2019-01-04 08:25:54', ''),
(3, 2, 2, 0, 1, 0, 0, '2019-01-04 08:29:52', ''),
(4, 4, 1, 0, 1, 0, 0, '2019-01-05 02:46:39', ''),
(5, 5, 1, 0, 1, 0, 0, '2019-01-05 08:48:44', ''),
(6, 5, 2, 0, 1, 0, 0, '2019-01-05 08:48:44', '');

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
(2, 2, 1, 0, 1, 0, 0, '2019-01-04 08:26:41', ''),
(3, 3, 1, 0, 1, 0, 0, '2019-01-04 08:27:14', ''),
(4, 4, 1, 0, 1, 0, 0, '2019-01-04 08:27:14', ''),
(5, 3, 2, 0, 1, 0, 0, '2019-01-04 08:30:15', ''),
(6, 4, 2, 0, 1, 0, 0, '2019-01-04 08:30:15', ''),
(7, 6, 1, 0, 1, 0, 0, '2019-01-05 04:18:39', ''),
(8, 6, 2, 0, 1, 0, 0, '2019-01-05 04:18:42', ''),
(9, 7, 1, 0, 1, 0, 0, '2019-01-05 08:51:07', ''),
(10, 7, 2, 0, 1, 0, 0, '2019-01-05 08:51:07', ''),
(11, 8, 1, 0, 1, 0, 0, '2019-01-05 09:33:22', ''),
(12, 8, 2, 0, 1, 0, 0, '2019-01-05 09:33:35', '');

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

INSERT INTO `tb_infaq` (`id_infaq`, `nama_pengirim`, `bank_pengirim`, `pemilik_rekening`, `norek_pengirim`, `jumlah_infaq`, `tanggal_infaq`, `bukti_infaq`, `status_infaq`, `status_uang`, `diperbarui_oleh`, `terakhir_diperbarui`, `id_zis`) VALUES
('t26a53f7e1179e70b78a3951a1159e2030', 'Fuad', 'BRI', 'Nugroho', '0099019429100', 1000000, '2018-01-04 08:00:00', 'profile.jpg', 'Valid', 'Kas Baznas', 1, '2019-01-05 02:39:10', '0');

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
(1, '2019-01-05 02:18:43', 1000000),
(2, '2019-01-05 05:04:45', 1125000),
(3, '2019-01-05 05:14:01', 1225000),
(4, '2019-01-05 08:53:27', 1025000),
(5, '2019-01-07 01:57:17', 1026000),
(6, '2019-01-07 03:53:33', 1027000);

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
(1, '2018-01-04 15:23:37', 'Membangun jembatan', 't14fef34479d29c15a4e5bbe00c3120787', 200000, 1, '2019-01-05 08:53:27');

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
(1, '2019-01-05 02:18:43', 'Infaq', 't26a53f7e1179e70b78a3951a1159e2030', 1000000),
(2, '2019-01-05 05:06:08', 'Zakat Fitrah', 't3dac69f4982004526b7fc5d7dc9ab3f35', 125000),
(3, '2019-01-05 05:14:01', 'Zakat Fitrah', '2328d29whd29wd2', 100000),
(4, '2019-01-07 01:57:17', 'Zakat Maal', '2', 1000),
(5, '2019-01-07 03:53:33', 'Zakat Maal', '2', 1000);

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
(1, 2019, 'nominal_zakat_fitrah', '25000'),
(2, 2019, 'nomimal_barang_temuan', '35000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_zakat_fitrah`
--

CREATE TABLE `tb_zakat_fitrah` (
  `id_zakat_fitrah` varchar(34) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
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

INSERT INTO `tb_zakat_fitrah` (`id_zakat_fitrah`, `nama_pengirim`, `bank_pengirim`, `pemilik_rekening`, `norek_pengirim`, `jumlah_orang`, `harga_zakat`, `total_zakat`, `tanggal_zakat`, `bukti_zakat`, `status_zakat`, `status_uang_zakat`, `diperbarui_oleh`, `terakhir_diperbarui`, `id_zis`) VALUES
('2328d29whd29wd2', 'Sugiono', 'BRI', 'Suwarno', '009230810002', 4, 25000, 100000, '2019-01-05 00:00:00', 'i352f05b9eb1d836e69572d1fe1ca35c9c.png', 'Valid', 'Kas Baznas', 1, '2019-01-07 03:42:18', 't1d94f343a14ea9ab9ef7a7b8eaf999e04'),
('t3dac69f4982004526b7fc5d7dc9ab3f35', 'Bambang', 'BRI', 'Bambang', '298220000291', 5, 25000, 125000, '2018-12-10 08:00:00', 'i31fa29053f202533ceb42e758277ef8cb.png', 'Valid', 'Kas Baznas', 1, '2019-01-07 03:42:00', 't14fef34479d29c15a4e5bbe00c3120787');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_zakat_maal`
--

CREATE TABLE `tb_zakat_maal` (
  `id_maal` bigint(20) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
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
  `jenis_maal` enum('Uang','Emas','Perdagangan','Pertanian','Pertambangan') NOT NULL DEFAULT 'Uang',
  `id_zis` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_zakat_maal`
--

INSERT INTO `tb_zakat_maal` (`id_maal`, `nama_pengirim`, `bank_pengirim`, `pemilik_rekening`, `norek_pengirim`, `jumlah_maal`, `tanggal_maal`, `bukti_maal`, `status_maal`, `status_uang`, `diperbarui_oleh`, `terakhir_diperbarui`, `jenis_maal`, `id_zis`) VALUES
(1, 'Fuad', 'BNI', 'fhadi', '989898878', 100000, '2018-01-20 18:00:00', 'i46df2ba7846906255671318310678331a.png', 'Menunggu Konfirmasi', 'Kas Baznas', 1, '2019-01-07 03:53:25', 'Pertanian', '0'),
(2, 'Nirwan', 'BNI', 'Habibi', '123', 1000, '2019-01-05 15:53:27', 'i434452c2f3dd98775fedecd9b591e4501.png', 'Valid', 'Kas Baznas', 1, '2019-01-07 03:53:33', 'Perdagangan', '0');

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
('0', 'Baznas', '<p>Jalan Raya Legian No. 357, Legian, Kuta, Kabupaten Badung, Bali 80361</p>', 'Badung', 'Legian', 't1b247b9de58ee72c3c0573502a652c86e.png', 5, 2, '2019-01-04 08:43:19'),
('t14fef34479d29c15a4e5bbe00c3120787', 'Masjid Nurul Hikmah', '<p>Jalan Tibung Sari No. 1, Denpasar Barat, Dalung, Kuta Utara, Kabupaten Badung, Bali 80117</p>', 'Dalung', 'Tibung', 't14fef34479d29c15a4e5bbe00c3120787.png', 3, 2, '2019-01-04 08:33:53'),
('t1d94f343a14ea9ab9ef7a7b8eaf999e04', 'Masjid Agung Asasuttaqwa', '<p>Jalan Waringin, Tuban, Kuta, Kabupaten Badung, Bali</p>', 'Tuban', 'Waringin', 't1d94f343a14ea9ab9ef7a7b8eaf999e04.png', 4, 2, '2019-01-04 08:36:04');

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
('super', 'Super', 'super@gmail.com', NULL, '1b3231655cebb7a1f783eddf27d254ca', 'Super', '123', 'BRI', 'super', 1, 1),
('administrator', 'Administrator', 'administrator@gmail.com', NULL, '200ceb26807d6bf99fd6f4f0d1ca54d4', 'Baznas ', '12345678', 'BNI', 'administrator', 2, 2),
('nirwan', 'Nirwan', 'nirwan@gmail.com', NULL, 'ef4113dcac30d9fea0cd4ed7caa66ee8', 'Moch Nirwan Firdaus', '5678902', 'Syariah', 'pengurus', 3, 3),
('habibi', 'Habibi', 'habibi@gmail.com', NULL, 'ef4113dcac30d9fea0cd4ed7caa66ee8', 'Abdulloh Habibie', '7654321', 'BRI', 'pengurus', 3, 4),
('nugroho', 'Pengurus Baznas', 'nugroho@gmail.com', NULL, '5588432fffd3b845fe662e6e9e9ea924', 'Groho Santo', '1234212123', 'BNI', 'nugroho', 3, 5);

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
(1, 'Super Admin', NULL),
(2, 'Administrator', NULL),
(3, 'Pengurus ZIS', NULL);

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
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_mainmenu`
--
ALTER TABLE `tab_akses_mainmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_submenu`
--
ALTER TABLE `tab_akses_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kasbas`
--
ALTER TABLE `tb_kasbas`
  MODIFY `id_kasbas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_kaskel`
--
ALTER TABLE `tb_kaskel`
  MODIFY `id_kaskel` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kasmas`
--
ALTER TABLE `tb_kasmas`
  MODIFY `id_kasmas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `id_setting` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_zakat_maal`
--
ALTER TABLE `tb_zakat_maal`
  MODIFY `id_maal` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tm_user`
--
ALTER TABLE `tm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
