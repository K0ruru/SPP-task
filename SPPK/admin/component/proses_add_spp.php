<?php
// Pengaturan koneksi database
require '../../koneksi.php';

// Mendapatkan data formulir
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];

// Kueri SQL untuk memasukkan data ke dalam database menggunakan parameterized query
$sql = "INSERT INTO data_spp (tahun, nominal) VALUES (?, ?)";
$stmt = $conn->prepare($sql); // Menyiapkan pernyataan SQL
$stmt->bind_param("ii", $tahun, $nominal); // "ii" mengindikasikan bahwa kedua nilai yang diikat adalah integer

// Menjalankan query
if ($stmt->execute()) { // Jika query berhasil dijalankan
    header("Location:../crud/c-spp.php");// Pengguna diarahkan ke halaman lain setelah query berhasil dieksekusi
} else {
    echo "Error: " . $stmt->error; // Menampilkan pesan kesalahan jika query tidak berhasil dieksekusi
}

// Menutup pernyataan dan koneksi database
$stmt->close();
$conn->close();
?>