<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonDateRegistration extends Model
{

    use SoftDeletes;

    protected $softDelete = true;

    protected $fillable = [
        'lesson_date_id',
        'student_id',
        'lesson_id',
        'skill',
        'comment',
        'presence'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonDate()
    {
        return $this->belongsTo(LessonDate::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function mayCancel(){
        if(empty($this->errors())){
            return true;
        }
        return false;
    }

    public function warnings(){
        $html = "";

        $cancelled = \Auth::user()->lessonDateRegistrations()->onlyTrashed()
            ->where('lesson_id', '=', $this->lesson->id)
            ->where('student_id', '=', \Auth::user()->id)->get()->count();

        if($cancelled == 3){
            $html .= '<p class="warning">Dit is de laatste keer dat je jezelf mag uitschrijven</p>';
        }else{
            $attempts = 4 - $cancelled;
            $html .= '<p class="warning">Je mag je nog '. $attempts .' keer uitschrijven voor deze les</p>';
        }






        return $html;
    }


    public function errors(){
        $html = "";

        if($this->lessonDate->lesson->deadline->diffInDays(Carbon::now()) <= 5){
            $html .= '<p class="warning">5 dagen voor de deadline is het niet meer mogelijk om in te schrijven.</p>';
        }

        $cancelled = \Auth::user()->lessonDateRegistrations()->onlyTrashed()
            ->where('lesson_id', '=', $this->lesson->id)
            ->where('student_id', '=', \Auth::user()->id)->get()->count();

        if($cancelled >= 4){
            $html .= '<p class="warning">Maximum aantal uitschrijvingen voor les bereikt.</p>';
        }


        return $html;
    }
}
