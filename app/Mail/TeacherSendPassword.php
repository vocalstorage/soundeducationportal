<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Teacher;

class TeacherSendPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Teacher $teacher, $password)
    {
        $this->teacher = $teacher;
        $this->password = $password;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('teacher.mail.teacherSendPassword');
    }
}
