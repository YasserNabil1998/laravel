<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'created_by', 'duration_minutes', 'total_questions',
        'passing_score', 'start_time', 'end_time', 'is_active', 'is_published'
    ];
}


