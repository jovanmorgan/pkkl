<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nikk = $_POST['nikk'];

// Lakukan validasi data
if (empty($nikk)) {
    echo "data_tidak_lengkap";
    exit();
}


// Buat query SQL untuk menambahkan data kk ke dalam database
$query = "INSERT INTO kk (nikk) 
        VALUES ('$nikk')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
