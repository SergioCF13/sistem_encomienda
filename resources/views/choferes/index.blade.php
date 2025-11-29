@extends('adminlte::page')

@section('title', 'Choferes')

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
            <table id="choferes-table" class="table table-hover table-striped align-middle text-center">
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
                    @foreach($chofer as $chofer)
                    <tr>
                        <td>{{ $chofer->id_chofer }}</td>
                        <td class="text-start">{{ $chofer->nombre }}</td>
                        <td>{{ $chofer->ci }}</td>
                        <td class="text-start">{{ $chofer->licencia }}</td>
                        <td>{{ $chofer->telefono }}</td>
                        <td>
                            <span class="badge 
                                @if($chofer->estado == 'Activo') bg-success
                                @elseif($chofer->estado == 'En ruta') bg-warning
                                @else bg-danger @endif">
                                {{ $chofer->estado }}
                            </span>
                        </td>
                            <td>
                                <a href="{{ route('choferes.edit', $chofer->id_chofer) }}" 
                                   class="btn btn-sm btn-outline-warning me-1" 
                                   title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('choferes.destroy', $chofer->id_chofer) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')  <!-- Esto es importante para enviar el método DELETE -->
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Desea eliminar este chofer?')" title="Eliminar">
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
