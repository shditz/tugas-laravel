<!-- resources/views/edit-rilis.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Rilisan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Rilisan</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rilis.update', $rilisan->id) }}" enctype="multipart/form-data" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block font-semibold mb-1">Nama dan jabatan anggota dewan yang hadir:</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $rilisan->nama) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <div>
                <label for="jabatan" class="block font-semibold mb-1">Nama dan jabatan tamu:</label>
                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $rilisan->jabatan) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <div>
                <label for="judul" class="block font-semibold mb-1">Tempat kegitan:</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul', $rilisan->judul) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

           

            <div>
                <label for="pesan" class="block font-semibold mb-1">rilisan</label>
                <textarea name="pesan" id="pesan" rows="4" required
                    class="w-full border border-gray-300 rounded px-3 py-2">{{ old('pesan', $rilisan->pesan) }}</textarea>
            </div>
             <div>
                <label for="status" class="block font-semibold mb-1">Penulis rilis:</label>
                <input type="text" name="status" id="status" value="{{ old('status', $rilisan->status) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>
           

            <div class="flex justify-between items-center">
                <a href="{{ route('rilis.index') }}" class="text-gray-600 hover:underline">kembali</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 duration-150">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
