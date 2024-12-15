<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../images/logo_pkkl.png">
    <title>
        PKKL | Kelahiran
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="../../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../../assets/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="white-content">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper badge-warning">
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <img src="../../images/logo_pkkl.png" width="50px" alt="" style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative" style="font-size: 14px; font-weight: bold; font-style: italic; right: 10px; color: #ffffff;">
                        PKKL
                    </a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="./dashboard">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_home">
                            <i class="tim-icons icon-components"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_profile">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_lurah">
                            <i class="fas fa-user-tie"></i>
                            <p>Lurah</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_penduduk">
                            <i class="tim-icons icon-bullet-list-67"></i>
                            <p>Penduduk</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_kematian">
                            <i class="tim-icons icon-alert-circle-exc"></i>
                            <p>Kematian</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./admin_data_kelahiran">
                            <i class="tim-icons icon-badge"></i>
                            <p>Kelahiran</p>
                        </a>
                    </li>
                    <li>
                        <a href="./admin_data_kartu_keluarga">
                            <i class="tim-icons icon-credit-card"></i>
                            <p>Kartu Keluarga</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./admin_data_Report">
                            <i class="tim-icons icon-chart-bar-32"></i>
                            <p>Data</p>
                        </a>
                    </li>
                    <br>
                    <br>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard Admin</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../../keamanan/koneksi.php';

                                        // Periksa apakah session id_admin telah diset
                                        if (isset($_SESSION['id_admin'])) {
                                            $id_admin = $_SESSION['id_admin'];

                                            // Query SQL untuk mengambil data admin berdasarkan id_admin dari session
                                            $query = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data admin
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data admin sebagai array asosiatif
                                                    $admin = mysqli_fetch_assoc($result);
                                        ?>
                                                    <?php if (!empty($admin['fp'])) : ?>
                                                        <img class="avatar" src="data_fp/<?php echo $admin['fp']; ?>" alt="...">
                                                    <?php else : ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $admin['id_admin']; ?>
                                                    </h5>
                                        <?php
                                                } else {
                                                    // Jika tidak ada data admin
                                                    echo "Tidak ada data admin.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data admin: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_admin tidak diset
                                            echo "Session id_admin tidak tersedia.";
                                        }

                                        // Tutup koneksi ke database
                                        mysqli_close($koneksi);
                                        ?>

                                    </div>
                                    <b class="caret d-none d-lg-block d-xl-block"></b>
                                    <p class="d-lg-none">
                                        Log out
                                    </p>
                                </a>
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li class="nav-link"><a href="foto_profile" class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="GET">
                            <div class="modal-header">
                                <input type="text" name="search_query" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Navbar -->

            <!-- Modal Tambah Data Tamabh -->
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambah" style="font-size: 250%;">Tambah
                                Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan data tambah -->
                            <form id="form_tambah" action="kelahiran/tambah.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="anak_id_penduduk">Anak :</label>
                                    <select class="form-control" id="anak_id_penduduk" name="anak_id_penduduk" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data penduduk
                                        $query = "SELECT id_penduduk, nama FROM penduduk";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_penduduk'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ibu_id_penduduk">Ibu :</label>
                                    <select class="form-control" id="ibu_id_penduduk" name="ibu_id_penduduk" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data penduduk
                                        $query = "SELECT id_penduduk, nama FROM penduduk";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_penduduk'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bapa_id_penduduk">Ayah :</label>
                                    <select class="form-control" id="bapa_id_penduduk" name="bapa_id_penduduk" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data penduduk
                                        $query = "SELECT id_penduduk, nama FROM penduduk";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_penduduk'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="font-size: 250%;">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan atau mengedit data kelahiran -->
                            <form id="form_edit" action="kelahiran/edit.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="editid_kelahiran" name="id_kelahiran">
                                <div class="form-group">
                                    <label for="anak_id_penduduk">Anak :</label>
                                    <select class="form-control" id="editanak_id_penduduk" name="anak_id_penduduk" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data penduduk
                                        $query = "SELECT id_penduduk, nama FROM penduduk";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_penduduk'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ibu_id_penduduk">Ibu :</label>
                                    <select class="form-control" id="editibu_id_penduduk" name="ibu_id_penduduk" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data penduduk
                                        $query = "SELECT id_penduduk, nama FROM penduduk";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_penduduk'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bapa_id_penduduk">Ayah :</label>
                                    <select class="form-control" id="editbapa_id_penduduk" name="bapa_id_penduduk" required>
                                        <option value="" selected>Silakan Pilih</option>
                                        <?php
                                        // Menggunakan include untuk menyertakan file koneksi
                                        include '../../keamanan/koneksi.php';

                                        // Query untuk mendapatkan data penduduk
                                        $query = "SELECT id_penduduk, nama FROM penduduk";
                                        $result = $koneksi->query($query);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                            // Loop melalui hasil query dan tambahkan setiap opsi ke dalam select
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id_penduduk'] . "'>" . $row['nama'] . "</option>";
                                            }
                                            // Bebaskan hasil query
                                            $result->free();
                                        } else {
                                            echo "Gagal mengeksekusi query: " . $koneksi->error;
                                        }

                                        // Tutup koneksi
                                        $koneksi->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="addEditVideoForm">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- js edit -->
            <script>
                function openEditModal(id_kelahiran, anak_id_penduduk, ibu_id_penduduk, bapa_id_penduduk) {
                    // Isi data ke dalam form edit
                    document.getElementById('editid_kelahiran').value = id_kelahiran;
                    document.getElementById('editanak_id_penduduk').value = anak_id_penduduk;
                    document.getElementById('editibu_id_penduduk').value = ibu_id_penduduk;
                    document.getElementById('editbapa_id_penduduk').value = bapa_id_penduduk;
                    $('#editModal').modal('show');
                }
            </script>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data kelahiran
                                            </h2>

                                            <p class="category">Clik untuk menambah data kelahiran</p>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 ml-auto mr-auto">
                                            <div class="row justify-content-center align-items-center">
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambah">Tambah </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="table-responsive">
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
                                            include '../../keamanan/koneksi.php';

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .button-like {
                    display: inline-block;
                    padding: 7px 20px;
                    background-color: #007bff;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    cursor: default;
                    color: #fff;
                }
            </style>
            <footer class="footer">
                <div class="container-fluid">
                    <ul class="nav">

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link">
                                About Us
                            </a>
                        </li>

                    </ul>
                    <div class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Dibuat Oleh Sherly
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--=============== LOADING ===============-->
    <div class="loading">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <style>
        .loading {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            /* Mula-mula, loading disembunyikan */
            justify-content: center;
            align-items: center;
            z-index: 9999;
            /* Menempatkan loading di atas elemen lain */
            height: 100vh;
            width: 100vw;
            background-color: rgba(255, 255, 255, 0.932);
            /* Menambahkan latar belakang semi transparan */
        }

        .circle {
            width: 20px;
            height: 20px;
            background-color: #41a506;
            border-radius: 50%;
            margin: 0 10px;
            animation: bounce 0.5s infinite alternate;
        }

        .circle:nth-child(2) {
            animation-delay: 0.2s;
        }

        .circle:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-20px);
            }
        }
    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        const loding = document.querySelector('.loading');
        document.addEventListener('DOMContentLoaded', function() {
            const anakSelect = document.getElementById('anak_id_penduduk');
            const ibuSelect = document.getElementById('ibu_id_penduduk');
            const ayahSelect = document.getElementById('bapa_id_penduduk');

            function updateOptions() {
                const selectedAnak = anakSelect.value;
                const selectedIbu = ibuSelect.value;
                const selectedAyah = ayahSelect.value;

                const options = document.querySelectorAll('#anak_id_penduduk option, #ibu_id_penduduk option, #bapa_id_penduduk option');

                options.forEach(option => {
                    if (option.value && (option.value === selectedAnak || option.value === selectedIbu || option.value === selectedAyah)) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                });
            }

            anakSelect.addEventListener('change', updateOptions);
            ibuSelect.addEventListener('change', updateOptions);
            ayahSelect.addEventListener('change', updateOptions);

            updateOptions();
        });
        document.addEventListener('DOMContentLoaded', function() {
            const anakSelect = document.getElementById('editanak_id_penduduk');
            const ibuSelect = document.getElementById('editibu_id_penduduk');
            const ayahSelect = document.getElementById('editbapa_id_penduduk');

            function updateOptions2() {
                const selectedAnak = anakSelect.value;
                const selectedIbu = ibuSelect.value;
                const selectedAyah = ayahSelect.value;

                const options = document.querySelectorAll('#editanak_id_penduduk option, #editibu_id_penduduk option, #editbapa_id_penduduk option');

                options.forEach(option => {
                    if (option.value && (option.value === selectedAnak || option.value === selectedIbu || option.value === selectedAyah)) {
                        option.disabled = true;
                    } else {
                        option.disabled = false;
                    }
                });
            }

            anakSelect.addEventListener('change', updateOptions);
            ibuSelect.addEventListener('change', updateOptions);
            ayahSelect.addEventListener('change', updateOptions);

            updateOptions2();
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_tambah').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var anakId = document.getElementById('anak_id_penduduk').value;
                var ibuId = document.getElementById('ibu_id_penduduk').value;
                var bapaId = document.getElementById('bapa_id_penduduk').value;

                var formData = new FormData();
                formData.append('anak_id_penduduk', anakId);
                formData.append('ibu_id_penduduk', ibuId);
                formData.append('bapa_id_penduduk', bapaId);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                fetch('kelahiran/tambah.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                        loding.style.display = 'none';

                        if (data.trim() === 'success') {
                            form.reset();
                            $('#modalTambah').modal('hide');
                            loadTable();

                            swal("Berhasil!", "Data berhasil ditambahkan", "success").then(() => {
                                refreshDropdownOptions();
                            });
                        } else if (data.trim() === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (data.trim() === 'data_anak_sudah_ada') {
                            swal("Error", "Data kelahiran Pada Penduduk Sudah Ada!", "info");
                        } else {
                            swal("Error", "Gagal menambahkan data", "error");
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    });
            });

        });

        // Fungsi untuk memperbarui opsi dropdown setelah data berhasil terkirim
        function refreshDropdownOptions() {
            const options = document.querySelectorAll('#anak_id_penduduk option, #ibu_id_penduduk option, #bapa_id_penduduk option');

            options.forEach(option => {
                option.disabled = false;
            });

            // Panggil fungsi updateOptions() jika diperlukan
            updateOptions();
        }

        // Fungsi untuk memperbarui opsi dropdown setelah data berhasil terkirim pada popup edit
        function refreshDropdownOptions2() {
            const options = document.querySelectorAll('#editanak_id_penduduk option, #editibu_id_penduduk option, #editbapa_id_penduduk option');

            options.forEach(option => {
                option.disabled = false;
            });

            // Panggil fungsi updateOptions2() jika diperlukan
            updateOptions2();
        }

        // logika untuk mengedit Data
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form_edit').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'kelahiran/edit.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText.trim();
                        console.log(response); // Debugging

                        if (response === 'success') {
                            form.reset();
                            $('#editModal').modal('hide');
                            loadTable();
                            swal("Berhasil!", "Data berhasil ditambahkan", "success").then(() => {
                                refreshDropdownOptions2(); // Panggil fungsi refreshDropdownOptions2() setelah data berhasil diperbarui
                            });
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_anak_sudah_ada') {
                            swal("Error", "Data kelahiran Pada Penduduk Sudah Ada!", "info");
                        } else {
                            swal("Error", "Gagal menambahkan data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });


        // logika untuk menghapus data video
        function hapus(id) {
            swal({
                    title: "Apakah Anda yakin?",
                    text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                    icon: "warning",
                    buttons: ["Batal", "Ya, hapus!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        // Jika pengguna mengonfirmasi untuk menghapus
                        var xhr = new XMLHttpRequest();

                        // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                        loding.style.display = 'flex';

                        xhr.open('POST', 'kelahiran/hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {

                            // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                            loding.style.display = 'none';

                            if (xhr.status === 200) {
                                var response = xhr.responseText;
                                if (response === 'success') {
                                    swal("Sukses!", "Data berhasil dihapus.", "success")
                                    loadTable();
                                } else {
                                    swal("Error", "Gagal menghapus Data.", "error");
                                }
                            } else {
                                swal("Error", "Terjadi kesalahan saat mengirim data.", "error");
                            }
                        };
                        xhr.send("id=" + id);
                    } else {
                        // Jika pengguna membatalkan penghapusan
                        swal("Penghapusan dibatalkan", {
                            icon: "info",
                        });
                    }
                });
        }


        function loadTable() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('dataTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'kelahiran/load_table.php', true);
            xhrTable.send();
        }
    </script>


    <!--   Core JS Files   -->
    <script src="../../assets/js/core/jquery.min.js"></script>
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../assets/js/black-dashboard.min.js?v=1.0.0"></script>
    <!-- Black Dashboard DEMO methods, don't include it in your project! -->
    <script src="../../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "black-dashboard-free"
            });
    </script>
</body>

</html>