<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_sejara = $_POST['id_sejara'];
$deskripsi_sejara = $_POST['deskripsi_sejara'];

// Konversi tag <br> kembali menjadi newline (\n)
$deskripsi_sejara = str_replace('<br>', "\n", $deskripsi_sejara);

// Lakukan validasi data
if (empty($deskripsi_sejara)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE sejara SET deskripsi_sejara = '$deskripsi_sejara' WHERE id_sejara = '$id_sejara'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
