<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsultaClientController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::acceptJson()->get($url);
        return $response->successful() ? ($response->json() ?? []) : [];
    }

    public function index(Request $request)
    {
        $url = env('API_BASE_URL');
        $medicos = $this->fetchDataFromApi($url . '/medicos');
        $pacientes = $this->fetchDataFromApi($url . '/pacientes');

        $resultadoMedico = null;
        $resultadoPaciente = null;

        if ($request->filled('codigo_medico')) {
            $res = Http::acceptJson()->get($url . '/medicos/' . $request->codigo_medico . '/ingresos');
            if ($res->successful()) {
                $resultadoMedico = $res->json();
            }
        }

        if ($request->filled('codigo_paciente')) {
            $res = Http::acceptJson()->get($url . '/pacientes/' . $request->codigo_paciente . '/ingresos');
            if ($res->successful()) {
                $resultadoPaciente = $res->json();
            }
        }

        return view('consultas.index', compact(
            'medicos',
            'pacientes',
            'resultadoMedico',
            'resultadoPaciente'
        ));
    }
}
