@extends('layouts.dashboard')

@section('content')

<div class="flex justify-center p-6">
    <div class="card bg-white rounded sm:w-10/12  p-4 shadow-lg">
        <div class="flex">
            <div class="w-2/3">
                <h1 class="font-semibold">
                    {{$job->title}}
                </h1>
                <span class="block text-xs uppercase text-teal-600">{{$job->subject->name}}</span>
            </div>
            <div class="w-1/3">
                <span
                    class="float-right rounded-full text-green-700 bg-green-200 px-2 py-1 text-xs font-bold mr-3">{{$job->state($job->state)}}</span>
            </div>
            <div>
                <a class="rounded-full bg-orange-500 font-semibold text-white p-1"
                    href="{{route('teachers.edit',$job->id)}}">edit</a>
            </div>
        </div>
        <div class="py-4 text-sm">
            {{$job->description}}
        </div>
        <div class="flex justify-around items-center">
            <div class="flex items-center">
                <pre>Fecha Inicio: </pre><span
                    class="block text-xs uppercase text-teal-600">{{$job->start->format('d-m-Y')}}</span>
            </div>
            <div class="flex items-center">
                <pre>Fecha Fin: </pre><span
                    class="block text-xs uppercase text-teal-600">{{$job->end->format('d-m-Y')}}</span>
            </div>
        </div>

        <div class="flex justify-center m-1">
            {{-- Youtube --}}
            @if ($job->link)
            <iframe id="player" type="text/html" width="800" height="600"
                src="http://www.youtube.com/embed/{{$job->link}}" frameborder="0"></iframe>
            @endif
        </div>
        
        <div class="flex justify-center m-1">
            <iframe id="viewer" height="600" width="800" src="http://docs.google.com/gview?url={{$file}}&time=300000&embedded=true"
                frameborder="0"></iframe>
        </div>

        <div class="w-6/12 ">
            <h1 class="font-semibold px-5">Comments</h1>
            <div class="relative w-1/2 m-8">
                <div class="border-r-2 border-gray-500 absolute h-full top-0" style="left: 15px">
                </div>
                <ul class="list-none m-0 p-0">

                    @foreach ($job->comments as $item)
                    <li class="mb-2">
                        <div class="flex items-center mb-1">
                            <div class="bg-gray-500 rounded-full h-8 w-8"></div>
                            <div class="flex-1 ml-4  font-semibold">{{$item->user->name}}: </div>
                        </div>
                        <div class="ml-12">
                            {{$item->comment}}
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>

        </div>

        <div>
            <form action="{{route('JobComment.store')}}" method="POST">
                @csrf
                <input type="text" name="job" value="{{$job->id}}" hidden>
                <div
                    class="w-8/12 mx-5 border border-gray-600 bg-white h-8 rounded-full px-5 py-1 content-center flex items-center">
                    <input name="comment" type="text" class="bg-transparent focus:outline-none w-full  text-sm   "  value="{{ old('comment') }}">
                    <button type="submit" class="text-teal-600 font-semibold">Comment</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@push('js')
    <script>
        let ancho = screen.width;
        if (ancho <= 640) {
            let marco = document.getElementById('viewer');
            marco.setAttribute('height',200);
            marco.setAttribute('width',270);

            let marco2 = document.getElementById('player');
            marco2.setAttribute('height',200);
            marco2.setAttribute('width',270);
        }
    </script>
@endpush