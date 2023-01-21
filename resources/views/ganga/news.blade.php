@extends('layouts.layoutMain')
@section('contenido')
    <div>
        @if(Auth::check())
            <a href="{{ route('ganga.create') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Crear una nueva ganga</a>
            <a href="{{ route('user.show',Auth::user()->id ) }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Acceder a {{ Auth::user()->name }}</a>
        @endif
    </div>
    <h1>Nuevas Gangas</h1>
    @foreach ($gangas as $ganga)
        <h2>{{ $ganga->title }}</h2>
        <p>Por {{ $ganga->description }}</p>
        <h4>Me Gustas: </h4>
        <a href="{{ route('ganga.show', $ganga->id) }}">Ver más</a>
        @if (Auth::check());

        <form action="{{ action('GangaController@thumbUp', $ganga->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Me Gusta</button>
        </form>

        <form action="{{ action('GangaController@thumbDown', $ganga->id)}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">No me Gusta</button>
        </form>

        @if (Auth::user()->id === $ganga->user_id)
            <a href="{{ route('ganga.edit', $ganga->id) }}">Editar</a>
        @endif
        @endif
    @endforeach
@endsection

