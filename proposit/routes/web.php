<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::get('/', function () {
    return redirect()->route('events.index');
});

// Eventos
Route::resource('events', EventController::class);

// Propostas
Route::resource('proposals', ProposalController::class);

// Papéis
Route::resource('roles', RoleController::class);

// Registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Mostrar formulário de login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// Enviar dados do login
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/painel', function() {
    return view('dashboard'); // Crie o arquivo resources/views/dashboard.blade.php
})->name('dashboard');

Route::get('proposals/{proposal}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
