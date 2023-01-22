@extends('layouts.layoutMain')
@section('contenido')
    <div>
        @if(Auth::check())
            <a href="{{ route('ganga.create') }}" class="m-2 text-white text-decoration-none">Crear una nueva ganga</a>
            <a href="{{ route('user.show',Auth::user()->id ) }}" class="m-2 text-white text-decoration-none">Acceder a {{ Auth::user()->name }}</a>
        @endif
    </div>
    <h1>Listado de Gangas</h1>
    <div class="container justify-content-center">
        <div class="card-deck row justify-content-center">
            @foreach ($gangas as $ganga)
            <div class="card m-3 col-sm-3 justify-content-center">
                <img src="/storage/{{$ganga->img}}" alt="{{$ganga->title}}"  class="card-img-top">
                <h4 class="card-title text-center">{{ $ganga->title }}</h4>
                <p class="card-text text-center">Por {{ $ganga->description }}</p>
                <p class="card-text text-center">Me Gustas: {{ $ganga->likes }}</p>
                <p class="card-text text-center">Me Gustas: {{ $ganga->unlikes }}</p>
                <a class="btn btn-primary text-center mb-3" href="/ganga/show/{{ $ganga->id }}">Ver más</a>
                @if (Auth::check())
                    <form action="#" method="POST" class="justify-content-center">
                        @csrf
                        <button type="submit" class="btn btn-primary text-center">Me Gusta</button>
                    </form>

                    <form action="#" method="POST" class="justify-content-center">
                        @csrf
                        <button type="submit" class="btn btn-danger text-center justify-content-center">No me Gusta</button>
                    </form>

                    @if (Auth::user()->id === $ganga->user_id)
                        <a class="btn btn-success text-center" href="{{ route('ganga.edit', $ganga->id) }}">Editar</a>
                    @endif
                @endif
            </div>
            @endforeach
        </div>
    </div>
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

