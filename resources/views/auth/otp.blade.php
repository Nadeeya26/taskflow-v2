<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Verify OTP - TaskFlow</title>
</head>
<body class="tf-page font-sans min-h-screen flex items-center justify-center px-4">
  <div class="tf-card w-full max-w-md p-8">
    <h1 class="tf-brand text-center text-3xl">TaskFlow</h1>
    <p class="tf-muted mt-2 text-center">Verify your account</p>
    <p class="tf-muted mt-1 text-center text-sm">Enter the latest 6-digit code sent to your email.</p>

    @if(session('success'))
      <div class="tf-card-soft mt-6 p-4 text-center text-green-200">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="tf-card-soft mt-6 p-4 text-red-200">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}" class="mt-6">
      @csrf
      <label class="tf-label text-center block" for="otp">Your OTP Code</label>
      <input
        id="otp"
        type="text"
        name="otp"
        class="tf-input mt-2 text-center text-2xl font-black tracking-[0.35em]"
        inputmode="numeric"
        autocomplete="one-time-code"
        pattern="[0-9]{6}"
        maxlength="6"
        placeholder="000000"
        required
      >
      <button type="submit" class="tf-button primary mt-5 w-full">Verify Account</button>
    </form>

    <form method="POST" action="{{ route('otp.resend') }}" class="mt-3">
      @csrf
      <button type="submit" class="tf-button w-full">Send New OTP</button>
    </form>

    <a href="/" class="tf-button mt-3 w-full">Back to Home</a>

    <p class="tf-muted mt-6 text-center text-xs">
      Use the newest email. Resending creates a new code and the old one stops working.
    </p>
  </div>
</body>
</html>
