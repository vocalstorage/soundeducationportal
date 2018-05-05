<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public  $fillable = [
        'title',
        'description',
        'deadline',
        'max_registration',
        'teacher_id',
    ];

    public function lessonDates(){
       return $this->hasMany(LessonDate::class)->orderBy('date', 'ASC')->orderBy('time', 'ASC');
    }
}
