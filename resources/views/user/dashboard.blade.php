<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Absensi Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    /* Scrollbar for sidebar */
    ::-webkit-scrollbar {
      width: 6px;
    }
    ::-webkit-scrollbar-track {
      background: transparent;
    }
    ::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }
    .today {
      background-color: #3b82f6; /* Warna biru untuk hari ini */
      color: white; /* Teks putih untuk kontras */
      border-radius: 0.5rem; /* Sudut membulat */
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col md:flex-row">

  <!-- Sidebar -->
  <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-52 bg-blue-600 text-white rounded-r-3xl shadow-lg flex flex-col transform md:relative md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
    <div class="p-6">
      <h1 class="text-4xl font-bold tracking-wide mb-8">Dinas Luar</h1>
      <nav aria-label="Main Navigation" class="space-y-4 mb-12">
        <a href="{{ url('dashboard') }}" class="flex items-center px-4 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 transition font-mono">
          <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
        
        <a href="{{ url('userp') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-user mr-2"></i> Laporan DL
        </a>
        
        <a href="{{ url('loginp') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-sign-out-alt mr-2"></i> Log out
        </a>
      </nav>
    </div>
  </aside>

  <!-- Mobile hamburger button -->
  <button id="sidebarToggle" aria-label="Toggle sidebar" class="md:hidden fixed top-4 left-4 z-40 bg-blue-600 text-white p-2 rounded-md shadow-md hover:bg-blue-700 transition">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>

  <!-- Main content area -->
  <main class="flex-1 p-6 md:ml-52 overflow-auto min-h-screen">
    <header class="mb-8 flex justify-between items-center">
      <div>
        <h2 class="text-3xl font-bold text-gray-800">Dashboard Dinas Luar </h2>
        <p class="mt-2 text-gray-600 max-w-md">Ringkasan data kehadiran karyawan hari ini.</p>
      </div>
      <div class="flex items-center space-x-3">
        <span class="text-gray-700 text-lg font-semibold select-none">Halo<span id="userName">Budi Santoso</span></span>
        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff&rounded=true&size=32" alt="Avatar User" class="w-8 h-8 rounded-full border-2 border-blue-600" />
      </div>
    </header>

    <!-- Kotak Welcome -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
      <h3 class="text-xl font-semibold">Selamat Datang<span id="userName"></span>!</h3>
      <p class="mt-2 text-gray-600">Kami senang Anda kembali. Berikut adalah ringkasan kehadiran Anda hari ini.</p>
    </div>

    <!-- Kalender -->
    <div class="bg-white p-4 rounded-lg shadow-md mb-6">
      <h3 class="text-xl font-semibold mb-4">Kalender</h3>
      <div class="grid grid-cols-7 text-center">
        <div class="font-bold">Min</div>
        <div class="font-bold">Sen</div>
        <div class="font-bold">Sel</div>
        <div class="font-bold">Rab</div>
        <div class="font-bold">Kam</div>
        <div class="font-bold">Jum</div>
        <div class="font-bold">Sab</div>
      </div>
      <div class="grid grid-cols-7 text-center mt-2" id="calendar-body">
        <!-- Kalender akan diisi di sini oleh JavaScript -->
      </div>
    </div>
  </main>

  <script>
    // For demonstration, username is Budi Santoso
    const userName = "selamat datang";
    document.getElementById('userName').textContent = userName;

    // Render Calendar
    function renderCalendar() {
      const calendarBody = document.getElementById('calendar-body');
      calendarBody.innerHTML = ''; // Kosongkan isi sebelumnya

      const date = new Date();
      const year = date.getFullYear();
      const month = date.getMonth(); // 0-11
      const today = date.getDate(); // Tanggal hari ini
      const firstDay = new Date(year, month, 1).getDay(); // Hari pertama bulan ini
      const lastDate = new Date(year, month + 1, 0).getDate(); // Tanggal terakhir bulan ini

      // Kosongkan sel untuk hari sebelum tanggal 1
      for (let i = 0; i < firstDay; i++) {
          const emptyCell = document.createElement('div');
          calendarBody.appendChild(emptyCell);
      }

      // Isi tanggal
      for (let day = 1; day <= lastDate; day++) {
          const dayCell = document.createElement('div');
          dayCell.className = "border p-2";
          dayCell.textContent = day;

          // Tandai hari ini
          if (day === today) {
              dayCell.classList.add('today');
          }

          calendarBody.appendChild(dayCell);
      }
    }

    // Panggil fungsi untuk merender kalender saat halaman dimuat
    renderCalendar();

    // Sidebar toggle for mobile
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // Initialize sidebar hidden on mobile by default
    function initSidebar() {
        if (window.innerWidth < 768) {
            sidebar.classList.add('-translate-x-full');
        }
    }
    window.addEventListener('resize', () => {
        if(window.innerWidth >= 768){
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    });
    initSidebar();
  </script>

</body>
</html>
