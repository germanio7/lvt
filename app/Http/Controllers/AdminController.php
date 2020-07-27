<?php

namespace App\Http\Controllers;

use App\User;
use App\Subject;
use App\Delivery;
use App\Job;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use App\Traits\TeachersTrait;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:student')->only('student');
        $this->middleware('role:teacher')->only('teacher');
        $this->middleware('role:adviser')->only('adviser');
    }

    public function teacher()
    {
        $year = now()->format('Y');
        $subjects = TeachersTrait::subjects($year);
        $noLeidas = auth()->user()->unreadNotifications()->get();
        return view('admin.teachers.index', compact('subjects', 'noLeidas'));
    }

    public function student()
    {
        // $posts = Post::where('user_id',Auth::user()->id)->where('course_id',$subject->course_id)->with('annotations')->get();

        $user = Auth::user();
        $enrol = StudentsTrait::enrollment(2020);
        $subjects =  $enrol->subjects;
        $ids = $subjects->modelkeys();
        $subjects = Subject::whereIn('id',$ids)->with('posts')->get();

        $deliveries = Delivery::where('user_id', $user->id)->get();
        $jobs = StudentsTrait::pendding();

        $noLeidas = auth()->user()->unreadNotifications()->get();

        return view('admin.students.index', compact('user', 'jobs', 'deliveries','subjects', 'noLeidas'));
    }

    public function adviser()
    {
        $jobs = Job::where('state', 0)->get();
        $noLeidas = auth()->user()->unreadNotifications()->get();
        return view('admin.advisers.index', compact('jobs', 'noLeidas'));
    }
}
