<?php

use App\Http\Controllers\ConsultaClientController;
use App\Http\Controllers\IngresoClientController;
use App\Http\Controllers\MedicoClientController;
use App\Http\Controllers\PacienteClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('medicos', MedicoClientController::class)
    ->parameters(['medicos' => 'id']);

Route::resource('pacientes', PacienteClientController::class)
    ->parameters(['pacientes' => 'id']);

Route::resource('ingresos', IngresoClientController::class)
    ->parameters(['ingresos' => 'id']);

Route::get('consultas', [ConsultaClientController::class, 'index'])
    ->name('consultas.index');
