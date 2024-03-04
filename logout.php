<?php
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Hancurkan sesi
session_destroy();

// Pesan logout berhasil
$message = "Logout sukses.";
header("Location: index.php?message=" . urlencode($message));
exit();
?>
