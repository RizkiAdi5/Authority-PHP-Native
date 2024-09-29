<?php
session_start();
include 'conection.php'; // Pastikan nama file koneksi database benar

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // find username
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Username or password is incorrect!";
    }

    // regist 
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $password]);

    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');


        /* .pacifico-regular {
            font-family: "Pacifico", cursive;
            font-weight: 400;
            font-style: normal;
        } */

        body {
            background-image: url('asset/japon.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #f0f0f0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(5px);
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-family: "Pacifico", cursive;
        }

        p a {
            cursor: pointer;
        }

        form .form-group label {
            color: #ffffff;
        }


        #registForm {
            display: none;
        }
    </style>

    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Login Form -->
    <div class="container mt-5" id="loginForm">
        <h2 class=" text-white">Login</h2>
        <hr>
        <?php
        if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php } ?>
        <form method="POST" class="text-white">
            <div class="form-group">
                <label for="username">Username :</label>
                <input type="text" class="form-control" name="username" id="username" required />
            </div>
            <div class="form-group mt-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required />
            </div>
            <button type="submit " name="login" class="btn btn-primary mt-3 w-100">Login</button>
        </form>
        <p class="mt-3  ">Don't have an account? <a id="showRegister" class="text-primary">Sign up here</a>.</p>
    </div>

    <!-- Regist Form (hide) -->
    <div id="registForm" class="container mt-5">
        <h2 class="text-white">Create New Account</h2>
        <hr>
        <form method="POST">
            <div class="form-group mt-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required />
            </div>
            <div class="form-group mt-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required />
            </div>
            <div class="form-group mt-3 ">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required />
            </div>
            <button type="submit" name="register" class="btn btn-primary mt-3 w-100">Create</button>
        </form>
        <p class="mt-3">You have an account? <a id="showLogin" class="text-primary">Sign in here</a>.</p>
    </div>

    <!-- form js-->
    <script>
        document.getElementById('showRegister').addEventListener('click', function() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registForm').style.display = 'block';
        });

        document.getElementById('showLogin').addEventListener('click', function() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registForm').style.display = 'none';
        });
    </script>
</body>

</html>