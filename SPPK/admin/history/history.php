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

// Fungsi cetak PDF
if (isset($_GET['create_pdf'])) {
    require('../../tcpdf/tcpdf.php'); // Sesuaikan dengan lokasi TCPDF Anda

    $pdf = new TCPDF();
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->AddPage();

    $content = '<h1>Data Pembayaran</h1>';
    $content = '<table border="1">
                    <tr>
                        <th>id_pembayaran</th>
                        <th>id_akun</th>
                        <th>nisn</th>
                        <th>tgl_bayar</th>
                        <th>bulan_dibayar</th>
                        <th>tahun_dibayar</th>
                        <th>id_spp</th>
                        <th>Jumlah_bayar</th>
                        <th>akun_siswa</th>
                    </tr>';

    $sql = "SELECT * FROM data_pembayaran";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content .= '<tr>';
            $content .= '<td>' . $row['id_pembayaran'] . '</td>';
            $content .= '<td>' . $row['id_akun'] . '</td>';
            $content .= '<td>' . $row['nisn'] . '</td>';
            $content .= '<td>' . $row['tgl_bayar'] . '</td>';
            $content .= '<td>' . $row['bulan_dibayar'] . '</td>';
            $content .= '<td>' . $row['tahun_dibayar'] . '</td>';
            $content .= '<td>' . $row['id_spp'] . '</td>';
            $content .= '<td>' . $row['jumlah_bayar'] . '</td>';
            $content .= '<td>' . $row['id_akun_siswa'] . '</td>';
            $content .= '</tr>';
        }
    } else {
        $content .= '<tr><td colspan="9">Tidak ada data pembayaran</td></tr>';
    }

    $content .= '</table>';

    $pdf->writeHTML($content);
    $pdf->Output('data_pembayaran.pdf', 'D'); // 'D' untuk unduh
    mysqli_close($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>

    </style>
</head>

<body>
    <a class="add" href="../index.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a><br><br>
    <a class="add" id="create_pdf" href=""><i class="fa-solid fa-print"></i> Print PDF</a>
    <?php
    require('../../koneksi.php'); // Menghubungkan dengan file koneksi.php
    $sql = "SELECT * FROM data_pembayaran";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        echo "<table class='blueTable'>";
        echo "<tr>";
        echo "<th>id_pembayaran</th>";
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
            echo "<td>" . $row['id_pembayaran'] . "</td>";
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
        echo "<th>id_pembayaran</th>";
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