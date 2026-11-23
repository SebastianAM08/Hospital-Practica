<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PacienteClientController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::acceptJson()->get($url);
        return $response->successful() ? ($response->json() ?? []) : [];
    }

    public function index()
    {
        $url = env('API_BASE_URL');
        $pacientes = $this->fetchDataFromApi($url . '/pacientes');

        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $url = env('API_BASE_URL');
        $data = $request->only(['codigo_paciente', 'nombre', 'apellidos']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $response = Http::acceptJson()
                ->attach('foto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post($url . '/pacientes', $data);
        } else {
            $response = Http::acceptJson()->post($url . '/pacientes', $data);
        }

        if ($response->status() === 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Error al registrar el paciente.')->withInput();
        }

        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado.');
    }

    public function show($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->get($url . '/pacientes/' . $id);

        if ($response->failed()) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado.');
        }

        $paciente = $response->json();

        return view('pacientes.show', compact('paciente'));
    }

    public function edit($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->get($url . '/pacientes/' . $id);

        if ($response->failed()) {
            return redirect()->route('pacientes.index')->with('error', 'Paciente no encontrado.');
        }

        $paciente = $response->json();

        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, $id)
    {
        $url = env('API_BASE_URL');
        $data = $request->only(['nombre', 'apellidos']);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $data['_method'] = 'PUT';

            $response = Http::acceptJson()
                ->attach('foto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post($url . '/pacientes/' . $id, $data);
        } else {
            $response = Http::acceptJson()->put($url . '/pacientes/' . $id, $data);
        }

        if ($response->status() === 422) {
            return back()->withErrors($response->json('errors'))->withInput();
        }

        if ($response->failed()) {
            return back()->with('error', $response->json('message') ?? 'Error al actualizar el paciente.')->withInput();
        }

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado.');
    }

    public function destroy($id)
    {
        $url = env('API_BASE_URL');
        $response = Http::acceptJson()->delete($url . '/pacientes/' . $id);

        if ($response->failed()) {
            return redirect()->route('pacientes.index')
                ->with('error', $response->json('message') ?? 'No se pudo eliminar el paciente.');
        }

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado.');
    }
}
