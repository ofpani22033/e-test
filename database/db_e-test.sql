-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2025 pada 07.17
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_e-test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama_user`, `username`, `password`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` varchar(20) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nama_guru`, `username`, `password`) VALUES
('3273050108800018', 'Aisyah Ainur, S.Pd.', 'aisyah', 'aisyah'),
('3273050910950016', 'Wisnu Taufiq, S.T.', 'wisnu', 'wisnu'),
('3273051010600014', 'Anik Pramesti, S.Pd.', 'anik', 'anik'),
('3273051011700015', 'Puji Astuti, S.Pd.', 'puji', 'puji'),
('3273051012650017', 'Dwi Astuti, S.S.', 'dwias', 'dwias'),
('3273051210800019', 'Ahmad Yogi Putra, S.T.', 'ahmadyo', 'ahmadyo'),
('3273051408630011', 'Suparno, S.Pd.', 'suparno', 'suparno'),
('3273052010700012', 'Siti Fatimah, S.T.', 'sitifa', 'sitifa'),
('3273056010700013', 'Sugiarto, S.T.', 'sugiarto', 'sugiarto'),
('3273056010900009', 'Elsa Ayu, S.Pd.', 'elsaayu', 'elsaayu'),
('3273056010900010', 'Heri Suprianto, S.T.', 'heri', 'heri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil_ujian`
--

CREATE TABLE `tb_hasil_ujian` (
  `id_peserta` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_jenis_ujian` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `tanggal_ujian` date DEFAULT NULL,
  `jam_ujian` time DEFAULT NULL,
  `durasi_ujian` int(11) NOT NULL,
  `timer_ujian` int(11) NOT NULL,
  `status_ujian` tinyint(1) NOT NULL,
  `benar` int(3) DEFAULT NULL,
  `salah` int(3) DEFAULT NULL,
  `nilai` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_hasil_ujian`
--

INSERT INTO `tb_hasil_ujian` (`id_peserta`, `id_siswa`, `id_jenis_ujian`, `id_matapelajaran`, `tanggal_ujian`, `jam_ujian`, `durasi_ujian`, `timer_ujian`, `status_ujian`, `benar`, `salah`, `nilai`) VALUES
(1, 1, 1, 1, '2025-11-23', '20:00:00', 30, 1800, 1, NULL, NULL, NULL),
(2, 2, 1, 1, '2025-11-23', '20:00:00', 30, 1800, 1, NULL, NULL, NULL),
(3, 3, 1, 1, '2025-11-23', '20:00:00', 30, 1800, 1, NULL, NULL, NULL),
(4, 4, 1, 1, '2025-11-19', '11:00:00', 30, 1800, 2, 2, 0, 100),
(5, 8, 1, 1, '2025-11-23', '20:00:00', 30, 1800, 2, 1, 1, 50),
(6, 1, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 0, 2, 0),
(7, 2, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 2, 2, 100),
(8, 3, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 2, 0, 100),
(9, 4, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 0, 3, 0),
(10, 8, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 1, 3, 50),
(11, 9, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 0, 2, 0),
(12, 10, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 2, 0, 100),
(13, 11, 1, 2, '2025-11-23', '18:30:00', 30, 1800, 2, 1, 1, 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(5) NOT NULL,
  `id_peserta` int(5) NOT NULL,
  `id_soal_ujian` int(5) NOT NULL,
  `jawaban` varchar(15) NOT NULL,
  `skor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `id_peserta`, `id_soal_ujian`, `jawaban`, `skor`) VALUES
(1, 2, 1, 'A', '1'),
(2, 2, 1, 'A', '1'),
(3, 2, 1, 'A', '1'),
(4, 7, 1, 'A', '0'),
(5, 7, 2, 'B', '0'),
(6, 9, 1, 'D', '0'),
(7, 10, 1, 'C', '0'),
(8, 10, 2, 'A', '0'),
(9, 13, 7, 'D', '1'),
(10, 13, 6, 'B', '0'),
(11, 15, 7, 'A', '1'),
(12, 15, 8, 'D', '1'),
(13, 15, 6, 'A', '1'),
(14, 17, 9, 'A', '1'),
(15, 17, 8, 'D', '1'),
(16, 17, 7, 'A', '1'),
(17, 17, 6, 'E', '0'),
(18, 14, 8, 'E', '0'),
(19, 14, 6, 'E', '0'),
(20, 14, 7, 'A', '1'),
(21, 14, 9, 'E', '0'),
(22, 24, 17, 'D', '1'),
(23, 24, 19, 'B', '1'),
(24, 24, 18, 'B', '1'),
(25, 24, 20, 'B', '0'),
(26, 24, 16, 'C', '1'),
(27, 25, 18, 'A', '0'),
(28, 25, 16, 'C', '1'),
(29, 25, 17, 'B', '0'),
(30, 25, 19, 'C', '0'),
(31, 25, 20, 'C', '1'),
(32, 26, 19, 'B', '1'),
(33, 26, 20, 'C', '1'),
(34, 26, 18, 'B', '1'),
(35, 26, 16, 'C', '1'),
(36, 26, 17, 'D', '1'),
(37, 27, 20, 'A', '0'),
(38, 27, 17, 'A', '0'),
(39, 27, 16, 'D', '0'),
(40, 27, 18, 'A', '0'),
(41, 27, 19, 'A', '0'),
(42, 29, 21, 'A', '1'),
(43, 30, 2, 'C', '1'),
(44, 30, 1, 'A', '0'),
(45, 34, 2, 'C', '1'),
(46, 34, 1, 'E', '1'),
(47, 32, 2, '', '0'),
(48, 32, 1, '', '0'),
(49, 31, 1, '', '0'),
(50, 31, 2, '', '0'),
(51, 4, 1, 'E', '1'),
(52, 4, 2, 'C', '1'),
(53, 6, 7, 'A', '0'),
(54, 6, 6, 'A', '0'),
(55, 7, 7, 'D', '1'),
(56, 7, 6, 'C', '1'),
(57, 8, 6, 'C', '1'),
(58, 8, 7, 'D', '1'),
(59, 9, 6, 'A', '0'),
(60, 9, 7, 'A', '0'),
(61, 11, 6, 'B', '0'),
(62, 11, 7, 'B', '0'),
(63, 12, 7, 'D', '1'),
(64, 12, 6, 'C', '1'),
(65, 5, 2, 'C', '1'),
(66, 5, 1, 'D', '0'),
(67, 10, 7, 'A', '0'),
(68, 10, 6, 'C', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_ujian`
--

CREATE TABLE `tb_jenis_ujian` (
  `id_jenis_ujian` int(11) NOT NULL,
  `jenis_ujian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jenis_ujian`
--

INSERT INTO `tb_jenis_ujian` (`id_jenis_ujian`, `jenis_ujian`) VALUES
(1, 'UTS Ganjil '),
(3, 'UAS Genap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'RPL 1'),
(2, 'RPL 2'),
(3, 'RPL 3'),
(4, 'TKJ 1'),
(5, 'TKJ 2'),
(6, 'TKJ 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matapelajaran`
--

CREATE TABLE `tb_matapelajaran` (
  `id_matapelajaran` int(11) NOT NULL,
  `kode_matapelajaran` varchar(50) DEFAULT NULL,
  `nama_matapelajaran` varchar(100) DEFAULT NULL,
  `id_guru` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matapelajaran`
--

INSERT INTO `tb_matapelajaran` (`id_matapelajaran`, `kode_matapelajaran`, `nama_matapelajaran`, `id_guru`) VALUES
(1, '001', 'Pemrograman Dasar', '3273051408630011'),
(2, '002', 'Pemrograman Website', '3273052010700012'),
(3, '003', 'Basis Data', '3273056010700013'),
(4, '004', 'Pemrograman Berorientasi Proyek', '3273056010900010'),
(5, '005', 'Komputer dan Jaringan Dasar', '3273050910950016'),
(6, '006', 'Teknologi Jaringan Berbasis Luas (WAN)', '3273051210800019'),
(7, '007', 'Administrasi Sistem Jaringan', '3273051210800019'),
(8, '008', 'Bahasa Indonesia', '3273051011700015'),
(9, '009', 'Matematika', '3273051012650017'),
(10, '010', 'Bahasa Inggris', '3273050108800018'),
(11, '011', 'Pendidikan Kewarganegaraan', '3273051010600014'),
(12, '012', 'Pendidikan Agama', '3273056010900009');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `nis` int(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `id_kelas`, `nama_siswa`, `nis`, `username`, `password`) VALUES
(1, 1, 'ALFARUQ ARVIANSYAH', 11040, 'alfaruq', 'alfaruq'),
(2, 1, 'ALISA JAUHARO FIRDAUSA', 11041, 'alisa', 'alisa'),
(3, 1, 'ALYA KIRANIA PUTRI VIANTI', 11042, 'alya', 'alya'),
(4, 1, 'ALYCIA RAHMA SHAFIRAH', 11043, 'alycia', 'alycia'),
(6, NULL, NULL, NULL, NULL, NULL),
(8, 1, 'AURA AGASTYA ANDINI', 11044, 'auraaga', 'auraag'),
(9, 1, 'Zidan', 11063, 'zidan', 'zidan'),
(10, 1, 'zidan pani', 11064, 'zidanpani', 'zidanpani'),
(11, 1, 'Ofpani aziz', 11065, 'ofpani', 'ofpani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_soal_ujian`
--

CREATE TABLE `tb_soal_ujian` (
  `id_soal_ujian` int(11) NOT NULL,
  `id_matapelajaran` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `e` text NOT NULL,
  `kunci_jawaban` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_soal_ujian`
--

INSERT INTO `tb_soal_ujian` (`id_soal_ujian`, `id_matapelajaran`, `pertanyaan`, `a`, `b`, `c`, `d`, `e`, `kunci_jawaban`) VALUES
(1, 1, '<p>Urutan langkah-langkah logis untuk menyelesaikan masalah yang disusun secara sistematis disebut...</p>\r\n', 'Sintaks', 'Pseudocode', 'Program', 'Flowchart', 'Algoritma', 'E'),
(2, 1, '<p>Simbol Flowchart yang digunakan untuk menyatakan proses input atau output data (membaca data atau menampilkan hasil) adalah...</p>\r\n', 'Garis Panah (Arrow Line)', 'Belah Ketupat (Diamond)', 'Jajaran Genjang (Parallelogram)', 'Oval/Terminator', 'Persegi Panjang (Rectangle)', 'C'),
(3, 5, '<p>Komponen utama pada komputer yang berfungsi sebagai otak atau pusat pemrosesan dan perhitungan adalah...</p>\r\n', 'VGA Card (Video Graphics Array)', 'Hard Disk Drive (HDD)', 'CPU (Central Processing Unit)', 'Motherboard', 'RAM (Random Access Memory)', 'C'),
(4, 5, '<p>Perangkat jaringan yang berfungsi untuk menghubungkan beberapa komputer dalam satu jaringan lokal (LAN) dan bekerja pada lapisan Data Link (Layer 2) model OSI adalah...</p>\r\n', 'Repeater', 'Modem', 'Router', 'Hub', 'Switch', 'E'),
(6, 2, '<p>Software aplikasi yang digunakan untuk menampilkan atau membuka halaman website disebut...B. C. D. E.</p>\r\n\r\n<p>&nbsp;</p>\r\n', ' Text Editor ', 'Web Browser', 'Web Server', 'Database', 'Compiler', 'C'),
(7, 2, '<p>Tag HTML yang digunakan untuk membuat judul pada tab browser (bukan judul di dalam konten halaman) adalah...&nbsp;</p>\r\n', '<header>', '<head>', '<h1>', '<title>', '<caption>', 'D');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indeks untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_soal_ujian` (`id_soal_ujian`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indeks untuk tabel `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  ADD PRIMARY KEY (`id_jenis_ujian`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  ADD PRIMARY KEY (`id_matapelajaran`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  ADD PRIMARY KEY (`id_soal_ujian`),
  ADD KEY `id_matapelajaran` (`id_matapelajaran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_hasil_ujian`
--
ALTER TABLE `tb_hasil_ujian`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_ujian`
--
ALTER TABLE `tb_jenis_ujian`
  MODIFY `id_jenis_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_matapelajaran`
--
ALTER TABLE `tb_matapelajaran`
  MODIFY `id_matapelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_soal_ujian`
--
ALTER TABLE `tb_soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
