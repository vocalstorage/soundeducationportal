<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'schoolgroup_id','email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lessonDateRegistrations()
    {
        return $this->hasmany(LessonDateRegistration::class);
    }

    public function schoolgroup(){
        return $this->belongsTo(Schoolgroup::class);
    }

    public function cancels(){
        return $this->lessonDateRegistrations()->onlyTrashed()->get()->count();
    }
}


