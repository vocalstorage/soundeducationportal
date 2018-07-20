<?php

namespace App\Mail;

use App\LessonDate;
use App\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeacherSendLessonDateDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher, $lessonDate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Teacher $teacher, LessonDate $lessonDate)
    {
        $this->teacher = $teacher;
        $this->lessonDate = $lessonDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('rowan@soundeducation.nl')
            ->subject('Les vervallen voor docenten')
            ->markdown('teacher.mail.teacherSendLessonDateDeleted');

    }
}
