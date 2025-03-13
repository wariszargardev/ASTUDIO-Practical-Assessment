<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'status'];

    /**
     * The user that belongs to the project.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
