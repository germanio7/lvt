@extends('layouts.dashboard')

@section('content')
<div class="container font-montserrat text-sm ">
    <div class="card  rounded-sm bg-gray-100 mx-auto md:mt-10 shadow-lg">
        <div
            class="card-title bg-white w-full p-1 md:p-5  border-b flex items-center justify-between md:justify-between ">
            <h1 class="text-teal-600 font-semibold">{{$delivery->job->subject->name}}>{{$delivery->job->title}}</h1>
        </div>
        <div class="card-body py-5">
            <div class="w-6/12 p-5">
                <label class="font-semibold" for="">Description:</label>
                <span>{{$delivery->job->description}}</span>
            </div>
            <div class="w-6/12 p-5">
                <label class="font-semibold" for="">Job</label>
                <a href="">{{$delivery->job->file_path}}</a>
            </div>
            <div class="w-6/12 p-5">
                <label class="font-semibold" for="">Delivery</label>
                <a href="">{{$delivery->file_path}}</a>
            </div>

            <div class="w-full p-5">
                <iframe height="400" width="600" src="{{asset('entregas/'. $delivery->file_path)}}"
                    frameborder="0"></iframe>
            </div>

            <div class="card-body py-5">
                <form method="POST" action="{{route('update.deliver', $delivery->id)}}" class="mx-auto" id="delivery"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Update Deliver
                        </label>
                        <div class="relative">
                            <div class="overflow-hidden relative w-64 mt-4 mb-4">
                                <div class="flex items-center justify-center bg-grey-lighter">
                                    <label
                                        class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-teal-600 hover:text-white">
                                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                        </svg>
                                        <span class="mt-2 text-base leading-normal" id="selected">Select a file</span>
                                        <input type='file' class="hidden" name="file" id="fileName"
                                            onchange="setName()" />
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-8/12 mb-5 font-semibold md:w-5/12 py-2 flex mx-auto  justify-center bg-teal-600 text-gray-200 ">Update</button>
                </form>

                <div class="w-6/12 ">
                    <h1 class="font-semibold px-5">Comments</h1>
                    <div class="relative w-1/2 m-8">
                        <div class="border-r-2 border-gray-500 absolute h-full top-0" style="left: 15px">
                        </div>
                        <ul class="list-none m-0 p-0">

                            @foreach ($delivery->comments as $item)
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
                    <form action="{{route('comment.store')}}" method="POST">
                        @csrf
                        <input type="text" name="delivery" value="{{$delivery->id}}" hidden>
                        <div
                            class="w-8/12 mx-5 border border-gray-600 bg-white h-8 rounded-full px-5 py-1 content-center flex items-center">
                            <input name="comment" type="text"
                                class="bg-transparent focus:outline-none w-full  text-sm   ">
                            <button type="submit" class="text-teal-600 font-semibold">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @endsection

        @push('js')
        <script>
            function setName(){
             let fileName = document.getElementById('fileName');
             var cad = fileName.value;
             cad = cad.split('\\');
             let selected = document.getElementById('selected');
             selected.innerHTML = cad[2];
            fileDocument = document.getElementById("fileName").files[0];
            fileDocument_url = URL.createObjectURL(fileDocument);
            document.getElementById('viewer').setAttribute('src', fileDocument_url);
            toggleModal();
        }
        </script>
        @endpush