<?php
require '../config/auth_resepsionis.php';
include '../config/koneksi.php';
include '../layouts/sidebar-resepsionis.php';

$where = "WHERE 1";
if (!empty($_GET['tanggal'])) {
  $tanggal = mysqli_real_escape_string($conn, $_GET['tanggal']);
  $where .= " AND tamu.tanggal = '$tanggal'";
}
if (!empty($_GET['departemen'])) {
  $departemen = mysqli_real_escape_string($conn, $_GET['departemen']);
  $where .= " AND tamu.departemen = '$departemen'";
}

$query = "SELECT tamu.*, petugas.nama_petugas, jabatan.nama_jabatan
          FROM tamu
          JOIN petugas ON tamu.petugas = petugas.nama_petugas
          JOIN jabatan ON petugas.id_jabatan = jabatan.id
          $where
          ORDER BY tamu.tanggal DESC";
$result = mysqli_query($conn, $query);
$departemenList = mysqli_query($conn, "SELECT DISTINCT nama_departemen FROM departemen");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tamu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <style>
    .header-scrolled {
      background-color: #ffffff !important;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      color: #9a3412;
    }
    .header-scrolled .text-2xl { font-size: 1.25rem; }
    .header-scrolled nav a     { color: #9a3412; }
  </style>
</head>
<body class="font-sans text-gray-900 bg-gray-100">
      <!-- Header -->
  <header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 left-64 right-0 z-40">
    <h1 class="text-2xl font-bold mb-6 text-orange-700">Dashboard Resepsionis</h1>
    <div id="profileBtn" class="flex items-center gap-2 cursor-pointer relative">
      <img src="https://i.pravatar.cc/40?u=resepsionis" class="w-10 h-10 rounded-full object-cover" alt="resepsionis">
      <span class="font-semibold text-gray-700"><?= htmlspecialchars($_SESSION['username']) ?></span>
      <div id="dropdownProfile" class="absolute right-0 mt-12 w-48 bg-white rounded shadow-lg hidden">
      </div>
    </div>
  </header>

  <div class="pt-32 max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-orange-700">Daftar Tamu</h1>

    <form method="GET" class="mb-6 flex flex-wrap gap-4 bg-white p-4 rounded shadow">
      <div>
        <label class="block text-sm font-medium">Filter Tanggal</label>
        <input type="date" name="tanggal" value="<?= isset($_GET['tanggal']) ? htmlspecialchars($_GET['tanggal']) : '' ?>" class="border rounded px-3 py-1">
      </div>
      <div>
        <label class="block text-sm font-medium">Filter Departemen</label>
        <select name="departemen" class="border rounded px-3 py-1">
          <option value="">Semua</option>
          <?php while ($row = mysqli_fetch_assoc($departemenList)): ?>
            <option value="<?= htmlspecialchars($row['nama_departemen']) ?>" <?= (isset($_GET['departemen']) && $_GET['departemen'] == $row['nama_departemen']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($row['nama_departemen']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="flex items-end">
        <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Terapkan</button>
      </div>
    </form>

    <div class="bg-white shadow-md rounded-lg p-4">
      <div class="overflow-x-auto">
        <table id="tabelTamu" class="stripe hover w-full text-sm text-left text-gray-800 mt-6">
          <thead class="bg-orange-500 text-white">
            <tr>
              <th>No</th>
              <th>Nama Perwakilan</th>
              <th>No Telepon</th>
              <th>Instansi</th>
              <th>Departemen</th>
              <th>Keperluan</th>
              <th>Nama Pegawai yang Dituju</th>
              <th>Jabatan</th>
              <th>Tanggal Datang</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama']); ?></td>
                <td><?= htmlspecialchars($row['telepon']); ?></td>
                <td><?= htmlspecialchars($row['instansi']); ?></td>
                <td><?= htmlspecialchars($row['departemen']); ?></td>
                <td><?= htmlspecialchars($row['keperluan']); ?></td>
                <td><?= htmlspecialchars($row['nama_petugas']); ?></td>
                <td><?= htmlspecialchars($row['nama_jabatan']); ?></td>
                <td><?= htmlspecialchars($row['tanggal']); ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      $('#tabelTamu').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excelHtml5',
            title: 'Data Tamu',
            className: 'bg-green-500 text-white px-3 py-1 rounded mr-2'
          },
          {
            extend: 'pdfHtml5',
            title: 'Data Tamu',
            orientation: 'landscape',
            pageSize: 'A4',
            className: 'bg-red-500 text-white px-3 py-1 rounded'
          }
        ],
        language: {
          search:       "Cari:",
          lengthMenu:   "Tampilkan _MENU_ data",
          info:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          paginate: { previous: "Sebelumnya", next: "Berikutnya" }
        }
      });
    });

    window.addEventListener('scroll', () => {
      const header = document.getElementById('header');
      window.scrollY > 10
        ? header.classList.add('header-scrolled')
        : header.classList.remove('header-scrolled');
    });
  </script>
</body>
</html>
