<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
        </h2>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    </x-slot>

    <div class="bg-gray-800 min-h-screen">
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
                    <div class="bg-no-repeat bg-white border border-red-200 rounded-xl w-12/12 lg:w-7/12 p-6 sm:w-full md:w-7/12" style="background-image: url(https://previews.dropbox.com/p/thumb/AAvyFru8elv-S19NMGkQcztLLpDd6Y6VVVMqKhwISfNEpqV59iR5sJaPD4VTrz8ExV7WU9ryYPIUW8Gk2JmEm03OLBE2zAeQ3i7sjFx80O-7skVlsmlm0qRT0n7z9t07jU_E9KafA9l4rz68MsaZPazbDKBdcvEEEQPPc3TmZDsIhes1U-Z0YsH0uc2RSqEb0b83A1GNRo86e-8TbEoNqyX0gxBG-14Tawn0sZWLo5Iv96X-x10kVauME-Mc9HGS5G4h_26P2oHhiZ3SEgj6jW0KlEnsh2H_yTego0grbhdcN1Yjd_rLpyHUt5XhXHJwoqyJ_ylwvZD9-dRLgi_fM_7j/p.png?fv_content=true&size_mode=5); background-position: 90% center;">
                        <p class="text-5xl text-black">Bienvenido <strong>{{ $nombreUsuario }}</strong></p>
                        <a href="/empleados/crear-tarea" class="bg-red-300 text-xl text-black inline-block rounded-full mt-12 px-8 py-2"><strong>Ver tareas</strong></a>
                    </div>

                    <div class="bg-no-repeat bg-red-200 border border-red-200 rounded-xl w-12/12 lg:w-5/12  p-6 sm:w-full md:w-5/12" style="background-image: url(https://previews.dropbox.com/p/thumb/AAuwpqWfUgs9aC5lRoM_f-yi7OPV4txbpW1makBEj5l21sDbEGYsrC9sb6bwUFXTSsekeka5xb7_IHCdyM4p9XCUaoUjpaTSlKK99S_k4L5PIspjqKkiWoaUYiAeQIdnaUvZJlgAGVUEJoy-1PA9i6Jj0GHQTrF_h9MVEnCyPQ-kg4_p7kZ8Yk0TMTL7XDx4jGJFkz75geOdOklKT3GqY9U9JtxxvRRyo1Un8hObbWQBS1eYE-MowAI5rNqHCE_e-44yXKY6AKJocLPXz_U4xp87K4mVGehFKC6dgk_i5Ur7gspuD7gRBDvd0sanJ9Ybr_6s2hZhrpad-2WFwWqSNkh/p.png?fv_content=true&size_mode=5); background-position: 100% 40%;">
                        <p class="text-5xl text-black">Mensajes <br><strong></strong></p>
                        <a href="/chat" class="bg-gray-800 text-xl text-white  inline-block rounded-full mt-12 px-8 py-2"><strong>Ver mensajes</strong></a>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row h-120 mt-6 gap-3">
                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-12/12 lg:w-4/12">
                           <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-primary-400">

                                <a class="relative" href="/tool/writey-ai">
                                    <div class="relative w-full aspect-video">
                                        <img class="rounded w-full h-full object-cover"
                                            src="https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw1fHxrZXlib2FyZHxlbnwwfDB8fHwxNjk5NTI1MDAzfDA&ixlib=rb-4.0.3&q=80&w=1080" alt="Writey A.I" loading="lazy">

                                        <div
                                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-b from-gray-800 to-gray-500 text-white">
                                            <h2 class="text-xl font-semibold">Writey A.I</h2>
                                            <p class="font-medium text-sm">Most advanced language A.I</p>
                                        </div>
                                    </div>
                                </a>

                                <div class="flex flex-col justify-beetween gap-3 px-4 py-2">

                                    <p class="text-gray-600 two-lines">
                                        Writey A.I is an AI tool that generates original, researched blog posts in minutes, provides content
                                        optimization advice, and works with a plagiarism-free rule.
                                    </p>

                                    <ul class="flex flex-wrap items-center justify-start text-sm gap-2">
                           

                                    </ul>

                                    <ul class="flex flex-wrap text-sm gap-2 my-1">
                                        <li class="flex items-center gap-2">
                                            <span>Content Generation,</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span>Marketing,</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span>SEO,</span>
                                        </li>
                                        <li class="flex items-center gap-2">
                                            <span>Writing</span>
                                        </li>
                                    </ul>
                                </div>

                            </li>
                    </div>




                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-12/12 lg:w-4/12">
                        <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-primary-400">
        
                <div class="relative w-full aspect-video">
                    <img class="rounded w-full h-full object-cover"
                        src="https://images.unsplash.com/photo-1529236183275-4fdcf2bc987e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxrZXlib2FyZHxlbnwwfDB8fHwxNjk5NTI1MDAzfDA&ixlib=rb-4.0.3&q=80&w=1080" alt="WriteMe.ai" loading="lazy">
                    <div
                        class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-b from-gray-800 to-gray-500 text-white">
                        <p class="font-medium text-sm"></p>
                    </div>
                </div>
      


            <div class="flex flex-col justify-beetween gap-3 px-4 py-2">

                                <p class="text-gray-600 two-lines">
                                    WriteMe.ai is your #1 AI-powered content writing assistant that crafts high-quality content at a
                                    fraction of
                                    the cost. This advanced solution eliminates the need for manual writing and allows users to
                                    effortlessly
                                    generate content in a few clicks.
                                </p>

                      

                                <ul class="flex flex-wrap text-sm gap-2 my-1">
                                    <li class="flex items-center gap-2">
                                        <span>Chatbot,</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span>Content Generation,</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span>General Writing,</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span>Social Media Assistant,</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span>Writing</span>
                                    </li>
                                </ul>
                            </div>

                        </li>

                    </div>



                    <div class="bg-white rounded-xl shadow-lg px-6 py-4 w-12/12 lg:w-4/12">
                        <li class="relative bg-white flex flex-col justify-between border rounded shadow-md hover:shadow-primary-400">
            <a class="relative" href="/tool/publer">
                <div class="relative w-full aspect-video">
                    <img class="rounded w-full h-full object-cover"
                        src="https://images.unsplash.com/photo-1586776977607-310e9c725c37?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxM3x8a2V5Ym9hcmR8ZW58MHwwfHx8MTY5OTUyNTAwM3ww&ixlib=rb-4.0.3&q=80&w=1080" alt="Publer" loading="lazy">
                    <div
                        class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-b from-gray-800 to-gray-500 text-white">
                   
                    </div>
                </div>
            </a>


            <div class="flex flex-col justify-beetween gap-3 px-4 py-2">

                <p class="text-gray-600 two-lines">
                    Publer is a robust social media management platform offering a range of features including post
                    scheduling,
                    collaboration tools, analytics, and AI assistance to supercharge your social media strategy across
                    multiple
                    platforms.
                </p>

                <ul class="flex flex-wrap items-center justify-start text-sm gap-2">
            

                    <li title="Support for API"
                        class="flex items-center cursor-pointer gap-0.5 bg-gray-100 text-black px-2 py-0.5 rounded-full">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M17 9V12C17 14.7614 14.7614 17 12 17M7 9V12C7 14.7614 9.23858 17 12 17M12 17V21M8 3V6M16 3V6M5 9H19"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                        <span>API</span>
                    </li>
                </ul>

                <ul class="flex flex-wrap text-sm gap-2 my-1">
                    <li class="flex items-center gap-2">
                        <span>Marketing,</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>Productivity,</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span>Social Media</span>
                    </li>
                </ul>
            </div>

        </li>
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