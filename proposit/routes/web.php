<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return redirect()->route('events.index');
});

// Eventos
Route::resource('events', EventController::class);

// Propostas
Route::resource('proposals', ProposalController::class);

// Papéis
Route::resource('roles', RoleController::class);
