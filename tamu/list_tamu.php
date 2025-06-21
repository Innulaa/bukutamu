<?php
include '../config/koneksi.php';
include '../config/koneksi.php';


$query = "SELECT * FROM tamu ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Tamu - Resepsionis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <style>
    body { background-color: #fffaf0; }
    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid #fb923c;
      border-radius: 6px;
      padding: 4px 8px;
      outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
      box-shadow: 0 0 0 2px rgba(251, 146, 60, 0.5);
      border-color: #f97316;
    }
  </style>
</head>

<body class="text-gray-900">
 

  <main class="ml-64 pt-24 px-6">
    <h1 class="text-3xl font-bold mb-6 text-orange-700">Daftar Tamu</h1>
    <div class="bg-white shadow-md rounded-lg p-4">
      <div class="overflow-x-auto">
        <table id="tabelTamu" class="stripe hover w-full text-sm text-left text-gray-800">
          <thead class="bg-orange-300 text-white">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Telepon</th>
              <th>Instansi</th>
              <th>Departemen</th>
              <th>Keperluan</th>
              <th>Petugas</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['telepon']) ?></td>
                <td><?= htmlspecialchars($row['instansi']) ?></td>
                <td><?= htmlspecialchars($row['departemen']) ?></td>
                <td><?= htmlspecialchars($row['keperluan']) ?></td>
                <td><?= htmlspecialchars($row['petugas']) ?></td>
                <td><?= htmlspecialchars($row['tanggal']) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <script>
    $(document).ready(function () {
      $('#tabelTamu').DataTable({
        responsive: true,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ data",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          paginate: {
            previous: "Sebelumnya",
            next: "Berikutnya"
          }
        }
      });
    });
  </script>
</body>
</html>