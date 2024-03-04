<?php
include '../../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['judulFoto'], $_POST['deskripsi'], $_POST['tanggalUnggah'], $_FILES['lokasiFile'])) {
        $userID = 1; // Gantilah dengan cara yang sesuai untuk mendapatkan userID (sesuaikan dengan logika aplikasi Anda)
        $judul = $_POST['judulFoto'];
        $deskripsi = $_POST['deskripsi'];
        $tanggalUnggah = $_POST['tanggalUnggah'];

        // Process file upload
        if (isset($_FILES["lokasiFile"])) {
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["lokasiFile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the directory exists, if not, create it
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Check if image file is an actual image
            $check = getimagesize($_FILES["lokasiFile"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, there was an error uploading your file.";
            } else {
                // If everything is ok, try to upload file
                if (move_uploaded_file($_FILES["lokasiFile"]["tmp_name"], $target_file)) {
                    // File uploaded successfully, now insert data into the database
                    $stmt = mysqli_prepare($koneksi, "INSERT INTO foto (userID, judulFoto, deskripsi, tanggalUnggah, lokasiFile) VALUES (?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "issss", $userID, $judul, $deskripsi, $tanggalUnggah, $target_file);

                    if (mysqli_stmt_execute($stmt)) {
                        header("location: foto.php");
                    } else {
                        echo "Sorry, there was an error inserting data into the database: " . mysqli_stmt_error($stmt);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "Invalid request method.";
    }
}
?>