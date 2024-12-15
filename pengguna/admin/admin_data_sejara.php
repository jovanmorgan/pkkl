<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_admin'])) {
    // Pengguna belum login, arahkan kembali ke halaman masuk.php
    header("Location: ../../login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah login, Anda dapat melanjutkan menampilkan halaman admin.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/2-logo_pkkl.png">
    <title>
        sejara | Profile sejara
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
                        <a href="./admin_sejara">
                            <i class="tim-icons icon-components"></i>
                            <p>sejara</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./admin_data_profile">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Profile</p>
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
                    <li>
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

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">
                                                Data Sejarah
                                            </h2>
                                            <hr>
                                            <p class="category"> Halaman ini berfungsi untuk mengedit dan merubah data gambar dan text yang akan dimunculkan pada halaman Sejarah <br> Click data yang ingin diedit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel2" style="font-size: 250%;">Edit
                                        Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form untuk menambahkan atau mengedit data video -->
                                    <form id="editForm" action="profile/edit1.php" method="POST" enctype="multipart/form-data">
                                        <!-- Menambahkan input tersembunyi untuk menyimpan id_video saat mengedit -->
                                        <input type="hidden" id="id_sejara" name="id_sejara">
                                        <input type="hidden" id="gambar_sejara_lama" name="gambar_sejara_lama">
                                        <hr>
                                        <div class="form-group">
                                            <label for="editkover">Data Gambar :</label>
                                            <input type="file" class="form-control-file d-none" id="editkover" name="gambar_sejara" onchange="previewImageAndSetExisting(this, 'editkoverPreview1', 'editkoverImage1')">
                                            <label class="btn btn-primary" for="editkover">Pilih Gambar </label>
                                        </div>
                                        <hr>
                                        <div class="card" id="editkoverPreview1" style="display: none;">
                                            <img class="card-img-top" id="editkoverImage1" src="#" alt="Kover Image">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="simpan1">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal for gambar_struktur -->
                    <div class="modal fade" id="editModal2" tabindex="-2" role="dialog" aria-labelledby="editModalLabel2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel2" style="font-size: 250%;">Edit
                                        Struktur</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm2" action="profile/edit2.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" id="id_sejara2" name="id_sejara">
                                        <input type="hidden" id="gambar_struktur_lama" name="gambar_struktur_lama">
                                        <hr>
                                        <div class="form-group">
                                            <label for="editkover2">Data Gambar Struktur:</label>
                                            <input type="file" class="form-control-file d-none" id="editkover2" name="gambar_struktur" onchange="previewImageAndSetExisting2(this, 'editkoverPreview2', 'editkoverImage2')">
                                            <label class="btn btn-primary" for="editkover2">Pilih Gambar</label>
                                        </div>
                                        <hr>
                                        <div class="card" id="editkoverPreview2" style="display: none;">
                                            <img class="card-img-top" id="editkoverImage2" src="#" alt="Struktur Image">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="simpan2">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Edit Modal deskripsi-->
                    <div class="modal fade" id="editDeskripsiModal" tabindex="-1" role="dialog" aria-labelledby="editDeskripsiModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel2" style="font-size: 250%;">Edit Deskripsi
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm3" action="profile/edit3.php" method="POST">
                                        <input type="hidden" id="id_sejara3" name="id_sejara">
                                        <div class="form-group">
                                            <label for="deskripsiTextarea">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_sejara" id="deskripsiTextarea" rows="20" style="height: 400px;"></textarea>
                                        </div>
                                    </form>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="editDeskripsi">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal Visi dan Misi -->
                    <div class="modal fade" id="editVisiMisiModal" tabindex="-1" role="dialog" aria-labelledby="editVisiMisiModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel2" style="font-size: 250%;">Edit Visi &
                                        Misi
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm4" action="profile/edit4.php" method="POST">
                                        <input type="hidden" id="id_sejara4" name="id_sejara">
                                        <div class="form-group">
                                            <label for="visiTextarea">Visi</label>
                                            <textarea class="form-control" name="visi" id="visiTextarea" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="misiTextarea">Misi</label>
                                            <textarea class="form-control" name="misi" id="misiTextarea" rows="5"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="saveVisiMisiChanges">Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-body">
                                <section id="mu-course-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mu-course-content-area">
                                                    <div class="row">
                                                        <div class="col-md-18">
                                                            <!-- start course content container -->
                                                            <div class="mu-course-container mu-course-details">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mu-latest-course-single">
                                                                            <div id="dataGambar1">
                                                                                <?php
                                                                                include '../../keamanan/koneksi.php';

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

                                                                            </div>


                                                                            <style>
                                                                                .mu-latest-course-img {
                                                                                    position: relative;
                                                                                    display: inline-block;
                                                                                }

                                                                                .mu-latest-course-img img {
                                                                                    display: block;
                                                                                    width: 100%;
                                                                                    height: auto;
                                                                                }

                                                                                .mu-latest-course-imgcaption {
                                                                                    position: absolute;
                                                                                    top: 0;
                                                                                    left: 0;
                                                                                    width: 100%;
                                                                                    height: 100%;
                                                                                    background: rgba(0, 0, 0, 0.6);
                                                                                    /* Semi-transparent background */
                                                                                    display: flex;
                                                                                    align-items: center;
                                                                                    justify-content: center;
                                                                                    opacity: 0;
                                                                                    transition: opacity 0.3s ease;
                                                                                    color: white;
                                                                                    font-size: 1.5em;
                                                                                    text-align: center;
                                                                                }

                                                                                .mu-latest-course-img:hover .mu-latest-course-imgcaption {
                                                                                    opacity: 1;
                                                                                }

                                                                                .hover-text {
                                                                                    display: none;
                                                                                }

                                                                                .mu-latest-course-img:hover .hover-text {
                                                                                    display: block;
                                                                                }

                                                                                .edit-link {
                                                                                    display: block;
                                                                                    position: relative;
                                                                                    background-color: white;
                                                                                    color: black;
                                                                                    text-decoration: none;
                                                                                    padding: 20px;
                                                                                    border-radius: 5px;
                                                                                    transition: 0.5s all;
                                                                                }

                                                                                .edit-link .hover-text2 {
                                                                                    visibility: hidden;
                                                                                    opacity: 0;
                                                                                    position: absolute;
                                                                                    top: 50%;
                                                                                    left: 50%;
                                                                                    transform: translate(-50%, -50%);
                                                                                    background-color: rgba(0, 0, 0, 0.7);
                                                                                    color: black;
                                                                                    padding: 10px;
                                                                                    border-radius: 5px;
                                                                                    transition: 0.5s all;
                                                                                }

                                                                                .edit-link:hover .hover-text2 {
                                                                                    visibility: visible;
                                                                                    opacity: 1;
                                                                                    background-color: white;
                                                                                    color: black;
                                                                                }

                                                                                .edit-link:hover {
                                                                                    background-color: black;
                                                                                    color: #ffffff;
                                                                                }

                                                                                .content-to-edit {
                                                                                    position: relative;
                                                                                }
                                                                            </style>
                                                                            <div class="mu-latest-course-single-content">
                                                                                <h2>Pelayanan Kependudukan Kelurahan Lasiana</h2>
                                                                                <div id="data3">
                                                                                    <?php
                                                                                    include '../../keamanan/koneksi.php';

                                                                                    $sql = "SELECT id_sejara, deskripsi_sejara FROM sejara";
                                                                                    $result = $koneksi->query($sql);
                                                                                    if ($result->num_rows > 0) {
                                                                                        while ($row = $result->fetch_assoc()) {
                                                                                            $id_sejara = $row['id_sejara'];
                                                                                            // Mengganti newline menjadi <br>
                                                                                            $deskripsi_sejara = nl2br(htmlspecialchars($row['deskripsi_sejara'], ENT_QUOTES));
                                                                                            // Mengganti newline dengan <br> dan menghapus baris baru
                                                                                            $deskripsi_sejara_sambung = str_replace(array("\r", "\n"), '', $deskripsi_sejara);
                                                                                    ?>
                                                                                            <a href="#" class="edit-link" onclick="openEditModal3(<?php echo $id_sejara; ?>, '<?php echo $deskripsi_sejara_sambung; ?>')">
                                                                                                <div class="content-to-edit">
                                                                                                    <h4><b> Sejarah </b></h4>
                                                                                                    <p><?php echo $deskripsi_sejara; ?></p>
                                                                                                    <span class="hover-text2 text-center">Klik untuk mengedit</span>
                                                                                                </div>
                                                                                            </a>
                                                                                    <?php
                                                                                        }
                                                                                    } else {
                                                                                        echo "Tidak ada data.";
                                                                                    }

                                                                                    $koneksi->close();
                                                                                    ?>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end course content container -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
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
                </script> Dibuat Oleh FEBRIANI
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
            background-color: #0650a5;
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

        function openEditModal(id_gambar, gambar_sejara) {
            // Isi data ke dalam form edit
            document.getElementById('id_sejara').value = id_gambar;

            // Simpan URL gambar saat ini
            document.getElementById('gambar_sejara_lama').value = gambar_sejara;

            // Menampilkan preview gambar_sejara jika ada
            if (gambar_sejara !== '') {
                var koverImage = document.getElementById('editkoverImage1');
                koverImage.src = gambar_sejara;
                document.getElementById('editkoverPreview1').style.display = 'block';
            }

            $('#editModal').modal('show');
        }

        // Setel event listener untuk tombol Save
        document.getElementById('simpan1').addEventListener('click', function(event) {
            var fileInput = document.getElementById('editkover');
            // Periksa apakah pengguna memilih gambar baru
            if (fileInput.files.length === 0) {
                // Tampilkan pesan SweetAlert bahwa tidak ada perubahan yang dilakukan
                swal("Info", "Tidak ada perubahan yang dilakukan", "info");
                event.preventDefault(); // Mencegah form submit
            }
        });

        function previewImageAndSetExisting(input, previewId, inputId) {
            var preview = document.getElementById(previewId);
            var image = document.getElementById(inputId);
            var file = input.files[0];
            var fileType = file.type;

            if (fileType.match('image.*')) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        image.src = e.target.result;
                        preview.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    image.src = '#';
                    preview.style.display = 'none';
                }

                // Setel nilai input tersembunyi untuk menyimpan URL gambar lama menjadi string kosong
                document.getElementById('gambar_sejara_lama').value = '';
            } else {
                $.notify({
                    icon: "tim-icons icon-bell-55",
                    message: "Mohon pilih file gambar.",
                }, {
                    type: 'danger',
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'center'
                    }
                });
                input.value = '';
            }
        }

        // logika untuk mengedit data info
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('editForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'profile/edit1.php', true);
                xhr.onload = function() {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data berhasil diedit", "success");
                            loadTable1();
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#editModal').modal('hide');
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap",
                                "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!",
                                "Data username sudah digunakan silakan gunakan username lain",
                                "error");
                        } else {
                            swal("Error", "Gagal mengedit data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        function loadTable1() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten dengan respons dari server
                    document.getElementById('dataGambar1').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'profile/load_edit1.php', true);
            xhrTable.send();
        }


        function openEditModal2(id_gambar2, gambar_struktur) {
            // Isi data ke dalam form edit
            document.getElementById('id_sejara2').value = id_gambar2;
            document.getElementById('gambar_struktur_lama').value = gambar_struktur;

            // Menampilkan preview gambar_struktur jika ada
            if (gambar_struktur !== '') {
                var koverImage2 = document.getElementById('editkoverImage2');
                koverImage2.src = gambar_struktur;
                document.getElementById('editkoverPreview2').style.display = 'block';
            }

            $('#editModal2').modal('show');
        }

        // Setel event listener untuk tombol Save pada editForm2
        document.getElementById('simpan2').addEventListener('click', function(event) {
            var fileInput = document.getElementById('editkover2');
            if (fileInput.files.length === 0) {
                swal("Info", "Tidak ada perubahan yang dilakukan", "info");
                event.preventDefault(); // Mencegah form submit
            }
        });

        function previewImageAndSetExisting2(input, previewId, inputId) {
            var preview = document.getElementById(previewId);
            var image = document.getElementById(inputId);
            var file = input.files[0];
            var fileType = file.type;

            if (fileType.match('image.*')) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        image.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    image.src = '#';
                    preview.style.display = 'none';
                }
                document.getElementById('gambar_struktur_lama').value = '';
            } else {
                $.notify({
                    icon: "tim-icons icon-bell-55",
                    message: "Mohon pilih file gambar.",
                }, {
                    type: 'danger',
                    timer: 3000,
                    placement: {
                        from: 'top',
                        align: 'center'
                    }
                });
                input.value = '';
            }
        }

        // Logika untuk mengedit data gambar_struktur
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('editForm2').addEventListener('submit', function(event) {
                event.preventDefault(); // Menghentikan aksi default form submit
                var form = this;
                var formData = new FormData(form);
                loding.style.display =
                    'flex'; // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'profile/edit2.php', true);
                xhr.onload = function() {
                    loding.style.display =
                        'none'; // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data berhasil diedit", "success");
                            loadTable2(); // Memuat ulang tabel
                            form.reset();
                            $('#editModal2').modal('hide'); // Tutup modal setelah berhasil
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!",
                                "Data username sudah digunakan silakan gunakan username lain",
                                "error");
                        } else {
                            swal("Error", "Gagal mengedit data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        function loadTable2() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    document.getElementById('dataGambar2').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'profile/load_edit2.php', true);
            xhrTable.send();
        }

        function openEditModal3(id_sejara, deskripsi_sejara) {
            // Ubah <br> kembali menjadi newline (\n)
            deskripsi_sejara = deskripsi_sejara.replace(/<br\s*\/?>/gi, '\n');

            // Set value dari deskripsi_sejara ke dalam textarea modal
            document.getElementById('id_sejara3').value = id_sejara;
            document.getElementById('deskripsiTextarea').value = deskripsi_sejara;

            // Tampilkan modal
            $('#editDeskripsiModal').modal('show');


        }


        document.addEventListener('DOMContentLoaded', function() {
            // Event listener untuk tombol Save changes
            document.getElementById('editDeskripsi').addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah aksi default tombol submit

                // Mendapatkan nilai textarea
                var deskripsiTextarea = document.getElementById('deskripsiTextarea').value;

                // Mengubah newline menjadi tag <br>
                var deskripsi_sejara = deskripsiTextarea.replace(/\n/g, '<br>');

                // Setel nilai textarea yang sudah diubah ke dalam form
                document.getElementById('deskripsiTextarea').value = deskripsi_sejara;

                // Mengirim formulir
                var form = document.getElementById('editForm3');
                var formData = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'profile/edit3.php', true);
                xhr.onload = function() {
                    loding.style.display =
                        'none'; // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data berhasil diedit", "success");
                            loadTable3(); // Memuat ulang tabel
                            form.reset();
                            $('#editDeskripsiModal').modal('hide'); // Tutup modal setelah berhasil
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!",
                                "Data username sudah digunakan silakan gunakan username lain",
                                "error");
                        } else {
                            swal("Error", "Gagal mengedit data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });

            // Event listener untuk key press di textarea
            document.getElementById('deskripsiTextarea').addEventListener('keypress', function(event) {
                // Jika tombol "Enter" ditekan
                if (event.keyCode === 13) {
                    // Mencegah input default (perubahan baris)
                    event.preventDefault();

                    // Mendapatkan nilai textarea
                    var textareaValue = this.value;

                    // Mendapatkan posisi kursor dalam teks
                    var caretPos = this.selectionStart;

                    // Menambahkan newline (\n) pada posisi kursor
                    var newValue = textareaValue.substring(0, caretPos) + '\n' + textareaValue.substring(
                        caretPos);

                    // Menetapkan nilai yang baru ke dalam textarea
                    this.value = newValue;
                }
            });
        });

        function loadTable3() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    document.getElementById('data3').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'profile/load_edit3.php', true);
            xhrTable.send();
        }

        function openEditModal4(id_sejara, visi, misi) {
            // Set value dari visi dan misi ke dalam textarea modal
            document.getElementById('id_sejara4').value = id_sejara;
            document.getElementById('visiTextarea').value = visi.replace(/<br\s*\/?>/gi, '\n');
            document.getElementById('misiTextarea').value = misi.replace(/<br\s*\/?>/gi, '\n');
            // Tampilkan modal
            $('#editVisiMisiModal').modal('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('saveVisiMisiChanges').addEventListener('click', function() {
                // Mengubah newline menjadi tag <br> sebelum disimpan
                var visiTextarea = document.getElementById('visiTextarea').value.replace(/\n/g, '<br>');
                var misiTextarea = document.getElementById('misiTextarea').value.replace(/\n/g, '<br>');

                // Setel nilai textarea yang sudah diubah ke dalam form
                document.getElementById('visiTextarea').value = visiTextarea;
                document.getElementById('misiTextarea').value = misiTextarea;

                // Mengirim formulir
                var form = document.getElementById('editForm4');
                var formData = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'profile/edit4.php', true);
                xhr.onload = function() {
                    loding.style.display =
                        'none'; // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data berhasil diedit", "success");
                            loadTable4(); // Memuat ulang tabel
                            form.reset();
                            $('#editVisiMisiModal').modal('hide'); // Tutup modal setelah berhasil
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!",
                                "Data username sudah digunakan silakan gunakan username lain",
                                "error");
                        } else {
                            swal("Error", "Gagal mengedit data", "error");
                        }
                    } else {
                        swal("Error", "Terjadi kesalahan saat mengirim data", "error");
                    }
                };
                xhr.send(formData);
            });
        });

        function loadTable4() {
            var xhrTable = new XMLHttpRequest();
            xhrTable.onreadystatechange = function() {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    document.getElementById('data4').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'profile/load_edit4.php', true);
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
            $().ready(function() {
                $sidebar = $('.sidebar');
                $navbar = $('.navbar');
                $main_panel = $('.main-panel');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;
                white_color = false;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



                $('.fixed-plugin a').click(function(event) {
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data', new_color);
                    }

                    if ($main_panel.length != 0) {
                        $main_panel.attr('data', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data', new_color);
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        blackDashboard.showSidebarMessage('Sidebar mini activated...');
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });

                $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (white_color == true) {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').removeClass('white-content');
                        }, 900);
                        white_color = false;
                    } else {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').addClass('white-content');
                        }, 900);

                        white_color = true;
                    }


                });

                $('.light-badge').click(function() {
                    $('body').addClass('white-content');
                });

                $('.dark-badge').click(function() {
                    $('body').removeClass('white-content');
                });
            });
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