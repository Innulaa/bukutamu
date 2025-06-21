<?php
require '../config/auth.php';
require '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST['nama_departemen']);

    if ($nama) {
        mysqli_query($conn, "INSERT INTO departemen (nama_departemen) VALUES ('$nama')");
        header("Location: index.php?success=Data departemen berhasil ditambah.");
        exit;
    } else {
        header("Location: index.php?success=Gagal menambah data.");
        exit;
    }
}
?>
