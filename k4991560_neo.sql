-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2019 pada 02.19
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
(1, 1, 'Dashboard', '', 'menu-icon fa fa-dashboard', 'Dashboard', '', '2019-01-04 08:22:30', NULL),
(2, 2, 'Master', '', 'menu-icon fa fa-file', '#', '', '2019-01-04 08:22:30', NULL),
(3, 3, 'About', '', 'menu-icon fa fa-question', 'About', '', '2019-01-04 08:31:13', NULL);

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
(1, 'User Type', 2, '', '', 'User_type', '', '2019-01-04 08:23:35', NULL),
(2, 'User', 2, '', '', 'User', '', '2019-01-04 08:23:35', NULL),
(3, 'ZIS', 2, '', '', 'Zis', '', '2019-01-04 08:24:13', NULL),
(4, 'Infaq', 2, '', '', 'Infaq', '', '2019-01-04 08:24:13', NULL);

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
(3, 2, 2, 0, 1, 0, 0, '2019-01-04 08:29:52', '');

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
(1, 1, 1, 0, 1, 0, 0, '2019-01-04 08:26:41', ''),
(2, 2, 1, 0, 1, 0, 0, '2019-01-04 08:26:41', ''),
(3, 3, 1, 0, 1, 0, 0, '2019-01-04 08:27:14', ''),
(4, 4, 1, 0, 1, 0, 0, '2019-01-04 08:27:14', ''),
(5, 3, 2, 0, 1, 0, 0, '2019-01-04 08:30:15', ''),
(6, 4, 2, 0, 1, 0, 0, '2019-01-04 08:30:15', '');

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
  `diperbarui_oleh` int(11) DEFAULT NULL,
  `terakhir_diperbarui` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_zis` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_infaq`
--

INSERT INTO `tb_infaq` (`id_infaq`, `nama_pengirim`, `bank_pengirim`, `norek_pengirim`, `jumlah_infaq`, `tanggal_infaq`, `bukti_infaq`, `status_infaq`, `status_uang`, `diperbarui_oleh`, `terakhir_diperbarui`, `id_zis`) VALUES
('t26a53f7e1179e70b78a3951a1159e2030', 'Fuad', 'BRI', '0099019429100', 1000000, '2018-01-04 08:00:00', 'profile.jpg', 'Valid', 'Belum Dikirim', 2, '2019-01-04 09:41:54', '0');

--
-- Trigger `tb_infaq`
--
DELIMITER $$
CREATE TRIGGER `kasmas_infaq` AFTER UPDATE ON `tb_infaq` FOR EACH ROW BEGIN
IF(new.id_zis=0 AND new.status_infaq='Valid')
THEN
INSERT INTO tb_kasmas VALUES ('',CURRENT_TIMESTAMP,'Infaq',new.id_infaq,new.jumlah_infaq);
END IF;
END
$$
DELIMITER ;

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
(1, '2019-01-04 09:41:54', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kaskel`
--

CREATE TABLE `tb_kaskel` (
  `id_kaskel` bigint(20) NOT NULL,
  `tanggal_kaskel` datetime NOT NULL,
  `keperluan_kaskel` text NOT NULL,
  `id_zis` varchar(34) NOT NULL,
  `jumlah_kaskel` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kasmas`
--

CREATE TABLE `tb_kasmas` (
  `id_kasmas` bigint(20) NOT NULL,
  `tanggal_kasmas` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `asal_kasmas` enum('Infaq','Zakat Mal') NOT NULL,
  `id_asal` varchar(34) NOT NULL,
  `jumlah_kasmas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kasmas`
--

INSERT INTO `tb_kasmas` (`id_kasmas`, `tanggal_kasmas`, `asal_kasmas`, `id_asal`, `jumlah_kasmas`) VALUES
(1, '2019-01-04 09:41:54', 'Infaq', 't26a53f7e1179e70b78a3951a1159e2030', 1000000),
(2, '2019-01-04 09:41:54', 'Infaq', 't26a53f7e1179e70b78a3951a1159e2030', 1000000);

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
('super', 'Super', 'super@gmail.com', NULL, '1b3231655cebb7a1f783eddf27d254ca', '', '', '', 'super', 1, 1),
('administrator', 'Administrator', 'administrator@gmail.com', NULL, '200ceb26807d6bf99fd6f4f0d1ca54d4', '', '', '', 'administrator', 2, 2),
('nirwan', 'Nirwan', 'nirwan@gmail.com', NULL, 'ef4113dcac30d9fea0cd4ed7caa66ee8', '', '', '', 'pengurus', 3, 3),
('habibi', 'Habibi', 'habibi@gmail.com', NULL, 'ef4113dcac30d9fea0cd4ed7caa66ee8', '', '', '', 'pengurus', 3, 4),
('nugroho', 'Pengurus Baznas', 'nugroho@gmail.com', NULL, '5588432fffd3b845fe662e6e9e9ea924', '', '', '', 'nugroho', 3, 5);

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
  ADD KEY `id_zis` (`id_zis`);

--
-- Indeks untuk tabel `tb_kasmas`
--
ALTER TABLE `tb_kasmas`
  ADD PRIMARY KEY (`id_kasmas`);

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
  MODIFY `seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_mainmenu`
--
ALTER TABLE `tab_akses_mainmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tab_akses_submenu`
--
ALTER TABLE `tab_akses_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_about`
--
ALTER TABLE `tb_about`
  MODIFY `id_about` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kasbas`
--
ALTER TABLE `tb_kasbas`
  MODIFY `id_kasbas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_kaskel`
--
ALTER TABLE `tb_kaskel`
  MODIFY `id_kaskel` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kasmas`
--
ALTER TABLE `tb_kasmas`
  MODIFY `id_kasmas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `tb_kaskel_ibfk_1` FOREIGN KEY (`id_zis`) REFERENCES `tb_zis` (`id_zis`) ON DELETE CASCADE;

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
