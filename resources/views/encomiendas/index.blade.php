@extends('adminlte::page')

@section('title', 'Encomiendas')

@section('content_header')
    <h1>Encomiendas</h1>
@stop

@section('content')

<form method="GET" action="{{ route('encomiendas.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por código de barras" value="{{ $buscar }}">
        <button class="btn btn-primary">Buscar</button>
    </div>
</form>

<a href="{{ route('encomiendas.create') }}" class="btn btn-success mb-3">Nueva Encomienda</a>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table id="encomiendas-table" class="table table-striped table-sm table-bordered">
            <thead class="bg-light">
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($encomiendas as $e)
                <tr>
                    <td>{{ $e->codigo_barra }}</td>
                    <td>{{ $e->descripcion }}</td>
                    <td>{{ $e->peso }} kg</td>
                    <td>{{ $e->cliente->nombre }}</td>
                    <td>{{ $e->estado }}</td>
                    <td>
                        <a href="{{ route('encomiendas.show', $e->id_encomienda) }}" class="btn btn-info btn-sm" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('encomiendas.edit', $e->id_encomienda) }}" class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('encomiendas.print', $e->id_encomienda) }}" class="btn btn-outline-primary btn-sm" target="_blank" title="Imprimir Ticket">
                            <i class="fas fa-print"></i>
                        </a>
                        <form action="{{ route('encomiendas.destroy', $e->id_encomienda) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar encomienda?')" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#encomiendas-table').DataTable({
        responsive: true,
        pageLength: 10,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        },
        columnDefs: [
            { orderable: false, targets: [5] }
        ]
    });
});
</script>
@stop
