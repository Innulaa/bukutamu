<?php
require '../config/auth.php';
require '../config/koneksi.php';
include '../layouts/sidebar-admin.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$where = $search ? "WHERE petugas.nama_petugas LIKE '%$search%' OR jabatan.nama_jabatan LIKE '%$search%'" : '';
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM petugas JOIN jabatan ON petugas.id_jabatan = jabatan.id $where");
$total_data = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_data / $limit);

$data = mysqli_query($conn, "SELECT petugas.*, jabatan.nama_jabatan FROM petugas JOIN jabatan ON petugas.id_jabatan = jabatan.id $where ORDER BY petugas.id DESC LIMIT $limit OFFSET $offset");

$success = isset($_GET['success']) ? $_GET['success'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Petugas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background: #f0f4f8; }
    .notif-success { background-color: #FFF7E0; border: 1px solid #FFE8B0; color: #CC8B00; }
    .btn-orange { background-color: #FFA726; }
    .btn-orange:hover { background-color: #FB8C00; }
    .table-header { background-color: #FFE0B2; color: #5D4037; }
    .table-row:hover { background-color: #FFF3E0; }
  </style>
</head>
<body class="text-gray-800">

<header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 left-64 right-0 z-40">
  <h1 class="text-xl font-bold text-orange-600">Data Petugas</h1>
  <div class="flex items-center gap-3">
    <img src="https://i.pravatar.cc/40" class="rounded-full w-10 h-10" alt="Profile">
    <span class="font-semibold text-gray-700">Admin</span>
  </div>
</header>

<main class="pt-24 ml-64 px-6 pb-10">
  <?php if ($success): ?>
    <div id="successMessage" class="notif-success px-4 py-2 rounded mb-4">
      <strong>Success!</strong> <?= htmlspecialchars($success) ?>
    </div>
    <script>
      setTimeout(() => {
        const el = document.getElementById('successMessage');
        if (el) el.style.display = 'none';
      }, 10000);
    </script>
  <?php endif; ?>

  <div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
      <button onclick="openAddModal()" class="btn-orange text-white px-4 py-2 rounded text-sm font-medium">
        + Add New Petugas
      </button>
    </div>

    <div class="mb-4">
      <label class="text-sm">Tampilkan
        <select class="border border-gray-300 rounded px-2 py-1 ml-1 text-sm">
          <option>10</option><option>25</option><option>50</option>
        </select> data
      </label>
    </div>

    <div class="flex justify-end mb-2">
      <form method="GET" class="flex gap-2">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari nama/jabatan..." class="border border-gray-300 rounded px-3 py-1 text-sm">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Cari</button>
      </form>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border-t">
        <thead class="table-header">
          <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nama Petugas</th>
            <th class="px-4 py-2">Jabatan</th>
            <th class="px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($total_data === 0): ?>
            <script>
              Swal.fire({ icon: 'info', title: 'Tidak ditemukan', text: 'Data tidak ditemukan.', timer: 3000, showConfirmButton: false });
            </script>
            <tr><td colspan="4" class="text-center py-4 text-gray-500 italic">Data tidak ditemukan.</td></tr>
          <?php else: ?>
            <?php $no = $offset + 1; while ($row = mysqli_fetch_assoc($data)): ?>
              <tr class="border-b table-row">
                <td class="px-4 py-2"><?= $no++ ?></td>
                <td class="px-4 py-2"><?= $row['nama_petugas'] ?></td>
                <td class="px-4 py-2"><?= $row['nama_jabatan'] ?></td>
                <td class="px-4 py-2 text-center">
                  <button onclick="openEditModal(<?= $row['id'] ?>, '<?= addslashes($row['nama_petugas']) ?>', <?= $row['id_jabatan'] ?>)" class="text-orange-600 hover:text-orange-800 mx-1" title="Edit">
                    <i class="fas fa-pen"></i>
                  </button>
                  <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:text-red-800 mx-1" title="Delete">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
      <div>Menampilkan <?= $offset + 1 ?> sampai <?= min($offset + $limit, $total_data) ?> dari <?= $total_data ?> data</div>
      <div class="flex items-center space-x-2">
        <?php if ($page > 1): ?><a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>" class="px-2 py-1 border rounded hover:bg-gray-100">&laquo; Sebelumnya</a><?php endif; ?>
        <span class="px-3 py-1 border rounded bg-blue-500 text-white"><?= $page ?></span>
        <?php if ($page < $total_pages): ?><a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>" class="px-2 py-1 border rounded hover:bg-gray-100">Berikutnya &raquo;</a><?php endif; ?>
      </div>
    </div>
  </div>
</main>

<!-- Modal Tambah -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white w-96 rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4 text-orange-700">Tambah Petugas</h2>
    <form method="POST" action="tambah.php">
      <label class="block mb-2 text-sm font-medium">Nama Petugas</label>
      <input type="text" name="nama_petugas" class="w-full border px-3 py-2 rounded mb-3" required>

      <label class="block mb-2 text-sm font-medium">Jabatan</label>
      <select name="id_jabatan" class="w-full border px-3 py-2 rounded mb-4" required>
        <option value="">-- Pilih Jabatan --</option>
        <?php
        $jabatan_q = mysqli_query($conn, "SELECT * FROM jabatan ORDER BY nama_jabatan ASC");
        while ($j = mysqli_fetch_assoc($jabatan_q)) {
          echo "<option value='{$j['id']}'>{$j['nama_jabatan']}</option>";
        }
        ?>
      </select>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeAddModal()" class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
        <button type="submit" class="px-4 py-2 btn-orange text-white rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
  <div class="bg-white w-96 rounded-lg shadow p-6">
    <h2 class="text-lg font-semibold mb-4 text-orange-700">Edit Petugas</h2>
    <form method="POST" action="edit.php">
      <input type="hidden" name="id" id="editId">
      <label class="block mb-2 text-sm font-medium">Nama Petugas</label>
      <input type="text" name="nama_petugas" id="editNama" class="w-full border px-3 py-2 rounded mb-3" required>

      <label class="block mb-2 text-sm font-medium">Jabatan</label>
      <select name="id_jabatan" id="editJabatan" class="w-full border px-3 py-2 rounded mb-4" required>
        <?php
        $jabatan_q = mysqli_query($conn, "SELECT * FROM jabatan ORDER BY nama_jabatan ASC");
        while ($j = mysqli_fetch_assoc($jabatan_q)) {
          echo "<option value='{$j['id']}'>{$j['nama_jabatan']}</option>";
        }
        ?>
      </select>

      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
        <button type="submit" class="px-4 py-2 btn-orange text-white rounded">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
function openAddModal() {
  document.getElementById('addModal').classList.remove('hidden');
  document.getElementById('addModal').classList.add('flex');
}
function closeAddModal() {
  document.getElementById('addModal').classList.add('hidden');
}

function openEditModal(id, nama, jabatan_id) {
  document.getElementById('editId').value = id;
  document.getElementById('editNama').value = nama;
  document.getElementById('editJabatan').value = jabatan_id;
  document.getElementById('editModal').classList.remove('hidden');
  document.getElementById('editModal').classList.add('flex');
}
function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
}
</script>

</body>
</html>
