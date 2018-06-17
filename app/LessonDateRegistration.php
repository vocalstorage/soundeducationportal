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
        $errors = [];
        $errorHtml = '';
        $date = Carbon::parse($this->lessonDate->date);
        $now = Carbon::now();
        if($date->diffInDays($now) <= 5){
            $error = ['message' => '5 dagen voor de deadline is het niet meer mogelijk om in te schrijven.'];
            array_push($errors, $error);
        }
        $cancelled = \Auth::user()->lessonDateRegistrations()->onlyTrashed()
            ->where('lesson_id', '=', $this->lesson->id)
            ->where('student_id', '=', \Auth::user()->id)->get()->count();

        if($cancelled == 3){
            $error = ['message' => 'Maximum aantal uitschrijvingen voor les bereikt.'];
            array_push($errors, $error);
        }
        if(!empty($errors)){
            $errorHtml = "<div class='tooltip_error'>";
            foreach ($errors as $error){
                $errorHtml .= '<p>'. $error['message'] . '</p>';
            }
            $errorHtml .= "</div>";

            return $errorHtml;
        }else{
            return $cancelled;
        }

    }

    public function isPast(){
        $date = Carbon::parse($this->lessonDate->date);
        return $date->isPast();
    }
}
