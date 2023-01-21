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
    <img src="/storage/{{$ganga->img}}" alt="{{$ganga->title}}" width="200" height="200">
    <h2>{{ $ganga->title }}</h2>
    <p>Por {{ $ganga->description }}</p>
    <h4>Me Gustas: </h4>
    <a href="/ganga/show/{{ $ganga->id }}">Ver más</a>
    @if (Auth::check());

        <form action="{{ route('ganga.store')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Me Gusta</button>
        </form>

        <form action="{{ route('ganga.store')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">No me Gusta</button>
        </form>

        @if (Auth::user()->id === $ganga->user_id)
            <a href="{{ route('ganga.edit', $ganga->id) }}">Editar</a>
        @endif
   @endif
   @endforeach
    <div class="paginator justify-content-center my-3">
        @if(!$gangas->onFirstPage())
            <a href="{{ $gangas->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <span class="current-page mx-5">Pagina {{$gangas->currentPage()}} de {{$gangas->lastPage()}}</span>

        @if($gangas->hasMorePages())
            <a href="{{ $gangas->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif
    </div>
       @endsection

