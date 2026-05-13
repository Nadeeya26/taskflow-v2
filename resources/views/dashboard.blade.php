<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>My Tasks - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-black">My Tasks</h1>
        <p class="tf-muted text-sm mt-1">Welcome back, {{ Auth::user()->name }}.</p>
      </div>
      <a href="{{ route('tasks.create') }}" class="tf-button primary">Add Task</a>
    </div>

    @if(session('success'))
      <div class="tf-card-soft mb-5 p-4 text-green-200">{{ session('success') }}</div>
    @endif

    <div class="grid gap-5 md:grid-cols-3 mb-6">
      <div class="tf-card tf-stat">
        <p class="tf-muted text-xs font-black">TOTAL TASKS</p>
        <div class="mt-6 flex items-end justify-between">
          <p class="tf-stat-value">{{ $total }}</p>
          <span class="tf-icon">D</span>
        </div>
      </div>
      <div class="tf-card tf-stat">
        <p class="tf-muted text-xs font-black">COMPLETED</p>
        <div class="mt-6 flex items-end justify-between">
          <p class="tf-stat-value">{{ $completed }}</p>
          <span class="tf-pill done">{{ $total > 0 ? round(($completed / $total) * 100) : 0 }}%</span>
        </div>
      </div>
      <div class="tf-card tf-stat">
        <p class="tf-muted text-xs font-black">PENDING</p>
        <div class="mt-6 flex items-end justify-between">
          <p class="tf-stat-value">{{ $pending }}</p>
          <span class="tf-pill pending">open</span>
        </div>
      </div>
    </div>

    <section class="tf-card overflow-hidden">
      <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-700/40 px-5 py-4">
        <h2 class="font-black">Task List</h2>
        <div class="flex gap-2">
          <a href="{{ route('tasks.calendar') }}" class="tf-button">Calendar</a>
          <a href="{{ route('tasks.analytics') }}" class="tf-button">Analytics</a>
        </div>
      </div>

      @if($tasks->isEmpty())
        <div class="px-6 py-20 text-center">
          <div class="tf-card-soft mx-auto mb-6 flex h-28 w-28 items-center justify-center">
            <span class="tf-icon !h-12 !w-12">T</span>
          </div>
          <h3 class="text-2xl font-black">No tasks yet!</h3>
          <p class="tf-muted mx-auto mt-2 max-w-md text-sm">
            Your workspace is clean. Start organizing your workflow by adding your first task.
          </p>
          <a href="{{ route('tasks.create') }}" class="tf-button primary mt-6">Create your first task</a>
        </div>
      @else
        <div class="overflow-x-auto">
          <table class="tf-table">
            <thead>
              <tr>
                <th>Done</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Due</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tasks as $task)
                <tr>
                  <td>
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="tf-button !w-9 !min-h-9 !p-0 {{ $task->status === 'completed' ? 'primary' : '' }}">
                        {{ $task->status === 'completed' ? 'OK' : '' }}
                      </button>
                    </form>
                  </td>
                  <td>
                    <div class="font-bold {{ $task->status === 'completed' ? 'line-through tf-muted' : '' }}">{{ $task->title }}</div>
                    @if($task->description)
                      <p class="tf-muted mt-1 max-w-xl text-xs">{{ $task->description }}</p>
                    @endif
                  </td>
                  <td><span class="tf-pill {{ $task->priority }}">{{ ucfirst($task->priority) }}</span></td>
                  <td class="tf-muted">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No date' }}</td>
                  <td><span class="tf-pill {{ $task->status === 'completed' ? 'done' : 'pending' }}">{{ ucfirst($task->status) }}</span></td>
                  <td>
                    <div class="flex flex-wrap gap-2">
                      <a href="{{ route('tasks.edit', $task) }}" class="tf-button">Edit</a>
                      <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="tf-button danger">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </section>
  </main>
</div>
</body>
</html>
