<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Pengguna</title>
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



    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-30 w-52 bg-blue-600 text-white rounded-r-3xl shadow-lg flex flex-col transform md:relative md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
    <div class="p-6">
      <h1 class="text-4xl font-bold tracking-wide mb-8">Karyawan</h1>
      <nav aria-label="Main Navigation" class="space-y-4 mb-12">
        <a href="{{ url('dashboard') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
        </a>
        <a href="{{ url('absensi') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono ">
          <i class="fas fa-calendar-check mr-2"></i> Absensi
        </a>
        <a href="{{ url('userp') }}" class="flex items-center px-4 py-2 rounded-xl hover:bg-blue-700 transition font-mono">
          <i class="fas fa-user mr-2"></i> Laporan DL
        </a>
        <a href="{{ url('rilisu') }}" class="flex items-center px-4 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 transition font-mono">
          <i class="fas fa-paper-plane mr-2"></i> Rilis
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
      <!-- Main Content -->
    <main class="flex-1 ml-2 p-8">
        <h2 class="text-3xl font-bold mb-6">FORM RILIS</h2>
        <form id="dataForm" method="POST" action="{{ route('rili.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
         @csrf
        <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-gray-700 ">NAMA DAN JABATAN ANGGOTA DEWAN YANG HADIR</label>
                <input type="text" id="name" name="nama" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="" />
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-gray-700">NAMA DAN JABATAN TAMU(SELAIN ANGGOTA DEWAN YANGA DPRD PROVINSI RIAU)</label>
                <input type="text" id="jabatan" name="jabatan" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="" />
            </div>
            <div class="mb-4">
                <label for="text" class="block text-sm font-bold text-gray-700">TEMPAT KEGITAN</label>
                <input type="text" id="judul" name="judul" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="" />
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-bold text-gray-700">RILIS</label>
                <textarea id="pesan" name="pesan" placeholder="" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-bold text-gray-700">PENULIS RILIS</label>
                <input type="text" id="status" name="status" placeholder="" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" />
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-bold text-gray-700">FOTO KEGIATAN</label>
             <input type="file" name="foto[]" multiple>
             <div id="previewContainer" class="flex flex-wrap gap-2 mt-2"></div>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition">Kirim</button>
            <br><br>
            @if (session('success'))
         <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
@endif
        </form>
         
    </main>

 
    <script>
        document.querySelector('input[name="foto[]"]').addEventListener('change', function(e) {
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = ""; // Bersihkan preview lama

    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(evt) {
            const img = document.createElement('img');
            img.src = evt.target.result;
            img.className = "w-24 h-24 object-cover rounded border";
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});







///batas
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        toggleBtn.addEventListener('click', () => {
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
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

        // Preview image function
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

        // Handle form submission
      
            // Here you can add code to send the updated data to the server
     
    </script>

</body>
</html>
