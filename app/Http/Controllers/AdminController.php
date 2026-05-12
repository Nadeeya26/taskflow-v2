<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskLog;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard');
        }
        $users = User::withCount('tasks')->orderBy('created_at', 'desc')->get();
        $tasks = Task::with('user')->orderBy('created_at', 'desc')->get();
        $total_users = $users->count();
        $total_tasks = $tasks->count();
        $completed_tasks = $tasks->where('status', 'completed')->count();
        $completion_rate = $total_tasks > 0 ? round(($completed_tasks / $total_tasks) * 100) : 0;
        return view('admin', compact('users', 'tasks', 'total_users', 'total_tasks', 'completion_rate'));
    }

    public function deleteUser(User $user)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        if ($user->role === 'admin') return redirect()->route('admin.index');
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted!');
    }

    public function deleteTask(Task $task)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        TaskLog::create(['task_id' => $task->id, 'action' => 'deleted by admin']);
        $task->delete();
        return redirect()->route('admin.index')->with('success', 'Task deleted!');
    }
}