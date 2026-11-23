@extends('layouts.app')

@section('content')
<h2 class="mb-3">Editar Médico {{ $medico['codigo_medico'] }}</h2>

<form action="{{ route('medicos.update', $medico['codigo_medico']) }}" method="POST" class="col-md-6">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Código Médico</label>
        <input type="text" class="form-control" value="{{ $medico['codigo_medico'] }}" disabled>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" maxlength="100" value="{{ old('nombre', $medico['nombre']) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" maxlength="100" value="{{ old('apellidos', $medico['apellidos']) }}" required>
    </div>

    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
