<?php
require_once 'koneksi.php';
$db = new Koneksi();
$conn = $db->getConn();

if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $posisi = $_POST['posisi'];

    $stmt = $conn->prepare("INSERT INTO tblmahasiswa (nama, no_hp, posisi) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $no_hp, $posisi);
    if ($stmt->execute()) {
        header("Location: tambah.php");
    } else {
        echo "Gagal menambah data: " . $stmt->error;
    }
    $stmt->close();
}

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM tblmahasiswa WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: tambah.php");
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
}
?>
