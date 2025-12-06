<?php 
	session_start();
	if($_SESSION['username'] == null) {
		header('location:../login.php');
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
  <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UrbanEstate Admin | Transaction Entry</title>
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
        <h3>Input Transaction</h3>
        <div class="form-login">
          <?php
            include '../koneksi.php';
            // ambil daftar properti untuk select (lengkapi harga dan kategori)
            $props = [];
            $res = mysqli_query($koneksi, "SELECT id, nama_properti, harga, kategori FROM tb_properti ORDER BY nama_properti ASC");
            if ($res) {
              while ($r = mysqli_fetch_assoc($res)) $props[] = $r;
            }
          ?>
          <form action="transaction-proses.php" method="post">
            <label for="id_properti">Properti</label>
            <select class="input" name="id_properti" id="id_properti" required>
              <option value="" data-price="0" data-category="">-- Pilih Properti --</option>
              <?php foreach ($props as $p): ?>
                <option value="<?= htmlspecialchars($p['id']); ?>"
                        data-price="<?= htmlspecialchars($p['harga']); ?>"
                        data-category="<?= htmlspecialchars($p['kategori']); ?>">
                  <?= htmlspecialchars($p['nama_properti']); ?>
                </option>
              <?php endforeach; ?>
            </select>

            <label for="kategori_display">Kategori</label>
            <input class="input" type="text" id="kategori_display" placeholder="Kategori" readonly />
            <input type="hidden" name="kategori" id="kategori" value="" />

            <label for="nama_pembeli">Nama Pembeli</label>
            <input class="input" type="text" name="nama" id="nama" placeholder="Nama Pembeli" required />

            <label for="alamat_pembeli">Alamat</label>
            <input class="input" type="text" name="alamat" id="alamat" placeholder="Alamat" required />

            <label for="telepon">Telepon</label>
            <input class="input" type="text" name="no_telp" id="no_telp" placeholder="0812xxxx" required />

            <label for="total_display">Harga</label>
            <input class="input" type="text" id="total_display" placeholder="Total harga" readonly />

            <!-- nilai total numerik yang akan dikirim ke server -->
            <input type="hidden" name="total" id="total" value="0" />

            <label for="status">Status</label>
            <select class="input" name="status" id="status" required>
              <option value="pending">Pending</option>
              <option value="paid">Paid</option>
              <option value="cancelled">Cancelled</option>
            </select>

            <!-- kirim username admin yang membuat transaksi -->
            <input type="hidden" name="admin" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">

            <button type="submit" class="btn btn-simpan" name="simpan">
              Simpan
            </button>
          </form>

          <script>
            (function(){
              const propSelect = document.getElementById('id_properti');
              const totalHidden = document.getElementById('total');
              const totalDisplay = document.getElementById('total_display');
              const kategoriDisplay = document.getElementById('kategori_display');
              const kategoriHidden = document.getElementById('kategori');

              function formatIDR(v){
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(v);
              }

              function updateTotalAndCategory(){
                const opt = propSelect.options[propSelect.selectedIndex];
                const price = Number(opt?.dataset?.price || 0);
                const category = opt?.dataset?.category || '';
                totalHidden.value = price; // dikirim ke server
                totalDisplay.value = price ? formatIDR(price) : '';
                kategoriDisplay.value = category;
                kategoriHidden.value = category;
              }

              propSelect.addEventListener('change', updateTotalAndCategory);
              document.addEventListener('DOMContentLoaded', updateTotalAndCategory);
            })();
          </script>
        </div>
      </div>
    </section>
    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>
