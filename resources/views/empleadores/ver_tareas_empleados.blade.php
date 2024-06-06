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
                                <h5 class="card-title text-xl font-bold mb-5">Título: {{ $tarea->title }}</h5>
                                <p class="card-text mb-4"><span class="font-bold">Descripción:</span> {{ $tarea->description }}</p>
                                 <p class="card-text font-bold">
                                    Estado: @if($tarea->completed) <p class="bg-green-400">Completada</p> @else <p class="bg-yellow-400">En Progreso</p> @endif
                                </p>

                                <!-- Mostrar comentarios -->
                                @if($tarea->comments->isNotEmpty())
                                    <div class="mb-4">
                                 @foreach($tarea->comments as $comment)
                                    <div class="border p-2 mb-2 rounded">
                                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                                        <!-- Botón para mostrar el formulario de edición -->
                                        <button onclick="showEditForm({{ $comment->id }})" class="btn btn-xs btn-info">Editar</button>
                                        
                                        <!-- Formulario para editar el comentario (oculto inicialmente) -->
                                        <form id="edit-form-{{ $comment->id }}" action="{{ route('tareas.comment.update', [$tarea->id, $comment->id]) }}" method="POST" style="display:none;">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="content">{{ $comment->content }}</textarea>
                                            <button type="submit" class="btn btn-xs btn-info">Guardar</button>
                                        </form>
                                        
                                        <!-- Formulario para eliminar el comentario -->
                                        <form action="{{ route('tareas.comment.delete', [$tarea->id, $comment->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                @endforeach

                                    </div>
                                @endif
                                <!-- Formulario para agregar nuevos comentarios -->
                                <form action="{{ route('tareas.addComment', $tarea->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="task_id" value="{{ $tarea->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <div class="mb-4">
                                        <label for="commentContent" class="block text-gray-700 text-md font-bold mb-2 mt-5">Comentarios:</label>
                                        <textarea id="commentContent" name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3"></textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                            Publicar Comentario
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function showEditForm(commentId) {
        // Oculta todos los formularios de edición
        document.querySelectorAll('form[id^="edit-form-"]').forEach(form => {
            form.style.display = 'none';
        });
        
        // Muestra el formulario de edición específico
        document.getElementById('edit-form-' + commentId).style.display = 'block';
    }
</script>