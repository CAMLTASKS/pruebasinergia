<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DepartamentoController,
    MunicipioController,
    TipoDocumentoController,
    GeneroController,
    PacienteController,
    UserController,
    AuthController
};



Route::get('/prueba', function () {
    return response()->json(['status' => 'API funcionando correctamente']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['jwt.verify'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('departamentos', DepartamentoController::class);
    Route::apiResource('municipios', MunicipioController::class);
    Route::apiResource('tipos-documento', TipoDocumentoController::class);
    Route::apiResource('generos', GeneroController::class);
    Route::apiResource('pacientes', PacienteController::class);
    Route::apiResource('usuarios', UserController::class);
});
