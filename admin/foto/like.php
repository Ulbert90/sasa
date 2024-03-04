    <?php
    include_once '../../config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])) {
        $fotoID = $_POST['fotoID'];
        $userID = 1; // You can replace this with the actual user ID (assuming you have a user authentication system).

        // Check if the user has already liked the photo
        $checkQuery = "SELECT * FROM likefoto WHERE fotoID = $fotoID AND userID = $userID";
        $checkResult = mysqli_query($koneksi, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            // If the user hasn't liked the photo, insert a new like record
            $insertQuery = "INSERT INTO likefoto (fotoID, userID, tanggalLike) VALUES ($fotoID, $userID, CURRENT_DATE())";
            $insertResult = mysqli_query($koneksi, $insertQuery);

            if (!$insertResult) {
                die("Error inserting like data: " . mysqli_error($koneksi));
            }
        }

        // Update the likes count for the photo
        $updateQuery = "UPDATE foto SET likes = likes + 1 WHERE fotoID = $fotoID";
        $updateResult = mysqli_query($koneksi, $updateQuery);

        if (!$updateResult) {
            die("Error updating likes count: " . mysqli_error($koneksi));
        }

        // Redirect back to the gallery page
        header("Location: galeri.php");
        exit();
    }
    ?>