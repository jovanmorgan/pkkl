<div id="dataGambar1">
    <?php
    include '../../../keamanan/koneksi.php';

    $sql = "SELECT id_sejara, gambar_sejara FROM sejara";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gambar_sejara = str_replace("../../../", "../../", $row["gambar_sejara"]);
            echo '<figure class="mu-latest-course-img">';
            echo '<a href="#" onclick="openEditModal(' . $row["id_sejara"] . ', \'' . $gambar_sejara . '\')" data-toggle="modal" data-target="#edit1">';
            echo '<img src="' . $gambar_sejara . '" alt="img" />';
            echo '<figcaption class="mu-latest-course-imgcaption"><span class="hover-text">Klik untuk mengedit</span></figcaption>';
            echo '</a>';
            echo '</figure>';
        }
    } else {
        echo "Tidak ada data.";
    }

    $koneksi->close();
    ?>