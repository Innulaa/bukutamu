<?php echo 'Hapus Keperluan'; ?>
<?php
require '../config/auth.php';
require '../config/koneksi.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM keperluan WHERE id = $id");

header("Location: index.php?hapus=1");
exit;
