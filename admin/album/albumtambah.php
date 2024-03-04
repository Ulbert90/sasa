<?php
include_once('../../config.php');

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Initialize userID with 0 (or any default integer value)
$userID = 0;

// Check if the user is logged in and userID is set as an integer
if (isset($_SESSION['users']['userID']) && is_numeric($_SESSION['users']['userID'])) {
    $userID = (int)$_SESSION['users']['userID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $namaAlbum = mysqli_real_escape_string($koneksi, $_POST['namaAlbum']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $tanggalDibuat = mysqli_real_escape_string($koneksi, $_POST['tanggalDibuat']);

    $insertQuery = "INSERT INTO album (namaAlbum, deskripsi, tanggalDibuat, userID) VALUES ('$namaAlbum', '$deskripsi', '$tanggalDibuat', '$userID')";

    if ($koneksi->query($insertQuery) === TRUE) {
        echo "Data album berhasil ditambahkan.";
        header("location: album.php");
    } else {
        echo "Error: " . $insertQuery . "<br>" . $koneksi->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Tambah Album</h3>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namaAlbum" class="form-label">Nama Album</label>
                        <input type="text" class="form-control" id="namaAlbum" name="namaAlbum" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalDibuat" class="form-label">Tanggal Dibuat</label>
                        <?php
                            $todayDate = date("Y-m-d");
                            ?>
                        <input type="date" class="form-control" id="tanggalDibuat" name="tanggalDibuat"
                            value="<?= $todayDate ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Album</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>