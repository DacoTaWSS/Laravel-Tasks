<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Redirigir la ruta raíz a /tasks
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Rutas resource para el CRUD de tareas
Route::resource('tasks', TaskController::class);