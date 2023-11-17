<?php
session_start();
include '../../koneksi.php';
if ($_SESSION['status'] != "login") {
  header('location:../../login/login.php?pesan=belum_login');
}


// Check if 'nisn' is set in the URL and if it's a valid integer.
if (isset($_GET['nisn']) && is_numeric($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    
    // Fetch the student data from the database based on the 'nisn' value.
    $query = "SELECT * FROM data_siswa WHERE nisn = $nisn";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Redirect or handle the case where the student with that 'nisn' does not exist.
        header('location: error_page.php');
        exit();
    }
} else {
    // Redirect or handle the case where 'nisn' is not provided or is not a valid integer.
    header('location: error_page.php');
    exit();
}
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
    <form action="proses_edit.php" method="POST">
        <label for="nis">NISN:</label>
        <input type="text" name="nisn" value="<?php echo $row['nisn']; ?>"><br>
        <label for="nis">NIS:</label>
        <input type="text" name="nis" value="<?php echo $row['nis']; ?>"><br>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
        <label for="id_kelas">Kelas:</label>
        <input type="text" name="id_kelas" value="<?php echo $row['id_kelas']; ?>"><br>
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
        <label for="no_telp">No. Telp:</label>
        <input type="text" name="no_telp" maxlength="12" value="<?php echo $row['no_telp']; ?>"><br>
        <label for="id_spp">SPP:</label>
        <input type="text" name="id_spp" value="<?php echo $row['id_spp']; ?>"><br>
        <label for="id_akun">ID AKUN:</label>
        <input type="text" name="id_akun" value="<?php echo $row['id_akun']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>
