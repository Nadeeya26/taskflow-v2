<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Edit Task - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="mb-6">
      <h1 class="text-2xl font-black">Edit Task</h1>
      <p class="tf-muted text-sm mt-1">Update the task without changing the workflow.</p>
    </div>

    <section class="tf-card max-w-2xl p-6">
      @if($errors->any())
        <div class="tf-card-soft mb-5 p-4 text-red-200">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
          <label class="tf-label" for="title">Task Title</label>
          <input id="title" type="text" name="title" class="tf-input mt-2" value="{{ old('title', $task->title) }}" required>
        </div>

        <div>
          <label class="tf-label" for="description">Description</label>
          <textarea id="description" name="description" class="tf-textarea mt-2" rows="4">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="grid gap-5 md:grid-cols-3">
          <div>
            <label class="tf-label" for="priority">Priority</label>
            <select id="priority" name="priority" class="tf-select mt-2">
              <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
              <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
              <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
            </select>
          </div>
          <div>
            <label class="tf-label" for="status">Status</label>
            <select id="status" name="status" class="tf-select mt-2">
              <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
          </div>
          <div>
            <label class="tf-label" for="due_date">Due Date</label>
            <input id="due_date" type="date" name="due_date" class="tf-input mt-2" value="{{ old('due_date', $task->due_date) }}">
          </div>
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
          <button type="submit" class="tf-button primary">Save Changes</button>
          <a href="{{ route('dashboard') }}" class="tf-button">Cancel</a>
        </div>
      </form>
    </section>
  </main>
</div>
</body>
</html>
