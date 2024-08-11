<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'prodi') {
    header('Location: login.php');
    exit();
}

// Ambil id_jjudul dari query string
$id_judul = $_GET['id'] ?? null;
if (!$id_judul) {
    echo "ID tidak ditemukan.";
    exit();
}

// Proses penghapusan data
$deleteQuery = "DELETE FROM judul WHERE id_judul = '$id_judul'";
if (mysqli_query($koneksi, $deleteQuery)) {
    header('Location: petugas.php');
    exit();
} else {
    echo "Gagal menghapus data.";
}
?>
