<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        $ingresos = Ingreso::with(['medico', 'paciente'])->orderByDesc('fecha')->get();
        return response()->json($ingresos, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_ingreso'  => 'required|string|max:20|unique:ingresos,codigo_ingreso',
            'habitacion'      => 'required|string|max:20',
            'fecha'           => 'required|date',
            'codigo_medico'   => 'required|string|exists:medicos,codigo_medico',
            'codigo_paciente' => 'required|string|exists:pacientes,codigo_paciente',
        ]);

        $ingreso = Ingreso::create($validated);

        return response()->json($ingreso->load(['medico', 'paciente']), 201);
    }

    public function show($id)
    {
        $ingreso = Ingreso::with(['medico', 'paciente'])->find($id);

        if (!$ingreso) {
            return response()->json(['message' => 'Ingreso no encontrado.'], 404);
        }

        return response()->json($ingreso, 200);
    }

    public function update(Request $request, $id)
    {
        $ingreso = Ingreso::find($id);

        if (!$ingreso) {
            return response()->json(['message' => 'Ingreso no encontrado.'], 404);
        }

        $validated = $request->validate([
            'habitacion'      => 'required|string|max:20',
            'fecha'           => 'required|date',
            'codigo_medico'   => 'required|string|exists:medicos,codigo_medico',
            'codigo_paciente' => 'required|string|exists:pacientes,codigo_paciente',
        ]);

        $ingreso->update($validated);

        return response()->json($ingreso->load(['medico', 'paciente']), 200);
    }

    public function destroy($id)
    {
        $ingreso = Ingreso::find($id);

        if (!$ingreso) {
            return response()->json(['message' => 'Ingreso no encontrado.'], 404);
        }

        $ingreso->delete();

        return response()->json(['message' => 'Ingreso eliminado correctamente.'], 200);
    }
}
