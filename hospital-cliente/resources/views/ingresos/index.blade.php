@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Ingresos Hospitalarios</h2>
    <a href="{{ route('ingresos.create') }}" class="btn btn-primary">Nuevo Ingreso</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>Código</th>
                <th>Habitación</th>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ingresos as $ingreso)
                <tr>
                    <td>{{ $ingreso['codigo_ingreso'] }}</td>
                    <td>{{ $ingreso['habitacion'] }}</td>
                    <td>{{ substr($ingreso['fecha'] ?? '', 0, 10) }}</td>
                    <td>
                        @if(!empty($ingreso['paciente']))
                            {{ $ingreso['paciente']['nombre'] }} {{ $ingreso['paciente']['apellidos'] }} ({{ $ingreso['codigo_paciente'] }})
                        @else
                            {{ $ingreso['codigo_paciente'] }}
                        @endif
                    </td>
                    <td>
                        @if(!empty($ingreso['medico']))
                            {{ $ingreso['medico']['nombre'] }} {{ $ingreso['medico']['apellidos'] }} ({{ $ingreso['codigo_medico'] }})
                        @else
                            {{ $ingreso['codigo_medico'] }}
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('ingresos.show', $ingreso['codigo_ingreso']) }}" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="{{ route('ingresos.edit', $ingreso['codigo_ingreso']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ingresos.destroy', $ingreso['codigo_ingreso']) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar ingreso?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-secondary">No hay ingresos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
