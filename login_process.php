<?php
// Mulai session
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel");

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari user dengan username dan password yang sesuai
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

// Periksa apakah hasil query menghasilkan baris data atau tidak
if (mysqli_num_rows($result) == 1) {
    //ambil role user dari query 
    $row = mysqli_fetch_assoc($result);
    $role = $row['role'];

    //simpan informasi user di dalam sesi
    $_SESSION['id_user'] = $username;
    $_SESSION['role'] = $role;
    
    //pengecekan role
    if($role == 'admin') {
        header("Location: kamar.php");
    } else if ($role == 'resepsionis') {
        header("Location: pemesanan.php");
    }
    exit;
} else {
    // Jika user tidak ditemukan, beri pesan kesalahan
    echo "Username or password is incorrect. Please try again.";
}

// Menutup koneksi database
mysqli_close($conn);
?>