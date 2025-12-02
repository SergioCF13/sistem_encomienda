@extends('adminlte::page')

@section('title', 'Autos')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-car"></i> Autos</h1>
@stop

@section('content')

<a href="{{ route('autos.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Nuevo Auto
</a>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table id="autos-table" class="table table-striped table-sm">
            <thead class="bg-light">
                <tr>
                    <th>ID</th>
                    <th>Numero de Movil</th>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autos as $auto)
                <tr>
                    <td>{{ $auto->numero_movil }}</td>
                    <td>{{ $auto->id_auto }}</td>
                    <td>{{ $auto->placa }}</td>
                    <td>{{ $auto->marca }}</td>
                    <td>{{ $auto->modelo }}</td>
                    <td>
                        <span class="badge 
                            @if($auto->estado == 'Disponible') bg-success
                            @elseif($auto->estado == 'En ruta') bg-warning
                            @else bg-danger @endif">
                            {{ $auto->estado }}
                        </span>
                    </td>



                    
                    <td>
                        <a href="{{ route('autos.edit', $auto) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        
                                <!-- Mostrar el botón de eliminar solo si el usuario tiene el rol de Admin -->
                                @if(Auth::user()->hasRole('Admin'))
                                    <form action="{{ route('autos.destroy', $auto->id_auto) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('¿Desea eliminar este auto?')" 
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                        
<!--                         <form action="{{ route('autos.destroy', $auto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar auto?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form> -->
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
$('#autos-table').DataTable({
    responsive: true,
    pageLength: 10,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
    },
    columnDefs: [
        { orderable: false, targets: [6] }
    ]
});
</script>
@stop
