<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonDate extends Model
{
    protected $fillable = ['date',
        'registrations',
        'lesson_id',
        'teacher_id',
        'date',
        'time',];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function lessonDateRegistrations()
    {
        return $this->hasMany(LessonDateRegistration::class);
    }
}

