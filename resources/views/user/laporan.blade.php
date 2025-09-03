<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Profil - {{ $profile->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.8);
        justify-content: center;
        align-items: center;
      }
      .modal img {
        max-width: 90%;
        max-height: 90%;
      }
    </style>
    <script>
      function openModal(src) {
          const modal = document.getElementById('image-modal');
          const modalImg = document.getElementById('modal-image');
          const downloadLink = document.getElementById('download-link');

          modal.style.display = 'flex';
          modalImg.src = src;
          downloadLink.href = src;
      }

      function closeModal() {
          document.getElementById('image-modal').style.display = 'none';
      }

      window.onclick = function(e) {
          const modal = document.getElementById('image-modal');
          if(e.target === modal) closeModal();
      }
    </script>
</head>
<body class="bg-gray-100">

<header class="bg-cyan-500 text-white p-4 shadow-md flex justify-between items-center">
    <h1 class="text-2xl font-bold">Detail Profil</h1>
    <a href="{{ url('/data') }}" class="underline hover:text-cyan-300">Kembali</a>
</header>

<main class="max-w-5xl mx-auto p-6 bg-white rounded shadow mt-6">

    <h2 class="text-3xl font-bold mb-4">DOKUMEN PERJALANAN DINAS</h2>

    <p><strong>Nama:</strong> {{ $profile->nama }}</p>
    <p><strong>Tanggal pergi:</strong> {{ $profile->email }}</p>
    <p><strong>Tanggal pulang:</strong> {{ $profile->telpon }}</p>
    <p><strong>Tempat kegiatan:</strong> {{ $profile->alamat }}</p>

    
    <!-- Foto -->
    @if ($profile->foto)
        @foreach (json_decode($profile->foto, true) as $filename)
            <div class="mb-4">
                <img src="{{ asset('storage/foto/' . $filename) }}" alt="Foto Bukti" class="cursor-pointer" onclick="openModal(this.src)" />
                <a href="{{ asset('storage/foto/' . $filename) }}" download class="inline-block mt-2 bg-cyan-600 text-white px-4 py-2 rounded hover:bg-cyan-700">
                    Download
                </a>
            </div>
        @endforeach
    @else
        <p>Belum ada foto</p>
    @endif

    <!-- Modal for Images -->
    <div id="image-modal" class="modal" onclick="closeModal()">
        <img id="modal-image" src="" alt="Modal Image" />
        <a id="download-link" class="hidden" download>Download</a>
    </div>

    <!-- Tombol Download PDF -->
    <div class="mt-8">
        <a href="{{ route('profile.download', $profile->id) }}"
           class="inline-block bg-cyan-600 text-white px-6 py-3 rounded hover:bg-cyan-700">
           Download Laporan PDF
        </a>
    </div>

</main>

</body>
</html>
