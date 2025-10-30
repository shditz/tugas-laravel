<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Responsive</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <style>
    /* Custom styles using Tailwind's @layer directive */
    @layer base {
      body {
        @apply font-sans antialiased; /* Improved font rendering */
      }
    }

    @layer components {
      .form-control {
        @apply block w-full px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500;
      }

      .btn-primary {
        @apply inline-flex items-center px-4 py-2 bg-cyan-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cyan-600 active:bg-cyan-700 focus:outline-none focus:border-cyan-700 focus:ring focus:ring-cyan-200 disabled:opacity-25 transition;
      }

      .table-header {
          @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
      }

      .table-cell {
          @apply px-6 py-4 whitespace-nowrap text-sm text-gray-900;
      }
    }
  </style>
</head>
<body class="bg-gray-100">

  <!-- Header -->
  <header class="bg-cyan-500 text-white py-4 px-6 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
      <h1 class="text-2xl font-semibold">ADMIN</h1>
      <!-- Hamburger Button -->
      <button id="menuBtn" class="md:hidden focus:outline-none">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </div>
  </header>

  <!-- Sidebar (Hidden in mobile) -->
  <aside id="sidebar" class="bg-cyan-50 w-64 p-4 space-y-4 fixed top-0 left-0 h-full transform -translate-x-full transition-transform duration-200 rounded-sm md:translate-x-0 md:static md:block z-20 shadow-lg">
    <nav>
      <a href="{{ url('/data') }}" class="flex items-center space-x-2 rounded-md hover:bg-cyan-100 duration-200 p-2">
        <i class="fa-solid fa-user text-cyan-500"></i>
        <span class="text-gray-700">D. Karyawan</span>
      </a>
      <a href="{{ url('/dokumen') }}" class="flex items-center space-x-2 rounded-md hover:bg-cyan-100 duration-200 p-2">
        <i class="fa-solid fa-calendar text-cyan-500"></i>
        <span class="text-gray-700">Dokumen DL</span>
      </a>
    
       
      <a href="{{ url('/login') }}" class="flex items-center space-x-2 rounded-md hover:bg-cyan-100 duration-200 p-2">
        <i class="fa-solid fa-right-from-bracket text-cyan-500"></i>
        <span class="text-gray-700">Log Out</span>
      </a>
    </nav>
  </aside>

 <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Data Perjalanan Dinas</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow-md rounded border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Tanggal Pergi</th>
                    <th class="py-3 px-4">Tanggal Pulang</th>
                    <th class="py-3 px-4">Tempat Kegiatan</th>
                </tr>
            </thead>
            <tbody>
@forelse($profiles as $index => $profile)
    <tr class="border-t border-gray-200">
        <td class="py-3 px-4">{{ $index + 1 }}</td>
        <td class="py-3 px-4">
          <a href="{{ route('profiles.show', $profile->id) }}" class="text-cyan-600 hover:underline">
            {{ $profile->nama }}
          </a>
        </td>
        <td class="py-3 px-4">{{ $profile->email }}</td>
        <td class="py-3 px-4">{{ $profile->telpon }}</td>
        <td class="py-3 px-4">{{ $profile->alamat }}</td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="py-4 px-4 text-center text-gray-500">Belum ada data</td>
    </tr>
@endforelse
</tbody>
        </table>
    </div>

      <script>
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    menuBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>

</body>
</html>
