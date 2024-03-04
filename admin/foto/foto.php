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

.table-hover tbody tr:hover {
    background-color: #e0e0e0;
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
            <div class="d-flex gap-2 mb-3">
                <a href="tambahFoto.php" class="btn btn-warning text-white" role="button">+<i class="fas fa-camera"></i>
                    Foto</a>
                <a href="album/album.php" class="btn btn-primary" role="button">+<i class="fas fa-image"></i>
                    Album</a>
                <a href="../../index.php" class="btn btn-success" role="button"><i class="fas fa-home"></i> Home</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered border border-dark">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Foto</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" width="10%">Tanggal Unggah</th>
                            <th scope="col" width="10%">Foto</th>
                            <th scope="col" width="20%">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    $no = 1;
    $queryFoto = mysqli_query($koneksi, "SELECT * FROM foto");
    $jumlahFoto = mysqli_num_rows($queryFoto);

    if ($jumlahFoto > 0) {
        while ($d = mysqli_fetch_assoc($queryFoto)) {
            $tanggal = date('d', strtotime($d['tanggalUnggah']));
            $bulan = date('m', strtotime($d['tanggalUnggah']));
            $tahun = date('Y', strtotime($d['tanggalUnggah']));
    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['judulFoto']; ?></td>
                            <td><?php echo $d['deskripsi']; ?></td>
                            <td><?php echo $tanggal . '-' . $bulan . '-' . $tahun; ?></td>
                            <td>
                                <img src="<?php echo $d['lokasiFile']; ?>" class="card-img-top"
                                    alt="<?php echo $d['judulFoto']; ?>">
                            </td>
                            <td>
                                <a href="editFoto.php?fotoID=<?php echo $d['fotoID']; ?>"
                                    class="btn btn-warning text-white">
                                    <i class="fas fa-pen-to-square"></i> Edit
                                </a>
                                <a class="btn btn-danger" href='hapusFoto.php?fotoID=<?php echo $d['fotoID']; ?>'>
                                    <i class="fas fa-trash-can"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php
        }
    } else {
    ?>
                        <tr>
                            <td colspan="6">I am wanna have a relationship too 😓...</td>
                        </tr>
                        <?php
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