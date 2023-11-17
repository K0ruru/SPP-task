<?php
session_start(); // Memulai sesi untuk pengelolaan sesi pengguna.
include '../../koneksi.php'; // Mengimpor file koneksi ke database.

if ($_SESSION['status'] != "login") { // Memeriksa apakah status sesi adalah "login".
    header('location:../../login/login.php?pesan=belum_login'); // Pengguna diarahkan ke halaman login dengan pesan kesalahan jika tidak.
} elseif ($_SESSION['level'] !== "admin") { // Memeriksa apakah level pengguna bukan "admin".
    echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini."; // Pesan ditampilkan jika pengguna bukan admin.
    exit(); // Keluar dari skrip PHP.
}

if (isset($_GET['id_spp']) && is_numeric($_GET['id_spp'])) { // Memeriksa apakah 'id_spp' disetel dalam URL dan apakah itu integer yang valid.
    $id_spp = $_GET['id_spp']; // Menyimpan nilai 'id_spp' dari URL.

    $query = "SELECT * FROM data_spp WHERE id_spp = $id_spp"; // Membuat query SQL untuk mengambil data siswa berdasarkan 'id_spp'.
    $result = mysqli_query($conn, $query); // Menjalankan query SQL dan menyimpan hasilnya.

    if ($result && mysqli_num_rows($result) > 0) { // Memeriksa apakah query berhasil dieksekusi dan apakah setidaknya satu baris data yang dihasilkan.
        $row = mysqli_fetch_assoc($result); // Menyimpan baris data hasil query ke dalam array asosiatif.
    } else {
        header('location: error_page.php'); // Mengarahkan pengguna ke halaman kesalahan jika data siswa tidak ditemukan.
        exit(); // Keluar dari skrip PHP.
    }
} else {
    header('location: error_page.php'); // Mengarahkan pengguna ke halaman kesalahan jika 'id_spp' tidak disediakan atau bukan integer yang valid.
    exit(); // Keluar dari skrip PHP.
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit SPP</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>

<body>
    <h2>Edit SPP</h2>
    <form action="proses_edit_spp.php" method="POST">
        <label for="tahun">Tahun :</label>
        <input type="text" name="tahun" value="<?php echo $row['tahun']; ?>"><br>
        <label for="nominal">Nominal :</label>
        <input type="text" name="nominal" value="<?php echo $row['nominal']; ?>"><br>
        <input type="submit" value="Update">
        <a href="../crud/c-spp.php">Cancel</a><br>
    </form>
</body>

</html>