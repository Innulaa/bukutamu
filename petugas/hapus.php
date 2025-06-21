<?php
require '../config/auth.php';
require '../config/koneksi.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
  $query = mysqli_query($conn, "DELETE FROM petugas WHERE id=$id");
  if ($query) {
    header("Location: index.php?success=Data berhasil dihapus");
    exit;
  }
}

header("Location: index.php?success=Gagal menghapus data");
exit;
