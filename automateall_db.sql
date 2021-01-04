-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 12:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automateall_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academy`
--

CREATE TABLE `academy` (
  `id` int(11) NOT NULL,
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
(1, 'Learn to Build Robots', 'FREE ONLINE WORKSHOP Part 1', 'Workshop kali ini kita akan belajar mengenai salah satu cara untuk membuat robot dalam bentuk program menggunakan sebuah platform, yang nantinya bisa mengautomasi pekerjaan rutin kamu, sehingga tidak perlu repot berulang kali untuk mengerjakannya. \r\n                <br>Kalian gak perlu khawatir, karena kita bisa membuat bot tanpa perlu skill coding atau memiliki background IT sebelumnya lho! Asik kan, jadi siapapun bisa banget untuk belajar dan membuatnya. Yang penting teman-teman memiliki kemauan untuk belajar.\r\n                <br><br>Menarik bukan? Yuk belajar  bersama Automate All, bareng Tentor Annas Wahyu (Chief Technology Automate All).', '/img/onlineCourse/Learn To Build Robot.jpg', '2020-11-13 06:30:00', '2020-11-13 09:00:00', 'FREE', NULL, 'https://part1.automateall.id', 0, 0, ''),
(2, 'Learn PDF Automation', 'ONLINE WORKSHOP Part 2', 'Kalian tahu nggak sih kalau dengan teknologi canggih pada RPA (Robotic Process Automation), kita bisa melakukan PDF Automation, yang dapat mengenali sebuah gambar menjadi data teks yang dapat dibaca oleh Komputer. Baik file pdf yang dapat diedit maupun yang tidak.\r\n<br><br>\r\nManfaatnya adalah dapat mempercepat & mempermudah pengumpulan data dari 1 atau lebih file pdf (terutama untuk file pdf yang tidak dapat diedit).\r\n<br>\r\nPenasaran bukan? Nah buat teman-teman yang ingin belajar dan mengetahui bagaimana proses PDF Automation bisa banget gabung di workshop ini.\r\n<br>\r\nTenang aja kalian akan didampingi oleh tentor yang ahli di bidangnya bersama Dicky Prasetiyo (Chief Science Automate All).\r\n<br><br>\r\nJangan khawatir guys, workshop ini terbuka untuk umum ya! Hanya dengan investasi 99rb atau gratis* kamu sudah bisa mengautomasi pekerjaan dokumen kamu loh. Jadi kamu punya banyak waktu untuk bersantai sambil menunggu bot mengerjakan pekerjaan kamu. \r\n<br><br>\r\nKamu ga paham coding/teknik? Tenang, materi ini mudah dipahami semua kalangan dan kita menyediakan grup konsultasi selamanya.', '/img/onlineCourse/Learn PDF Automation.png', '2020-11-14 06:30:00', '2020-11-14 08:30:00', '99000', 1, 'https://part2.automateall.id ', 0, 0, 'Free because other workshop part 1');

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` varchar(255) NOT NULL,
  `idDaftar` varchar(255) NOT NULL,
  `idCoupon` varchar(255) DEFAULT NULL,
  `metode` tinytext NOT NULL,
  `tglBayar` datetime NOT NULL DEFAULT current_timestamp(),
  `hargaAwal` mediumint(4) NOT NULL,
  `diskon` mediumint(4) NOT NULL DEFAULT 0,
  `total` mediumint(4) NOT NULL,
  `bukti` tinytext NOT NULL,
  `keterangan` tinytext NOT NULL DEFAULT 'belum upload'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id`, `idDaftar`, `idCoupon`, `metode`, `tglBayar`, `hargaAwal`, `diskon`, `total`, `bukti`, `keterangan`) VALUES
('BYRf721X', 'DAF', NULL, '', '2021-01-04 17:49:35', 99000, 0, 99000, '/user/uniquebangets/pesan/ghvbGv7Av9/32_5.png', 'pengecekan');

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
('CPN7bbG7', 'FREESTUF', 100, 'discount', '2020-12-24 23:58:52', '2020-11-13 12:00:00', '{\"idUser\":\"27434\",\"idAcademy\":\"1\"}', 1, 0),
('CPNF8316', 'FREESTUF', 100, 'discount', '2020-12-24 22:41:28', '2020-11-13 12:00:00', '{\"idUser\":\"27434\",\"idAcademy\":\"1\"}', 1, 0),
('CPNrN2Bo', 'IRFFREE10', 100, 'Invite10', '2021-01-04 15:18:28', '2020-11-14 12:00:00', '{\"idUser\":\"FFt17\",\"idAcademy\":\"2\"}', -16, 0),
('qwerty', 'FREENTRY', 100, 'discount', '2020-12-01 01:24:55', '2020-12-31 01:24:55', '{\"idUser\":\"FFt17\",\"idAcademy\":2}', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `id` varchar(255) NOT NULL,
  `nama` tinytext NOT NULL,
  `idPendaftar` varchar(255) CHARACTER SET latin1 NOT NULL,
  `idPengajak` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `idAcademy` int(10) NOT NULL,
  `namaPengajak` tinytext NOT NULL,
  `whatsapp` tinytext NOT NULL,
  `organisasi` tinytext NOT NULL,
  `jumlahBayar` mediumint(4) NOT NULL,
  `tglDaftar` datetime NOT NULL DEFAULT current_timestamp(),
  `maxTglBayar` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daftar`
--

INSERT INTO `daftar` (`id`, `nama`, `idPendaftar`, `idPengajak`, `idAcademy`, `namaPengajak`, `whatsapp`, `organisasi`, `jumlahBayar`, `tglDaftar`, `maxTglBayar`) VALUES
('DAF', 'ghvbGv7Av9', 'FFt17', NULL, 2, '', '082140310174', 'telkom', 99000, '2021-01-04 06:25:19', '2020-11-14 12:00:00'),
('DAF123', 'ghvbGv7Av9a', '101Gu', 'FFt17', 1, '', '082140310174', 'telkom', 99000, '2021-01-04 06:25:19', '2020-11-14 12:00:00'),
('DAF123aadsd', 'ghvbGv7Avasd9xas', '101Gu', 'FFt17', 1, '', '082140310174', 'telkom', 99000, '2021-01-04 06:25:19', '2020-11-14 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `linkconfirm`
--

CREATE TABLE `linkconfirm` (
  `token` varchar(255) NOT NULL,
  `tglTerbuat` datetime NOT NULL,
  `type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linkconfirm`
--

INSERT INTO `linkconfirm` (`token`, `tglTerbuat`, `type`) VALUES
('dGtuPTlNSzUwMXMxajMmZW1haWw9bG9sb0BnbWFpbC5jb20mZGF0ZT0yMDIxLTAxLTAyIDA1OjI0OjAz', '2021-01-02 05:24:03', 'verifyAccount'),
('dGtuPTYzR0tBazYzNTAmZW1haWw9aXJmYW5udWdyYWhhODQ0QGdtYWlsLmNvbSZkYXRlPTIwMjEtMDEtMDQgMDU6MTU6MTY=', '2021-01-04 05:15:16', ''),
('dGtuPUwyanRmVkQ3TXomZW1haWw9a29rb0BnbWFpbC5jb20mZGF0ZT0yMDIwLTEyLTAxIDE2OjQzOjI0', '2020-12-01 16:43:24', 'verifyAccount'),
('dGtuPWJySTNWMkRncjMmZW1haWw9aXJmYW5udWdyYWhhODQ0QGdtYWlsLmNvbSZkYXRlPTIwMjAtMTItMDEgMTY6NDI6MzE=', '2020-12-01 16:42:31', 'verifyAccount');

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
(24, 'Tips Membangun Startup Teknologi yang Sempurna', '<p> Kali ini kita mau membahas mengenai hal-hal yang perlu diperhatikan saat membangun sebuah startup teknologi! Siapa tahu sobat automate all ada yang tertarik nih untuk bikin startup. </p>\r\n<br>\r\n<p>1.	Bentuklah Tim yang Seimbang </p>\r\n<p>Setiap startup, harus memiliki pendiri dan tim dengan keahlian yang saling melengkapi seperti keahlian di bidang desain dan penciptaan produk, ahli di bidang teknologi, serta ahli dalam pemasaran maupun partnership, karena sangat penting untuk meningkatkan kemungkinan keberhasilan mereka. </p>\r\n<br>\r\n<p>2.	Bangun produk dengan melakukan strategi \'build-test-scale\'</p>\r\n<p>Membangun produk teknologi melibatkan beberapa iterasi dan dengan strategi \'build-test-scale\', dimana sebuah startup dapat mengembangkan loop mekanisme umpan balik yang kuat, dan yang terpenting untuk mengoreksi produk sampai mencapai kesesuaian produk-pasar.</p>\r\n<br>\r\n<p>3.	Memahami perkembangan teknologi  & cara mengoptimalkannya</p>\r\n<p>Startup teknologi perlu memiliki tim engineering yang sangat produktif yang dapat memahami perkembangan teknologi terkini baik dalam teknologi backend maupun front-end. Tim teknisi bertugas mengoptimalkan produk untuk pengalaman pengguna terbaik dan akhirnya mengirimkan produk secepat mungkin agar menjadi yang terdepan dalam persaingan.</p>\r\n<br>\r\n<p>4.	Bangun budaya kerja yang baik </p>\r\n<p>Sebuah startup sangat penting untuk membangun budaya yang mendorong kepositifan, kinerja, rasa hormat, dan akuntabilitas yang jelas sejak awal dalam perjalanan sebuah perusahaan rintisan.</p>\r\n<br>\r\n<p>5.	Lakukan pendekatan yang berpusat pada pelanggan</p>\r\n<p>Sebuah startup sangat penting untuk memiliki pendekatan yang berpusat pada pelanggan sejak awal, dimana perusahaan harus mendengarkan kebutuhan pelanggan, hal itu akan menjadikan startup berada pada posisi yang baik karena melibatkan pelanggan tetap sebagai parameter untuk meraih kesuksesan.</p>', '2020-11-19 03:03:39', 0, '/img/news/Tips Membangun Startup Teknologi yang Sempurna!.png'),
(25, 'Teknologi yang dibutuhkan seorang Entrepreneurs di Era Digital', '<p>Membangun sebuah bisnis di tengah pandemi memang merupakan hal yang cukup berat sih, tapi kalian nggak perlu khawatir, karena kuncinya adalah kalian harus fokus terutama untuk memperhatikan alat teknologi yang digunakan guna mendapatkan hasil yang tepat. Dengan perangkat lunak yang memungkinkan kolaborasi, membantu kita mendapatkan wawasan yang lebih baik mengenai status bisnis atau hanya mengotomatiskan tugas-tugas dasar, serta kita akan memiliki sumber daya yang diperlukan untuk pertumbuhan bisnis yang berarti.</p>\r\n<p>Berikut adalah Teknologi yang dapat dipakai untuk membantu entrepreneurs</p>\r\n<br>\r\n<p>1. Cloud Native Technology</p>\r\n<p>Cloud Native Technology menawarkan kecepatan, skalabilitas, dan elastisitas yang dapat dimanfaatkan oleh semua ukuran bisnis untuk keuntungan mereka. Bisnis perusahaan maupun pengusaha memiliki fokus yang sama yakni transformasi bisnis dan teknologi memungkinkan untuk melaukan transformasi ini sementara layanan cloud native platform dapat mempercepatnya.</p>\r\n<br>\r\n<p>2. Marketing Tools</p>\r\n<p>Era digital telah memperkenalkan sejumlah teknik pemasaran baru, dan wirausahawan dapat menggunakan masing-masing alat ini jika mereka ingin menjangkau pelanggan mereka. Alat pemasaran modern mengambil pendekatan gambaran besar, menawarkan analisis kampanye dan integrasi dengan platform cloud lainnya.</p>\r\n<br>\r\n<p>3. Machine-powered data monitoring</p>\r\n<p>Salah satu keuntungan terbesar alat teknologi modern adalah kemampuannya untuk mengumpulkan data. Dengan mempelajari lebih lanjut tentang pelanggan atau efisiensi proses pada bisnis, dapat membuat perubahan penting pada bisnis untuk meningkatkan profitabilitas.</p>\r\n<br>\r\n<p>4. CRM (Customer Relationship Management) Software</p>\r\n<p>Software manajemen hubungan pelanggan (CRM) memberi perusahaan kekuatan lebih besar dalam cara mereka menangani hubungan penting ini. CRM mengumpulkan berbagai informasi yang dapat membantu tim penjualan dan mengubah prospek menjadi penjualan atau meningkatkan metrik retensi pelanggan.</p>\r\n<br>\r\n<p>5. Basic Automation</p>\r\n<p>Alat otomasi atau penggunaan asisten virtual menjadi penting bagi wirausahawan yang bekerja terlalu keras. Dengan otomatisasi strategis, dapat membuka banyak waktu untuk tugas-tugas yang memiliki kontribusi lebih besar pada keuntungan Anda.</p>', '2020-11-24 01:23:22', 0, '/img/news/Teknologi yang dibutuhkan seorang Entrepreneurs di Era Digital.png'),
(26, 'Aplikasi Manajemen Proyek Yang Wajib Dimiliki Saat WFH', '<p>Dimasa pandemi tentu semuanya diusahakan untuk bekerja dari rumah atau bisa dibilang kerja remote. Awalnya tentu kita butuh penyesuaian, tapi sekarang udah ada platform yang bisamendukung kita untuk melakukan pekerjaan dari rumah. Dijamin deh pekerjaan kalian akan ter-manage dengan baik.</p>\r\n<p>Nah buat pejuang WFH, Aplikasi ini cocok banget buat kalian!</p>\r\n<br>\r\n<p>1. Trello</p>\r\n<p>Aplikasi ini berguna untuk memungkinkan karyawan memvisualisasikan tugas di papan digital, kartu, dan kolom yang terlihat sangat familiar. Kartu dapat dimuat dengan informasi (termasuk grafik dan hyperlink) dan ditugaskan ke anggota tim WFH dengan tanggal jatuh tempo yang sduah terlampir.</p>\r\n<br>\r\n<p>2. Asana</p>\r\n<p>Aplikasi untuk sebuah tim dan individual, serta merupakan aplikasi alternatif yang sederhana dan intuitif untuk manajemen kerja. Asana menyediakan berbagai fitur yang dapat memudahkankan seorang leader untuk membagi tugas kepada tim dan mengatur jadwal pengerjaan project tersebut.</p>\r\n<br>\r\n<p>3. Clicup</p>\r\n<p>Aplikasi untuk sebuah tim dan individual, serta merupakan aplikasi alternatif yang sederhana dan intuitif untuk manajemen kerja. Asana menyediakan berbagai fitur yang dapat memudahkankan seorang leader untuk membagi tugas kepada tim dan mengatur jadwal pengerjaan project tersebut.</p>', '2020-11-24 01:26:23', 0, '/img/news/Aplikasi Manajemen Proyek Yang Wajib Dimiliki Saat WFH.png');

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
  `uniqueCode` tinytext DEFAULT NULL,
  `nama` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `pass` tinytext NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT 0,
  `isVerifikasi` datetime(1) DEFAULT NULL,
  `folderCode` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uniqueCode`, `nama`, `email`, `pass`, `isDelete`, `isVerifikasi`, `folderCode`) VALUES
('101Gu', NULL, 'okok', 'lolo@gmail.com', 'koko123', 0, NULL, NULL),
('27434', NULL, 'koko', 'koko@gmail.com', 'koko123', 0, NULL, NULL),
('default', NULL, 'default', 'default@gmail.com', 'default', 0, NULL, NULL),
('FFt17', 'uniquebangets', 'Irfan Nugraha', 'irfannugraha844@gmail.com', 'irfan123', 0, NULL, NULL);

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
  ADD UNIQUE KEY `idDaftar_2` (`idDaftar`),
  ADD KEY `idCoupon` (`idCoupon`),
  ADD KEY `idDaftar` (`idDaftar`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPendaftar` (`idPendaftar`),
  ADD KEY `idPengajak` (`idPengajak`),
  ADD KEY `idAcademy` (`idAcademy`);

--
-- Indexes for table `linkconfirm`
--
ALTER TABLE `linkconfirm`
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
  ADD UNIQUE KEY `uniqueCode` (`uniqueCode`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academy`
--
ALTER TABLE `academy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academy`
--
ALTER TABLE `academy`
  ADD CONSTRAINT `academy_ibfk_1` FOREIGN KEY (`idAcademy`) REFERENCES `academy` (`id`);

--
-- Constraints for table `bayar`
--
ALTER TABLE `bayar`
  ADD CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`idCoupon`) REFERENCES `coupon` (`id`),
  ADD CONSTRAINT `bayar_ibfk_2` FOREIGN KEY (`idDaftar`) REFERENCES `daftar` (`id`);

--
-- Constraints for table `daftar`
--
ALTER TABLE `daftar`
  ADD CONSTRAINT `daftar_ibfk_1` FOREIGN KEY (`idPendaftar`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `daftar_ibfk_2` FOREIGN KEY (`idPengajak`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `daftar_ibfk_3` FOREIGN KEY (`idAcademy`) REFERENCES `academy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
