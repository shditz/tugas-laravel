<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absensi Lokasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
    <h2 class="text-2xl font-bold text-center mb-4 text-blue-600">Absensi Lokasi</h2>

    <!-- Tanggal -->
    <div class="text-center mb-4">
      <p id="currentDate" class="text-sm text-gray-500"></p>
    </div>

    <!-- Info User -->
    <div class="text-center mb-4">
      <p class="font-semibold text-lg">Budi Santoso</p>
      <p class="text-sm text-gray-500">ID: 123456</p>
    </div>

    <!-- Waktu -->
    <div class="text-center mb-4">
      <p class="text-sm text-gray-400">Waktu Sekarang:</p>
      <p id="currentTime" class="text-xl font-bold text-blue-700">--:--:--</p>
    </div>

    <!-- Lokasi -->
    <div class="mb-4 text-center">
      <p class="text-sm text-gray-500">Lokasi Anda:</p>
      <p id="location" class="text-gray-700 text-sm italic">Belum diambil...</p>
    </div>

    <!-- Pesan Kesalahan -->
    <div id="error-message" class="text-red-500 text-sm text-center mb-4 hidden"></div>

    <!-- Tombol Absen -->
    <div class="grid grid-cols-2 gap-4 mb-4">
      <button onclick="absen('masuk')" class="bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
        <i class="fas fa-sign-in-alt"></i> Absen Masuk
      </button>
      <button onclick="absen('keluar')" class="bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
        <i class="fas fa-sign-out-alt"></i> Absen Keluar
      </button>
    </div>

    <!-- Tombol Refresh -->
    <div class="text-center mb-4">
      <button onclick="refreshLocation()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
        <i class="fas fa-sync-alt"></i> Refresh Lokasi
      </button>
    </div>

    <!-- Riwayat Absensi -->
    <div class="mt-4">
      <h3 class="text-lg font-semibold text-gray-700 mb-2">Riwayat Absensi</h3>
      <ul id="attendanceHistory" class="list-disc list-inside text-gray-600">
        <!-- Riwayat akan ditambahkan di sini -->
      </ul>
    </div>
  </div>

  <!-- Script Jam dan Lokasi -->
  <script>
    // Update waktu dan tanggal
    function updateTimeAndDate() {
      const now = new Date();
      document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID');
      document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }
    setInterval(updateTimeAndDate, 1000);
    updateTimeAndDate();

    // Fungsi untuk mengambil lokasi
    function getLocation(callback) {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(callback, function (error) {
          document.getElementById('error-message').textContent = 'Gagal mengambil lokasi. Izinkan akses lokasi di browser.';
          document.getElementById('error-message').classList.remove('hidden');
        });
      } else {
        document.getElementById('error-message').textContent = "Geolocation tidak didukung browser Anda.";
        document.getElementById('error-message').classList.remove('hidden');
      }
    }

    // Fungsi absen
    function absen(tipe) {
      getLocation(function (position) {
        const lat = position.coords.latitude.toFixed(5);
        const lon = position.coords.longitude.toFixed(5);
        document.getElementById('location').textContent = `Lat: ${lat}, Lon: ${lon}`;

        // Simulasi pengiriman ke backend
        const historyItem = document.createElement('li');
        const now = new Date();
        historyItem.textContent = `Absen ${tipe} pada ${now.toLocaleString('id-ID')} - Lokasi: (${lat}, ${lon})`;
        document.getElementById('attendanceHistory').appendChild(historyItem);

        // Notifikasi
        alert(`Absen ${tipe} berhasil!\nLokasi: (${lat}, ${lon})`);
      });
    }

    // Fungsi untuk refresh lokasi
    function refreshLocation() {
      getLocation(function (position) {
        const lat = position.coords.latitude.toFixed(5);
        const lon = position.coords.longitude.toFixed(5);
        document.getElementById('location').textContent = `Lat: ${lat}, Lon: ${lon}`;
      });
    }
  </script>
</body>
</html>
