<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Verify OTP - TaskFlow</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: { colors: { primary: '#1e3a5f', secondary: '#2E5C8E' } } }
    }
  </script>
  <style type="text/tailwindcss">
    @layer components {
      .input-field { @apply w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary text-center text-2xl font-bold tracking-widest; }
      .btn-primary { @apply bg-primary text-white w-full py-3 rounded-lg hover:bg-secondary transition font-semibold text-lg; }
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white rounded-2xl shadow-lg p-10 w-full max-w-md">
    <h2 class="text-3xl font-bold text-primary text-center mb-2">TaskFlow</h2>
    <p class="text-gray-500 text-center mb-2">Verify your account</p>
    <p class="text-center text-sm text-gray-400 mb-8">Enter the 6-digit OTP sent to your email</p>

    @if(session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-4 text-center font-bold">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
      @csrf
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2 text-center">Your OTP Code</label>
        <input type="text" name="otp" class="input-field" placeholder="000000" maxlength="6" required>
      </div>
      <button type="submit" class="btn-primary mb-4">Verify Account</button>
    </form>

    <form method="POST" action="{{ route('otp.resend') }}">
      @csrf
      <button type="submit" class="w-full py-3 border border-primary text-primary rounded-lg hover:bg-primary hover:text-white transition font-semibold">
        Resend OTP to Email
      </button>
    </form>

    <!-- Back to Home button added -->
    <div class="mt-6">
      <a href="/" class="block w-full py-3 bg-gray-200 text-gray-700 rounded-lg text-center font-semibold hover:bg-gray-300 transition">
        Back to Home
      </a>
    </div>

    <p class="text-center text-gray-400 text-sm mt-6">
      Check your email inbox for the 6-digit code
    </p>
  </div>
</body>
</html>