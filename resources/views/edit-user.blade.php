<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control w-full border rounded p-2">
            </div>

            <div class="mb-4">
            <label class="block text-gray-700">Password Baru (Opsional)</label>
            <input type="password" name="password" class="form-control w-full border rounded p-2" placeholder="Kosongkan jika tidak ingin mengubah">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jabatan</label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}" class="form-control w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jenis Kelamin</label>
                <select name="jeniskelamin" class="form-control w-full border rounded p-2">
                    <option value="Laki-laki" {{ $user->jeniskelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $user->jeniskelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
