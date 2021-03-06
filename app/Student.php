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
        'name',
        'password',
        'schoolgroup_id',
        'email',
        'tel',
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

    public function warnings(){
        $html = "";

        if ($this->lessonDateRegistrations()) {
            $html .= '<p class="warning">Deze student heeft nog ' . $this->lessonDateRegistrations()->count() . ' registratie(s)</p>';
        }

        return $html;
    }

}


