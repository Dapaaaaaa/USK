<?php
session_start();
if(!isset($_SESSION['id_user'])) {
    //jika belum login arahkan ke login
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Check-out Form</title>
</head>
<style>
        body {
            text-align: center; 
        }

        .container {
            width: 600px; 
            margin: 50px auto; 
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: left;
        }

        .container h2 {
            margin-bottom: 20px;
        }

        .container table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .container table th, .container table td {
            border: 2px solid #ccc;
            padding: 8px;
        }

        .container form {
            margin-top: 20px;
        }

        .container label {
            display: block;
        }

        .container select,
        .container input[type="submit"] {
            width: calc(100% - 20px);
            margin-bottom: 8px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
<body>
    <div class="container">
    <h2>Hotel Check-out Form</h2>

    <h3> List Selected Room</h3>
    <table>
        <tr>
            <th>Room Number</th>
            <th>Floor Number</th>
            <th>Type</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Action</th>
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
            echo "<td>";
            echo "<a href='checkout_process.php?nomor_kamar=". $row['nomor_kamar'] . "'> Check Out</a>";
            echo "</td>";
            echo "</tr>";
        }

        // Menutup koneksi database
        mysqli_close($conn);
        ?>
    </table>
    <!-- <form action="checkout_process.php" method="post">
        <label for="nomor_kamar">Nomor Kamar:</label><br>
        <select id="nomor_kamar" name="nomor_kamar">
            <?php
            //mulai koneksi
            $conn = mysqli_connect("localhost", "root", "", "hotel");
            
            //query untuk mengambil nomor kamar yang di tidak tersedia
            $query = "SELECT id, nomor_kamar FROM kamar WHERE status = 'Tidak Tersedia'";
            $result = mysqli_query($conn, $query);

            //tampilkan nomor kamar yang sedang di pesan
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value'" . $row['nomor_kamar'] . "'>" . $row['nomor_kamar'] . "</option>";
            }

            //tutup koneksi
            mysqli_close($conn);
            ?>

        </select> -->
        <!-- <input type="submit" value="Check-out"> -->
    </form>
    </div>
</body>
</html>