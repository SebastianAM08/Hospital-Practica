<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MedicoClientController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::acceptJson()->get($url);
        return $response->successful() ? ($response->json() ?? []) : [];
    }

    public function index()
    {
        $url = env('API_BASE_URL');
        $medicos = $this->fetchDataFromApi($url . '/medicos');

        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        return view('medicos.create');
    }

    public function store(Request $request)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->post($url . '/medicos', $request->only([
            'codigo_medico', 'nombre', 'apellidos'
        ]));

        if ($response->status() === 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Error al registrar el médico.')->withInput();
        }

        return redirect()->route('medicos.index')->with('success', 'Médico registrado.');
    }

    public function show($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->get($url . '/medicos/' . $id);

        if ($response->failed()) {
            return redirect()->route('medicos.index')->with('error', 'Médico no encontrado.');
        }

        $medico = $response->json();

        return view('medicos.show', compact('medico'));
    }

    public function edit($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->get($url . '/medicos/' . $id);

        if ($response->failed()) {
            return redirect()->route('medicos.index')->with('error', 'Médico no encontrado.');
        }

        $medico = $response->json();

        return view('medicos.edit', compact('medico'));
    }

    public function update(Request $request, $id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->put($url . '/medicos/' . $id, $request->only([
            'nombre', 'apellidos'
        ]));

        if ($response->status() === 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Error al actualizar el médico.')->withInput();
        }

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado.');
    }

    public function destroy($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->delete($url . '/medicos/' . $id);

        if ($response->failed()) {
            return redirect()->route('medicos.index')
                ->with('error', $response->json('message') ?? 'No se pudo eliminar el médico.');
        }

        return redirect()->route('medicos.index')->with('success', 'Médico eliminado.');
    }
}
