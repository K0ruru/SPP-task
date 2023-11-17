<?php
include '../../koneksi.php';

// Mengambil nilai 'id' dari parameter URL
$nisn = $_GET['nisn'];

// Menghapus data dari tabel 'siswa' berdasarkan ID yang diterima dari parameter 'id'
mysqli_query($conn, "DELETE FROM data_siswa WHERE nisn = '$nisn'");

// Mengarahkan pengguna kembali ke halaman ''data list siswa'
header("location: ../crud/c-siswa.php");
?>