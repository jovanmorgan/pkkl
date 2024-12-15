<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_penduduk = $_POST['id_penduduk'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$jk = $_POST['jk'];
$agama = $_POST['agama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];

// Lakukan validasi data
if (empty($nama) || empty($nik) || empty($jk) || empty($agama) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($alamat)) {
    echo "data_tidak_lengkap";
    exit();
}

// pengecekan nik pada penduduk
$check_query_penduduk = "SELECT * FROM penduduk WHERE nik = '$nik' AND id_penduduk != '$id_penduduk'";
$check_result_penduduk = mysqli_query($koneksi, $check_query_penduduk);
if (mysqli_num_rows($check_result_penduduk) > 0) {
    echo "data_nik_sudah_ada";
    exit();
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y', strtotime($tanggal_lahir));
// Konversi tag <br> kembali menjadi newline (\n)
$alamat_data = str_replace('<br>', "\n", $alamat);

// Buat query SQL untuk memperbarui data penduduk di dalam database
$query = "UPDATE penduduk SET nama='$nama', nik='$nik', jk='$jk', agama='$agama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_formatted', alamat='$alamat_data' WHERE id_penduduk ='$id_penduduk'";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
