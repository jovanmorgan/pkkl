<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_kk = $_POST['id_kk'];
$id_penduduk = $_POST['id_penduduk'];

// Lakukan validasi data
if (empty($id_kk) || empty($id_penduduk)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan id_penduduk pada penduduk
$check_query_penduduk = "SELECT * FROM detail_kk WHERE id_penduduk = '$id_penduduk'";
$check_result_penduduk = mysqli_query($koneksi, $check_query_penduduk);
if (mysqli_num_rows($check_result_penduduk) > 0) {
    echo "data_penduduk_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data kk ke dalam database
$query = "INSERT INTO detail_kk (id_kk, id_penduduk) 
        VALUES ('$id_kk', '$id_penduduk')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
