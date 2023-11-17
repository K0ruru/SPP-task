<?php
session_start();
include '../koneksi.php';
if ($_SESSION['status'] != "login") {
  header('location:../login/login.php?pesan=belum_login');
} elseif ($_SESSION['level'] !== "petugas") {
  echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini.";
  // Anda juga dapat mengarahkan pengguna ke halaman lain atau melakukan tindakan lain sesuai kebijakan aplikasi Anda.
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Petugas</title>
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>

<body>
  <div class="sidebar">
    <h2>Home</h2>
    <a href="#">Home</a>
    <!-- <div class="has-dropdown">
      <a href="#">data Akun</a>
      <div class="dropdown-menu">
        <ul>
          <li><a href="Akun/siswa/index.php">Siswa</a></li>
          <li><a href="akun/admin/index.php">Admin</a></li>
          <li><a href="akun/petugas/index.php">Petugas</a></li>
        </ul>
      </div>
    </div> -->
    <div class="has-dropdown">
      <a href="#">Entry/History</a>
      <div class="dropdown-menu">
        <ul>
          <li><a href="entry/entry.php">Entry</a></li>
          <li><a href="history/history.php">History</a></li>
        </ul>
      </div>
    </div>
    <br /><br /><br /><br />
    <a href="../login/logout.php"
      style="color:white;background:red; border-radius:3px; padding:5px; width:70px; text-align:center; margin-left:10px;">Logout</a><br><br>
  </div>

  <div class="content">
    <!-- Konten selamat datang dengan nama pengguna -->
    <h1>Selamat datang,
      <?php echo $_SESSION['username']; ?>!
    </h1>
    <p>Anda telah masuk ke dashboard Petugas.</p>
    <p>Hati-hati dengan apa yang anda tekan jika anda salah <br> tekan dan menyebabkan masalah itu bukan urusan kami (:
    </p>
  </div>
  <script>
    const dropdowns = document.querySelectorAll('.has-dropdown');

    dropdowns.forEach((dropdown) => {
      const dropdownMenu = dropdown.querySelector('.dropdown-menu');

      dropdown.addEventListener('mouseenter', () => {
        dropdownMenu.style.display = 'block';
      });

      dropdown.addEventListener('mouseleave', () => {
        dropdownMenu.style.display = 'none';
      });
    });
  </script>
  <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>
</body>

</html>