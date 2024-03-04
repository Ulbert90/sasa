<?php
include '../../config.php';

// Mendapatkan ID komentar yang dipilih
if (isset($_GET['komentarID'])) {
    $selectedKomentarID = $_GET['komentarID'];

    // Query untuk mendapatkan informasi komentar terpilih
    $query = "SELECT * FROM komentarfoto WHERE komentarID = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $selectedKomentarID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $komentar = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // Memproses formulir ketika disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Memastikan bahwa semua data yang dibutuhkan telah disertakan dalam formulir
        if (isset($_POST['isiKomentar'], $_POST['tanggalKomentar'])) {
            // Dapatkan data lainnya dari formulir
            $isiKomentar = $_POST['isiKomentar'];
            $tanggalKomentar = $_POST['tanggalKomentar'];

            // Update data komentar di tabel komentarfoto
            $stmt = mysqli_prepare($koneksi, "UPDATE komentarfoto SET isiKomentar = ?, tanggalKomentar = ? WHERE komentarID = ?");
            mysqli_stmt_bind_param($stmt, "ssi", $isiKomentar, $tanggalKomentar, $selectedKomentarID);

            if (mysqli_stmt_execute($stmt)) {
                // Komentar berhasil diupdate, mungkin Anda ingin melakukan redirect atau memberikan pesan sukses
                header("location: komentar.php");
                exit();
            } else {
                // Terdapat kesalahan saat mengeksekusi pernyataan SQL
                echo "Sorry, there was an error updating data in the database: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            // Data yang diperlukan tidak lengkap
            echo "Invalid request. Please provide all required data.";
        }
    }
} else {
    // Jika tidak ada ID komentar yang dipilih, redirect atau tampilkan pesan kesalahan
    header("location: komentar.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Komentar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2>Edit Komentar</h2>
                <form action="komentaredit.php?komentarID=<?php echo $selectedKomentarID; ?>" method="post">
                    <div class="mb-3">
                        <label for="isiKomentar" class="form-label">Isi Komentar:</label>
                        <textarea class="form-control" name="isiKomentar" id="isiKomentar" cols="30" rows="5"
                            required><?php echo $komentar['isiKomentar']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalKomentar" class="form-label">Tanggal Komentar:</label>
                        <input type="date" class="form-control" name="tanggalKomentar" id="tanggalKomentar"
                            value="<?php echo $komentar['tanggalKomentar']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a class="btn btn-secondary" href="komentar.php">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>