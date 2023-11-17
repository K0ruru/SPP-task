<?php
session_start();
include '../../koneksi.php';

if ($_SESSION['status'] != "login") {
  header('location:../../login/login.php?pesan=belum_login');
  exit();
} elseif ($_SESSION['level'] !== "admin") {
  echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini.";
  exit();
}

$sql = "SELECT nisn FROM data_siswa";
$result = mysqli_query($conn, $sql);

$spp_sql = "SELECT id_spp FROM data_spp";
$spp_result = mysqli_query($conn, $spp_sql);

// Mengambil akun siswa yang terhubung dengan data pembayaran tertentu
$sis_sql = "SELECT da.id_akun, da.nama 
            FROM data_akun da 
            JOIN data_siswa ds ON da.id_akun = ds.id_akun";
$sis_result = mysqli_query($conn, $sis_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entry</title>
  <link rel="stylesheet" href="../css/add.css">
</head>

<body>
  <h1>Entry Pembayaran</h1>

  <form action="proses_entry.php" method="post">
    <label for="id_akun">ID Akun Pengentry :</label>
    <input type="text" id="id_akun" name="id_akun" value="<?php echo $_SESSION['id_akun'] ?>" readonly /><br /><br />

    <label for="nisn">NISN:</label>
    <select id="nisn" name="nisn"">
      <option value="" hidden>pilih NISN</option>
      <?php
      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $nisn = $row['nisn'];
          // echo '<option value="' . $nisn . '">" . $nisn . " - " . $nama . "</option>';
          ?>
      <option value=" <?php echo $nisn ?>">
          <?php echo $nisn ?>
          </option>
          <?php
        }
      } else {
        echo "Tidak dapat mengeksekusi query.";
      } ?>
    </select><br /><br />

    <label for=" tgl_bayar">tgl_bayar:</label>
    <input type="date" id="tgl_bayar" name="tgl_bayar" /><br />

    <label for="bulan_dibayar">Bulan Dibayar:</label>
    <select id="bulan_dibayar" name="bulan_dibayar">
      <?php
      $bulan = array(
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );

      foreach ($bulan as $value) {
        echo "<option value='" . $value . "'>" . $value . "</option>";
      }
      ?>
    </select><br /><br />

    <label for="tahun_dibayar">Tahun Dibayar:</label>
    <select name="tahun_dibayar" required>
      <?php
      $tahun = array(
        '2023',
        '2024',
        '2025',
      );

      foreach ($tahun as $value) {
        echo "<option value='" . $value . "'>" . $value . "</option>";
      }
      ?>
    </select><br><br>

    <label for="id_spp"> SPP:</label>
    <select id="id_spp" name="id_spp" required>
      <?php
      if ($spp_result) {
        while ($row = mysqli_fetch_assoc($spp_result)) {
          $id_spp = $row['id_spp'];
          // echo '<option value="' . $nisn . '">" . $nisn . " - " . $nama . "</option>';
          ?>
          <option value=" <?php echo $id_spp ?>">
            <?php echo $id_spp ?>
          </option>
          <?php
        }
      } else {
        echo "Tidak dapat mengeksekusi query.";
      } ?>
    </select>
    <br><br>

    <label for="id_akun_siswa">Akun Siswa:</label>
    <select id="id_akun_siswa" name="id_akun_siswa" required>
      <?php
      if ($sis_result) {
        while ($row = mysqli_fetch_assoc($sis_result)) {
          $id_akun_siswa = $row['id_akun'];
          $nama = $row['nama'];
          ?>
          <option value="<?php echo $id_akun_siswa ?>">
            <?php echo $id_akun_siswa . ' - ' . $nama ?>
          </option>
          <?php
        }
      } else {
        echo "Tidak dapat mengeksekusi query.";
      }
      ?>
    </select>

    <br><br>

    <label for="jumlah_bayar">jumlah Dibayar:</label>
    <input type="text" id="jumlah_bayar" name="jumlah_bayar" /><br /><br />

    <input type="submit" value="Submit" />
  </form>

  <script>
    function fillIdSpp() {
      var selectedOption = document.getElementById("nisn").options[document.getElementById("nisn").selectedIndex];
      var nisn = selectedOption.value;

      // Menggunakan AJAX untuk mendapatkan id_spp dari server
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var idSpp = xhr.responseText;
          document.getElementById("id_spp").value = idSpp;
        }
      };

      // Mengganti URL dan parameter sesuai dengan implementasi server-side Anda
      xhr.open("GET", "get_id_spp.php?nisn=" + nisn, true);
      xhr.send();
    }
  </script>

</body>

</html>