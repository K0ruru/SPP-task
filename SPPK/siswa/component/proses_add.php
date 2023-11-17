<?php
// Database connection settings
require '../../koneksi.php';

// Get the form data
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
    echo "Semua kolom harus diisi.";
    exit;
}

// SQL query to insert the data into the database using parameterized query
$sql = "INSERT INTO data_siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp, id_akun) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssisssi", $nisn, $nis, $nama, $id_kelas, $alamat, $no_telp, $id_spp, $id_akun);

// Execute the query
if ($stmt->execute()) {
    header("Location:../crud/c-siswa.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
