<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap');

    body {
      margin: 0;
      padding: 0;
      font-family: 'Montserrat', sans-serif;
      background:
        linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
        url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      padding: 2.5rem 3rem;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      width: 360px;
      text-align: center;
      color: #333;
    }

    .login-container h2 {
      margin-bottom: 1.5rem;
      font-weight: 600;
      color: #222;
    }

    .input-group {
      margin-bottom: 1.2rem;
      position: relative;
    }

    .input-group label {
      display: block;
      text-align: left;
      font-size: 0.9rem;
      margin-bottom: 0.4rem;
      color: #444;
    }

    .input-group input {
      width: 100%;
      padding: 0.9rem 1rem;
      border: 2px solid #ddd;
      border-radius: 8px;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }

    .input-group input:focus {
      border-color: #f1c40f;
      outline: none;
    }

    .btn-login {
      width: 100%;
      padding: 0.9rem 0;
      background: #08b9ff;
      color: #fff;
      font-weight: 600;
      font-size: 1.1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      box-shadow: 0 6px 12px rgba(241, 196, 15, 0.6);
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-login:hover {
      background: #00b7ff;
      box-shadow: 0 8px 16px rgba(211, 84, 0, 0.8);
    }

    .error-message {
      color: #e74c3c;
      font-size: 0.85rem;
      margin-top: 0.6rem;
    }

    @media (max-width: 400px) {
      .login-container {
        width: 90%;
        padding: 2rem 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-container" role="main" aria-labelledby="loginTitle">
    <h2 id="loginTitle">Admin Login</h2>

    @if ($errors->any())
      <div class="mb-4 text-sm text-red-600">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form id="loginForm" action="{{ route('login.post') }}" method="POST" novalidate>
      @csrf
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required />
        @error('username')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn-login">Log In</button>
    </form>
  </div>
</body>
</html>