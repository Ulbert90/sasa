<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar Foto</title>
    <script src="https://kit.fontawesome.com/13c062a83b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-rAt1a3LyYaaDBVzSSgtFn5O9SZbnoWlMQFfe3F/3gGUpmH/p02F/j6m6/79IjzNS" crossorigin="anonymous">
</head>

<body>
    <?php
include_once '../../config.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>Pilih Foto</h2>
                <ul class="list-group" id="fotoList">
                    <?php
                // Ambil daftar foto dari database
                $result = mysqli_query($koneksi, "SELECT * FROM foto");

                while ($foto = mysqli_fetch_assoc($result)) {
                    echo '<li class="list-group-item selected" data-foto-id="' . $foto['fotoID'] . '">';
                    echo '<img src="' . $foto['lokasiFile'] . '" alt="' . $foto['judulFoto'] . '" class="img-thumbnail">';
                    echo '</li>';
                }
                ?>
                </ul>
            </div>
            <div class="col-md-8">
                <h2>Form Komentar</h2>
                <form action="prosesTambahkomentar.php" method="post">
                    <input type="hidden" id="selectedFotoId" name="fotoID" value="1">
                    <div class="mb-3">
                        <label for="isiKomentar" class="form-label">Isi Komentar:</label>
                        <textarea class="form-control" name="isiKomentar" id="isiKomentar" cols="30" rows="5"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalKomentar" class="form-label">Tanggal Komentar:</label>
                        <input type="date" class="form-control" name="tanggalKomentar" id="tanggalKomentar"
                            value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tambah Komentar</button>
                        <a class="btn btn-success" href="komentar.php">Lihat Komentar Lainnya</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Handle selected foto
    document.getElementById('fotoList').addEventListener('click', function(e) {
        if (e.target.tagName === 'IMG') {
            // Reset all selected items
            var fotoItems = document.querySelectorAll('.foto-list li');
            fotoItems.forEach(function(item) {
                item.classList.remove('selected');
            });

            // Set selected item
            var selectedFotoId = e.target.closest('li').getAttribute('data-foto-id');
            document.getElementById('selectedFotoId').value = selectedFotoId;
            e.target.closest('li').classList.add('selected');
        }
    });
    </script>

</body>

</html>