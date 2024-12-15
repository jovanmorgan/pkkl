<?php
include '../../../keamanan/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_home = $_POST['id_home'];

    // Cek apakah file gambar_struktur baru diunggah
    if (!empty($_FILES['gambar_struktur']['name'])) {
        $struktur_name = $_FILES['gambar_struktur']['name'];
        $struktur_tmp = $_FILES['gambar_struktur']['tmp_name'];
        $struktur_path = '../../../assets/img/profile/' . basename($struktur_name); // Simpan gambar di folder
        move_uploaded_file($struktur_tmp, $struktur_path);

        // Update path file gambar_struktur di database
        $query_update_struktur = "UPDATE home SET gambar_struktur='$struktur_path' WHERE id_home='$id_home'";
        mysqli_query($koneksi, $query_update_struktur);
    }

    echo "success";
    exit();
} else {
    echo "Gagal melakukan proses: " . mysqli_error($koneksi);
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
