<aside class="tf-sidebar">
  <div class="mb-8">
    <div class="tf-brand text-xl">TaskFlowPro</div>
    <p class="tf-muted text-xs mt-1">Workspace admin</p>
  </div>

  <nav class="space-y-2">
    <a href="{{ route('dashboard') }}" class="tf-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
      <span class="tf-icon">D</span> Dashboard
    </a>
    <a href="{{ route('tasks.create') }}" class="tf-nav-item {{ request()->routeIs('tasks.create') ? 'active' : '' }}">
      <span class="tf-icon">T</span> Tasks
    </a>
    <a href="{{ route('tasks.calendar') }}" class="tf-nav-item {{ request()->routeIs('tasks.calendar') ? 'active' : '' }}">
      <span class="tf-icon">C</span> Calendar
    </a>
    <a href="{{ route('tasks.analytics') }}" class="tf-nav-item {{ request()->routeIs('tasks.analytics') ? 'active' : '' }}">
      <span class="tf-icon">A</span> Analytics
    </a>
    <a href="{{ route('tasks.settings') }}" class="tf-nav-item {{ request()->routeIs('tasks.settings') ? 'active' : '' }}">
      <span class="tf-icon">S</span> Settings
    </a>
    @if(Auth::user()->isAdmin())
      <a href="{{ route('admin.index') }}" class="tf-nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
        <span class="tf-icon">P</span> Admin Panel
      </a>
    @endif
  </nav>

  <div class="absolute bottom-5 left-5 right-5 space-y-2">
    <a href="{{ route('tasks.create') }}" class="tf-button primary w-full">New Task</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="tf-nav-item w-full text-left">
        <span class="tf-icon">L</span> Logout
      </button>
    </form>
  </div>
</aside>
