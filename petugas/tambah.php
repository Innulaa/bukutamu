<?php
require '../config/auth.php';
require '../config/koneksi.php';

$nama = trim($_POST['nama_petugas']);
$jabatan_id = (int) $_POST['jabatan_id'];

if ($nama && $jabatan_id) {
  $query = mysqli_query($conn, "INSERT INTO petugas (nama_petugas, jabatan_id) VALUES ('$nama', $jabatan_id)");
  if ($query) {
    header("Location: index.php?success=Data berhasil ditambahkan");
    exit;
  }
}

header("Location: index.php?success=Gagal menambahkan data");
exit;
