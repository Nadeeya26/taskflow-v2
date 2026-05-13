<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Admin Panel - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="mb-6">
      <h1 class="text-2xl font-black">Admin Panel</h1>
      <p class="tf-muted text-sm mt-1">Manage users and tasks from one simple screen.</p>
    </div>

    @if(session('success'))
      <div class="tf-card-soft mb-5 p-4 text-green-200">{{ session('success') }}</div>
    @endif

    <div class="grid gap-5 md:grid-cols-3 mb-6">
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">TOTAL USERS</p><p class="tf-stat-value mt-6">{{ $total_users }}</p></div>
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">TOTAL TASKS</p><p class="tf-stat-value mt-6">{{ $total_tasks }}</p></div>
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">COMPLETION RATE</p><p class="tf-stat-value mt-6">{{ $completion_rate }}%</p></div>
    </div>

    <section class="tf-card overflow-hidden mb-6">
      <div class="border-b border-slate-700/40 px-5 py-4">
        <h2 class="font-black">All Users</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="tf-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Tasks</th>
              <th>Joined</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr>
                <td class="font-bold">{{ $user->name }}</td>
                <td class="tf-muted">{{ $user->email }}</td>
                <td><span class="tf-pill {{ $user->role === 'admin' ? 'high' : 'pending' }}">{{ ucfirst($user->role) }}</span></td>
                <td>{{ $user->tasks_count }}</td>
                <td class="tf-muted">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                  @if($user->role !== 'admin')
                    <form method="POST" action="{{ route('admin.deleteUser', $user) }}" onsubmit="return confirm('Delete this user and all their tasks?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="tf-button danger">Delete</button>
                    </form>
                  @else
                    <span class="tf-muted text-sm">Protected</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>

    <section class="tf-card overflow-hidden">
      <div class="border-b border-slate-700/40 px-5 py-4">
        <h2 class="font-black">All Tasks</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="tf-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>User</th>
              <th>Priority</th>
              <th>Status</th>
              <th>Due Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)
              <tr>
                <td class="font-bold">{{ $task->title }}</td>
                <td class="tf-muted">{{ $task->user->name }}</td>
                <td><span class="tf-pill {{ $task->priority }}">{{ ucfirst($task->priority) }}</span></td>
                <td><span class="tf-pill {{ $task->status === 'completed' ? 'done' : 'pending' }}">{{ ucfirst($task->status) }}</span></td>
                <td class="tf-muted">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No date' }}</td>
                <td>
                  <form method="POST" action="{{ route('admin.deleteTask', $task) }}" onsubmit="return confirm('Delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="tf-button danger">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </main>
</div>
</body>
</html>
