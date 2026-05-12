<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - TaskFlow</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: { colors: { primary: '#1e3a5f', secondary: '#2E5C8E' } } }
    }
  </script>
  <style type="text/tailwindcss">
    @layer components {
      .btn-primary { @apply bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition font-semibold; }
      .sidebar-link { @apply flex items-center gap-3 px-4 py-3 rounded-lg text-blue-100 hover:bg-secondary transition font-medium; }
      .sidebar-active { @apply bg-secondary text-white flex items-center gap-3 px-4 py-3 rounded-lg font-medium; }
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

  <!-- SIDEBAR -->
  <aside class="w-64 bg-primary min-h-screen flex flex-col fixed left-0 top-0">
    <div class="px-6 py-6 border-b border-blue-800">
      <h1 class="text-white text-2xl font-bold">TaskFlow</h1>
      <p class="text-blue-300 text-sm mt-1">Welcome, {{ Auth::user()->name }}</p>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-2">
      <a href="{{ route('dashboard') }}" class="sidebar-active">📋 Dashboard</a>
      <a href="{{ route('tasks.create') }}" class="sidebar-link">➕ Add Task</a>
      @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.index') }}" class="sidebar-link">🛡️ Admin Panel</a>
      @endif
    </nav>
    <div class="px-4 py-6 border-t border-blue-800">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-link w-full text-left">🚪 Logout</button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="ml-64 flex-1 p-8">
    <div class="flex justify-between items-center mb-8">
      <div>
        <h2 class="text-3xl font-bold text-primary">My Tasks</h2>
        <p class="text-gray-500 mt-1">Manage your personal tasks</p>
      </div>
      <a href="{{ route('tasks.create') }}" class="btn-primary">+ Add Task</a>
    </div>

    @if(session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-6 mb-8">
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-4xl font-bold text-primary">{{ $total }}</p>
        <p class="text-gray-500 mt-2 font-medium">Total Tasks</p>
      </div>
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-4xl font-bold text-green-500">{{ $completed }}</p>
        <p class="text-gray-500 mt-2 font-medium">Completed</p>
      </div>
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-4xl font-bold text-yellow-500">{{ $pending }}</p>
        <p class="text-gray-500 mt-2 font-medium">Pending</p>
      </div>
    </div>

    <!-- TASK LIST -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-bold text-primary">Task List</h3>
      </div>
      @if($tasks->isEmpty())
        <div class="text-center py-16 text-gray-400">
          <p class="text-5xl mb-4">📝</p>
          <p class="text-lg font-medium">No tasks yet!</p>
          <p class="text-sm mt-1">Click Add Task to create your first task.</p>
        </div>
      @else
        <div class="divide-y divide-gray-100">
          @foreach($tasks as $task)
            <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition">

              <!-- TOGGLE -->
              <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-6 h-6 rounded border-2 flex items-center justify-center
                  {{ $task->status === 'completed' ? 'bg-green-500 border-green-500 text-white' : 'border-gray-300' }}">
                  {{ $task->status === 'completed' ? '✓' : '' }}
                </button>
              </form>

              <!-- TASK INFO -->
              <div class="flex-1">
                <span class="font-medium {{ $task->status === 'completed' ? 'line-through text-gray-400' : 'text-gray-800' }}">
                  {{ $task->title }}
                </span>
                @if($task->due_date)
                  <span class="block text-xs text-gray-400 mt-1">📅 Due: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span>
                @endif
              </div>

              <!-- PRIORITY -->
              @php
                $colors = ['high'=>'bg-red-100 text-red-700','medium'=>'bg-yellow-100 text-yellow-700','low'=>'bg-green-100 text-green-700'];
              @endphp
              <span class="px-3 py-1 rounded-full text-xs font-bold {{ $colors[$task->priority] }}">
                {{ ucfirst($task->priority) }}
              </span>

              <!-- ACTIONS -->
              <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-50 text-primary px-3 py-1 rounded-lg text-sm font-medium hover:bg-blue-100 transition">✏️ Edit</a>
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-sm font-medium hover:bg-red-100 transition">🗑️ Delete</button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </main>
</body>
</html>