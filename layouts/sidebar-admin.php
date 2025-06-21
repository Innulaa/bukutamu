<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<style>
  #sidebar {
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    opacity: 1;
  }

  .sidebar-hidden {
    transform: translateX(-100%);
    opacity: 0;
  }
</style>

<!-- Tombol Hamburger -->
<div class="p-4">
  <button id="toggleSidebar" class="text-3xl focus:outline-none text-orange-800">
    &#9776;
  </button>
</div>

<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-orange-100 p-6 shadow-lg sidebar-hidden z-50 overflow-y-auto">
  <h2 class="text-2xl font-bold text-orange-700 mb-6">Menu</h2>
  <ul class="space-y-6 text-gray-800">

    <!-- HOME -->
    <li class="text-sm text-orange-700 uppercase font-semibold">Home</li>
    <li>
      <a href="../admin/dashboard.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">📊</span> Dashboard
      </a>
    </li>

    <!-- TOOLS & KOMPONEN -->
    <li class="text-sm text-orange-700 uppercase font-semibold mt-6">Tools & Komponen</li>
    <li>
      <a href="../admin/data-tamu.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">🧾</span> Tamu
      </a>
    </li>
    <li>
      <a href="../tamu/index.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">🛠️</span> Kelola Tamu
      </a>
    </li>
    <li>
      <a href="../keperluan/index.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">📌</span> Jenis Keperluan
      </a>
    </li>
    <li>
      <a href="../petugas/index.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">👮</span> Data Petugas
      </a>
    </li>
    <li>
      <a href="../departemen/index.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">🏢</span> Departemen
      </a>
    </li>
    <li>
      <a href="../jabatan/index.php" class="flex items-center text-lg hover:text-orange-600">
        <span class="text-2xl mr-3">💼</span> Jabatan
      </a>
    </li>
    <!-- LOGOUT -->
   <a href="../logout.php" onclick="confirmLogout()" class="flex items-center text-lg text-red-500 font-semibold hover:text-red-700">
  <span class="text-2xl mr-3">🚪</span> Logout
</a>

    </li>
  </ul>
</div>

<script>
  const btn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const main = document.querySelector('main');

  let isSidebarOpen = false;

  btn.addEventListener('click', () => {
    sidebar.classList.toggle('sidebar-hidden');
    isSidebarOpen = !isSidebarOpen;

    if (main) {
      main.classList.toggle('ml-64');
    }
  });

  document.addEventListener('mousemove', (event) => {
    if (
      isSidebarOpen &&
      !sidebar.contains(event.target) &&
      !btn.contains(event.target)
    ) {
      sidebar.classList.add('sidebar-hidden');
      if (main) {
        main.classList.remove('ml-64');
      }
      isSidebarOpen = false;
    }
  });

  function confirmLogout() {
  if (confirm("Apakah Anda yakin ingin logout?")) {
    window.location.href = "logout.php";
  }
}

</script>
