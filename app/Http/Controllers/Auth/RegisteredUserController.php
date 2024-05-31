<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // return view('auth.register');
        $empleadores = User::where('tipo_usuario', 'empleador')
                      ->pluck('name', 'id'); // Cambia 'name' a 'id' para el segundo argumento de pluck
        return view('auth.register', compact('empleadores'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'tipo_usuario' => ['required','string', 'max:255'],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'tipo_usuario' => $request->input('tipo_usuario'),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }

    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Password::defaults()],
    //         'tipo_usuario' => ['required','string', 'max:255'],
    //         'empleador_id' => ['nullable', 'exists:'.User::class.',id'], // Asegúrate de que el ID exista en la tabla de usuarios
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'tipo_usuario' => $request->input('tipo_usuario'),
    //         'empleador_id' => $request->input('empleador_id'), // Asigna el empleador_id si está presente
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }

    public function store(Request $request): RedirectResponse
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|confirmed|min:8',
        'tipo_usuario' => 'required|string|max:255',
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'tipo_usuario' => $validatedData['tipo_usuario'],
    ]);

    if ($validatedData['tipo_usuario'] === 'empleado') {
        // Aquí asumimos que el usuario seleccionó un empleador desde un dropdown en el formulario
        $empleadoPorId = $request->input('empleado_por_id'); // Este valor vendría del formulario
        $user->empleador()->associate($empleadoPorId)->save(); // Asociar el usuario con su empleador
    } else {
        // Si el usuario es un empleador, no necesitamos hacer nada adicional aquí
    }

    // Autenticar y redirigir
    Auth::login($user);
    return redirect()->intended('dashboard');
}


    public function obtenerEmpleadores(Request $request)
    {
        // Filtramos los usuarios que son empleadores
        $empleadores = User::where('tipo_usuario', 'empleador')->get();

        // Devolvemos los empleadores como respuesta JSON
        return response()->json($empleadores);
    }
}
