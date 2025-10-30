<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: url('{{ asset('dprd.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }

        .input-group input {
            padding-left: 40px;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(59, 130, 246, 0.4);
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .custom-checkbox {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .custom-checkbox:checked {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-color: #3b82f6;
        }

        .custom-checkbox:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 12px;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    
    <div class="glass-effect p-8 w-full max-w-md rounded-2xl shadow-2xl relative z-10">
        <div class="text-center mb-6">
            <div class="floating inline-block">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="mx-auto mb-4 h-24 w-24 object-contain">
            </div>
            <h2 class="text-3xl font-bold gradient-text mb-2">Login Data Dinas Luar</h2>
            <p class="text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->has('login_error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>{{ $errors->first('login_error') }}</span>
            </div>
        @endif

        <form action="{{ route('loginp') }}" method="POST" class="space-y-5">
            @csrf
            
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    placeholder="Username"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                />
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="Password"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                />
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="custom-checkbox mr-2" />
                    <label for="remember" class="text-gray-700">Ingat Saya</label>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm transition duration-200">Lupa Password?</a>
            </div>

            <button
                type="submit"
                class="w-full btn-login text-white py-3 rounded-lg font-semibold transition duration-200"
            >
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>
        </form>

        <div class="mt-6 text-center text-gray-600 text-sm">
            <p>© 2023 Sistem Data Dinas Luar. All rights reserved.</p>
        </div>
    </div>
</body>
</html>