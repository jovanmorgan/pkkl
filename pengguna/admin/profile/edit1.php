<?php
include '../../../keamanan/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_sejara = $_POST['id_sejara'];

    // Cek apakah file kover baru diunggah
    if (!empty($_FILES['gambar_sejara']['name'])) {
        $kover_name = $_FILES['gambar_sejara']['name'];
        $kover_tmp = $_FILES['gambar_sejara']['tmp_name'];
        $kover_path = '../../../assets/img/profile/' . basename($kover_name); // Simpan kover di dalam folder gambar
        move_uploaded_file($kover_tmp, $kover_path);

        // Update path file kover di database
        $query_update_kover = "UPDATE sejara SET gambar_sejara='$kover_path' WHERE id_sejara='$id_sejara'";
        mysqli_query($koneksi, $query_update_kover);

        // Setelah penyimpanan file selesai, arahkan kembali pengguna ke halaman yang sesuai
        echo "success";
        exit();
    } else {
        // Jika terjadi kesalahan saat melakukan proses update, tampilkan pesan kesalahan
        echo "Gagal melakukan proses : " . mysqli_error($koneksi);
    }
} else {
    // Jika metode request bukan POST, arahkan pengguna kembali ke halaman yang sesuai
    header("Location: ../../admin_data_sejara.php");
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
