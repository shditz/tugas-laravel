<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Responsive</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <script>
    function confirmDelete(event) {
      event.preventDefault(); // Prevent default button action
      const confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");
      if (confirmation) {
        // Logic to delete data
        alert("Data telah dihapus."); // Replace with appropriate deletion logic
      }
    }
  </script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Header -->
  <header class="flex items-center justify-between bg-cyan-500 p-4 text-white">
    <h1 class="text-xl font-bold">ADMIN</h1>
    <!-- Hamburger Button -->
    <button id="menuBtn" class="md:hidden" aria-label="Toggle Menu" aria-expanded="false">
      <i class="fas fa-bars text-2xl"></i>
    </button>
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

  <!-- Table -->
  <div class="p-4 md:ml-64">
    <h2 class="text-lg font-bold mb-4">Data Karyawan</h2>
    <div class="mb-4">
      <p class="text-gray-700">Berikut adalah data karyawan yang terdaftar:</p>
    </div>
    
    <!-- Responsive Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-300">
        <thead>
          <tr class="bg-cyan-300">

            <th class="py-2 px-4 border-b text-left">Penulis rilis</th>
            <th class="py-2 px-4 border-b text-left">Nama anggota dewan yang hadir</th>
            <th class="py-2 px-4 border-b text-left">Nama dan jabatan tamu</th>
            <th class="py-2 px-4 border-b text-left">Tempat kegitan</th>
            <th class="py-2 px-4 border-b text-left">Waktu</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $item)
          <tr class="hover:bg-gray-100 even:bg-gray-50" cursor-pointer onclick="window.location='{{ route('rilis.show', $item->id) }}'"> <!-- Added zebra striping and hover effect -->
            <td class="py-2 px-4 border-b">{{ $item->status }}</td>
            <td class="py-2 px-4 border-b">{{ $item->nama }}</td>
            <td class="py-2 px-4 border-b">{{ $item->jabatan }}</td>
            <td class="py-2 px-4 border-b">{{ $item->judul }}</td>
            
            <td class="py-2 px-4 border-b">{{ $item->created_at->format('d/m/Y H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');

    menuBtn.addEventListener('click', () => {
      const expanded = menuBtn.getAttribute('aria-expanded') === 'true' || false;
      menuBtn.setAttribute('aria-expanded', !expanded);
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>

</body>
</html>
