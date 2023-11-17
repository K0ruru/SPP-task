<?php
session_start(); // Memulai sesi untuk pengelolaan sesi pengguna.
include '../../koneksi.php'; // Mengimpor file koneksi ke database.


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the required fields are set.
    if (isset($_POST['nisn'], $_POST['nis'], $_POST['nama'], $_POST['id_kelas'], $_POST['alamat'], $_POST['no_telp'], $_POST['id_spp'], $_POST['id_akun'])) {
        $nisn = $_POST['nisn'];
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $id_kelas = $_POST['id_kelas'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $id_spp = $_POST['id_spp'];
        $id_akun = $_POST['id_akun'];

        // Update the student data in the database.
        $query = "UPDATE data_siswa SET nis = '$nis', nama = '$nama', id_kelas = '$id_kelas', alamat = '$alamat', no_telp = '$no_telp', id_spp = '$id_spp', id_akun = '$id_akun' WHERE nisn = $nisn";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect to the student list page or any other page you want.
            header('location: ../crud/c-siswa.php');
            exit();
        } else {
            // Handle the case where the update query fails, you can display an error message.
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle the case where the required fields are not set.
        echo "All fields are required.";
    }
} else {
    // Handle the case where the form is not submitted via POST.
    header('location: error_page.php');
    exit();
}
?>
