<?php
session_start();
include '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memastikan bahwa form telah di-submit dengan benar

    // Melakukan sanitasi pada data yang diterima dari form
    $id_akun = $_POST['id_akun'] ?? '';
    $nisn = $_POST['nisn'] ?? '';
    $tgl_bayar = $_POST['tgl_bayar'] ?? '';
    $bulan_dibayar = $_POST['bulan_dibayar'] ?? '';
    $tahun_dibayar = $_POST['tahun_dibayar'] ?? '';
    $id_spp = $_POST['id_spp'] ?? '';
    $jumlah_bayar = $_POST['jumlah_bayar'] ?? '';
    $id_akun_siswa = $_POST['id_akun_siswa'] ?? '';

    // Lakukan validasi data di sini sesuai kebutuhan Anda (contoh: cek keberadaan data di database, format tanggal, jumlah bayar, dll)

    // Menonaktifkan pengecekan kunci asing sementara
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0");

    // Jika data valid, lakukan proses penyimpanan ke database
    $sql = "INSERT INTO data_pembayaran (id_akun, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar, id_akun_siswa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iissiiii", $id_akun, $nisn, $tgl_bayar, $bulan_dibayar, $tahun_dibayar, $id_spp, $jumlah_bayar, $id_akun_siswa);

    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil disimpan, redirect ke halaman sukses atau ke halaman lain sesuai kebutuhan
        header("location: ../history/history.php");
        exit();
    } else {
        // Jika gagal disimpan, berikan pesan kesalahan atau tindakan yang sesuai
        echo "Terjadi kesalahan dalam memproses pembayaran. Silakan coba lagi.";
    }

    mysqli_stmt_close($stmt);

    // Mengaktifkan kembali pengecekan kunci asing setelah operasi selesai
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1");

    mysqli_close($conn);
} else {
    // Jika ada upaya akses langsung ke file ini tanpa melalui form, redirect ke halaman lain atau tindakan yang sesuai
    header("location: halaman_error.php");
    exit();
}
?>