<?php
  // Cek apakah file ini dipanggil dari index.php atau dari folder lain
  $baseUrl = basename($_SERVER['PHP_SELF']) === 'index.php' ? '' : '../';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BookOffice</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet" />

  <!-- Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['"Playfair Display"', 'serif'],
          },
          colors: {
            cream: '#fffdf6',
          },
        },
      },
    }
  </script>

  <!-- Scroll effect styling -->
  <style>
    .header-scrolled {
      background-color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="font-sans text-gray-900 bg-cream">

  <!-- Header -->
  <header id="header" class="w-full fixed top-0 left-0 z-50 transition-all duration-300">
    <div class="flex justify-between items-center px-8 py-4 bg-gradient-to-l from-orange-100 to-orange-300 text-gray-900">
      <!-- Logo -->
      <div class="text-3xl font-bold font-display text-gray-900">BookOffice</div>

      <!-- Navigation -->
      <nav class="space-x-6 text-lg font-semibold">
        <a href="<?= $baseUrl ?>index.php#home" class="hover:text-orange-800 transition-colors duration-200">Home</a>
        <a href="<?= $baseUrl ?>index.php#about" class="hover:text-orange-800 transition-colors duration-200">About</a>
        <a href="<?= $baseUrl ?>index.php#contact" class="hover:text-orange-800 transition-colors duration-200">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Spacer -->
  <div class="pt-24"></div>

  <!-- Scroll script -->
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
