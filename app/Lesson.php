<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    public $fillable = [
        'title',
        'description',
        'deadline',
        'max_registration',
        'teacher_id',
        'filepath_id',
        'schoolgroup_id',
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
        $deadline = Carbon::parse($this->deadline);

        $diffInDays = $deadline->diffInDays(Carbon::now());

        return $diffInDays;
    }

    public function removeLessonDates()
    {
        $i = 0;
//        if ($this->lessonDates->count() > 0) {
//            foreach ($this->lessonDates as $lessonDate) {
//                $date = Carbon::parse($lessonDate->date);
//                if ($date->isPast()) {
//                    $lessonDate->lessonDateRegistrations()->delete();
//                    $lessonDate->delete();
//                    $i++;
//                }
//            }
//        }
        return $i;
    }

    public function checkEmptyDates()
    {
        $lessonDates = [];
        if ($this->lessonDates->count() > 0) {
            foreach ($this->lessonDates()->where('warning', '!=', '2')->get() as $lessonDate) {
                $difference = Carbon::parse($this->deadline)->diffInDays($lessonDate->date);

                if($difference <= 10){
                    $lessonDate->warning = true;
                    $lessonDate->save();
                    array_push($lessonDates, $lessonDate);
                }
            }
        }
        return collect($lessonDates);
    }

    public function isPast(){
        $date = Carbon::parse($this->deadline);
        return $date->isPast();
    }


}
