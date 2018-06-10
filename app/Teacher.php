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
        return $this->hasOne(studio::class);
    }

    public function lessons(){
        return $this->belongsToMany(Lesson::class);
    }

    public function lesson_dates(){
        return $this->hasMany(LessonDate::class);
    }
}
