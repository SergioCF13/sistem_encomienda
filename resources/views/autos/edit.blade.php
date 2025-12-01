@extends('adminlte::page')

@section('title', 'Editar Auto')

@section('content_header')
    <h1 class="text-primary"><i class="fas fa-car"></i> Editar Auto</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm rounded">
            <div class="card-body">

                <form action="{{ route('autos.update', $auto) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-bold">Numero de Movil (Kg) *</label>
                        <input type="number" step="0.01" name="capacidad" class="form-control" value="{{ $auto->numero_movil }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Placa *</label>
                        <input type="text" name="placa" class="form-control" value="{{ $auto->placa }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Marca *</label>
                        <input type="text" name="marca" class="form-control" value="{{ $auto->marca }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Modelo *</label>
                        <input type="text" name="modelo" class="form-control" value="{{ $auto->modelo }}" required>
                    </div>



                    <div class="mb-3">
                        <label class="fw-bold">Estado</label>
                        <select name="estado" class="form-select">
                            <option {{ $auto->estado == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                            <option {{ $auto->estado == 'En ruta' ? 'selected' : '' }}>En ruta</option>
                            <option {{ $auto->estado == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('autos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>

                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@stop
