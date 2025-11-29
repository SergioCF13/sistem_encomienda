@extends('adminlte::page')

@section('title', 'Sucursales')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="fw-bold text-primary mb-0"><i class="fas fa-building"></i> Sucursales</h1>
    <a href="{{ route('sucursales.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> Nueva Sucursal
    </a>
</div>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table id="sucursales-table" class="table table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th width="120">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sucursales as $sucursal)
                        <tr>
                            <td>{{ $sucursal->id_sucursal }}</td>
                            <td class="text-start">{{ $sucursal->nombre }}</td>
                            <td>{{ $sucursal->ciudad }}</td>
                            <td class="text-start">{{ $sucursal->direccion }}</td>
                            <td>
                                <span class="badge {{ $sucursal->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $sucursal->estado }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('sucursales.edit', $sucursal->id_sucursal) }}" 
                                   class="btn btn-sm btn-outline-warning me-1" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('sucursales.destroy', $sucursal->id_sucursal) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('¿Desea desactivar esta sucursal?')" 
                                            title="Desactivar">
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
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function () {
    $('#sucursales-table').DataTable({
        responsive: true,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
        columnDefs: [{ orderable: false, targets: [5] }]  // Columna de Acciones no ordenable
    });
});
</script>
@stop
