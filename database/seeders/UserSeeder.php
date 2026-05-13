<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@taskflow.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'otp' => null,
            'is_verified' => true,
        ]);

        $john = User::create([
            'name' => 'John Smith',
            'email' => 'john@taskflow.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $sara = User::create([
            'name' => 'Sara Lee',
            'email' => 'sara@taskflow.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        Task::create(['user_id'=>$john->id,'title'=>'Complete project proposal','description'=>'Write and submit proposal','priority'=>'high','status'=>'pending','due_date'=>'2025-06-01']);
        Task::create(['user_id'=>$john->id,'title'=>'Review code changes','description'=>'Review pull requests','priority'=>'medium','status'=>'pending','due_date'=>'2025-05-20']);
        Task::create(['user_id'=>$john->id,'title'=>'Update documentation','description'=>'Update README file','priority'=>'low','status'=>'completed','due_date'=>'2025-05-15']);
        Task::create(['user_id'=>$sara->id,'title'=>'Design new homepage','description'=>'Create mockups','priority'=>'high','status'=>'pending','due_date'=>'2025-06-05']);
        Task::create(['user_id'=>$sara->id,'title'=>'Fix login bug','description'=>'Investigate session bug','priority'=>'high','status'=>'completed','due_date'=>'2025-05-16']);
    }
}
