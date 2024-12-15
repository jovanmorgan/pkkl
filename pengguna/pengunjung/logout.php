<?php
session_start();

// Hapus sesi id_pengunjung jika ada
if (isset($_SESSION['id_pengunjung'])) {
    unset($_SESSION['id_pengunjung']);
}

// Redirect pengguna kembali ke halaman login
header("Location: ../../berlangganan/login");
exit;
