<?php
session_start();

// Jika sudah login, langsung arahkan ke admin.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit();
}

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // === Ganti sesuai kebutuhanmu ===
    $admin_user = "admin";
    $admin_pass = "siega123"; // password bisa kamu ubah

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | SIEGA</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f0f6ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: #fff;
            padding: 30px 36px;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(11, 78, 215, 0.12);
            width: 360px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0b2545;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-bottom: 12px;
        }

        button {
            background: linear-gradient(90deg, var(--blue), var(--dark-blue));
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            width: 100%;
            font-weight: 700;
        }

        .error {
            background: #ffe6e6;
            color: #c0392b;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-box fade-in">
        <h2>Login Admin</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>

</html>