{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tareas Asignadas a Mi Empleador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Tareas Asignadas a Mi Empleador</h1>
                    @foreach($tareas as $tarea)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $tarea->title }}</h5>
                                <p class="card-text">{{ $tarea->description }}</p>
                                <!-- Mostrar otros detalles de la tarea -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tareas Asignadas a Mi Empleador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl mb-4">Tareas Asignadas a Mi Empleador</h1>
                    @foreach($tareas as $tarea)
                        <div class="card mb-6 bg-gray-100 dark:bg-gray-700 p-4 rounded shadow-md">
                            <div class="card-body">
                                <h5 class="card-title text-xl font-bold mb-2">{{ $tarea->title }}</h5>
                                <p class="card-text mb-4">{{ $tarea->description }}</p>
                                <!-- Mostrar otros detalles de la tarea -->
                                
                               
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
