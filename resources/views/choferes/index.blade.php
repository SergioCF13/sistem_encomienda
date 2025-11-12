@extends('adminlte::page')

@section('title', 'choferes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold text-primary mb-0">
            <i class="fas fa-users me-2"></i> Choferes
        </h1>
        <a href="{{ route('choferes.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-user-plus"></i> Nuevo Chofer
        </a>
    </div>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table id="clientes-table" class="table table-hover table-striped align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>CI</th>
                        <th>N° Licencia</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th width="120">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($choferes as $choferes)
                        <tr>
                            <td>{{ $choferes->id_choferes }}</td>
                            <td class="text-start">{{ $choferes->nombre }}</td>
                            <td>{{ $choferes->ci }}</td>
                            <td class="text-start">{{ $choferes->licencia }}</td>
                            <td>{{ $choferes->telefono }}</td>
                            <td>
                                @if($choferes->estado === 'Activo')
                                    <span class="badge bg-success px-3 py-2">Activo</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('choferes.edit', $choferes->id_choferes) }}" 
                                   class="btn btn-sm btn-outline-warning me-1" 
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('choferes.destroy', $choferes->id_choferes) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                            onclick="return confirm('¿Desea eliminar este Chofer?')" 
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle"></i> No hay Choferes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    table.dataTable thead th {
        background-color: #f4f6f9;
        color: #333;
        font-weight: 600;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 5px 10px;
    }
</style>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function () {
        $('#clientes-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            columnDefs: [
                { orderable: false, targets: [6] }
            ]
        });
    });
</script>
@stop
