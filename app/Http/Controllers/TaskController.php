<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
{
    $task = new Task([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'created_by' => auth()->id(), // El ID del usuario autenticado
        'visible_para' => auth()->user()->empleador_id, // Usa el empleador_id del usuario autenticado
        'completed' => $request->input('completed') === '1', // Convierte el valor del checkbox a booleano
    ]);
    $task->save();

    // Si el usuario es un empleado, también haz visible la tarea para su empleador
    if (auth()->user()->tipo_usuario == 'empleado') {
        $empleadoPorId = auth()->user()->empleador_id;
        $task->update(['visible_para' => $empleadoPorId]);
    }

    return back()->with('success', 'Tarea creada exitosamente.');
}


public function update(Request $request, $taskId)
{
    // Validar la solicitud antes de actualizar
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:65535',
        'completed' => 'nullable|boolean',
    ]);

    // Encontrar la tarea o lanzar una excepción si no existe
    $task = Task::findOrFail($taskId);

    // Actualizar la tarea con los datos validados
    $task->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'completed' => $validatedData['completed'] ?? false,
        'updated_by' => auth()->id(),
    ]);

    // Redirigir con un mensaje de éxito
    return back()->with('success', 'Tarea actualizada exitosamente.');
}


    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();

        return back()->with('success', 'Tarea eliminada exitosamente.');
    }



        public function index()
    {
        $userId = auth()->id(); // Obtiene el ID del usuario autenticado
        $tareas = Task::where('created_by', $userId)->get(); // Filtra las tareas por el usuario autenticado
        return view('empleados.edit_tarea', compact('tareas'));
    }

    public function toggleCompletion($taskId)
    {
        $task = Task::find($taskId);
        $task->update(['completed' => request()->input('completed')]);
        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }
    



}
