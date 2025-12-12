<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'manager_id'];

    // Relasi ke Manager (User)
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Relasi ke Staff (Many-to-Many)
    public function staff()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    // Relasi ke Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Scope untuk memfilter project berdasarkan User Login (Khusus Staff)
     * Requirement: "Harus diterapkan Scope (hanya Project yang di-assign)"
     */
    public function scopeForUser(Builder $query, User $user)
    {
        // Jika user punya role Staff, ambil project di mana dia terdaftar di pivot table
        if ($user->hasRole('Staff')) {
            return $query->whereHas('staff', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        // Jika Manager/Admin/Finance, logic bisa disesuaikan (misal: tampilkan semua atau hanya yg dimanage)
        return $query;
    }
}
