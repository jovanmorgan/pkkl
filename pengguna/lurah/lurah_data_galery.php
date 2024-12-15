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
                            <li class="search-bar input-group">
                                <button class="btn btn-link" id="search-button" data-toggle="modal"
                                    data-target="#searchModal"><i class="tim-icons icon-zoom-split"></i>
                                    <span class="d-lg-none d-md-block">Search</span>
                                </button>
                            </li>
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
                        <form action="" method="GET">
                            <div class="modal-header">
                                <input type="text" name="search_query" class="form-control" id="inlineFormInputGroup"
                                    placeholder="SEARCH">
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
            <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
                aria-hidden="true">
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
                            <form id="form_tambah" action="galery/tambah.php" method="POST"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Waktu :</label>
                                    <input type="datetime-local" class="form-control" id="tanggal" name="tanggal"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi :</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kover">Data Gambar :</label>
                                    <input type="file" class="form-control-file d-none" id="kover" name="foto"
                                        onchange="previewImage(this, 'koverPreview')" accept="image/*">
                                    <label class="btn btn-primary" for="kover">Pilih Gambar</label>
                                </div>

                                <div class="card" id="koverPreview" style="display: none;">
                                    <img class="card-img-top" id="koverImage" src="#" alt="Kover Image">
                                </div>
                                <script>
                                    function previewImage(input, previewId) {
                                        var preview = document.getElementById(previewId);
                                        var image = document.getElementById('koverImage');
                                        var file = input.files[0];
                                        var fileType = file.type;

                                        if (fileType.match('image.*')) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();

                                                reader.onload = function (e) {
                                                    image.src = e.target.result;
                                                    preview.style.display = 'block';
                                                }

                                                reader.readAsDataURL(input.files[0]);
                                            } else {
                                                image.src = '#';
                                                preview.style.display = 'none';
                                            }
                                        }
                                    }
                                </script>
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
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="font-size: 250%;">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk menambahkan atau mengedit data galery -->
                            <form id="form_edit" action="galery/edit.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="editid_galery" name="id_galery">
                                <div class="form-group">
                                    <label for="nama">Nama :</label>
                                    <input type="text" class="form-control" id="editnama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal :</label>
                                    <input type="datetime-local" class="form-control" id="edittanggal" name="tanggal"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi:</label>
                                    <textarea class="form-control" id="editdeskripsi" name="deskripsi"
                                        required></textarea>
                                </div>
                                <!-- Data Kover -->
                                <div class="form-group">
                                    <label for="kover">Data Kover:</label>
                                    <input type="file" class="form-control-file d-none" id="editKover" name="foto"
                                        onchange="previewImageAndSetExisting(this, 'editkoverPreview')"
                                        accept="image/*">
                                    <label class="btn btn-primary" for="editKover">Pilih Gambar</label>
                                </div>

                                <!-- Preview Kover -->
                                <div class="card" id="editkoverPreview" style="display: none;">
                                    <img class="card-img-top" id="editkoverImage" src="#" alt="Kover Image">
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
                function openEditModal(id_galery, nama, foto, tanggal, deskripsi) {
                    deskripsi_data = deskripsi.replace(/<br\s*\/?>/gi, '\n');
                    // Isi data ke dalam form edit
                    document.getElementById('editid_galery').value = id_galery;
                    document.getElementById('editnama').value = nama;
                    document.getElementById('edittanggal').value = tanggal;
                    document.getElementById('editdeskripsi').value = deskripsi_data;

                    // Menampilkan preview foto jika ada
                    if (foto !== '') {
                        var koverPreview = document.getElementById('editkoverPreview');
                        var koverImage = document.getElementById('editkoverImage');
                        koverImage.src = foto;
                        koverPreview.style.display = 'block';
                    }

                    // Membuka modal
                    $('#editModal').modal('show');
                }

                function previewImageAndSetExisting(input, previewId) {
                    var preview = document.getElementById(previewId);
                    var image = document.getElementById('editkoverImage');
                    var file = input.files[0];
                    var fileType = file.type;

                    if (fileType.match('image.*')) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                image.src = e.target.result;
                                preview.style.display = 'block';
                            }

                            reader.readAsDataURL(input.files[0]);
                        } else {
                            image.src = '#';
                            preview.style.display = 'none';
                        }
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
            </script>

            <?php
            include '../../keamanan/koneksi.php';
            ?>

            <div id="dataTable" class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="places-buttons">
                                    <div class="row">
                                        <div class="col-md-6 ml-auto mr-auto text-center">
                                            <h2 class="card-title">Data Galery</h2>
                                            <p class="category">Silakan lihat data data Galery</p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Galeri dari Database -->
                    <?php
                    // Ambil kata kunci pencarian dari URL jika ada
                    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
                    $sql = "SELECT id_galery, nama, foto, tanggal, deskripsi FROM galery";
                    // Jika ada kata kunci pencarian, tambahkan klausa WHERE untuk mencocokkan 
                    if (!empty($search_query)) {
                        $sql .= " WHERE nama LIKE '%$search_query%' OR tanggal LIKE '%$search_query%' OR deskripsi LIKE '%$search_query%'";
                    }
                    // Balik urutan data untuk memunculkan yang paling baru di atas
                    $sql .= " ORDER BY id_galery DESC";
                    $result = $koneksi->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_galery = $row['id_galery'];
                            $nama = $row['nama'];
                            $foto = str_replace('../../../', '../../', $row['foto']);
                            $tanggal_input = $row['tanggal'];
                            $tanggal = date('Y-m-d\TH:i', strtotime($tanggal_input));
                            $deskripsi = str_replace(array("\r", "\n"), '', nl2br($row['deskripsi']));
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card card-chart">
                                    <div class="card-header p-0">
                                        <img src="<?php echo htmlspecialchars($foto); ?>"
                                            alt="<?php echo htmlspecialchars($nama); ?>" class="img-fluid img-gallery"
                                            onclick="showImageModal('<?php echo htmlspecialchars($foto); ?>', '<?php echo htmlspecialchars($nama); ?>', '<?php echo htmlspecialchars($deskripsi); ?>')">
                                    </div>
                                    <div class="card-body text-center">
                                        <h5 class="card-category"><?php echo htmlspecialchars($nama); ?></h5>
                                        <p class="card-description"><?php echo $deskripsi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p class='col-12 text-center'>Tidak ada data galeri.</p>";
                    }

                    $koneksi->close();
                    ?>
                </div>
            </div>

            <!-- Modal untuk menampilkan gambar besar -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel" style="font-size: 250%;">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 240%;">&times;</span>
                            </button>
                        </div>
                        <hr>
                        <div class="card">
                            <img id="modalImage" src="" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function editGallery(id) {
                    // Tambahkan logika untuk mengedit galeri
                    console.log("Edit gallery with ID: " + id);
                }

                function deleteGallery(id) {
                    // Tambahkan logika untuk menghapus galeri
                    console.log("Delete gallery with ID: " + id);
                }

                function showImageModal(imgSrc, imgTitle, imgDesc) {
                    var modal = $('#imageModal');
                    modal.find('#modalImage').attr('src', imgSrc);
                    modal.find('.modal-title').text(imgTitle);
                    modal.find('#modalDescription').text(imgDesc);
                    modal.modal('show');
                }
            </script>
            <style>
                .img-gallery {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                    cursor: pointer;
                }

                .card-body {
                    padding: 20px;
                }

                .card-category {
                    font-size: 1.25em;
                    font-weight: bold;
                    margin-bottom: 10px;
                    color: #333;
                }

                .card-description {
                    font-size: 1em;
                    color: #666;
                    margin-bottom: 20px;
                }

                .btn-sm {
                    font-size: 0.875em;
                    padding: 5px 10px;
                }

                .card-chart {
                    transition: transform 0.3s, box-shadow 0.3s;
                }

                .card-chart:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
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

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('form_tambah').addEventListener('submit', function (event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);

                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'galery/tambah.php', true);
                xhr.onload = function () {
                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Berhasil!", "Data berhasil ditambahkan", "success");
                            // Reset form setelah berhasil
                            form.reset();
                            // Tutup modal setelah berhasil
                            document.getElementById('koverPreview').style.display = 'none';
                            $('#modalTambah').modal('hide');
                            // Muat ulang tabel
                            loadTable();
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!",
                                "Data username sudah digunakan silakan gunakan username lain",
                                "error");
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

        // logika untuk mengedit Data
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('form_edit').addEventListener('submit', function (event) {
                event.preventDefault(); // Menghentikan aksi default form submit

                var form = this;
                var formData = new FormData(form);
                // Tampilkan elemen .loading sebelum mengirimkan permintaan AJAX
                loding.style.display = 'flex';

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'galery/edit.php', true);
                xhr.onload = function () {

                    // Sembunyikan elemen .loading setelah permintaan AJAX selesai
                    loding.style.display = 'none';

                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'success') {
                            swal("Suksess!", "Data berhasil diedit", "success");
                            loadTable();
                            // Reset form setelah berhasil
                            document.getElementById('editkoverPreview').style.display = 'none';
                            form.reset();
                            // Tutup modal setelah berhasil
                            $('#editModal').modal('hide');
                        } else if (response === 'data_tidak_lengkap') {
                            swal("Error", "Data edit yang anda masukan belum lengkap", "error");
                        } else if (response === 'data_username_sudah_ada') {
                            swal("Username Salah!", "Data username sudah digunakan silakan gunakan username lain", "error");
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

                        xhr.open('POST', 'galery/hapus.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function () {

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
            xhrTable.onreadystatechange = function () {
                if (xhrTable.readyState == 4 && xhrTable.status == 200) {
                    // Perbarui konten tabel dengan respons dari server
                    document.getElementById('dataTable').innerHTML = xhrTable.responseText;
                }
            };
            xhrTable.open('GET', 'galery/load_table.php', true);
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