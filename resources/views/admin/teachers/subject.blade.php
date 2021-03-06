@extends('layouts.dashboard')

@section('content')
<div class="container font-montserrat text-sm ">
    <div class="card  rounded-sm bg-gray-100 mx-auto md:mt-10 shadow-lg">
        <div class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between ">
        <h1 class="text-teal-600 font-semibold">{{$subject->name}}</h1>
            <a href="{{route('teacher.create', $subject)}}" class="bg-teal-600 text-white text-sm p-2 shadow-lg hover:text-gray-700">New Job</a>

        </div>
        <div class="card-body py-2">
            <table class="text-gray-700">
                <thead>
                    <tr class="text-center">
                        <th class="w-1/12 px-10 hidden md:block">ID</th>
                        <th class="md:w-5/12 w-2/12 px-10 ">Title</th>
                        <th class="w-3/12 ">Start</th>
                        <th class="w-3/12 ">End</th>
                        <th class="w-3/12 px-10">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($subject->jobs as $job)
                        <tr class="text-center">
                        <td  class="w-1/12 px-10 hidden md:block ">{{$job->id}}</td>
                        <td  class="w-3/12 ">{{$job->title}}</td>
                        <td  class="w-3/12">{{$job->start->format('d-m-Y')}}</td>
                        <td  class="w-3/12">{{$job->end->format('d-m-Y')}}</td>
                        <td  class="md:w-3/12 w-9/12">
                            <div class="flex justify-center">
                                <a href="{{route('teachers.show', $job->id)}}" class="mx-1 text-teal-400">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="pencil-alt" class="h-4 w-4 svg-inline--fa fa-pencil-alt fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"/></svg>
                                </a>
                                <a href="{{route('teacher.showJob', $job->id)}}" class="mx-1 text-teal-600">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="trash-alt" class="h-4 w-4 svg-inline--fa fa-trash-alt fa-w-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M32 464a48 48 0 0048 48h288a48 48 0 0048-48V128H32zm272-256a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zm-96 0a16 16 0 0132 0v224a16 16 0 01-32 0zM432 32H312l-9.4-18.7A24 24 0 00281.1 0H166.8a23.72 23.72 0 00-21.4 13.3L136 32H16A16 16 0 000 48v32a16 16 0 0016 16h416a16 16 0 0016-16V48a16 16 0 00-16-16z"/></svg>
                                </a>
                                <a href="{{route('teacher.descargar', $job->file_path)}}" class="mx-1 text-teal-800">
                                <svg aria-hidden="true" data-prefix="fas" data-icon="info" class="h-4 w-4 svg-inline--fa fa-info fa-w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M20 424.229h20V279.771H20c-11.046 0-20-8.954-20-20V212c0-11.046 8.954-20 20-20h112c11.046 0 20 8.954 20 20v212.229h20c11.046 0 20 8.954 20 20V492c0 11.046-8.954 20-20 20H20c-11.046 0-20-8.954-20-20v-47.771c0-11.046 8.954-20 20-20zM96 0C56.235 0 24 32.235 24 72s32.235 72 72 72 72-32.235 72-72S135.764 0 96 0z"/></svg>
                                </a>

                            </div>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <div class="comments mt-10">
        <h1 class="text-2xl font-rubik">Posts</h1>
    <a href="{{route('new.post',$subject->id)}}">New Post</a>
    @if(count($posts)>0)
        @foreach ($posts as $post)
        <div class="card bg-white w-10/12 p-5 my-3">
            <div class="card-title">
                <h1>{{$post->title}}</h1>
            <h4>Author: {{auth()->user()->name}}</h4>
                <span>Published: {{$post->created_at}}</span>
                <span>{{$post->description}}</span>
                <p>{{$post->content}}</p>
            </div>

        </div>
            @foreach ($post->annotations as $annotation)
            <div class="card bg-white w-8/12 p-5">
                <div class="card-title">
                    <h4>Author: {{$annotation->user->name}}</h4>
                    <h1>{{$annotation->annotation}}</h1>

                    <span>Published: {{$annotation->created_at}}</span>
                </div>

            </div>
            @endforeach

            <div>
            <form action="{{route('annotations.store')}}" method="POST">
                    @csrf
                    <input type="text" name="post_id" value="{{$post->id}}" hidden>
                    <input type="text" name="subject_id" value="{{$subject->id}}" hidden>
                    <div
                        class="w-8/12 mx-5 border border-gray-600 bg-white h-8 rounded-full px-5 py-1 content-center flex items-center">
                        <input name="annotation" type="text" class="bg-transparent focus:outline-none w-full  text-sm   ">
                        <button type="submit" class="text-teal-600 font-semibold">Comment</button>
                    </div>
                </form>
            </div>
        @endforeach

    @else
            <h1>No posee posts</h1>
    @endif


    </div>

</div>
@endsection
