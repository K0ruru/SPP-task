<?php
session_start(); // Memulai sesi untuk pengelolaan sesi pengguna.
include '../../koneksi.php'; // Mengimpor file koneksi ke database.

if ($_SESSION['status'] != "login") { // Memeriksa apakah status sesi adalah "login".
    header('location:../../login/login.php?pesan=belum_login'); // Pengguna diarahkan ke halaman login dengan pesan kesalahan jika tidak.
} elseif ($_SESSION['level'] !== "admin") { // Memeriksa apakah level pengguna bukan "admin".
    echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini."; // Pesan ditampilkan jika pengguna bukan admin.
    exit(); // Keluar dari skrip PHP.
}

if (isset($_GET['nisn']) && is_numeric($_GET['nisn'])) { // Memeriksa apakah 'nisn' disetel dalam URL dan apakah itu integer yang valid.
    $nisn = $_GET['nisn']; // Menyimpan nilai 'nisn' dari URL.

    $query = "SELECT * FROM data_siswa WHERE nisn = $nisn"; // Membuat query SQL untuk mengambil data siswa berdasarkan 'nisn'.
    $result = mysqli_query($conn, $query); // Menjalankan query SQL dan menyimpan hasilnya.

    if ($result && mysqli_num_rows($result) > 0) { // Memeriksa apakah query berhasil dieksekusi dan apakah setidaknya satu baris data yang dihasilkan.
        $row = mysqli_fetch_assoc($result); // Menyimpan baris data hasil query ke dalam array asosiatif.
    } else {
        header('location: error_page.php'); // Mengarahkan pengguna ke halaman kesalahan jika data siswa tidak ditemukan.
        exit(); // Keluar dari skrip PHP.
    }
} else {
    header('location: error_page.php'); // Mengarahkan pengguna ke halaman kesalahan jika 'nisn' tidak disediakan atau bukan integer yang valid.
}

// Lakukan query ke database untuk mendapatkan data akun siswa dengan level "siswa"
$query = "SELECT id_kelas, nama_kelas, kompetensi_keahlian FROM data_kelas";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>

<body>
    <h2>Edit Student</h2>
    <?php
    if (isset($row)) {
        ?>
        <form action="proses_edit.php" method="POST">
            <label for="nisn">NISN:</label>
            <input type="text" name="nisn" value="<?php echo $row['nisn']; ?>" readonly><br>
            <label for="nis">NIS:</label>
            <input type="text" name="nis" value="<?php echo $row['nis']; ?>"><br>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
            <label for="id_kelas">Kelas:</label>
            <select name="id_kelas">
                <?php
                while ($kelas = mysqli_fetch_assoc($result)) {
                    $selected = ($row['id_kelas'] == $kelas['id_kelas']) ? 'selected' : '';
                    echo '<option value="' . $kelas['id_kelas'] . '" ' . $selected . '>' . $kelas['nama_kelas'] . ' - ' . $kelas['kompetensi_keahlian'] . '</option>';
                }
                ?>
            </select><br>
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
            <label for="no_telp">No. Telp:</label>
            <input type="text" name="no_telp" maxlength="12" value="<?php echo $row['no_telp']; ?>"><br>
            <label for="id_spp">SPP :</label>
            <?php
            // Retrieve and display the concatenated information of "id_spp - tahun"
            $spp_query = "SELECT CONCAT(id_spp, ' - ', tahun, ' - ', nominal) AS spp_info FROM data_spp WHERE id_spp = " . $row['id_spp'];
            $spp_result = mysqli_query($conn, $spp_query);
            $spp_row = mysqli_fetch_assoc($spp_result);
            echo '<input type="text" name="id_spp" value="' . $spp_row['spp_info'] . '" readonly><br>';
            ?>

            <label for="id_akun">ID AKUN:</label>
            <input type="text" name="id_akun" value="<?php echo $row['id_akun']; ?>" readonly><br><br>
            <input type="submit" value="Update">
            <a href="../crud/c-siswa.php">Cancel</a><br>
        </form>
        <?php
    } else {
        echo "Data siswa tidak ditemukan.";
    }
    ?>
</body>

</html>