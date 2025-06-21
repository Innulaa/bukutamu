<?php
require '../config/auth.php';
require '../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM jabatan WHERE id = $id");
header("Location: index.php?success=Data jabatan berhasil dihapus.");
exit;
?>