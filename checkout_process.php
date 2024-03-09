<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel");

// Ambil nomor kamar dari formulir
$nomor_kamar = $_GET['nomor_kamar'];

// Cari informasi pemesanan yang sesuai dari database
$query_pemesanan = "SELECT * FROM kamar WHERE nomor_kamar = '$nomor_kamar'";
$result_pemesanan = mysqli_query($conn, $query_pemesanan);

if(mysqli_num_rows($result_pemesanan) > 0) {
    // Ubah status kamar menjadi "Tersedia" di database
    $query_update_kamar = "UPDATE kamar SET status = 'Tersedia' WHERE nomor_kamar = '$nomor_kamar'";
    $result_update_kamar = mysqli_query($conn, $query_update_kamar);

    if ($result_update_kamar) {
        echo "Check-out berhasil! Kamar telah tersedia kembali.";
    } else {
        echo "Check-out gagal! Silakan coba lagi.";
    }
} else {
    echo "Pemesanan tidak ditemukan untuk nomor kamar ini.";
}

// Menutup koneksi database
mysqli_close($conn);
?>
