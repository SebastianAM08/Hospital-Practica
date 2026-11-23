@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Pacientes</h2>
    <a href="{{ route('pacientes.create') }}" class="btn btn-primary">Nuevo Paciente</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Ingresos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacientes as $paciente)
                <tr>
                    <td>
                        @if(!empty($paciente['foto']))
                            <img src="{{ $paciente['foto'] }}" alt="Foto" width="40" height="40" class="rounded object-fit-cover">
                        @else
                            <span class="text-secondary">-</span>
                        @endif
                    </td>
                    <td>{{ $paciente['codigo_paciente'] }}</td>
                    <td>{{ $paciente['nombre'] }}</td>
                    <td>{{ $paciente['apellidos'] }}</td>
                    <td>{{ $paciente['ingresos_count'] ?? 0 }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('pacientes.show', $paciente['codigo_paciente']) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('pacientes.edit', $paciente['codigo_paciente']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('pacientes.destroy', $paciente['codigo_paciente']) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar paciente?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-secondary">No hay pacientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
