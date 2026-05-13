<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Settings - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="mb-6">
      <h1 class="text-2xl font-black">Settings</h1>
      <p class="tf-muted text-sm mt-1">Simple account shortcuts. The real account system stays in Jetstream.</p>
    </div>

    <div class="grid gap-5 lg:grid-cols-2">
      <section class="tf-card p-6">
        <h2 class="font-black">Account</h2>
        <div class="mt-5 space-y-4">
          <div>
            <p class="tf-muted text-xs font-black">NAME</p>
            <p class="mt-1 font-bold">{{ Auth::user()->name }}</p>
          </div>
          <div>
            <p class="tf-muted text-xs font-black">EMAIL</p>
            <p class="mt-1 font-bold">{{ Auth::user()->email }}</p>
          </div>
          <div>
            <p class="tf-muted text-xs font-black">ROLE</p>
            <span class="tf-pill mt-1">{{ ucfirst(Auth::user()->role) }}</span>
          </div>
        </div>
      </section>

      <section class="tf-card p-6">
        <h2 class="font-black">Useful Actions</h2>
        <div class="mt-5 flex flex-wrap gap-3">
          <a href="{{ route('profile.show') }}" class="tf-button primary">Edit Profile</a>
          <a href="{{ route('tasks.create') }}" class="tf-button">New Task</a>
          @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.index') }}" class="tf-button">Admin Panel</a>
          @endif
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-5">
          @csrf
          <button type="submit" class="tf-button danger">Log Out</button>
        </form>
      </section>
    </div>
  </main>
</div>
</body>
</html>
