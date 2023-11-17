<?php
session_start();
include '../../koneksi.php';

if ($_SESSION['status'] != "login") {
  header('location:../../login/login.php?pesan=belum_login');
} elseif ($_SESSION['level'] !== "admin") {
  echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini.";
  // Anda juga dapat mengarahkan pengguna ke halaman lain atau melakukan tindakan lain sesuai kebijakan aplikasi Anda.
  exit();
}
$query = "SELECT ds.nisn, ds.nis, ds.nama, ds.no_telp, ds.alamat, CONCAT(dak.id_akun, ' - ', dak.nama) AS id_akun,
CONCAT(dk.id_kelas, ' - ', dk.nama_kelas) AS id_kelas, 
CONCAT(ds.id_spp, ' - ', dsp.tahun, ' - ', dsp.nominal) AS id_spp
FROM data_siswa ds
LEFT JOIN data_kelas dk ON ds.id_kelas = dk.id_kelas
LEFT JOIN data_spp dsp ON dsp.id_spp = ds.id_spp
LEFT JOIN data_akun dak ON dak.id_akun = ds.id_akun";


$result = mysqli_query($conn, $query);

$sis_sql = "SELECT * FROM data_kelas";
$sis_result = mysqli_query($conn, $sis_sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Records</title>
  <link rel="stylesheet" href="../css/c-siswa.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="content">
    <a href="../index.php" class="add"><i class="fa-solid fa-arrow-left"></i> Kembali</a><br><br>
    <div class="hb">
    <a class="add" href="../component/add.php"><i class="fa-solid fa-plus"></i>Add</a>
    <div class="filter-container">
      <label for="kelas-filter">Filter kelas:</label>
      <select id="kelas-filter">
        <option value="">Semua Kelas</option>
        <?php
        while ($sis_row = mysqli_fetch_assoc($sis_result)) {
          echo "<option value='" . $sis_row['id_kelas'] . "'>" . $sis_row['nama_kelas'] . "</option>";
        }
        ?>
      </select>
      <button onclick="filterData()">Filter</button>
    </div>
    </div>
    <table class="blueTable">
      <thead>
        <tr>
          <th>NISN</th>
          <th>NIS</th>
          <th>NAMA</th>
          <th>ID dan KELAS</th>
          <th>ALAMAT</th>
          <th>NO TELP</th>
          <th>ID SPP</th>
          <th>ID AKUN</th>
          <th>ACTION</th>
        </tr>
      </thead>

      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['nisn'] . "</td>";
          echo "<td>" . $row['nis'] . "</td>";
          echo "<td>" . $row['nama'] . "</td>";
          echo "<td>" . $row['id_kelas'] . "</td>";
          echo "<td>" . $row['alamat'] . "</td>";
          echo "<td>" . $row['no_telp'] . "</td>";
          echo "<td>" . $row['id_spp'] . "</td>";
          echo "<td>" . $row['id_akun'] . "</td>";
          echo "<td>";
          echo "<a class='delete'  href='javascript:void(0);' onclick='confirmDelete(" . $row['nisn'] . ")'><i class='fas fa-trash'></i>Delete</a>";
          echo "<a class='edit' href='../component/edit.php?nisn=$row[nisn]'><i class='fas fa-edit'></i>Edit</a>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>

  <script>
    function filterData() {
      var selectedKelas = document.getElementById('kelas-filter').value;
      var rows = document.querySelectorAll('.blueTable tbody tr');

      rows.forEach(function (row) {
        var dataKelas = row.querySelector('td:nth-child(4)').innerText;
        if (selectedKelas === '' || dataKelas.includes(selectedKelas)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>
</body>

</html>