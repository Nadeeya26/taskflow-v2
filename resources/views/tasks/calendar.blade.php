<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Calendar - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-black">Calendar</h1>
        <p class="tf-muted text-sm mt-1">Tasks grouped by due date.</p>
      </div>
      <a href="{{ route('tasks.create') }}" class="tf-button primary">Add Task</a>
    </div>

    @php
      $groupedTasks = $tasks->groupBy(function ($task) {
          return \Carbon\Carbon::parse($task->due_date)->format('Y-m-d');
      });
    @endphp

    <section class="tf-calendar-grid">
      @forelse($groupedTasks as $date => $dayTasks)
        <div class="tf-card tf-day">
          <p class="text-sm font-black">{{ \Carbon\Carbon::parse($date)->format('d M') }}</p>
          <p class="tf-muted text-xs">{{ \Carbon\Carbon::parse($date)->format('l') }}</p>
          <div class="mt-4 space-y-2">
            @foreach($dayTasks as $task)
              <a href="{{ route('tasks.edit', $task) }}" class="block rounded-md border border-slate-700/50 bg-slate-950/30 p-3">
                <span class="block text-sm font-bold">{{ $task->title }}</span>
                <span class="tf-pill {{ $task->priority }} mt-2">{{ ucfirst($task->priority) }}</span>
              </a>
            @endforeach
          </div>
        </div>
      @empty
        <div class="tf-card col-span-full p-10 text-center">
          <h2 class="text-xl font-black">No dated tasks yet</h2>
          <p class="tf-muted mt-2 text-sm">Add a due date to a task and it will appear here.</p>
          <a href="{{ route('tasks.create') }}" class="tf-button primary mt-5">Create dated task</a>
        </div>
      @endforelse
    </section>
  </main>
</div>
</body>
</html>
