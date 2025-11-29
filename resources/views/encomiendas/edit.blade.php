@extends('adminlte::page')

@section('title','Editar Encomienda')

@section('content_header')
<h1>Editar Encomienda</h1>
@stop

@section('content')

<form action="{{ route('encomiendas.update', $encomienda->id_encomienda) }}" method="POST">
@csrf
@method('PUT')

@include('encomiendas.form')

<button class="btn btn-primary mt-3">Actualizar</button>
</form>

@stop
