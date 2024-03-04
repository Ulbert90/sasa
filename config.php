<?php
$host = 'localhost';
$user = 'roxy';
$password = '';
$db = 'galleryDK';

// Create a connection to the database
$koneksi = new mysqli($host, $user, $password, $db);

// Check the connection
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Now, you can use $koneksi for database operations

?>