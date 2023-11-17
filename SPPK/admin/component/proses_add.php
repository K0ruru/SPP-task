<?php
// Pengaturan koneksi database
require '../../koneksi.php';

// Mendapatkan data formulir
$nisn = $_POST["nisn"];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$id_kelas = $_POST['id_kelas'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];
$id_spp = $_POST['id_spp'];
$id_akun = $_POST['id_akun'];

// Validasi data
if (empty($nisn) || empty($nis) || empty($nama) || empty($id_kelas) || empty($alamat) || empty($no_telp) || empty($id_spp) || empty($id_akun)) {
    echo "Semua kolom harus diisi."; // Menampilkan pesan jika ada kolom yang kosong
    exit; // Keluar dari skrip PHP
}

// Kueri SQL untuk memasukkan data ke dalam database menggunakan parameterized query
$sql = "INSERT INTO data_siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp, id_akun) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql); // Menyiapkan pernyataan SQL
$stmt->bind_param("sssisssi", $nisn, $nis, $nama, $id_kelas, $alamat, $no_telp, $id_spp, $id_akun); // Mengikat parameter ke pernyataan SQL jika 's' itu string , jika i itu integer

// Menjalankan query
if ($stmt->execute()) { // Jika query berhasil dijalankan
    header("Location:../crud/c-siswa.php"); // Pengguna diarahkan ke halaman lain setelah query berhasil dieksekusi
} else {
    echo "Error: " . $stmt->error; // Menampilkan pesan kesalahan jika query tidak berhasil dieksekusi
}

// Menutup pernyataan dan koneksi database
$stmt->close();
$conn->close();
?>
