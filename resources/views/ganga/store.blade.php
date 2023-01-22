@extends('layouts.layoutMain')
@section('contenido')
    <div class="container justify-content-center">
    <h2 class="text-center mb-4">Nueva Ganga</h2>
    @if(Auth::check())
        <form action="{{ route('ganga.store') }}" method='POST' enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? ''}}">
                @if ($errors->has('title'))
                    <div class="text-danger">
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Descripcion</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ old('description') ?? ''}}"></input>
                @if ($errors->has('description'))
                    <div class="text-danger">
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="url">URL de la Ganga</label>
                <input type="text" name="url" id="url" class="form-control" value="{{ old('url') ?? ''}}">
                @if ($errors->has('url'))
                    <div class="text-danger">
                        {{ $errors->first('url') }}
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label for="price">Precio Original de la Ganga</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') ?? ''}}" min="0">
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="price_sale">Precio Rebajado de la Ganga</label>
                <input type="number" name="price_sale" id="price_sale" class="form-control" value="{{ old('price_sale') ?? ''}}" min="0">
                @if ($errors->has('price_sale'))
                    <div class="text-danger">
                        {{ $errors->first('price_sale') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="category">Selecciona la Ctegoria a la vista</label>
                <select type="number" name="category" id="category" class="form-category">
                    @foreach ($categorys as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <div class="text-danger">
                        {{ $errors->first('category') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="img">Imagen</label>
                <input type="file" name="img" id="img_ganga" class="form-control" value="{{ old('img') ?? ''}}" accept="image/*">
                @if ($errors->has('img'))
                    <div class="text-danger">
                        {{ $errors->first('img') }}
                    </div>
                @endif
            </div>

            <input type="hidden" name="user_id" id="user_id" class="user_id" value="{{ Auth::user()->id ?? ''}}" min="0">

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">Añadir Ganga</button>
            </div>
        </form>
    @endif
    </div>
@endsection
