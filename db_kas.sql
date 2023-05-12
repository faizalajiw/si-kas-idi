-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2023 pada 16.30
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
-- Database: `db_kas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `id_banner` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `banner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `banner`
--

INSERT INTO `banner` (`id_banner`, `tanggal`, `banner`) VALUES
(1, '2021-11-12', 'product-1-min.jpg'),
(2, '2021-11-12', 'product-2-min.jpg'),
(3, '2021-11-12', 'product-3-min.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `gambar`, `tanggal`) VALUES
(1, '1.jpg', '2021-11-01'),
(2, '2.jpg', '2021-11-02'),
(3, '3.jpg', '2021-11-03'),
(4, '4.jpg', '2021-11-04'),
(5, '5.jpg', '2021-11-05'),
(6, '6.jpg', '2021-11-06'),
(7, '7.jpg', '2021-11-07'),
(8, '8.jpg', '2021-11-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `slogan` text NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `home`
--

INSERT INTO `home` (`id`, `judul`, `slogan`, `alamat`, `kontak`) VALUES
(1, 'KEUNTUNGAN MEMESAN DI ONE ADVERTISING', 'KEPUASAN KONSUMEN adalah prioritas utama kami, didukung team yang mumpuni, mesin yang terdepan di bidangnya dan service yang selalu update, menjadikan Angkasa Putra solusi terdepan untuk mempercayakan dokumen anda.', 'Jl. Kapten Pattimura, Rw. Sari, Kec. Kota Baru, Kota Jambi, Jambi 36361', '628237643475');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_buka`
--

CREATE TABLE `jam_buka` (
  `id` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `jam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam_buka`
--

INSERT INTO `jam_buka` (`id`, `hari`, `jam`) VALUES
(1, 'Senin', '09.00 - 17.00'),
(2, 'Selasa', '09.00 - 17.00'),
(3, 'Rabu', '09.00 - 17.00'),
(4, 'Kamis', '09.00 - 17.00'),
(5, 'Jumat', '09.00 - 17.00'),
(6, 'Sabtu', '09.00 - 17.00'),
(7, 'Minggu', '09.00 - 17.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id`, `nama`, `gambar`) VALUES
(1, 'Banner', 'banner.jpg'),
(2, 'Brosur', 'brosur.jpg'),
(3, 'ID Card', 'idcard.jpg'),
(4, 'Kartu Pelajar', 'kartupelajar.jpg'),
(5, 'Roll Banner', 'rollbaner.jpg'),
(6, 'Stand Board', 'standboard.jpg'),
(7, 'Stempel Kayu', 'stempelkayu.jpg'),
(8, 'Y Banner', 'ybaner.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `tanggal`, `catatan`, `jumlah`, `user`, `status`) VALUES
(1, '2023-05-08', '', 5000000, '1', 'Iuran IDI, Hibah'),
(2, '2023-05-01', '', 1000000, '1', 'Sewa Gedung'),
(3, '2023-04-10', '', 3000000, '1', 'Sponsor'),
(4, '2023-05-09', '', 10000000, '1', 'Sewa Gedung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal`, `catatan`, `jumlah`, `user`, `status`) VALUES
(1, '2023-05-03', 'event', 500000, 1, ''),
(2, '2023-05-05', 'acara', 500000, 1, 'selesai'),
(3, '2023-05-08', '', 5000000, 1, 'Iklan HUT Brebes'),
(4, '2023-05-10', '', 1000000, 1, 'Dana Sosial');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `create_at` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` enum('admin','pegawai','3') NOT NULL,
  `is_active` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `email`, `no_telp`, `create_at`, `password`, `foto`, `role`, `is_active`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '082389324', 1636668594, '123', 'profil-2305091683599823.png', 'admin', '1'),
(2, 'popo', 'popo', 'popo@gmail.com', '082389324', 1636668594, '123', 'team-5.jpg', 'pegawai', '1'),
(3, 'admin1', 'Elang Bimantoro', 'partofelang@gmail.com', '134', 1683310923, 'admin', '', 'admin', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jam_buka`
--
ALTER TABLE `jam_buka`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jam_buka`
--
ALTER TABLE `jam_buka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
