<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::resource('clientes', 'App\Http\Controllers\ClienteController'); 
Route::resource('cursos', 'App\Http\Controllers\CursoController'); 
Route::resource('asistenciaCursos', 'App\Http\Controllers\AsistenciaCursoController'); 
Route::get('reconocimientos/{codigo}/download', 'App\Http\Controllers\ReconocimientoController@download');
Route::resource('reconocimientos', 'App\Http\Controllers\ReconocimientoController'); 
Route::resource('designs', 'App\Http\Controllers\DiseñoController'); 


Route::get('/prueba', function () {
    return view('pdf.center');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


