<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    body {
        background: url("admin/img/bg.jpg");
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f0f0;
    }

    .text-decoration-none {
        cursor: pointer;
        text-decoration: none;
        color: #333;
        border: 1px solid #ddd;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .text-decoration-nonew:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .text-decoration-none:hover h2 {
        color: #ff66b2;
    }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body class="bg-light">
        <div class="container mt-5">
            <div class="bg-dark text-white text-center p-4">
                <h1>WELCOME TO GALLERY FOTO WEBSITE!</h1>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <a href="admin/foto/galeri.php" class="card text-decoration-none">
                        <div class="card-body">
                            <h2 class="card-title">Gallery</h2>
                            <p class="card-text">Menu Utama</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4">
                    <a href="admin/album/album.php" class="card text-decoration-none">
                        <div class="card-body">
                            <h2 class="card-title">ALBUM</h2>
                            <p class="card-text">Buat Album mu.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-4">
                    <a href="admin/foto/foto.php" class="card text-decoration-none">
                        <div class="card-body">
                            <h2 class="card-title">FOTO</h2>
                            <p class="card-text">Tambahkan Foto mu.</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-12 text-center">
                    <a href="../logout.php" class="card text-decoration-none">
                        <div class="card-body">
                            <h2 class="card-title">LOG OUT</h2>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

</body>

</html>