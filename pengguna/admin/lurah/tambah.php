<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan validasi data
if (empty($nip) || empty($nama) || empty($username) || empty($password)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan jumlah data di tabel lurah
$query_check_count = "SELECT COUNT(*) as total FROM lurah";
$result_check_count = mysqli_query($koneksi, $query_check_count);
$row_check_count = mysqli_fetch_assoc($result_check_count);
$total_data = (int)$row_check_count['total'];

// Jika sudah ada satu data, beri pesan error
if ($total_data >= 1) {
    echo "data_sudah_ada";
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
$check_query_lurah = "SELECT * FROM lurah WHERE username = '$username'";
$check_result_lurah = mysqli_query($koneksi, $check_query_lurah);
if (mysqli_num_rows($check_result_lurah) > 0) {
    echo "data_username_sudah_ada";
    exit();
}

// Buat query SQL untuk menambahkan data lurah ke dalam database
$query = "INSERT INTO lurah (nip, nama, username, password) 
          VALUES ('$nip', '$nama', '$username', '$password')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
