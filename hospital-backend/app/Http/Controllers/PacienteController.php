<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    private function cloudinary(): Cloudinary
    {
        return new Cloudinary(env('CLOUDINARY_URL'));
    }

    public function index()
    {
        $pacientes = Paciente::withCount('ingresos')->get();
        return response()->json($pacientes, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo_paciente' => 'required|string|max:20|unique:pacientes,codigo_paciente',
            'nombre'          => 'required|string|max:100',
            'apellidos'       => 'required|string|max:100',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $fotoUrl = null;

        if ($request->hasFile('foto')) {
            $upload = $this->cloudinary()->uploadApi()->upload(
                $request->file('foto')->getRealPath(),
                [
                    'folder'    => 'hospital_pacientes',
                    'public_id' => $validated['codigo_paciente'],
                    'overwrite' => true,
                ]
            );
            $fotoUrl = $upload['secure_url'];
        }

        $paciente = Paciente::create([
            'codigo_paciente' => $validated['codigo_paciente'],
            'nombre'          => $validated['nombre'],
            'apellidos'       => $validated['apellidos'],
            'foto'            => $fotoUrl,
        ]);

        return response()->json($paciente, 201);
    }

    public function show($id)
    {
        $paciente = Paciente::with('ingresos.medico')->find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado.'], 404);
        }

        return response()->json($paciente, 200);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado.'], 404);
        }

        $validated = $request->validate([
            'nombre'    => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = [
            'nombre'    => $validated['nombre'],
            'apellidos' => $validated['apellidos'],
        ];

        if ($request->hasFile('foto')) {
            $upload = $this->cloudinary()->uploadApi()->upload(
                $request->file('foto')->getRealPath(),
                [
                    'folder'     => 'hospital_pacientes',
                    'public_id'  => $paciente->codigo_paciente,
                    'overwrite'  => true,
                    'invalidate' => true,
                ]
            );
            $data['foto'] = $upload['secure_url'];
        }

        $paciente->update($data);

        return response()->json($paciente, 200);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado.'], 404);
        }

        if ($paciente->ingresos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el paciente porque tiene ingresos asociados.',
            ], 400);
        }

        if ($paciente->foto) {
            $this->cloudinary()->uploadApi()->destroy('hospital_pacientes/' . $paciente->codigo_paciente);
        }

        $paciente->delete();

        return response()->json(['message' => 'Paciente eliminado correctamente.'], 200);
    }

    public function ingresos($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado.'], 404);
        }

        $ingresos = $paciente->ingresos()->with('medico')->orderByDesc('fecha')->get();

        return response()->json([
            'paciente' => $paciente,
            'ingresos' => $ingresos,
        ], 200);
    }
}