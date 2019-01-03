/*
Navicat MySQL Data Transfer

Source Server         : susancatering.co.id_3306
Source Server Version : 50559
Source Host           : susancatering.co.id:3306
Source Database       : k4991560_neo

Target Server Type    : MYSQL
Target Server Version : 50559
File Encoding         : 65001

Date: 2019-01-03 10:30:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_bank
-- ----------------------------
DROP TABLE IF EXISTS `data_bank`;
CREATE TABLE `data_bank` (
  `id_data` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_bank` varchar(255) NOT NULL,
  `atas_nama_bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_data`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_bank
-- ----------------------------
INSERT INTO `data_bank` VALUES ('1', 'Mandiri', 'Nama', '32523523', '');
INSERT INTO `data_bank` VALUES ('2', 'BRI', 'Nama', '52352', '');

-- ----------------------------
-- Table structure for konfirmasi_bayar
-- ----------------------------
DROP TABLE IF EXISTS `konfirmasi_bayar`;
CREATE TABLE `konfirmasi_bayar` (
  `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_konfirmasi` date NOT NULL,
  `id_order` varchar(255) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bank_bayar` varchar(20) NOT NULL,
  `rekening_bayar` varchar(30) NOT NULL,
  `nama_bayar` varchar(30) NOT NULL,
  `foto` text NOT NULL,
  PRIMARY KEY (`id_konfirmasi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of konfirmasi_bayar
-- ----------------------------
INSERT INTO `konfirmasi_bayar` VALUES ('1', '2018-10-25', 'T181025001', '10000000', 'bca', '111', 'edwin', '111.jpg');

-- ----------------------------
-- Table structure for mainmenu
-- ----------------------------
DROP TABLE IF EXISTS `mainmenu`;
CREATE TABLE `mainmenu` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `idmenu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `active_menu` varchar(50) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `link_menu` varchar(50) NOT NULL,
  `menu_akses` varchar(12) NOT NULL,
  `entry_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mainmenu
-- ----------------------------
INSERT INTO `mainmenu` VALUES ('1', '1', 'Dashboard', '', 'menu-icon fa fa-tachometer', 'Dashboard', '', '2018-11-02 03:54:49', null);
INSERT INTO `mainmenu` VALUES ('8', '8', 'Administrator', '', 'menu-icon fa fa-user', '#', '', '2017-10-13 17:57:17', null);
INSERT INTO `mainmenu` VALUES ('2', '2', 'Slider', '', 'menu-icon fa fa-file-image-o', 'Slider', '', '2017-10-17 17:28:56', null);
INSERT INTO `mainmenu` VALUES ('3', '3', 'Pencairan Poin', '', 'menu-icon fa fa-money', 'Pencairanpoin', '', '2018-10-24 01:49:50', null);
INSERT INTO `mainmenu` VALUES ('4', '4', 'Gudang', '', 'menu-icon fa fa-building', 'Gudang', '', '2018-10-25 02:51:59', null);
INSERT INTO `mainmenu` VALUES ('19', '5', 'Setting Penjualan', '', 'menu-icon fa fa-building', 'Setting', '', '2018-11-02 02:03:51', null);
INSERT INTO `mainmenu` VALUES ('20', '6', 'Order', '', 'menu-icon fa fa-money', 'Order', '', '2018-11-02 03:47:12', null);
INSERT INTO `mainmenu` VALUES ('21', '7', 'Barang Masuk', '', 'menu-icon fa fa-money', 'Bpb2', '', '2018-12-17 04:24:25', null);
INSERT INTO `mainmenu` VALUES ('22', '9', 'Laporan', '', 'menu-icon fa fa-money', '#', '', '2018-11-06 03:27:15', null);
INSERT INTO `mainmenu` VALUES ('23', '10', 'Voucher', '', 'menu-icon fa fa-money', 'Voucher', '', '2018-11-06 08:20:23', null);
INSERT INTO `mainmenu` VALUES ('24', '11', 'Master', '', 'menu-icon fa fa-money', '#', '', '2018-11-06 16:23:50', null);
INSERT INTO `mainmenu` VALUES ('25', '12', 'Barang Pindah', '', 'menu-icon fa fa-money', 'Barang_pindah2', '', '2018-12-18 03:31:47', null);
INSERT INTO `mainmenu` VALUES ('26', '13', 'Riwayat Pencairan Poin', '', 'menu-icon fa fa-money', 'Riwayat_Poin', '', '2018-12-07 01:29:51', null);

-- ----------------------------
-- Table structure for ongkir_pembeli
-- ----------------------------
DROP TABLE IF EXISTS `ongkir_pembeli`;
CREATE TABLE `ongkir_pembeli` (
  `id_ongkir` int(11) NOT NULL AUTO_INCREMENT,
  `ongkir` double NOT NULL,
  `id_order` varchar(50) NOT NULL,
  `id_penjual` varchar(50) NOT NULL,
  `tagihan_admin` int(11) NOT NULL DEFAULT '0',
  `pembayaran` int(11) NOT NULL DEFAULT '0',
  `jasa_pengiriman` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ongkir`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ongkir_pembeli
-- ----------------------------
INSERT INTO `ongkir_pembeli` VALUES ('1', '30000', 'T181219001', 'TOKONEO', '0', '0', 'JNE - OKE');
INSERT INTO `ongkir_pembeli` VALUES ('2', '5000', 'T181219005', 'TOKONEO', '0', '0', 'JNE - OKE');
INSERT INTO `ongkir_pembeli` VALUES ('3', '7000', 'T181219007', 'TOKONEO', '0', '0', 'JNE - OKE');
INSERT INTO `ongkir_pembeli` VALUES ('4', '5000', 'T181219008', 'TOKONEO', '0', '0', 'JNE - OKE');
INSERT INTO `ongkir_pembeli` VALUES ('5', '5000', 'T181219001', 'TOKONEO', '0', '0', 'JNE - OKE');

-- ----------------------------
-- Table structure for pencairan_poin
-- ----------------------------
DROP TABLE IF EXISTS `pencairan_poin`;
CREATE TABLE `pencairan_poin` (
  `kode_cairpoin` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_dapat` varchar(20) NOT NULL,
  `fc_id_order_detail` varchar(30) NOT NULL,
  `fc_kdpoin` int(11) NOT NULL,
  `selisih_harga` int(11) NOT NULL,
  `keuntungan_harga` int(11) NOT NULL,
  `persentasi` int(11) NOT NULL,
  `total_poin` int(11) NOT NULL,
  `status_ambil` int(11) NOT NULL,
  `tgl_ambil` datetime NOT NULL,
  `id_user_pencair` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_cairpoin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pencairan_poin
-- ----------------------------
INSERT INTO `pencairan_poin` VALUES ('1', 'admin', '1', '2', '150000', '50000', '33', '2', '0', '2018-12-11 00:00:00', 'admin');
INSERT INTO `pencairan_poin` VALUES ('2', 'admin', '3', '4', '150000', '-50000', '-33', '4', '0', '2018-12-11 00:00:00', 'admin');
INSERT INTO `pencairan_poin` VALUES ('3', 'admin', '4', '3', '150000', '100000', '67', '3', '0', '2018-12-11 00:00:00', '3');

-- ----------------------------
-- Table structure for riwayat_pencairan_poin
-- ----------------------------
DROP TABLE IF EXISTS `riwayat_pencairan_poin`;
CREATE TABLE `riwayat_pencairan_poin` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_user` char(30) DEFAULT NULL,
  `fm_nominal` double(11,0) DEFAULT NULL,
  `fc_poin` char(4) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of riwayat_pencairan_poin
-- ----------------------------
INSERT INTO `riwayat_pencairan_poin` VALUES ('1', 'admin', '0', '4');
INSERT INTO `riwayat_pencairan_poin` VALUES ('2', 'admin', '10000', '2');

-- ----------------------------
-- Table structure for submenu
-- ----------------------------
DROP TABLE IF EXISTS `submenu`;
CREATE TABLE `submenu` (
  `id_sub` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sub` varchar(50) NOT NULL,
  `mainmenu_idmenu` int(11) NOT NULL,
  `active_sub` varchar(20) NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `link_sub` varchar(50) NOT NULL,
  `sub_akses` varchar(12) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of submenu
-- ----------------------------
INSERT INTO `submenu` VALUES ('1', 'Barang Masuk', '9', '', '', 'Barang_masuk', '', '2018-11-06 17:16:45', null);
INSERT INTO `submenu` VALUES ('6', 'Order', '9', '', '', 'Laporan_order', '', '2018-11-06 17:16:38', null);
INSERT INTO `submenu` VALUES ('7', 'Stock', '9', '', '', 'Laporan_stock', '', '2018-11-06 17:16:27', null);
INSERT INTO `submenu` VALUES ('8', 'Poin', '9', '', '', 'Point', '', '2018-11-06 17:16:18', null);
INSERT INTO `submenu` VALUES ('9', 'Bank', '11', '', '', 'Bank', '', '2018-11-06 17:21:49', null);
INSERT INTO `submenu` VALUES ('10', 'About', '11', '', '', 'About', '', '2018-11-06 17:21:53', null);
INSERT INTO `submenu` VALUES ('11', 'Kontak', '11', '', '', 'Kontak', '', '2018-11-06 17:21:56', null);
INSERT INTO `submenu` VALUES ('12', 'User Type', '11', '', '', 'User_type', '', '2018-11-10 17:57:56', null);
INSERT INTO `submenu` VALUES ('13', 'Kategori Produk', '11', '', '', 'Kategori_produk', '', '2018-11-07 01:28:41', null);
INSERT INTO `submenu` VALUES ('14', 'User', '11', '', '', 'User', '', '2018-11-10 17:12:04', null);
INSERT INTO `submenu` VALUES ('15', 'Set up', '11', '', '', 'Setup', '', '2018-11-13 04:12:03', null);
INSERT INTO `submenu` VALUES ('16', 'Kontak 2', '11', '', '', 'Kontak_2', '', '2018-11-19 09:14:35', null);
INSERT INTO `submenu` VALUES ('17', 'Barang Pindah', '9', '', '', 'Laporan_brg_pindah', '', '2018-12-07 02:22:40', null);

-- ----------------------------
-- Table structure for t_barang_pindah
-- ----------------------------
DROP TABLE IF EXISTS `t_barang_pindah`;
CREATE TABLE `t_barang_pindah` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdbarang_pindah` char(30) DEFAULT NULL,
  `fd_tgl_barang_pindah` date DEFAULT NULL,
  `fc_kdgudang_asal` int(11) DEFAULT NULL,
  `fc_kdgudang_tujuan` int(11) DEFAULT NULL,
  `fc_kdbarang` char(20) DEFAULT NULL,
  `f_jumlah_barang` int(20) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_barang_pindah
-- ----------------------------
INSERT INTO `t_barang_pindah` VALUES ('1', 'BRGP-00001', '2018-12-11', '1', '2', 'BRG-00001', '1', 'admin');
INSERT INTO `t_barang_pindah` VALUES ('2', 'BRGP-00002', '2018-12-11', '1', '2', 'BRG-00001', '1', 'admin');

-- ----------------------------
-- Table structure for t_barang_pindah_temp
-- ----------------------------
DROP TABLE IF EXISTS `t_barang_pindah_temp`;
CREATE TABLE `t_barang_pindah_temp` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdbarang_pindah` char(30) DEFAULT NULL,
  `fd_tgl_barang_pindah` date DEFAULT NULL,
  `fc_kdgudang_asal` int(11) DEFAULT NULL,
  `fc_kdgudang_tujuan` int(11) DEFAULT NULL,
  `fc_kdbarang` char(20) DEFAULT NULL,
  `f_jumlah_barang` int(20) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_barang_pindah_temp
-- ----------------------------

-- ----------------------------
-- Table structure for t_bpbdtl
-- ----------------------------
DROP TABLE IF EXISTS `t_bpbdtl`;
CREATE TABLE `t_bpbdtl` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_nobpb` char(15) DEFAULT NULL,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fn_qtyterima` int(11) DEFAULT NULL,
  `fm_harsat` double(10,0) DEFAULT NULL,
  `fm_subtot` double(10,0) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bpbdtl
-- ----------------------------
INSERT INTO `t_bpbdtl` VALUES ('1', 'BPB-00001', 'BRG-00002', '1', '10', '100000', '1000000', null);
INSERT INTO `t_bpbdtl` VALUES ('2', 'BPB-00002', 'BRG-00001', '2', '2', '900000', '1800000', null);
INSERT INTO `t_bpbdtl` VALUES ('5', 'BPB-00005', 'BRG-00018', '2', '2', '200000', '400000', null);
INSERT INTO `t_bpbdtl` VALUES ('6', 'BPB-00006', 'BRG-00019', '2', '3', '200000', '600000', null);
INSERT INTO `t_bpbdtl` VALUES ('7', 'BPB-00007', 'BRG-00023', '1', '4', '100000', '400000', null);
INSERT INTO `t_bpbdtl` VALUES ('8', 'BPB-00007', 'BRG-00007', '1', '3', '100000', '300000', null);
INSERT INTO `t_bpbdtl` VALUES ('9', 'BPB-00008', 'BRG-00023', '1', '2', '20000', '40000', null);
INSERT INTO `t_bpbdtl` VALUES ('10', 'BPB-00009', 'BRG-00007', '1', '1', '100000', '100000', null);
INSERT INTO `t_bpbdtl` VALUES ('11', 'BPB-00010', 'BRG-00023', '1', '2', '200000', '400000', null);
INSERT INTO `t_bpbdtl` VALUES ('12', 'BPB-00010', 'BRG-00007', '1', '1', '200000', '200000', null);
INSERT INTO `t_bpbdtl` VALUES ('13', 'BPB-00011', 'BRG-00053', '2', '1', '1700000', '1700000', null);
INSERT INTO `t_bpbdtl` VALUES ('14', 'BPB-00012', 'BRG-00016', '2', '4', '500000', '2000000', null);
INSERT INTO `t_bpbdtl` VALUES ('15', 'BPB-00012', 'BRG-00058', '2', '4', '500000', '2000000', null);
INSERT INTO `t_bpbdtl` VALUES ('16', 'BPB-00012', 'BRG-00037', '2', '1', '250000', '250000', null);
INSERT INTO `t_bpbdtl` VALUES ('17', 'BPB-00015', 'BRG-00035', '2', '1', '1500000', '1500000', null);
INSERT INTO `t_bpbdtl` VALUES ('18', 'BPB-00016', 'BRG-00004', '2', '1', '2000000', '2000000', null);
INSERT INTO `t_bpbdtl` VALUES ('19', 'BPB-00017', 'BRG-00017', '2', '1', '800000', '800000', null);
INSERT INTO `t_bpbdtl` VALUES ('20', 'BPB-00018', 'BRG-00013', '2', '1', '500000', '500000', null);
INSERT INTO `t_bpbdtl` VALUES ('21', 'BPB-00019', 'BRG-00021', '2', '2', '700000', '1400000', null);
INSERT INTO `t_bpbdtl` VALUES ('22', 'BPB-00020', 'BRG-00027', '2', '1', '800000', '800000', null);
INSERT INTO `t_bpbdtl` VALUES ('23', 'BPB-00021', 'BRG-00055', '2', '1', '400000', '400000', null);
INSERT INTO `t_bpbdtl` VALUES ('24', 'BPB-00021', 'BRG-00055', '2', '1', '400000', '400000', null);
INSERT INTO `t_bpbdtl` VALUES ('25', 'BPB-00022', 'BRG-00061', '2', '10', '35000', '350000', null);
INSERT INTO `t_bpbdtl` VALUES ('26', 'BPB-00023', 'BRG-00060', '2', '5', '20000', '100000', null);
INSERT INTO `t_bpbdtl` VALUES ('27', 'BPB-00024', 'BRG-00062', '2', '1', '100000', '100000', null);
INSERT INTO `t_bpbdtl` VALUES ('28', 'BPB-00025', 'BRG-00059', '2', '1', '700000', '700000', null);
INSERT INTO `t_bpbdtl` VALUES ('29', 'BPB-00026', 'BRG-00055', '2', '1', '400000', '400000', null);

-- ----------------------------
-- Table structure for t_bpbdtl_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_bpbdtl_copy`;
CREATE TABLE `t_bpbdtl_copy` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_nobpb` char(15) DEFAULT NULL,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fn_qtyterima` int(11) DEFAULT NULL,
  `fm_harsat` double(10,0) DEFAULT NULL,
  `fm_subtot` double(10,0) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bpbdtl_copy
-- ----------------------------
INSERT INTO `t_bpbdtl_copy` VALUES ('1', 'BPB-00001', 'BRG-00002', '1', '10', '100000', '1000000', null);
INSERT INTO `t_bpbdtl_copy` VALUES ('2', 'BPB-00002', 'BRG-00001', '2', '2', '900000', '1800000', null);
INSERT INTO `t_bpbdtl_copy` VALUES ('5', 'BPB-00005', 'BRG-00018', '2', '2', '200000', '400000', null);
INSERT INTO `t_bpbdtl_copy` VALUES ('6', 'BPB-00006', 'BRG-00019', '2', '3', '200000', '600000', null);

-- ----------------------------
-- Table structure for t_bpbdtl_temp
-- ----------------------------
DROP TABLE IF EXISTS `t_bpbdtl_temp`;
CREATE TABLE `t_bpbdtl_temp` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_nobpb` char(15) DEFAULT NULL,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fn_qtyterima` int(11) DEFAULT NULL,
  `fm_harsat` double(10,0) DEFAULT NULL,
  `fm_subtot` double(10,0) DEFAULT NULL,
  `fd_tglbpb` date NOT NULL,
  `fv_nama_supplier` varchar(50) NOT NULL,
  `fd_tglinput` datetime NOT NULL,
  `fc_userinput` varchar(30) NOT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bpbdtl_temp
-- ----------------------------

-- ----------------------------
-- Table structure for t_bpbmst
-- ----------------------------
DROP TABLE IF EXISTS `t_bpbmst`;
CREATE TABLE `t_bpbmst` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_nobpb` char(15) DEFAULT NULL,
  `fd_tglbpb` date DEFAULT NULL,
  `fv_nama_supplier` varchar(30) DEFAULT NULL,
  `fd_tglinput` datetime DEFAULT NULL,
  `fc_userinput` char(15) DEFAULT NULL,
  `fn_qtytot` int(11) DEFAULT NULL,
  `fm_total` double(15,0) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bpbmst
-- ----------------------------
INSERT INTO `t_bpbmst` VALUES ('1', 'BPB-00001', '2018-12-11', 'toko', '2018-12-11 09:26:25', null, '10', '100000', 'admin');
INSERT INTO `t_bpbmst` VALUES ('2', 'BPB-00002', '2018-12-12', '', '2018-12-12 14:06:03', null, '4', '1800000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('5', 'BPB-00005', '2018-12-12', '', '2018-12-12 14:22:29', null, '2', '200000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('6', 'BPB-00006', '2018-12-12', 'galheh santoso JPR', '2018-12-12 14:27:58', null, '3', '200000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('7', 'BPB-00007', '2018-12-20', '', '2018-12-20 11:16:12', null, '7', '200000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('8', 'BPB-00008', '2018-12-20', '', '2018-12-20 12:38:39', null, '2', '20000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('9', 'BPB-00009', '2018-12-20', '', '2018-12-20 12:42:28', null, '1', '100000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('10', 'BPB-00010', '2018-12-21', '', '2018-12-21 05:19:34', null, '3', '400000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('11', 'BPB-00011', '2018-12-22', '', '2018-12-22 17:24:47', null, '1', '1700000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('12', 'BPB-00012', '2018-12-29', '', '2018-12-29 19:16:16', null, '4', '500000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('13', 'BPB-00012', '2018-12-29', '', '2018-12-29 19:16:16', null, '4', '500000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('14', 'BPB-00012', '2018-12-29', '', '2018-12-29 19:16:16', null, '1', '250000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('15', 'BPB-00015', '2018-12-29', '', '2018-12-29 19:21:01', null, '1', '1500000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('16', 'BPB-00016', '2018-12-29', '', '2018-12-29 19:22:08', null, '1', '2000000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('17', 'BPB-00017', '2018-12-29', '', '2018-12-29 19:22:53', null, '1', '800000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('18', 'BPB-00018', '2018-12-29', '', '2018-12-29 19:23:42', null, '1', '500000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('19', 'BPB-00019', '2018-12-29', '', '2018-12-29 19:24:42', null, '2', '700000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('20', 'BPB-00020', '2018-12-29', '', '2018-12-29 19:25:30', null, '1', '800000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('21', 'BPB-00021', '2018-12-29', '', '2018-12-29 19:26:33', null, '2', '800000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('22', 'BPB-00022', '2018-12-29', '', '2018-12-29 19:48:54', null, '10', '35000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('23', 'BPB-00023', '2018-12-29', '', '2018-12-29 19:50:24', null, '5', '20000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('24', 'BPB-00024', '2018-12-29', '', '2018-12-29 19:54:57', null, '1', '100000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('25', 'BPB-00025', '2018-12-29', '', '2018-12-29 19:55:41', null, '1', '700000', 'Yoke');
INSERT INTO `t_bpbmst` VALUES ('26', 'BPB-00026', '2018-12-29', '', '2018-12-29 19:58:30', null, '1', '400000', 'Yoke');

-- ----------------------------
-- Table structure for t_bpbmst_copy
-- ----------------------------
DROP TABLE IF EXISTS `t_bpbmst_copy`;
CREATE TABLE `t_bpbmst_copy` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_nobpb` char(15) DEFAULT NULL,
  `fd_tglbpb` date DEFAULT NULL,
  `fv_nama_supplier` varchar(30) DEFAULT NULL,
  `fd_tglinput` datetime DEFAULT NULL,
  `fc_userinput` char(15) DEFAULT NULL,
  `fn_qtytot` int(11) DEFAULT NULL,
  `fm_total` double(15,0) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bpbmst_copy
-- ----------------------------
INSERT INTO `t_bpbmst_copy` VALUES ('1', 'BPB-00001', '2018-12-11', 'toko', '2018-12-11 09:26:25', null, '10', '100000', 'admin');
INSERT INTO `t_bpbmst_copy` VALUES ('2', 'BPB-00002', '2018-12-12', '', '2018-12-12 14:06:03', null, '4', '1800000', 'Yoke');
INSERT INTO `t_bpbmst_copy` VALUES ('5', 'BPB-00005', '2018-12-12', '', '2018-12-12 14:22:29', null, '2', '200000', 'Yoke');
INSERT INTO `t_bpbmst_copy` VALUES ('6', 'BPB-00006', '2018-12-12', 'galheh santoso JPR', '2018-12-12 14:27:58', null, '3', '200000', 'Yoke');

-- ----------------------------
-- Table structure for t_bpbmst_temp
-- ----------------------------
DROP TABLE IF EXISTS `t_bpbmst_temp`;
CREATE TABLE `t_bpbmst_temp` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_nobpb` char(15) DEFAULT NULL,
  `fd_tglbpb` date DEFAULT NULL,
  `fv_nama_supplier` varchar(30) DEFAULT NULL,
  `fd_tglinput` datetime DEFAULT NULL,
  `fc_userinput` char(15) DEFAULT NULL,
  `fn_qtytot` int(11) DEFAULT NULL,
  `fm_total` double(15,0) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bpbmst_temp
-- ----------------------------

-- ----------------------------
-- Table structure for t_nomor
-- ----------------------------
DROP TABLE IF EXISTS `t_nomor`;
CREATE TABLE `t_nomor` (
  `kode` char(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `awalan` char(15) COLLATE latin1_general_ci DEFAULT NULL,
  `akhiran` char(15) COLLATE latin1_general_ci DEFAULT NULL,
  `panjang` int(4) unsigned DEFAULT '0',
  `nomor` int(4) unsigned DEFAULT '0',
  PRIMARY KEY (`kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of t_nomor
-- ----------------------------
INSERT INTO `t_nomor` VALUES ('BRG', 'BRG-', null, '5', '63');
INSERT INTO `t_nomor` VALUES ('BPB', 'BPB-', null, '5', '27');
INSERT INTO `t_nomor` VALUES ('BRGP', 'BRGP-', null, '5', '3');
INSERT INTO `t_nomor` VALUES ('NEO', 'NEO', null, '5', '6');

-- ----------------------------
-- Table structure for t_setup
-- ----------------------------
DROP TABLE IF EXISTS `t_setup`;
CREATE TABLE `t_setup` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fc_param` char(20) DEFAULT NULL,
  `fc_kode` char(1) DEFAULT NULL,
  `fc_isi` char(200) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_setup
-- ----------------------------
INSERT INTO `t_setup` VALUES ('1', 'WAKTU', '1', '24', null);
INSERT INTO `t_setup` VALUES ('2', 'GAMBAR 1', '1', 'Banner_1.jpg', null);
INSERT INTO `t_setup` VALUES ('3', 'GAMBAR 2', '1', 'Banner_2.jpg', null);
INSERT INTO `t_setup` VALUES ('4', 'GAMBAR 3', '1', 'Banner_3.jpg', null);
INSERT INTO `t_setup` VALUES ('5', 'SEKILAS', '1', 'Toko Neo Wood Art menjual segala jenis furniture yang memiliki kualitas tinggi', null);
INSERT INTO `t_setup` VALUES ('6', 'GAMBAR 1', '2', null, null);
INSERT INTO `t_setup` VALUES ('7', 'GAMBAR 2', '2', null, null);
INSERT INTO `t_setup` VALUES ('8', 'GAMBAR 3', '2', null, null);

-- ----------------------------
-- Table structure for t_status
-- ----------------------------
DROP TABLE IF EXISTS `t_status`;
CREATE TABLE `t_status` (
  `fc_param` char(10) NOT NULL,
  `fc_kode` char(2) NOT NULL,
  `fv_value` char(50) DEFAULT NULL,
  PRIMARY KEY (`fc_param`,`fc_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_status
-- ----------------------------

-- ----------------------------
-- Table structure for t_temp_order
-- ----------------------------
DROP TABLE IF EXISTS `t_temp_order`;
CREATE TABLE `t_temp_order` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `fn_quantity` int(10) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fc_kdkeranjang_belanja` char(20) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_temp_order
-- ----------------------------
INSERT INTO `t_temp_order` VALUES ('3', 'BI00001', '1', '1', '::1');
INSERT INTO `t_temp_order` VALUES ('4', 'BI00002', '1', '1', '::1');

-- ----------------------------
-- Table structure for tab_akses_mainmenu
-- ----------------------------
DROP TABLE IF EXISTS `tab_akses_mainmenu`;
CREATE TABLE `tab_akses_mainmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `c` int(11) DEFAULT '0',
  `r` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tab_akses_mainmenu
-- ----------------------------
INSERT INTO `tab_akses_mainmenu` VALUES ('1', '1', '1', null, '1', null, null, '2017-09-25 16:49:01', 'direktur');
INSERT INTO `tab_akses_mainmenu` VALUES ('2', '8', '1', '0', '0', '0', '0', '2018-11-06 03:27:38', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('3', '2', '1', '0', '1', '0', '0', '2017-10-13 19:29:46', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('4', '3', '1', '0', '1', '0', '0', '2017-10-13 19:29:46', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('5', '4', '1', '0', '1', '0', '0', '2017-10-13 19:29:46', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('23', '5', '1', '0', '1', '0', '0', '2018-11-02 02:04:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('24', '6', '1', '0', '1', '0', '0', '2018-11-02 03:53:48', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('25', '7', '1', '0', '1', '0', '0', '2018-11-02 16:15:56', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('26', '9', '1', '0', '1', '0', '0', '2018-11-06 03:28:28', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('27', '10', '1', '0', '1', '0', '0', '2018-11-06 08:03:04', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('28', '11', '1', '0', '1', '0', '0', '2018-11-06 16:24:19', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('29', '12', '1', '0', '1', '0', '0', '2018-11-06 17:55:08', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('30', '13', '1', '0', '1', '0', '0', '2018-12-07 01:30:03', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('31', '1', '3', '0', '1', '0', '0', '2018-12-12 07:38:01', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('32', '2', '3', '0', '1', '0', '0', '2018-12-12 07:38:01', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('33', '3', '3', '0', '0', '0', '0', '2018-12-13 03:53:17', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('34', '4', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('35', '5', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('36', '6', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('37', '8', '3', '0', '0', '0', '0', '2018-12-13 04:01:51', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('38', '9', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('39', '10', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('40', '11', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('41', '12', '3', '0', '1', '0', '0', '2018-12-12 07:38:02', '');
INSERT INTO `tab_akses_mainmenu` VALUES ('42', '13', '3', '0', '0', '0', '0', '2018-12-13 03:54:16', '');

-- ----------------------------
-- Table structure for tab_akses_submenu
-- ----------------------------
DROP TABLE IF EXISTS `tab_akses_submenu`;
CREATE TABLE `tab_akses_submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sub_menu` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `c` int(11) DEFAULT '0',
  `r` int(11) DEFAULT '0',
  `u` int(11) DEFAULT '0',
  `d` int(11) DEFAULT '0',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `entry_user` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tab_akses_submenu
-- ----------------------------
INSERT INTO `tab_akses_submenu` VALUES ('1', '1', '1', '0', '1', '0', '0', '2017-10-13 17:45:40', '');
INSERT INTO `tab_akses_submenu` VALUES ('6', '6', '1', '0', '1', '0', '0', '2018-11-06 03:34:29', '');
INSERT INTO `tab_akses_submenu` VALUES ('7', '7', '1', '0', '1', '0', '0', '2018-11-06 03:34:29', '');
INSERT INTO `tab_akses_submenu` VALUES ('8', '8', '1', '0', '1', '0', '0', '2018-11-06 03:34:39', '');
INSERT INTO `tab_akses_submenu` VALUES ('9', '9', '1', '0', '1', '0', '0', '2018-11-06 17:08:23', '');
INSERT INTO `tab_akses_submenu` VALUES ('10', '10', '1', '0', '1', '0', '0', '2018-11-06 17:22:35', '');
INSERT INTO `tab_akses_submenu` VALUES ('11', '11', '1', '0', '1', '0', '0', '2018-11-06 17:22:35', '');
INSERT INTO `tab_akses_submenu` VALUES ('12', '12', '1', '0', '1', '0', '0', '2018-11-07 01:23:27', '');
INSERT INTO `tab_akses_submenu` VALUES ('13', '13', '1', '0', '1', '0', '0', '2018-11-07 01:29:00', '');
INSERT INTO `tab_akses_submenu` VALUES ('15', '14', '1', '0', '1', '0', '0', '2018-11-10 17:12:34', '');
INSERT INTO `tab_akses_submenu` VALUES ('16', '15', '1', '0', '1', '0', '0', '2018-11-13 04:13:17', '');
INSERT INTO `tab_akses_submenu` VALUES ('17', '16', '1', '0', '1', '0', '0', '2018-11-19 09:15:13', '');
INSERT INTO `tab_akses_submenu` VALUES ('18', '17', '1', '0', '1', '0', '0', '2018-12-07 02:22:58', '');
INSERT INTO `tab_akses_submenu` VALUES ('19', '1', '3', '0', '1', '0', '0', '2018-12-12 07:38:10', '');
INSERT INTO `tab_akses_submenu` VALUES ('20', '2', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('21', '3', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('22', '4', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('23', '5', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('24', '6', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('25', '7', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('26', '8', '3', '0', '1', '0', '0', '2018-12-13 04:01:41', '');
INSERT INTO `tab_akses_submenu` VALUES ('27', '9', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('28', '10', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('29', '11', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('30', '12', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('31', '13', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('32', '14', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('33', '15', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('34', '16', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');
INSERT INTO `tab_akses_submenu` VALUES ('35', '17', '3', '0', '1', '0', '0', '2018-12-12 07:38:11', '');

-- ----------------------------
-- Table structure for tb_about
-- ----------------------------
DROP TABLE IF EXISTS `tb_about`;
CREATE TABLE `tb_about` (
  `id_about` int(11) NOT NULL AUTO_INCREMENT,
  `about_logo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `about_deskripsi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `id_admin` int(11) DEFAULT NULL,
  `about_title_meta` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `about_deskripsi_meta` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `about_keyword_meta` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_about`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_about
-- ----------------------------
INSERT INTO `tb_about` VALUES ('1', 'neo_wood_art.png', '<p>Tentang Neo Wood Art adalah</p>', '0', null, null, null);

-- ----------------------------
-- Table structure for tb_kontak
-- ----------------------------
DROP TABLE IF EXISTS `tb_kontak`;
CREATE TABLE `tb_kontak` (
  `id_kontak` int(11) NOT NULL AUTO_INCREMENT,
  `kontak_lat` varchar(100) DEFAULT NULL,
  `kontak_long` varchar(100) DEFAULT NULL,
  `kontak_deskripsi` text,
  `kontak_judul` varchar(30) DEFAULT NULL,
  `kontak_title_meta` varchar(200) DEFAULT NULL,
  `kontak_deskripsi_meta` text,
  `kontak_keyword_meta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_kontak
-- ----------------------------
INSERT INTO `tb_kontak` VALUES ('1', '-7.9695905', '112.6110401', '<p>No. Hp : 083848032977</p>', 'Kontak Kami', null, null, null);
INSERT INTO `tb_kontak` VALUES ('2', '-7.9619634', '112.621421', '<p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.vv</p>', 'Kontak Kami', '', '', '');

-- ----------------------------
-- Table structure for tb_slider
-- ----------------------------
DROP TABLE IF EXISTS `tb_slider`;
CREATE TABLE `tb_slider` (
  `id_slider` int(11) NOT NULL AUTO_INCREMENT,
  `fv_slider_judul` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `fv_slider_deskripsi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `fc_slider_gambar` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_slider
-- ----------------------------
INSERT INTO `tb_slider` VALUES ('1', 'Furniture', 'Kursi Rotan', 'slider1.jpg', null);
INSERT INTO `tb_slider` VALUES ('2', 'Furniture', 'Meja Artistik', 'slider2.jpg', null);
INSERT INTO `tb_slider` VALUES ('3', 'Furniture', 'Meja Kayu Jati', 'slider3.jpg', null);

-- ----------------------------
-- Table structure for td_barang
-- ----------------------------
DROP TABLE IF EXISTS `td_barang`;
CREATE TABLE `td_barang` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdbarang` char(20) DEFAULT NULL,
  `fc_kdkategori` int(11) DEFAULT NULL,
  `fv_nama_barang` varchar(100) DEFAULT NULL,
  `fv_deskripsi` text,
  `fc_img_1` text,
  `fc_img_2` text,
  `fc_img_3` text,
  `fc_img_4` text,
  `fd_harga_barang_publish` double(15,0) DEFAULT NULL,
  `fd_harga_barang_min` double(15,0) DEFAULT NULL,
  `fv_jenis_poin` varchar(20) DEFAULT NULL,
  `fv_berat` char(10) DEFAULT NULL,
  `fv_dimensi` char(30) DEFAULT NULL,
  `fc_user` char(20) DEFAULT NULL,
  `fc_status_stok` char(30) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_barang
-- ----------------------------
INSERT INTO `td_barang` VALUES ('1', 'BRG-00023', '15', 'Stool Sono Kotak Kecil', '', 'Produk-1_file1-.jpg', '', '', '', '850000', '700000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('3', 'BRG-00003', '4', 'Sketsel Sono', '', 'Produk-3_file1-.jpg', '', '', '', '7200000', '5500000', '3', '10000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('4', 'BRG-00004', '4', 'Stand Daun Sono', '', 'Produk-4_file1-.jpg', 'Produk-0_file1-.jpg', 'Produk-0_file1-.jpg', 'Produk-0_file4-.jpg', '4500000', '4000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('5', 'BRG-00005', '4', 'Timbo Koin', '', 'Produk-5_file1-.jpg', '', '', '', '750000', '600000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('6', 'BRG-00006', '4', 'Bowel Polos', '', '', '', '', '', '750000', '600000', '1', '1000', '30x56', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('7', 'BRG-00007', '4', 'Pot Koin Kotak', '', 'Produk-7_file1-.jpg', '', '', '', '750000', '600000', '', '1000', '', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('12', 'BRG-00012', '4', 'Cermin Koin Bulat', '', 'Produk-12_file1-.png', '', '', '', '500000', '400000', '1', '1000', 'd.50 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('13', 'BRG-00013', '4', 'Sketsel Akar jati', '', 'Produk-13_file1-.jpg', 'Produk-13_file2-.jpg', '', '', '1800000', '1500000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('14', 'BRG-00014', '4', 'Mangkok Sono Set', '', 'Produk-14_file1-.jpg', '', '', '', '450000', '300000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('15', 'BRG-00015', '4', 'Mangkok Sono Besar', '', 'Produk-15_file1-.jpg', 'Produk-15_file2-.jpg', '', '', '100000', '150000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('16', 'BRG-00016', '4', 'Cermin koin persegi', 'cermin bevel 5 mm', 'Produk-16_file1-.jpg', '', '', '', '1700000', '1500000', '1', '10000', '150x70 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('17', 'BRG-00017', '14', 'Relief Kuda', '', '', '', '', '', '1500000', '1100000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('18', 'BRG-00018', '14', 'Patung Kuda Jati', '', 'Produk-18_file1-.jpg', '', '', '', '600000', '400000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('19', 'BRG-00019', '14', 'Patung Kuda Sono', '', '', '', '', '', '600000', '400000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('20', 'BRG-00020', '14', 'Beruang', '', '', '', '', '', '2500000', '2200000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('21', 'BRG-00021', '14', 'Bulldog', '', 'Produk-21_file1-.jpg', '', '', '', '1500000', '1000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('22', 'BRG-00022', '14', 'Gajah Gading', '', 'Produk-22_file1-.jpg', 'Produk-22_file2-.jpg', 'Produk-22_file3-.jpg', '', '1500000', '1000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('23', 'BRG-00024', '15', 'Stool Jati Kotak', '', 'Produk-23_file1-.jpg', '', '', '', '1000000', '850000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('24', 'BRG-00025', '15', 'Stool Sono Bundar', '', '', '', '', '', '1000000', '850000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('25', 'BRG-00026', '15', 'Bangku Sono Balok', '', '', '', '', '', '1700000', '1400000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('26', 'BRG-00027', '15', 'Bangku Sono Kopi', '', '', '', '', '', '1750000', '1500000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('27', 'BRG-00028', '15', 'Kursi Dobel Akar Jati', '', 'Produk-27_file1-.jpg', 'Produk-27_file2-.jpg', 'Produk-27_file3-.jpg', '', '2400000', '2100000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('28', 'BRG-00029', '15', 'Kursi Dobel Akar Jati', '', '', '', '', '', '2200000', '2000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('29', 'BRG-00030', '15', 'Bangku Sono Balok', '', 'Produk-29_file1-.jpg', '', '', '', '3400000', '3000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('30', 'BRG-00031', '15', 'Bangku Jati Erosi', '', 'Produk-30_file1-.jpg', '', '', '', '2900000', '2500000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('31', 'BRG-00032', '15', 'Bangku Sono Keling', '', 'Produk-31_file1-.jpg', '', '', '', '4100000', '3700000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('32', 'BRG-00033', '16', 'Gentong Erosi Besar', '', 'Produk-32_file1-.jpg', '', '', '', '600000', '400000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('33', 'BRG-00034', '16', 'Gentong Erosi Kecil', '', 'Produk-33_file1-.jpg', '', '', '', '500000', '300000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('34', 'BRG-00035', '16', 'Display Sono', '', 'Produk-34_file1-.jpg', '', '', '', '2500000', '2000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('35', 'BRG-00037', '13', 'Meja Laci Jati', '', '', '', '', '', '750000', '600000', '1', '1000', '40x30x70 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('36', 'BRG-00038', '13', 'Meja Sono Balok', '', '', '', '', '', '2100000', '1800000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('37', 'BRG-00039', '13', 'Meja Akar Jati Tinggi+Kaca', '', 'Produk-37_file1-.jpg', '', '', '', '2800000', '1900000', '', '1000', '100x65x80 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('38', 'BRG-00040', '13', 'Meja Balik Akar Jati+Kaca', '', 'Produk-38_file1-.jpg', '', '', '', '3500000', '3000000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('39', 'BRG-00041', '13', 'Meja Makan Balik Jati + Kaca', 'include kaca bevel 12mm', 'Produk-39_file1-.jpg', '', '', '', '6200000', '5500000', '3', '1000', '120x80x80 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('40', 'BRG-00042', '13', 'Meja Konsul Sono', '', 'Produk-40_file1-.jpg', '', '', '', '3200000', '2800000', '2', '1000', '150x50x80 cm', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('41', 'BRG-00043', '13', 'Meja Kecil Akar Jati', '', 'Produk-41_file1-.jpg', '', '', '', '850000', '700000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('42', 'BRG-00044', '13', 'Meja Sonokeling Besar', '', 'Produk-42_file1-.jpg', 'Produk-42_file2-.jpg', '', '', '19700000', '19200000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('43', 'BRG-00045', '15', 'Kursi Single Akar Jati', '', 'Produk-43_file1-.jpg', '', '', '', '950000', '800000', '', '1000', '', 'TOKONEO', '');
INSERT INTO `td_barang` VALUES ('44', 'BRG-00001', '4', 'Stand Table Jati', '', '', '', '', '', '1750000', '1500000', '1', '1000', '40x40x76 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('45', 'BRG-00036', '13', 'Meja Konsul Jati', '', '', '', '', '', '2000000', '1700000', '1', '1000', '150x50x80 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('46', 'BRG-00002', '4', 'Sketsel Ranting', '', 'Produk-46_file1-.jpg', '', 'Produk-0_file3-.jpg', 'Produk-0_file4-.jpg', '1950000', '1600000', '1', '1000', '', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('47', 'BRG-00052', '4', 'Hiasan Jamur', '', 'Produk-47_file1-.jpg', '', '', '', '1250000', '850000', '1', '1000', '', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('48', 'BRG-00053', '18', 'Set meja kursi Bola', 'include kaca bevel 12mm', 'Produk-48_file1-.png', '', '', '', '4000000', '3600000', '2', '100 kg', 'meja d.70cm t.45cm/ kursi d.40', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('49', 'BRG-00054', '13', 'Meja Bintangan Sonokeling', '', 'Produk-49_file1-.jpg', 'Produk-49_file2-.jpg', '', '', '2000000', '1700000', '1', '100 kg', 'p.47cm l.42cm t.40cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('50', 'BRG-00055', '17', 'kursi sandaran kaki satu', '', 'Produk-50_file1-.jpg', '', '', '', '2200000', '1800000', '1', '1000', '125x40x76 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('51', 'BRG-00056', '17', 'kursi sandaran akar jati', '', 'Produk-51_file1-.jpg', '', '', '', '2400000', '2000000', '1', '1000', '140x65x90 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('52', 'BRG-00057', '17', 'stool sono bulat', '', 'Produk-52_file1-.jpg', '', '', '', '1100000', '950000', '1', '1000', 'd.40 cm / t.47cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('53', 'BRG-00058', '4', 'cermin sebetan', 'cermin bevel 5 mm', 'Produk-53_file1-.jpg', 'Produk-53_file2-.jpg', '', '', '1700000', '1500000', '1', '10000', '150x70 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('54', 'BRG-00059', '4', 'stand daun mahoni', 'kayu mahoni', 'Produk-54_file1-.jpg', '', '', '', '2600000', '2300000', '2', '50000', '40x30x150 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('55', 'BRG-00060', '4', 'piring erosi jati kecil', '', 'Produk-55_file1-.jpg', '', '', '', '200000', '150000', '0.5', '10000', '30 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('56', 'BRG-00061', '4', 'piring erosi jati besar', '', 'Produk-56_file1-.jpg', '', '', '', '250000', '200000', '0.5', '2000', '40 cm', 'TOKONEO', 'in stok');
INSERT INTO `td_barang` VALUES ('57', 'BRG-00062', '4', 'hiasan telor', '', 'Produk-57_file1-.jpg', '', '', '', '500000', '400000', '', '5000', '', 'TOKONEO', 'in stok');

-- ----------------------------
-- Table structure for td_chatlive
-- ----------------------------
DROP TABLE IF EXISTS `td_chatlive`;
CREATE TABLE `td_chatlive` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_idroom` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `fv_msg` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `fd_waktu` datetime DEFAULT NULL COMMENT 'Relasi Dengan Tabel tb_user field id_nik',
  `fc_pengirim` enum('P','A') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'P' COMMENT 'P = Pengunjung, A = Admin',
  `fc_baca` enum('Y','N','') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_chatlive
-- ----------------------------
INSERT INTO `td_chatlive` VALUES ('2', '7', 'Apakah Boleh', '2017-07-07 04:26:37', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('3', '7', 'Saya Ingin Coba', '2017-07-07 16:26:51', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('4', '7', 'Mengapa setiap Kali saya merasa Galau ', '2017-07-07 16:27:18', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('5', '7', 'Bukit Daun Hotel and Resort provides the wellness component in each Bukit Daun property, through facilities, treatments and products.', '2017-07-07 16:27:58', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('6', '7', 'Halooo,, Apakah ada Orang ?', '2017-07-07 16:28:22', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('7', '7', 'Iya selamat datang', '2017-07-07 00:00:00', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('8', '7', 'Adakah yang bisa saya banntu', '2017-07-07 00:00:00', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('9', '7', 'hayooo', '2017-07-07 16:47:47', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('10', '7', 'Ada apa', '2017-07-07 16:47:59', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('11', '7', 'apakaj', '2017-07-07 16:48:05', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('12', '7', 'dsfsdg gd  f', '2017-07-07 16:48:14', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('13', '7', 'sdsd fg d h gf', '2017-07-07 16:48:24', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('14', '7', 'gkjkjk', '2017-07-07 17:28:57', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('15', '8', 'Apakah saya bisa', '2017-07-07 05:35:59', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('16', '8', 'Maaf Pertanyaan Anda Kurang Jelas', '2017-07-07 17:36:49', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('17', '8', 'silahkan', '2017-07-07 17:37:07', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('18', '8', 'qdries', '2017-07-07 17:37:50', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('19', '8', 'coba', '2017-07-07 17:38:07', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('20', '8', 'woeeeee', '2017-07-07 17:38:32', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('21', '8', 'sdagjgdhadah', '2017-07-07 17:38:57', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('22', '8', 'dancok', '2017-07-07 17:39:08', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('23', '8', 'matanya', '2017-07-07 17:39:24', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('24', '8', 'asu', '2017-07-07 17:39:32', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('25', '8', 'hshgsgfscs', '2017-07-07 17:39:33', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('26', '8', 'kamfret', '2017-07-07 17:39:45', 'A', 'N');
INSERT INTO `td_chatlive` VALUES ('27', null, 'ha ha ha', '2017-07-07 19:31:42', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('28', null, 'hdgdg', '2017-07-07 19:31:58', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('29', '9', 'dsfsdfdsf', '2017-07-07 08:50:49', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('30', '9', 'hjhjh', '2017-07-07 20:51:24', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('31', '10', 'Apakah anda', '2017-07-07 09:11:38', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('32', '10', 'Apakah anda', '2017-07-07 09:11:45', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('33', '10', 'saya percaya', '2017-07-07 21:12:04', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('34', '10', 'saya percaya', '2017-07-07 21:12:04', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('35', '10', 'saya percaya', '2017-07-07 21:12:05', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('36', '10', 'saya percaya', '2017-07-07 21:12:05', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('37', '10', 'saya percaya', '2017-07-07 21:12:05', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('38', '10', 'saya percaya', '2017-07-07 21:12:05', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('39', '10', 'saya percaya', '2017-07-07 21:12:06', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('40', '10', 'saya percaya', '2017-07-07 21:12:06', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('41', '10', 'saya percaya', '2017-07-07 21:12:06', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('42', '10', 'saya percaya', '2017-07-07 21:12:06', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('43', '10', 'saya percaya', '2017-07-07 21:12:06', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('44', '10', 'saya percaya', '2017-07-07 21:12:07', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('45', '10', 'saya percaya', '2017-07-07 21:12:07', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('46', '10', 'saya percaya', '2017-07-07 21:12:07', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('47', '10', 'hsg', '2017-07-07 21:12:13', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('48', '12', 'Apakah Saya Bisa Bicara Dengan Anda ?', '2017-07-08 01:55:55', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('49', '12', 'Haloo', '2017-07-08 01:57:09', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('50', '13', 'Apakah Saya Bisa ?', '2017-07-11 09:26:41', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('51', '13', 'haloo ', '2017-07-11 09:26:47', 'P', 'N');
INSERT INTO `td_chatlive` VALUES ('52', '13', 'Apakah Ada Orang', '2017-07-11 09:26:55', 'P', 'N');

-- ----------------------------
-- Table structure for td_keranjang_belanja
-- ----------------------------
DROP TABLE IF EXISTS `td_keranjang_belanja`;
CREATE TABLE `td_keranjang_belanja` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdkeranjang_belanja` char(30) DEFAULT NULL,
  `fc_kdbarang` char(20) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fm_harga_produk` double(15,0) DEFAULT NULL,
  `fn_jumlah_produk` int(10) DEFAULT NULL,
  `fm_subtotal_belanja` double(15,0) DEFAULT NULL,
  `fc_status_stok` char(30) DEFAULT NULL,
  `fc_status` char(10) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `f_kode_voucher` char(30) DEFAULT NULL,
  `fd_exp_date` datetime DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_keranjang_belanja
-- ----------------------------

-- ----------------------------
-- Table structure for td_keranjang_belanja_copy
-- ----------------------------
DROP TABLE IF EXISTS `td_keranjang_belanja_copy`;
CREATE TABLE `td_keranjang_belanja_copy` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdkeranjang_belanja` char(30) DEFAULT NULL,
  `fc_kdbarang` char(20) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fm_harga_produk` double(15,0) DEFAULT NULL,
  `fn_jumlah_produk` int(10) DEFAULT NULL,
  `fm_subtotal_belanja` double(15,0) DEFAULT NULL,
  `fc_status_stok` char(30) DEFAULT NULL,
  `fc_status` char(10) DEFAULT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `f_kode_voucher` char(30) DEFAULT NULL,
  `fd_exp_date` datetime DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_keranjang_belanja_copy
-- ----------------------------
INSERT INTO `td_keranjang_belanja_copy` VALUES ('5', 'IKP_181219_001', 'BRG-00001', '1', '1750000', '2', '3500000', 'in stok', 'visitor', '2018-12-19 08:13:31', '', '2018-12-20 14:03:13');
INSERT INTO `td_keranjang_belanja_copy` VALUES ('13', 'IKP_181219_002', 'BRG-00001', '1', '1750000', '1', '1750000', 'in stok', 'visitor', '2018-12-19 10:40:40', '', '2018-12-20 17:40:40');
INSERT INTO `td_keranjang_belanja_copy` VALUES ('14', 'IKP_181219_002', 'BRG-00002', '1', '1800000', '1', '1800000', 'in stok', 'visitor', '2018-12-19 14:08:27', '', '2018-12-17 17:40:59');

-- ----------------------------
-- Table structure for td_konfirmasi_bayar
-- ----------------------------
DROP TABLE IF EXISTS `td_konfirmasi_bayar`;
CREATE TABLE `td_konfirmasi_bayar` (
  `fc_kdkonfirmasi` int(11) NOT NULL AUTO_INCREMENT,
  `fd_tgl_konfirmasi` date DEFAULT NULL,
  `fc_kdorder` char(15) DEFAULT NULL,
  `fm_jumlah_bayar` double(10,0) DEFAULT NULL,
  `fc_bank_bayar` char(20) DEFAULT NULL,
  `fc_rekening_bayar` char(30) DEFAULT NULL,
  `fv_nama_bayar` varchar(30) DEFAULT NULL,
  `fc_img` text,
  PRIMARY KEY (`fc_kdkonfirmasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_konfirmasi_bayar
-- ----------------------------

-- ----------------------------
-- Table structure for td_order
-- ----------------------------
DROP TABLE IF EXISTS `td_order`;
CREATE TABLE `td_order` (
  `fc_id_order_detail` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdorder` char(30) DEFAULT NULL,
  `fc_penjual` char(30) DEFAULT NULL,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `f_jumlah_produk` int(10) DEFAULT NULL,
  `f_berat_produk` int(10) DEFAULT NULL,
  `fm_harga` double(15,0) DEFAULT NULL,
  `fm_harga_pajak` double(15,0) DEFAULT NULL,
  `fm_subtotal` double(15,0) DEFAULT NULL,
  `fm_subtotal_pajak` double(15,0) DEFAULT NULL,
  `fm_pembayaran` double(15,0) DEFAULT NULL,
  `fm_tagihan` double(15,0) DEFAULT NULL,
  `f_kode_voucher` char(30) DEFAULT NULL,
  `fc_kdgudang` int(11) DEFAULT NULL,
  PRIMARY KEY (`fc_id_order_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_order
-- ----------------------------
INSERT INTO `td_order` VALUES ('1', 'T181219001', 'TOKONEO', 'BRG-00002', '1', '1000', '1800000', null, '1800000', null, null, null, '', '1');
INSERT INTO `td_order` VALUES ('2', 'T181219001', 'TOKONEO', 'BRG-00001', '2', '1000', '1800000', null, '1800000', null, null, null, '', '1');

-- ----------------------------
-- Table structure for td_stok_barang_gudang
-- ----------------------------
DROP TABLE IF EXISTS `td_stok_barang_gudang`;
CREATE TABLE `td_stok_barang_gudang` (
  `fc_kdstok_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdgudang` int(11) DEFAULT NULL,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `fc_qty_barang` char(10) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_kdstok_gudang`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of td_stok_barang_gudang
-- ----------------------------
INSERT INTO `td_stok_barang_gudang` VALUES ('1', '1', 'BRG-00001', '16', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('2', '2', 'BRG-00002', '10', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('3', '2', 'BRG-00001', '6', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('4', '1', 'BRG-00002', '4', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('5', '2', 'BRG-00023', '4', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('6', '2', 'BRG-00018', '2', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('7', '2', 'BRG-00019', '3', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('8', '1', 'BRG-00023', '8', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('9', '1', 'BRG-00007', '5', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('10', '2', 'BRG-00053', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('11', '2', 'BRG-00016', '4', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('12', '2', 'BRG-00058', '4', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('13', '2', 'BRG-00037', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('14', '2', 'BRG-00035', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('15', '2', 'BRG-00004', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('16', '2', 'BRG-00017', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('17', '2', 'BRG-00013', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('18', '2', 'BRG-00021', '2', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('19', '2', 'BRG-00027', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('20', '2', 'BRG-00055', '3', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('21', '2', 'BRG-00061', '10', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('22', '2', 'BRG-00060', '5', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('23', '2', 'BRG-00062', '1', null);
INSERT INTO `td_stok_barang_gudang` VALUES ('24', '2', 'BRG-00059', '1', null);

-- ----------------------------
-- Table structure for tm_gudang
-- ----------------------------
DROP TABLE IF EXISTS `tm_gudang`;
CREATE TABLE `tm_gudang` (
  `fc_kdgudang` int(11) NOT NULL AUTO_INCREMENT,
  `fv_nmgudang` varchar(30) DEFAULT NULL,
  `fv_alamat` text,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_kdgudang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tm_gudang
-- ----------------------------
INSERT INTO `tm_gudang` VALUES ('1', 'Gudang Galunggung', 'Jalan Galunggung', 'admin');
INSERT INTO `tm_gudang` VALUES ('2', 'Matos', 'Malang Town Square', 'admin');

-- ----------------------------
-- Table structure for tm_kategori_barang
-- ----------------------------
DROP TABLE IF EXISTS `tm_kategori_barang`;
CREATE TABLE `tm_kategori_barang` (
  `fc_id` int(11) NOT NULL AUTO_INCREMENT,
  `fv_nama_kategori` varchar(100) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tm_kategori_barang
-- ----------------------------
INSERT INTO `tm_kategori_barang` VALUES ('1', 'Living Room', null);
INSERT INTO `tm_kategori_barang` VALUES ('2', 'Bed Room', null);
INSERT INTO `tm_kategori_barang` VALUES ('3', 'Dining Room', null);
INSERT INTO `tm_kategori_barang` VALUES ('4', 'Dekorasi', null);
INSERT INTO `tm_kategori_barang` VALUES ('5', 'Interior', null);
INSERT INTO `tm_kategori_barang` VALUES ('6', 'Eterior + Pagar', null);
INSERT INTO `tm_kategori_barang` VALUES ('7', 'Kusen Pintu', null);
INSERT INTO `tm_kategori_barang` VALUES ('8', 'Gebyok', null);
INSERT INTO `tm_kategori_barang` VALUES ('9', 'Gazebo', null);
INSERT INTO `tm_kategori_barang` VALUES ('10', 'Joglo', null);
INSERT INTO `tm_kategori_barang` VALUES ('11', 'Classic', null);
INSERT INTO `tm_kategori_barang` VALUES ('13', 'Meja', null);
INSERT INTO `tm_kategori_barang` VALUES ('14', 'Ukiran', null);
INSERT INTO `tm_kategori_barang` VALUES ('16', 'Art', null);
INSERT INTO `tm_kategori_barang` VALUES ('17', 'Kursi dan Bangku', null);
INSERT INTO `tm_kategori_barang` VALUES ('18', 'set meja kursi', null);

-- ----------------------------
-- Table structure for tm_order
-- ----------------------------
DROP TABLE IF EXISTS `tm_order`;
CREATE TABLE `tm_order` (
  `fc_kdorder` char(30) NOT NULL,
  `fd_tgl_order` datetime DEFAULT NULL,
  `fm_total` double(15,0) DEFAULT NULL,
  `fv_nama_order` varchar(30) DEFAULT NULL,
  `fv_email_order` varchar(30) DEFAULT NULL,
  `fv_alamat_order` text,
  `fc_telp` char(12) DEFAULT NULL,
  `fc_kode_pos_order` char(8) DEFAULT NULL,
  `fv_provinsi_order` varchar(30) DEFAULT NULL,
  `fv_kota_order` varchar(30) DEFAULT NULL,
  `fm_ongkir_order` double(10,0) DEFAULT NULL,
  `fm_grandtotal_order` double(15,0) DEFAULT NULL,
  `fc_status_kirim` char(1) DEFAULT '1',
  `fc_jenis_stok_order` char(30) DEFAULT NULL,
  `fd_tgl_exp` datetime DEFAULT NULL,
  `fc_visitor` char(10) DEFAULT NULL,
  PRIMARY KEY (`fc_kdorder`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tm_order
-- ----------------------------
INSERT INTO `tm_order` VALUES ('T181219001', '2018-12-17 11:51:24', '1800000', 'edwin', 'edwinlaksono12@gmail.com', 'kediri', '111', '111', 'Jawa Timur', 'Kota Malang', '35000', '1835000', '5', 'in stok', '2018-12-17 11:51:24', 'user');

-- ----------------------------
-- Table structure for tm_poin
-- ----------------------------
DROP TABLE IF EXISTS `tm_poin`;
CREATE TABLE `tm_poin` (
  `fc_kdpoin` int(11) NOT NULL AUTO_INCREMENT,
  `fc_jumlah_poin` char(15) DEFAULT NULL,
  `fc_min_persen` char(15) DEFAULT NULL,
  `fc_max_persen` char(15) DEFAULT NULL,
  `id_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`fc_kdpoin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tm_poin
-- ----------------------------
INSERT INTO `tm_poin` VALUES ('1', '1', '1', '25', 'admn');
INSERT INTO `tm_poin` VALUES ('2', '2', '26', '50', 'admin');
INSERT INTO `tm_poin` VALUES ('3', '3', '51', '75', 'admin');
INSERT INTO `tm_poin` VALUES ('4', '4', '76', '99', 'admin');

-- ----------------------------
-- Table structure for tm_user
-- ----------------------------
DROP TABLE IF EXISTS `tm_user`;
CREATE TABLE `tm_user` (
  `id_user` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` varchar(30) NOT NULL,
  `status` varchar(1) NOT NULL,
  `foto` text,
  `password` varchar(100) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `aktif_user` tinyint(1) NOT NULL,
  `nama_rek_user` varchar(255) NOT NULL,
  `no_rek_user` varchar(255) NOT NULL,
  `bank_rek_user` varchar(255) NOT NULL,
  `view_password` varchar(100) DEFAULT NULL,
  `admin_level` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tm_user
-- ----------------------------
INSERT INTO `tm_user` VALUES ('Yoke', 'Yoke', 'admin@admin.com', 'admin', '1', null, 'e00cf25ad42683b3df678c61f42c6bda', '', '', '0', '0', '', '', '', 'admin1', '1', '1');
INSERT INTO `tm_user` VALUES ('TOKONEO', 'TOKONEO', 'cs@neowoodart.com', 'member', '', null, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Jawa Timur', 'Malang', '255', '1', 'Yayan Rahmat Wijaya', '021223224244', 'BRI', null, null, '18');
INSERT INTO `tm_user` VALUES ('widya', 'widya', 'interen@mail.com', 'member', '1', null, '058a984b819c5ccb46b4768f125844cd', '', '', '0', '0', '', '', '', 'interen', '4', '19');
INSERT INTO `tm_user` VALUES ('admin', 'Luna', '', '', '', null, '0192023a7bbd73250516f069df18b500', '', '', '0', '0', '', '', '', 'admin123', '3', '21');

-- ----------------------------
-- Table structure for tm_voucher
-- ----------------------------
DROP TABLE IF EXISTS `tm_voucher`;
CREATE TABLE `tm_voucher` (
  `fc_id_voucher` int(11) NOT NULL AUTO_INCREMENT,
  `fc_kdbarang` char(15) DEFAULT NULL,
  `id_user` char(25) DEFAULT NULL,
  `fm_nominal` double(11,0) DEFAULT NULL,
  `fd_tgl_exp_voucher` date DEFAULT NULL,
  `f_kode_voucher` char(30) DEFAULT NULL,
  `fd_tgl_terbit_voucher` date DEFAULT NULL,
  `fc_status` enum('0','1','2') DEFAULT '0' COMMENT '0 : status belum di pakai,1: status kalau sudah cek voucher , 2 : status kalau sudah check out',
  PRIMARY KEY (`fc_id_voucher`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tm_voucher
-- ----------------------------
INSERT INTO `tm_voucher` VALUES ('1', 'BRG-00001', 'admin', '100000', '2018-12-09', 'NEO00001', '2018-12-11', '1');
INSERT INTO `tm_voucher` VALUES ('2', 'BRG-00001', 'admin', '200000', '2018-12-13', 'NEO00002', '2018-12-11', '1');
INSERT INTO `tm_voucher` VALUES ('4', 'BRG-00001', 'admin', '50000', '2018-12-12', 'NEO00004', '2018-12-11', '1');
INSERT INTO `tm_voucher` VALUES ('5', 'BRG-00001', 'admin', '100000', '2018-12-12', 'NEO00005', '2018-12-11', '1');

-- ----------------------------
-- Table structure for user_type
-- ----------------------------
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_type_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES ('1', 'Top Admin', null);
INSERT INTO `user_type` VALUES ('3', 'Admin', null);
INSERT INTO `user_type` VALUES ('4', 'Marketing', null);
