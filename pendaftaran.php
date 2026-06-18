<?php
// (Opsional) jika form sudah dikirim, tampilkan pesan sukses
if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $message = "Pendaftaran berhasil dikirim!";
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Mahasiswa Baru | SIEGA Unika Soegijapranata</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 640px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        label {
            font-weight: 600;
            color: #0b2545;
        }

        input,
        select,
        textarea {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 15px;
            width: 100%;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            margin-top: 10px;
            background: linear-gradient(90deg, var(--blue), var(--dark-blue));
            color: #fff;
            padding: 10px 16px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        .message {
            background: #e6f7ec;
            border: 1px solid #b7eb8f;
            color: #256029;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 12px;
            text-align: center;
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
            <a href="index.html#about">Tentang</a>
            <a href="index.html#program">Program</a>
            <a href="index.html#news">Berita</a>
            <a href="index.html#daftar" class="cta">Kembali</a>
        </nav>
    </header>

    <main>
        <div class="form-container fade-in">
            <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

            <?php if (!empty($message)): ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form action="process_daftar.php" method="POST">
                <div>
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" required>
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="telepon">Nomor Telepon</label>
                    <input type="text" name="telepon" id="telepon" required>
                </div>

                <div>
                    <label for="program">Program Studi Pilihan</label>
                    <select name="program" id="program" required>
                        <option value="">-- Pilih Program Studi --</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Akuntansi & Sistem Informasi">Akuntansi & Sistem Informasi</option>
                        <option value="E-Commerce">E-Commerce</option>
                        <option value="Game Technology">Game Technology</option>
                    </select>
                </div>

                <div>
                    <label for="pesan">Pesan / Motivasi Singkat</label>
                    <textarea name="pesan" id="pesan" placeholder="Ceritakan alasan kamu ingin bergabung dengan SIEGA..."></textarea>
                </div>

                <button type="submit">Kirim Pendaftaran</button>
            </form>
        </div>
    </main>

    <footer>
        <div style="max-width:1200px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;gap:20px">
            <div>
                <div style="font-weight:800">SIEGA</div>
                <div style="font-size:13px;color:rgba(255,255,255,0.85)">Unika Soegijapranata — Teknologi & Inovasi</div>
            </div>
            <div style="font-size:13px;color:rgba(255,255,255,0.9)">© 2025 SIEGA • All rights reserved</div>
        </div>
    </footer>
</body>

</html>