-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 05:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `fp`) VALUES
(1, 'admin', 'admin', '12', '666239058e4e3.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kk`
--

CREATE TABLE `detail_kk` (
  `id_detail_kk` int(12) NOT NULL,
  `id_kk` int(12) NOT NULL,
  `id_penduduk` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_kk`
--

INSERT INTO `detail_kk` (`id_detail_kk`, `id_kk`, `id_penduduk`) VALUES
(3, 2, 2),
(6, 4, 5),
(7, 2, 3),
(9, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `galery`
--

CREATE TABLE `galery` (
  `id_galery` int(12) NOT NULL,
  `nama` text NOT NULL,
  `foto` text NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galery`
--

INSERT INTO `galery` (`id_galery`, `nama`, `foto`, `tanggal`, `deskripsi`) VALUES
(4, 'data 2', '../../../images/galery/IMG-20240605-WA0019.jpg', '19-Jun-2024 23:15', 'data 2'),
(5, 'data 1', '../../../images/galery/IMG-20240605-WA0019.jpg', '12-Jun-2024 23:17', 'data 1');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id_home` int(12) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `gambar_struktur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id_home`, `visi`, `misi`, `gambar_struktur`) VALUES
(1, 'TEWUJUD KOTA KUPANG YANG LAYAK HUNI, CERDAS, MANDIRI DAN\nSEJAHTERA DENGAN TATAKELOLA BEBAS KKN ', '•	Mengembangkan sumber daya manusia (SDM) yang sehat, cerdas, berakhlak,professional dan berdaya saing (KUPANG SEHAT-CERDAS)\n•	Mengembangkan perekonomian kota kupang yang berdaya saing dengan meningkatkan peran swasta (KUPANG MAKMUR)\n•	Meningkatkan kesejahteraan sosial dan mengembangkan budaya kota yang tertib,aman,kreatif dan berprestasi dalam menunjang kota jasa (KUPANG BAGAYA-BERPRESTASI)\n•	Mempersiapkan kota kupang menuju metropolitan yang berwawasan lingkungan (KUPANG HIJAU)\n•	Meningkatkan tatakelola pemerintahan yang bebas KKN dan transparasi pengelola keuangan (KUPANG JUJUR)\n•	Membangun kota kupang sebagai rumah besar persaudaraan dan kerukunan lintas SARA (KUPANG RUKUN DAN AMAN) \n', '../../../assets/img/profile/struktur.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kelahiran`
--

CREATE TABLE `kelahiran` (
  `id_kelahiran` int(12) NOT NULL,
  `anak_id_penduduk` int(12) NOT NULL,
  `ibu_id_penduduk` int(12) NOT NULL,
  `bapa_id_penduduk` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelahiran`
--

INSERT INTO `kelahiran` (`id_kelahiran`, `anak_id_penduduk`, `ibu_id_penduduk`, `bapa_id_penduduk`) VALUES
(18, 3, 1, 2),
(19, 7, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kematian`
--

CREATE TABLE `kematian` (
  `id_kematian` int(12) NOT NULL,
  `id_penduduk` int(12) NOT NULL,
  `tgl_kematian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kematian`
--

INSERT INTO `kematian` (`id_kematian`, `id_penduduk`, `tgl_kematian`) VALUES
(5, 3, '06-Jun-2024');

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id_kk` int(12) NOT NULL,
  `nikk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id_kk`, `nikk`) VALUES
(2, 2147483647),
(4, 22);

-- --------------------------------------------------------

--
-- Table structure for table `lurah`
--

CREATE TABLE `lurah` (
  `id_lurah` int(12) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lurah`
--

INSERT INTO `lurah` (`id_lurah`, `nip`, `nama`, `username`, `password`, `fp`) VALUES
(4, '196602141989031010', 'WELLEM BENTURA, SH ', 'wallem', '123', '66624b709d309.png');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(12) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(150) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama`, `jk`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nik`) VALUES
(1, 'Sintia', 'Wanita', 'Islam', 'Medan', '11-Apr-2007', 'medan', '120343202324'),
(2, 'JOVANDRY MORCHAN MERE GUJU', 'Pria', 'Katolik', 'Naikoten ', '12-Jun-2002', 'NTT', '12060212424435'),
(3, 'nanda', 'Wanita', 'Kristen', 'Naikoten ', '12-Dec-2006', 'naikoten', '23532524342323'),
(5, 'cici', 'Wanita', 'Hindu', 'penfui', '04-Mar-2004', 'penfui', '12312245235'),
(7, 'JOSUA MALI LEGI', 'Pria', 'Kristen', 'KUPANG', '12-Mar-2002', 'LABAT', '12413432452532235');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(12) NOT NULL,
  `nama` varchar(120) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nama`, `username`, `password`, `fp`) VALUES
(1, 'pengunjung', 'pengunjung', '1', '666242727ac62.png');

-- --------------------------------------------------------

--
-- Table structure for table `sejara`
--

CREATE TABLE `sejara` (
  `id_sejara` int(12) NOT NULL,
  `deskripsi_sejara` text NOT NULL,
  `gambar_sejara` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sejara`
--

INSERT INTO `sejara` (`id_sejara`, `deskripsi_sejara`, `gambar_sejara`) VALUES
(1, 'Sejarah pada prinsipnya sangat penting sebab manusia dilahirkan sampai dengan meninggal dunia pasti selalu beraktifitas dalam mempertahankan hidupnya. Manusia sebagai makhluk sejarah yang dapat berkarya, dan karya tersebut dapat di rekam oleh ruang waktu. Oleh karena itu, sejarah merupakan jalan untuk suatu tujuan, sehingga dengan adanya sejarah maka manusia semakin mengenal dan mengenang.\nBerdasarkan hasil wawancara yang kami lakukan maka diperoleh data bahwa kata lasiana yang berasal dari bahasa rote yang terdiri dari dua suku kata yang mempunyai arti berbeda-beda yaitu “lasi” dan “ana” yang mana lasi berarti hutan dan ana berarti kecil jika kata itu digabungkan akan menjadi lasiana yang berarti “hutan kecil”, karena sejak dahulu lasiana hanya terdiri dari hutan yang kecil. Oleh karena itu lasiana sebagai nama tempat yang sudah lama ada, sehingga kini sebagai wilayah kelurahan. Kelurahan lasiana sendiri berdiri pada tahun 1967, yang terbentuk suatu pemerintahan dengan nama desa gaya baru dengan kepala desa pertama bapak C.C Tjandring (1967-1971) dan didalam desa gaya baru terbentuk tiga (tiga) temukun,yakni:\n	a. Temukun Tuak Sabu\n	b. Temukun Lasiana\n	c. Temukun Tuak Lobang \npada masa itu desa gaya baru terjadi peralihan dari wilayah atministratif kabupaten kupang kepemerintahan kota madya daerah tingkat II kupang. Dan diikuti pengalihan status dari desa ke  kelurahan. Lurah pertama yang memimpin ada kelurahan lasiana bapak K.J. Mooy (1996-1997). Lurah kedua dipimpin oleh bapak I. Nuban (1997-2005), lurah ketiga dipimpin oleh bapak Yesriel O. Henuk, SH (2005-2007). Lurah keempat dipimpin oleh bapak Laesa Latif,A.Md (2007-2009). Lurah kelima dipimpin oleh bapak Marthen Ludji,SH (2009-2011). Lurah keenam dipimpin oleh bapak Yefta M. Henuk,SH tahun (2011-2012). Lurah ketujuh dipimpin oleh bapakYesriel O. Henuk,SH (2012 sampai dengan tanggal 02 april 2018 Plt lurah di tunjukan oleh camat : Bapak Richard B. Penlaana, Sos, M.si (Sekretaris Kelapa Lima) tanggal 14 desember 2018 bapak wellem bentura, SH dilantik untuk menjadi Lurah Lasiana, pada tahun 1967 sampai dengan 1978, desa gaya baru di pimpin oleh kepala desa : Bapak Yeremias Amalo. Pada tahu 1978 sampai dengan 1996 desa gaya baru dipimpin kepala desa : Bapak K.J.Mooy\n', '../../../assets/img/profile/IMG-20240605-WA0019.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_kk`
--
ALTER TABLE `detail_kk`
  ADD PRIMARY KEY (`id_detail_kk`);

--
-- Indexes for table `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id_galery`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id_home`);

--
-- Indexes for table `kelahiran`
--
ALTER TABLE `kelahiran`
  ADD PRIMARY KEY (`id_kelahiran`);

--
-- Indexes for table `kematian`
--
ALTER TABLE `kematian`
  ADD PRIMARY KEY (`id_kematian`);

--
-- Indexes for table `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indexes for table `lurah`
--
ALTER TABLE `lurah`
  ADD PRIMARY KEY (`id_lurah`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `sejara`
--
ALTER TABLE `sejara`
  ADD PRIMARY KEY (`id_sejara`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_kk`
--
ALTER TABLE `detail_kk`
  MODIFY `id_detail_kk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `galery`
--
ALTER TABLE `galery`
  MODIFY `id_galery` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id_home` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelahiran`
--
ALTER TABLE `kelahiran`
  MODIFY `id_kelahiran` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kematian`
--
ALTER TABLE `kematian`
  MODIFY `id_kematian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kk`
--
ALTER TABLE `kk`
  MODIFY `id_kk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lurah`
--
ALTER TABLE `lurah`
  MODIFY `id_lurah` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sejara`
--
ALTER TABLE `sejara`
  MODIFY `id_sejara` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
