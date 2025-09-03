<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Absensi Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-thumb { background-color: rgba(255, 255, 255, 0.3); border-radius: 3px; }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col md:flex-row">

 <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-52 bg-blue-600 text-white rounded-r-3xl shadow-lg flex flex-col transform md:relative md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
    <div class="p-6">
      <h1 class="text-4xl font-bold tracking-wide mb-8">Karyawan</h1>
      <nav aria-label="Main Navigation" class="space-y-4 mb-12">
        <a href="{{ url('dashboard') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
        <a href="{{ url('absensi') }}" class="flex items-center px-4 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 transition font-mono ">
          <i class="fas fa-calendar-check mr-2"></i> Absensi
        </a>
        <a href="{{ url('userp') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-user mr-2"></i> Laporan DL
        </a>
        <a href="{{ url('rilisu') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-paper-plane mr-2"></i> Rilis
        </a>
        <a href="{{ url('loginp') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-sign-out-alt mr-2"></i> Log out
        </a>
      </nav>
    </div>
  </aside>

  <button id="sidebarToggle" class="md:hidden fixed top-4 left-4 z-40 bg-blue-600 text-white p-2 rounded-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
  </button>

  <main class="flex-1 p-6 md:ml-52">
    <header class="mb-8 flex justify-between items-center">
      <span class="text-gray-700 text-lg font-semibold">Halo, <span id="userName">User</span></span>
      <img src="https://ui-avatars.com/api/?name=User&background=3b82f6&color=fff&rounded=true&size=32" alt="Avatar User" class="w-8 h-8 rounded-full border-2 border-blue-600" id="userAvatar" />
    </header>

    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full mx-auto">
      <h2 class="text-3xl font-extrabold text-center mb-6 text-blue-700">Absensi Lokasi</h2>
      <div class="text-center mb-5">
        <p id="currentDate" class="text-sm font-medium text-blue-600"></p>
      </div>

      <form id="absenForm" method="POST" action="{{ route('absensi.store') }}">
        @csrf
        <label for="inputStatus" class="block text-gray-700 font-semibold mb-1">Status Kehadiran:</label>
        <select name="status" id="inputStatus" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" disabed>
          <option value="">-- Pilih status --</option>
          <option value="hadir">Hadir</option>
          <option value="sakit">Sakit</option>
          <option value="izin">Izin</option>
          <option value="keuar kota(DL)">keluar kota(DL)</option>
        </select>

        <label for="inputName" class="block text-gray-700 font-semibold mt-4 mb-1">Nama:</label>
        <select name="nama" id="inputStatus" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" disabed>
          <option value="">-- pilih nama --</option>
          <option value="said">said</option>
          <option value="didi">didi</option>
          <option value="rey">ray</option>
          <option value="paisal">paisal</option>
        </select>

        <label for="inputDate" class="block text-gray-700 font-semibold mt-4 mb-1">Tanggal:</label>
        <input type="date" name="tanggal" id="inputDate" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" readonly />

        <label for="inputTime" class="block text-gray-700 font-semibold mt-4 mb-1">Waktu:</label>
        <input type="text" name="waktu" id="inputTime" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" readonly />

        <section class="text-center mb-6">
          <p id="statusKehadiran" class="text-blue-700 font-semibold text-lg italic">-</p>
        </section>

        <section class="mb-6 text-center">
          <p class="text-sm text-gray-500 mb-1">Lokasi Anda:</p>
          <input type="text" name="lokasi" id="inputLocation" class="w-full p-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500" readonly />
        </section>

        <div id="error-message" class="text-red-600 text-sm text-center mb-6 hidden"></div>

        <div class="grid grid-cols-2 gap-5 mb-6">
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-xl">Absen Hadir</button>
          <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl">Absen Izin</button>
        </div>

        @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        {{ session('success') }}
    </div>
@endif
      </form>

      

      <section class="mt-6">
        <div id="infoAbsensi" class="text-green-600 font-semibold text-center mb-4 hidden"></div>
        <h3 class="text-xl font-semibold text-gray-800 mb-3">Hasil Absensi</h3>
        <div id="resultAbsensi" class="text-gray-700">
          <p class="italic">Belum ada hasil absensi.</p>
        </div>
      </section>
    </div>
  </main>

  <script>
    
   






//batas chat
   const locationElem = document.getElementById('inputLocation');
const errorElem = document.getElementById('error-message');
const statusSelect = document.getElementById('inputStatus');
const statusText = document.getElementById('statusKehadiran');
const userNameElem = document.getElementById('userName');
const userAvatar = document.getElementById('userAvatar');

// Koordinat Kantor DPRD Provinsi Riau
const officeLocation = { lat: 0.4944567, lon: 101.4556865 };
const maxRadius = 200; // meter

// Update tanggal dan waktu setiap detik
function updateDateTime() {
  const now = new Date();
  document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', {
    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
  });
  document.getElementById('inputDate').value = now.toISOString().split('T')[0];
  document.getElementById('inputTime').value = now.toLocaleTimeString('id-ID', { hour12: false });
}
setInterval(updateDateTime, 1000);
updateDateTime();

// Tampilkan error message sementara
function showError(message) {
  errorElem.textContent = message;
  errorElem.classList.remove('hidden');
  setTimeout(() => {
    errorElem.classList.add('hidden');
  }, 5000);
}

// Fungsi menghitung jarak antar koordinat (Haversine formula)
function getDistanceFromLatLonInMeters(lat1, lon1, lat2, lon2) {
  const R = 6371000; // Radius bumi dalam meter
  const dLat = deg2rad(lat2 - lat1);
  const dLon = deg2rad(lon2 - lon1);
  const a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
    Math.sin(dLon / 2) * Math.sin(dLon / 2);
  const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  return R * c; // Jarak dalam meter
}
function deg2rad(deg) {
  return deg * (Math.PI / 180);
}

// Dapatkan lokasi user
function refreshLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successLocation, errorLocation);
  } else {
    showError("Geolocation tidak didukung oleh browser Anda.");
  }
}

function successLocation(position) {
  const { latitude, longitude } = position.coords;
  locationElem.value = `Lat: ${latitude.toFixed(5)}, Lon: ${longitude.toFixed(5)}`;
}

function errorLocation(err) {
  showError("Gagal mengambil lokasi: " + err.message);
  locationElem.value = "Tidak dapat diakses";
}

// Submit absensi dengan status dari tombol, set dropdown dan validasi lokasi + radius khusus untuk hadir
function submitAbsen(status) {
  const name = "Anonim"; // Tidak pakai input nama

  if (!locationElem.value || locationElem.value === "Tidak dapat diakses") {
    showError("Lokasi belum tersedia, silakan refresh lokasi terlebih dahulu.");
    return;
  }

  // Ambil lat dan lon dari lokasi user yang sudah diisi inputLocation
  const matches = locationElem.value.match(/Lat:\s*(-?\d+\.?\d*),\s*Lon:\s*(-?\d+\.?\d*)/);
  if (!matches) {
    showError("Format lokasi tidak valid.");
    return;
  }
  const userLat = parseFloat(matches[1]);
  const userLon = parseFloat(matches[2]);

  // Jika status hadir, cek jarak dengan kantor
  if (status.toLowerCase() === "hadir") {
    const distance = getDistanceFromLatLonInMeters(userLat, userLon, officeLocation.lat, officeLocation.lon);
    if (distance > maxRadius) {
      showError(`Lokasi Anda berada di luar radius ${maxRadius} meter dari Kantor DPRD Provinsi Riau. Tidak bisa absen hadir.`);
      return;
    }
  }

  // Set dropdown sesuai tombol klik dan update status kehadiran
  statusSelect.value = status;
  statusText.textContent = `Status dipilih: ${status.charAt(0).toUpperCase() + status.slice(1)}`;

  const inputDate = document.getElementById('inputDate').value;
  const inputTime = document.getElementById('inputTime').value;

  const now = new Date();
  const record = {
    status,
    name,
    date: inputDate,
    time: inputTime,
    timestamp: now.toISOString(),
    location: locationElem.value
  };

  const history = JSON.parse(localStorage.getItem('attendanceHistory')) || [];
  history.unshift(record);
  localStorage.setItem('attendanceHistory', JSON.stringify(history));

  loadAttendanceHistory();
  displayResult(record);






  alert(`Berhasil absen ${status} pada ${inputDate} ${inputTime}`);
}

// Muat riwayat absensi dari localStorage
function loadAttendanceHistory() {
  const historyElem = document.getElementById('attendanceHistory');
  historyElem.innerHTML = '';
  const history = JSON.parse(localStorage.getItem('attendanceHistory')) || [];
  if (history.length === 0) {
    historyElem.innerHTML = '<li class="text-center text-gray-400 italic">Belum ada riwayat absensi.</li>';
    return;
  }
  history.forEach(record => {
    const li = document.createElement('li');
    li.textContent = `${record.status} pada ${new Date(record.timestamp).toLocaleString('id-ID')} - Lokasi: ${record.location}`;
    historyElem.appendChild(li);
  });
}

// Tampilkan hasil absensi terakhir
function displayResult(record) {
  const resultElem = document.getElementById('resultAbsensi');
  resultElem.innerHTML = `
    <p><strong>Status:</strong> ${record.status.charAt(0).toUpperCase() + record.status.slice(1)}</p>
    <p><strong>Tanggal:</strong> ${record.date}</p>
    <p><strong>Waktu:</strong> ${record.time}</p>
    <p><strong>Lokasi:</strong> ${record.location}</p>
  `;
}

// Update tampilan nama user dan avatar (disembunyikan)
function updateUserDisplay(name) {
  userNameElem.textContent = "";
  userAvatar.style.display = "none";
}

// Load halaman
window.onload = function () {
  refreshLocation();
  loadAttendanceHistory();
};

// Update status kehadiran saat dropdown berubah (antispasi)
statusSelect.addEventListener('change', () => {
  const val = statusSelect.value;
  statusText.textContent = val ? `Status dipilih: ${val.charAt(0).toUpperCase() + val.slice(1)}` : '-';
});

// Sidebar toggle (mobile)
document.getElementById('sidebarToggle').addEventListener('click', () => {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('-translate-x-full');
});

const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('sidebarToggle');

// Inisialisasi sidebar hidden untuk layar kecil saat halaman dimuat
function initSidebar() {
  if (window.innerWidth < 768) {
    sidebar.classList.add('-translate-x-full');
  } else {
    sidebar.classList.remove('-translate-x-full');
  }
}

// Jalankan saat resize layar
window.addEventListener('resize', initSidebar);
initSidebar();

     // Sidebar toggle for mobile
        







  </script>
</body>
</html>
