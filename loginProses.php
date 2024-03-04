<?php
session_start();
require_once 'config.php';

// Simpan data username dan password yang diterima dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash password menggunakan MD5 (Gantilah dengan algoritma hash yang lebih aman jika memungkinkan)
$hashedPassword = md5($password);

// Query untuk mencari pengguna berdasarkan username dan password
$query = "SELECT * FROM users WHERE username='$username' AND password='$hashedPassword'";
$result = $koneksi->query($query);

if ($result->num_rows == 1) {
    // Jika data ditemukan, set session 'user' ke nilai username
    $row = $result->fetch_assoc();
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['user'] = $row['username'];

    // Redirect ke halaman utama atau halaman selanjutnya
    header('Location: dashboard.php');
    exit;
} else {
    // Jika tidak sesuai, kembalikan ke halaman login dengan pesan error
    header('Location: index.php?error=1');
    exit;
}

?>