<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != "login") {
  header('location:../login/login.php?pesan=belum_login');
}

$no = 1;
$id_akun = $_SESSION["id_akun"];
$query = mysqli_query($conn, "SELECT * FROM `data_pembayaran` WHERE id_akun_siswa = $id_akun");
while ($row = mysqli_fetch_array($query)) {
  $akun_petugas = $row["id_akun"];
  $query2 = mysqli_query($conn, "SELECT * FROM `data_akun` WHERE id_akun = $akun_petugas ");
  $akun_data = mysqli_fetch_assoc($query2);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../admin/css/history.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <a href="../login/logout.php" style="color:white;background:red; border-radius:3px; padding:5px;" >Logout</a><br><br>
  <?php
  $sql = "SELECT * FROM data_pembayaran WHERE id_akun_siswa = $id_akun";
  $result = mysqli_query($conn, $sql);


  if (mysqli_num_rows($result) > 0) {
    echo "<table class='blueTable'>";
    echo "<tr>";
    echo "<th>id_akun</th>";
    echo "<th>nisn</th>";
    echo "<th>tgl_bayar</th>";
    echo "<th>bulan_dibayar</th>";
    echo "<th>tahun_dibayar</th>";
    echo "<th>id_spp</th>";
    echo "<th>Jumlah_bayar</th>";
    echo "<th>akun_siswa</th>";
    echo "</tr>";
    // Menampilkan data dari tabel database
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id_akun'] . "</td>";
      echo "<td>" . $row['nisn'] . "</td>";
      echo "<td>" . $row['tgl_bayar'] . "</td>";
      echo "<td>" . $row['bulan_dibayar'] . "</td>";
      echo "<td>" . $row['tahun_dibayar'] . "</td>";
      echo "<td>" . $row['id_spp'] . "</td>";
      echo "<td>" . $row['jumlah_bayar'] . "</td>";
      echo "<td>" . $row['id_akun_siswa'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "<table class='blueTable'>";
    echo "<tr>";
    echo "<th>id_akun</th>";
    echo "<th>nisn</th>";
    echo "<th>tgl_bayar</th>";
    echo "<th>bulan_dibayar</th>";
    echo "<th>tahun_dibayar</th>";
    echo "<th>id_spp</th>";
    echo "<th>Jumlah_bayar</th>";
    echo "</tr>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
    echo "<td>tidak ada pembayaran</td>";
  }

  mysqli_close($conn); // Menutup koneksi
  ?>

  <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>
</body>

</html>