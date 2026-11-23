@extends('layouts.app')

@section('content')
<h2 class="mb-3">Editar Ingreso {{ $ingreso['codigo_ingreso'] }}</h2>

<form action="{{ route('ingresos.update', $ingreso['codigo_ingreso']) }}" method="POST" class="col-md-6">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Código Ingreso</label>
        <input type="text" class="form-control" value="{{ $ingreso['codigo_ingreso'] }}" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Habitación</label>
        <input type="text" name="habitacion" class="form-control" maxlength="20" value="{{ old('habitacion', $ingreso['habitacion']) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fecha</label>
        <input type="date" name="fecha" class="form-control" value="{{ old('fecha', substr($ingreso['fecha'] ?? '', 0, 10)) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Paciente</label>
        <select name="codigo_paciente" class="form-select" required>
            <option value="">-- Selecciona un paciente --</option>
            @foreach($pacientes as $paciente)
                <option value="{{ $paciente['codigo_paciente'] }}" {{ old('codigo_paciente', $ingreso['codigo_paciente']) == $paciente['codigo_paciente'] ? 'selected' : '' }}>
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
                <option value="{{ $medico['codigo_medico'] }}" {{ old('codigo_medico', $ingreso['codigo_medico']) == $medico['codigo_medico'] ? 'selected' : '' }}>
                    {{ $medico['codigo_medico'] }} - {{ $medico['nombre'] }} {{ $medico['apellidos'] }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('ingresos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
