
<?php
require('../../../fpdf/fpdf.php'); // Ganti dengan path yang benar

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../../../images/logo_pkkl.png', 10, 6, 26); // Ganti 'path/to/logo_pkkl.png' dengan path yang benar
        // Times New Roman regular 16
        $this->SetFont('Times', '', 16);
        // Judul
        $this->Cell(0, 7, 'PEMERINTAH KOTA KUPANG', 0, 1, 'C');
        $this->Cell(0, 7, 'KECAMATAN KELAPA LIMA', 0, 1, 'C');
        $this->Cell(0, 7, 'KELURAHAN LASIANA', 0, 1, 'C');
        // Garis di bawah judul
        $this->Ln(2); // Mengurangi jarak antar judul
        $this->Cell(0, 0, '', 'T');
        $this->Ln(10);
    }

    function Footer()
    {
        // Posisi 1,5 cm dari bawah
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Nomor halaman
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Lakukan koneksi ke database
include '../../../keamanan/koneksi.php';

// Ambil id_kematian dari parameter URL
$id_kematian = isset($_GET['id_kematian']) ? $_GET['id_kematian'] : '';

// Query SQL untuk mengambil data kematian berdasarkan id_kematian
$query_kematian = "SELECT * FROM kematian WHERE id_kematian = '$id_kematian'";
$result_kematian = mysqli_query($koneksi, $query_kematian);
$row_kematian = mysqli_fetch_assoc($result_kematian);

// Query SQL untuk mengambil data penduduk berdasarkan id_penduduk dari tabel kematian
$id_penduduk = $row_kematian['id_penduduk'];
$query_penduduk = "SELECT * FROM penduduk WHERE id_penduduk = '$id_penduduk'";
$result_penduduk = mysqli_query($koneksi, $query_penduduk);
$row_penduduk = mysqli_fetch_assoc($result_penduduk);

// Buat PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 16); // Times New Roman regular 16
$pdf->Cell(0, 7, 'SURAT KETERANGAN KEMATIAN', 0, 1, 'C');
$pdf->Line(60, $pdf->GetY(), 150, $pdf->GetY()); // Membuat garis bawah judul
$pdf->Cell(125, 7, 'NOMOR : ', 0, 1, 'C');

$pdf->SetFont('Times', '', 12); // Times New Roman regular 12
$pdf->Ln(7); // Mengurangi jarak antara judul dan konten

$pdf->MultiCell(0, 7, "Yang bertanda tangan dibawah ini, Lurah Lasiana, menerangkan bahwa:", 0, 'L');
$pdf->Ln(7); // Menambah jarak antara paragraf pengantar dan konten

// Menampilkan data kematian
$pdf->Cell(40, 7, 'Nama', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_penduduk['nama'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Jenis Kelamin', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_penduduk['jk'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'TTL', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_penduduk['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($row_penduduk['tanggal_lahir'])), ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Tanggal Kematian', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kematian['tgl_kematian'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Agama', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_penduduk['agama'], ENT_QUOTES), 0, 1);

$pdf->Ln(7); // Menambah jarak antar konten

// Teks penutup
$pdf->Ln(7); // Menambah jarak antara konten dan teks penutup
// Tanggal otomatis
$tanggal_otomatis = date('d F Y'); // Format tanggal: 01 Januari 2022
$pdf->MultiCell(0, 7, "yang bersangkutan diatas adalah benar warga kelurahan lasiana yang telah meninggal
dunia pada tanggal $tanggal_otomatis kepada keluarga yang diberikan surat keterangan sebagai salah satu persyaratan untuk dipergunakan dalam pengurusan selanjutnya.
demikian surat keterangan ini dibuat untuk dipergunakan sebaimana mestinya.", 0, 'L');
$pdf->Ln(20); // Menambah jarak sebelum tanda tangan

// Ambil data nama dan NIP lurah dari database
$query_lurah = "SELECT nama, nip FROM lurah"; // Ambil hanya satu data lurah
$result_lurah = mysqli_query($koneksi, $query_lurah);
$row_lurah = mysqli_fetch_assoc($result_lurah);
$nama_lurah = $row_lurah['nama'];
$nip_lurah = $row_lurah['nip'];

// Tanda tangan
$pdf->Cell(0, 7, 'LURAH LASIANA       ', 0, 1, 'R');
$pdf->Ln(15); // Menambah jarak sebelum nama lurah
$pdf->Cell(0, 7, "$nama_lurah", 0, 1, 'R');
$pdf->Line(151, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Cell(0, 7, "NIP. $nip_lurah", 0, 1, 'R');


// Tutup koneksi ke database
mysqli_close($koneksi);

// Output PDF
$pdf->Output();
