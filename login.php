<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Login</title>
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

        .container h1 {
            text-align: center;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%; 
            margin-bottom: 10px;
        }

        .container input[type="submit"] {
            width: 100%;
        }
    </style>
<body>
    <div class="container">
        <h1>Halaman Login</h1>
            <form action="login_process.php" method="POST">
                <label for="username">Username:</label><br>
                <input type="text" name="username" id="username">
                <br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password">
                <br>
                <input type="submit" value="Login">
            </form>
            <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>