<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_lurah = $_POST['id_lurah'];
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($id_lurah) || empty($nip) || empty($nama) || empty($username)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan username pada admin
$check_query_admin = "SELECT * FROM admin WHERE username = '$username'";
$check_result_admin = mysqli_query($koneksi, $check_query_admin);
if (mysqli_num_rows($check_result_admin) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// pengecekan username pada pengunjung
$check_query_pengunjung = "SELECT * FROM pengunjung WHERE username = '$username'";
$check_result_pengunjung = mysqli_query($koneksi, $check_query_pengunjung);
if (mysqli_num_rows($check_result_pengunjung) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// pengecekan username pada lurah
$check_query_lurah = "SELECT * FROM lurah WHERE username = '$username' AND id_lurah != '$id_lurah'";
$check_result_lurah = mysqli_query($koneksi, $check_query_lurah);
if (mysqli_num_rows($check_result_lurah) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// Buat query SQL untuk memperbarui data lurah ke dalam database
if (!empty($password)) {
    // Enkripsi password jika diubah
    $query = "UPDATE lurah SET nip = '$nip', nama = '$nama', username = '$username', password = '$password' WHERE id_lurah = '$id_lurah'";
} else {
    // Jangan ubah password jika tidak diisi
    $query = "UPDATE lurah SET nip = '$nip', nama = '$nama', username = '$username' WHERE id_lurah = '$id_lurah'";
}

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
