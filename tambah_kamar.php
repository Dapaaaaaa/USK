<?php

    session_start();
    if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
        header("Location: kamar.php");
        exit;
    }

?>


<!DOCTYPE html>
<head>
    <title>Halaman Tambah Kamar</title>
</head>
<style>
        body {
            text-align: center; /* Posisi konten halaman ke tengah */
        }

        .container {
            width: 300px; /* Lebar kotak */
            margin: 50px auto; /* Memposisikan kotak ke tengah secara vertical dan horizontal */
            padding: 20px; /* Ruang di dalam kotak */
            border: 1px solid #ccc; /* Garis pinggir kotak */
            border-radius: 5px; /* Sudut bulat kotak */
            display: inline-block; /* Menjadikan kotak sebagai elemen inline-block */
            text-align: left; /* Posisi teks ke kiri */
        }

        .container h2 {
            text-align: center; /* Posisi teks judul ke tengah */
        }

        .container input[type="text"],
        .container input[type="password"],
        .container input[type="submit"] {
            width: 100%; /* Lebar input sesuai dengan lebar kotak */
            margin-bottom: 10px; /* Jarak antara input */
        }
    </style>
<body>
    <div class="container">
        <h2>Halaman Tambah Kamar</h2>
            <form action="tambah_kamar_process.php" method="post">
                <label for="nomor_kamar">Nomor Kamar </label><br>
                <input type="text" name="nomor_kamar" id="nomor_kamar" required><br>
                <label for="lantai_kamar">Lantai Kamar</label><br>
                <input type="text" name="lantai_kamar" id="lantai_kamar" required><br>
                <label for="tipe_kamar">Tipe Kamar</label><br>
                <input type="text" name="tipe_kamar" id="tipe_kamar" required><br>
                <label for="harga">Harga</label><br>
                <input type="text" name="harga" id="harga" required><br>
                <label for="deskripsi">Deskripsi</label><br>
                <input type="text" name="deskripsi" id="deskripsi" required><br>

                <input type="submit" value="Register">
            </form>
        </div>
</body>
</html>