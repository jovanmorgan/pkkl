<?php
include '../../../keamanan/koneksi.php';

// Terima data dari formulir HTML
$id_galery = $_POST['id_galery'];
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$deskripsi = $_POST['deskripsi'];

// Lakukan validasi data
if (empty($id_galery) || empty($nama) || empty($tanggal) || empty($deskripsi)) {
    echo "data_tidak_lengkap";
    exit();
}

// Proses upload file
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $kover_name = $_FILES['foto']['name'];
    $kover_tmp = $_FILES['foto']['tmp_name'];
    $kover_path = '../../../images/galery/' . basename($kover_name);

    // Simpan file foto di folder tujuan
    if (move_uploaded_file($kover_tmp, $kover_path)) {
        // File berhasil diupload, lanjutkan dengan update database
    } else {
        echo "error";
        exit();
    }
} else {
    // Jika tidak ada file baru yang diupload, tetap gunakan foto yang lama
    $kover_path = '';
}

// Format tanggal ke format yang diinginkan
$tanggal_formatted = date('d-M-Y H:i', strtotime($tanggal));
// Konversi tag <br> kembali menjadi newline (\n)
$deskripsi_data = str_replace('<br>', "\n", $deskripsi);

// Buat query SQL untuk mengupdate data
$query_update = "UPDATE galery SET tanggal = '$tanggal_formatted', nama = '$nama', deskripsi = '$deskripsi_data'";

// Tambahkan kolom foto jika ada file baru yang diupload
if (!empty($kover_path)) {
    $query_update .= ", foto = '$kover_path'";
}

$query_update .= " WHERE id_galery = '$id_galery'";

// Jalankan query
if (mysqli_query($koneksi, $query_update)) {
    echo "success";
} else {
    echo "error";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
