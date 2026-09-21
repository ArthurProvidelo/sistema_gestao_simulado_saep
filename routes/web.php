<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\AgendamentoController;

Route::get('/', [UsuarioController::class, 'login']);
Route::get('/login', [UsuarioController::class, 'login']);
Route::post('/login', [UsuarioController::class, 'autenticar']);
Route::post('/logout', [UsuarioController::class, 'logout']);

Route::get('/principal', function () {
    return view('principal');
});

// ROtas de empresas

Route::get('/empresas/listar', [EmpresaController::class, 'listar']);
Route::get('/empresas/create', [EmpresaController::class, 'create']);
Route::post('/empresas', [EmpresaController::class, 'store']);
Route::get('/empresas/{id}/edit', [EmpresaController::class, 'edit']);
Route::put('/empresas/{id}', [EmpresaController::class, 'update']);
Route::delete('/empresas/{id}', [EmpresaController::class, 'destroy']);

// Rotas de salas

Route::get('/salas/listar', [SalaController::class, 'listar']);
Route::get('/salas/create', [SalaController::class, 'create']);
Route::post('/salas', [SalaController::class, 'store']);
Route::get('/salas/{id}/edit', [SalaController::class, 'edit']);
Route::put('/salas/{id}', [SalaController::class, 'update']);
Route::delete('/salas/{id}', [SalaController::class, 'destroy']);

// Rotas de agendamentos 

Route::get('/agendamentos/listar', [AgendamentoController::class, 'listar']);
Route::get('/agendamentos/create', [AgendamentoController::class, 'create']);
Route::post('/agendamentos', [AgendamentoController::class, 'store']);
Route::get('/agendamentos/{id}/edit', [AgendamentoController::class, 'edit']);
Route::put('/agendamentos/{id}', [AgendamentoController::class, 'update']);
Route::delete('/agendamentos/{id}', [AgendamentoController::class, 'destroy']);
