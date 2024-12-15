<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_penduduk = $_POST['id_penduduk'];
$tgl_kematian = $_POST['tgl_kematian'];

// Lakukan validasi data
if (empty($id_penduduk) || empty($tgl_kematian)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan id_kematian pada kematian
$check_query_kematian = "SELECT * FROM kematian WHERE id_penduduk = '$id_penduduk'";
$check_result_kematian = mysqli_query($koneksi, $check_query_kematian);
if (mysqli_num_rows($check_result_kematian) > 0) {
    echo "data_id_kematian_sudah_ada";
    exit();
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y', strtotime($tgl_kematian));

// Buat query SQL untuk menambahkan data kematian ke dalam database
$query = "INSERT INTO kematian (id_penduduk, tgl_kematian) 
        VALUES ('$id_penduduk', '$tanggal_formatted')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
