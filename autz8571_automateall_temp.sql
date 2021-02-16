-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2021 at 06:42 PM
-- Server version: 10.2.36-MariaDB-cll-lve
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autz8571_automateall_temp`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy`
--

CREATE TABLE `academy` (
  `id` varchar(255) NOT NULL,
  `judul` tinytext NOT NULL,
  `subjudul` tinytext NOT NULL,
  `isi` text NOT NULL,
  `img` tinytext NOT NULL,
  `waktuMulai` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktuSelesai` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` tinytext NOT NULL,
  `idAcademy` int(11) DEFAULT NULL COMMENT 'menyimpan id akademi yang berhubungan',
  `link` tinytext NOT NULL,
  `isSelesai` tinyint(1) NOT NULL DEFAULT 0,
  `isDelete` tinyint(1) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academy`
--

INSERT INTO `academy` (`id`, `judul`, `subjudul`, `isi`, `img`, `waktuMulai`, `waktuSelesai`, `price`, `idAcademy`, `link`, `isSelesai`, `isDelete`, `keterangan`) VALUES
('ACDPdc1W88', 'Learn to Build Robots', 'FREE ONLINE WORKSHOP Part 1', 'Workshop kali ini kita akan belajar mengenai salah satu cara untuk membuat robot dalam bentuk program menggunakan sebuah platform, yang nantinya bisa mengautomasi pekerjaan rutin kamu, sehingga tidak perlu repot berulang kali untuk mengerjakannya. \r\n                <br>Kalian gak perlu khawatir, karena kita bisa membuat bot tanpa perlu skill coding atau memiliki background IT sebelumnya lho! Asik kan, jadi siapapun bisa banget untuk belajar dan membuatnya. Yang penting teman-teman memiliki kemauan untuk belajar.\r\n                <br><br>Menarik bukan? Yuk belajar  bersama Automate All, bareng Tentor Annas Wahyu (Chief Technology Automate All).', '/img/onlineCourse/Learn To Build Robot.jpg', '2020-11-13 06:30:00', '2020-11-13 09:00:00', 'FREE', NULL, 'https://part1.automateall.id', 1, 0, ''),
('ACDv4U3Z6Z', 'Learn PDF Automation', 'ONLINE WORKSHOP Part 2', 'Kalian tahu nggak sih kalau dengan teknologi canggih pada RPA (Robotic Process Automation), kita bisa melakukan PDF Automation, yang dapat mengenali sebuah gambar menjadi data teks yang dapat dibaca oleh Komputer. Baik file pdf yang dapat diedit maupun yang tidak.\r\n<br><br>\r\nManfaatnya adalah dapat mempercepat & mempermudah pengumpulan data dari 1 atau lebih file pdf (terutama untuk file pdf yang tidak dapat diedit).\r\n<br>\r\nPenasaran bukan? Nah buat teman-teman yang ingin belajar dan mengetahui bagaimana proses PDF Automation bisa banget gabung di workshop ini.\r\n<br>\r\nTenang aja kalian akan didampingi oleh tentor yang ahli di bidangnya bersama Dicky Prasetiyo (Chief Science Automate All).\r\n<br><br>\r\nJangan khawatir guys, workshop ini terbuka untuk umum ya! Hanya dengan investasi 99rb atau gratis* kamu sudah bisa mengautomasi pekerjaan dokumen kamu loh. Jadi kamu punya banyak waktu untuk bersantai sambil menunggu bot mengerjakan pekerjaan kamu. \r\n<br><br>\r\nKamu ga paham coding/teknik? Tenang, materi ini mudah dipahami semua kalangan dan kita menyediakan grup konsultasi selamanya.', '/img/onlineCourse/Learn PDF Automation.png', '2020-11-14 06:30:00', '2020-11-14 08:30:00', '99000', 1, 'https://part2.automateall.id ', 1, 0, 'Free because other workshop part 1');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` varchar(255) NOT NULL,
  `idDaftar` varchar(255) DEFAULT NULL,
  `idCourseDaftar` varchar(255) DEFAULT NULL,
  `idCoupon` varchar(255) DEFAULT NULL,
  `metode` tinytext NOT NULL,
  `tglBayar` datetime NOT NULL DEFAULT current_timestamp(),
  `hargaAwal` mediumint(4) NOT NULL,
  `diskon` mediumint(4) NOT NULL DEFAULT 0,
  `total` mediumint(4) NOT NULL,
  `bukti` tinytext NOT NULL,
  `keterangan` tinytext NOT NULL DEFAULT 'belum upload' COMMENT 'belum upload > pengecekan > terverifikasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` varchar(255) NOT NULL,
  `code` tinytext NOT NULL,
  `potongan` int(11) NOT NULL DEFAULT 0,
  `keterangan` tinytext NOT NULL,
  `tglMulai` datetime NOT NULL,
  `tglSelesai` datetime NOT NULL,
  `idVital` longtext DEFAULT NULL,
  `jumlah` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `potongan`, `keterangan`, `tglMulai`, `tglSelesai`, `idVital`, `jumlah`, `isDelete`) VALUES
('CPNarkavidia', 'ARKAVIDIA-A', 100, 'discount', '2021-01-31 06:09:00', '9999-01-29 06:09:00', '', -1, 0),
('CPNarkavidiab', 'ARKAVIDIA-B', 50, 'discount', '2021-01-31 06:09:00', '9999-01-29 06:09:00', NULL, -3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coursedaftar`
--

CREATE TABLE `coursedaftar` (
  `id` varchar(255) NOT NULL,
  `idCourse` varchar(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `idSertifikat` varchar(255) DEFAULT NULL,
  `uniqueCode` tinytext NOT NULL,
  `tglDaftar` datetime NOT NULL DEFAULT current_timestamp(),
  `maxTglBayar` datetime NOT NULL,
  `jumlahBayar` tinytext NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `ulasan` tinytext NOT NULL,
  `updateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `createDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursedaftar`
--

INSERT INTO `coursedaftar` (`id`, `idCourse`, `idUser`, `idSertifikat`, `uniqueCode`, `tglDaftar`, `maxTglBayar`, `jumlahBayar`, `rating`, `ulasan`, `updateDate`, `createDate`) VALUES
('row ini jangan dihapus', 'row ini jangan dihapus', 'row ini jangan dihapus', NULL, 'row ini jangan dihapus', '2021-01-29 01:00:10', '2021-01-29 01:00:10', '9999999999', 0, '', '2021-01-29 01:00:10', '2021-01-29 01:00:10'),
('row ini jangan dihapus 2', 'row ini jangan dihapus 2', 'row ini jangan dihapus 2', NULL, 'row ini jangan dihapus 2', '2021-01-29 01:00:10', '2021-01-29 01:00:10', '9999999999', 0, '', '2021-01-29 01:00:10', '2021-01-29 01:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `courseepisode`
--

CREATE TABLE `courseepisode` (
  `id` varchar(255) NOT NULL,
  `idSection` varchar(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `no` tinyint(4) NOT NULL,
  `deskripsi` tinytext NOT NULL,
  `durasi` tinytext NOT NULL,
  `linkVideo` tinytext NOT NULL,
  `linkThumbnail` tinytext NOT NULL,
  `isIntroduction` tinyint(1) NOT NULL,
  `isDelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courseepisode`
--

INSERT INTO `courseepisode` (`id`, `idSection`, `nama`, `no`, `deskripsi`, `durasi`, `linkVideo`, `linkThumbnail`, `isIntroduction`, `isDelete`) VALUES
('CEP3pQbn', 'CSCaGkFQ', 'Read Single PDF tanpa OCR', 7, '', '05:36', 'K9P6rVP_XqY', '', 0, 0),
('CEP9cxhf', 'CSCaibpw', 'Create Multi PDF', 6, '', '04:39', 'p4x_nxcT6-M', '', 0, 0),
('CEP9uBpV', 'CSC0IXYa', 'RPA dan Excel Automation', 1, '', '04:33', 'KetD7Mx4w5g', '', 0, 0),
('CEPb3Dg8', 'CSCtnQLI', 'Menjadikan Prosesnya Dinamis', 5, '', '05:34', 'F3HnYB8fZwc', '', 0, 0),
('CEPbLQzR', 'CSCtfTG3', 'Refresh Pivot Table', 11, '', '03:49', '96NAT3iSNPI', '', 0, 0),
('CEPc2eTq', 'CSCtnQLI', 'Membuat Proses Automasi Email', 4, '', '16:51', 'dJGZnWordac', '', 0, 0),
('CEPcuBBG', 'CSCq4V65', 'Apa itu RPA', 1, '', '03:02', 'inc-t5rVbDg', '', 0, 0),
('CEPDM4Bu', 'CSC021vg', 'Read Row Cell', 6, '', '06:29', '3V9WeIjXCWc', '', 0, 0),
('CEPEixCH', 'CSCaGkFQ', 'Read Single PDF dengan OCR', 8, '', '09:01', '5K5rWUFZQO4', '', 0, 0),
('CEPGuFTI', 'CSCN6lqt', 'Copy Excel', 7, '', '05:02', 'sJNPup3Eh6U', '', 0, 0),
('CEPHeBlN', 'CSCSIN7g', 'Split Data bagian 2', 11, '', '01:45', 'XWxfC8HC0hY', '', 0, 0),
('CEPHrUa8', 'CSCt9TlD', 'Membuat Lookup', 13, '', '07:24', 'TS0hAJv03cY', '', 0, 0),
('CEPHUPMi', 'CSC021vg', 'Write Excel', 4, '', '09:04', 'd20rcy5hY-U', '', 0, 0),
('CEPj0W3W', 'CSC021vg', 'Read Excel', 5, '', '05:23', 'eyylMCwyYec', '', 0, 0),
('CEPjPt8f', 'CSCSIN7g', 'Get Data Nomor Transaksi', 12, '', '06:53', '2sFit59oPDU', '', 0, 0),
('CEPQm9dR', 'CSCIPpLA', 'Download UiPath Studio Pro', 2, '', '04:05', '6cG77EQdR8Y', '', 0, 0),
('CEPrQq7Y', 'CSCt9TlD', 'Menjalankan Rumus Excel', 12, '', '05:32', '002TvL7uu4I', '', 0, 0),
('CEPrz7Py', 'CSCqwes1', 'Pengenalan Kelas Email Automation', 0, '', '00:28', 'TK9D9kedPt8', '/img/onlineCourse/thumbnails/EMAILANNAS-THUMB.jpg', 1, 0),
('CEPS6fpk', 'CSCaibpw', 'Create Single PDF', 5, '', '02:57', 'mm5-m7p-2Sc', '', 0, 0),
('CEPs7Y1u', 'CSC62mdp', 'Pengenalan Kelas Excel Automation', 0, '', '01:01', '2vJI2YkaUzk', '/img/onlineCourse/thumbnails/EXCELDICKY-THUMB.jpg', 1, 0),
('CEPsKUqU', 'CSCSIN7g', 'Input to Excel', 13, '', '06:48', 'aaFjX0L4lJk', '', 0, 0),
('CEPTfSrZ', 'CSCpald7', 'Pengenalan Kelas PDF Automation', 0, '', '01:04', 'Mmhv4XRgwiw', '/img/onlineCourse/thumbnails/PDFDICKY-THUMB.jpg', 1, 0),
('CEPtIu3C', 'CSC0IXYa', 'Instalasi UiPath Studio Pro', 3, '', '02:55', '1HyKDFHhY4U', '', 0, 0),
('CEPTt79F', 'CSC0IXYa', 'Download UiPath Studio Pro', 2, '', '04:05', '6cG77EQdR8Y', '', 0, 0),
('CEPu5kCC', 'CSCN6lqt', 'Append Excel', 8, '', '07:08', 'FFIzIh8KPbU', '', 0, 0),
('CEPu5mLU', 'CSCtfTG3', 'Create Pivot Table', 10, '', '03:21', '7k6aUhqTI68', '', 0, 0),
('CEPUXEZ3', 'CSCtnQLI', 'Pengaturan Email', 3, '', '01:52', 'Lgc8tslBtiM', '', 0, 0),
('CEPUz7on', 'CSCIPpLA', 'Instalasi UiPath Studio Pro', 3, '', '02:55', '1HyKDFHhY4U', '', 0, 0),
('CEPv3Pc1', 'CSCSIN7g', 'Split Data bagian 1', 10, '', '04:51', 'Ah_XLDmldXk', '', 0, 0),
('CEPvQohr', 'CSCIPpLA', 'Mengkonfigurasi Aplikasi UiPath Studio Pro', 4, '', '04:19', 'Rbe3BMCNlPI', '', 0, 0),
('CEPw807d', 'CSCq4V65', 'Automasi Sederhana', 2, '', '07:00', 'cQ5b1f0IxUg', '', 0, 0),
('CEPwvEuO', 'CSCaGkFQ', 'Read Multi PDF dengan OCR', 9, '', '07:43', '7Fn3AAMThoU', '', 0, 0),
('CEPx4Xpf', 'CSCIPpLA', 'Pengenalan RPA dan PDF Automation', 1, '', '06:24', '7_R-trtDvqQ', '', 0, 0),
('CEPXe9pS', 'CSCtfTG3', 'Sorting Table', 9, '', '05:16', 'MON-mY0hdmI', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courseinstructur`
--

CREATE TABLE `courseinstructur` (
  `id` varchar(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `foto` tinytext NOT NULL,
  `keterangan` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courseinstructur`
--

INSERT INTO `courseinstructur` (`id`, `nama`, `foto`, `keterangan`) VALUES
('INSannas', 'Annas Wahyu', '', 'CTO of Automate All'),
('INSdicky', 'Dicky Prasetiyo', '', 'CSO of Automate All'),
('INSkahfi', 'Muhammad Alkahfi', '', 'CIO of Automate All');

-- --------------------------------------------------------

--
-- Table structure for table `courseonline`
--

CREATE TABLE `courseonline` (
  `id` varchar(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `kategori` tinytext NOT NULL,
  `deskripsiSingkat` text NOT NULL,
  `deskripsi` text NOT NULL,
  `linkThumbnail` tinytext NOT NULL,
  `linkTelegram` tinytext DEFAULT NULL,
  `linkMateri` tinytext DEFAULT NULL,
  `persyaratan` longtext NOT NULL,
  `mendapatkan` longtext NOT NULL,
  `mempelajari` longtext NOT NULL,
  `idStruktur` varchar(255) NOT NULL,
  `lastUpdate` datetime NOT NULL DEFAULT current_timestamp(),
  `biaya` tinytext NOT NULL,
  `durasiBerlangganan` tinytext NOT NULL DEFAULT '-1' COMMENT 'durasi berlangganan dalam satuan hari (-1 = selamanya)',
  `tools` longtext NOT NULL,
  `OS` tinytext NOT NULL,
  `RAM` tinytext NOT NULL,
  `Storage` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courseonline`
--

INSERT INTO `courseonline` (`id`, `nama`, `kategori`, `deskripsiSingkat`, `deskripsi`, `linkThumbnail`, `linkTelegram`, `linkMateri`, `persyaratan`, `mendapatkan`, `mempelajari`, `idStruktur`, `lastUpdate`, `biaya`, `durasiBerlangganan`, `tools`, `OS`, `RAM`, `Storage`) VALUES
('CONemaau', 'Email Automation using UiPath Studio Pro', 'RPA', 'Mahir menerapkan Robotic Process Automation dalam mengautomasi Email', 'Pengiriman surat elektronik bisa menjadi hal yang rutin kita kerjakan. Bila kita biasa melakukannya secara manual, mungkin bisa beralih ke teknik yang lebih modern, yaitu dengan menerapkan automasi. Kita tahu bahwa automasi akan membuat suatu pekerjaan dapat beroperasi secara otomatis sehingga mengurangi beban kerja kita. Automasi Email sendiri dapat dilakukan dengan banyak cara. Kelas ini akan menjelaskan penerapan sebuah teknologi bernama Robotic Process Automation, dalam mengautomasi pekerjaan Email kita. Dijamin bakal seru dan akan bermanfaat untuk kita, jadi tunggu apalagi? yuk bergabung dengan kelas ini!', '/img/onlineCourse/thumbnails/EMAILANNAS-THUMB.jpg', 'https://t.me/joinchat/TBosFmHX1w0Nr5B2', NULL, 'Memiliki kemauan untuk belajar;;Memiliki komputer dan sejenisnya dengan sistem operasi Windows', '35 menit total durasi video;;Akses kelas seumur hidup', 'Mengenal apa itu Robotic Process Automation, dan Email Automation;;Mengetahui manfaat yang akan diperoleh dan juga cara kerjanya;;Dapat mengautomasi Email menggunakan tools UiPath Studio Pro', 'INSannas', '2021-01-29 10:20:42', '99000', '-1', 'UiPath Studio Pro;;Google Chrome', 'Windows 7 / 8 / 10', '4 GB', '1 GB'),
('CONexcau', 'Excel Automation using UiPath Studio Pro', 'RPA', 'Mampu mengautomasi file Excel dengan Robotic Process Automation dan Platform UiPath', 'Excel bisa diautomasi? Lalu apa itu RPA? kedua pertanyaan tersebut dapat terjawab setelah mengikuti kelas ini loh.<br>Halo semua! banyak diantara kita yang telah mengenal sebuah aplikasi atau program spreadsheet bernama Microsoft Excel yang dapat digunakan untuk mengelola data serta melakukan perhitungan. Aplikasi itu sangat membantu keseharian kita. Saat ini, ada sebuah cara yang dapat digunakan untuk membuat pekerjaan kamu di Excel menjadi lebih mudah, cepat dan tidak bosan, yaitu dengan mengautomasinya. Automasi atau membuat suatu pekerjaan menjadi otomatis sebenarnya teknik yang sudah lama digunakan, namun mungkin kita belum mengetahui bagaimana caranya mengautomasi Excel.<br>Kelas ini akan menerapkan teknologi modern yaitu Robotic Process Automation yang disingkat RPA, untuk mengautomasi beberapa proses yang terjai di Excel, seperti memasukan data kedalamnya, membuat table dan lainnya yang tentu akan bermanfaat untuk mu.<br>Jadi tunggu apalagi? yuk bergabung dengan kelas ini.', '/img/onlineCourse/thumbnails/EXCELDICKY-THUMB.jpg', 'https://t.me/joinchat/TIBXykWe62mbmYrX', 'https://drive.google.com/drive/folders/1Q3iPe5ki4MaZmWr5Xpp5wP8bP-8DAKIe?usp=sharing', 'Memiliki kemauan untuk belajar;;Memiliki komputer dan sejenisnya dengan sistem operasi Windows', '1 Jam total durasi video;;Akses kelas seumur hidup;;Sertifikat Elektronik', 'Mengenal apa itu Robotic Process Automation, manfaat yang akan diperoleh dan juga cara kerjanya;;Mengetahui proses Excel yang dapat diautomasi dan cara kerjanya;;Mampu menggunakan tools UiPath Studio Pro;;Mampu melakukan Read, Write, Copy, dan Append pada file Excel;;Mampu membuat serta mengelola pivot table;;Mengautomasi penggunaan rumus atau formula pada Excel', 'INSdicky', '2021-01-29 10:17:31', '199000', '-1', 'UiPath Studio Pro;;Microsoft Excel;;Google Chrome', 'Windows 7 / 8 / 10', '4 GB', '1 GB'),
('CONpdfau', 'PDF Automation using UiPath Studio Pro', 'RPA', 'Mahir automasi PDF dengan teknologi terkini yaitu Robotic Process Automation (RPA) dan platform UiPath.', 'Apakah kamu pernah mendengar teknologi bernama <em>Robotic Process Automation</em> atau yang disingkat dengan <strong>RPA</strong>? atau kamu pernah membuat pekerjaan rutinmu di komputer menjadi <strong>otomatis</strong>? seperti dijalankan oleh suatu program tertentu yang terjadwal sehingga kamu tidak perlu melakukannya dengan manual. Bila belum pernah, <strong>jangan khawatir ya</strong>, karena kelas ini tepat untuk mu!<br> Di kelas ini, instruktur akan menjelaskan mengenai ilmu automasi dari dasar, lalu tools atau aplikasi yang dapat digunakan untuk pembuatan automasinya, serta khusus untuk kelas ini, ilmu tersebut akan diaplikasikan secara langsung, karena kita akan membuat sebuah rentetan proses automasi terhadap <strong>Portable Document File (PDF)</strong>. Jadi, tunggu apalagi? yuk bergabung di kelas ini!😊', '/img/onlineCourse/thumbnails/PDFDICKY-THUMB.jpg', 'https://t.me/joinchat/T88vvNWhAq7U3zr1', 'https://drive.google.com/drive/folders/1FTvFG1Vc55afYYpciyFzSRmwgojgBsJS?', 'Memiliki kemauan untuk belajar;;Memiliki komputer dan sejenisnya dengan sistem operasi Windows', '1 Jam total durasi video;;Akses kelas seumur hidup;;Sertifikat Elektronik', 'Mengenal apa itu Robotic Process Automation, manfaat yang akan diperoleh dan juga cara kerjanya;;Mengetahui bagaimana proses automasi terhadap file PDF dilakukan;;Mampu menggunakan tools UiPath Studio Pro;;Mampu mengautomasi pembuatan file PDF;;Mampu membaca file PDF baik dengan atau tanpa teknologi Optical Character Recognition (OCR);;Mampu mengelola isi PDF dan menyimpannya dalam bentuk file Excel', 'INSdicky', '2021-01-29 08:16:27', '199000', '-1', 'UiPath Studio Pro;;Google Chrome', 'Windows 7 / 8 / 10', '4 GB', '1 GB');

-- --------------------------------------------------------

--
-- Table structure for table `courseprogress`
--

CREATE TABLE `courseprogress` (
  `id` varchar(255) NOT NULL,
  `idDaftar` varchar(255) DEFAULT NULL,
  `idEpisode` varchar(255) DEFAULT NULL,
  `tglSelesai` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courseprogress`
--

INSERT INTO `courseprogress` (`id`, `idDaftar`, `idEpisode`, `tglSelesai`) VALUES
('CPG71A7b', 'CDFv02Ro', 'CEPx4Xpf', '2021-02-11 14:40:43'),
('CPG730If', 'CDF4poVj', 'CEPx4Xpf', '2021-01-31 01:24:28'),
('CPGFy0Nb', 'CDF4poVj', 'CEPUz7on', '2021-02-05 02:41:40'),
('CPGHi0J8', 'CDF4poVj', 'CEPTfSrZ', '2021-01-30 22:09:52'),
('CPGplD0Y', 'CDFv02Ro', 'CEPTfSrZ', '2021-02-11 14:40:36'),
('CPGxgsg0', 'CDF4poVj', 'CEPQm9dR', '2021-01-31 01:26:04'),
('default', NULL, NULL, NULL),
('default1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coursesection`
--

CREATE TABLE `coursesection` (
  `id` varchar(255) NOT NULL,
  `idCourse` varchar(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `no` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursesection`
--

INSERT INTO `coursesection` (`id`, `idCourse`, `nama`, `no`) VALUES
('CSC021vg', 'CONexcau', 'Write, Read Excel', 2),
('CSC0IXYa', 'CONexcau', 'Persiapan Awal', 1),
('CSC62mdp', 'CONexcau', 'Introduction', 0),
('CSCaGkFQ', 'CONpdfau', 'Read PDF', 3),
('CSCaibpw', 'CONpdfau', 'Create PDF', 2),
('CSCIPpLA', 'CONpdfau', 'Persiapan Awal', 1),
('CSCN6lqt', 'CONexcau', 'Copy, Append Excel', 3),
('CSCpald7', 'CONpdfau', 'Introduction', 0),
('CSCq4V65', 'CONemaau', 'RPA dan Automasi', 1),
('CSCqwes1', 'CONemaau', 'Introduction', 0),
('CSCSIN7g', 'CONpdfau', 'Input dan Split Data PDF', 4),
('CSCt9TlD', 'CONexcau', 'Formula', 5),
('CSCtfTG3', 'CONexcau', 'Excel Table', 4),
('CSCtnQLI', 'CONemaau', 'Automasi Email', 2);

-- --------------------------------------------------------

--
-- Table structure for table `coursesertifikat`
--

CREATE TABLE `coursesertifikat` (
  `id` varchar(255) NOT NULL,
  `token` tinytext NOT NULL,
  `version` varchar(10) NOT NULL,
  `location` tinytext NOT NULL,
  `createDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updateDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursesertifikat`
--

INSERT INTO `coursesertifikat` (`id`, `token`, `version`, `location`, `createDate`, `updateDate`) VALUES
('CSTaYOfd', 'SAI-OC-ZWJrdnNYclRrUlJYSml3MA==-YUtSd3BXND0=', '1', '/public/user/Z77GWCLZ1EOC2HBWTMXG/pesan/CDF4poVj/SAI-OC-ZWJrdnNYclRrUlJYSml3MA==-YUtSd3BXND0=.pdf', '2021-02-05 15:59:38', '2021-02-05 15:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `id` varchar(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `idPendaftar` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idPengajak` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idAcademy` varchar(255) CHARACTER SET latin1 NOT NULL,
  `namaPengajak` tinytext NOT NULL,
  `whatsapp` tinytext NOT NULL,
  `organisasi` tinytext NOT NULL,
  `jumlahBayar` mediumint(4) NOT NULL,
  `tglDaftar` datetime NOT NULL DEFAULT current_timestamp(),
  `maxTglBayar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `linkConfirm`
--

CREATE TABLE `linkConfirm` (
  `token` varchar(255) NOT NULL,
  `tglTerbuat` datetime NOT NULL,
  `type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linkConfirm`
--

INSERT INTO `linkConfirm` (`token`, `tglTerbuat`, `type`) VALUES
('dGtuPTlNSzUwMXMxajMmZW1haWw9bG9sb0BnbWFpbC5jb20mZGF0ZT0yMDIxLTAxLTAyIDA1OjI0OjAz', '2021-01-02 05:24:03', 'verifyAccount'),
('dGtuPTYzR0tBazYzNTAmZW1haWw9aXJmYW5udWdyYWhhODQ0QGdtYWlsLmNvbSZkYXRlPTIwMjEtMDEtMDQgMDU6MTU6MTY=', '2021-01-04 05:15:16', ''),
('dGtuPUwyanRmVkQ3TXomZW1haWw9a29rb0BnbWFpbC5jb20mZGF0ZT0yMDIwLTEyLTAxIDE2OjQzOjI0', '2020-12-01 16:43:24', 'verifyAccount'),
('dGtuPWJySTNWMkRncjMmZW1haWw9aXJmYW5udWdyYWhhODQ0QGdtYWlsLmNvbSZkYXRlPTIwMjAtMTItMDEgMTY6NDI6MzE=', '2020-12-01 16:42:31', 'verifyAccount'),
('VzVjd0JqM1ZNVXR2KzdhaFZGTUVsdFdqTlIwa1JYVVJjN0F5T3pLUjNNc2g5NHVHb2tnSG9hdERrZHR1dnAydHNPUURDWnhTK2Y1R25aMFFuWkFTNjczNlFnQT0=', '2021-01-07 01:20:36', 'verifyAccount'),
('VzVjd0JqTEtaanB4ZzVDQUtBUUVsdFdqTlIwa1Rub21SYUp1TDI3M3NidDcybzJDcnc4STRLVUttSngrdXRUNnZlUUNGcDFPNVA1WWpac0ZsNU1RNDdqeA==', '2021-01-13 15:28:51', 'verifyAccount'),
('VzVjd0JqTFdGQWhxKzY2bkZBWUVsdFdqTlIwa1JYVVJjN0F5T3pLUjNNc2g5NHVHb2tnSG9hdERrZHR1dnAydHNPUURDWnhTK2Y1R25aSVFuWklTNjc3NlFBQT0=', '2021-01-08 03:23:16', 'verifyAccount'),
('VzVjd0JqVENJRGw5bkt1NFVUNEVsdFdqTlIwa1JYQnFXN0pKTDFtTnU3MVUxSmFoaVVNLzdQeC9yY0EzbjRpOStibGVXdGthcUtNSGc4TlVpOFZKcmVqOVF3YmdDNUl1R0wwa0pwMjgzdjBXU1VCVGhBPT0=', '2021-01-27 19:54:02', 'verifyAccount'),
('VzVjd0JraVBZQ2hxcWFtZkRCOEVsdFdqTlIwa1JDdHFYNTh5UEh1V3pMRmYwNnVIcWtNdjY0Wi9xNnRBanIzNHNKWlVWc3dXcGVFSXdzY1d5Y0JjdkxEeVFRVGpGNDhzQktBdk1ZKzkzZk1TUjBwVQ==', '2021-02-09 20:41:07', 'verifyAccount'),
('VzVjd0JrelZKMFY2K2JLdlZoSUVsdFdqTlIwa1JYQnFXN0pKTDFtTnU3MVUxSmFoaVVNLzdQeC9yY0EzbjRpOStibGVXdGthcUtNSGc4TlVpOFZKcmVqOVF3YmdDNUl1R0wwa0pwMi8xLzBUU1VCUWdBPT0=', '2021-01-27 20:04:36', 'verifyAccount'),
('VzVjd0JrNk9aVEFkL0pHQ0ppMEVsdFdqTlIwa1FuQnJYTE5KTjFtTnU2Rlo0SWFsakdFTTRxbEZrTk5wc0lUdTZiZEhYcEJOK2YxYWdKb0NnSkVaK2J6NVN3UGtBSXdv', '2021-02-01 19:56:36', 'verifyAccount'),
('VzVjd0JrS0RDa3R4Ky9hYlVTSUVsdFdqTlIwa1Rub21SYUp1TDI3M3NidDcybzJDcnc4STRLVUttSngrdXRUNnZlUUNGcDFPNVA1WWpac0ZsNUlZNDcveA==', '2021-01-13 15:30:21', 'verifyAccount'),
('VzVjd0JsS0xJRTVqLzQ2TktpWUVsdFdqTlIwa1FuRTNlNHN5TkhpUDhyVkUrYmlNK21FTTRxbEZrTk5wc0lUdTZiZEhYcEJOK2YxYWdKb0JnSk1SK2IveVN3ZmlBSXNz', '2021-01-29 22:10:42', 'verifyAccount'),
('VzVjd0JsWHpZaE5EbzZ1VURBWUVsdFdqTlIwa1JYVVJjN0F5T3pLUjNNc2g5NHVHb2tnSG9hdERrZHR1dnAydHNPUURDWnhTK2Y1R25aMFFuSmNTNmI3NlJBVT0=', '2021-01-07 16:03:53', 'verifyAccount'),
('VzVjd0Jtam9PazFwL0tQRVVSOEVsdFdqTlIwa1JYVVJlN0F5TjFPUjNNc2g5NHVHb2tnSG9hdERrZHR1dnAydHNPUURDWnhTK2Y1R25aMFFuSmNTNmJuNlJRND0=', '2021-01-07 16:04:48', 'verifyAccount'),
('VzVjd0JtMkROamdjL1l1Q1dGd0VsdFdqTlIwa1JXRTRYTEF5TDFtVXo1TmUrS25TcW1FTTRxbEZrTk5wc0lUdTZiZEhYcEJOK2YxYWdKb0NnSkVjK2J6eFN3UGtBSTBu', '2021-02-04 11:56:29', 'verifyAccount'),
('VzVjd0JtV09OazlLdGE2UkJsSUVsdFdqTlIwa1JYVVJjN0F5T3pLUjNNc2g5NHVHb2tnSG9hdERrZHR1dnAydHNPUURDWnhTK2Y1R25aMFFuWkFTNjcvNlFBST0=', '2021-01-07 01:22:14', 'verifyAccount'),
('VzVjd0JtZk5GeXRtbnFleUZ5Y0VsdFdqTlIwa1JVNXJYSjVGRlVtUHU3MWYxSmFNK21FTTRxbEZrTk5wc0lUdTZiZEhYcEJOK2YxYWdKb0JnSkFSK2J6elN3YnJBSXdv', '2021-01-19 13:09:36', 'verifyAccount'),
('VzVjd0JtZmVGVThlK3ZPU0JWd0VsdFdqTlIwa1Rub21SYUp1TDI3M3NidDcybzJDcnc4STRLVUttSngrdXRUNnZlUUNGcDFPNVA1WWpac0ZsNVVmNDduMwxsamxxsamx', '2021-01-13 15:47:47', 'verifyAccount'),
('VzVjd0JuMkpGZ3RiOXZmRUdWb0VsdFdqTlIwa1JYVVJjN0F5T3pLUjNNc2g5NHVHb2tnSG9hdERrZHR1dnAydHNPUURDWnhTK2Y1R25aSVFuWklTNjd6NlJBOD0=', '2021-01-08 03:21:59', 'verifyAccount');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL DEFAULT 'judul kosong',
  `isi` longtext NOT NULL DEFAULT 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
  `tanggalUpload` datetime NOT NULL DEFAULT current_timestamp(),
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `img` text NOT NULL DEFAULT '/img/news/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `judul`, `isi`, `tanggalUpload`, `isDeleted`, `img`) VALUES
(0, 'Yakin password kamu sudah aman', '<p>Udah 2021 tapi masih aja ada yang menggunakan Password yang mudah ditebak? Wahh, kayaknya sobat automate all harus mulai ngecek passwordnya masing-masing deh, karena kalian harus memastikan bahwa password yang kalian gunakan untuk aplikasi digital memang udah aman dan bebas terhindar dari peretasan. </p>\r\n<br>\r\n<p>Pada era digital, penggunaan password atau kata sandi sangat penting demi menjaga keamanan akun-akun media sosial maupun layanan digital lainnya. Namun, masih belum banyak masyarakat yang paham pentingnya membuat kata sandi yang \"unik\" untuk mencegah peretasan.\r\n<br><br>\r\nMenurut laporan dari NordPass, penyedia layanan password manager, ada sekitar 200 password rentan yang masih banyak digunakan pengguna internet. NordPass menganalisis lebih dari 275 juta password yang berhasil diretas hacker sepanjang 2020, dan hanya 44 persen dari total password yang diteliti, masuk dalam kategori \"unik\".\r\n<br><br>\r\nDalam membuat password yang aman memang membutuhkan cara yang agak \"tricky\". Bisa dengan huruf, simbol, dan angka di tempat yang tak terduga dalam susunan kata sandi. Hindari menggunakan informasi pribadi sebagai password, seperti tanggal lahir atau nama Anda sendiri.', '2021-01-08 04:46:34', 0, '/img/news/Yakin password kamu sudah aman.png'),
(1, 'Skill yang paling dicari di Era Teknologi', '<p>Baru-baru ini penyedia layanan analisis pasar kerja, Burning Glass Technologies, mempublikasi hasil studi terkait</p>\r\n<br>\r\n<p>keterampilan yang paling banyak dicari di dunia teknologi informasi (TI) saat ini. Sebagian jenis pekerjaan ini bisa bilang dibilang jenis pekerjaan yang baru muncul lima tahun terakhir. 5 skill ini masuk ke dalam kategori disruptor, alias keterampilan yang paling banyak di cari saat ini serta diprediksi memiliki prospek yang bagus lima tahun mendatang.</p>\r\n<br>\r\n<p>1. Quantum Computing</p>\r\n<p>Keterampilan yang berkaitan dengan membangun dan memanfaatkan komputer kuantum dan aplikasinya.</p>\r\n<br>\r\n<p>2. Connected technologies</p>\r\n<p>Keterampilan yang berkaitan dengan dengan Internet of Things (IoT) dan alat \\ fisik yang terhubung, serta infrastruktur telekomunikasi yang diperlukan untuk mengaktifkannya, seperti 5G.</p>\r\n<br>\r\n<p>3. Fintech</p>\r\n<p>Keterampilan yang berkaitan dengan teknologi blockchain dan lainnya yang bertujuan untuk membuat transaksi keuangan lebih efisien dan aman.</p>\r\n<br>\r\n<p>4. AI dan Machine Learning</p>\r\n<p>keterampilan yang berkaitan dengan pengembangan dan pemanfaatan program, alat, dan solusi, yang didukung oleh algoritma dan teknologi lain yang secara otomatis merespons dan meningkat berdasarkan pengalaman atau data sebelumnya.</p>\r\n<br>\r\n<p>5. IT automation</p>\r\n<p>Keterampilan yang berkaitan dengan kegiatan mengotomatisasi dan mengatur proses dan alur kerja digital.</p>', '2021-01-09 11:04:29', 0, '/img/news/Skill yang paling dicari di Era Teknologi.png'),
(2, 'Apa yang bisa dilakukan Big Data dalam Bisnis', '<p>Hi guys, udah pada tau sama big data kan? Jadi Big Data merupakan kumpulan data yang terstruktur, semi-terstruktur, hingga tidak terstruktur / abstrak dalam volume besar yang memiliki potensi untuk diolah sebagai informasi yang akan berguna untuk proyek machine learning dan aplikasi analisis canggih lainnya.</p>\r\n<p>Ada 3 hal yang bisa didapatkan dalam penggunaan big data</p>\r\n<br>\r\n<p>1. Mengoptimalisasi Cost</p>\r\n<p>Kemampuan untuk melakukan data processing serta analisis secara mendalam, dapat membentuk pola baru yang dapat menemukan kelompok target market baru dengan cost yang lebih sedikit. Sehingga, perusahaan dapat menggunakan cost secara optimal.</p>\r\n<br>\r\n<p>2. Meningkatkan efektifitas dan efisiensi bisnis</p>\r\n<p>Big data memiliki kemampuan untuk mencari jalan tercepat untuk menghasilkan sesuatu, seperti flow bisnis yang lebih efektif & efisien, hingga konsumen mana yang memiliki potensi keinginan untuk membeli yang tinggi. Semua itu tentu dapat dideteksi lebih awal dengan big data</p>\r\n<br>\r\n<p>3. Product Development</p>\r\n<p>Dengan kemampuan membaca kebiasaan & pola pengguna di internet, informasi yang dihasilkan oleh big data dapat digunakan oleh perusahaan untuk menyesuaikan produk dengan minat pasar dan tentu akan menguntungkan bagi bisnis.</p>', '2021-01-12 11:04:29', 0, '/img/news/Apa yang bisa dilakukan Big Data dalam Bisnis.png'),
(3, 'Tips memilih Teknologi yang tepat untuk Startup Anda!', '<p>Dalam membangun sebuah bisnis tentu ada banyak hal yang perlu kita perhatikan dan perlu kita pertimbangkan dengan sebaik-baiknya, salah satunya adalah teknologi yang menunjang jalannya bisnis kalian. So, Mimin mau kasih tips ke kalian gimana cara memilih teknologi yang tepat ketika membangun sebuah startup.</p>\r\n<p>berikut 4 tips teknologinya</p>\r\n<br>\r\n<p>1. Memilih Platform</p>\r\n<p>Terdapat 2 hal utama yang perlu dipertimbangkan yakni platform seluler atau web. Biasanya lebih aman menggunakan aplikasi web terlebih dahulu karena lebih fleksibel dan memberikan ruang untuk perbaikan kesalahan.</p>\r\n<br>\r\n<p>2. Memilih Perangkat</p>\r\n<p>Bisnis Anda memerlukan perangkat yang andal dan kuat. Seperti PC, laptop, tablet, smartphone sesuai dengan kebutuhan bisnis.</p>\r\n<br>\r\n<p>3. Memilih Sistem Operasi</p>\r\n<p>Bisnis harus mengetahui apa yang sedang dikerjakan dan perangkat digunakan di perusahaan. Serta dapat memilih sistem operasi yang tepat untuk peralatan Bisnis. Seperti Windows, IoS, Linux, dll.</p>\r\n<br>\r\n<p>4. Memilih Stack</p>\r\n<p>Memilih stack bergantung pada platform, jenis produk, dan jumlah pengguna yang diharapkan. Biasanya mengarah pada Framework, Bahasa pemrograman, server, database, dll.</p>\r\n', '2021-01-15 11:06:36', 0, '/img/news/Tips memilih Teknologi yang tepat untuk Startup Anda!.png'),
(8, 'Sudah Siapkah Memasuki Era Society 5.0?', '<h2>Latar Belakang Era Society 5.0</h2>\r\n	<p>Era Society 5.0 pertama kali dinyatakan oleh Jepang, dimana bukan teknologi yang menguasai manusia tapi manusia yang menguasai teknologi. Hal ini disebabkan karena pada revolusi industri 4.0 banyak memunculkan pandangan bahwa, pekerjaan manusia akan tergantikan oleh teknologi pintar.</p>\r\n	<h2>Perbedaan dengan Era Sebelumnya</h2>\r\n	<p>Jika revolusi 4.0 menggunakan kecerdasan buatan (Artificial Intelligent), society 5.0 tetap menggunakan teknologi modern namun dengan  komponen utamanya adalah manusia.</p>\r\n	<h2>Contoh Penerapan</h2>\r\n	<ul>\r\n		<li>di bidang kesehatan</li>\r\n		<p>Akan mengembangkan teknologi AI yang memberikan informasi mengenai detak jantung dan tekanan darah seseorang.</p>\r\n		<li>di bidang transportasi</li>\r\n		<p>Teknologi AI dapat mendeteksi apakah pengendara mengantuk atau tidak dalam kondisi baik sehingga dapat mengurangi kecelakaan.</p>\r\n	</ul>\r\n	<h2>Jadi, apakah anda sudah siap untuk Era Society 5.0?</h2>\r\n<br>', '2020-10-19 20:26:16', 0, '/img/news/Sudah Siapkah Memasuki Era Society 5.0.png'),
(9, '3 Pekerjaan Menjanjikan di Masa Depan!', '<h2>Menurut Survey</h2>\r\n	<p>Berdasarkan World Economic Forum (www.weforum.org), lebih dari 54% tenaga kerja akan memerlukan re-skilling pada 5 tahun mendatang!</p>\r\n	<h2>Sedangkan pekerjaan masa depan</h2>\r\n	<p>Menurut versi LinkedIn 2019 pekerjaan masa depan akan didominasi oleh teknologi.</p>\r\n	<h2>Berikut pekerjaannya</h2>\r\n	<ol>\r\n		<li>Artificial Intelligence (AI)</li>\r\n		<p>Mengacu pada simulasi kecerdasan manusia dalam mesin yang terprogram untuk berpikir seperti manusia dan meniru tindakannya.</p>\r\n		<li>Robotic Process Automation (RPA)</li>\r\n		<p>Konsep teknologi yang menggunakan robot untuk membantu manusia dalam melakukan pekerjaan yang bersifat repetitive (berulang-ulang).</p>\r\n		<li>Workflow Automation</li>\r\n		<p>Teknologi yang digunakan untuk mengautomasi pekerjaan manual seperti input data.<br>\r\n			Dengan Workflow Automation dapat membantu menghemat waktu dan biaya, mengurangi kesalahan, dan meningkatkan produktivitas\r\n		</p>\r\n	</ol>\r\n	<h2>Jadi, anda tertarik mendalami skill yang mana nih?</h2>\r\n</p>', '2020-10-20 22:46:12', 0, '/img/news/3 Pekerjaan Menjanjikan di Masa Depan!.png'),
(10, 'Mengenal Teknologi Otomatisasi', '  <h2>Contoh teknologi otomatisasi yang ada di sekitar</h2>\r\n  <p>Sebenarnya anda sudah merasakan manfaat dari teknologi otomatisasi di kehidupan sehari-hari.</p>\r\n  <p>Misalnya saja mesin cuci. Ada teknologi mesin cuci yang dapat bekerja dengan 1 tombol. Secara otomatis, mesin cuci tersebut akan melakukan proses mencuci hingga pengeringan.<br>Masalahnya, baju tidak memiliki akal pikiran. Benda mati. Akan  mudah untuk menciptakan sistem yang dapat bekerja dengan baik.\r\n  </p>\r\n  <h2>Bagaimana jika yang diatur oleh sistem adalah manusia</h2>\r\n  <p>Pada dasarnya, pengembangan teknologi diperuntukan bagi manusia. Sehingga teknologi otomatisasi tidak hanya digunakan untuk benda mati saja.\r\n  </p>\r\n  <h2>Lalu apa sebenarnya teknologi otomatisasi?</h2>\r\n  <p>Berdasarkan pemaparan dari Technopedia, Otomatisasi adalah pembuatan dan implementasi teknologi untuk mengontrol dan memonitor produksi dan delivery produk baik barang maupun jasa. Teknologi merupakan kunci dari otomatisasi. Untuk dapat menjalankan sistem otomatis, teknologi perlu masuk kedalam sistem. Bukan lagi sebagai sistem pendukung, tetapi justru harus menyatu dengan sistem. Jadi, jika terjadi masalah pada teknologi, maka sistem tidak akan terganggu.\r\n  </p>\r\n  <h2>Berkat kemajuan teknologi yang begitu pesat</h2>\r\n  <p>seperti adanya fitur cloud, fitur IT disaster recovery management, dan lainnya, sudah cukup ampuh untuk meng-backup jika suatu hal buruk terjadi pada sistem. Sehingga, sistem bisa terus bekerja dengan baik.', '2020-10-21 22:45:35', 0, '/img/news/Mengenal Teknologi Otomatisasi.png'),
(11, 'Sejauh Mana Penerapan Teknologi Otomatisasi di Indonesia?', '<h2>Secara global</h2>\r\n  <p>Tercatat hanya 53% executive yang bersedia untuk mengaplikasikan teknologi otomatisasi pada bisnis proses / sistem mereka.<br>47% masih ragu untuk terjun dan mencoba teknologi otomatisasi sebagai solusi.</p>\r\n  <h2>Sedangkan di Indonesia,</h2>\r\n  <p>Teknologi otomatisasi masih sepi peminat, meskipun permintaan akan teknologi tersebut terus meningkat.</p>\r\n  <p>Ada beberapa hal yang menghambat implementasi teknologi otomatisasi di Indonesia, yaitu...</p>\r\n  <ol>\r\n    <li>Cultural Resistance</li>\r\n    <p>Jika sebuah perusahaan memiliki corporate culture yang resisten terhadap perubahan, tentu akan berdampak pada lambatnya implementasi teknologi baru pada perusahaan. Jika paksaan muncul, baru perusahaan mau menggunakan teknologi tersebut.</p>\r\n    <li>Kekurangan Ahli IT</li>\r\n    <p>Melakukan rekrutmen dan seleksi tenaga ahli IT itu tidak gampang. Perusahaan harus tahu benar teknologi apa yang akan dipakai. Sayangnya, tidak semua perusahaan itu paham tentang kebutuhan IT mereka. Sehingga, banyak perusahaan besar sekalipun yang melakukan kerja sama dengan perusahaan IT.</p>\r\n    <li>Masalah Biaya</li>\r\n    <p>Tidak dipungkiri bahwa biaya menjadi pertimbangan yang cukup besar sebelum mengimplementasikan teknologi otomatisasi pada bisnis proses / sistem informasi perusahaan. Namun, jangan pernah sekali-kali terperangkap dalam jebakan “murah”, dalam proses development sistem perusahaan. Ingin untung, malah buntung.</p>\r\n  </ol>', '2020-10-23 00:28:30', 0, '/img/news/Sejauh Mana Penerapan Teknologi Otomatisasi di Indonesia.png'),
(12, '#AutoLearn1 \"Academics Output and Industrial Needs Gap : Kita bisa apa?\" (part 1)', '<p>Kesenjangan antara dunia akademik dan dunia industri teknologi kian meningkat. Dampaknya, Indonesia turun ke peringkat 50 dari 141 negara di Global Competitive Index (GCI) akhir tahun 2019. Penyebab utamanya karena tingkat adopsi teknologi yang menurun, dan diikuti turunnya beberapa variabel seperti kompetensi tenaga kerja dan kesehatan.</p>\r\n<p>Lalu apa yang perlu kita siapkan? <br> <br>\r\nAutomate All Present, On Colaboration with Miloo project <br> <br>\r\n\"Academics Output and Industrial Needs Gap : Kita bisa apa?\"\r\n</p>\r\n<p>Speaker :\r\n<br>Ferro Ferizka (Worldwide Senior Lead at Microsoft)</p>\r\n<p>Host: \r\n<br>Rahmat Ridha M (Founder of Miloo Project)</p>\r\n<p>\r\nTanggal : Sabtu, 24 Oktober 2020<br>\r\nWaktu   : pukul 15.30 - 17.30 WIB<br>\r\nTempat  : Live via zoom<br>\r\nLive    : Live on Miloo Project<br>\r\n</p>\r\n<p>RSVP<br>\r\nlink : http://bit.ly/MilooTalks24Okt</p>\r\n<p>Waktu pendaftaran maksimal hari Sabtu, 24 Oktober 2020 pukul 12:00 WIB\r\n<br>Ayo segera daftarkan dirimu! Peserta Terbatas!    \r\n</p>\r\n<h2>About Our Speaker </h2>\r\n<p>\r\nFerro Ferizka, yang menjadi pembicara kita pada kesempatan ini merupakan seseorang dengan skill multidisiplin tinggi. Dalam karir profesional, kak Ferro banyak berkontribusi di perusahaan teknologi dunia, yakni Microsoft. Menjadi Microsoft student ambassador sejak kuliah di UGM, hingga saat ini menjadi Worldwide Senior Lead di perusahaan yang sama. <br>\r\nKarir Akademiknya pun tak kalah, melanjutkan pendidikan Magister bisnis di 2 negara yakni Singapore don Australia. Lalu terlibat menjadi kepala tim transformasi digital di BAPPENAS. Membuat kak Ferro layak dipercaya menjadi Rektor di Universitas Mahakarya Asia. <br>\r\nPada kesempaton kali ini, kak Ferro akan sharing dari sudut pandang corporate and academical studies. \r\n</p>', '2020-10-23 18:34:25', 0, '/img/news/AutoLearn1 Spesial Kolaborasi.png'),
(13, 'Teknologi Otomatisasi, Untuk \r\nApa?', '<h2>Inilah beberapa manfaat dari teknologi otomatisasi</h2>\r\n  <ol>\r\n    <li>Meningkatkan Produktivitas</li>\r\n    <p>Kemampuannya dalam mengurangi waktu untuk menyelesaikan task dalam tiap workflow dan business process tentu akan meningkatkan jumlah output dari proses tersebut.</p>\r\n    <li>Mengurangi \r\nBeban Waktu dan Biaya</li>\r\n    <p>Dengan peningkatan produktivitas perusahaan, terjadi penurunan beban waktu dan biaya.</p>\r\n    <li>Meningkatkan \r\nKepuasan Pelanggan</li>\r\n    <p>Apakah kamu tahu bahwa 70–80% pendapatan perusahaan itu datang dari konsumen yang pernah memakai layanan tersebut? Yap, dengan teknologi otomatisasi, kepuasan pelanggan dapat ditingkatkan. Artinya, optimasi pendapatan dari peningkatan angka konsumen yang melakukan repurchase terhadap produk perusahaan.</p>\r\n  </ol>', '2020-10-25 01:01:36', 0, '/img/news/Teknologi Automasi, Untuk Apa.png'),
(14, 'Peran Kecerdasan Buatan Lawan Covid-19', '<p>Artificial Intelligent (AI) menjadi senjata baru dalam memerangi Covid-19. Perusahaan TMiRob Asal Tiongkok membuat mesin berbasis AI yang bisa mensterilisasi rumah sakit. Sedangkan Alibaba menciptakan AI yang bisa mendiagnosa Covid-19 secara akurat dan cepat.</p>\r\n<p>Namun apakah teknologi yang sama bisa diimplementasikan di Indonesia? Menurut Malina Platon, Direktur UI Path, “Ai dan RPA juga bisa membantu indonesia mengidentifikasi petugas kesehatan memerangi Covid dengan cara merawat pasien dari hasil X-Ray yang kami sedang eksplorasi di AS. dan jika ini terbukti bisa menjadi solusi yang tepat, kita bisa implementasikan ke negara-negara lain. Seperti indonesia yang saat ini menghadapi masalah yang sama.”</p>\r\n<p>Saat ini Badan Pengkajian dan Penerapan Teknologi (BPPT) tengah mengembangkan produk-produk berbasis AI buatan dalam negeri untuk menangani Covid-19. Rencananya produk-produk berbasis AI bisa melacak keberadaa ODP, mempercepat PCR testing, serta mendeteksi dini Covid-19 pada pasien. Namun sampai saat ini belum diketahui kapan teknologi BPPT tersebut bisa digunakan oleh sektor kesehatan</p>\r\n<p>Hmm, kira-kira kapan ya teknologinya selesai? Semoga saja bisa secepatnya ya sob!</p>', '2020-10-27 23:32:05', 0, '/img/news/Peran Kecerdasan Buatan Lawan Covid-19.png'),
(15, 'Teknologi Otomatisasi, Sebagai Ancaman?', '<p>\r\n    Dengan keajaiban era digital, sepertinya kita sedang menuju utopia sci-fi dalam film di mana robot dapat melakukan segalanya.\r\n    <br><br>Jadi, apa yang akan dilakukan manusia jika pekerjaannya bisa digantikan oleh robot? Menurut penelitian oleh McKinsey, 49% pekerjaan di luar sana dapat diotomatiskan. Ini akan mempengaruhi kehidupan 1,1 miliar orang diseluruh dunia.\r\n</p>\r\n<p>\r\n    Tapi \"bisa otomatis\", sebenarnya masih merupakan istilah yang sangat luas. Sebagian besar pekerjaan dapat dibantu dengan otomatisasi, meskipun sebagian kecil lainnya dapat digantikan total. Contohnya pada masalah administrasi tanpa pengambilan keputusan atau pertimbangan manusiawi, seperti input data manual. Sedangkan pekerjaan yang membutuhkan kreativitas, pengambilan keputusan, dan pertimbangan manusiawi lainnya sulit untuk diotomatiskan. Oleh karena itu, Algoritma pada Robotic Process Automation (RPA) dapat membantu : \r\n</p>\r\n<p>\r\n • Melakukan pekerjaan berulang lebih cepat dan akurat\r\n<br> • karyawan dapat melakukan pekerjaan dibidang kreatif lainnya\r\n<br> • Menghemat waktu dan biaya\r\n<br> • Bekerja secara terus menerus 24/7\r\n<br> • Memproses data dalam format terstruktur\r\n</p>\r\n<p>RPA sebenarnya bisa menjadi batu loncatan agar lebih banyak karyawan yang bisa mempersiapkan diri untuk posisi yang lebih tinggi, seperti di jajaran manajemen. Jadi ini tuh bukan ancaman sob, tapi kesempatan!</p>', '2020-11-02 02:07:19', 0, '/img/news/Teknologi Otomatisasi, Sebagai Ancaman.png'),
(16, '5 Rekomendasi Film Sci-Fi tentang Teknologi Masa Depan', '<p>Menonton film menjadi salah satu hal yang paling digandrungi di tengah pandemi COVID-19 saat ini. Dari sekian banyak genre film, salah satu yang paling digemari adalah film bergenre Sci-Fi (Science Fiction). Nah bagi sobat pecinta film bergenre ini, berikut 5 rekomendasi film tentang teknologi masa depan yang wajib kamu tonton!</p>\r\n<br>\r\n<h4>Blade Runner 2049</h4>\r\n<p>\r\n  Film ini merupakan sekuel dari Blade Runner (1982). Disutradarai oleh Denis Villeneuve, film ini berlatar di tahun 2049. Film ini mengisahkan tentang seorang polisi LAPD bernama K yang menyelidiki sebuah rahasia yang dapat menimbulkan kekacauan besar. Pengungkapan rahasia ini membawa K ke sebuah perjalanan untuk mencari Rick Deckard, seorang mantan anggota \"Blade Runner\" LAPD yang menghilang 30 puluh tahun lalu.\r\n</p>\r\n<br>\r\n<h4>I, Robot</h4>\r\n<p>\r\n  Film yang dirilis di tahun 2004  ini disutradarai oleh Alex Proyas. Dibintangi oleh Will Smith, I, Robot diangkat dari buku yang berjudul sama yang ditulis oleh penulis asal Rusia, Isaac Asimov. I, Robot bercerita tentang dunia di mana manusia dan robot saling berinteraksi dan hidup berdampingan. Di tahun 2035, robot dapat melakukan pekerjaan seperti manusia bahkan pekerjaan yang tidak bisa dilakukan oleh manusia pada umumnya. Nantinya, robot-robotlah yang menggantikan seluruh pekerjaan manusia.\r\n</p>\r\n<br>\r\n<h4>Her</h4>\r\n<p>\r\n  Joaquin Phoenix dan Scarlett Johansson membintangi film yang disutradarai dan ditulis oleh Spike Jonze. Film yang dirlis di tahun 2013 ini bercerita tentang Theodore (joaquin Phoenix), seorang yang pemalu dan tertutup. Suatu hari, ia membeli perangkat OS yang ia lihat di iklan. Di dalam perangkat OS tersebut ada suara dari Artificial Intelligence atau AI yang bernama Samantha. Dari situlah, Theodore menemukan kecocokan dan menghabiskan waktunya dengan Samantha. \r\n</p>\r\n<br>\r\n<h4>Ex Machina</h4>\r\n<p>\r\n  Ex Machina menceritakan tentang seorang programer muda, Caleb Smith, yang mendapat kesempatan diundang oleh CEO perusahaannya untuk menguji dan menganalisa robot yang wujudnya mirip sekali dengan manusia dan memiliki kecerdasan buatan. Film yang dirilis di tahun 2015 ini disutradarai serta ditulis oleh Alex Garland, dan dibintangi oleh Domhnall Gleeson, Oscar Isaac, dan Alicia Vikander.\r\n</p>\r\n<br>\r\n<h4>Elysium</h4>\r\n<p>\r\n  Elyium disutradarai oleh Neill Blomkamp dan dirilis pada tahun 2013. Film ini dibintangi oleh Jodie Foster, Matt Damon, dan Sharlto Copley. Berlatar di tahun 2154, keadaan Bumi banyak berubah karena populasi dan polusi yang sangat tinggi. Selain itu, terjadinya perang, mewabahnya penyakit juga kemiskinan ikut mengancam Bumi. Orang-orang yang memiliki banyak harta segera pindah dari Bumi menuju Elysium yang terdapat di luar angkasa, sedangkan orang-orang yang tidak mampu hanya bisa bertahan di Bumi yang sudah rusak.\r\n</p>', '2020-11-05 10:23:46', 0, '/img/news/5 Rekomendasi Film Sci-Fi tentang Teknologi Masa Depan.png'),
(17, 'Tips Agar Tidak Menjadi Korban Peretasan', '<p>Akun layanan merupakan salah satu ancaman di ranah internet. Hal ini sering terjadi, bahkan terkadang peretas mengancam akan menyebarkan data-data penting dari akun yang diretas tersebut. Perusahaan keamanan siber (Kaspersky), membagikan tips untuk terhindar dari peretasan.</p>\r\n<br>\r\n<h4>1. Perhatian kata sandi</h4>\r\n<p>\r\n  Anda harus menggunakan kata sandi yang kuat dan unik. Untuk memperkuat kata sandi bisa menambahkan angka, mencampurkan huruf besar dan kecil dan karakter spesial (!, @, #, dll), dengan menambahkan 3 hal ini akan membuat kata sandi sulit ditebak. \"in!P4ssw0rd\" akan lebih sulit ditebak dari pada \"inipassword\". Hal ini dilakukan untuk memastikan akun Anda terlindungi dengan lebih aman.\r\n</p>\r\n<br>\r\n<h4>2. Otentikasi dua faktor</h4>\r\n<p>\r\n  Selain kata sandi Otentikasi dua faktor akan melindungi akun anda, fitur ini sudah diterapkan di beberapa akun seperti Facebook, Google, dan lainya. Jika ada perangkat yang tidak dikenal yang mencoba masuk ke akun anda, maka anda akan diminta memasukan kode login khusus yang bisa didapatkan dari akun lainya. Penggunaan fitur keamanan ini akan semakin memperkuat keamanan akun, dan bisa mencegah peretasan.\r\n</p>\r\n<br>\r\n<h4>3. Solusi perlindungan</h4>\r\n<p>\r\n  Perusahaan keamananan siber Kaspersky menganjurkan pengguna untuk memasang solusi perlindungan yang andal di seluruh perangkat yang terhubung ke akun.\r\n</p>', '2020-11-06 22:37:41', 0, '/img/news/Tips Agar Tidak Menjadi Korban Peretasan.png'),
(18, 'Aplikasi Gratis Remote Dekstop Terbaik', '<p>Aplikasi remote desktop atau lebih tepatnya disebut remote access software atau remote control software merupakan aplikasi yang memungkinkan sobat untuk mengontrol komputer lain dari jarak jauh. Dengan remote control sobat dapat mengambil alih mouse dan keyboard dan menggunakan komputer lain yang terhubung seperti sedang menggunakan komputer di hadapan kamu. Berikut beberapa rekomendasi aplikasi gratis terbaik remote control yang bisa sobat coba nih.</p>\r\n<br>\r\n<h4>1. Team Viewer</h4>\r\n<p>\r\n  Team Viewer adalag aplikasi remote dekstop yang paling mudah digunakan. Tidak sulit untuk menginstal karena tidak memerlukan perubahan pada konfigurasi router atau firewall.\r\n</p>\r\n<br>\r\n<h4>2. Remote Utilities</h4>\r\n<p>\r\n  Remote Utilities adalah remote dekstop dengan beberapa fitur yang sangat baik. Remote Utilities bekerja dengan menghubungkan dua komputer dengan apa yang mereka sebut “Internet ID“.\r\n</p>\r\n<br>\r\n<h4>3. Ammy Admin</h4>\r\n<p>\r\n  Ammy Admin adalah remote desktop yang benar-benar portabel dan sangat sederhana dalam setupnya. Ammyy Admin bekerja dengan menghubungkan satu komputer ke komputer lain melalui ID yang disediakan oleh aplikasi.\r\n</p>\r\n<br>\r\n<h4>3. UltraVNC</h4>\r\n<p>\r\n  UltraVNC hampir sama dengan Remote Utilities di mana server dan viewer diinstal pada kedua PC, dan viewer sendiri digunakan untuk mengontrol server.\r\n</p>\r\n<h4>3. AeroAdmin</h4>\r\n<p>\r\n  AeroAdmin adalah aplikasi remote desktop termudah saat ini. hampir ada tidak pengaturan, dan semuanya cepat dan langsung ke tujuan untuk digunakan sebagai support dadakan.\r\n</p>', '2020-11-09 22:48:07', 0, '/img/news/Aplikasi Gratis Remote Dekstop Terbaik.png'),
(19, 'Dibalik teknologi yang dipakai Google', '<p>Berikut adalah teknologi yang Google gunakan:</p>\r\n<ul>\r\n   <li>Application</li>\r\n   <p>Java, Dart, Android SDK</p>\r\n   <li>Database</li>\r\n   <p>Java, Dart, Android SDK</p>\r\n   <li>Frontend</li>\r\n   <p>Angular, Material Design</p>\r\n   <li>Backend</li>\r\n   <p>Python, java, Go, C++</p>\r\n   <li>Big Data</li>\r\n   <p>G Suite, Kubernetes</p>\r\n</ul>', '2020-11-10 06:06:12', 0, '/img/news/Teknologi nya Google.png'),
(22, 'Kupas Tuntas Robotic Process Automation (RPA)', '<p>Kali ini kita mau bahas seputar teknologi canggih masa kini yang lagi booming banget, yaitu RPA atau Robotic Process Automation. Kalian pasti tahu nih, di masa sekarang ini semua orang tentu ingin melakukan pekerjaannya dengan cepat dan juga tepat. Tapi kebanyakan dari mereka berpikir bahwa melakukan pekerjaan rutin tersebut merupakan hal yang tidak mudah dan juga membosankan. Tapi, kalian nggak perlu khawatir, karena sudah ada teknologi canggih yang bisa mengautomasi pekerjaan kalian!</p>\r\n<br>\r\n<p>Dengan menggunakan RPA dapat membantu meningkatkan kualitas proses, kecepatan, dan produktivitas serta mengintegrasikan sistem lama yang merupakan sesuatu yang semakin penting dalam iklim saat ini seiring dengan upaya organisasi untuk mempercepat proyek transformasi digital. Peluang bisnis yang besar untuk mengotomatiskan proses manual, memakan waktu, berulang, dan transaksional.</p>\r\n<br>\r\n<p>Beberapa orang berpendapat bahwa melakukan pekerjaan rutin sangat membosankan dan memakan waktu. Namun faktanya pekerjaan rutin bisa di Automasi agar lebih efektif dan efisien dalam melakukan proses bisnis.</p>\r\n<p>Lalu bagaimana RPA (Robotic Process Automation) dapat mengotomatiskan pekerjaan rutin agar lebih efektif? Cari tahu lebih banyak pada Online Workshop Part 1 yang dapat diikuti melalui <a href=\"/academy/detail?id=1\">link ini</a> </p>', '2020-11-12 00:23:40', 0, '/img/news/Kupas Tuntas Robotic Process Automation (RPA).png'),
(23, 'Tips Konversi Dokumen Tanpa Harus Ribet', '<p>Bayangkan deh, jika kita memiliki dokumen kertas  seperti artikel majalah, brosur, atau kontrak PDF yang dikirimkan oleh mitra kita melalui email. Jelas, pemindai tidak cukup untuk membuat informasi ini tersedia untuk diedit. </p>\r\n<p>Jika hal ini terjadi teman-teman memerlukan teknologi OCR (Optical Character Recognition) yang akan membantu kita untuk mengkonversi berbagai jenis dokumen dalam waktu yang singkat.</p>\r\n<br>\r\n<p>OCR merupakan sebuah teknologi yang dapat mengenali tulisan dalam sebuah gambar menjadi data teks yang dapat dibaca dalam sebuah komputer. Baik itu tulisan tangan ataupun tulisan digital.</p>\r\n<p>Tapi bagaimana kalau kita membuat bot sendiri yang bisa melakukan proses automasi dokumen menggunakan teknologi OCR? Kira-kira susah nggak ya?  Tidak ada kata susah jika mau belajar. Yuk kita belajar bersama di Online Workshop Part 2 yang dapat diakses melalui <a href=\"/academy/detail?id=2\">Link Ini</a></p>\r\n', '2020-11-13 00:23:23', 0, '/img/news/Tips Konversi Dokumen Tanpa Harus Ribet.png'),
(24, 'Tips Membangun Startup Teknologi yang Sempurna', '<p> Kali ini kita mau membahas mengenai hal-hal yang perlu diperhatikan saat membangun sebuah startup teknologi! Siapa tahu sobat automate all ada yang tertarik nih untuk bikin startup. </p>\r\n<br>\r\n<p>1.	Bentuklah Tim yang Seimbang </p>\r\n<p>Setiap startup, harus memiliki pendiri dan tim dengan keahlian yang saling melengkapi seperti keahlian di bidang desain dan penciptaan produk, ahli di bidang teknologi, serta ahli dalam pemasaran maupun partnership, karena sangat penting untuk meningkatkan kemungkinan keberhasilan mereka. </p>\r\n<br>\r\n<p>2.	Bangun produk dengan melakukan strategi \'build-test-scale\'</p>\r\n<p>Membangun produk teknologi melibatkan beberapa iterasi dan dengan strategi \'build-test-scale\', dimana sebuah startup dapat mengembangkan loop mekanisme umpan balik yang kuat, dan yang terpenting untuk mengoreksi produk sampai mencapai kesesuaian produk-pasar.</p>\r\n<br>\r\n<p>3.	Memahami perkembangan teknologi  & cara mengoptimalkannya</p>\r\n<p>Startup teknologi perlu memiliki tim engineering yang sangat produktif yang dapat memahami perkembangan teknologi terkini baik dalam teknologi backend maupun front-end. Tim teknisi bertugas mengoptimalkan produk untuk pengalaman pengguna terbaik dan akhirnya mengirimkan produk secepat mungkin agar menjadi yang terdepan dalam persaingan.</p>\r\n<br>\r\n<p>4.	Bangun budaya kerja yang baik </p>\r\n<p>Sebuah startup sangat penting untuk membangun budaya yang mendorong kepositifan, kinerja, rasa hormat, dan akuntabilitas yang jelas sejak awal dalam perjalanan sebuah perusahaan rintisan.</p>\r\n<br>\r\n<p>5.	Lakukan pendekatan yang berpusat pada pelanggan</p>\r\n<p>Sebuah startup sangat penting untuk memiliki pendekatan yang berpusat pada pelanggan sejak awal, dimana perusahaan harus mendengarkan kebutuhan pelanggan, hal itu akan menjadikan startup berada pada posisi yang baik karena melibatkan pelanggan tetap sebagai parameter untuk meraih kesuksesan.</p>', '2020-11-18 03:03:39', 0, '/img/news/Tips Membangun Startup Teknologi yang Sempurna!.png'),
(25, 'Teknologi yang dibutuhkan seorang Entrepreneurs di Era Digital', '<p>Membangun sebuah bisnis di tengah pandemi memang merupakan hal yang cukup berat sih, tapi kalian nggak perlu khawatir, karena kuncinya adalah kalian harus fokus terutama untuk memperhatikan alat teknologi yang digunakan guna mendapatkan hasil yang tepat. Dengan perangkat lunak yang memungkinkan kolaborasi, membantu kita mendapatkan wawasan yang lebih baik mengenai status bisnis atau hanya mengotomatiskan tugas-tugas dasar, serta kita akan memiliki sumber daya yang diperlukan untuk pertumbuhan bisnis yang berarti.</p>\r\n<p>Berikut adalah Teknologi yang dapat dipakai untuk membantu entrepreneurs</p>\r\n<br>\r\n<p>1. Cloud Native Technology</p>\r\n<p>Cloud Native Technology menawarkan kecepatan, skalabilitas, dan elastisitas yang dapat dimanfaatkan oleh semua ukuran bisnis untuk keuntungan mereka. Bisnis perusahaan maupun pengusaha memiliki fokus yang sama yakni transformasi bisnis dan teknologi memungkinkan untuk melaukan transformasi ini sementara layanan cloud native platform dapat mempercepatnya.</p>\r\n<br>\r\n<p>2. Marketing Tools</p>\r\n<p>Era digital telah memperkenalkan sejumlah teknik pemasaran baru, dan wirausahawan dapat menggunakan masing-masing alat ini jika mereka ingin menjangkau pelanggan mereka. Alat pemasaran modern mengambil pendekatan gambaran besar, menawarkan analisis kampanye dan integrasi dengan platform cloud lainnya.</p>\r\n<br>\r\n<p>3. Machine-powered data monitoring</p>\r\n<p>Salah satu keuntungan terbesar alat teknologi modern adalah kemampuannya untuk mengumpulkan data. Dengan mempelajari lebih lanjut tentang pelanggan atau efisiensi proses pada bisnis, dapat membuat perubahan penting pada bisnis untuk meningkatkan profitabilitas.</p>\r\n<br>\r\n<p>4. CRM (Customer Relationship Management) Software</p>\r\n<p>Software manajemen hubungan pelanggan (CRM) memberi perusahaan kekuatan lebih besar dalam cara mereka menangani hubungan penting ini. CRM mengumpulkan berbagai informasi yang dapat membantu tim penjualan dan mengubah prospek menjadi penjualan atau meningkatkan metrik retensi pelanggan.</p>\r\n<br>\r\n<p>5. Basic Automation</p>\r\n<p>Alat otomasi atau penggunaan asisten virtual menjadi penting bagi wirausahawan yang bekerja terlalu keras. Dengan otomatisasi strategis, dapat membuka banyak waktu untuk tugas-tugas yang memiliki kontribusi lebih besar pada keuntungan Anda.</p>', '2020-11-19 01:23:22', 0, '/img/news/Teknologi yang dibutuhkan seorang Entrepreneurs di Era Digital.png'),
(26, 'Aplikasi Manajemen Proyek Yang Wajib Dimiliki Saat WFH', '<p>Dimasa pandemi tentu semuanya diusahakan untuk bekerja dari rumah atau bisa dibilang kerja remote. Awalnya tentu kita butuh penyesuaian, tapi sekarang udah ada platform yang bisamendukung kita untuk melakukan pekerjaan dari rumah. Dijamin deh pekerjaan kalian akan ter-manage dengan baik.</p>\r\n<p>Nah buat pejuang WFH, Aplikasi ini cocok banget buat kalian!</p>\r\n<br>\r\n<p>1. Trello</p>\r\n<p>Aplikasi ini berguna untuk memungkinkan karyawan memvisualisasikan tugas di papan digital, kartu, dan kolom yang terlihat sangat familiar. Kartu dapat dimuat dengan informasi (termasuk grafik dan hyperlink) dan ditugaskan ke anggota tim WFH dengan tanggal jatuh tempo yang sduah terlampir.</p>\r\n<br>\r\n<p>2. Asana</p>\r\n<p>Aplikasi untuk sebuah tim dan individual, serta merupakan aplikasi alternatif yang sederhana dan intuitif untuk manajemen kerja. Asana menyediakan berbagai fitur yang dapat memudahkankan seorang leader untuk membagi tugas kepada tim dan mengatur jadwal pengerjaan project tersebut.</p>\r\n<br>\r\n<p>3. Clicup</p>\r\n<p>Aplikasi untuk sebuah tim dan individual, serta merupakan aplikasi alternatif yang sederhana dan intuitif untuk manajemen kerja. Asana menyediakan berbagai fitur yang dapat memudahkankan seorang leader untuk membagi tugas kepada tim dan mengatur jadwal pengerjaan project tersebut.</p>', '2020-11-23 01:26:23', 0, '/img/news/Aplikasi Manajemen Proyek Yang Wajib Dimiliki Saat WFH.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL DEFAULT 'judul kosong',
  `isi` longtext NOT NULL DEFAULT '\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\'',
  `client` text NOT NULL DEFAULT 'Lorem ipsum',
  `service` text NOT NULL DEFAULT 'Lorem ipsum dolor sit amet',
  `tglBerlangganan` timestamp NULL DEFAULT NULL,
  `tanggalUpload` timestamp NOT NULL DEFAULT current_timestamp(),
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `img` text NOT NULL,
  `video` text NOT NULL,
  `fileLocation` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `judul`, `isi`, `client`, `service`, `tglBerlangganan`, `tanggalUpload`, `isDeleted`, `img`, `video`, `fileLocation`) VALUES
(2, 'AutoScrap', 'AutoScrap merupakan sebuah aplikasi yang bisa melakukan ekstraksi data dari suatu website. Salah satu contohnya adalah mengambil daftar harga dari sebuah direktori website marketplace. Hal ini bisa saja dilakukan secara manual dengan meng-copy paste data ke excel. Tetapi bagaimana jika datanya banyak? tentu anda membutuhkan automation yang bisa membantu melakukan proses web scraping lebih cepat dan mudah.\r\n\r\nProses yang dilakukan oleh aplikasi AutoScrap adalah program masuk ke halaman website, download konten, mengekstrak data dari konten, menyimpan data dan menampilkan data ke dalam format CSV atau spreadsheet excel.', '-', 'Scraping', '2020-11-11 09:40:45', '2020-11-11 09:41:59', 0, '/img/pictures/laptop.png', '', '/RPA/Ebay.zip');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `uniqueCode` varchar(255) DEFAULT NULL,
  `nama` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pass` tinytext NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT 0,
  `isVerifikasi` datetime(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academy`
--
ALTER TABLE `academy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idGratisKarena` (`idAcademy`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCoupon` (`idCoupon`),
  ADD KEY `idDaftar` (`idDaftar`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursedaftar`
--
ALTER TABLE `coursedaftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCourse` (`idCourse`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `courseepisode`
--
ALTER TABLE `courseepisode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSection` (`idSection`);

--
-- Indexes for table `courseinstructur`
--
ALTER TABLE `courseinstructur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseonline`
--
ALTER TABLE `courseonline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idStruktur` (`idStruktur`);

--
-- Indexes for table `courseprogress`
--
ALTER TABLE `courseprogress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDaftar` (`idDaftar`),
  ADD KEY `idEpisode` (`idEpisode`);

--
-- Indexes for table `coursesection`
--
ALTER TABLE `coursesection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCourse` (`idCourse`);

--
-- Indexes for table `coursesertifikat`
--
ALTER TABLE `coursesertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD KEY `idPendaftar` (`idPendaftar`),
  ADD KEY `idPengajak` (`idPengajak`),
  ADD KEY `idAcademy` (`idAcademy`);

--
-- Indexes for table `linkConfirm`
--
ALTER TABLE `linkConfirm`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueCode` (`uniqueCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
