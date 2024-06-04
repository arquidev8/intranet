<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    </x-slot>

    <div class="bg-orange-100 min-h-screen">
        <div class="flex flex-col sm:flex-row pt-24 px-10 pb-4">
            <div class=" w-12/12 lg:w-2/12 mr-0 lg:mr-6">
                <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
                    @if (auth()->user()->tipo_usuario == 'empleado')
                        <a href="{{ route('empleados.crear-tarea') }}" 
                           class="inline-block text-gray-600 hover:text-black my-4 w-full">
                            <span class="material-icons-outlined float-left pr-2">assignment</span>
                            {{ __('Crear Tarea') }}
                            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                        </a>
                    @elseif (auth()->user()->tipo_usuario == 'empleador')
                        <a href="{{ route('empleadores.tareas-asignadas') }}" 
                           class="inline-block text-gray-600 hover:text-black my-4 w-full">
                            <span class="material-icons-outlined float-left pr-2">assignment_turned_in</span>
                            {{ __('Ver Tareas') }}
                            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                        </a>
                    @endif
                </div>

                <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
                    <a href="/profile" class="inline-block text-gray-600 hover:text-black my-4 w-full">
                        <span class="material-icons-outlined float-left pr-2">face</span>
                        Perfil
                        <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); this.closest('form').submit();"  
                           class="inline-block text-gray-600 hover:text-black my-4 w-full">
                            <span class="material-icons-outlined float-left pr-2">power_settings_new</span>
                            {{ __('Log Out') }}
                            <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
                        </a>
                    </form>
                </div>
            </div>
            
            <div class=" w-12/12 lg:w-10/12">
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="bg-no-repeat bg-red-200 border border-red-300 rounded-xl w-12/12 lg:w-7/12 p-6 sm:w-full md:w-7/12" style="background-image: url(https://previews.dropbox.com/p/thumb/AAvyFru8elv-S19NMGkQcztLLpDd6Y6VVVMqKhwISfNEpqV59iR5sJaPD4VTrz8ExV7WU9ryYPIUW8Gk2JmEm03OLBE2zAeQ3i7sjFx80O-7skVlsmlm0qRT0n7z9t07jU_E9KafA9l4rz68MsaZPazbDKBdcvEEEQPPc3TmZDsIhes1U-Z0YsH0uc2RSqEb0b83A1GNRo86e-8TbEoNqyX0gxBG-14Tawn0sZWLo5Iv96X-x10kVauME-Mc9HGS5G4h_26P2oHhiZ3SEgj6jW0KlEnsh2H_yTego0grbhdcN1Yjd_rLpyHUt5XhXHJwoqyJ_ylwvZD9-dRLgi_fM_7j/p.png?fv_content=true&size_mode=5); background-position: 90% center;">
                        <p class="text-5xl text-indigo-900">Welcome <br><strong>Lorem Ipsum</strong></p>
                        <span class="bg-red-300 text-xl text-white inline-block rounded-full mt-12 px-8 py-2"><strong>01:51</strong></span>
                    </div>

                    <div class="bg-no-repeat bg-orange-200 border border-orange-300 rounded-xl w-12/12 lg:w-5/12  p-6 sm:w-full md:w-5/12" style="background-image: url(https://previews.dropbox.com/p/thumb/AAuwpqWfUgs9aC5lRoM_f-yi7OPV4txbpW1makBEj5l21sDbEGYsrC9sb6bwUFXTSsekeka5xb7_IHCdyM4p9XCUaoUjpaTSlKK99S_k4L5PIspjqKkiWoaUYiAeQIdnaUvZJlgAGVUEJoy-1PA9i6Jj0GHQTrF_h9MVEnCyPQ-kg4_p7kZ8Yk0TMTL7XDx4jGJFkz75geOdOklKT3GqY9U9JtxxvRRyo1Un8hObbWQBS1eYE-MowAI5rNqHCE_e-44yXKY6AKJocLPXz_U4xp87K4mVGehFKC6dgk_i5Ur7gspuD7gRBDvd0sanJ9Ybr_6s2hZhrpad-2WFwWqSNkh/p.png?fv_content=true&size_mode=5); background-position: 100% 40%;">
                        <p class="text-5xl text-indigo-900">Inbox <br><strong>23</strong></p>
                        <a href="" class="bg-orange-300 text-xl text-white underline hover:no-underline inline-block rounded-full mt-12 px-8 py-2"><strong>See messages</strong></a>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row h-64 mt-6 gap-3">
                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-12/12 lg:w-4/12">
                        a
                    </div>
                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-12/12 lg:w-4/12">
                        b
                    </div>
                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-12/12 lg:w-4/12">
                        c
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>







   {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <form action="{{ route('tasks.store') }}" method="post">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>
    </div>
    <button type="submit">Create Task</button>
</form> --}}