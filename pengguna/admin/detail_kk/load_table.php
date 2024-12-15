<?php
// Lakukan koneksi ke database
include '../../../keamanan/koneksi.php';

// Ambil id_kk dari URL atau request
$id_kk = isset($_GET['id_kk']) ? $_GET['id_kk'] : '';

// Cek apakah id_kk telah diterima
if (empty($id_kk)) {
    echo "<h3>ID KK tidak ditemukan!</h3>";
    exit;
}

// Query untuk mengambil data detail_kk dan penduduk yang memiliki id_kk tertentu
$query = "SELECT detail_kk.*, penduduk.nama AS nama, penduduk.jk AS jk, penduduk.agama AS agama, 
                 penduduk.tempat_lahir AS tempat_lahir, penduduk.tanggal_lahir AS tanggal_lahir, 
                 penduduk.alamat AS alamat, penduduk.nik AS nik
          FROM detail_kk
          LEFT JOIN penduduk ON detail_kk.id_penduduk = penduduk.id_penduduk
          WHERE detail_kk.id_kk = '$id_kk'";

// Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan
if (!empty($_GET['search_query'])) {
    $search_query = $_GET['search_query'];
    $query .= " AND penduduk.nama LIKE '%$search_query%'";
}

// Balik urutan data untuk memunculkan yang paling baru di atas
$query .= " ORDER BY detail_kk.id_detail_kk DESC";
$result = mysqli_query($koneksi, $query);

// Variabel untuk menyimpan nomor urut
$counter = 1;

// Cek jika query berhasil dieksekusi
if ($result) {
    // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
    while ($row = mysqli_fetch_assoc($result)) {
        $alamat = nl2br($row['alamat']); // Mengganti newline menjadi <br>
        $alamat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['alamat']));

        echo "<tr>";
        echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['nama'], ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['nik'], ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['jk'], ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['agama'], ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['tempat_lahir'], ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . htmlspecialchars($row['tanggal_lahir'], ENT_QUOTES) . "</td>";
        echo "<td class='text-center'>" . $alamat_sambung . "</td>";
        echo "<td class='text-center'>
                <button class='btn btn-primary btn-sm' onclick='openEditModal(
                    \"" . htmlspecialchars($row['id_detail_kk'], ENT_QUOTES) . "\",
                    \"" . htmlspecialchars($row['id_kk'], ENT_QUOTES) . "\",
                    \"" . htmlspecialchars($row['id_penduduk'], ENT_QUOTES) . "\"
                )'>Edit</button>
            </td>";
        echo "<td class='text-center'>
                <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_detail_kk'], ENT_QUOTES) . "\")'>Hapus</button>
            </td>";
        echo "</tr>";

        // Increment nomor urut
        $counter++;
    }
} else {
    echo "<td class='text-center' colspan='10'><h3>Gagal mengambil data dari database</h3></td>";
}

// Tutup koneksi ke database
mysqli_close($koneksi);
