@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- Mostrar el botón solo si el usuario tiene el rol 'Admin' -->
            @if(auth()->user()->hasRole('Admin'))
                <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Nuevo Usuario</a>
            @endif
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            @if(!auth()->user()->hasRole('Secretaria'))
                                <th>Email</th> 
                            @endif
                            <th>Sucursal</th>
                            <th>Rol</th> 
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                
                               
                                @if(!auth()->user()->hasRole('Secretaria'))
                                    <td>{{ $user->email }}</td>
                                @else
                                    <td>Acción restringida </td> 
                                @endif
                                
                                <td>{{ $user->sucursal ? $user->sucursal->nombre : 'N/A' }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge badge-info">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                      
                                        @if(auth()->user()->hasRole('Admin'))
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
