<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IngresoClientController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::acceptJson()->get($url);
        return $response->successful() ? ($response->json() ?? []) : [];
    }

    public function index()
    {
        $url = env('API_BASE_URL');
        $ingresos = $this->fetchDataFromApi($url . '/ingresos');

        return view('ingresos.index', compact('ingresos'));
    }

    public function create()
    {
        $url = env('API_BASE_URL');
        $medicos = $this->fetchDataFromApi($url . '/medicos');
        $pacientes = $this->fetchDataFromApi($url . '/pacientes');

        return view('ingresos.create', compact('medicos', 'pacientes'));
    }

    public function store(Request $request)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->post($url . '/ingresos', $request->only([
            'codigo_ingreso', 'habitacion', 'fecha', 'codigo_medico', 'codigo_paciente'
        ]));

        if ($response->status() === 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Error al registrar el ingreso.')->withInput();
        }

        return redirect()->route('ingresos.index')->with('success', 'Ingreso registrado.');
    }

    public function show($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->get($url . '/ingresos/' . $id);

        if ($response->failed()) {
            return redirect()->route('ingresos.index')->with('error', 'Ingreso no encontrado.');
        }

        $ingreso = $response->json();

        return view('ingresos.show', compact('ingreso'));
    }

    public function edit($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->get($url . '/ingresos/' . $id);

        if ($response->failed()) {
            return redirect()->route('ingresos.index')->with('error', 'Ingreso no encontrado.');
        }

        $ingreso = $response->json();
        $medicos = $this->fetchDataFromApi($url . '/medicos');
        $pacientes = $this->fetchDataFromApi($url . '/pacientes');

        return view('ingresos.edit', compact('ingreso', 'medicos', 'pacientes'));
    }

    public function update(Request $request, $id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->put($url . '/ingresos/' . $id, $request->only([
            'habitacion', 'fecha', 'codigo_medico', 'codigo_paciente'
        ]));

        if ($response->status() === 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Error al actualizar el ingreso.')->withInput();
        }

        return redirect()->route('ingresos.index')->with('success', 'Ingreso actualizado.');
    }

    public function destroy($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->delete($url . '/ingresos/' . $id);

        if ($response->failed()) {
            return redirect()->route('ingresos.index')
                ->with('error', $response->json('message') ?? 'No se pudo eliminar el ingreso.');
        }

        return redirect()->route('ingresos.index')->with('success', 'Ingreso eliminado.');
    }
}
