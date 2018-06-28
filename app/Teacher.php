<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{

    use Notifiable;

    protected $fillable = ['name',
        'color',
        'email',
        'studio_id',
        'password'];


    public function studio()
    {
        return $this->hasOne(Studio::class);
    }

    public function lessons(){
        return $this->belongsToMany(Lesson::class);
    }

    public function lesson_dates(){
        return $this->hasMany(LessonDate::class);
    }

    public function warnings(){
        $html = "";

        if($this->lesson_dates()){
            $html .= '<p class="warning">Deze leraar heeft nog  '. $this->lesson_dates()->count().' lesson open staan</p>';
        }

        return $html;
    }

    public function hasAppointmentToday(){
        foreach ($this->lessons as $lesson){
            foreach ($lesson->lessonDates as $lessonDate){
                if($lessonDate->date->isToday()){
                    dd($lessonDate->date);
                }
            }
        }
    }


}
