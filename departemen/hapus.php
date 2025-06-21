<?php
require '../config/auth.php';
require '../config/koneksi.php';

$id = intval($_GET['id']);
if ($id) {
    mysqli_query($conn, "DELETE FROM departemen WHERE id = $id");
    header("Location: index.php?success=Data departemen berhasil dihapus.");
} else {
    header("Location: index.php?success=Gagal menghapus data.");
}
exit;
?>
