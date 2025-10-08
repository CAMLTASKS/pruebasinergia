<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function index()
    {
        return response()->json(TipoDocumento::all(), 200);
    }

    public function show($id)
    {
        $tipo = TipoDocumento::find($id);
        if (!$tipo) {
            return response()->json(['error' => 'Tipo de documento no encontrado'], 404);
        }
        return response()->json($tipo, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['nombre' => 'required|string|max:100']);
        $tipo = TipoDocumento::create($validated);
        return response()->json($tipo, 201);
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoDocumento::find($id);
        if (!$tipo) {
            return response()->json(['error' => 'Tipo de documento no encontrado'], 404);
        }
        $tipo->update($request->only('nombre'));
        return response()->json($tipo, 200);
    }

    public function destroy($id)
    {
        $tipo = TipoDocumento::find($id);
        if (!$tipo) {
            return response()->json(['error' => 'Tipo de documento no encontrado'], 404);
        }
        $tipo->delete();
        return response()->json(['message' => 'Tipo de documento eliminado correctamente'], 200);
    }
}
