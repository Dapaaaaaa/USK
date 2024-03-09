<?php
// Lakukan pemeriksaan apakah pengguna sudah login atau belum
session_start();
if(!isset($_SESSION['id_user'])) {
    // Jika belum login, arahkan pengguna ke halaman login
    header("Location: login.php");
    exit; // Hentikan eksekusi lebih lanjut
}

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "hotel");

// Query untuk mengambil data kamar yang statusnya tersedia
$query = "SELECT id, nomor_kamar, tipe_kamar, harga FROM kamar WHERE status = 'Tersedia'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Booking Form</title>
</head>
<style>
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
        }

        .container h2 {
            text-align: center;
        }

        .container input[type="text"],
        .container input[type="date"],
        .container select {
            width: 100%; 
            margin-bottom: 10px;
        }

        .container input[type="submit"] {
            width: 100%;
        }
</style>
<body>
    <div class="container">
    <h2>Hotel Booking Form</h2>
    <a href="kamar.php"><button>Back</button></a>

    <form action="pemesanan_process.php" method="post" id="bookingForm">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br>

        <label for="NIK">NIK:</label><br>
        <input type="text" id="NIK" name="NIK" required><br>

        <label for="nomor_kamar">Nomor Kamar:</label><br>
        <select id="nomor_kamar" name="nomor_kamar" onchange="showRoomInfo()" required>
            <?php
            // Loop untuk menampilkan opsi nomor kamar yang tersedia
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "' data-harga='" . $row['harga'] . "' data-tipe='" . $row['tipe_kamar'] . "'>" . $row['nomor_kamar'] . "</option>";
            }
            ?>
        </select><br>
        
        <label for="tipe_kamar">Tipe kamar:</label><br>
        <input type="text" id="tipe_kamar" name="tipe_kamar" readonly><br>

        <label for="harga">Harga:</label><br>
        <input type="text" id="harga" name="harga" readonly><br>

        <label for="tanggal_checkin">Tanggal Check-in:</label><br>
        <input type="date" id="tanggal_checkin" name="tanggal_checkin" required><br>

        <label for="tanggal_checkout">Tanggal Check-out:</label><br>
        <input type="date" id="tanggal_checkout" name="tanggal_checkout" required><br>

        <input type="submit" value="Pesan!">
    </form>

    <script>
        // Inisialisasi harga dengan harga kamar pertama
        document.getElementById("harga").value = document.getElementById("nomor_kamar").selectedOptions[0].getAttribute("data-harga");

        // Inisialisai tipe kamar dengan kamar pertama
        document.getElementById("tipe_kamar").value = document.getElementById("nomor_kamar").selectedOptions[0].getAttribute("data-tipe");

        function showRoomInfo() {
            // Mendapatkan nilai nomor kamar yang dipilih
            var nomorKamar = document.getElementById("nomor_kamar").value;
            // Mendapatkan data harga kamar dari atribut data-harga
            var hargaKamar = document.getElementById("nomor_kamar").selectedOptions[0].getAttribute("data-harga");
            // Mendapatkan data tipe akmar dari atribut data-tipe
            var tipeKamar = document.getElementById("nomor_kamar").selectedOptions[0].getAttribute("data-tipe");
            // Memasukkan harga kamar ke dalam input harga
            document.getElementById("harga").value = hargaKamar;
            // Memasukkan tipe kamar ke dalam input tipe
            document.getElementById("tipe_kamar").value = tipeKamar;
        }
    </script>
    </div>
</body>
</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>
