@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Menú del restaurante</h1>
@stop

@section('content')
    
<a class="btn btn-success mb-4" href="productos/create">CREAR</a>

<table id="productos" class="table table-striped caption-top">
    <caption>Lista de platos</caption>
    <thead class="bg-secondary text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Precio</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{$producto->id}}</td>
            <td>{{$producto->codigo}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->descripcion}}</td>
            <td>${{$producto->precio}}</td>
            <td>
                <form action="{{route ('productos.destroy', $producto->id)}}" method="POST">
                    <a href="productos/{{$producto->id}}/edit" class="btn btn-primary">Editar</a>
                    @csrf
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

@stop

@section('js')
    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#productos').DataTable({
           "lengthMenu": [[5,10,50,-1], [5,10,50,"All"]] 
    });
    });
</script>
@stop