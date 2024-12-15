<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_detail_kk = $_POST['id_detail_kk'];
$id_kk = $_POST['id_kk'];
$id_penduduk = $_POST['id_penduduk'];

// Lakukan validasi data
if (empty($id_kk) || empty($id_penduduk)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan id_penduduk pada penduduk
$check_query_penduduk = "SELECT * FROM detail_kk WHERE id_penduduk = '$id_penduduk' AND id_detail_kk = '$id_detail_kk'";
$check_result_penduduk = mysqli_query($koneksi, $check_query_penduduk);
if (mysqli_num_rows($check_result_penduduk) > 0) {
    echo "data_penduduk_sudah_ada";
    exit();
}

// Buat query SQL untuk memperbarui data detail_kk di dalam database
$query = "UPDATE detail_kk SET id_kk='$id_kk', id_penduduk='$id_penduduk' WHERE id_detail_kk ='$id_detail_kk'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
