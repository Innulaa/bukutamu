<?php


require '../config/auth.php';
require '../config/koneksi.php';
include '../layouts/sidebar-admin.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$where = $search ? "WHERE nama_departemen LIKE '%$search%'" : '';
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM departemen $where");
$total_data = mysqli_fetch_assoc($total_query)['total'];
$total_pages = ceil($total_data / $limit);

$data = mysqli_query($conn, "SELECT * FROM departemen $where ORDER BY id DESC LIMIT $limit OFFSET $offset");

$success = isset($_GET['success']) ? $_GET['success'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Departemen</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background: #f0f4f8; }
    .notif-success {
      background-color: #FFF7E0;
      border: 1px solid #FFE8B0;
      color: #CC8B00;
    }
    .btn-orange {
      background-color: #FFA726;
    }
    .btn-orange:hover {
      background-color: #FB8C00;
    }
    .table-header {
      background-color: #FFE0B2;
      color: #5D4037;
    }
    .table-row:hover {
      background-color: #FFF3E0;
    }
  </style>
</head>
<body class="text-gray-800">

<header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 left-64 right-0 z-40">
  <h1 class="text-xl font-bold text-orange-600">Data Departemen</h1>
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
        + Add New Departemen
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
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Cari departemen..." class="border border-gray-300 rounded px-3 py-1 text-sm">
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600">Cari</button>
      </form>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left border-t">
        <thead class="table-header">
          <tr>
            <th class="px-4 py-2">No</th>
            <th class="px-4 py-2">Nama Departemen</th>
            <th class="px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($total_data === 0): ?>
            <script>
              Swal.fire({
                icon: 'info',
                title: 'Tidak ditemukan',
                text: 'Data dengan kata kunci "<?= htmlspecialchars($search) ?>" tidak ditemukan.',
                timer: 3000,
                showConfirmButton: false
              });
            </script>
            <tr>
              <td colspan="3" class="text-center py-4 text-gray-500 italic">Data tidak ditemukan.</td>
            </tr>
          <?php else: ?>
            <?php $no = $offset + 1; while ($row = mysqli_fetch_assoc($data)): ?>
              <tr class="border-b table-row">
                <td class="px-4 py-2"><?= $no++ ?></td>
                <td class="px-4 py-2"><?= $row['nama_departemen'] ?></td>
                <td class="px-4 py-2 text-center">
                  <button onclick="openEditModal(<?= $row['id'] ?>, '<?= addslashes($row['nama_departemen']) ?>')" class="text-orange-600 hover:text-orange-800 mx-1" title="Edit">
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
      <div>
        Menampilkan <?= $offset + 1 ?> sampai <?= min($offset + $limit, $total_data) ?> dari <?= $total_data ?> data
      </div>
      <div class="flex items-center space-x-2">
        <?php if ($page > 1): ?>
          <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>" class="px-2 py-1 border rounded hover:bg-gray-100">&laquo; Sebelumnya</a>
        <?php endif; ?>
        <span class="px-3 py-1 border rounded bg-blue-500 text-white"><?= $page ?></span>
        <?php if ($page < $total_pages): ?>
          <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>" class="px-2 py-1 border rounded hover:bg-gray-100">Berikutnya &raquo;</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<script>
function openAddModal() {
  // implementasikan sesuai kebutuhan
}
function openEditModal(id, nama) {
  // implementasikan sesuai kebutuhan
}
</script>

</body>
</html>
