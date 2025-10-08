<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        return response()->json(Departamento::all(), 200);
    }

    public function show($id)
    {
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }
        return response()->json($departamento, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['nombre' => 'required|string|max:100']);
        $departamento = Departamento::create($validated);
        return response()->json($departamento, 201);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }
        $departamento->update($request->only('nombre'));
        return response()->json($departamento, 200);
    }

    public function destroy($id)
    {
        $departamento = Departamento::find($id);
        if (!$departamento) {
            return response()->json(['error' => 'Departamento no encontrado'], 404);
        }
        $departamento->delete();
        return response()->json(['message' => 'Departamento eliminado correctamente'], 200);
    }
}
