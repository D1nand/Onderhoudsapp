<?php

// app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'taskname',
        'beginDate',
        'endDate',
        // Add any other fields you want to mass assign
    ];

    // Add relationships or other methods if needed
}

