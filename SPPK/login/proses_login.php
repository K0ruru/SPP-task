<?php
session_start();
require '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT id_akun, username, level FROM data_akun WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($id_akun, $username, $level);

    if ($stmt->fetch()) {
        $_SESSION['id_akun'] = $id_akun;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level; // Simpan peran pengguna dalam sesi
        $_SESSION['status'] = "login";

        if ($level == 'admin') {
            header("Location: ../admin/index.php");
        } elseif ($level == 'petugas') {
            header("Location: ../petugas");
        } elseif ($level == 'siswa') {
            header("Location: ../siswa/index.php");
        }
    } else {
        $_SESSION['login_error'] = "Login failed. Invalid username or password.";
        header("Location: login.php");
    }

    $stmt->close();
}

$conn->close();
