<?php

namespace App\Listeners;


use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;
use App\Filepath;

class HasUploadedImageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ImageWasUploaded $event)
    {
        $publicFilePath = str_replace(public_path(), "", $event->path());
        Filepath::create(['path' => $publicFilePath]);
    }
}
