@extends('adminlte::page')

@section('title', 'Registrar Encomienda')

@section('content_header')
    <h1 class="text-primary fw-bold"><i class="fas fa-box"></i> Registrar Nueva Encomienda</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-body">
                <form action="{{ route('encomiendas.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="descripcion" class="form-label fw-bold">Descripción <span class="text-danger">*</span></label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror" placeholder="Ingrese una descripción" value="" required>
                            @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pago" class="form-label fw-bold">Pago <span class="text-danger">*</span></label>
                            <select name="pago" id="pago" class="form-select form-select-sm @error('pago') is-invalid @enderror" required>
                                <option value="Cancelado" {{ old('pago') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="Por pagar" {{ old('pago') == 'Por pagar' ? 'selected' : '' }}>Por pagar</option>
                                <option value="Qr" {{ old('pago') == 'Qr' ? 'selected' : '' }}>Qr</option>
                                <option value="Otro" {{ old('pago') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('pago') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_envio" class="form-label fw-bold">Fecha Envío <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_envio" id="fecha_envio" class="form-control form-control-sm @error('fecha_envio') is-invalid @enderror" value="" required>
                            @error('fecha_envio') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_cliente" class="form-label fw-bold">Cliente <span class="text-danger">*</span></label>
                            <select name="id_cliente" id="id_cliente" class="form-select form-select-sm select2 @error('id_cliente') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccione un cliente</option> <!-- Opción vacía al inicio -->
                                @foreach ($clientes as $c)
                                    <option value="{{ $c->id_cliente }}">{{ $c->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_cliente') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="id_sucursal_origen" class="form-label fw-bold">Sucursal Origen <span class="text-danger">*</span></label>
                            <select name="id_sucursal_origen" id="id_sucursal_origen" class="form-select form-select-sm select2 @error('id_sucursal_origen') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccione sucursal origen</option> <!-- Opción vacía al inicio -->
                                @foreach ($sucursales as $s)
                                    <option value="{{ $s->id_sucursal }}">{{ $s->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_sucursal_origen') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_sucursal_destino" class="form-label fw-bold">Sucursal Destino <span class="text-danger">*</span></label>
                            <select name="id_sucursal_destino" id="id_sucursal_destino" class="form-select form-select-sm select2 @error('id_sucursal_destino') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccione sucursal destino</option> <!-- Opción vacía al inicio -->
                                @foreach ($sucursales as $s)
                                    <option value="{{ $s->id_sucursal }}">{{ $s->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_sucursal_destino') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="id_chofer" class="form-label fw-bold">Chofer <span class="text-danger">*</span></label>
                            <select name="id_chofer" id="id_chofer" class="form-select form-select-sm select2 @error('id_chofer') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccione chofer</option> <!-- Opción vacía al inicio -->
                                @foreach ($choferes as $ch)
                                    <option value="{{ $ch->id_chofer }}">{{ $ch->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_chofer') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_auto" class="form-label fw-bold">Auto <span class="text-danger">*</span></label>
                            <select name="id_auto" id="id_auto" class="form-select form-select-sm select2 @error('id_auto') is-invalid @enderror" required>
                                <option value="" disabled selected>Seleccione auto</option> <!-- Opción vacía al inicio -->
                                @foreach ($autos as $a)
                                    <option value="{{ $a->id_auto }}">{{ $a->placa }}</option>
                                @endforeach
                            </select>
                            @error('id_auto') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <!-- Campo oculto para el empleado (usuario logueado) -->
                    <input type="hidden" name="id_empleado" value="{{ auth()->id() }}">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('encomiendas.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Encomienda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<!-- Agregar los estilos de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
<!-- Agregar los scripts de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: "Seleccione una opción",
            allowClear: true
        });
    });
</script>
<script>
    // Obtener la fecha y hora actual en formato yyyy-mm-dd
    window.onload = function() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd; // Formato yyyy-mm-dd

        document.getElementById('fecha_envio').value = today; // Asignar la fecha al input
    };
</script>
@stop
