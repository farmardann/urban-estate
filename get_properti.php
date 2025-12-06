<?php
include 'koneksi.php';

// Ambil ID dari URL (contoh: id=5)
$id = $_GET['id'] ?? '';
$id = str_replace('id=', '', $id); // Bersihkan string jika ada

if (!empty($id) && is_numeric($id)) {
    // Gunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("SELECT * FROM tb_properti WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($data = $result->fetch_assoc()) {
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Properti tidak ditemukan"]);
    }
    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode(["error" => "ID tidak valid"]);
}

$koneksi->close();
?>