<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Manage Your Tasks</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#1e3a5f',
            secondary: '#2E5C8E',
          }
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    @layer components {
      .btn-primary { @apply bg-primary text-white px-8 py-3 rounded-lg hover:bg-secondary transition font-semibold; }
      .btn-outline { @apply border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-primary transition font-semibold; }
    }
  </style>
</head>
<body class="font-sans bg-white">

  <!-- NAVBAR -->
  <nav class="bg-primary shadow-lg">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-white text-2xl font-bold">TaskFlow</h1>
      <div class="flex gap-4 items-center">
        <a href="{{ route('login') }}" class="text-white hover:text-blue-200 transition font-medium">Login</a>
        <a href="{{ route('register') }}" class="bg-white text-primary px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">Sign Up</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="bg-gradient-to-br from-primary to-secondary text-white py-28 text-center">
    <div class="max-w-3xl mx-auto px-6">
      <h2 class="text-5xl font-bold mb-6 leading-tight">Manage your tasks,<br>effortlessly</h2>
      <p class="text-xl text-blue-100 mb-10">Stay organized and boost your productivity with TaskFlow. The simple powerful task management solution for teams and individuals.</p>
      <div class="flex justify-center gap-4 flex-wrap">
        <a href="{{ route('register') }}" class="btn-primary">Get Started Free</a>
        <a href="{{ route('login') }}" class="btn-outline">Login</a>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
      <h3 class="text-3xl font-bold text-center text-primary mb-14">Why choose TaskFlow?</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-xl shadow p-8 text-center hover:shadow-lg transition">
          <div class="text-5xl mb-4">✅</div>
          <h4 class="text-xl font-bold text-primary mb-3">Task Tracking</h4>
          <p class="text-gray-500">Create update and manage all your tasks in one simple place.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-8 text-center hover:shadow-lg transition">
          <div class="text-5xl mb-4">🎯</div>
          <h4 class="text-xl font-bold text-primary mb-3">Priority Labels</h4>
          <p class="text-gray-500">Set High Medium or Low priority so you always focus on what matters.</p>
        </div>
        <div class="bg-white rounded-xl shadow p-8 text-center hover:shadow-lg transition">
          <div class="text-5xl mb-4">🔒</div>
          <h4 class="text-xl font-bold text-primary mb-3">Secure Login</h4>
          <p class="text-gray-500">Role based access control keeps your data safe and private.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-primary text-white text-center py-6">
    <p class="text-blue-200">© 2025 TaskFlow. All rights reserved.</p>
  </footer>

</body>
</html>