<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController; // Asegúrate de importar TaskController


Route::get('/', function () {
    return view('welcome');
});

Route::get('/empleadores', [ProfileController::class, 'obtenerEmpleadores']);


// Route::get('/tareas', [TaskController::class, 'index'])->name('tareas.index');
Route::get('/empleados/editar-tareas', [TaskController::class, 'index'])->name('tareas.edit');
Route::post('/tareas', [TaskController::class, 'store'])->name('tareas.store');
Route::post('/tasks/{taskId}/toggle-completion', [TaskController::class, 'toggleCompletion']);

Route::put('/tareas/{taskId}', [TaskController::class, 'update'])->name('tareas.update');
Route::delete('/tareas/{taskId}', [TaskController::class, 'destroy'])->name('tareas.destroy');


Route::get('/empleadores/tareas-asignadas', [DashboardController::class, 'verTareasEmpleados'])->middleware(['auth'])->name('empleadores.tareas-asignadas');



Route::get('/tareas/{taskId}', [TaskController::class, 'show'])->name('tareas.show'); // Ruta para mostrar detalles de una tarea
Route::post('/tareas/{taskId}/comentar', [TaskController::class, 'addComment'])->name('tareas.addComment'); // Ruta para agregar un comentario a una tarea
Route::get('/tareas/{taskId}/comentarios', [TaskController::class, 'showComments'])->name('tareas.showComments'); // Ruta para mostrar los comentarios de una tarea
// Route::get('/tareas/{taskId}/comentarios/{commentId}/editar', [TaskController::class, 'updateComment'])->name('tareas.comment.edit');
Route::put('/tareas/{taskId}/comentarios/{commentId}', [TaskController::class, 'updateComment'])->name('tareas.comment.update');
Route::delete('/tareas/{taskId}/comentarios/{commentId}', [TaskController::class, 'deleteComment'])->name('tareas.comment.delete');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/empleados/crear-tarea', [EmpleadoController::class, 'create'])->name('empleados.crear-tarea');

});

require __DIR__.'/auth.php';
