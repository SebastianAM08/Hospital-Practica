@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detalle del Médico</h2>
    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card p-3 mb-4">
    <p class="mb-1"><strong>Código:</strong> {{ $medico['codigo_medico'] }}</p>
    <p class="mb-1"><strong>Nombre:</strong> {{ $medico['nombre'] }}</p>
    <p class="mb-0"><strong>Apellidos:</strong> {{ $medico['apellidos'] }}</p>
</div>

<h4>Ingresos atendidos</h4>
@if(!empty($medico['ingresos']))
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Código Ingreso</th>
                    <th>Habitación</th>
                    <th>Fecha</th>
                    <th>Paciente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medico['ingresos'] as $ingreso)
                    <tr>
                        <td>{{ $ingreso['codigo_ingreso'] }}</td>
                        <td>{{ $ingreso['habitacion'] }}</td>
                        <td>{{ substr($ingreso['fecha'] ?? '', 0, 10) }}</td>
                        <td>
                            @if(!empty($ingreso['paciente']))
                                {{ $ingreso['paciente']['codigo_paciente'] }} - {{ $ingreso['paciente']['nombre'] }} {{ $ingreso['paciente']['apellidos'] }}
                            @else
                                {{ $ingreso['codigo_paciente'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-secondary">Este médico aún no tiene ingresos atendidos.</p>
@endif
@endsection
