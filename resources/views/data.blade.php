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
      <a href="{{ url('/absenini') }}" class="flex items-center space-x-2 rounded-md hover:bg-cyan-100 duration-200 p-2">
        <i class="fa-sharp fa-regular fa-calendar text-cyan-500"></i>
        <span class="text-gray-700">Absensi karyawan</span>
      </a>
       <a href="{{ url('/rilis') }}" class="flex items-center space-x-2 rounded-md hover:bg-cyan-100 duration-200 p-2">
        <i class="fa-sharp fa-regular fa-calendar text-cyan-500"></i>
        <span class="text-gray-700">data rilis</span>
      </a>
      <a href="{{ url('/login') }}" class="flex items-center space-x-2 rounded-md hover:bg-cyan-100 duration-200 p-2">
        <i class="fa-solid fa-right-from-bracket text-cyan-500"></i>
        <span class="text-gray-700">Log Out</span>
      </a>
    </nav>
  </aside>

  <!-- Overlay for mobile -->
  <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 hidden z-10 md:hidden"></div>

  <!-- Main Content -->
  <main class="md:ml-64 p-6">
    <div class="container mx-auto">

      <!-- Form Tambah Karyawan -->
      <div class="bg-white shadow overflow-hidden rounded-md">
        <div class="px-4 py-5 sm:px-6">
          <h2 class="text-lg font-medium text-gray-900">Tambah Karyawan</h2>
          <p class="mt-1 max-w-2xl text-sm text-gray-500">Tambahkan data karyawan baru ke dalam sistem.</p>
        </div>
        <div class="border-t border-gray-200">
         <form action="{{ route('users.store') }}" method="POST" class="px-4 py-5 sm:p-6">
          @csrf
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">
              <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
              <input type="text" name="username" id="username" class="border-2 form-control mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full h-8 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" name="password" id="password" class="border-2 form-control mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full h-8 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="border-2 form-control mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full h-8 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
              <input type="text" name="jabatan" id="jabatan" class="border-2 form-control mt-1 focus:ring-cyan-500 focus:border-cyan-500 block w-full h-8 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="jeniskelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
              <select name="jeniskelamin" id="jeniskelamin" class="form-control border-2 mt-1 w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-cyan-500 focus:border-cyan-500" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>

          <div class="mt-6">
            <button type="submit" class="btn-primary w-[95px] h-8 rounded-xl bg-green-500 hover:bg-green-600 duration-200">Simpan</button>
          </div>
        </form>

    @if ($errors->any())
    <div class="alert alert-danger mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        </div>
      </div>

      @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      <!-- Tabel Data Karyawan -->
      <div class="mt-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="table-header">Id</th>
                <th scope="col" class="table-header">Username</th>
                <th scope="col" class="table-header">Password</th>
                <th scope="col" class="table-header">Jabatan</th>
                <th scope="col" class="table-header">Jenis Kelamin</th>
                <th scope="col" class="table-header">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($users as $user)
                <tr>
                  <td class="table-cell">{{ $user->id }}</td>
                  <td class="table-cell">{{ $user->username }}</td>
                  <td class="table-cell">{{ $user->password }}</td>
                  <td class="table-cell">{{ $user->jabatan }}</td>
                  <td class="table-cell">{{ $user->jeniskelamin }}</td>
                  <td class="table-cell">
                      
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                      <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
                      @csrf
                      @method('DELETE')
                      <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </main>

  <!-- Script untuk sidebar toggle -->
  <script>
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    });
  </script>

</body>
</html>
