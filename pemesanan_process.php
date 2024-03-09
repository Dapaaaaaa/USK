<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel");

// Ambil data dari form
$nama = $_POST['nama'];
$NIK = $_POST['NIK'];
$nomor_kamar = $_POST['nomor_kamar'];
$tanggal_checkin = $_POST['tanggal_checkin'];
$tanggal_checkout = $_POST['tanggal_checkout'];


// Cetak nilai yang dikirim dari form
echo "Nama: " . $_POST['nama'] . "<br>";
echo "NIK: " . $_POST['NIK'] . "<br>";
echo "Nomor Kamar: " . $_POST['nomor_kamar'] . "<br>";
echo "Tanggal Check-in: " . $_POST['tanggal_checkin'] . "<br>";
echo "Tanggal Check-out: " . $_POST['tanggal_checkout'] . "<br>";

// Query untuk mengambil ID kamar berdasarkan nomor kamar yang dipilih
$query_id_kamar = "SELECT id FROM kamar WHERE id = '$nomor_kamar'";
$result_id_kamar = mysqli_query($conn, $query_id_kamar);

if(mysqli_num_rows($result_id_kamar) > 0) {
    $row_id_kamar = mysqli_fetch_assoc($result_id_kamar);
    $id_kamar = $row_id_kamar['id'];

    // Query untuk menyimpan data pemesanan ke database
    $query_pemesanan = "INSERT INTO pemesanan (nama, NIK, id_kamar, tanggal_checkin, tanggal_checkout) 
                        VALUES ('$nama', '$NIK', '$id_kamar', '$tanggal_checkin', '$tanggal_checkout')";
    $result_pemesanan = mysqli_query($conn, $query_pemesanan);

    // Cek apakah query pemesanan berhasil
    if ($result_pemesanan) {
        // Update status kamar menjadi tidak tersedia
        $query_update_kamar = "UPDATE kamar SET status = 'Tidak Tersedia' WHERE id = '$id_kamar'";
        $result_update_kamar = mysqli_query($conn, $query_update_kamar);

        if ($result_update_kamar) {
            echo "Pemesanan berhasil! Status kamar telah diperbarui.";
        } else {
            echo "Pemesanan berhasil tetapi status kamar gagal diperbarui.";
        }
    } else {
        echo "Pemesanan gagal!";
    }
} else {
    echo "Kamar tidak ditemukan.";
}

// Menutup koneksi database
mysqli_close($conn);
?>
