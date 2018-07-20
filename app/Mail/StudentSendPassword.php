<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Student;

class StudentSendPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $student, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student, $password)
    {
        $this->student = $student;
        $this->password = $password;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('planning@soundeducation.nl')
            ->subject('Inlog gegevens voor de planning van praktijklessen')
            ->markdown('student.mail.studentSendPassword');
    }
}
