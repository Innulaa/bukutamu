<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config/koneksi.php';

if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tamu WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $telepon = $_POST['telepon'];
  $tanggal = $_POST['tanggal'];

  $query = "UPDATE tamu SET nama='$nama', telepon='$telepon', tanggal='$tanggal' WHERE id=$id";
  $result = mysqli_query($conn, $query);
  
  if ($result) {
    header("Location: index.php?status=updated");
    exit;
  } else {
    die("Error query: " . mysqli_error($conn));
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Tamu</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-blue-700">Edit Data Tamu</h2>
    <form method="POST">
      <div class="mb-4">
        <label class="block mb-1">Nama Lengkap</label>
        <input name="nama" value="<?= htmlspecialchars($data['nama']) ?>" class="w-full border p-2 rounded" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Telepon</label>
        <input name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>" class="w-full border p-2 rounded" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Waktu Kehadiran</label>
        <input type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal']) ?>" class="w-full border p-2 rounded" required>
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan Perubahan</button>
      <a href="index.php" class="ml-4 text-blue-700 underline">Batal</a>
    </form>
  </div>
</body>
</html>
