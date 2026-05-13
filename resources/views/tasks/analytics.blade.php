<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Analytics - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="mb-6">
      <h1 class="text-2xl font-black">Analytics</h1>
      <p class="tf-muted text-sm mt-1">Simple numbers you can explain quickly.</p>
    </div>

    <div class="grid gap-5 md:grid-cols-4 mb-6">
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">TOTAL</p><p class="tf-stat-value mt-6">{{ $total }}</p></div>
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">DONE</p><p class="tf-stat-value mt-6">{{ $completed }}</p></div>
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">PENDING</p><p class="tf-stat-value mt-6">{{ $pending }}</p></div>
      <div class="tf-card tf-stat"><p class="tf-muted text-xs font-black">RATE</p><p class="tf-stat-value mt-6">{{ $completionRate }}%</p></div>
    </div>

    <div class="grid gap-5 lg:grid-cols-2">
      <section class="tf-card p-6">
        <h2 class="font-black">Priority Split</h2>
        <div class="mt-6 space-y-5">
          @foreach([['High', $high, 'high'], ['Medium', $medium, 'medium'], ['Low', $low, 'low']] as [$label, $count, $type])
            @php $width = $total > 0 ? max(6, round(($count / $total) * 100)) : 6; @endphp
            <div>
              <div class="mb-2 flex justify-between text-sm">
                <span class="font-bold">{{ $label }}</span>
                <span class="tf-muted">{{ $count }} tasks</span>
              </div>
              <div class="h-3 rounded bg-slate-800">
                <div class="h-3 rounded {{ $type === 'high' ? 'bg-red-400' : ($type === 'medium' ? 'bg-orange-300' : 'bg-green-300') }}" style="width: {{ $width }}%"></div>
              </div>
            </div>
          @endforeach
        </div>
      </section>

      <section class="tf-card p-6">
        <h2 class="font-black">Recent Tasks</h2>
        <div class="mt-4 space-y-3">
          @forelse($tasks->sortByDesc('created_at')->take(6) as $task)
            <div class="tf-card-soft flex items-center justify-between gap-4 p-4">
              <div>
                <p class="font-bold">{{ $task->title }}</p>
                <p class="tf-muted text-xs">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'No date' }}</p>
              </div>
              <span class="tf-pill {{ $task->status === 'completed' ? 'done' : 'pending' }}">{{ ucfirst($task->status) }}</span>
            </div>
          @empty
            <p class="tf-muted text-sm">No tasks to analyze yet.</p>
          @endforelse
        </div>
      </section>
    </div>
  </main>
</div>
</body>
</html>
