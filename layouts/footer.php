    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-orange-100 to-orange-300 text-orange-900 text-center py-4 text-sm shadow-inner font-medium">
      © 2025 eHadir. All Rights Reserved.
    </footer>

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
