<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - TaskFlow</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: { colors: { primary: '#1e3a5f', secondary: '#2E5C8E' } } }
    }
  </script>
  <style type="text/tailwindcss">
    @layer components {
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
      <p class="text-blue-300 text-sm mt-1">Admin: {{ Auth::user()->name }}</p>
    </div>
    <nav class="flex-1 px-4 py-6 space-y-2">
      <a href="{{ route('dashboard') }}" class="sidebar-link">📋 Dashboard</a>
      <a href="{{ route('admin.index') }}" class="sidebar-active">🛡️ Admin Panel</a>
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
    <div class="mb-8">
      <h2 class="text-3xl font-bold text-primary">Admin Panel</h2>
      <p class="text-gray-500 mt-1">Manage all users and tasks</p>
    </div>

    @if(session('success'))
      <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">{{ session('success') }}</div>
    @endif

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-6 mb-10">
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-4xl font-bold text-primary">{{ $total_users }}</p>
        <p class="text-gray-500 mt-2 font-medium">Total Users</p>
      </div>
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-4xl font-bold text-secondary">{{ $total_tasks }}</p>
        <p class="text-gray-500 mt-2 font-medium">Total Tasks</p>
      </div>
      <div class="bg-white rounded-xl shadow p-6 text-center">
        <p class="text-4xl font-bold text-green-500">{{ $completion_rate }}%</p>
        <p class="text-gray-500 mt-2 font-medium">Completion Rate</p>
      </div>
    </div>

    <!-- USERS TABLE -->
    <div class="bg-white rounded-xl shadow overflow-hidden mb-10">
      <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-bold text-primary">All Users</h3>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
              <th class="px-6 py-3 text-left">Name</th>
              <th class="px-6 py-3 text-left">Email</th>
              <th class="px-6 py-3 text-left">Role</th>
              <th class="px-6 py-3 text-left">Tasks</th>
              <th class="px-6 py-3 text-left">Joined</th>
              <th class="px-6 py-3 text-left">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($users as $user)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $user->email }}</td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ ucfirst($user->role) }}
                  </span>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $user->tasks_count }}</td>
                <td class="px-6 py-4 text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                  @if($user->role !== 'admin')
                    <form method="POST" action="{{ route('admin.deleteUser', $user) }}" onsubmit="return confirm('Delete this user and all their tasks?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-sm hover:bg-red-100 transition font-medium">🗑️ Delete</button>
                    </form>
                  @else
                    <span class="text-gray-300 text-sm">Protected</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <!-- TASKS TABLE -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="text-lg font-bold text-primary">All Tasks</h3>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
              <th class="px-6 py-3 text-left">Title</th>
              <th class="px-6 py-3 text-left">User</th>
              <th class="px-6 py-3 text-left">Priority</th>
              <th class="px-6 py-3 text-left">Status</th>
              <th class="px-6 py-3 text-left">Due Date</th>
              <th class="px-6 py-3 text-left">Action</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($tasks as $task)
              @php $pc = ['high'=>'bg-red-100 text-red-700','medium'=>'bg-yellow-100 text-yellow-700','low'=>'bg-green-100 text-green-700']; @endphp
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $task->title }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $task->user->name }}</td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-bold {{ $pc[$task->priority] }}">{{ ucfirst($task->priority) }}</span>
                </td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-bold {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ ucfirst($task->status) }}
                  </span>
                </td>
                <td class="px-6 py-4 text-gray-400">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No date' }}</td>
                <td class="px-6 py-4">
                  <form method="POST" action="{{ route('admin.deleteTask', $task) }}" onsubmit="return confirm('Delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-sm hover:bg-red-100 transition font-medium">🗑️ Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
</html>