
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

// Query SQL untuk mengambil data kelahiran berdasarkan id_kelahiran
$id_kelahiran = isset($_GET['id_kelahiran']) ? $_GET['id_kelahiran'] : '';
$query_kelahiran = "SELECT kelahiran.*, anak.nama AS nama_anak, anak.jk AS jk_anak, anak.tempat_lahir AS tempat_lahir_anak, anak.tanggal_lahir AS tanggal_lahir_anak, anak.agama AS agama_anak, ibu.nama AS nama_ibu, ayah.nama AS nama_ayah 
                    FROM kelahiran
                    LEFT JOIN penduduk AS anak ON kelahiran.anak_id_penduduk = anak.id_penduduk
                    LEFT JOIN penduduk AS ibu ON kelahiran.ibu_id_penduduk = ibu.id_penduduk
                    LEFT JOIN penduduk AS ayah ON kelahiran.bapa_id_penduduk = ayah.id_penduduk
                    WHERE kelahiran.id_kelahiran = '$id_kelahiran'";
$result_kelahiran = mysqli_query($koneksi, $query_kelahiran);
$row_kelahiran = mysqli_fetch_assoc($result_kelahiran);

// Buat PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 16); // Times New Roman regular 16
$pdf->Cell(0, 7, 'SURAT KETERANGAN KELAHIRAN', 0, 1, 'C');
$pdf->Line(60, $pdf->GetY(), 150, $pdf->GetY()); // Membuat garis bawah judul
$pdf->Cell(125, 7, 'NOMOR : ', 0, 1, 'C');

$pdf->SetFont('Times', '', 12); // Times New Roman regular 12
$pdf->Ln(7); // Mengurangi jarak antara judul dan konten

$pdf->MultiCell(0, 7, "Yang bertanda tangan dibawah ini, lurah lasiana, menerangkan bahwa :", 0, 'L');
$pdf->Ln(7); // Menambah jarak antara paragraf pengantar dan konten

// Menampilkan data kelahiran
$pdf->Cell(40, 7, 'Nama', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kelahiran['nama_anak'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Jenis Kelamin', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kelahiran['jk_anak'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Tempat, Tanggal Lahir', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kelahiran['tempat_lahir_anak'] . ', ' . $row_kelahiran['tanggal_lahir_anak'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Agama', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kelahiran['agama_anak'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Nama Ayah', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kelahiran['nama_ayah'], ENT_QUOTES), 0, 1);

$pdf->Cell(40, 7, 'Nama Ibu', 0, 0);
$pdf->Cell(5, 7, ':', 0, 0);
$pdf->Cell(0, 7, htmlspecialchars($row_kelahiran['nama_ibu'], ENT_QUOTES), 0, 1);

$pdf->Ln(7); // Menambah jarak antar konten

// Teks penutup
$pdf->Ln(7); // Menambah jarak antara konten dan teks penutup
// Tanggal otomatis
$pdf->MultiCell(0, 7, "demikian surat pengantar kelahiran ini dibuat dan diberikan kepada yang bersangkutan
untuk dipergunakan sebagaimana mestinya.", 0, 'L');
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
