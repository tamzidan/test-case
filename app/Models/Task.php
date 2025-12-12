<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'assigned_to_user_id', 'title', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Menggunakan nama 'assignedUser' sesuai screenshot
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}
