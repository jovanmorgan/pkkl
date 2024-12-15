<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_kematian = $_POST['id_kematian'];
$id_penduduk = $_POST['id_penduduk'];
$tgl_kematian = $_POST['tgl_kematian'];

// Lakukan validasi data
if (empty($id_kematian) || empty($id_penduduk) || empty($tgl_kematian)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan nik pada kematian
$check_query_kematian = "SELECT * FROM kematian WHERE id_penduduk = '$id_penduduk' AND id_kematian != '$id_kematian'";
$check_result_kematian = mysqli_query($koneksi, $check_query_kematian);
if (mysqli_num_rows($check_result_kematian) > 0) {
    echo "data_nik_sudah_ada";
    exit();
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y', strtotime($tgl_kematian));

// Buat query SQL untuk memperbarui data kematian di dalam database
$query = "UPDATE kematian SET id_penduduk='$id_penduduk', tgl_kematian='$tgl_kematian' WHERE id_kematian ='$id_kematian'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
