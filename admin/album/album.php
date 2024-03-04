<?php
include_once '../../config.php';
include_once '../../nav/navbar.php';
?>
<style>
body {
    background-color: #f2f2f2;
}

#content {
    justify-content: center;
}

.btn-primary,
.btn-secondary,
.btn-warning,
.btn-danger {
    border-radius: 5px;
}

.btn-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
}

.table th,
.table td {
    text-align: center;
    vertical-align: middle;
}

.table-responsive {
    overflow-x: auto;
}

.table thead th {
    background-color: #007bff;
    color: #fff;
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Galeri Foto</title>
    <script src="https://kit.fontawesome.com/13c062a83b.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div id="content">
        <!-- Main Content Section -->
        <div class="container mt-5">
            <div class="d-flex justify-content-between mb-3">
                <a href="albumtambah.php" class="btn btn-primary" role="button"><i class="fas fa-plus"></i> Buat Album
                    Baru</a>
                <a href="../../galeri.php?php echo $d['albumID']; ?>" class="btn btn-info text-white">
                    <i class="fas fa-clone"></i> Lihat
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered border border-dark">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pembuat Album</th>
                            <th scope="col">Judul Album</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" width="10%">Tanggal Dibuat</th>
                            <th scope="col" width="30%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
$queryFoto = mysqli_query($koneksi, "SELECT album.*, users.username
                                    FROM album
                                    INNER JOIN users ON album.userID = users.userID");
                    $jumlahFoto = mysqli_num_rows($queryFoto);

                    if ($jumlahFoto == 0) {
                        ?>
                        <tr>
                            <td colspan="7">i am wanna have a relationship too😓...</td>
                        </tr>
                        <?php
                    } else {
                        while ($d = mysqli_fetch_assoc($queryFoto)) {
                            // Ambil tanggal, bulan, dan tahun dari kolom tanggalUnggah
                            $tanggal = date('d', strtotime($d['tanggalDibuat']));
                            $bulan = date('m', strtotime($d['tanggalDibuat']));
                            $tahun = date('Y', strtotime($d['tanggalDibuat']));
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['username']; ?></td> <!-- Menampilkan username pembuat album -->
                            <td><?php echo $d['namaAlbum']; ?></td>
                            <td><?php echo $d['deskripsi']; ?></td>
                            <td><?php echo $tanggal . '-' . $bulan . '-' . $tahun; ?></td>
                            <td>
                                <a href="albumedit.php?albumID=<?php echo $d['albumID']; ?>"
                                    class="btn btn-warning text-white">
                                    <i class="fas fa-pen-to-square"></i> Ubah
                                </a>

                                <a class="btn btn-danger" href='hapusFoto.php?albumID=<?php echo $d['albumID']; ?>'>
                                    <i class="fas fa-trash-can"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>