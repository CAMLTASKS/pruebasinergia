<?php

use Illuminate\Support\Facades\Route;



Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');



Route::get('/', fn() => view('inicio'))->name('dashboard');
Route::get('/pacientes', fn() => view('pacientes'))->name('pacientes');
Route::get('/usuarios', fn() => view('usuarios'))->name('usuarios');
Route::get('/departamentos', fn() => view('departamentos'))->name('departamentos');
Route::get('/municipios', fn() => view('municipios'))->name('municipios');
Route::get('/tipos-documento', fn() => view('tipos-documento'))->name('tipos-documento');
Route::get('/genero', fn() => view('genero'))->name('genero');
Route::get('/configuracion', fn() => view('configuracion'))->name('configuracion');
Route::get('/resolucion-conocimientos', fn() => view('resolucion-conocimientos'))->name('resolucion-conocimientos');


Route::fallback(function () {
    return redirect('/login');
});
