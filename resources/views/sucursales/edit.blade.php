@extends('adminlte::page')

@section('title', 'Editar Sucursal')

@section('content_header')
<h1 class="text-primary fw-bold"><i class="fas fa-edit"></i> Editar Sucursal</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('sucursales.update', $sucursal->id_sucursal) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $sucursal->nombre) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ciudad <span class="text-danger">*</span></label>
                        <input type="text" name="ciudad" class="form-control" value="{{ old('ciudad', $sucursal->ciudad) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dirección <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $sucursal->direccion) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="Activo" {{ $sucursal->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $sucursal->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
