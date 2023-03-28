@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>CREAR REGISTROS</h1>
@stop

@section('content')
    
<form action="/productos" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Código</label>
        <input id="codigo" name="codigo" type="text" class="form-control" , tabindex="1">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" , tabindex="2">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Descripción</label>
        <input id="descripcion" name="descripcion" type="text" class="form-control" , tabindex="2">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Precio</label>
        <input id="precio" name="precio" type="number" step="any" value="0.00" class="form-control" , tabindex="4">
    </div>

    @if($errors->any())
    <x-adminlte-callout theme="danger" title-class="text-danger text-uppercase"
        icon="fas fa-lg fa-exclamation-circle" title="Error al guardar">
        <i>Ha ocurrido un error al guardar el plato!</i>
    </x-adminlte-callout>
    {{-- <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
    </div> --}}
    @endif

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