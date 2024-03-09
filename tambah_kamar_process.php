<?php
// Mulai session
session_start();

// Periksa apakah pengguna memiliki sesi yang valid sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: kamar.php");
    exit;
}

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel");

// Ambil data dari formulir tambah kamar
$nomor_kamar = $_POST['nomor_kamar'];
$lantai_kamar = $_POST['lantai_kamar'];
$tipe_kamar = $_POST['tipe_kamar'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// Query untuk menambahkan kamar ke database
$query = "INSERT INTO kamar (nomor_kamar, lantai_kamar, tipe_kamar, harga, deskripsi) VALUES ('$nomor_kamar', '$lantai_kamar', '$tipe_kamar', '$harga', '$deskripsi')";

// Eksekusi query
if (mysqli_query($conn, $query)) {
    echo "Kamar berhasil ditambahkan.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Menutup koneksi database
mysqli_close($conn);
?>
