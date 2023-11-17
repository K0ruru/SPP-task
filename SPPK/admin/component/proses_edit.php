<?php
session_start();
include '../../koneksi.php';


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

        // Periksa apakah id_kelas yang diterima dari POST valid
        $checkQuery = "SELECT id_kelas FROM data_kelas WHERE id_kelas = '$id_kelas'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) == 0) {
            // id_kelas tidak valid, tampilkan pesan kesalahan
            echo "ID Kelas tidak valid.";
        } else {
            // Lanjutkan dengan query UPDATE
            $updateQuery = "UPDATE data_siswa SET nis = '$nis', nama = '$nama', id_kelas = '$id_kelas', alamat = '$alamat', no_telp = '$no_telp', id_spp = '$id_spp', id_akun = '$id_akun' WHERE nisn = $nisn";
            $updateResult = mysqli_query($conn, $updateQuery);
            if ($updateResult) {
                // Redirect atau tampilkan pesan sukses
                header('location: ../crud/c-siswa.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
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