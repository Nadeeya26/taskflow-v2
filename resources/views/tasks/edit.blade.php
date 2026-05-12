<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Task - TaskFlow</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: { colors: { primary: '#1e3a5f', secondary: '#2E5C8E' } } }
    }
  </script>
  <style type="text/tailwindcss">
    @layer components {
      .input-field { @apply w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary; }
      .btn-primary { @apply bg-primary text-white px-8 py-3 rounded-lg hover:bg-secondary transition font-semibold; }
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white rounded-2xl shadow-lg p-10 w-full max-w-lg">
    <h2 class="text-2xl font-bold text-primary mb-2">Edit Task</h2>
    <p class="text-gray-500 mb-8">Update your task details</p>

    @if($errors->any())
      <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task) }}">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Task Title *</label>
        <input type="text" name="title" class="input-field" value="{{ $task->title }}" required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Description</label>
        <textarea name="description" class="input-field" rows="3">{{ $task->description }}</textarea>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Priority</label>
        <select name="priority" class="input-field">
          <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>🟢 Low</option>
          <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>🟡 Medium</option>
          <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>🔴 High</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Status</label>
        <select name="status" class="input-field">
          <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
          <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>✅ Completed</option>
        </select>
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Due Date</label>
        <input type="date" name="due_date" class="input-field" value="{{ $task->due_date }}">
      </div>
      <div class="flex gap-4">
        <button type="submit" class="btn-primary">Save Changes</button>
        <a href="{{ route('dashboard') }}" class="px-8 py-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition font-semibold">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>