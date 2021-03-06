@extends('layouts.dashboard')

@section('content')

<div class="container font-montserrat text-sm ">
    <div class="card  rounded-sm bg-gray-100 mx-auto md:mt-10 shadow-lg">
        <div
            class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between ">
            <h1 class="text-teal-600 font-semibold">{{$job->subject->name}}</h1>
        </div>
        <div class="card-body py-5">
            <form method="POST" action="/teachers/{{$job->id}}" enctype="multipart/form-data" class="mx-auto">
                @csrf
                @method('PUT')

                {{-- <input hidden type="text" name="subject" id="" value="{{$job->subject->id}}"> --}}

                <div class="flex flex-wrap my-5">
                    <div class="w-full md:w-1/2 px-3">
                        <div class="mb-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name">
                                Title
                            </label>
                            <input type="text" id="title" name="title" value="{{$job->title}}"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" type="text" placeholder="Title">
                        </div>
                        <div class="flex-wrap items-center mb-2">
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Start
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 hover:text-teal-500"
                                    type="date" name="start" value="{{$job->start->format('Y-m-d')}}">
                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="flex-wrap items-center">
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    End
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 hover:text-teal-500"
                                    type="date" name="end" value="{{$job->end->format('Y-m-d')}}">
                                <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex flex-wrap my-5">
                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    File
                                </label>

                                <div class="relative">
                                    <div class="overflow-hidden relative w-64 mt-4 mb-4">
                                        <div class="flex items-center justify-center bg-grey-lighter">
                                            <label
                                                class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:text-teal-500">
                                                <svg class="w-8 h-8" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path
                                                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                                </svg>
                                                <span class="mt-2 text-base leading-normal" id="selected">Select a
                                                    file</span>
                                                <input type='file' value="{{$job->file_path}}" class="hidden" name="file" id="fileName" onchange="setName()"/>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-last-name">
                            Description
                        </label>
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" placeholder="description">{{$job->description}}</textarea>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name">
                                Link Youtube
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 mb-2"
                                placeholder="link" type="text" name="link" id="link" value="{{$job->link}}">
                        </div>

                        <div class="flex justify-center px-3">
                            <button type="submit"
                                class="w-8/12 mb-5 font-semibold md:w-5/12 py-2 flex mx-auto  justify-center bg-teal-600 text-gray-200 hover:bg-teal-400">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            @if ($job->file_path)
            <div class="flex justify-center">
                <iframe id="viewer" height="600" width="800"
                    frameborder="0"></iframe>
            </div>
            @endif
            <div class="flex justify-center m-1">
                {{-- Youtube --}}
                @if ($job->link)
                <iframe id="player" type="text/html" width="800" height="600"
                    src="http://www.youtube.com/embed/{{$vid}}" frameborder="0"></iframe>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    let aux = @json($file);

    let tipos = ['png', 'jpg'];

    let aux1 = 0;

    tipos.forEach(element => {
        if (aux.search(element) > 0) {
            aux1 = aux.search(element);
        }
    });

    if (aux1 == 0) {
        document.getElementById('viewer').setAttribute('src', 'http://docs.google.com/gview?url='+aux+'&time=300000&embedded=true');
    } else {
        document.getElementById('viewer').setAttribute('src', aux );
    }

    let ancho = screen.width;
    if (ancho <= 640) {
        let marco = document.getElementById('viewer');
        marco.setAttribute('height',200);
        marco.setAttribute('width',270);

        let marco2 = document.getElementById('player');
            marco2.setAttribute('height',200);
            marco2.setAttribute('width',270);
    }

    function setName(){
        let fileName = document.getElementById('fileName');
        var cad = fileName.value;
        cad = cad.split('\\');
        let selected = document.getElementById('selected');
        selected.innerHTML = cad[2];
        fileDocument = document.getElementById("fileName").files[0];
        fileDocument_url = URL.createObjectURL(fileDocument);
        document.getElementById('viewer').setAttribute('src', fileDocument_url);
    }
</script>
@endpush