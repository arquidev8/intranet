

<div class="mt-4 container mx-auto px-2 py-2 sm:px-4 md:px-8 w-full lg:w-10/12">
    <div class="overflow-x-auto">
        <table class="responsive-table w-full table-auto">
            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="px-2 py-1">Título</th>
                    <th class="px-2 py-1">Descripción</th>
                    <th class="px-2 py-1">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($tareas as $tarea)
                    <tr>
                        <td class="px-2 py-1">{{ $tarea->title }}</td>
                        <td class="px-2 py-1">{{ $tarea->description }}</td>
                        <td class="px-2 py-1">
                            <div class="flex flex-wrap justify-between items-center gap-3">
                                <button id="completeButton-{{ $tarea->id }}" onclick="toggleTaskCompletion({{ $tarea->id }}, {{ $tarea->completed ? 0 : 1 }})"
                                    class="btn-action {{ $tarea->completed ? 'bg-green-500 text-white' : 'bg-gray-400 text-black' }} hover:bg-green-700 hover:text-white px-2 py-1 rounded">
                                    {{ $tarea->completed ? 'Completada' : 'En Progreso' }}
                                </button>

                                <button onclick="showEditFields({{ $tarea->id }})" class="btn-action bg-blue-500 hover:bg-blue-700 text-white px-2 py-1 rounded">Editar</button>
                                
                                <form id="editForm{{ $tarea->id }}" style="display:none;" action="{{ route('tareas.update', $tarea->id) }}" method="POST" class="w-full mt-2">
                                    @csrf
                                    @method('PUT')
                                    <label for="title">Título:</label>
                                    <input type="text" id="title{{ $tarea->id }}" name="title" value="{{ $tarea->title }}" required class="w-full p-2 mb-2 border border-gray-300 rounded">

                                    <label for="description">Descripción:</label>
                                    <textarea id="description{{ $tarea->id }}" name="description" rows="3" class="w-full p-2 mb-2 border border-gray-300 rounded">{{ $tarea->description }}</textarea>

                                    <input type="checkbox" id="completed{{ $tarea->id }}" name="completed" value="1" {{ $tarea->completed ? 'checked' : '' }}>
                                    <label for="completed{{ $tarea->id }}">Completada</label>

                                    <button type="submit" class="btn-action bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded mr-2 mt-2">Guardar cambios</button>
                                </form>

                                <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de querer eliminar esta tarea?');" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



 


<script>


function toggleTaskCompletion(taskId, newState) {
    fetch(`/tasks/${taskId}/toggle-completion`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ completed: newState }),
    })
  .then(response => response.json())
  .then(data => {
        if (data.success) {
            const button = document.querySelector(`#completeButton-${taskId}`);
            button.textContent = data.task.completed? 'Completada' : 'En Progreso';
            button.className = data.task.completed? 'bg-green-500 text-white' : 'bg-gray-400 text-black';
            location.reload(); // Recarga la página para reflejar el cambio global
        } else {
            alert('Error al actualizar el estado de la tarea.');
        }
    })
  .catch(error => console.error('Error:', error));
}



function showEditFields(taskId) {
    document.getElementById(`editForm${taskId}`).style.display = 'block';
}

function redirectToSamePage(event) {
    event.preventDefault(); // Evita que el formulario se envíe de la manera predeterminada
    document.getElementById(`editForm{{ $tarea->id }}`).submit(); // Envía el formulario
    window.location.href = "{{ route('tareas.edit') }}"; // Redirige a la página de lista de tareas
}

function showEditFields(taskId) {
    document.getElementById(`editForm${taskId}`).style.display = 'block';
}
</script>

<style>

    @media (max-width: 640px) {
       .responsive-table {
            width: 100%;
            margin: auto;
        }
    }
    @media (min-width: 641px) {
       .responsive-table {
            max-width: 1200px;
            margin: auto;
        }
    }

    .btn-action {
    flex-grow: 1; /* Asegura que cada botón crezca para ocupar el espacio disponible */
    display: inline-flex; /* Usa flexbox para el contenido interno del botón */
    align-items: center; /* Centra verticalmente el contenido del botón */
    justify-content: center; /* Centra horizontalmente el contenido del botón */
    cursor: pointer; /* Cambia el cursor a puntero cuando se pasa sobre el botón */
}


</style>

