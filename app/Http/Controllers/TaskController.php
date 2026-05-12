<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $total = $tasks->count();
        $completed = $tasks->where('status', 'completed')->count();
        $pending = $total - $completed;
        return view('dashboard', compact('tasks', 'total', 'completed', 'pending'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        TaskLog::create(['task_id' => $task->id, 'action' => 'created']);
        return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    public function edit(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());
        TaskLog::create(['task_id' => $task->id, 'action' => 'updated']);
        return redirect()->route('dashboard')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        TaskLog::create(['task_id' => $task->id, 'action' => 'deleted']);
        $task->delete();
        return redirect()->route('dashboard')->with('success', 'Task deleted!');
    }

    public function toggle(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);
        $task->update(['status' => $task->status === 'completed' ? 'pending' : 'completed']);
        TaskLog::create(['task_id' => $task->id, 'action' => 'toggled']);
        return redirect()->route('dashboard');
    }
}