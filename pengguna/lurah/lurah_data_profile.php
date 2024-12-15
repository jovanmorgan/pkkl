<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_lurah'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman lurah.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../images/logo_pkkl.png">
    <title>
        PKKL | lurah Dashboard
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
                        <img src="../../images/logo_pkkl.png" width="50px" alt=""
                            style="position: relative; bottom: 3px;">
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal position-relative"
                        style="font-size: 14px; font-weight: bold; font-style: italic; right: 10px; color: #ffffff;">
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
                        <a href="./lurah_home">
                            <i class="tim-icons icon-components"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./lurah_data_profile">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="./lurah_data_lurah">
                            <i class="fas fa-user-tie"></i>
                            <p>Lurah</p>
                        </a>
                    </li>
                    <li>
                        <a href="./lurah_data_penduduk">
                            <i class="tim-icons icon-bullet-list-67"></i>
                            <p>Penduduk</p>
                        </a>
                    </li>
                    <li>
                        <a href="./lurah_data_kematian">
                            <i class="tim-icons icon-alert-circle-exc"></i>
                            <p>Kematian</p>
                        </a>
                    </li>
                    <li>
                        <a href="./lurah_data_kelahiran">
                            <i class="tim-icons icon-badge"></i>
                            <p>Kelahiran</p>
                        </a>
                    </li>
                    <li>
                        <a href="./lurah_data_kartu_keluarga">
                            <i class="tim-icons icon-credit-card"></i>
                            <p>Kartu Keluarga</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./lurah_data_Report">
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard lurah</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <div class="photo">
                                        <?php
                                        // Lakukan koneksi ke database
                                        include '../../keamanan/koneksi.php';

                                        // Periksa apakah session id_lurah telah diset
                                        if (isset($_SESSION['id_lurah'])) {
                                            $id_lurah = $_SESSION['id_lurah'];

                                            // Query SQL untuk mengambil data lurah berdasarkan id_lurah dari session
                                            $query = "SELECT * FROM lurah WHERE id_lurah = '$id_lurah'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data lurah
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data lurah sebagai array asosiatif
                                                    $lurah = mysqli_fetch_assoc($result);
                                                    ?>
                                                    <?php if (!empty($lurah['fp'])): ?>
                                                        <img class="avatar" src="data_fp/<?php echo $lurah['fp']; ?>" alt="...">
                                                    <?php else: ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $lurah['id_lurah']; ?>
                                                    </h5>
                                                    <?php
                                                } else {
                                                    // Jika tidak ada data lurah
                                                    echo "Tidak ada data lurah.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data lurah: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_lurah tidak diset
                                            echo "Session id_lurah tidak tersedia.";
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
                                    <li class="nav-link"><a href="foto_profile"
                                            class="nav-item dropdown-item">Profile</a></li>
                                    <li class="nav-link"><a href="logout" class="nav-item dropdown-item">Log
                                            out</a></li>
                                </ul>
                            </li>
                            <li class="separator d-lg-none"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog"
                aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
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
                                            <h2 class="card-title stylish-title">
                                                Profile
                                            </h2>
                                            <hr>
                                            <p class="category">Halaman ini berisi tentang data galary dan sejara</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a href="./lurah_data_galery">
                            <div class="card card-chart hover-card">
                                <div class="card-header">
                                    <h5 class="card-category">Galery</h5>
                                </div>
                                <div class="card-body text-center">
                                    <i class="tim-icons icon-image-02" style="font-size: 5em; color: #ffaf40;"></i>
                                    <p>View our photo gallery</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="./lurah_data_sejara">
                            <div class="card card-chart hover-card">
                                <div class="card-header">
                                    <h5 class="card-category">Sejara Kantor Lurah Lasiana</h5>
                                </div>
                                <div class="card-body text-center">
                                    <i class="tim-icons icon-single-copy-04"
                                        style="font-size: 5em; color: #ffcc80;"></i>
                                    <p>Learn about our history</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <style>
                .hover-card {
                    transition: transform 0.3s, box-shadow 0.3s;
                }

                .hover-card:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
                }

                .card-body i {
                    display: block;
                    margin-bottom: 10px;
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
        $(document).ready(function () {
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