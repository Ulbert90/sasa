<?php
include_once '../../config.php';

// Number of photos per page
$photosPerPage = 6;

// Get the current page number from the URL, default to page 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the OFFSET for the SQL query
$offset = ($page - 1) * $photosPerPage;

$query = "SELECT foto.*, COUNT(likefoto.likeID) as likes 
          FROM foto 
          LEFT JOIN likefoto ON foto.fotoID = likefoto.fotoID 
          GROUP BY foto.fotoID 
          LIMIT $offset, $photosPerPage";

$result = mysqli_query($koneksi, $query);

// Check if the query was successful
if (!$result) {
    die("Error retrieving data from the database: " . mysqli_error($koneksi));
}

// Query to get the total number of photos
$totalPhotosQuery = "SELECT COUNT(*) as total FROM foto";
$totalResult = mysqli_query($koneksi, $totalPhotosQuery);
$totalPhotos = mysqli_fetch_assoc($totalResult)['total'];

// Calculate total pages
$totalPages = ceil($totalPhotos / $photosPerPage);
?>
<?php
function getAlbumName($koneksi, $albumID)
{
    $query = "SELECT namaAlbum FROM album WHERE albumID = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $albumID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $namaAlbum);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    return htmlspecialchars($namaAlbum);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8ef9aa6db8.js" crossorigin="anonymous"></script>
    <style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card img {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        max-height: 200px;
        object-fit: cover;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
    }

    .card-text {
        color: #333;
    }

    .text-muted {
        color: #6c757d;
    }

    .container {
        max-width: 900px;
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid" style="font-family: cursive;">
            <a href="../../dashboard.php" class="btn btn-info"><i class="fas fa-arrow-left"></i></a>
            <a class="navbar-brand ml-3" href="#"> Photo Gallery</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeri.php">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../album/album.php">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container-fluid pl-3 pr-3">
        <br>
        <!-- Card Deck -->
        <u>
            <h2 class="text-center pt-4 pb-2">Gallery Foto</h2>
        </u>
        <div class="card-deck row row-cols-1 row-cols-md-4 g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo $row['lokasiFile']; ?>" class="card-img-top"
                        alt="<?php echo $row['judulFoto']; ?>">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['judulFoto']); ?></h5>
                        <p class="card-text"><?php echo limitWords(htmlspecialchars($row['deskripsi']), 10); ?></p>
                        <hr>
                        <p class="text-secondary">
                            Album: <?php echo getAlbumName($koneksi, $row['albumID']); ?>
                        </p>
                        <div class="d-flex justify-content-between">
                            <form method="post" action="like.php">
                                <input type="hidden" name="fotoID" value="<?php echo $row['fotoID']; ?>">
                                <button type="submit" class="btn btn-danger" name="like">
                                    <i class="fas fa-heart"></i> Like
                                </button>
                            </form>
                            <p class="card-text">
                                <small class="text-muted">Upload Date:
                                    <?php echo date('d-M-Y', strtotime($row['tanggalUnggah'])); ?>
                                </small>
                            </p>
                        </div>
                        <span><?php echo $row['likes']; ?> Likes</span>
                        <div class="mt-auto d-grid">
                            <a href="../komentar/komentarTambah.php" class="btn btn-light">Komentar</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>

    <?php
    // Fungsi untuk membatasi jumlah kata dalam deskripsi
    function limitWords($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }
    ?>
    <?php
    // Fungsi untuk membatasi jumlah kata dalam deskripsi dan mengganti 10 kata terakhir dengan "..."
    function shortenDescription($string, $word_limit) {
        $words = explode(" ", $string);
        if (count($words) > $word_limit) {
            $words = array_slice($words, 0, $word_limit - 10); // Ambil 10 kata terakhir
            $words[] = "...";
        }
        return implode(" ", $words);
    }
    ?>


    <!-- Pagination -->
    <div class="mt-5">


        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php } ?>
                <li class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTuj
</body>

</html>