@extends('layouts.app')

@section('content')
<h2 class="mb-3">Editar Paciente {{ $paciente['codigo_paciente'] }}</h2>

<form action="{{ route('pacientes.update', $paciente['codigo_paciente']) }}" method="POST" enctype="multipart/form-data" class="col-md-6">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Código Paciente</label>
        <input type="text" class="form-control" value="{{ $paciente['codigo_paciente'] }}" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" maxlength="100" value="{{ old('nombre', $paciente['nombre']) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" maxlength="100" value="{{ old('apellidos', $paciente['apellidos']) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fotografía (deja vacío para conservar la actual)</label>
        @if(!empty($paciente['foto']))
            <div class="mb-2">
                <img src="{{ $paciente['foto'] }}" alt="Foto actual" width="80" height="80" class="rounded object-fit-cover">
            </div>
        @endif
        <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
