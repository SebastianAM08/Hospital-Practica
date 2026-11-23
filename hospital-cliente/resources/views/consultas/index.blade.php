@extends('layouts.app')

@section('content')
<h2 class="mb-4">Consultas e Historial</h2>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-3">
            <h5 class="mb-3">Ingresos atendidos por Médico</h5>
            <form method="GET" action="{{ route('consultas.index') }}" class="d-flex gap-2 mb-3">
                <select name="codigo_medico" class="form-select" required>
                    <option value="">-- Selecciona un médico --</option>
                    @foreach($medicos as $medico)
                        <option value="{{ $medico['codigo_medico'] }}" {{ request('codigo_medico') == $medico['codigo_medico'] ? 'selected' : '' }}>
                            {{ $medico['codigo_medico'] }} - {{ $medico['nombre'] }} {{ $medico['apellidos'] }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Buscar</button>
            </form>

            @if($resultadoMedico)
                <p class="small text-secondary mb-2">
                    Médico: <strong>{{ $resultadoMedico['medico']['nombre'] }} {{ $resultadoMedico['medico']['apellidos'] }}</strong>
                </p>
                @if(!empty($resultadoMedico['ingresos']))
                    <div class="table-responsive">
                        <table class="table table-sm table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Ingreso</th>
                                    <th>Habitación</th>
                                    <th>Fecha</th>
                                    <th>Paciente</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultadoMedico['ingresos'] as $ing)
                                    <tr>
                                        <td>{{ $ing['codigo_ingreso'] }}</td>
                                        <td>{{ $ing['habitacion'] }}</td>
                                        <td>{{ substr($ing['fecha'] ?? '', 0, 10) }}</td>
                                        <td>{{ $ing['paciente']['nombre'] ?? '' }} {{ $ing['paciente']['apellidos'] ?? $ing['codigo_paciente'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-secondary mb-0">Sin ingresos registrados para este médico.</p>
                @endif
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-3">
            <h5 class="mb-3">Historial de ingresos por Paciente</h5>
            <form method="GET" action="{{ route('consultas.index') }}" class="d-flex gap-2 mb-3">
                <select name="codigo_paciente" class="form-select" required>
                    <option value="">-- Selecciona un paciente --</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente['codigo_paciente'] }}" {{ request('codigo_paciente') == $paciente['codigo_paciente'] ? 'selected' : '' }}>
                            {{ $paciente['codigo_paciente'] }} - {{ $paciente['nombre'] }} {{ $paciente['apellidos'] }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Buscar</button>
            </form>

            @if($resultadoPaciente)
                <p class="small text-secondary mb-2">
                    Paciente: <strong>{{ $resultadoPaciente['paciente']['nombre'] }} {{ $resultadoPaciente['paciente']['apellidos'] }}</strong>
                </p>
                @if(!empty($resultadoPaciente['ingresos']))
                    <div class="table-responsive">
                        <table class="table table-sm table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Ingreso</th>
                                    <th>Habitación</th>
                                    <th>Fecha</th>
                                    <th>Médico</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultadoPaciente['ingresos'] as $ing)
                                    <tr>
                                        <td>{{ $ing['codigo_ingreso'] }}</td>
                                        <td>{{ $ing['habitacion'] }}</td>
                                        <td>{{ substr($ing['fecha'] ?? '', 0, 10) }}</td>
                                        <td>{{ $ing['medico']['nombre'] ?? '' }} {{ $ing['medico']['apellidos'] ?? $ing['codigo_medico'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-secondary mb-0">Sin ingresos registrados para este paciente.</p>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
