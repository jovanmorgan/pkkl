<?php
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_pengunjung'])) {
    // Pengguna belum masuk, arahkan kembali ke halaman masuk.php
    header("Location: ../../berlangganan/login");
    exit; // Pastikan untuk menghentikan eksekusi skrip setelah mengarahkan
}

// Jika pengguna sudah masuk, Anda dapat melanjutkan menampilkan halaman pengunjung.php seperti biasa
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../images/logo_pkkl.png">
    <title>
        PKKL | pengunjung Dashboard
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
                    <li class="active">
                        <a href="./dashboard">
                            <i class="tim-icons icon-chart-pie-36"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_home">
                            <i class="tim-icons icon-components"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_data_profile">
                            <i class="tim-icons icon-single-02"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_data_lurah">
                            <i class="fas fa-user-tie"></i>
                            <p>Lurah</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_data_penduduk">
                            <i class="tim-icons icon-bullet-list-67"></i>
                            <p>Penduduk</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_data_kematian">
                            <i class="tim-icons icon-alert-circle-exc"></i>
                            <p>Kematian</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_data_kelahiran">
                            <i class="tim-icons icon-badge"></i>
                            <p>Kelahiran</p>
                        </a>
                    </li>
                    <li>
                        <a href="./pengunjung_data_kartu_keluarga">
                            <i class="tim-icons icon-credit-card"></i>
                            <p>Kartu Keluarga</p>
                        </a>
                    </li>
                    <li style="opacity: 0;">
                        <a href="./pengunjung_data_Report">
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
                        <a class="navbar-brand" href="javascript:void(0)">Dashboard pengunjung</a>
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

                                        // Periksa apakah session id_pengunjung telah diset
                                        if (isset($_SESSION['id_pengunjung'])) {
                                            $id_pengunjung = $_SESSION['id_pengunjung'];

                                            // Query SQL untuk mengambil data pengunjung berdasarkan id_pengunjung dari session
                                            $query = "SELECT * FROM pengunjung WHERE id_pengunjung = '$id_pengunjung'";
                                            $result = mysqli_query($koneksi, $query);

                                            // Periksa apakah query berhasil dieksekusi
                                            if ($result) {
                                                // Periksa apakah terdapat data pengunjung
                                                if (mysqli_num_rows($result) > 0) {
                                                    // Ambil data pengunjung sebagai array asosiatif
                                                    $pengunjung = mysqli_fetch_assoc($result);
                                                    ?>
                                                    <?php if (!empty($pengunjung['fp'])): ?>
                                                        <img class="avatar" src="data_fp/<?php echo $pengunjung['fp']; ?>" alt="...">
                                                    <?php else: ?>
                                                        <img class="avatar" src="../../assets/img/anime3.png" alt="Profile Photo">
                                                    <?php endif; ?>
                                                    <h5 class="title">
                                                        <?php echo $pengunjung['id_pengunjung']; ?>
                                                    </h5>
                                                    <?php
                                                } else {
                                                    // Jika tidak ada data pengunjung
                                                    echo "Tidak ada data pengunjung.";
                                                }
                                            } else {
                                                // Jika query tidak berhasil dieksekusi
                                                echo "Gagal mengambil data pengunjung: " . mysqli_error($koneksi);
                                            }
                                        } else {
                                            // Jika session id_pengunjung tidak diset
                                            echo "Session id_pengunjung tidak tersedia.";
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
                                        <div class="col-md-12 text-center">
                                            <h2 class="card-title stylish-title">
                                                Selamat Datang Di Website Pelayanan Kependudukan Kelurahan Lasiana Kota
                                                Kupang
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                        .stylish-title {
                            font-family: 'Arial Black', Gadget, sans-serif;
                            font-size: 2em;
                            color: #2c3e50;
                            text-transform: uppercase;
                            letter-spacing: 2px;
                            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
                            background: linear-gradient(to right, #ffaf40, #ffcc80);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            padding: 10px 0;
                            width: 100%;
                        }

                        .card-chart {
                            transition: transform 0.3s, box-shadow 0.3s;
                            cursor: pointer;
                        }

                        .card-chart:hover {
                            transform: translateY(-10px);
                            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
                        }

                        .card-category {
                            font-weight: bold;
                            color: #ffaf40;
                        }

                        .card-title i {
                            font-size: 2em;
                            margin-right: 10px;
                            color: #ffcc80;
                        }

                        .card-body p {
                            margin: 0;
                            font-size: 1.1em;
                        }
                    </style>

                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./dashboard'">
                            <div class="card-header">
                                <h5 class="card-category">Total Dashboard</h5>
                                <h3 class="card-title"><i class="tim-icons icon-chart-pie-36"></i>5 Data</h3>
                            </div>
                            <div class="card-body p-4">
                                Dashboard pengunjung pada Pelayanan Kependudukan Kelurahan Lasiana
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./pengunjung_data_penduduk'">
                            <div class="card-header">
                                <h5 class="card-category">Total Penduduk</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_penduduk = "SELECT COUNT(*) AS total_penduduk FROM penduduk";
                                $result_count_penduduk = mysqli_query($koneksi, $query_count_penduduk);

                                if ($result_count_penduduk) {
                                    $row_count_penduduk = mysqli_fetch_assoc($result_count_penduduk);
                                    $total_data_penduduk = $row_count_penduduk['total_penduduk'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-bullet-list-67'></i> $total_data_penduduk Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data penduduk pada Pelayanan Kependudukan Kelurahan Lasiana
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./pengunjung_data_kematian'">
                            <div class="card-header">
                                <h5 class="card-category">Total Kematian</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_kematian = "SELECT COUNT(*) AS total_kematian FROM kematian";
                                $result_count_kematian = mysqli_query($koneksi, $query_count_kematian);

                                if ($result_count_kematian) {
                                    $row_count_kematian = mysqli_fetch_assoc($result_count_kematian);
                                    $total_data_kematian = $row_count_kematian['total_kematian'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-alert-circle-exc'></i> $total_data_kematian Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data kematian pada Pelayanan Kekematianan Kelurahan Lasiana
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./pengunjung_data_kelahiran'">
                            <div class="card-header">
                                <h5 class="card-category">Total Kelahiran</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_kelahiran = "SELECT COUNT(*) AS total_kelahiran FROM kelahiran";
                                $result_count_kelahiran = mysqli_query($koneksi, $query_count_kelahiran);

                                if ($result_count_kelahiran) {
                                    $row_count_kelahiran = mysqli_fetch_assoc($result_count_kelahiran);
                                    $total_data_kelahiran = $row_count_kelahiran['total_kelahiran'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-badge'></i> $total_data_kelahiran Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data kelahiran pada Pelayanan Kekelahiranan Kelurahan Lasiana
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="location.href='./pengunjung_data_kk'">
                            <div class="card-header">
                                <h5 class="card-category">Total KK</h5>
                                <?php
                                include '../../keamanan/koneksi.php';

                                $query_count_kk = "SELECT COUNT(*) AS total_kk FROM kk";
                                $result_count_kk = mysqli_query($koneksi, $query_count_kk);

                                if ($result_count_kk) {
                                    $row_count_kk = mysqli_fetch_assoc($result_count_kk);
                                    $total_data_kk = $row_count_kk['total_kk'];

                                    echo "<h3 class='card-title'><i class='tim-icons icon-credit-card'></i> $total_data_kk Data</h3>";
                                } else {
                                    echo "<h3 class='font-weight-bolder'>Error</h3>";
                                }

                                mysqli_close($koneksi);
                                ?>
                            </div>
                            <div class="card-body p-4">
                                Jumlah data KK pada Pelayanan Kekkan Kelurahan Lasiana
                            </div>
                        </div>
                    </div>


                </div>
            </div>
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