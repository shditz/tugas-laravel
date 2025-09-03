<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Rilisan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
    </style>
    <script>
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const downloadButton = document.getElementById('downloadButton');

            modalImage.src = imageSrc;
            downloadButton.href = imageSrc; // Set the download link
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-16 px-4">
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">Detail Rilisan</h1>
        </header>

        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Informasi Rilisan</h2>

            <div class="mb-4">
                <p class="text-gray-700"><strong>Nama dan jabatan anggota dewan yang hadir:</strong> {{ $rilisan->nama }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-700"><strong>Nama dan jabatan tamu:</strong> {{ $rilisan->jabatan }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-700"><strong>Tempat kegiatan:</strong> {{ $rilisan->judul }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-700"><strong>Tanggal:</strong> {{ $rilisan->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-2">Rilisan:</h3>
                <p class="text-gray-800 whitespace-pre-line">{{ $rilisan->pesan }}</p>
            </div>
            <br></br>
            <div class="mb-4">
                <p class="text-gray-700 font-bold text-lg"><strong>Penulis rilis:</strong> {{ $rilisan->status }}</p>
            </div>
            <br><br><br>

            @if($rilisan->foto)
                @php
                    $photos = json_decode($rilisan->foto, true);
                @endphp

                @if(is_array($photos) && count($photos) > 0)
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2">Foto Rilisan:</h3>
                        <div class="flex flex-wrap gap-4">
                            @foreach($photos as $photo)
                                <img src="{{ asset('images/' . $photo) }}" alt="Foto Rilisan" class="w-32 h-32 object-cover rounded shadow cursor-pointer" onclick="openModal('{{ asset('images/' . $photo) }}')" />
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-red-500">Tidak ada foto yang tersedia.</p>
                @endif
            @else
                <p class="text-red-500">Tidak ada foto yang tersedia.</p>
            @endif

            <div class="mt-8">
                <a href="{{ url('/rilis') }}" class="text-blue-600 hover:underline">Kembali ke daftar rilisan</a>
                <a href="{{ route('rilis.edit', $rilisan->id) }}" class="ml-4 text-blue-600 hover:underline">Edit Rilisan</a>
            </div>
        </div>
    </div>

    <!-- Modal untuk Preview Gambar -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-4">
            <span class="cursor-pointer" onclick="closeModal()">✖</span>
            <img id="modalImage" src="" alt="Preview" class="max-w-full max-h-screen" />
            <div class="mt-4">
                <a id="downloadButton" href="#" download class="text-blue-600 hover:underline">Download Gambar</a>
            </div>
        </div>
    </div>
</body>
</html>
