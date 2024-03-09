<!DOCTYPE html>
<head>
    <title>Halaman Register</title>
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
        <h2>Halaman Register</h2>
            <form action="register_process.php" method="post">
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" required><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required><br>

                <input type="submit" value="Register">
            </form>
        </div>
</body>
</html>