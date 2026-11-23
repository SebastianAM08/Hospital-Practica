@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1>Sistema de Gestión Hospitalaria</h1>
    <p class="text-secondary">Administración de médicos, pacientes e ingresos hospitalarios.</p>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card h-100 p-3">
            <h5>Médicos</h5>
            <p class="text-secondary small">Registro, edición y consulta de médicos e ingresos atendidos.</p>
            <a href="{{ route('medicos.index') }}" class="btn btn-primary btn-sm mt-auto">Gestionar</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3">
            <h5>Pacientes</h5>
            <p class="text-secondary small">Gestión de pacientes, fotografías e historial de ingresos.</p>
            <a href="{{ route('pacientes.index') }}" class="btn btn-primary btn-sm mt-auto">Gestionar</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3">
            <h5>Ingresos</h5>
            <p class="text-secondary small">Asociación de pacientes y médicos por habitación y fecha.</p>
            <a href="{{ route('ingresos.index') }}" class="btn btn-primary btn-sm mt-auto">Gestionar</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card h-100 p-3">
            <h5>Consultas</h5>
            <p class="text-secondary small">Historial de ingresos por paciente y atenciones por médico.</p>
            <a href="{{ route('consultas.index') }}" class="btn btn-secondary btn-sm mt-auto">Consultar</a>
        </div>
    </div>
</div>
@endsection
