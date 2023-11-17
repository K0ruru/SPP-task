<?php
include '../../koneksi.php';

// Mengambil nilai 'id' dari parameter URL
$id_kelas = $_GET['id_kelas'];

// Menghapus data dari tabel 'kelas' berdasarkan ID yang diterima dari parameter 'id'
mysqli_query($conn, "DELETE FROM data_kelas WHERE id_kelas = '$id_kelas'");

// Mengarahkan pengguna kembali ke halaman ''data list kelas'
header("location: ../crud/c-kelas.php");
?>