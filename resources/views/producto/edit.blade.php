@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDITAR REGISTROS</h1>
@stop

@section('content')
    
<form action="/productos/{{$producto->id}}" method="POST">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="" class="form-label">Código</label>
        <input autocomplete="off" maxlength="10" id="codigo" name="codigo" type="text" class="form-control" value="{{$producto->codigo}}" , tabindex="1">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input autocomplete="off" maxlength="50" id="nombre" name="nombre" type="text" class="form-control" value="{{$producto->nombre}}" , tabindex="2">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Descripción</label>
        <input autocomplete="off" maxlength="200" id="descripcion" name="descripcion" type="text" class="form-control" value="{{$producto->descripcion}}" , tabindex="2">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Precio</label>
        <input autocomplete="off" id="precio" name="precio" type="number" step="any" class="form-control" value="{{$producto->precio}}" , tabindex="4">
    </div>

    <a href="/productos" class="btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>

</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop