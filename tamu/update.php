<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
  $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);

  $query = "UPDATE tamu SET nama='$nama', telepon='$telepon', tanggal='$tanggal' WHERE id=$id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: index.php?status=updated");
    exit;
  } else {
    die("Gagal update: " . mysqli_error($conn));
  }
} else {
  header("Location: index.php");
  exit;
}
