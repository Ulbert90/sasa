<?php
include '../../config.php';

// Check if the 'bukuID' key exists in the $_GET array
if(isset($_GET["komentarID"])) {
    $id = $_GET["komentarID"];

    // jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM komentarfoto WHERE komentarID='$id' ";
    $hasil_query = mysqli_query($koneksi, $query);

    // periksa query, apakah ada kesalahan
    if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
    } else {
        // Handle success case, if needed
        header("location: komentar.php");
    }
} else {
    // Handle the case where 'komentarID' key is not set
    echo "Parameter 'komentarID' is missing.";
}
?>