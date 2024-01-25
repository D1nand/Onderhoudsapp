<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'passwordCode',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define the relationship with the Task model
    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }
}

