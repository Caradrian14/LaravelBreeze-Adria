@extends('layouts.layoutMain')
@section('contenido')
    <div>
        @if(Auth::check())
            <a href="{{ route('ganga.create') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Crear una nueva ganga</a>
            <a href="{{ route('user.show',Auth::user()->id ) }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Acceder a {{ Auth::user()->name }}</a>
        @endif
    </div>
    <h1>Listado de Gangas</h1>
@foreach ($gangas as $ganga)
    <h2>{{ $ganga->title }}</h2>
    <p>Por {{ $ganga->description }}</p>
    <a href="{{ route('ganga.show', $ganga->id) }}">Ver más</a>
    @if (Auth::user()->id === $ganga->user_id)

    <a href="{{ route('ganga.edit', $ganga->id) }}">Editar</a>
    @endif
@endforeach
@endsection

