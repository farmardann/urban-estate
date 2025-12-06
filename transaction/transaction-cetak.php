<?php
include('../koneksi.php');
require_once("../dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

// ambil semua kolom dari tb_pembayaran
$query = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran ORDER BY tanggal DESC");

$html = '<center><h3>Data Transaksi</h3></center><hr/><br>';
$html .= '<table border="1" width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
            <tr style="background:#f2f2f2;">
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Harga (Rp)</th>
                <th>Status</th>
            </tr>';

$no = 1;
while ($transaction = mysqli_fetch_assoc($query)) {
    // fallback pengambilan kolom: harga bisa disimpan di 'harga' atau 'total'
    $harga_value = isset($transaction['harga']) ? (float)$transaction['harga']
                   : (isset($transaction['total']) ? (float)$transaction['total'] : 0);


    $harga_formatted = number_format($harga_value, 0, ',', '.');

    $html .= "<tr>
                <td style='text-align:center'>{$no}</td>
                <td>" . htmlspecialchars($transaction['tanggal'] ?? '') . "</td>
                <td>" . htmlspecialchars($transaction['nama'] ?? '') . "</td>
                <td>" . htmlspecialchars($transaction['kategori'] ?? '') . "</td>
                <td>" . htmlspecialchars($transaction['alamat'] ?? '') . "</td>
                <td>" . htmlspecialchars($transaction['no_telp'] ?? $transaction['nomorhp'] ?? '') . "</td>
                <td style='text-align:right'>" . $harga_formatted . "</td>
                <td>" . htmlspecialchars($transaction['status'] ?? '') . "</td>
            </tr>";
    $no++;
}
$html .= "</table>";

$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas (perbaiki typo portrait)
$dompdf->setPaper('A4', 'portrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf (inline)
$dompdf->stream('laporan-transaksi.pdf', ["Attachment" => 0]);
?>
