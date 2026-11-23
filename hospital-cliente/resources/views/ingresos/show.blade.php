@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detalle del Ingreso</h2>
    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card p-3 col-md-6">
    <p class="mb-1"><strong>Código Ingreso:</strong> {{ $ingreso['codigo_ingreso'] }}</p>
    <p class="mb-1"><strong>Habitación:</strong> {{ $ingreso['habitacion'] }}</p>
    <p class="mb-1"><strong>Fecha:</strong> {{ substr($ingreso['fecha'] ?? '', 0, 10) }}</p>
    <hr>
    <p class="mb-1"><strong>Paciente:</strong>
        @if(!empty($ingreso['paciente']))
            {{ $ingreso['paciente']['codigo_paciente'] }} - {{ $ingreso['paciente']['nombre'] }} {{ $ingreso['paciente']['apellidos'] }}
        @else
            {{ $ingreso['codigo_paciente'] }}
        @endif
    </p>
    <p class="mb-0"><strong>Médico:</strong>
        @if(!empty($ingreso['medico']))
            {{ $ingreso['medico']['codigo_medico'] }} - {{ $ingreso['medico']['nombre'] }} {{ $ingreso['medico']['apellidos'] }}
        @else
            {{ $ingreso['codigo_medico'] }}
        @endif
    </p>
</div>
@endsection
