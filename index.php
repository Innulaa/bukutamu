<?php include 'layouts/header.php'; ?>

<!-- Tambahkan AOS (Animate On Scroll) -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<!-- Sticky Header (via Tailwind, pastikan header.php mendukung sticky) -->
<style>
  header {
    position: sticky;
    top: 0;
    z-index: 50;
    background-color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
</style>

<!-- Hero -->
<section id="home" class="relative">
  <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e" alt="Building" class="w-full h-[600px] object-cover" />
  <div class="absolute top-32 left-8 text-white max-w-md" data-aos="fade-right">
    <h1 class="text-4xl font-extrabold">WELCOME In our<br />company</h1>
    <p class="mt-4 text-lg font-semibold">We are a professional team to manage your business.</p>
    <a href="tamu/form_input.php" class="inline-block mt-6 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-full transition">Get Started</a>
  </div>
</section>

<!-- About -->
<section id="about" class="flex flex-col md:flex-row items-center justify-center gap-8 px-8 py-16 bg-yellow-50" data-aos="fade-up">
  <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Building Icon" class="w-40 h-40" />
  <div class="max-w-lg">
    <h2 class="text-2xl font-bold text-amber-700 mb-2">About the company</h2>
    <p class="text-gray-700">GuestBook is a team of professionals committed to providing the best service to help your business grow digitally.</p>
  </div>
</section>

<!-- Statistik -->
<section class="px-8 py-16 bg-white text-center" data-aos="zoom-in-up">
  <h2 class="text-2xl font-bold text-amber-700 mb-10">Statistik Kunjungan Tamu Kantor</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
    <div class="bg-yellow-100 rounded-lg p-6 shadow-lg" data-aos="flip-left">
      <div class="text-4xl">👥</div>
      <p class="text-2xl font-bold mt-2 text-amber-700">20</p>
      <p>Total Tamu</p>
    </div>
    <div class="bg-yellow-100 rounded-lg p-6 shadow-lg" data-aos="flip-left" data-aos-delay="100">
      <div class="text-4xl">📅</div>
      <p class="text-2xl font-bold mt-2 text-amber-700">20</p>
      <p>Rata-Rata Tamu Perbulan</p>
    </div>
    <div class="bg-yellow-100 rounded-lg p-6 shadow-lg" data-aos="flip-left" data-aos-delay="200">
      <div class="text-4xl">🗓️</div>
      <p class="text-2xl font-bold mt-2 text-amber-700">1</p>
      <p>Jumlah Tamu Hari Ini</p>
    </div>
  </div>
</section>

<!-- Contact -->
<section id="contact" class="px-8 py-16 bg-yellow-50 flex flex-col md:flex-row justify-between items-start gap-8" data-aos="fade-up">
  <div>
    <h2 class="text-2xl font-bold text-amber-700 mb-4">Contact Us</h2>
    <p class="flex items-center gap-2 mb-2">📍 <strong>Alamat:</strong> Jl. Imam Bonjol II, Kedamaian, Tanjung Karang</p>
    <p class="flex items-center gap-2 mb-2">📧 <strong>Email:</strong> GuestBookOffice@gmail.com</p>
    <p class="flex items-center gap-2">📞 <strong>Call:</strong> 08227345689</p>
  </div>
  <iframe
    src="https://www.google.com/maps?q=Tanjung+Karang,+Lampung&output=embed"
    class="w-full md:w-1/2 h-64 rounded-md border-2"
    allowfullscreen=""
    loading="lazy"
  ></iframe>
</section>

<?php include 'layouts/footer.php'; ?>
