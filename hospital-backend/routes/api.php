<?php

use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('medicos', MedicoController::class);
Route::get('medicos/{id}/ingresos', [MedicoController::class, 'ingresos']);

Route::apiResource('pacientes', PacienteController::class);
Route::get('pacientes/{id}/ingresos', [PacienteController::class, 'ingresos']);

Route::apiResource('ingresos', IngresoController::class);
