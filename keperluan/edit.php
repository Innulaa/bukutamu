<?php
require '../config/auth.php';
require '../config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama_keperluan'];
    $departemen_id = $_POST['departemen_id'];

    mysqli_query($conn, "UPDATE keperluan SET nama_keperluan='$nama', departemen_id=$departemen_id WHERE id=$id");
    header("Location: index.php?success=Data keperluan berhasil diperbarui.");
    exit;
}

$id = $_GET['id'];
$keperluan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM keperluan WHERE id=$id"));
$departemen = mysqli_query($conn, "SELECT * FROM departemen");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Keperluan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 text-gray-800 px-6 py-10">

  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold text-orange-600 mb-4">Edit Keperluan</h2>

    <form method="POST">
      <input type="hidden" name="id" value="<?= $keperluan['id'] ?>">

      <label class="block mb-3">
        <span class="text-gray-700">Nama Keperluan</span>
        <input type="text" name="nama_keperluan" value="<?= htmlspecialchars($keperluan['nama_keperluan']) ?>" required class="w-full border px-3 py-2 rounded">
      </label>

      <label class="block mb-4">
        <span class="text-gray-700">Departemen</span>
        <select name="departemen_id" required class="w-full border px-3 py-2 rounded">
          <option value="">-- Pilih Departemen --</option>
          <?php while ($d = mysqli_fetch_assoc($departemen)): ?>
            <option value="<?= $d['id'] ?>" <?= $d['id'] == $keperluan['departemen_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($d['nama_departemen']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </label>

      <div class="flex justify-end gap-2">
        <a href="index.php" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">Batal</a>
        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
