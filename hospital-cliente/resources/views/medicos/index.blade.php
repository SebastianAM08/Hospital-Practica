@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Médicos</h2>
    <a href="{{ route('medicos.create') }}" class="btn btn-primary">Nuevo Médico</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Ingresos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($medicos as $medico)
                <tr>
                    <td>{{ $medico['codigo_medico'] }}</td>
                    <td>{{ $medico['nombre'] }}</td>
                    <td>{{ $medico['apellidos'] }}</td>
                    <td>{{ $medico['ingresos_count'] ?? 0 }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('medicos.show', $medico['codigo_medico']) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('medicos.edit', $medico['codigo_medico']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('medicos.destroy', $medico['codigo_medico']) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar médico?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-secondary">No hay médicos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
