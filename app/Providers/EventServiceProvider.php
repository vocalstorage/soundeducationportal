<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

//use Unisharp\Laravelfilemanager\Events\ImageIsDeleting;
//use Unisharp\Laravelfilemanager\Events\ImageIsRenaming;
//use Unisharp\Laravelfilemanager\Events\ImageIsUploading;
use Unisharp\Laravelfilemanager\Events\ImageWasUploaded;
use App\Listeners\HasUploadedImageListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\LessonDateDeleted' => [
            'App\Listeners\HasDeletedLessonDate',
        ],
        ImageWasUploaded::class => [
            HasUploadedImageListener::class
        ]
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
