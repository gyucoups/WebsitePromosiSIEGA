<?php
// === Konfigurasi koneksi database ===
$host     = "localhost";   // biasanya: localhost
$user     = "root";        // sesuaikan dengan user MySQL kamu
$password = "";            // isi jika MySQL kamu pakai password
$database = "siega_db";    // nama database (buat di phpMyAdmin)

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// === Ambil data dari form ===
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $telepon  = mysqli_real_escape_string($conn, $_POST['telepon']);
    $program  = mysqli_real_escape_string($conn, $_POST['program']);
    $pesan    = mysqli_real_escape_string($conn, $_POST['pesan']);

    // === Query simpan ke tabel pendaftaran ===
    $query = "INSERT INTO pendaftaran (nama, email, telepon, program, pesan, tanggal_daftar)
              VALUES ('$nama', '$email', '$telepon', '$program', '$pesan', NOW())";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil, kembali ke halaman pendaftaran dengan pesan sukses
        header("Location: pendaftaran.php?status=success");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }
} else {
    echo "Akses tidak valid.";
}

// Tutup koneksi
mysqli_close($conn);
