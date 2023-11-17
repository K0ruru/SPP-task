<?php
session_start();
// Koneksi ke database
include '../../../koneksi.php';
if ($_SESSION['status'] != "login") {
    header('location:../../login/login.php?pesan=belum_login');
    exit();
} elseif ($_SESSION['level'] !== "admin") {
    echo "Anda bukan admin. Anda tidak memiliki akses ke halaman ini.";
    // Anda juga dapat mengarahkan pengguna ke halaman lain atau melakukan tindakan lain sesuai kebijakan aplikasi Anda.
    exit();
}

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data hanya dengan level "siswa"
$sql = "SELECT * FROM data_akun WHERE level = 'siswa'";
$result = mysqli_query($conn, $sql);



// Tutup koneksi database
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Records</title>
    <link rel="stylesheet" href="../../css/c-siswa.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="content">
        <a href="../../index.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a><br><br>
        <a class="add" href="../component/add.php"><i class="fa-solid fa-plus"></i>Add</a>
        <table class="blueTable">
            <thead>
                <tr>
                    <th>ID Akun</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_akun'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['level'] . "</td>";
                    echo "<td>";
                    echo "<a class='delete' href='javascript:void(0);' onclick='confirmDelete(" . $row['id_akun'] . ")'><i class='fas fa-trash'></i>Delete</a>";
                    echo "<a class='edit' href='../../component/edit.php?id_akun=" . $row['id_akun'] . "'><i class='fas fa-edit'></i>Edit</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://kit.fontawesome.com/d7c9159410.js" crossorigin="anonymous"></script>

    <script>
        function confirmDelete(id_akun) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = "../component/delete.php?id_akun=" + id_akun;
            }
        }
    </script>
</body>

</html>