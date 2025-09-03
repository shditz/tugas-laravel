<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const toggleButton = document.getElementById('togglePassword');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.innerHTML = '👁️'; // Eye emoji for showing password
      } else {
        passwordInput.type = 'password';
        toggleButton.innerHTML = '🙈'; // Monkey emoji for hiding password
      }
    }
  </script>
  <style>
    
  </style>
</head>
<body class=" ">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-40 w-40" src="login1.jpg" alt="Your Company" />
      <h2 class="mt-4 text-center text-4xl font-bold tracking-tight text-gray-900">Login</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" />
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
            <div class="text-sm">
              <a href="#" class="font-semibold text-blue-600 hover:text-indigo-500">Forgot password?</a>
            </div>
          </div>
          <div class="mt-2 flex items-center">
            <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm" />
            <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="ml-2 text-gray-600 hover:text-indigo-500 focus:outline-none" style="font-size: 1.5rem;">
              🙈 <!-- Initial emoji for hiding password -->
            </button>
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-blue-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
      </form>

     
    </div>
  </div>
</body>
</html>
