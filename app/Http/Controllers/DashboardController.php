<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show($role)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->tipo_usuario == $role) {
                return view("dashboard.$role");
            } else {
                abort(403, 'No autorizado');
            }
        } else {
            abort(401, 'No autorizado');
        }
    }

    public function verTareasEmpleados()
{
    if (Auth::check()) {
        $user = Auth::user();
        
        // Verifica si el usuario autenticado es un empleador
        if ($user->tipo_usuario!= 'empleador') {
            abort(403, 'Acceso denegado');
        }

        // Filtra las tareas que están asignadas al empleador actual
        $tareas = Task::where('visible_para', $user->id)->get();

        return view('empleadores.ver_tareas_empleados', compact('tareas'));
    } else {
        abort(401, 'No autorizado');
    }
}

    


}
