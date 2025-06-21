<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}
include '../config/koneksi.php';
include '../layouts/sidebar-admin.php';

// === Statistik ===
$totalTamu     = (int) mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM tamu"))['total'];
$hariIni       = date('Y-m-d');
$tamuHariIni   = (int) mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM tamu WHERE DATE(tanggal)='$hariIni'"))['total'];
$rataBulanan   = (int) mysqli_fetch_assoc(mysqli_query($conn,"SELECT ROUND(COUNT(*)/COUNT(DISTINCT DATE_FORMAT(tanggal,'%Y-%m'))) rata FROM tamu"))['rata'];
$totalPetugas  = (int) mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM petugas"))['total'];

// === Grafik Departemen ===
$deptRes = mysqli_query($conn,"SELECT departemen,COUNT(*) jumlah FROM tamu GROUP BY departemen ORDER BY jumlah DESC");
$deptLabels=$deptCounts=[]; while($r=mysqli_fetch_assoc($deptRes)){ $deptLabels[]=$r['departemen']; $deptCounts[]=(int)$r['jumlah']; }

// === Grafik Keperluan ===
$kepRes = mysqli_query($conn,"SELECT keperluan,COUNT(*) jumlah FROM tamu GROUP BY keperluan ORDER BY jumlah DESC");
$kepLabels=$kepCounts=[]; while($r=mysqli_fetch_assoc($kepRes)){ $kepLabels[]=$r['keperluan']; $kepCounts[]=(int)$r['jumlah']; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    tailwind.config={theme:{extend:{colors:{cream:'#fffaf0',orangeSoft:'#fed7aa',orangeDark:'#c2410c'}}}}
  </script>
  <style>body{background:#fffaf0}</style>
</head>
<body class="bg-cream text-gray-900">

  <!-- Header dengan profile kanan -->
  <header class="bg-white py-4 px-6 shadow flex justify-between items-center fixed top-0 left-64 right-0 z-40">
    <div class="flex items-center space-x-4">
      <h1 class="text-2xl font-bold text-orangeDark">Dashboard Admin</h1>
    </div>
    <div id="profileBtn" class="flex items-center gap-2 cursor-pointer relative">
      <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full object-cover" alt="admin">
      <span class="font-semibold text-gray-700">Admin</span>
      <div id="dropdownProfile" class="absolute right-0 mt-12 w-48 bg-white rounded shadow-lg hidden">
      </div>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main class="pt-24 px-4 md:px-8 space-y-6 ml-64">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-orange-100 p-4 rounded-lg shadow text-center"><p class="text-sm">Total Tamu</p><p class="text-2xl font-bold text-orangeDark"><?=$totalTamu?></p></div>
      <div class="bg-orange-100 p-4 rounded-lg shadow text-center"><p class="text-sm">Tamu Hari Ini</p><p class="text-2xl font-bold text-orangeDark"><?=$tamuHariIni?></p></div>
      <div class="bg-orange-100 p-4 rounded-lg shadow text-center"><p class="text-sm">Rata-rata/Bulan</p><p class="text-2xl font-bold text-orangeDark"><?=$rataBulanan?></p></div>
      <div class="bg-orange-100 p-4 rounded-lg shadow text-center"><p class="text-sm">Jumlah Petugas</p><p class="text-2xl font-bold text-orangeDark"><?=$totalPetugas?></p></div>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
      <h2 class="text-lg font-semibold text-orangeDark mb-4">Kunjungan per Departemen</h2>
      <canvas id="departemenChart" height="90"></canvas>
    </div>

    <div class="bg-white rounded-lg shadow p-4">
      <h2 class="text-lg font-semibold text-orangeDark mb-4">Topik Keperluan yang Sering Dibahas</h2>
      <canvas id="keperluanChart" height="90"></canvas>
    </div>
  </main>

  <!-- JS -->
  <script>
    const pBtn=document.getElementById('profileBtn'); const drop=document.getElementById('dropdownProfile');
    pBtn.addEventListener('click',e=>{e.stopPropagation();drop.classList.toggle('hidden');});
    window.addEventListener('click',()=>drop.classList.add('hidden'));
    
    new Chart(document.getElementById('departemenChart'),{
      type:'line',
      data:{labels:<?=json_encode($deptLabels)?>,datasets:[{data:<?=json_encode($deptCounts)?>,label:'Kunjungan',borderColor:'#fb923c',backgroundColor:'rgba(251,146,60,0.25)',tension:0.3,fill:true,pointRadius:4,pointBackgroundColor:'#fb923c'}]},
      options:{plugins:{legend:{display:false}},scales:{y:{beginAtZero:true},x:{grid:{display:false}}}}
    });

    new Chart(document.getElementById('keperluanChart'),{
      type:'bar',
      data:{labels:<?=json_encode($kepLabels)?>,datasets:[{data:<?=json_encode($kepCounts)?>,backgroundColor:'#f97316',label:'Jumlah'}]},
      options:{plugins:{legend:{display:false}},scales:{y:{beginAtZero:true}}}
    });
    
  </script>
</body>
</html>
