@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDITAR REGISTROS</h1>
@stop

@section('content')

<form action="/productos/{{$producto->id}}" method="POST" enctype="multipart/form-data">
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
    

    <!-- Para ver la imagen seleccionada, de Lo contrario no se -->
    <div class="d-flex justify-content-center grid grid-cols-2 mt-1 mx-7">
        <img src="/imagen/{{$producto->imagen}}" id='imagenSeleccionada' alt="Plato" style="max-height: 200px;">
    </div>

    <div class="grid grid-cols-1 mt-1 mx-7">
        <label for="imagen" class="form-label">Subir Imagen</label>
        <div class='flex items-center justify-center w-full'>
            <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                <div class='flex flex-col items-center justify-center pt-7'>
                    <svg class="w-10 h-10 text-purple group-hover:text-purple-600" fill='currentColor'  viewBox="0 0 16 16">
                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/>
                      </svg>
                    <p class='ext-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider '>Seleccione la imagen</p>
                </div>
                <input accept="image/*" name="imagen" id="imagen" type='file' class="hidden" />
            </label>
        </div>
    </div>


    <div class="mb-3">
        <label for="" class="form-label">Precio</label>
        <input autocomplete="off" id="precio" name="precio" type="number" step="any" class="form-control" value="{{$producto->precio}}" , tabindex="4">
    </div>

    @if($errors->any())
    <x-adminlte-callout theme="danger" title-class="text-danger text-uppercase"
        icon="fas fa-lg fa-exclamation-circle" title="Error al actualizar">
        <i>Ha ocurrido un error al actualizar los datos!</i>
        <p><i>{{$errors}}</i></p>
    </x-adminlte-callout>
    {{-- <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
    </div> --}}
    @endif

    <a href="/productos" class="mb-3 btn btn-secondary" tabindex="5">Cancelar</a>
    <button type="submit" class="mb-3 ml-5 btn btn-primary" tabindex="4">Guardar</button>

</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- <<-- Script para ver La imagen antes de CREAR UN NUEVO PRODUCTO --> --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function (e) {
        $('#imagen').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

    });

</script>
@stop