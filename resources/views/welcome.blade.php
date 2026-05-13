<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>TaskFlow - Manage Your Tasks</title>
</head>
<body class="tf-page font-sans">
  <nav class="tf-topbar fixed top-0 left-0 right-0 z-20">
    <div class="max-w-6xl mx-auto px-5 h-full flex items-center justify-between">
      <a href="/" class="tf-brand">TaskFlow</a>
      <div class="hidden md:flex items-center gap-6">
        <a href="#features" class="tf-link active">Features</a>
        <a href="#solutions" class="tf-link">Solutions</a>
        <a href="#pricing" class="tf-link">Pricing</a>
        <a href="#resources" class="tf-link">Resources</a>
      </div>
      <div class="flex items-center gap-3">
        <a href="{{ route('login') }}" class="tf-link">Log In</a>
        <a href="{{ route('register') }}" class="tf-button primary !min-h-[30px]">Get Started</a>
      </div>
    </div>
  </nav>

  <main class="pt-12">
    <section class="tf-section text-center">
      <div class="inline-flex items-center gap-2 rounded-full border border-blue-400/20 bg-blue-400/10 px-4 py-1 text-xs font-bold text-blue-200">
        INTRODUCING V1.0
      </div>
      <h1 class="mt-8 text-4xl md:text-6xl font-black leading-tight">
        Manage your tasks, <span class="text-blue-300 italic">effortlessly</span>
      </h1>
      <p class="tf-muted mx-auto mt-5 max-w-2xl font-semibold">
        The modern workspace that keeps tasks, priorities, dates, and team focus in one clean place.
      </p>
      <div class="mt-8 flex flex-wrap justify-center gap-3">
        <a href="{{ route('register') }}" class="tf-button primary">Get Started Free</a>
        <a href="{{ route('login') }}" class="tf-button">View Demo</a>
      </div>

      <div class="tf-card mt-16 mx-auto max-w-5xl p-5 overflow-hidden">
        <div class="mx-auto grid max-w-3xl grid-cols-3 gap-4 rounded-lg border border-cyan-300/10 bg-cyan-300/5 p-6 rotate-[-2deg]">
          <div class="tf-card-soft p-5 text-left">
            <p class="tf-muted text-xs font-bold">TOTAL</p>
            <p class="mt-4 text-3xl font-black">128</p>
            <div class="mt-5 h-2 rounded bg-cyan-300/40"></div>
          </div>
          <div class="tf-card-soft p-5 text-left">
            <p class="tf-muted text-xs font-bold">FOCUS</p>
            <p class="mt-4 text-3xl font-black">87%</p>
            <div class="mt-5 h-2 rounded bg-blue-300/50"></div>
          </div>
          <div class="tf-card-soft p-5 text-left">
            <p class="tf-muted text-xs font-bold">DUE</p>
            <p class="mt-4 text-3xl font-black">Today</p>
            <div class="mt-5 h-2 rounded bg-green-300/50"></div>
          </div>
        </div>
      </div>
    </section>

    <section id="features" class="tf-section">
      <h2 class="text-3xl font-black">Engineered for Focus</h2>
      <p class="tf-muted mt-3 max-w-xl font-semibold">
        Powerful tools hidden behind a minimal interface, so you can explain the system and still use it fast.
      </p>

      <div class="mt-10 grid gap-5 md:grid-cols-3">
        <div class="tf-card-soft md:col-span-2 p-7">
          <span class="tf-icon">T</span>
          <h3 class="mt-5 text-xl font-black">Task Tracking</h3>
          <p class="tf-muted mt-3 text-sm">Create, update, complete, and delete tasks with no extra steps.</p>
          <div class="mt-8 flex gap-2">
            <span class="tf-pill">Kanban</span>
            <span class="tf-pill">Queue</span>
            <span class="tf-pill">List</span>
          </div>
        </div>
        <div class="tf-card-soft p-7">
          <span class="tf-icon">P</span>
          <h3 class="mt-5 text-xl font-black">Priority Labels</h3>
          <p class="tf-muted mt-3 text-sm">Simple low, medium, and high labels keep sorting easy.</p>
        </div>
        <div class="tf-card-soft p-7">
          <span class="tf-icon">S</span>
          <h3 class="mt-5 text-xl font-black">Secure Login</h3>
          <p class="tf-muted mt-3 text-sm">The login and signup flow stays the same, only the UI is cleaner.</p>
        </div>
        <div class="tf-card-soft md:col-span-2 p-7">
          <div class="flex items-center justify-between gap-5">
            <div>
              <h3 class="text-xl font-black">Deep Analytics</h3>
              <p class="tf-muted mt-3 text-sm">Simple totals, rates, and priority counts without confusing charts.</p>
            </div>
            <div class="flex h-24 w-36 items-end gap-3 rounded-lg bg-slate-950/40 p-5">
              <span class="w-5 h-8 rounded bg-blue-300/40"></span>
              <span class="w-5 h-14 rounded bg-blue-300/60"></span>
              <span class="w-5 h-20 rounded bg-blue-300"></span>
              <span class="w-5 h-12 rounded bg-blue-300/50"></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="solutions" class="tf-section">
      <div class="rounded-[24px] bg-gradient-to-br from-blue-400 to-blue-700 px-6 py-16 text-center">
        <h2 class="text-3xl md:text-4xl font-black">Ready to reach your Peak Flow?</h2>
        <p class="mx-auto mt-4 max-w-xl text-sm font-semibold text-blue-50">
          Join teams already organizing work with a simpler TaskFlow dashboard.
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
          <a href="{{ route('register') }}" class="tf-button bg-white !text-blue-900">Get Started for Free</a>
          <a href="{{ route('login') }}" class="tf-button border-white/30 bg-transparent">Log In</a>
        </div>
      </div>
    </section>
  </main>

  <footer id="resources" class="border-t border-slate-700/40 px-6 py-10">
    <div class="max-w-6xl mx-auto grid gap-8 md:grid-cols-5">
      <div class="md:col-span-2">
        <div class="tf-brand">TaskFlow</div>
        <p class="tf-muted mt-3 max-w-sm text-sm">Empowering focus through simple tasks, dates, and admin controls.</p>
      </div>
      <div><p class="text-xs font-black text-blue-300">PRODUCT</p><p class="tf-muted mt-3 text-sm">Features</p><p class="tf-muted mt-2 text-sm">Solutions</p></div>
      <div><p class="text-xs font-black text-blue-300">COMPANY</p><p class="tf-muted mt-3 text-sm">About</p><p class="tf-muted mt-2 text-sm">Careers</p></div>
      <div><p class="text-xs font-black text-blue-300">LEGAL</p><p class="tf-muted mt-3 text-sm">Privacy</p><p class="tf-muted mt-2 text-sm">Terms</p></div>
    </div>
  </footer>
</body>
</html>
