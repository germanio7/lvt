<?php

namespace App\Http\Controllers;

use App\Job;
use App\Notifications\StudentNotification;
use App\Notifications\TeacherNotification;
use Illuminate\Http\Request;

class AdviserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:adviser');
    }

    public function showJob($id)
    {
        $job = Job::find($id);

        // auth()->user()->notifications()->find($id)->markAsRead();

        $notif = auth()->user()->notifications()->whereNotifiable_id(auth()->user()->id)
            ->whereRead_at(null)
            ->where('data->action', $id)
            ->get();

        $notif->markAsRead();

        return view('admin.advisers.showJob', compact('job'));
    }

    public function updateJob(Request $request, $id)
    {
        $job = Job::find($id);
        $job->state = $request->state;
        $job->update();

        if ($request->state == 2) {
            $user = $job->subject->teacher;
            $user->notify(new TeacherNotification('Tarea', $job, 'Revisar Tarea'));
        } elseif ($request->state == 1) {
            $matriculas = $job->subject->course->enrollments;
            $matriculas->map(function($item) use($job){
                $user = $item->student;
                $user->notify(new StudentNotification('Tarea',$job, 'Nueva Tarea'));
            });
        }

        // auth()->user()->notifications()->find($id)->markAsRead();

        $notif = auth()->user()->notifications()->whereNotifiable_id(auth()->user()->id)
            ->whereRead_at(null)
            ->where('data->action', $id)
            ->get();

        $notif->markAsRead();

        return redirect()->action('AdminController@adviser');
    }
}
