<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
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



    //     public function index()
    // {
    //     $userId = auth()->id(); // Obtiene el ID del usuario autenticado
    //     $tareas = Task::where('created_by', $userId)->get(); // Filtra las tareas por el usuario autenticado
    //     return view('empleados.edit_tarea', compact('tareas'));
    // }

        public function index()
    {
        $userId = auth()->id(); // Obtiene el ID del usuario autenticado
        $tareas = Task::where('created_by', $userId)
                    ->with('comments') // Carga los comentarios de cada tarea
                    ->get(); // Filtra las tareas por el usuario autenticado

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


    public function addComment(Request $request, $taskId)
    {
    

        $comment = new Comment([
            'content' => $request->input('content'),
            'task_id' => $request->input('task_id'),
            'user_id' => auth()->id(),
        ]);
        $comment->save();

        return back()->with('success', 'Comentario agregado exitosamente.');
    }



    public function showComments($taskId)
    {
        $task = Task::findOrFail($taskId);
        $comments = $task->comments;

        return view('comments.show', compact('task', 'comments'));
    }

    public function updateComment(Request $request, $taskId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $validatedData = $request->validate([
            'content' => 'required|string|max:65535',
        ]);
    
        $comment->update([
            'content' => $validatedData['content'],
            'updated_by' => auth()->id(), // Opcional: Guardar el ID del usuario que realizó la última actualización
        ]);
    
        return back()->with('success', 'Comentario actualizado exitosamente.');
    }
    

    public function deleteComment($taskId, $commentId)
{
    $comment = Comment::where('task_id', $taskId)->where('id', $commentId)->first();
    if ($comment) {
        $comment->delete();
        return redirect()->route('empleadores.tareas-asignadas', $taskId)->with('success', 'Comentario eliminado exitosamente.');
    }
    return redirect()->back()->withErrors(['message' => 'No se encontró el comentario para eliminar.']);
}


    



}
