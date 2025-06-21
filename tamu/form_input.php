<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Hubungkan ke koneksi database
include '../config/koneksi.php';

// Ambil data dari database
$departemen = mysqli_query($conn, "SELECT * FROM departemen");
$keperluan = mysqli_query($conn, "SELECT * FROM keperluan");

// Ambil petugas beserta jabatan
$petugas = mysqli_query($conn, "SELECT petugas.nama_petugas, jabatan.nama_jabatan 
                                FROM petugas 
                                JOIN jabatan ON petugas.id_jabatan = jabatan.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GuestBook - Form Input</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .header-scrolled {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    input:focus,
    select:focus {
      outline: none;
      border-color: #fb923c;
      box-shadow: 0 0 0 1.5px #f97316;
    }
  </style>
</head>
<body class="font-sans text-gray-900 bg-gray-100">
  <?php include '../layouts/header.php'; ?>

  <!-- Form Section -->
  <main class="pt-28 pb-16 flex justify-center items-center min-h-screen bg-gray-100">
    <form action="tambah.php" method="POST" class="w-full max-w-xl bg-white p-10 rounded shadow">
      <h2 class="text-2xl font-bold text-center font-serif text-gray-800 mb-4">
        Form Input Perwakilan Penghubung Instansi
      </h2>
      <hr class="border-t-2 border-orange-200 mb-6" />

      <label class="block mb-2 font-semibold">Nama Perwakilan Penghubung Instansi</label>
      <input name="nama" type="text" class="w-full mb-4 px-4 py-2 border rounded" placeholder="Nama Lengkap" required />

      <label class="block mb-2 font-semibold">No Telepon</label>
      <input name="telepon" type="text" class="w-full mb-4 px-4 py-2 border rounded" placeholder="Nomor Telepon" required />

      <label class="block mb-2 font-semibold">Waktu Kehadiran</label>
      <input name="tanggal" type="date" class="w-full mb-4 px-4 py-2 border rounded" required />

      <label class="block mb-2 font-semibold">Asal Instansi</label>
      <input name="instansi" type="text" class="w-full mb-4 px-4 py-2 border rounded" placeholder="Kantor / Instansi" required />

      <label class="block mb-2 font-semibold">Departemen</label>
      <select name="departemen" class="w-full mb-4 px-4 py-2 border rounded" required>
        <option value="">Pilih Departemen</option>
        <?php while ($row = mysqli_fetch_assoc($departemen)) : ?>
          <option value="<?= htmlspecialchars($row['nama_departemen']) ?>">
            <?= htmlspecialchars($row['nama_departemen']) ?>
          </option>
        <?php endwhile; ?>
      </select>

      <label class="block mb-2 font-semibold">Nama Pegawai yang Dituju</label>
      <select name="petugas" class="w-full mb-4 px-4 py-2 border rounded" required>
        <option value="">Pilih Pegawai</option>
        <?php while ($row = mysqli_fetch_assoc($petugas)) : ?>
          <option value="<?= htmlspecialchars($row['nama_petugas']) ?>">
            <?= htmlspecialchars($row['nama_petugas']) ?> (<?= htmlspecialchars($row['nama_jabatan']) ?>)
          </option>
        <?php endwhile; ?>
      </select>

      <label class="block mb-2 font-semibold">Keperluan</label>
      <select name="keperluan" class="w-full mb-6 px-4 py-2 border rounded" required>
        <option value="">Pilih Keperluan</option>
        <?php while ($row = mysqli_fetch_assoc($keperluan)) : ?>
          <option value="<?= htmlspecialchars($row['nama_keperluan']) ?>">
            <?= htmlspecialchars($row['nama_keperluan']) ?>
          </option>
        <?php endwhile; ?>
      </select>

      <button type="submit" class="w-full bg-orange-300 text-white py-3 rounded font-semibold hover:bg-orange-400 transition">
        Simpan Data
      </button>
    </form>
  </main>

  <!-- Modal Success -->
  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white rounded-lg p-6 max-w-sm text-center shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Berhasil disimpan!</h3>
        <button id="okButton" class="bg-orange-300 text-white px-6 py-2 rounded hover:bg-orange-400 transition">
          Oke
        </button>
      </div>
    </div>

    <script>
      document.getElementById('okButton').addEventListener('click', () => {
        window.location.href = 'list_tamu.php';
      });
    </script>
  <?php endif; ?>

  <script>
    const header = document.getElementById("header");
    window.addEventListener("scroll", () => {
      if (window.scrollY > 50) {
        header.classList.add("header-scrolled");
      } else {
        header.classList.remove("header-scrolled");
      }
    });
  </script>
</body>
</html>
