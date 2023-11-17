<?php
include '../../koneksi.php';

// Mengambil nilai 'id' dari parameter URL
$id_kelas = $_GET['id_spp'];

// Menghapus data dari tabel 'spp' berdasarkan ID yang diterima dari parameter 'id'
mysqli_query($conn, "DELETE FROM data_spp WHERE id_spp = '$id_spp'");

// Mengarahkan pengguna kembali ke halaman 'data list spp'
header("location: ../crud/c-spp.php");
?>