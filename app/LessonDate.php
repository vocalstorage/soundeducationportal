<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonDate extends Model
{
    protected $fillable = [
        'registrations',
        'lesson_id',
        'teacher_id',
        'date',
        'time',];

    protected $dates = [
        'date'
    ];

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

    public function warnings(){
        $html = "";

        if($this->lessonDateRegistrations()){
            $html .= '<p class="warning">De les heeft '. $this->lessonDateRegistrations->count().' registratie(s)</p>';
        }

        return $html;
    }

}

