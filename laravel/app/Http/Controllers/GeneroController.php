<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index()
    {
        return response()->json(Genero::all(), 200);
    }

    public function show($id)
    {
        $genero = Genero::find($id);
        if (!$genero) {
            return response()->json(['error' => 'Género no encontrado'], 404);
        }
        return response()->json($genero, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['nombre' => 'required|string|max:100']);
        $genero = Genero::create($validated);
        return response()->json($genero, 201);
    }

    public function update(Request $request, $id)
    {
        $genero = Genero::find($id);
        if (!$genero) {
            return response()->json(['error' => 'Género no encontrado'], 404);
        }
        $genero->update($request->only('nombre'));
        return response()->json($genero, 200);
    }

    public function destroy($id)
    {
        $genero = Genero::find($id);
        if (!$genero) {
            return response()->json(['error' => 'Género no encontrado'], 404);
        }
        $genero->delete();
        return response()->json(['message' => 'Género eliminado correctamente'], 200);
    }
}
