<?php 
include '../koneksi.php';

function upload() {
    $namaFile = $_FILES['foto']['name'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4) {
        echo "
            <script>
                alert('Gambar Harus Diisi');
                window.location = 'categories-entry.php';
            </script>
        ";

        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstentiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar, $ekstentiGambarValid)) {
        echo "
            <script>
                alert('File Harus Berupa Gambar');
                window.location = 'categories-entry.php';
            </script>
        ";

        return null;
    }

    // lolos pengecekan, upload gambar
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    $oke =  move_uploaded_file($tmpName, '../img_categories/' . $namaFileBaru);
    return $namaFileBaru;

}

if(isset($_POST['simpan'])) {
    $nama_properti = $_POST['nama_properti'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $foto = upload();

    if(!$foto) {
        return false;
    }
    // var_dump($foto, $kategori, $harga, $deskripsi);

    $sql = "INSERT INTO tb_properti VALUES(NULL, '$nama_properti', '$foto', '$kategori', '$deskripsi','$harga')";

    if(empty($kategori) || empty($harga)|| empty($deskripsi)) {
        echo "
            <script>
                alert('Pastikan Anda Mengisi Semua Data');
                window.location = 'categories-entry.php';
            </script>
        ";
    }elseif(mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Categories Berhasil Ditambahkan');
                window.location = 'categories.php'
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Terjadi Kesalahan');
                window.location = 'categories-entry.php'
            </script>
        ";
    }
}elseif(isset($_POST['edit'])) {
    $id         = $_POST['id'];
    $nama_properti = $_POST['nama_properti'];
    $kategori = $_POST['kategori'];
    $harga      = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $fotoLama = $_POST['fotoLama'];

    // cek apakah user pilih gambar atau tidak
    if($_FILES['foto']['error']) {
        $foto = $fotoLama;
    }else {
        // foto lama akan dihapus dan diganti foto baru
        unlink('../img_categories/' . $fotoLama);
        $foto = upload();
    }

    $sql = "UPDATE tb_properti SET 
            foto = '$foto',
            nama_properti = '$nama_properti',
            kategori = '$kategori',
            harga = '$harga',
            deskripsi = '$deskripsi'
            WHERE id = $id 
            ";

    if(mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Categories Berhasil Diubah');
                window.location = 'categories.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Terjadi Kesalahan');
                window.location = 'categories-edit.php';
            </script>
        ";
    }
}elseif(isset($_POST['hapus'])) {
    $id = $_POST['id'];

    // hapus gambar
    $sql = "SELECT * FROM tb_properti WHERE id = $id";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $foto = $row['foto'];
    unlink('../img_categories/' . $foto);
    

    $sql = "DELETE FROM tb_properti WHERE id = $id";
    if(mysqli_query($koneksi, $sql)) {
        echo "
            <script>
                alert('Data Categories Berhasil Dihapus');
                window.location = 'categories.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Data Categories Gagal Dihapus');
                window.location = 'categories.php';
            </script>
        ";
    }
}else {
    header('location: categories.php');
}
