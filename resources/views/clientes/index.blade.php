@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="fw-bold text-primary mb-0">
            <i class="fas fa-users me-2"></i> Clientes
        </h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-user-plus"></i> Nuevo Cliente
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
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th width="120">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id_cliente }}</td>
                            <td class="text-start">{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->ci }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td class="text-start">{{ $cliente->direccion }}</td>
                            <td>
                                @if($cliente->estado === 'Activo')
                                    <span class="badge bg-success px-3 py-2">Activo</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">Inactivo</span>
                                @endif
                            </td>
                            
                            <td>
                                <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" 
                                   class="btn btn-sm btn-outline-warning me-1" 
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Mostrar el botón de eliminar solo si el usuario tiene el rol de Admin -->
                                @if(Auth::user()->hasRole('Admin'))
                                    <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('¿Desea eliminar este cliente?')" 
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
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
    $(document).ready(function() {
        $('#clientes-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            columnDefs: [
                { orderable: false, targets: [6] }  // No ordenable en la columna de Acciones
            ]
        });
    });
</script>
@stop
