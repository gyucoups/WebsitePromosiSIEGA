<?php
// === Koneksi Database ===
$host     = "localhost";
$user     = "root";
$password = "";
$database = "siega_db";
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// === Login Sederhana ===
$admin_user = "admin";     // ubah sesuai kebutuhan
$admin_pass = "siega123";  // ubah sesuai kebutuhan

$is_logged_in = false;
$error = "";

// Jika form login dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'])) {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $is_logged_in = true;
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
    <title>Admin - Data Pendaftar | SIEGA</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f3f6fb;
            font-family: Inter, sans-serif;
        }

        .container {
            max-width: 960px;
            margin: 120px auto;
            background: #fff;
            padding: 28px 32px;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(11, 78, 215, 0.12);
        }

        h2 {
            text-align: center;
            color: #0b2545;
            margin-bottom: 20px;
        }

        .error {
            background: #ffe6e6;
            color: #c0392b;
            padding: 8px 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 10px;
        }

        /* form login */
        form.login {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 320px;
            margin: 0 auto;
        }

        input {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        button {
            background: linear-gradient(90deg, var(--blue), var(--dark-blue));
            color: #fff;
            border: none;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: linear-gradient(90deg, var(--blue), var(--dark-blue));
            color: #fff;
        }

        tr:hover {
            background: #f9fbff;
        }

        .no-data {
            text-align: center;
            color: #6b7280;
            padding: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="brand">
            <div class="logo"><img src="assets/img/logo-siega.jpg" alt="Logo SIEGA"></div>
            <div>
                <div style="font-weight:800">SIEGA</div>
                <div style="font-size:12px;color:var(--muted)">Unika Soegijapranata</div>
            </div>
        </div>
        <nav>
            <a href="index.html">Beranda</a>
            <a href="pendaftaran.php">Formulir</a>
            <a href="#" class="cta">Admin</a>
        </nav>
    </header>

    <main>
        <div class="container fade-in">
            <h2>Panel Admin SIEGA</h2>

            <?php if (!$is_logged_in): ?>
                <!-- Tampilan login -->
                <?php if (!empty($error)): ?>
                    <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" class="login">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Masuk</button>
                </form>
            <?php else: ?>
                <!-- Tampilan data pendaftar -->
                <h3 style="text-align:center;margin-top:20px;">Data Pendaftar Mahasiswa Baru</h3>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM pendaftaran ORDER BY tanggal_daftar DESC");
                if (mysqli_num_rows($result) > 0):
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Program</th>
                                <th>Pesan</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['telepon']) ?></td>
                                    <td><?= htmlspecialchars($row['program']) ?></td>
                                    <td><?= htmlspecialchars($row['pesan']) ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($row['tanggal_daftar'])) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="no-data">Belum ada data pendaftar.</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div style="max-width:1200px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;gap:20px">
            <div>
                <div style="font-weight:800">SIEGA</div>
                <div style="font-size:13px;color:rgba(255,255,255,0.85)">Unika Soegijapranata — Admin Panel</div>
            </div>
            <div style="font-size:13px;color:rgba(255,255,255,0.9)">© 2025 SIEGA</div>
        </div>
    </footer>
</body>

</html>
<?php mysqli_close($conn); ?>