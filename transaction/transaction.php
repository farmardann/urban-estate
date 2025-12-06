<?php
session_start();
if ($_SESSION['username'] == null) header('location:../login.php');

include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <link rel="icon" href="../assets/icon.png" />
   <link rel="stylesheet" href="../assets/css/dashboard.css" />
   <!-- Boxicons CDN Link -->
   <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>UrbanEstate Admin | Transaction</title>
</head>

<body>
   <div class="sidebar">
      <div class="logo-details">
         <i class="bx bx-category"></i>
         <span class="logo_name">UrbanEstate</span>
      </div>
      <ul class="nav-links">
         <li>
            <a href="../dashboard.php" class="active">
               <i class="bx bx-grid-alt"></i>
               <span class="links_name">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="../categories/categories.php">
               <i class="bx bx-box"></i>
               <span class="links_name">Categories</span>
            </a>
         </li>
         <li>
            <a href="../transaction/transaction.php">
               <i class="bx bx-list-ul"></i>
               <span class="links_name">Transaction</span>
            </a>
         </li>
         <li>
            <a href="../logout.php">
               <i class="bx bx-log-out"></i>
               <span class="links_name">Log out</span>
            </a>
         </li>
      </ul>
   </div>
   <section class="home-section">
      <nav>
         <div class="sidebar-button">
            <i class="bx bx-menu sidebarBtn"></i>
         </div>
         <div class="profile-details">
            <span class="admin_name">UrbanEstate Admin</span>
         </div>
      </nav>
      <div class="home-content">
         <h3>Transaction</h3>
         <button type="button" class="btn btn-tambah">
				<a href="transaction-entry.php">Tambah Transaksi</a>
			</button>
         <button type="button" class="btn btn-tambah">
				<a href="transaction-cetak.php">Cetak Transaksi</a>
			</button>
         <table class="table-data">
            <thead>
               <tr>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>Kategori</th>
                  <th>Total (Rp)</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               // ambil data pembayaran — tidak melakukan JOIN karena tb_pembayaran tidak memiliki id_properti
               $sql = "SELECT * FROM tb_pembayaran ORDER BY tanggal DESC";
               $result = mysqli_query($koneksi, $sql);
               if (!$result || mysqli_num_rows($result) == 0) {
                 echo "<tr><td colspan='6' style='text-align:center;color:#c00;'>Data Kosong</td></tr>";
               } else {
                 while ($row = mysqli_fetch_assoc($result)) {
                   $tanggal = htmlspecialchars($row['tanggal'] ?? '');
                   $nama = htmlspecialchars($row['nama'] ?? '');
                   $kategori = htmlspecialchars($row['kategori'] ?? '-');
                   // harga disimpan di kolom 'harga' sesuai proses penyimpanan sebelumnya
                   $total = (float)($row['harga'] ?? 0);
                   $status = htmlspecialchars($row['status'] ?? '');
                   $nomorhp = htmlspecialchars($row['no_telp'] ?? $row['nomorhp'] ?? '');
                   $harga_display = number_format($total, 0, ',', '.');
                   echo "<tr>
                           <td>{$tanggal}</td>
                           <td>{$nama}</td>
                           <td>{$kategori}</td>
                           <td>Rp {$harga_display}</td>
                           <td><span class='status'>{$status}</span></td>
                           <td>
                             <button class='btn_detail' onclick=\"showDetails('{$tanggal}', '{$nama}', '{$kategori}', 'Rp {$harga_display}', '{$nomorhp}', '{$status}')\">Detail</button>
                           </td>
                         </tr>";
                 }
               }
               ?>
            </tbody>
         </table>
      </div>
   </section>
   <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function() {
         sidebar.classList.toggle("active");
         if (sidebar.classList.contains("active")) {
            sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
         } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };

      function showDetails(tanggal, nama, kategori, harga, nomorhp, status) {
         alert(`Tanggal: ${tanggal}\nNama: ${nama}\nKategori: ${kategori}\nHarga: ${harga}\nNomor HP: ${nomorhp}\nStatus: ${status}`);
      }
   </script>
</body>
</html>