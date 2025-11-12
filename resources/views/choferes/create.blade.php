@extends('adminlte::page')

@section('title', 'Registrar Chofer')

@section('content_header')
    <h1 class="text-primary fw-bold"><i class="fas fa-user-plus"></i> Registrar Chofer</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <form action="{{ route('choferes.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                                   placeholder="Ingrese nombre completo" value="{{ old('nombre') }}">
                            @error('nombre') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">CI</label>
                            <input type="text" name="ci" class="form-control" placeholder="Ingrese CI" value="{{ old('ci') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Licencia</label>
                            <input type="text" name="licencia" class="form-control" placeholder="Ingrese N° Licencia" value="{{ old('licencia') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="Ej: 70012345" value="{{ old('telefono') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="Activo" selected>Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('choferes.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Chofer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
