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
$query = "SELECT * FROM data_kelas";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Records</title>
  <link rel="stylesheet" href="../css/c-siswa.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>

<body>
  <div class="content">
    <a href="../index.php" class="add"><i class="fa-solid fa-arrow-left"></i> Kembali</a><br><br>
    <a class="add" href="../component/add_kelas.php"><i class="fa-solid fa-plus"></i>Add</a>
    <table class="blueTable">
      <thead>
        <tr>
          <th>ID KELAS</th>
          <th>NAMA KELAS</th>
          <th>JURUSAN</th>
          <th>ACTION</th>
        </tr>
      </thead>

      <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['id_kelas'] . "</td>";
          echo "<td>" . $row['nama_kelas'] . "</td>";
          echo "<td>" . $row['kompetensi_keahlian'] . "</td>";
          echo "<td>";
          echo "<a class='delete' href='javascript:void(0);' onclick='confirmDelete(" . $row['id_kelas'] . ")'><i class='fas fa-trash'></i>Delete</a>";
          echo "<a class='edit' href='../component/edit_kelas.php?id_kelas=$row[id_kelas]'><i class='fas fa-edit'></i>Edit</a>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>

  <script>
    function confirmDelete(id_kelas) {
      if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = "../component/delete_kelas.php?id_kelas=" + id_kelas;
      }
    }
  </script>
</body>

</html>