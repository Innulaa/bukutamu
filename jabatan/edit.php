<?php
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $nama_jabatan = $_POST['nama_jabatan'];

  // Validasi input (opsional tapi direkomendasikan)
  if (!empty($id) && !empty($nama_jabatan)) {
    $query = "UPDATE jabatan SET nama_jabatan = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "si", $nama_jabatan, $id);
      mysqli_stmt_execute($stmt);

      // Redirect ke index dengan pesan sukses
      header("Location: index.php?success=Data berhasil diperbarui");
      exit;
    } else {
      die("Query error: " . mysqli_error($conn));
    }
  } else {
    die("ID atau nama jabatan tidak boleh kosong.");
  }
} else {
  header("Location: index.php");
  exit;
}
