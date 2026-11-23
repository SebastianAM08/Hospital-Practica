@extends('layouts.app')

@section('content')
<h2 class="mb-3">Registrar Paciente</h2>

<form action="{{ route('pacientes.store') }}" method="POST" enctype="multipart/form-data" class="col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label">Código Paciente</label>
        <input type="text" name="codigo_paciente" class="form-control" maxlength="20" value="{{ old('codigo_paciente') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" maxlength="100" value="{{ old('nombre') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" maxlength="100" value="{{ old('apellidos') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Fotografía (JPG, PNG, WEBP)</label>
        <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
    </div>

    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
