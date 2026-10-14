// BAB III: Manipulasi DOM dan Toast/Snackbar untuk Landing Page Roda Care
 document.addEventListener("DOMContentLoaded", function () {
   const toast = document.getElementById("toast");
   let toastTimer;

   // DOM 1: menampilkan toast/snackbar.
   function showToast(message) {
     toast.textContent = message;
     toast.classList.add("show");
     clearTimeout(toastTimer);
     toastTimer = setTimeout(function () {
       toast.classList.remove("show");
     }, 2800);
   }

   // DOM 2: menu navigasi mobile dibuka/tutup melalui classList.
   const menuToggle = document.getElementById("menuToggle");
   const navLinks = document.querySelector(".nav-links");
   menuToggle.addEventListener("click", function () {
     const isOpen = navLinks.classList.toggle("show");
     menuToggle.setAttribute("aria-expanded", String(isOpen));
     menuToggle.setAttribute("aria-label", isOpen ? "Tutup menu" : "Buka menu");
     showToast(isOpen ? "Menu navigasi dibuka." : "Menu navigasi ditutup.");
   });

   // DOM 3: tombol tema mengubah class pada elemen body.
   const themeToggle = document.getElementById("themeToggle");
   themeToggle.addEventListener("click", function () {
     const isDark = document.body.classList.toggle("dark-mode");
     themeToggle.textContent = isDark ? "☀️" : "🌙";
     themeToggle.setAttribute("aria-label", isDark ? "Gunakan tema terang" : "Gunakan tema gelap");
     showToast(isDark ? "Tema gelap diaktifkan." : "Tema terang diaktifkan.");
   });

   // DOM 4: pencarian menyaring kartu layanan sesuai kata kunci.
   const serviceSearch = document.getElementById("serviceSearch");
   const serviceCards = document.querySelectorAll(".service-card");
   serviceSearch.addEventListener("input", function () {
     const keyword = serviceSearch.value.trim().toLowerCase();
     let visibleCount = 0;
     serviceCards.forEach(function (card) {
       const matches = card.textContent.toLowerCase().includes(keyword);
       card.classList.toggle("filtered-out", !matches);
       if (matches) visibleCount++;
     });
     if (keyword.length > 0) {
       showToast(visibleCount > 0 ? visibleCount + " layanan ditemukan." : "Layanan tidak ditemukan.");
     }
   });

   // DOM 5: tahun pada footer diperbarui otomatis.
   document.getElementById("currentYear").textContent = new Date().getFullYear();

   // Tampilkan notifikasi selamat datang saat landing page dibuka.
   showToast("Selamat datang di Roda Care!");
 });
