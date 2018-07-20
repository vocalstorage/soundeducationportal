<?php

namespace App\Mail;

use App\LessonDate;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LessondateScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $lessondate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lessondate)
    {
        $this->lessondate = $lessondate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('planning@soundeducation.nl')
                ->subject('Les bevestigd')
                ->markdown('student.mail.lessonDateIsScheduled');
    }
}
