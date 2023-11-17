<?php
session_start(); // Memulai sesi untuk pengelolaan sesi pengguna.
require '../../koneksi.php'; // Mengimpor file koneksi ke database.

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
    <form action="proses_add.php" method="POST">
        <label for="nisn">NISN:</label>
        <input type="text" name="nisn" required><br>

        <label for="nis">NIS:</label>
        <input type="text" name="nis" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="id_kelas">Kelas:</label>
        <select name="id_kelas" required>
            <option value="">Pilih kelas</option>
            <?php
            // Lakukan query ke database untuk mendapatkan data akun siswa dengan level "siswa"
            $query = "SELECT id_kelas, nama_kelas, kompetensi_keahlian FROM data_kelas";
            $result = mysqli_query($conn, $query);

            // Loop melalui hasil query dan buat opsi dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_kelas'] . "'>" . $row['id_kelas'] . " - " . $row['nama_kelas'] . " - " . $row['kompetensi_keahlian'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required><br>

        <label for="no_telp">Nomor Telepon:</label>
        <input type="text" name="no_telp" maxlength="12" required><br>

        <label for="id_spp">SPP:</label>
        <select name="id_spp" required>
            <option value="">Pilih SPP</option>

            <?php
            // Lakukan query ke database untuk mendapatkan data akun siswa dengan level "siswa"
            $query = "SELECT id_spp, tahun, nominal FROM data_spp";
            $result = mysqli_query($conn, $query);

            // Loop melalui hasil query dan buat opsi dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_spp'] . "'>" . $row['id_spp'] . " - " . $row['tahun'] . " - " . $row['nominal'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="id_akun">ID Akun Siswa:</label>
        <select name="id_akun" required>
            <option value="" hidden>Pilih Akun</option>

            <?php
            // Lakukan query ke database untuk mendapatkan data akun siswa dengan level "siswa"
            $query = "SELECT id_akun, nama FROM data_akun WHERE level = 'siswa'";
            $result = mysqli_query($conn, $query);

            // Loop melalui hasil query dan buat opsi dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_akun'] . "'>" . $row['id_akun'] . " - " . $row['nama'] . "</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Insert Data">
        <a href="../crud/c-siswa.php">Cancel</a><br>
    </form>
    <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>
</body>

</html>