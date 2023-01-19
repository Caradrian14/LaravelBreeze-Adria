@extends('layouts.layoutMain')
@section('contenido')
    <h1>Perfil de {{ Auth::user()->name }}</h1>

    @if (count($gangas)>0)
    <p>Gangas creadas por el usuario: </p>
    @foreach ($gangas as $ganga)
        <h2>{{ $ganga->title }}</h2>
        <p>Por {{ $ganga->description }}</p>
        <a href="{{ route('ganga.show', $ganga->id) }}">Ver más</a>
    @endforeach
    @else
        <p>No tienes ninguna ganga creada</p>
    @endif
@endsection
