@extends('layouts.dashboard')

@section('content')

<div class="bg-indigo-900 text-center py-4 lg:px-4">
    @foreach ($noLeidas as $item)
    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
        role="alert">
        <span class="font-semibold mr-2 text-left flex-auto">{{$item->data['message']}}</span>
        <a class="rounded text-white font-bold bg-teal-500 p-1" href="{{url('showJob',$item->data['action'])}}">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </a>
    </div>
    @endforeach
    <a href="{{route('notifications')}}" class="bg-teal-600 text-white text-sm p-2 shadow-lg hover:text-gray-700">Ver más</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2">
    @if(count($jobs)>0)
    @foreach ($jobs ??[] as $job)
    <div
        class="mx-2 text-white card bg-gradient-green rounded-sm font-montserrat w-auto flex p-5 justify-between mt-5 items-center">
        <div>
            <a href="{{route('adviser.showJob',$job->id)}}">
                <svg aria-hidden="true" data-prefix="fas" data-icon="clipboard-list"
                    class="h-12 w-12 svg-inline--fa fa-clipboard-list fa-w-12" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512">
                    <path fill="currentColor"
                        d="M336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM96 424c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm0-96c-13.3 0-24-10.7-24-24s10.7-24 24-24 24 10.7 24 24-10.7 24-24 24zm96-192c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm128 368c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16zm0-96c0 4.4-3.6 8-8 8H168c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8v16z" />
                </svg>
            </a>
        </div>
        <div>
            <h1 class="text-sm">{{$job->title}}</h1>
        </div>
    </div>
    @endforeach
    @else
    <div>
        <h1>No posee tares por revisar</h1>
    </div>
    @endif
</div>

@endsection