<?php
session_start();
include '../koneksi.php';

if (!isset($_POST['simpan'])) {
    header('Location: transaction-entry.php');
    exit;
}

// ambil & sanitasi input
$nama = trim($_POST['nama'] ?? '');
$no_telp = trim($_POST['no_telp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga_raw = $_POST['total'] ?? '0';
$status = trim($_POST['status'] ?? '');
$tanggal = date('Y-m-d');

// bersihkan harga (boleh berisi format seperti "Rp 1.000.000")
$harga = floatval(preg_replace('/[^\d\.]/', '', $harga_raw));

// validasi
if (empty($nama) || empty($no_telp) || empty($alamat) || empty($kategori) || $harga <= 0) {
    echo "
        <script>
            alert('Pastikan Anda Mengisi Semua Data dengan benar.');
            window.location = 'transaction-entry.php';
        </script>
    ";
    exit;
}

// prepared insert — menyesuaikan struktur VALUES sebelumnya (id auto, kemudian 7 kolom)
$sql = "INSERT INTO tb_pembayaran VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $sql);
if (!$stmt) {
    echo "
        <script>
            alert('Gagal menyiapkan query: " . mysqli_error($koneksi) . "');
            window.location = 'transaction-entry.php';
        </script>
    ";
    exit;
}

// tipe: s (nama), s (no_telp), s (alamat), s (kategori), d (harga), s (status), s (tanggal)
mysqli_stmt_bind_param($stmt, "ssssdss", $nama, $no_telp, $alamat, $kategori, $harga, $status, $tanggal);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($ok) {
    echo "
        <script>
            alert('Transaction Berhasil');
            window.location = '../transaction/transaction.php';
        </script>
    ";
    exit;
} else {
    echo "
        <script>
            alert('Terjadi Kesalahan saat menyimpan: " . mysqli_error($koneksi) . "');
            window.location = 'transaction-entry.php';
        </script>
    ";
    exit;
}
?>
