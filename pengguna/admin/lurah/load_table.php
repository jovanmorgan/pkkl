                                    <table class="table tablesorter " id="dataTable">
                                        <thead class="text-primary">
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center">NIP</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Username</th>
                                                <th class="text-center">Password</th>
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

                                            // Query SQL untuk mengambil data dari tabel lurah
                                            $query = "SELECT * FROM lurah";

                                            // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                                            if (!empty($search_query)) {
                                                $query .= " WHERE nama LIKE '%$search_query%' OR username LIKE '%$search_query%' OR nip LIKE '%$search_query%'";
                                            }

                                            // Balik urutan data untuk memunculkan yang paling baru di atas
                                            $query .= " ORDER BY id_lurah DESC";
                                            $result = mysqli_query($koneksi, $query);

                                            // Variabel untuk menyimpan nomor urut
                                            $counter = 1;

                                            // Cek jika query berhasil dieksekusi
                                            if ($result) {
                                                // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($counter, ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nip'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['nama'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['username'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>" . htmlspecialchars($row['password'], ENT_QUOTES) . "</td>";
                                                    echo "<td class='text-center'>
                        <button class='btn btn-primary btn-sm' onclick='openEditModal(
                            \"" . htmlspecialchars($row['id_lurah'], ENT_QUOTES) . "\",
                            \"" . htmlspecialchars($row['nip'], ENT_QUOTES) . "\",
                            \"" . htmlspecialchars($row['nama'], ENT_QUOTES) . "\",
                            \"" . htmlspecialchars($row['username'], ENT_QUOTES) . "\",
                            \"" . htmlspecialchars($row['password'], ENT_QUOTES) . "\"
                        )'>Edit</button>
                    </td>";
                                                    echo "<td class='text-center'>
                        <button class='btn btn-danger btn-sm' onclick='hapus(\"" . htmlspecialchars($row['id_lurah'], ENT_QUOTES) . "\")'>Hapus</button>
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