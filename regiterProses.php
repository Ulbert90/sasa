<?php
// Include your database connection script (replace with your actual connection code)
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $namaLengkap = $_POST['namaLengkap'];
    $alamat = $_POST['alamat'];

    // Perform basic validation (you may add more robust validation)
    if (empty($username) || empty($password) || empty($email) || empty($namaLengkap) || empty($alamat)) {
        // Handle empty fields
        echo "All fields are required. Please fill in all the fields.";
    } else {
        // Hash the password using MD5 (not recommended for security reasons)
        $hashedPassword = md5($password);

        // Prepare and execute the SQL query to insert user data
        $sql = "INSERT INTO users (username, password, email, namaLengkap, alamat) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param('sssss', $username, $hashedPassword, $email, $namaLengkap, $alamat);

        if ($stmt->execute()) {
            // Registration successful
            echo "Registration successful. You can now login.";
            header("location: login.php");  
        } else {
            // Handle database error
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
} else {
    // Redirect to the registration form if accessed directly without submitting the form
    header("Location: register.php");
    exit();
}

// Close the database connection (replace with your actual closing code)
$koneksi->close();
?>