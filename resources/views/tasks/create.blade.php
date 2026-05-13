<!DOCTYPE html>
<html lang="en">
<head>
  @include('partials.tf-head')
  <title>Add Task - TaskFlow</title>
</head>
<body class="font-sans">
<div class="tf-shell">
  @include('partials.tf-sidebar')

  <main class="tf-main">
    <div class="mb-6">
      <h1 class="text-2xl font-black">Add Task</h1>
      <p class="tf-muted text-sm mt-1">Keep it simple: title, priority, date, and optional notes.</p>
    </div>

    <section class="tf-card max-w-2xl p-6">
      @if($errors->any())
        <div class="tf-card-soft mb-5 p-4 text-red-200">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('tasks.store') }}" class="space-y-5">
        @csrf
        <div>
          <label class="tf-label" for="title">Task Title</label>
          <input id="title" type="text" name="title" class="tf-input mt-2" placeholder="Write the task title" value="{{ old('title') }}" required>
        </div>

        <div>
          <label class="tf-label" for="description">Description</label>
          <textarea id="description" name="description" class="tf-textarea mt-2" rows="4" placeholder="Optional short note">{{ old('description') }}</textarea>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
          <div>
            <label class="tf-label" for="priority">Priority</label>
            <select id="priority" name="priority" class="tf-select mt-2">
              <option value="low">Low</option>
              <option value="medium" selected>Medium</option>
              <option value="high">High</option>
            </select>
          </div>
          <div>
            <label class="tf-label" for="due_date">Due Date</label>
            <input id="due_date" type="date" name="due_date" class="tf-input mt-2" value="{{ old('due_date') }}">
          </div>
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
          <button type="submit" class="tf-button primary">Save Task</button>
          <a href="{{ route('dashboard') }}" class="tf-button">Cancel</a>
        </div>
      </form>
    </section>
  </main>
</div>
</body>
</html>
