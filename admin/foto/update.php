<?php
include_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fotoID = isset($_POST['fotoID']) ? $_POST['fotoID'] : '';
    $judulFoto = isset($_POST['judulFoto']) ? $_POST['judulFoto'] : '';
    $deskripsi = isset($_POST['deskripsiFoto']) ? $_POST['deskripsiFoto'] : '';
    $tanggalUnggah = isset($_POST['tanggalUnggah']) ? $_POST['tanggalUnggah'] : '';

    // Note: In a real application, you should validate and sanitize user input.

    // Update the photo details in the database
    $query = "UPDATE foto SET judulFoto='$judulFoto', deskripsi='$deskripsi', tanggalUnggah='$tanggalUnggah' WHERE fotoID=$fotoID";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Foto details updated successfully.";
        header("location: galeri.php"); // Assuming it's dashboard.php
        exit();
    } else {
        echo "Error updating foto details: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
