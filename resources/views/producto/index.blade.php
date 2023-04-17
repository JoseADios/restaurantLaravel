@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
<h1>Menú del restaurante</h1>
@stop

@section('content')

<a class="btn btn-success mb-4" href="productos/create">CREAR</a>

<table id="productos" class="table table-striped caption-top">
    <caption>Lista de platos</caption>
    <thead class="bg-secondary text-white">
        <tr>
            <th style="display: none" scope="col">ID</th>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Imagen</th>
            <th scope="col">Precio</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td id="idProd" style="display: none">{{$producto->id}}</td>
            <td>{{$producto->codigo}}</td>
            <td>{{$producto->nombre}}</td>
            </td>
            <td class="d-flex justify-content-center"><img style="border-radius: 5px; max-height: 40px"
                    src="/imagen/{{$producto->imagen}}"></td>
            <td>${{$producto->precio}}</td>
            <td>
                <div class="d-flex">
                    <button id="btn-ver"
                        onclick="mostrarProd('{{$producto->id}}', '{{$producto->codigo}}', '{{$producto->nombre}}', '{{$producto->imagen}}', '{{$producto->descripcion}}', '{{$producto->precio}}')"
                        class="mr-1 btn btn-success" tabindex="4">Ver</button>
                    <form class="formEliminar" action="{{route ('productos.destroy', $producto->id)}}" method="POST">
                        <a href="productos/{{$producto->id}}/edit" class="btn btn-primary">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: #dc3545" class="btn btn-danger">Borrar</button>
                    </form>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#productos').DataTable({
           "lengthMenu": [[4,10,50,-1], [5,10,50,"All"]] 
    });
    });
</script>

{{-- Mostrar detalles del producto --}}
<script>
    function mostrarProd(id, cod, nombre, src, descripcion, precio) {
        Swal.fire({
            title: nombre,
            text: descripcion,
            imageUrl: 'imagen/'+src,
            imageWidth: 'auto',
            imageHeight: 300,
            imageAlt: 'Custom image',
            footer: '$'+precio,
        })
}
</script>

<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.formEliminar')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function (form){
            form.addEventListener('submit', function (event) {
                event.preventDefault()
                event.stopPropagation()
            
                Swal.fire({
                    title: 'Estás seguro de eliminar este registro?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                        Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success')
                    }
                })

            }, false)
        })
    })()
</script>


@stop