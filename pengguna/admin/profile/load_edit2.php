<?php
include '../../../keamanan/koneksi.php';

$sql = "SELECT id_home, gambar_struktur FROM home";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gambar_struktur = str_replace("../../../", "../../", $row["gambar_struktur"]);
        echo '<figure class="mu-latest-course-img">';
        echo '<a href="#" onclick="openEditModal2(' . $row["id_home"] . ', \'' . $gambar_struktur . '\')">';
        echo '<img src="' . $gambar_struktur . '" alt="img" />';
        echo '<figcaption class="mu-latest-course-imgcaption"><span class="hover-text">Klik untuk mengedit</span></figcaption>';
        echo '</a>';
        echo '</figure>';
    }
} else {
    echo "Tidak ada data.";
}

$koneksi->close();
