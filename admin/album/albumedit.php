<?php
// Include your database connection file
$host = "localhost";
$user = "roxy";
$pass = "";
$db = "gallery";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $row variable to an empty array
$row = array();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fotoID = isset($_POST['fotoID']) ? $_POST['fotoID'] : '';
    $judulFoto = isset($_POST['judulFoto']) ? $_POST['judulFoto'] : '';
    $deskripsi = isset($_POST['deskripsiFoto']) ? $_POST['deskripsiFoto'] : '';
    $tanggalUnggah = isset($_POST['tanggalUnggah']) ? $_POST['tanggalUnggah'] : '';

    // Note: In a real application, you should validate and sanitize user input.

    // Update the foto details in the database
   // Update the foto details in the database
$query = "UPDATE foto SET judulFoto='$judulFoto', deskripsi='$deskripsi', tanggalUnggah='$tanggalUnggah' WHERE fotoID='$fotoID'";

$result = $conn->query($query);

if ($result) {
    echo "Foto details updated successfully.";
    header("location: album.php");
    exit();
} else {
    echo "Error updating foto details: " . $conn->error;
}
}

// Retrieve foto details based on fotoID
$fotoID = isset($_GET['fotoID']) ? $_GET['fotoID'] : ''; // Assuming you pass fotoID as a parameter in the URL

if (!empty($fotoID)) {
    $query = "SELECT * FROM foto WHERE fotoID = $fotoID";
    $result = $conn->query($query);

    // Check if the query was successful and data is available
    if ($result && $result->num_rows > 0) {
        // Fetch the data into $row
        $row = $result->fetch_assoc();
    } else {
        echo "Error retrieving foto details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    body {
        background-color: #f8f9fa;
    }

    #content {
        margin-top: 30px;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-update {
        background-color: #007bff;
        color: #fff;
    }
    </style>
</head>

<body>
    <div id="content" class="container">
        <div class="card mx-auto mt-5" style="max-width: 500px;">
            <div class="card-body">
                <h1 class="text-center mb-4">Edit Foto Details</h1>
                <form method="post" action="">
                    <input type="hidden" name="fotoID"
                        value="<?php echo isset($row['fotoID']) ? $row['fotoID'] : ''; ?>">

                    <div class="mb-3">
                        <label for="judulFoto" class="form-label">Judul:</label>
                        <input type="text" name="judulFoto"
                            value="<?php echo isset($row['judulFoto']) ? $row['judulFoto'] : ''; ?>"
                            class="form-control" required>
                    </div>
                    <br>

                    <div class="mb-3">
                        <label for="deskripsiFoto" class="form-label">Deskripsi:</label>
                        <textarea name="deskripsiFoto" class="form-control"
                            required><?php echo isset($row['deskripsi']) ? $row['deskripsi'] : ''; ?></textarea>
                    </div>
                    </br>

                    <div class="mb-3">
                        <label for="tanggalUnggah" class="form-label">Tanggal Unggah:</label>
                        <input type="date" name="tanggalUnggah"
                            value="<?php echo isset($row['tanggalUnggah']) ? $row['tanggalUnggah'] : ''; ?>"
                            class="form-control">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-update">Update</button>
                        <a href="album.php" class="btn btn-success">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>