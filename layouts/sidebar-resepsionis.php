<?php
// sidebar-resepsionis.php
?>

<aside class="fixed top-0 left-0 w-64 h-full bg-orange-100 shadow-md z-50">
  <div class="py-5 px-6 border-b border-orange-200">
    <h2 class="text-xl font-bold text-orange-800">Resepsionis Panel</h2>
  </div>
  <nav class="px-4 mt-4">
    <a href="../resepsionis/dashboard.php" class="block py-2 px-4 rounded hover:bg-orange-200 text-orange-800 font-medium mb-1">
      Dashboard
    </a>
    <a href="../resepsionis/input-tamu.php" class="block py-2 px-4 rounded hover:bg-orange-200 text-orange-800 font-medium mb-1">
      Input Tamu
    </a>
    <a href="../resepsionis/daftar_tamu.php" class="block py-2 px-4 rounded hover:bg-orange-200 text-orange-800 font-medium mb-1">
      Daftar Tamu
    </a>
    <a href="../logout.php" onclick="return confirmLogout()" class="block py-2 px-4 rounded hover:bg-orange-200 text-red-600 font-medium mt-8">

      Logout
    </a>

    <script>
  function confirmLogout() {
    return confirm("Yakin ingin logout?");
  }
</script>
  </nav>
</aside>
