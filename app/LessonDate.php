<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class LessonDate extends Model
{
    protected $fillable = ['date',
        'registrations',
        'lesson_id',
        'teacher_id',
        'date',
        'deadline',
        'time',];

    public function lesson()
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}

