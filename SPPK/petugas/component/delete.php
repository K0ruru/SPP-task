<?php
include '../../koneksi.php';

// Mengambil nilai 'id' dari parameter URL
$nisn = $_GET['nisn'];

// Menghapus data dari tabel 'karyawan' berdasarkan ID yang diterima dari parameter 'id'
mysqli_query($conn, "DELETE FROM siswa WHERE nisn = '$nisn'");

// Mengarahkan pengguna kembali ke halaman 'data_karyawan.php'
header("location: ../index.php");
?>