<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('{{ asset('dprd.png') }}');
            background-size: cover;
            background-position: center;
        }

        .blur-effect {
            filter: blur(1px); /* Mengatur tingkat blur */
        }

        .login-container {
            position: relative;
            z-index: 10; /* Memastikan form login berada di atas elemen lain */
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="blur-effect w-full h-full absolute top-0 left-0"></div> <!-- Latar belakang buram -->
    
    <div class="bg-white p-6 shadow-lg w-full max-w-sm rounded-lg login-container backdrop-blur-2xl "> <!-- Ukuran form lebih kecil -->
        <div class="text-center mb-3">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="mx-auto mb-2 h-40 w-40"> <!-- Ukuran logo lebih kecil -->
        </div>
        <h2 class="text-center text-2xl mt-2 mb-4 font-bold text-gray-800">Login Karyawan</h2> <!-- Ukuran teks judul lebih kecil -->

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 mb-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('login_error'))
            <div class="bg-red-200 text-red-800 p-2 mb-2 rounded text-center">
                {{ $errors->first('login_error') }}
            </div>
        @endif

        <form action="{{ route('loginp') }}" method="POST">
            @csrf
            <label for="username" class="block mb-1 font-semibold text-gray-700">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                required
                class="w-full p-2 border border-gray-300 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
            />

            <label for="password" class="block mb-1 font-semibold text-gray-700">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                class="w-full p-2 border border-gray-300 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />

            <div class="flex items-center mb-3">
                <input type="checkbox" id="remember" name="remember" class="mr-2" />
                <label for="remember" class="text-gray-700">Ingat Saya</label>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200"
            >
                Login
            </button>
        </form>
    </div>
</body>
</html>
