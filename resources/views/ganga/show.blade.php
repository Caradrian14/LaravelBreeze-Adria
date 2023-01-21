@extends('layouts.layoutMain')
@section('contenido')
    <img src="/storage/{{$ganga->img}}" alt="{{$ganga->title}}" width="200" height="200">
    <h1>Detalle de la Ganga</h1>
    <h2>Titulo: {{ $ganga->title }}</h2>
    <p>Descripcion: {{ $ganga->description }}</p>
    <p>Enlace: {{ $ganga->url }}</p>
    <p>Me gustas recibidos: {{ $ganga->likes }}</p>
    <p>No me gustas recibidos: {{ $ganga->unlikes }}</p>
    <p>Precio: {{ $ganga->price }}</p>
    <p>Precio en rebaja: {{ $ganga->price_sale }}</p>
    <p>Disponible: {{ $ganga->available }}</p>
    <p>Categoria a la que pertenece: {{ $ganga->category }}</p>
    @if(Auth::check())
        <button onclick="location.href='{{ route('ganga.edit', $ganga->id) }}'" type="button">
            Editar</button>

        <form action="{{ route('ganga.destroy', $ganga->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    @endif
    <a href="{{  url('ganga')}}">Volver al Listado de Gangas</a>
@endsection
