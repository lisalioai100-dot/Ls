<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Publish;
use App\Models\Student;


class LessonObserver
{
    /**
     * Handle the Lesson "created" event.
     */
    public function created(Lesson $lesson): void
    {
        $students = Student::all();
        Notification::send($students , new Publish($lesson->name , 'video'));
    }

}
