<?php
require '../config/auth_resepsionis.php';
include '../config/koneksi.php';
include '../layouts/sidebar-resepsionis.php'; // sesuaikan jika file sidebar berbeda


// Ambil statistik sederhana (bisa kamu tambah sesuai kebutuhan)
$totalTamu = (int) mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM tamu"))['total'];
$hariIni   = date('Y-m-d');
$tamuHariIni = (int) mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM tamu WHERE DATE(tanggal)='$hariIni'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Resepsionis</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            cream: '#fffaf0',
            orangeSoft: '#fed7aa',
            orangeDark: '#c2410c'
          }
        }
      }
    }
  </script>
  <style>
    body { background-color: #fffaf0; }
  </style>
</head>
<body class="bg-cream text-gray-900">

  <!-- Header -->
  <header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 left-64 right-0 z-40">
    <h1 class="text-2xl font-bold text-orangeDark">Dashboard Resepsionis</h1>
    <div id="profileBtn" class="flex items-center gap-2 cursor-pointer relative">
      <img src="https://i.pravatar.cc/40?u=resepsionis" class="w-10 h-10 rounded-full object-cover" alt="resepsionis">
      <span class="font-semibold text-gray-700"><?= htmlspecialchars($_SESSION['username']) ?></span>
      <div id="dropdownProfile" class="absolute right-0 mt-12 w-48 bg-white rounded shadow-lg hidden">
      </div>
    </div>
  </header>

  <!-- Konten -->
  <main class="pt-24 px-4 md:px-8 space-y-6 ml-64">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <div class="bg-orange-100 p-4 rounded-lg shadow text-center">
        <p class="text-sm">Total Tamu</p>
        <p class="text-2xl font-bold text-orangeDark"><?= $totalTamu ?></p>
      </div>
      <div class="bg-orange-100 p-4 rounded-lg shadow text-center">
        <p class="text-sm">Tamu Hari Ini</p>
        <p class="text-2xl font-bold text-orangeDark"><?= $tamuHariIni ?></p>
      </div>
    </div>
  </main>

  <!-- JS untuk dropdown -->
  <script>
    const pBtn = document.getElementById('profileBtn');
    const drop = document.getElementById('dropdownProfile');
    pBtn.addEventListener('click', e => {
      e.stopPropagation();
      drop.classList.toggle('hidden');
    });
    window.addEventListener('click', () => drop.classList.add('hidden'));
  </script>

</body>
</html>

