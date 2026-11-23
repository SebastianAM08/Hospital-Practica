@extends('layouts.app')

@section('content')
<h2 class="mb-3">Registrar Ingreso</h2>

<form action="{{ route('ingresos.store') }}" method="POST" class="col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label">Código Ingreso</label>
        <input type="text" name="codigo_ingreso" class="form-control" maxlength="20" value="{{ old('codigo_ingreso') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Habitación</label>
        <input type="text" name="habitacion" class="form-control" maxlength="20" value="{{ old('habitacion') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha</label>
        <input type="date" name="fecha" class="form-control" value="{{ old('fecha', date('Y-m-d')) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Paciente</label>
        <select name="codigo_paciente" class="form-select" required>
            <option value="">-- Selecciona un paciente --</option>
            @foreach($pacientes as $paciente)
                <option value="{{ $paciente['codigo_paciente'] }}" {{ old('codigo_paciente') == $paciente['codigo_paciente'] ? 'selected' : '' }}>
                    {{ $paciente['codigo_paciente'] }} - {{ $paciente['nombre'] }} {{ $paciente['apellidos'] }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Médico</label>
        <select name="codigo_medico" class="form-select" required>
            <option value="">-- Selecciona un médico --</option>
            @foreach($medicos as $medico)
                <option value="{{ $medico['codigo_medico'] }}" {{ old('codigo_medico') == $medico['codigo_medico'] ? 'selected' : '' }}>
                    {{ $medico['codigo_medico'] }} - {{ $medico['nombre'] }} {{ $medico['apellidos'] }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
