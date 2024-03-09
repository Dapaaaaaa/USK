<?php

    // Mulai session
    session_start();

    // Harus login untuk mengakses view ini
    if(!isset($_SESSION['id_user'])) {
        header("Location: login.php");
        exit;
    }

    // Handle pencarian jika ada data yang dikirimkan
    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        // Koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "hotel");

        // Mendapatkan rentang tanggal dari input
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        $query = "SELECT * FROM kamar WHERE nomor_kamar IN (
            SELECT nomor_kamar FROM pemesanan WHERE ('$start_date' BETWEEN tanggal_checkin AND tanggal_checkout)
            OR ('$end_date' BETWEEN tanggal_checkin AND tanggal_checkout)
            OR (tanggal_checkin BETWEEN '$start_date' AND '$end_date')
            OR (tanggal_checkout BETWEEN '$start_date' AND '$end_date'))";

        $result = mysqli_query($conn, $query);

        // Menutup koneksi database
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<head>
    <title>Halaman Home</title>
    <style>
        h3 {
            margin-top: 45px;
        }

        table {
            width: 100%;
            /* margin-top: 50px; */
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        #search-form {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
        }
        #search-form label {
            display: block;
            margin-bottom: 5px;
        }
        #search-form input[type="date"] {
            width: 200px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Resepsionis</h2>

    <!-- Tombol Kamar -->
    <a href="kamar.php"><button>Kamar</button></a>

    <!-- Tombol Tambah Kamar -->
    <a href="tambah_kamar.php"><button>Tambah Kamar</button></a>

    <!-- Tombol Check In -->
    <a href="checkin.php"><button>Check In</button></a>

    <!-- Tombol Check Out -->
    <a href="checkout.php"><button>Check Out</button></a>

    <!-- Tombol Log Out -->
    <a href="logout.php"><button>Log Out</button></a>

    <!-- Formulir pencarian -->
    <!-- <div id="search-form">
        <form action="" method="GET">
            <label for="start_date">Mulai Tanggal:</label>
            <input type="date" id="start_date" name="start_date" required>
            <label for="end_date">Akhir Tanggal:</label>
            <input type="date" id="end_date" name="end_date" required>
            <input type="submit" value="Cari">
        </form>
    </div> -->

    <h3> List Available Room</h3>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Floor</th>
            <th>Type</th>
            <th>Price</th>
            <th>Availability</th>
        </tr>
        <?php
        // Koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "hotel");

        // Query untuk mengambil data kamar yang kosong dari database
        $query = "SELECT * FROM kamar WHERE status = 'Tersedia'";
        $result = mysqli_query($conn, $query);

        // Loop untuk menampilkan setiap baris data sebagai baris dalam tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nomor_kamar'] . "</td>";
            echo "<td>" . $row['lantai_kamar'] . "</td>";
            echo "<td>" . $row['tipe_kamar'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }

        // Menutup koneksi database
        mysqli_close($conn);
        ?>
    </table>

    <h3> List Selected Room</h3>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Floor</th>
            <th>Type</th>
            <th>Price</th>
            <th>Availability</th>
        </tr>
        <?php
        // Koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "hotel");

        // Query untuk mengambil data kamar yang kosong dari database
        $query = "SELECT * FROM kamar WHERE status = 'Tidak Tersedia'";
        $result = mysqli_query($conn, $query);

        // Loop untuk menampilkan setiap baris data sebagai baris dalam tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nomor_kamar'] . "</td>";
            echo "<td>" . $row['lantai_kamar'] . "</td>";
            echo "<td>" . $row['tipe_kamar'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }

        // Menutup koneksi database
        mysqli_close($conn);
        ?>
    </table>
    
</body>
</html>