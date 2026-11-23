@extends('layouts.app')

@section('content')
<h2 class="mb-3">Registrar Médico</h2>

<form action="{{ route('medicos.store') }}" method="POST" class="col-md-6">
    @csrf
    <div class="mb-3">
        <label class="form-label">Código Médico</label>
        <input type="text" name="codigo_medico" class="form-control" maxlength="20" value="{{ old('codigo_medico') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" maxlength="100" value="{{ old('nombre') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" maxlength="100" value="{{ old('apellidos') }}" required>
    </div>

    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
