<?php
include '../../../keamanan/koneksi.php';

// Terima ID detail_kk yang akan dihapus dari formulir HTML
$id_detail_kk = $_POST['id']; // Ubah menjadi $_GET jika menggunakan metode GET

// Lakukan validasi data
if (empty($id_detail_kk)) {
    echo "data_tidak_lengkap";
    exit();
}

// Buat query SQL untuk menghapus data detail_kk berdasarkan ID
$query_delete_detail_kk = "DELETE FROM detail_kk WHERE id_detail_kk = '$id_detail_kk'";

// Jalankan query untuk menghapus data
if (mysqli_query($koneksi, $query_delete_detail_kk)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
