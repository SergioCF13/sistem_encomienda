@extends('adminlte::page')

@section('title', 'Editar Chofer')

@section('content_header')
    <h1 class="text-primary fw-bold"><i class="fas fa-user-edit"></i> Editar Chofer</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <form action="{{ route('choferes.update', $choferes->id_choferes) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $choferes->nombre) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">CI</label>
                            <input type="text" name="ci" class="form-control" value="{{ old('ci', $choferes->ci) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Licencia</label>
                            <input type="text" name="licencia" class="form-control" value="{{ old('licencia', $choferes->licencia) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $choferes->telefono) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="Activo" {{ $choferes->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $choferes->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('choferes.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
