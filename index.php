<?php
$cookie_name = "user";
$cookie_value = getenv("username") ?: 'guest';
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UrbanEstate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@400;600;700&family=Saira:ital,wght@0,400;0,500;0,600;1,400&display=swap"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <?php
    // tampilkan status cookie (bisa dihapus untuk produksi)
    if(!isset($_COOKIE[$cookie_name])) {
      echo '<div class="cookie-status">Cookie named "' . htmlspecialchars($cookie_name) . '" is not set! (refresh setelah set)</div>';
    } else {
      echo '<div class="cookie-status">Cookie "' . htmlspecialchars($cookie_name) . '" is set! Value: ' . htmlspecialchars($_COOKIE[$cookie_name]) . '</div>';
    }
    ?>
    <div id="snackbar">Selamat Datang di UrbanEstate! 👋</div>
    <!-- Header Top -->
    <header class="topbar">
      <div class="container topbar__row">
        <div class="topbar__left"></div>
        <p class="topbar__center">
          <strong>Opening hours:</strong> Mon - Sat 9:00 am to 6:00 pm
        </p>
        <nav class="topbar__right">
          <a href="login.php">Login</a>
          <span class="sep"></span>
          <a class="accent" href="register.php">Register</a>
          <span class="sep"></span>
          <a href="dashboard.php" aria-label="Dashboard">Dashboard</a>
        </nav>
      </div>
    </header>

    <!-- Main Nav -->
    <div class="container navbar">
      <div class="brand">
        <img src="assets/images/logo.svg" alt="logo" class="brand__icon" />
        <span class="brand__name">UrbanEstate</span>
      </div>
      <nav class="menu">
        <a class="active" href="#home">Home</a>
        <a href="#about">About Us</a>
        <a href="#projects">Apartments</a>
        <a href="#testimoni">Testimoni</a>
        <a href="#footer">Contact</a>
      </nav>
    </div>

    <!-- Hero -->
    <section id="home" class="hero">
      <div class="hero__layout">
        <div class="hero__panel">
          <span class="pill welcome">WELCOME TO URBANESTATE!</span>
          <h1>
            Many Property <span class="accent">Places</span><br />Service Best
            Home.
          </h1>
          <p class="lede">
            We provide the most House and modern design place for companies and
            businesses home.
          </p>
          <div class="hero__cta">
            <a class="btn btn--primary with-icon" href="#apartments"
              ><span class="i i-home"></span>90 Apartments</a
            >
            <a class="btn btn--ghost with-icon" href="#projects"
              ><span class="i i-grid"></span>2500 Square</a
            >
          </div>
        </div>
        <div class="hero__image">
          <img src="assets/images/villa1.png" alt="villa luxury" />
          <div class="hero__badge">
            <span>400 Batu Road City, Labest</span>
            <span>896 th Wiryo Utomo Place</span>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section id="about" class="section about">
      <div class="container grid-2">
        <div class="about__media">
          <img src="assets/images/villa1.png" alt="about" class="photo" />
          <div class="since">Since 2025</div>
        </div>
        <div class="about__text">
          <p class="eyebrow">Our About property</p>
          <h2>We Provide thorough About customer service Home.</h2>
          <p class="muted">
            Home tailored design, management & support services business;
            majority have in some we form by injected humour solution.
          </p>
          <ul class="ticks">
            <li>Magnificent project of three modern.</li>
            <li class="accent">Movable items not fixed to land</li>
            <li>a private plot and a swimming pool.</li>
          </ul>
          <a class="btn btn--dark" href="#about">About More</a>
        </div>
      </div>
    </section>

    <!-- Services -->
    <section class="section services">
      <div class="container center">
        <p class="eyebrow">Our Properties ROOM</p>
        <h2>Property Management Services Managing of rental</h2>
      </div>
      <div class="container cards-4">
        <article class="card">
          <img src="assets/images/car.svg" alt="parking" class="icon" />
          <h3>Parking Space</h3>
        </article>
        <article class="card card--accent">
          <img src="assets/images/swim.svg" alt="swimming" class="icon" />
          <h3>Swimming Pool</h3>
        </article>
        <article class="card">
          <img src="assets/images/wifi.svg" alt="wifi" class="icon" />
          <h3>Fast free WI‑FI</h3>
        </article>
        <article class="card">
          <img src="assets/images/food.svg" alt="food" class="icon" />
          <h3>Food vegetable</h3>
        </article>
      </div>
    </section>

    <!-- Projects -->
    <section id="projects" class="section projects">
      <div class="container center">
        <p class="eyebrow">Our BEST PROJECTS</p>
        <h2>Property Investment Assisting Projects House lucrative.</h2>
      </div>
        <div class="container grid-3">
            <?php
            // 1. Sertakan file koneksi database
            include 'koneksi.php';

            // 2. Query untuk mengambil semua data properti
            $sql = "SELECT * FROM tb_properti";
            $result = mysqli_query($koneksi, $sql);

            // 3. Cek jika tidak ada data
            if (mysqli_num_rows($result) == 0) {
                echo "
                <div style='text-align: center; grid-column: 1 / -1;'>
                    <h3 style='color: red;'>Tidak Ada Data Properti Tersedia.</h3>
                </div>";
            } else {
                // 4. Loop untuk menampilkan setiap properti
                while ($data = mysqli_fetch_assoc($result)) {
                    // Pastikan nama kolom sesuai dengan nama kolom di tabel Anda
                    $nama = htmlspecialchars($data['nama_properti'] ?? 'Nama Properti');
                    $kategori = htmlspecialchars($data['kategori'] ?? 'Kategori');
                    $harga = htmlspecialchars($data['harga'] ?? 'Hubungi Kami');
                    $deskripsi = htmlspecialchars($data['deskripsi'] ?? 'Deskripsi singkat properti...');
                    $foto = htmlspecialchars($data['foto'] ?? 'default.jpg');
                    $id_properti = htmlspecialchars($data['id'] ?? '0');
                    
                    echo "
                    <div class='project__card'>
                        <div class='project__image'>
                            <img src='img_categories/$foto' alt='$nama' />
                        </div>
                        <div class='project__meta'>
                        <h3>$nama</h3>
                        <ul class='facts'>
                            <li><span>Deskripsi</span><b>$deskripsi</b></li>
                            <li><span>Kategori</span><b>$kategori</b></li>
                            <li><span>Harga</span><b>$harga</b></li>
                        </ul>
                            
                            <a class='btn btn--dark small' href='transaction/transaction-entry.php'>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    ";
                }
            }
            ?>
          </div>
        </div>
    </section>

    <!-- Plans / Facts -->
    <section class="section plans">
      <div class="container grid-2 align-center">
        <div>
          <p class="eyebrow">Our Property plans</p>
          <h2>Exhibition Large open space with minimal distractions.</h2>
          <ul class="facts">
            <li><span>Floor No</span><b>25</b></li>
            <li><span>Rooms</span><b>08</b></li>
            <li><span>Bathrooms</span><b>24</b></li>
            <li><span>Total area, square</span><b>2000m²</b></li>
            <li><span>Parking</span><b>09</b></li>
            <li><span>Pricing</span><b>$66/M4</b></li>
          </ul>
          <a class="btn btn--dark" href="#projects">Schedule Visit Now</a>
        </div>
        <div class="card-lg">
          <img src="assets/images/villa1.png" alt="plan" />
        </div>
      </div>
    </section>

    <!-- Testimonial -->
    <section id="testimoni" class="section testimonial">
      <div class="container center">
        <p class="eyebrow">our testimonial say</p>
        <h2>What Our Client Says This Best off Property</h2>
      </div>
      <div class="container testimonial__card">
        <img src="assets/images/villa1.png" alt="client bg" />
        <blockquote>
          <p>
            Professional who help you buy sell home the assist with pricing room
            and paperwork house.
          </p>
          <footer>
            <strong>Ralph Havens</strong>
            <span>Founder</span>
          </footer>
        </blockquote>
      </div>
    </section>

    <!-- Blog -->
    <section class="section blog">
      <div class="container center">
        <p class="eyebrow">our largest blog</p>
        <h2>Our News & Property Articles of blog</h2>
      </div>
      <div class="container grid-2">
        <article class="post">
          <img src="assets/images/villa1.png" alt="b1" />
          <div class="post__meta">
            <p class="muted">By: Admin · Comments (3)</p>
            <h3>Full Property Blog Some Agencies</h3>
            <a class="btn btn--dark small" href="#">Read More</a>
          </div>
        </article>
        <article class="post">
          <img src="assets/images/villa1.png" alt="b2" />
          <div class="post__meta">
            <p class="muted">By: Admin · Comments (3)</p>
            <h3>Promote to property blog effectively</h3>
            <a class="btn btn--dark small" href="#">Read More</a>
          </div>
        </article>
      </div>
    </section>

    <!-- Footer -->
    <footer id="footer" class="footer">
      <div class="container footer__grid">
        <div>
          <div class="brand brand--footer">
            <img src="assets/images/logo.svg" alt="logo" class="brand__icon" />
            <span class="brand__name">UrbanEstate</span>
          </div>
          <p class="muted">
            Will give you a complete account the system, and expound the
            teachings of the great explorer the truth, the master-builder
            because ...
          </p>
        </div>
        <div>
          <h4>Our Service</h4>
          <ul class="list">
            <li>Team</li>
            <li>About</li>
            <li>Video</li>
            <li>Gallery</li>
            <li>Brand</li>
            <li>Blog</li>
          </ul>
        </div>
        <div>
          <h4>Quick Link</h4>
          <ul class="list">
            <li>What We Do</li>
            <li>About Company</li>
            <li>Team Member</li>
            <li>Our Gallery</li>
            <li>Watch Video</li>
            <li>Latest news</li>
          </ul>
        </div>
      </div>
      <div class="footer__bottom">
        <div class="container split">
          <p>Copyright © 2025 UrbanEstate. All Rights Reserved.</p>
          <p>Privacy · Policy · Contact Us</p>
        </div>
      </div>
    </footer>
    <button id="scrollTopBtn" class="scroll-top-btn" title="Go to top">
      ↑
    </button>
    <script src="assets/js/main.js"></script>
  </body>
</html>