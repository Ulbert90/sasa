<?php
include '../config.php';

// Check if the 'bukuID' key exists in the $_GET array
if(isset($_GET["fotoID"])) {
    $id = $_GET["fotoID"];

    // jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM foto WHERE fotoID='$id' ";
    $hasil_query = mysqli_query($conn, $query);

    // periksa query, apakah ada kesalahan
    if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($conn).
            " - ".mysqli_error($conn));
    } else {
        // Handle success case, if needed
        header("location: galeri.php");
    }
} else {
    // Handle the case where 'fotoID' key is not set
    echo "Parameter 'fotoID' is missing.";
}
?>