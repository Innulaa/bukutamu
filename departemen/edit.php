<?php
require '../config/auth.php';
require '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $nama = trim($_POST['nama_departemen']);

    if ($id && $nama) {
        mysqli_query($conn, "UPDATE departemen SET nama_departemen='$nama' WHERE id=$id");
        header("Location: index.php?success=Data departemen berhasil diperbarui.");
        exit;
    } else {
        header("Location: index.php?success=Gagal memperbarui data.");
        exit;
    }
}
?>
