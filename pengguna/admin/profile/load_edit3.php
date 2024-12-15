<?php
include '../../../keamanan/koneksi.php';

$sql = "SELECT id_sejara, deskripsi_sejara FROM sejara";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_sejara = $row['id_sejara'];
        $deskripsi_sejara = nl2br($row['deskripsi_sejara']); // Mengganti newline menjadi <br>
        $deskripsi_sejara_sambung = str_replace(array("\r", "\n"), '', nl2br($row['deskripsi_sejara'])); // Mengganti newline dengan <br> dan menghapus baris baru

?>
        <a href="#" class="edit-link" onclick="openEditModal3(<?php echo $id_sejara; ?>, '<?php echo htmlspecialchars($deskripsi_sejara_sambung, ENT_QUOTES); ?>')">
            <div class="content-to-edit">
                <h4><b> Sejerah </b></h4>
                <p><?php echo $deskripsi_sejara; ?>
                </p>
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