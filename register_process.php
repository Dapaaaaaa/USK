<?php

    // Mulai session
    session_start();

    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "hotel");

    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'resepsionis';

    $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
    $result = mysqli_query($conn, $query);

    if($result) {
        echo "Berhasil Registrasi! Silahkan Login Kembali!";

        header("refresh:3; Location: login.php");
    } else {
        echo "Registrasi gagal";
    }

    // tutup koneksi
    mysqli_close($conn);
?>