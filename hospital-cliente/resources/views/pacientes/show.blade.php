@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detalle del Paciente</h2>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card p-3 mb-4 col-md-6">
    @if(!empty($paciente['foto']))
        <div class="mb-3">
            <img src="{{ $paciente['foto'] }}" alt="Foto" width="120" height="120" class="rounded object-fit-cover">
        </div>
    @endif
    <p class="mb-1"><strong>Código:</strong> {{ $paciente['codigo_paciente'] }}</p>
    <p class="mb-1"><strong>Nombre:</strong> {{ $paciente['nombre'] }}</p>
    <p class="mb-0"><strong>Apellidos:</strong> {{ $paciente['apellidos'] }}</p>
</div>

<h4>Historial de ingresos</h4>
@if(!empty($paciente['ingresos']))
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Código Ingreso</th>
                    <th>Habitación</th>
                    <th>Fecha</th>
                    <th>Médico</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paciente['ingresos'] as $ingreso)
                    <tr>
                        <td>{{ $ingreso['codigo_ingreso'] }}</td>
                        <td>{{ $ingreso['habitacion'] }}</td>
                        <td>{{ substr($ingreso['fecha'] ?? '', 0, 10) }}</td>
                        <td>
                            @if(!empty($ingreso['medico']))
                                {{ $ingreso['medico']['codigo_medico'] }} - {{ $ingreso['medico']['nombre'] }} {{ $ingreso['medico']['apellidos'] }}
                            @else
                                {{ $ingreso['codigo_medico'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-secondary">Este paciente aún no registra ingresos.</p>
@endif
@endsection
