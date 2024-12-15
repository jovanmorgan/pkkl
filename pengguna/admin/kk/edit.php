<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_kk = $_POST['id_kk'];
$nikk = $_POST['nikk'];

// Lakukan validasi data
if (empty($nikk) || empty($id_kk)) {
    echo "data_tidak_lengkap";
    exit();
}
// Buat query SQL untuk memperbarui data kk di dalam database
$query = "UPDATE kk SET nikk='$nikk' WHERE id_kk ='$id_kk'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
