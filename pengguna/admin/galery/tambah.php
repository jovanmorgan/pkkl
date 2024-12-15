<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($nama) || empty($tanggal) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

$kover_name = $_FILES['foto']['name'];
$kover_tmp = $_FILES['foto']['tmp_name'];
$kover_path = '../../../images/galery/' . basename($kover_name); // Simpan kover di dalam folder gambar
move_uploaded_file($kover_tmp, $kover_path);

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y H:i', strtotime($tanggal));
// Konversi tag <br> kembali menjadi newline (\n)
$deskripsi_data = str_replace('<br>', "\n", $deskripsi);

// Buat query SQL untuk menambahkan data kegiatan ke dalam database
$query = "INSERT INTO galery (tanggal, nama, deskripsi, foto) 
        VALUES ('$tanggal_formatted', '$nama', '$deskripsi_data', '$kover_path')";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
