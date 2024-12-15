<?php
include '../../../keamanan/koneksi.php';

$sql = "SELECT id_home, visi, misi FROM home";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_home = $row['id_home'];
        $visi = str_replace(array("\r", "\n"), '', nl2br($row['visi']));
        $misi = str_replace(array("\r", "\n"), '', nl2br($row['misi']));
?>
        <a href="#" class="edit-link" onclick="openEditModal4(<?php echo $id_home; ?>, '<?php echo htmlspecialchars($visi, ENT_QUOTES); ?>', '<?php echo htmlspecialchars($misi, ENT_QUOTES); ?>')">
            <div class="content-to-edit">
                <h4 id="visi&misi">
                    <b>Visi dan Misi</b>
                </h4>
                <p>Berikut adalah isi Visi
                    dan
                    Misi dari home IO0496
                    Maranatha:</p>
                <p>Visi</p>
                <blockquote>
                    <p>
                        <i>“<?php echo nl2br($row['visi']); ?>”</i>
                    </p>
                </blockquote>
                <p>Misi</p>
                <blockquote>
                    <p>
                        <i><?php echo nl2br($row['misi']); ?></i>
                    </p>
                </blockquote>
                <span class="hover-text2 text-center">Klik
                    untuk mengedit</span>
            </div>
        </a>
<?php
    }
} else {
    echo "Tidak ada data.";
}

$koneksi->close();
?>