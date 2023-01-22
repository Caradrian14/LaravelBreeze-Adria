@extends('layouts.layoutMain')
@section('contenido')
    <div class="card mb-4 container">
    <img src="/storage/{{$ganga->img}}" alt="{{$ganga->title}}" class="card-img-top">
        <div class="card-body">
        <h4>Detalle de la Ganga</h4>
    <h4 class="card-title">Titulo: {{ $ganga->title }}</h4>
    <p class="card-text">Descripcion: {{ $ganga->description }}</p>
    <p class="card-text">Enlace: {{ $ganga->url }}</p>
    <p class="card-text">Me gustas recibidos: {{ $ganga->likes }}</p>
    <p class="card-text">No me gustas recibidos: {{ $ganga->unlikes }}</p>
    <p class="card-text">Precio: {{ $ganga->price }}</p>
    <p class="card-text">Precio en rebaja: {{ $ganga->price_sale }}</p>
    <p class="card-text">Disponible: {{ $ganga->available }}</p>
    <p class="card-text">Categoria a la que pertenece: {{ $ganga->category }}</p>
    @if(Auth::check())
        <button class="btn btn-primary m-2" onclick="location.href='{{ route('ganga.edit', $ganga->id) }}'" type="button">
            Editar</button>

        <form action="{{ route('ganga.destroy', $ganga->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button  type="submit" class="btn btn-danger m-2">Eliminar</button>
        </form>
    @endif
    <a class="btn btn-secundary" href="{{  url('ganga')}}">Volver al Listado de Gangas</a>
@endsection
