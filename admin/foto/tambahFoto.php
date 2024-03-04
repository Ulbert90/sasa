<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div id="content">
        <!-- main konten-->
        <h1 class="text-center fs-5">Tambah Data album</h1>
        <hr class="mt-2">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="prosesTambah.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul album</label>
                            <input type="text" class="form-control" id="judul" name="judulFoto" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="tanggalUnggah" class="form-label">Tanggal Unggah</label>
                            <!-- Set default value to today's date using PHP -->
                            <input type="date" class="form-control" id="tanggalUnggah" name="tanggalUnggah"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="lokasiFile" class="form-label">Cover album</label>
                            <input type="file" class="form-control" id="lokasiFile" name="lokasiFile"
                                onchange="previewImage(this)">
                            <img id="preview" src="#" alt="Preview"
                                style="max-width: 100%; max-height: 100px; margin-top: 10px; display: none; border: solid #000;">
                        </div>
                        <button type="submit" class="btn btn-outline-success">Input</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>