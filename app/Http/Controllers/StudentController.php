<?php

namespace App\Http\Controllers;

use App\Job;
use App\Comment;
use App\Delivery;
use App\Notifications\StudentNotification;
use App\Traits\FilesTrait;
use Illuminate\Http\Request;
use App\Traits\StudentsTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TeacherNotification;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:student')->except('updateDelivery', 'addComment');
        $this->middleware('role:teacher')->only('updateDelivery');
    }

    public function penddings()
    {
        $jobs = StudentsTrait::pendding();
        return view('admin.students.penddings', compact('jobs'));
    }

    public function descargar($job)
    {
        $file = public_path('tareas/') . $job;
        return response()->download($file);
    }

    public function deliver($id)
    {
        $job = Job::find($id);

        $notif = auth()->user()->notifications()->whereNotifiable_id(auth()->user()->id)
            ->whereRead_at(null)
            ->where('data->tipo', 'Tarea')
            ->where('data->action', $id)
            ->get();

        $notif->markAsRead();

        return view('admin.students.create', compact('job'));
    }

    public function store(Request $request)
    {

        try {
            // DB::transaction(function () use ($request) {
            $nameFile = FilesTrait::store($request, $ubicacion = 'entregas', $nombre = auth()->user()->name);
            // if ($request->file->getClientOriginalExtension() == 'pdf' || $request->file->getClientOriginalExtension() == 'docx') {
            //     $nameFile = time() . '_' . auth()->user()->name . '.' . $request->file->getClientOriginalExtension();
            //     $path = public_path('entregas/');
            //     $request->file->move($path, $nameFile);
            // }

            // if ($nameFile) {
            $delivery = Delivery::create([
                'job_id' => $request->job,
                'file_path' => $nameFile,
                'state' => 0,
                'user_id' => Auth::user()->id,
            ]);
            // }

            // Si tiene comentarios los crea
            if ($request->comment) {
                Comment::create([
                    'user_id' => Auth::user()->id,
                    'delivery_id' => $delivery->id,
                    'comment' => $request->comment,
                ]);
            }

            $job = Job::find($request->job);
            $user = $job->subject->teacher;
            $user->notify(new TeacherNotification('Entrega', $delivery, 'Nueva Entrega'));
            // });

            session()->flash('message', 'Entrega creada');
        } catch (\Throwable $th) {
            session()->flash('message', 'Error');
        }

        return redirect()->to('/student');
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::find($id);
        if ($request->file) {
            $nameFile = FilesTrait::update($request, 'entregas', auth()->user()->name, $delivery);
        } else $nameFile = $delivery->file_path;

        $delivery->update([
            'file_path' => $nameFile
        ]);

        $job = Job::find($delivery->job_id);
        $user = $job->subject->teacher;
        $user->notify(new TeacherNotification('Entrega', $delivery, 'Entrega Actualizada'));
    }

    public function deliveries()
    {

        $deliveries = Delivery::where('user_id', Auth::id())->with('comments')->get();

        return view('admin.students.deliveries', compact('deliveries'));
    }

    public function updateDelivery(Request $request, $id)
    {
        Delivery::where('id', $id)

            ->update(['state' => $request->state]);

        $delivery = Delivery::find($id);
        if ($request->state == 1) {
            $student = $delivery->user;
            $student->notify(new StudentNotification('Entrega', $delivery, 'Revisar Entrega'));
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $delivery = Delivery::find($id);

        $notif = auth()->user()->notifications()->whereNotifiable_id(auth()->user()->id)
            ->whereRead_at(null)
            ->where('data->tipo', 'Entrega')
            ->where('data->action', $id)
            ->get();

        $notif->markAsRead();

        return view('admin.students.delivery', compact('delivery'));
    }

    public function addComment(Request $request)
    {

        Comment::create([
            'user_id' => Auth::user()->id,
            'delivery_id' => $request->delivery,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }
}
