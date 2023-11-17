<?php
session_start();
include '../../koneksi.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the required fields are set.
    if (isset($_POST['tahun'], $_POST['nominal'])) {
        $tahun = $_POST['tahun'];
        $nominal = $_POST['nominal'];

        // Update the student data in the database.
        $query = "UPDATE data_spp SET tahun = '$tahun' WHERE nominal = '$nominal'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect to the student list page or any other page you want.
            header('location: ../crud/c-spp.php');
            exit();
        } else {
            // Handle the case where the update query fails, you can display an error message.
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle the case where the required fields are not set.
        echo "All fields are required.";
    }
} else {
    // Handle the case where the form is not submitted via POST.
    header('location: error_page.php');
    exit();
}
?>
