<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonDateRegistration extends Model
{
    protected $fillable = [
        'lesson_date_id',
        'student_id',
        'skill'];

    public function lessonDate()
    {
        return $this->belongsTo(LessonDate::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
