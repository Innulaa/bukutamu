<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $query = "DELETE FROM tamu WHERE id = $id";
  mysqli_query($conn, $query);
}

// Arahkan kembali ke halaman index.php
header("Location: index.php?status=deleted");
exit;
