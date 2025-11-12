@extends('adminlte::page')

@section('title', 'Registrar Sucursal')

@section('content_header')
<h1 class="text-primary fw-bold"><i class="fas fa-plus"></i> Registrar Sucursal</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('sucursales.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Ciudad <span class="text-danger">*</span></label>
                        <input type="text" name="ciudad" class="form-control" value="{{ old('ciudad') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Dirección <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="Activo" selected>Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('sucursales.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
