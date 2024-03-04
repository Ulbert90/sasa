<?php
include '../../config.php';
include '../../nav/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Data Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div id="content">
        <!-- Main Content Section -->

        <div class="container mt-5">
            <a href="../foto/galeri.php" class="btn btn-info my-4">
                <-- </a>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered border border-dark">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">user</th>
                                    <th scope="col">komentar</th>
                                    <th scope="col">tanggl komentar</th>
                                    <th scope="col" width="20%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
    $no = 1;
    $queryFoto = mysqli_query($koneksi, "SELECT * FROM komentarfoto");
    $jumlahFoto = mysqli_num_rows($queryFoto);

    if ($jumlahFoto > 0) {
        while ($d = mysqli_fetch_assoc($queryFoto)) {
    ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['fotoID']; ?></td>
                                    <td><?php echo $d['userID']; ?></td>
                                    <td><?php echo $d['isiKomentar']; ?></td>
                                    <td><?php echo $d['tanggalKomentar']; ?></td>
                                    <td>
                                        <a href="komentaredit.php?komentarID=<?php echo $d['komentarID']; ?>"
                                            class="btn btn-warning text-white">
                                            <i class="fas fa-pen-to-square"></i> Edit
                                        </a>
                                        <a class="btn btn-danger"
                                            href='komentarhapus.php?komentarID=<?php echo $d['komentarID']; ?>'>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>