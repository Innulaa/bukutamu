<?php
require '../config/auth.php';
require '../config/koneksi.php';

$id = (int) $_POST['id'];
$nama = trim($_POST['nama_petugas']);
$jabatan_id = (int) $_POST['jabatan_id'];

if ($id && $nama && $jabatan_id) {
  $query = mysqli_query($conn, "UPDATE petugas SET nama_petugas='$nama', jabatan_id=$jabatan_id WHERE id=$id");
  if ($query) {
    header("Location: index.php?success=Data berhasil diperbarui");
    exit;
  }
}

header("Location: index.php?success=Gagal memperbarui data");
exit;
