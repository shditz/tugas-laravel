<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Responsive</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS Bundle (popper + bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f7f8;
      color: #333;
    }
    h1 {
      text-align: center;
      margin-bottom: 24px;
      color: #2c3e50;
    }
    table {
      width: 80%;
      margin: 0 auto;
      border-collapse: collapse;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      background: white;
      border-radius: 8px;
      overflow: hidden;
    }
    thead {
      background: #3498db;
      color: white;
    }
    thead th {
      padding: 14px 20px;
      text-align: left;
    }
    tbody tr {
      border-bottom: 1px solid #ecf0f1;
    }
    tbody tr:nth-child(even) {
      background: #f9fafb;
    }
    tbody td {
      padding: 12px 20px;
    }
    .status-hadir {
      color: #27ae60;
      font-weight: 600;
    }
    .status-izin {
      color: #f39c12;
      font-weight: 600;
    }
    .status-alpha {
      color: #e74c3c;
      font-weight: 600;
    }
    .search-form {
      width: 80%;
      margin: 20px auto;
      height:70px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }

    .search-form input[type="date"] {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 10px;
    }

    .search-form button {
      padding: 8px 15px;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    #didin{
      float:left;
      margin-top:15px; 
      margin-left: 50px;
    }
    #didin1{
      
      margin-top: 15px;
    }

  </style>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Header -->
  <header class="flex items-center justify-between bg-cyan-500 p-4 text-white">
    <h1 class="text-xl font-bold">ADMIN</h1>
    <button id="menuBtn" class="md:hidden">
      <i class="fas fa-bars text-2xl"></i>
    </button>
  </header>

  <!-- Sidebar -->
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

  <!-- Main Content -->
  <main class="pt-10 md:ml-64">
    <h1>Tabel Absensi</h1>

    <!-- Search Form -->
    <div class="search-form">
      <div id="didin">
      <form action="{{ url('/absenini/search') }}" method="GET">
  <input type="date" name="searchDate" id="searchDate">
  <button type="submit">Cari</button>
</form>
</div>
<div >
    <!-- Tombol buka modal -->
<button type="button" id="didin1" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
  Cetak
</button>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('absen.export') }}" method="GET">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">Filter Download Excel</h5>
          <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <label for="bulan">Bulan:</label>
          <select name="bulan" id="bulan" class="form-select" required>
            <option value="">--Pilih Bulan--</option>
            @for ($m = 1; $m <= 12; $m++)
              <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
              </option>
            @endfor
          </select>

          <label for="tahun" class="mt-3">Tahun:</label>
          <select name="tahun" id="tahun" class="form-select" required>
            <option value="">--Pilih Tahun--</option>
            @for ($y = 2020; $y <= 2035; $y++)
              <option value="{{ $y }}">{{ $y }}</option>
            @endfor
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Download Excel</button>
        </div>
      </form>
    </div>
  </div>
</div>



</div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Status</th>
          <th>tanggal</th>
          <th>waktu</th>
          <th>lokasi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($absens as $absen)
          <tr>
            <td>{{ $absen->nama }}</td>
            <td class="
              {{ $absen->status == 'Hadir' ? 'status-hadir' : ($absen->status == 'Izin' ? 'status-izin' : 'status-alpha') }}
            ">
              {{ $absen->status }}
            </td>
            <td>{{ $absen->tanggal }}</td>
            <td>{{ $absen->waktu }}</td>
            <td>@php
  // Ambil angka koordinat dari string
  preg_match('/Lat:\s*([0-9\.\-]+),\s*Lon:\s*([0-9\.\-]+)/', $absen->lokasi, $matches);
  $lat = $matches[1] ?? null;
  $lon = $matches[2] ?? null;
@endphp

@if($lat && $lon)
  <a href="https://www.google.com/maps?q={{ $lat }},{{ $lon }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">
    {{ $lat }}, {{ $lon }}
  </a>
@else
  {{ $absen->lokasi }}
@endif</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </main>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    menuBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>

</body>
</html>
