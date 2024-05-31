<?php

namespace App\Http\Controllers;

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
}
