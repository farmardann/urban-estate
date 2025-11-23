<?php
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {
  $requestEmail = isset($_POST['email']) ? trim($_POST['email']) : '';
  $requestPassword = isset($_POST['password']) ? $_POST['password'] : '';

  if ($requestEmail === '' || $requestPassword === '') {
    echo "<script>alert('Silakan masukkan email dan password.'); window.location='login.php';</script>";
    exit;
  }

  // Gunakan prepared statement untuk mencegah SQL injection
  $sql = "SELECT * FROM tb_admin WHERE email = ? LIMIT 1";
  if ($stmt = mysqli_prepare($koneksi, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $requestEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      // Pastikan nama kolom password sesuai dengan struktur tabel Anda (mis. 'password')
      $hashed = isset($row['password']) ? $row['password'] : '';

      if ($hashed !== '' && password_verify($requestPassword, $hashed)) {
        // Login sukses
        $_SESSION['username'] = $row['username'];
        header('Location: dashboard.php');
        exit;
      } else {
        echo "<script>alert('Email atau password salah.'); window.location='login.php';</script>";
        exit;
      }
    } else {
      // user tidak ditemukan
      echo "<script>alert('Email atau password salah.'); window.location='login.php';</script>";
      exit;
    }
  } else {
    // error pada statement
    echo "<script>alert('Terjadi kesalahan pada server.'); window.location='login.php';</script>";
    exit;
  }
}

?>
