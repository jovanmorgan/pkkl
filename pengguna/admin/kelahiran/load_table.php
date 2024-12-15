                                    <table class="table tablesorter " id="dataTable">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center">Nama Anak</th>
                                                <th class="text-center">Nama Ibu</th>
                                                <th class="text-center">Nama Ayah</th>
                                                <th class="text-center">Nik</th>
                                                <th class="text-center">Jenis Kelamin</th>
                                                <th class="text-center">Agama</th>
                                                <th class="text-center">Tempat Lahir</th>
                                                <th class="text-center">Tanggal Lahir</th>
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

                                            // Query SQL untuk mengambil data dari tabel kelahiran
                                            $query = "SELECT kelahiran.*, 
                                                        anak.nama AS nama_anak, anak.nik AS nik_anak, anak.jk AS jk_anak, anak.agama AS agama_anak, 
                                                        anak.tempat_lahir AS tempat_lahir_anak, anak.tanggal_lahir AS tanggal_lahir_anak, anak.alamat AS alamat_anak,
                                                        ibu.nama AS nama_ibu, ayah.nama AS nama_ayah 
                                                FROM kelahiran
                                                LEFT JOIN penduduk AS anak ON kelahiran.anak_id_penduduk = anak.id_penduduk
                                                LEFT JOIN penduduk AS ibu ON kelahiran.ibu_id_penduduk = ibu.id_penduduk
                                                LEFT JOIN penduduk AS ayah ON kelahiran.bapa_id_penduduk = ayah.id_penduduk";

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan
                                            if (!empty($search_query)) {
                                                $query .= " WHERE anak.nama LIKE '%$search_query%' 
                                                            OR anak.jk LIKE '%$search_query%' 
                                                            OR anak.agama LIKE '%$search_query%' 
                                                            OR anak.tempat_lahir LIKE '%$search_query%' 
                                                            OR anak.tanggal_lahir LIKE '%$search_query%' 
                                                            OR anak.alamat LIKE '%$search_query%' 
                                                            OR anak.nik LIKE '%$search_query%'";
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY kelahiran.id_kelahiran DESC";
                                            $result = mysqli_query($koneksi, $query);
                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;
                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_ibu'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama_ayah'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nik_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['jk_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['agama_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tempat_lahir_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['tanggal_lahir_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['alamat_anak'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>
                                                            <a href='kelahiran/laporan_kelahiran?id_kelahiran=" . htmlspecialchars($row['id_kelahiran'], ENT_QUOTES) . "' target='_blank' class='btn btn-info btn-sm'>Laporan</a>
                                                        </td>";
                                                    echo "<td class='text-center'>
                                                            <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                                \"" . htmlspecialchars($row['id_kelahiran'], ENT_QUOTES) . "\",
                                                                \"" . htmlspecialchars($row['anak_id_penduduk'], ENT_QUOTES) . "\",
                                                                \"" . htmlspecialchars($row['ibu_id_penduduk'], ENT_QUOTES) . "\",
                                                                \"" . htmlspecialchars($row['bapa_id_penduduk'], ENT_QUOTES) . "\"
                                                            )'>Edit</button>
                                                        </td>";
                                                    echo "<td class='text-center'>
                                                            <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_kelahiran'], ENT_QUOTES) . "\")'>Hapus</button>
                                                        </td>";
                                                    echo "</tr>";

                                                    // Increment nomor urut
                                                    $counter++;
                                                }
                                            } else {
                                                echo "<td class='text-center' colspan='14'><h3>Gagal mengambil data dari database</h3></td>";
                                            }

                                            // Tutup koneksi ke database
                                            mysqli_close($koneksi);
                                            ?>
                                        </tbody>
                                    </table>