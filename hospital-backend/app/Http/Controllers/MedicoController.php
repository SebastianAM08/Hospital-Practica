<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::withCount('ingresos')->get();
        return response()->json($medicos, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_medico' => 'required|string|max:20|unique:medicos,codigo_medico',
            'nombre'        => 'required|string|max:100',
            'apellidos'     => 'required|string|max:100',
        ]);

        $medico = Medico::create($validated);

        return response()->json($medico, 201);
    }

    public function show($id)
    {
        $medico = Medico::with('ingresos.paciente')->find($id);

        if (!$medico) {
            return response()->json(['message' => 'Médico no encontrado.'], 404);
        }

        return response()->json($medico, 200);
    }

    public function update(Request $request, $id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['message' => 'Médico no encontrado.'], 404);
        }

        $validated = $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
        ]);

        $medico->update($validated);

        return response()->json($medico, 200);
    }

    public function destroy($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['message' => 'Médico no encontrado.'], 404);
        }

        if ($medico->ingresos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el médico porque tiene ingresos asociados.',
            ], 400);
        }

        $medico->delete();

        return response()->json(['message' => 'Médico eliminado correctamente.'], 200);
    }

    public function ingresos($id)
    {
        $medico = Medico::find($id);

        if (!$medico) {
            return response()->json(['message' => 'Médico no encontrado.'], 404);
        }

        $ingresos = $medico->ingresos()->with('paciente')->orderByDesc('fecha')->get();

        return response()->json([
            'medico'   => $medico,
            'ingresos' => $ingresos,
        ], 200);
    }
}
