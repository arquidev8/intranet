{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Tarea') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-2 py-12 sm:px-4 md:px-8">
        <div class="max-w-screen-md mx-auto sm:px-6 md:max-w-2xl lg:px-8 lg:max-w-4xl xl:max-w-6xl">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título:</label>
                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="title" name="title" required>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción:</label>
                            <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Duración estimada (horas):</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="time" id="duration" name="duration" min="0" required>
                        </div>
          
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Crear Tarea
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    @include('empleados.edit_tarea', ['tareas' => $tareas])

</x-app-layout> --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Tarea') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-2 py-12 sm:px-4 md:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Formulario de creación de tareas -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg w-full lg:w-1/2">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título:</label>
                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="title" name="title" required>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción:</label>
                            <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Duración estimada (horas):</label>
                            <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="time" id="duration" name="duration" min="0" required>
                        </div>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Crear Tarea
                        </button>
                    </form>
                </div>
            </div>

            <!-- Vista incrustada de tareas -->
            <div class="w-full lg:w-[1300px]">
                @include('empleados.edit_tarea', ['tareas' => $tareas])
            </div>
        </div>
    </div>
</x-app-layout>
