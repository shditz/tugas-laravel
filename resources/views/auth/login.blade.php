<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
   
    :root {
      --primary: #00d4ff;     /* Cyan cerah */
      --primary-dark: #00a8cc; /* Cyan gelap untuk hover */
      --secondary: #0891b2;   /* Cyan tua sebagai aksen */
      --accent: #f72585;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --success: #06b6d4;     /* Cyan untuk success */
      --error: #f72585;
    }
   
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
   
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0f3a4d, #164e63);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      color: var(--dark);
    }
   
    .login-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 440px;
      padding: 2.5rem 2.5rem;
      position: relative;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
   
    .login-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }
   
    .login-header {
      text-align: center;
      margin-bottom: 2rem;
      position: relative;
    }
   
    .login-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.2rem;
      box-shadow: 0 5px 15px rgba(0, 212, 255, 0.4);
    }
   
    .login-icon i {
      font-size: 1.8rem;
      color: white;
    }
   
    .login-header h1 {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 0.5rem;
    }
   
    .login-header p {
      color: var(--gray);
      font-size: 0.95rem;
    }
   
    .input-group {
      margin-bottom: 1.5rem;
      position: relative;
    }
   
    .input-group label {
      display: block;
      text-align: left;
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
      color: var(--dark);
      font-weight: 500;
    }
   
    .input-field {
      position: relative;
    }
   
    .input-field i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
      transition: color 0.3s ease;
    }
   
    .input-group input {
      width: 100%;
      padding: 1rem 1rem 1rem 2.8rem;
      border: 2px solid #e9ecef;
      border-radius: 10px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background-color: #f8f9fa;
    }
   
    .input-group input:focus {
      border-color: var(--primary);
      background-color: white;
      box-shadow: 0 0 0 3px rgba(0, 212, 255, 0.2);
      outline: none;
    }
   
    .input-group input:focus + i {
      color: var(--primary);
    }
   
    .btn-login {
      width: 100%;
      padding: 1rem 0;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
      font-weight: 600;
      font-size: 1rem;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(0, 212, 255, 0.4);
      position: relative;
      overflow: hidden;
    }
   
    .btn-login:hover {
      background: linear-gradient(135deg, var(--primary-dark), #067a94);
      box-shadow: 0 8px 20px rgba(0, 212, 255, 0.5);
      transform: translateY(-2px);
    }
   
    .btn-login:active {
      transform: translateY(0);
    }
   
    .btn-login::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 5px;
      height: 5px;
      background: rgba(255, 255, 255, 0.5);
      opacity: 0;
      border-radius: 100%;
      transform: scale(1, 1) translate(-50%);
      transform-origin: 50% 50%;
    }
   
    .btn-login:focus:not(:active)::after {
      animation: ripple 1s ease-out;
    }
   
    @keyframes ripple {
      0% {
        transform: scale(0, 0);
        opacity: 0.5;
      }
      100% {
        transform: scale(20, 20);
        opacity: 0;
      }
    }
   
    .login-footer {
      margin-top: 1.5rem;
      text-align: center;
      font-size: 0.85rem;
      color: var(--gray);
    }
   
    .error-message {
      color: var(--error);
      font-size: 0.85rem;
      margin-top: 0.5rem;
      display: flex;
      align-items: center;
      gap: 5px;
    }
   
    .error-message i {
      font-size: 0.8rem;
    }
   
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
    }
   
    .remember-me {
      display: flex;
      align-items: center;
      gap: 6px;
    }
   
    .remember-me input {
      accent-color: var(--primary);
    }
   
    .forgot-password {
      color: var(--primary);
      text-decoration: none;
      transition: color 0.3s ease;
    }
   
    .forgot-password:hover {
      color: var(--primary-dark);
    }
   
    .alert {
      padding: 0.8rem 1rem;
      border-radius: 8px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.9rem;
    }
   
    .alert-error {
      background-color: rgba(247, 37, 133, 0.1);
      color: var(--error);
      border-left: 4px solid var(--error);
    }
   
    .alert-success {
      background-color: rgba(6, 182, 212, 0.1);
      color: var(--success);
      border-left: 4px solid var(--success);
    }
   
    @media (max-width: 480px) {
      .login-container {
        padding: 2rem 1.5rem;
      }
     
      .login-header h1 {
        font-size: 1.6rem;
      }
     
      .form-options {
        flex-direction: column;
        gap: 10px;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <div class="login-container" role="main" aria-labelledby="loginTitle">
    <div class="login-header">
      <div class="login-icon">
        <i class="fas fa-lock"></i>
      </div>
      <h1 id="loginTitle">Admin Login</h1>
      <p>Access your administration dashboard</p>
    </div>

    @if ($errors->any())
      <div class="alert alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <div>
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      </div>
    @endif

    <form id="loginForm" action="{{ route('login.post') }}" method="POST" novalidate>
      @csrf
     
      <div class="input-group">
        <label for="username">Username</label>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Enter your username" required />
        </div>
        @error('username')
          <div class="error-message">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $message }}</span>
          </div>
        @enderror
      </div>
     
      <div class="input-group">
        <label for="password">Password</label>
        <div class="input-field">
          <i class="fas fa-key"></i>
          <input type="password" id="password" name="password" placeholder="Enter your password" required />
        </div>
        @error('password')
          <div class="error-message">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $message }}</span>
          </div>
        @enderror
      </div>
     
      <div class="form-options">
        <div class="remember-me">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Remember me</label>
        </div>
        <a href="#" class="forgot-password">Forgot Password?</a>
      </div>
     
      <button type="submit" class="btn-login">
        <i class="fas fa-sign-in-alt"></i> Log In
      </button>
    </form>
   
    <div class="login-footer">
      <p>&copy; 2023 Your Company. All rights reserved.</p>
    </div>
  </div>

  <script>
    document.querySelector('.btn-login').addEventListener('click', function(e) {
      if (!this.form.checkValidity()) {
        e.preventDefault();
        const inputs = this.form.querySelectorAll('input');
        inputs.forEach(input => {
          if (!input.validity.valid) {
            input.style.animation = 'shake 0.5s';
            setTimeout(() => {
              input.style.animation = '';
            }, 500);
          }
        });
      }
    });

    const style = document.createElement('style');
    style.textContent = `
      @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
      }
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>