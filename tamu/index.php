<?php
require '../config/auth.php';
require '../config/koneksi.php';
include '../layouts/sidebar-admin.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$query = "SELECT * FROM tamu";
if ($search != '') {
  $query .= " WHERE 
    nama LIKE '%$search%' OR 
    telepon LIKE '%$search%' OR 
    instansi LIKE '%$search%' OR 
    departemen LIKE '%$search%' OR 
    keperluan LIKE '%$search%' OR 
    petugas LIKE '%$search%' OR 
    tanggal LIKE '%$search%'";
}
$query .= " ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tamu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body { background-color: #fefcf9; }
    .table-header { background-color: #FFE0B2; color: #5D4037; }
    .table-row:hover { background-color: #FFF3E0; }
    .btn-orange { background-color: #FFA726; }
    .btn-orange:hover { background-color: #FB8C00; }
  </style>
</head>
<body class="text-gray-800">

<header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 left-64 right-0 z-40">
  <h1 class="text-xl font-bold text-orange-600">Kelola Tamu</h1>
  <div class="flex items-center gap-3">
    <img src="https://i.pravatar.cc/40" class="rounded-full w-10 h-10" alt="Profile">
    <span class="font-semibold text-gray-700">Admin</span>
  </div>
</header>

<main class="pt-24 ml-64 px-6 pb-10">
  <div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-orange-600">Daftar Tamu</h1>

    <div class="mb-4 flex justify-end">
      <form method="GET" class="flex items-center gap-2">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari tamu..." class="border border-gray-300 rounded px-3 py-1 text-sm w-64">
        <button type="submit" class="btn-orange text-white px-3 py-1 rounded text-sm hover:bg-orange-600">Cari</button>
      </form>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border-t">
        <thead class="table-header">
          <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nama Perwakilan</th>
            <th class="px-4 py-2">No Telepon</th>
            <th class="px-4 py-2">Instansi</th>
            <th class="px-4 py-2">Departemen</th>
            <th class="px-4 py-2">Keperluan</th>
            <th class="px-4 py-2">Petugas Penerima</th>
            <th class="px-4 py-2">Tanggal Datang</th>
            <th class="px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
            <tr class="border-b table-row">
              <td class="px-4 py-2"><?= $no++; ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['nama']); ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['telepon']); ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['instansi']); ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['departemen']); ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['keperluan']); ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['petugas']); ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['tanggal']); ?></td>
              <td class="px-4 py-2 text-center">
                <div class="relative inline-block text-left">
                  <button onclick="openEditModal(<?= $row['id']; ?>, '<?= htmlspecialchars(addslashes($row['nama'])); ?>', '<?= htmlspecialchars(addslashes($row['telepon'])); ?>', '<?= $row['tanggal']; ?>')" class="btn-orange text-white px-2 py-1 rounded text-xs">Edit</button>
                  <button onclick="confirmDelete(<?= $row['id']; ?>)" class="ml-2 bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs">Hapus</button>
                </div>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<!-- Modal Edit -->
<div id="modalEdit" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded shadow max-w-md w-full">
    <h2 class="text-lg font-semibold mb-4 text-orange-600">Edit Data Tamu</h2>
    <form id="formEdit" method="POST" action="update.php">
      <input type="hidden" name="id" id="editId">
      <div class="mb-4">
        <label class="block mb-1">Nama Lengkap</label>
        <input name="nama" id="editNama" class="w-full border p-2 rounded" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Telepon</label>
        <input name="telepon" id="editTelepon" class="w-full border p-2 rounded" required>
      </div>
      <div class="mb-4">
        <label class="block mb-1">Tanggal</label>
        <input type="date" name="tanggal" id="editTanggal" class="w-full border p-2 rounded" required>
      </div>
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
        <button type="submit" class="btn-orange text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="modalConfirm" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
  <div class="bg-white p-6 rounded shadow text-center">
    <h2 class="text-lg font-semibold mb-4">Yakin ingin menghapus data ini?</h2>
    <div class="flex justify-center gap-4">
      <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
      <a id="btnDelete" href="#" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Ya, Hapus</a>
    </div>
  </div>
</div>

<script>
  function confirmDelete(id) {
    document.getElementById('btnDelete').href = 'hapus.php?id=' + id;
    document.getElementById('modalConfirm').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modalConfirm').classList.add('hidden');
  }

  function openEditModal(id, nama, telepon, tanggal) {
    document.getElementById('editId').value = id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editTelepon').value = telepon;
    document.getElementById('editTanggal').value = tanggal;
    document.getElementById('modalEdit').classList.remove('hidden');
  }

  function closeEditModal() {
    document.getElementById('modalEdit').classList.add('hidden');
  }

  <?php if (isset($_GET['status']) && $_GET['status'] == 'deleted'): ?>
    alert("Berhasil dihapus!");
  <?php elseif (isset($_GET['status']) && $_GET['status'] == 'updated'): ?>
    alert("Berhasil diperbarui!");
  <?php endif; ?>
</script>

</body>
</html>
