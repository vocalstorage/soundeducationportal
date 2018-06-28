<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    public $fillable = [
        'title',
        'description',
        'max_registration',
        'deadline',
        'teacher_id',
        'filepath_id',
        'schoolgroup_id',
    ];

    protected $dates = [
        'deadline'
    ];

    public function lessonDates()
    {
        return $this->hasMany(LessonDate::class)->orderBy('date', 'ASC')->orderBy('time', 'ASC');
    }

    public function lessonDateRegistrations()
    {
        return $this->hasMany(LessonDateRegistration::class);
    }

    public function filepath()
    {
        return $this->belongsTo(Filepath::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->whereHas('studio');
    }

    public function schoolgroup()
    {
        return $this->belongsTo(Schoolgroup::class);
    }

    public function diffDeadline()
    {
        $diffInDays = $this->deadline->diffInDays(Carbon::now()) - 5;

        return $diffInDays;
    }

    public function maySchedule(){

        if($this->diffDeadline() > 0 && !$this->deadline->isPast()){
            return true;
        }
        return false;
    }


    public function checkEmptyDates()
    {
        $lessonDates = [];
        if ($this->lessonDates->count() > 0) {
            foreach ($this->lessonDates()
                         ->where('warning', '!=', '2')
                         ->where('registrations', '<', '2')
                         ->get() as $lessonDate)
            {
                $difference = $lessonDate->lesson->diffDeadline();
                if($difference <= 10){
                    $lessonDate->warning = true;
                    $lessonDate->save();
                    array_push($lessonDates, $lessonDate);
                }
            }
        }
        return collect($lessonDates);
    }

    public function warnings(){
        $html = "";

        if($this->lessonDateRegistrations()){
            $html .= '<p class="warning">De les heeft '. $this->lessonDateRegistrations->count().' registratie(s)</p>';
        }

        return $html;
    }




}
