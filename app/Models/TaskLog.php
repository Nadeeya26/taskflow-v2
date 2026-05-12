<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = ['task_id', 'action'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}