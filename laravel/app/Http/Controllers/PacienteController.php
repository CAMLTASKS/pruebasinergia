<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        return response()->json(Paciente::with(['departamento', 'municipio', 'genero', 'tipoDocumento'])->get(), 200);
    }

    public function show($id)
    {
        $paciente = Paciente::with(['departamento', 'municipio', 'genero', 'tipoDocumento'])->find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
        return response()->json($paciente, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'numero_documento' => 'required|numeric|unique:paciente,numero_documento',
            'nombre1' => 'required|string|max:100',
            'nombre2' => 'nullable|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'nullable|string|max:100',
            'genero_id' => 'required|exists:genero,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'correo' => 'required|email',
        ]);

        $paciente = Paciente::create($validated);
        return response()->json($paciente, 201);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        $validated = $request->validate([
            'numero_documento' => 'sometimes|numeric|unique:paciente,numero_documento,' . $id,
            'correo' => 'sometimes|email',
        ]);

        $paciente->update($validated);
        return response()->json($paciente, 200);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
        $paciente->delete();
        return response()->json(['message' => 'Paciente eliminado correctamente'], 200);
    }
}
