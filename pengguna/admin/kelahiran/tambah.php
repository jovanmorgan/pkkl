<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$anak_id_penduduk = $_POST['anak_id_penduduk'];
$ibu_id_penduduk = $_POST['ibu_id_penduduk'];
$bapa_id_penduduk = $_POST['bapa_id_penduduk'];

// Lakukan validasi data
if (empty($anak_id_penduduk) || empty($ibu_id_penduduk) || empty($bapa_id_penduduk)) {
    echo "data_tidak_lengkap";
    exit();
}

// Pengecekan apakah anak sudah ada di kelahiran
$check_query_kelahiran = "SELECT * FROM kelahiran WHERE anak_id_penduduk = '$anak_id_penduduk'";
$check_result_kelahiran = mysqli_query($koneksi, $check_query_kelahiran);
if (mysqli_num_rows($check_result_kelahiran) > 0) {
    echo "data_anak_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data kelahiran ke dalam database
$query = "INSERT INTO kelahiran (anak_id_penduduk, ibu_id_penduduk, bapa_id_penduduk) 
            VALUES ('$anak_id_penduduk', '$ibu_id_penduduk', '$bapa_id_penduduk')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
