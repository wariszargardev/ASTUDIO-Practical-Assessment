<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = ['user_id', 'project_id', 'task_name', 'date', 'hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'user_email' => $this->user->email,
            'project_title' => $this->project->name,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'task_name' => $this->task_name,
            'date' => $this->date,
            'hours' => $this->hours,
        ];
    }
}
