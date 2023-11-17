<?php
session_start();
include '../../koneksi.php';
if ($_SESSION['status'] != "login") {
    header('location:../../login/login.php?pesan=belum_login');
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
    <form action="./proses_add.php" method="POST">
        <label for="nisn">NISN:</label>
        <input type="text" name="nisn" required><br>

        <label for="nis">NIS:</label>
        <input type="text" name="nis" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="id_kelas">Kelas:</label>
        <input type="text" name="id_kelas" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required><br>

        <label for="no_telp">No. Telp:</label>
        <input type="text" name="no_telp" maxlength="12" required><br>

        <label for="id_spp">ID SPP:</label>
        <input type="text" name="id_spp" required><br>

        <label for="id_akun">ID Akun Siswa:</label>
        <select class="dd_id_akun" name="id_akun" required>
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
    </form>
</body>

</html>