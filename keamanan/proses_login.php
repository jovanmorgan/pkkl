<?php
include 'koneksi.php';


function checkpengunjungType($username)
{
    global $koneksi;
    $query_admin = "SELECT * FROM admin WHERE username = '$username'";
    $query_pengunjung = "SELECT * FROM pengunjung WHERE username = '$username'";
    $query_lurah = "SELECT * FROM lurah WHERE username = '$username'";

    $result_admin = mysqli_query($koneksi, $query_admin);
    $result_pengunjung = mysqli_query($koneksi, $query_pengunjung);
    $result_lurah = mysqli_query($koneksi, $query_lurah);

    if (mysqli_num_rows($result_admin) > 0) {
        return "admin";
    } elseif (mysqli_num_rows($result_pengunjung) > 0) {
        return "pengunjung";
    } elseif (mysqli_num_rows($result_lurah) > 0) {
        return "lurah";
    } else {
        return "not_found";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
    if (empty($username) && empty($password)) {
        echo "tidak_ada_data";
        exit();
    }
    if (empty($username)) {
        echo "username_tidak_ada";
        exit();
    }

    if (empty($password)) {
        echo "password_tidak_ada";
        exit();
    }


    $pengunjungType = checkpengunjungType($username);
    if ($pengunjungType !== "not_found") {
        $query_pengunjung = "SELECT * FROM $pengunjungType WHERE username = '$username'";
        $result_pengunjung = mysqli_query($koneksi, $query_pengunjung);

        if (mysqli_num_rows($result_pengunjung) > 0) {
            $row = mysqli_fetch_assoc($result_pengunjung);
            $hashed_password = $row['password'];

            if ($password === $hashed_password) {

                // Process login for other pengunjung types
                session_start();
                $_SESSION['username'] = $username;

                switch ($pengunjungType) {
                    case "admin":
                        $_SESSION['id_admin'] = $row['id_admin'];
                        break;
                    case "pengunjung":
                        $_SESSION['id_pengunjung'] = $row['id_pengunjung'];
                        $id_pengunjung = $row['id_pengunjung'];
                        break;
                    case "lurah":
                        $_SESSION['id_lurah'] = $row['id_lurah'];
                        break;
                    default:
                        break;
                }

                // Success response
                switch ($pengunjungType) {
                    case "admin":
                        echo "success:" . $username . ":" . $pengunjungType . ":" . "../pengguna/admin/";
                        break;
                    case "pengunjung":
                        echo "success:" . $username . ":" . $pengunjungType . ":" . "../pengguna/pengunjung/";
                        break;
                    case "lurah":
                        echo "success:" . $username . ":" . $pengunjungType . ":" . "../pengguna/lurah/";
                        break;
                    default:
                        echo "success:" . $username . ":" . $pengunjungType . ":" . "../berlangganan/login";
                        break;
                }
            } else {
                echo "error_password";
            }
        } else {
            echo "error_username";
        }
    } else {
        echo "error_username";
    }
}
