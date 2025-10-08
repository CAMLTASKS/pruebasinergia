<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        return response()->json(Municipio::all(), 200);
    }

    public function show($id)
    {
        $municipio = Municipio::find($id);
        if (!$municipio) {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
        return response()->json($municipio, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_departamento' => 'required|integer|exists:departamentos,id',
            'nombre' => 'required|string|max:100',
        ]);

        $municipio = Municipio::create($validated);
        return response()->json($municipio, 201);
    }

    public function update(Request $request, $id)
    {
        $municipio = Municipio::find($id);
        if (!$municipio) {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
        $municipio->update($request->only(['id_departamento', 'nombre']));
        return response()->json($municipio, 200);
    }

    public function destroy($id)
    {
        $municipio = Municipio::find($id);
        if (!$municipio) {
            return response()->json(['error' => 'Municipio no encontrado'], 404);
        }
        $municipio->delete();
        return response()->json(['message' => 'Municipio eliminado correctamente'], 200);
    }
}
