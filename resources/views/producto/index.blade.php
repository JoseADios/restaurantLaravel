@extends('layouts.base')

@section('contenido')
    <h1>Vista Index</h1>
    
    <a class="btn btn-success" href="productos/create">Crear</a>
    
    <table class="table table-dark caption-top">
        <caption>Lista de platos</caption>
        <thead class="table-bg-scale">
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
                    <td>{{$producto->precio}}</td>
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
@endsection