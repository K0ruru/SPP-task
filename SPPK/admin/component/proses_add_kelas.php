<?php
// Pengaturan koneksi database
require '../../koneksi.php';

// Mendapatkan data formulir
$nama_kelas = $_POST['nama_kelas'];
$kompetensi_keahlian = $_POST['kompetensi_keahlian'];

// Kueri SQL untuk memasukkan data ke dalam database menggunakan parameterized query
$sql = "INSERT INTO data_kelas (nama_kelas, kompetensi_keahlian) VALUES (?, ?)";
$stmt = $conn->prepare($sql); // Menyiapkan pernyataan SQL
$stmt->bind_param("ss", $nama_kelas, $kompetensi_keahlian);// "ss" mengindikasikan bahwa kedua nilai yang diikat adalah string

// Menjalankan query
if ($stmt->execute()) { // Jika query berhasil dijalankan
    header("Location:../crud/c-kelas.php"); // Pengguna diarahkan ke halaman lain setelah query berhasil dieksekusi
} else {
    echo "Error: " . $stmt->error; // Menampilkan pesan kesalahan jika query tidak berhasil dieksekusi
}

// Menutup pernyataan dan koneksi database
$stmt->close();
$conn->close();
?>

