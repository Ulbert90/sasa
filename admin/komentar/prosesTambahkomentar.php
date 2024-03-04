<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memastikan bahwa semua data yang dibutuhkan telah disertakan dalam formulir
    if (isset($_POST['fotoID'], $_POST['isiKomentar'], $_POST['tanggalKomentar'])) {
        // Mendapatkan user ID dari sesi (sesuaikan dengan implementasi Anda)
        $userID = $_SESSION['userID']; // Sesuaikan dengan nama variabel sesi Anda

        // Dapatkan data lainnya dari formulir
        $fotoID = $_POST['fotoID'];
        $isiKomentar = $_POST['isiKomentar'];
        $tanggalKomentar = $_POST['tanggalKomentar'];

        // Memasukkan data komentar ke dalam tabel komentarfoto
        $stmt = mysqli_prepare($koneksi, "INSERT INTO komentarfoto (fotoID, userID, isiKomentar, tanggalKomentar) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iiss", $fotoID, $userID, $isiKomentar, $tanggalKomentar);

        if (mysqli_stmt_execute($stmt)) {
            // Komentar berhasil ditambahkan, mungkin Anda ingin melakukan redirect atau memberikan pesan sukses
            header("location: komentar.php");
            exit();
        } else {
            // Terdapat kesalahan saat mengeksekusi pernyataan SQL
            echo "Sorry, there was an error inserting data into the database: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Data yang diperlukan tidak lengkap
        echo "Invalid request. Please provide all required data.";
    }
} else {
    // Metode request tidak valid
    echo "Invalid request method.";
}
?>