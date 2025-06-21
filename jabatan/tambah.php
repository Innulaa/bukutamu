<?php
require '../config/auth.php';
require '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama_jabatan'];
  mysqli_query($conn, "INSERT INTO jabatan (nama_jabatan, created_at) VALUES ('$nama', NOW())");
  header('Location: index.php?success=Data jabatan berhasil ditambahkan.');
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Jabatan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <main class="p-10 max-w-lg mx-auto">
    <h2 class="text-xl font-bold text-orange-700 mb-4">Tambah Jabatan</h2>
    <form method="POST" class="bg-white shadow p-6 rounded">
      <label class="block mb-3">
        <span class="text-sm font-medium">Nama Jabatan</span>
        <input type="text" name="nama_jabatan" required class="w-full px-3 py-2 border rounded">
      </label>
      <div class="flex justify-end gap-2">
        <a href="index.php" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm rounded">Kembali</a>
        <button type="submit" class="btn-orange text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </form>
  </main>
</body>
</html>