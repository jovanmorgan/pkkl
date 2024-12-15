                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Nik</th>
                                                <th class="text-center">Jenis Kelamin</th>
                                                <th class="text-center">Agama</th>
                                                <th class="text-center">Tempat Lahir</th>
                                                <th class="text-center">Tanggal Lahir</th>
                                                <th class="text-center">Tanggal Kematian</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">Laporan</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Lakukan koneksi ke database
                                            include '../../../keamanan/koneksi.php';
                                            // Ambil kata kunci pencarian dari URL jika ada
                                            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
                                            // Query SQL untuk mengambil data dari tabel kematian
                                            $query = "SELECT kematian.*, penduduk.nama AS nama, penduduk.nama AS nama, penduduk.jk AS jk, penduduk.agama AS agama, penduduk.tempat_lahir AS tempat_lahir, penduduk.tanggal_lahir AS tanggal_lahir, penduduk.alamat AS alamat, penduduk.nik AS nik
                                            FROM kematian
                                            LEFT JOIN penduduk ON kematian.id_penduduk = penduduk.id_penduduk";
                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE kematian.tgl_kematian LIKE '%$search_query%' OR penduduk.nama LIKE '%$search_query%' OR penduduk.jk LIKE '%$search_query%' OR penduduk.agama LIKE '%$search_query%' OR penduduk.tempat_lahir LIKE '%$search_query%' OR penduduk.tanggal_lahir LIKE '%$search_query%' OR penduduk.alamat LIKE '%$search_query%' OR penduduk.nik LIKE '%$search_query%'";
                                            }
                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_kematian DESC";
                                            $result = mysqli_query($koneksi, $query);
                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;
                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $alamat = nl2br($row['alamat']); // Mengganti newline menjadi <br>
                                                    $alamat_sambung = str_replace(array("\r", "\n"), '', nl2br($row['alamat']));
                                                    $tgl_kematian_input = $row['tgl_kematian'];
                                                    $tgl_kematian_input_data = date('Y-m-d', strtotime($tgl_kematian_input));

                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nik'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jk'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['agama'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tempat_lahir'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tanggal_lahir'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tgl_kematian'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . $alamat_sambung . "</td>";
                                                    echo "<td class='text-center'>
                                                            <a href='kematian/laporan_kematian?id_kematian=" . htmlspecialchars($row['id_kematian'], ENT_QUOTES) . "' target='_blank' class='btn btn-info btn-sm'>Laporan</a>
                                                        </td>";
                                                    echo "<td class='text-center'>
                                                            <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                \"" . htmlspecialchars($row['id_kematian'], ENT_QUOTES) . "\",
                                                                \"" . htmlspecialchars($row['id_penduduk'], ENT_QUOTES) . "\",
                                                                \"" . $tgl_kematian_input_data . "\"
                                                            )'>Edit</button>
                                                        </td>";

                                                    echo "<td class='text-center'>
                                                            <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_kematian'], ENT_QUOTES) . "\")'>Hapus</button>
                                                        </td>";
                                                    echo "</tr>";

                                                    // Increment nomor urut
                                                    $counter++;
                                                }
                                            } else {
                                                echo "<td class='text-center' colspan='7'><h3>Gagal mengambil data dari database</h3></td>";
                                            }

                                            // Tutup koneksi ke database
                                            mysqli_close($koneksi);
                                            ?>
                                        </tbody>
                                    </table>