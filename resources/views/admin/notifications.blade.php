@extends('layouts.dashboard')

@section('content')
<div class="grid grid-cols-1 bg-indigo-900 text-center py-4 lg:px-4">
    @php
    $rol = auth()->user()->roles()->first()->name;
    @endphp
    @foreach ($todas as $item)
    @switch($rol)
    @case('adviser')
    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex m-1"
        role="alert">
        <span class="font-semibold mr-2 text-left flex-auto">{{$item->data['message']}}</span>
        <a class="rounded text-white font-bold bg-teal-500 p-1" href="{{url('showJob',$item->data['action'])}}">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </a>
    </div>
    @break

    @case('teacher')
    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
        role="alert">
        <span class="font-semibold mr-2 text-left flex-auto">{{$item->data['message']}}</span>
        @if ($item->data['tipo'] == 'Tarea')
        <a class="rounded text-white font-bold bg-teal-500 p-1" href="{{url('teacher/showJob',$item->data['action'])}}">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </a>
        @else
        <a class="rounded text-white font-bold bg-teal-500 p-1" href="{{url('entrega',$item->data['action'])}}">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </a>
        @endif
    </div>
    @break

    @case('student')
    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
        role="alert">
        <span class="font-semibold mr-2 text-left flex-auto">{{$item->data['message']}}</span>
        @if ($item->data['tipo'] == 'Tarea')
        <a class="rounded text-white font-bold bg-teal-500 p-1" href="{{url('penddings')}}">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </a>
        @else
        <a class="rounded text-white font-bold bg-teal-500 p-1" href="{{url('delivery',$item->data['action'])}}">
            <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
            </svg>
        </a>
        @endif
    </div>
    @break

    @endswitch
    @endforeach
</div>
@endsection