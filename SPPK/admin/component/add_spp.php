<?php
session_start(); // Memulai sesi untuk pengelolaan sesi pengguna.
include '../../koneksi.php'; // Mengimpor file koneksi ke database.

if ($_SESSION['status'] != "login") { // Memeriksa apakah status sesi adalah "login".
    header('location:../../login/login.php?pesan=belum_login'); // Pengguna diarahkan ke halaman login dengan pesan kesalahan jika tidak.
} elseif ($_SESSION['level'] !== "admin") { // Memeriksa apakah level pengguna bukan "admin".
    echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini."; // Pesan ditampilkan jika pengguna bukan admin.
    exit(); // Keluar dari skrip PHP.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/add.css">
</head>

<body>
  <h1>Form Tambah Data</h1>
  <form action="proses_add_spp.php" method="POST">

    <label for="tahun">Tahun :</label>
    <input type="text" name="tahun" required><br>

    <label for="nominal">Nominal :</label>
    <input type="text" name="nominal" required><br>

    <input type="submit" value="Insert Data">
    <a href="../crud/c-spp.php">Cancel</a><br>

  </form>
</body>

</html>