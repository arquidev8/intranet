{{-- 


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Seguimiento de tareas') }}
        </h2>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gray-800 rounded-lg">
            <div class="bg-gray-800 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl mb-4 text-white">Tareas de mis empleados</h1>
                    @foreach($tareas as $tarea)
                        <div class="card mb-6 bg-gray-100 dark:bg-gray-700 p-4 rounded shadow-md">
                            <div class="card-body">
                                <h5 class="card-title text-xl font-bold mb-5">Título: {{ $tarea->title }}</h5>
                                <p class="card-text mb-4"><span class="font-bold">Descripción:</span> {{ $tarea->description }}</p>
                                 <p class="card-text font-black">
                                    Estado: @if($tarea->completed) <p class="text-green-400 font-black text-xl">Completada</p> @else <p class="text-xl text-yellow-500 font-black">En Progreso</p> @endif
                                </p>

                                <!-- Mostrar comentarios -->
                                @if($tarea->comments->isNotEmpty())
                                    <div class="mb-4">
                                 @foreach($tarea->comments as $comment)
                                    <div class="border p-2 mb-2 rounded">
                                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                                        <!-- Botón para mostrar el formulario de edición -->
                                        <button onclick="showEditForm({{ $comment->id }})" class="btn btn-xs btn-info bg-yellow-200 p-1">Editar</button>
                                        
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
                                            <button type="submit" class="btn btn-xs btn-danger bg-red-500 text-white p-1">Eliminar</button>
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
                                        <button class="bg-black text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
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
</script> --}}



{{-- <x-app-layout>
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
        <header class="bg-white dark:bg-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Seguimiento de tareas</h1>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out">
                        Nueva tarea
                    </button>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="space-y-8">
                @foreach($tareas as $tarea)
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                        <div class="px-6 py-4">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $tarea->title }}</h2>
                                @if($tarea->completed)
                                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">Completada</span>
                                @else
                                    <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 rounded-full">En Progreso</span>
                                @endif
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $tarea->description }}</p>
                            
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Comentarios</h3>
                                <div class="space-y-4">
                                    @foreach($tarea->comments as $comment)
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-md p-4">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $comment->user->name }}</p>
                                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $comment->content }}</p>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <button onclick="showEditForm({{ $comment->id }})" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Editar</button>
                                                    <form action="{{ route('tareas.comment.delete', [$tarea->id, $comment->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <form id="edit-form-{{ $comment->id }}" action="{{ route('tareas.comment.update', [$tarea->id, $comment->id]) }}" method="POST" class="hidden mt-4">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="content" class="w-full px-3 py-2 text-sm text-gray-700 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-600 dark:text-gray-300 dark:focus:ring-blue-600" rows="3">{{ $comment->content }}</textarea>
                                                <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                                    Guardar cambios
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <form action="{{ route('tareas.addComment', $tarea->id) }}" method="POST" class="mt-6">
                                @csrf
                                <input type="hidden" name="task_id" value="{{ $tarea->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <div>
                                    <label for="commentContent" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nuevo comentario</label>
                                    <textarea id="commentContent" name="content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Escribe tu comentario aquí..."></textarea>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                        Publicar comentario
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    function showEditForm(commentId) {
        document.querySelectorAll('form[id^="edit-form-"]').forEach(form => {
            form.classList.add('hidden');
        });
        
        const form = document.getElementById('edit-form-' + commentId);
        form.classList.remove('hidden');
    }
</script> --}}



<x-app-layout>
    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
        <main class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Tareas Totales</h3>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $tareas->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Tareas Completadas</h3>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $tareas->where('completed', 1)->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Tareas Pendientes</h3>
                    <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $tareas->where('completed', 0)->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Horas Totales</h3>
                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400" id="totalHours">
                        {{ $tareas->sum('duration') }}
                    </p>
                </div>
            </div>


            <form method="GET" action="{{ route('empleadores.tareas-asignadas') }}" class="mb-6">
                <div class="flex justify-between items-center">
                    <div class="flex space-x-4">
                        <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="all">Todas las tareas</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completadas</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendientes</option>
                        </select>
                        <input type="text" name="search" placeholder="Buscar tarea..." value="{{ request('search') }}" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out">Buscar</button>
                    </div>
                </div>
            </form>

            <div class="space-y-8" id="taskList">
                @foreach($tareas as $tarea)
                    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden task-card" 
                         data-status="{{ $tarea->completed ? 'completed' : 'pending' }}" 
                         data-date="{{ $tarea->created_at->format('Y-m-d') }}" 
                         data-duration="{{ $tarea->duration }}">
                        <div class="px-6 py-4">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $tarea->title }}</h2>
                                <span class="px-3 py-1 text-sm font-medium {{ $tarea->completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} rounded-full">
                                    {{ $tarea->completed ? 'Completada' : 'En Progreso' }}
                                </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $tarea->description }}</p>
                            <div class="flex justify-between items-center text-sm text-gray-500 dark:text-gray-400">
                                <span>Duración: {{ number_format($tarea->duration, 2) }} hrs</span>
                                <span>Creada: {{ $tarea->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>





   <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-8 p-12">
                <div class="p-6">
                 <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Semanas Aprobadas de {{ $currentMonth->translatedFormat('F Y') }}
                </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($approvedWeeks as $index => $week)
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Semana {{ $index + 1 }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $week['start'] }} - {{ $week['end'] }}</p>
                                <p class="text-{{ $week['approved'] ? 'green' : 'yellow' }}-600 dark:text-{{ $week['approved'] ? 'green' : 'yellow' }}-400">
                                    {{ $week['approved'] ? 'Aprobada' : 'Pendiente' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                @php
                    $allApproved = collect($approvedWeeks)->every(fn($week) => $week['approved']);
                    $canDownload = $allApproved && $totalApprovedHours >= 160;
                @endphp
                
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="certifyHours" class="mr-2">
                        <label for="certifyHours" class="text-sm text-gray-700 dark:text-gray-300">
                            Certifico que las horas aquí mostradas son correctas y autorizo el pago al Profesional
                        </label>
                    </div>
                    <button
                        onclick="downloadReport()"
                        class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded {{ $canDownload ? '' : 'opacity-50 cursor-not-allowed' }}"
                        {{ $canDownload ? '' : 'disabled' }}
                    >
                        Descargar Reporte Mensual ({{ number_format($totalApprovedHours, 2) }} horas aprobadas)
                    </button>
                </div>
            </div>



<script>
function downloadReport() {
    const certifyCheckbox = document.getElementById('certifyHours');
    if (!certifyCheckbox.checked) {
        alert('Por favor, certifique que las horas son correctas antes de descargar el reporte.');
        return;
    }
    
    const totalApprovedHours = {{ $totalApprovedHours }};
    if (totalApprovedHours < 160) {
        alert('No se pueden descargar reportes hasta que se hayan aprobado al menos 160 horas.');
        return;
    }
    
    // Mostrar mensaje de carga
    const downloadButton = document.querySelector('button[onclick="downloadReport()"]');
    downloadButton.textContent = 'Descargando...';
    downloadButton.disabled = true;
    
    // Iniciar la descarga
    window.location.href = "{{ route('work-hours.download-monthly-report', ['month' => $currentMonth->format('Y-m')]) }}";
    
    // Mostrar mensaje de éxito y restaurar el botón
    setTimeout(() => {
        alert('Reporte descargado con éxito. Se enviará una copia por correo electrónico en breve.');
        downloadButton.textContent = 'Descargar Reporte Mensual';
        downloadButton.disabled = false;
    }, 2000);
}
</script>

        <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                @if(!empty($pendingWeeks))
                    <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">Semanas Pendientes de Aprobación</h2>
                    @foreach($pendingWeeks as $pendingWeek)
                        <div class="mb-8 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Semana del {{ $pendingWeek['start']->format('d/m/Y') }} al {{ $pendingWeek['end']->format('d/m/Y') }}</h3>
                                @foreach($pendingWeek['summary'] as $employeeId => $summary)
                                    <div class="mb-6 border-b pb-4 border-gray-200 dark:border-gray-600">
                                        <p class="font-bold mb-2 text-gray-700 dark:text-gray-300">Nombre del Profesional: {{ $summary['name'] }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">Total de horas contratadas: 40</p>
                                        <p class="text-gray-600 dark:text-gray-400">Horas pendientes de aprobación: {{ $summary['pending_hours'] }}</p>
                                        <p class="text-gray-600 dark:text-gray-400">Horas restantes para completar: {{ max(0, 40 - $summary['total_hours']) }}</p>
                                        <div class="grid grid-cols-5 gap-2 mt-4">
                                            @foreach($summary['days'] as $day)
                                                <div class="p-2 border border-gray-200 dark:border-gray-600 rounded">
                                                    <div class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ Carbon\Carbon::parse($day['date'])->format('D d') }}</div>
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $day['hours'] }} hrs</div>
                                                    @if($day['approved'])
                                                        <span class="text-green-500 text-xs">Aprobado</span>
                                                    @else
                                                        <span class="text-yellow-500 text-xs">Pendiente</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        @if($summary['pending_hours'] > 0)
                                            <div class="mt-4 flex space-x-2">
                                                <form action="{{ route('work-hours.approve-week') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="week_start" value="{{ $pendingWeek['start']->format('Y-m-d') }}">
                                                    <input type="hidden" name="employee_id" value="{{ $employeeId }}">
                                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-300">Aprobar</button>
                                                </form>
                                                <button onclick="showCommentModal({{ $employeeId }}, '{{ $pendingWeek['start']->format('Y-m-d') }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300">
                                                    Aprobar con comentarios
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif

                <h2 class="text-3xl font-bold mb-4 text-gray-900 dark:text-gray-100">Semana Actual: {{ $weekStart->format('d/m/Y') }} al {{ $weekStart->copy()->endOfWeek(Carbon\Carbon::FRIDAY)->format('d/m/Y') }}</h2>
                @foreach ($workHoursSummary as $employeeId => $summary)
                    <div class="mb-8 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6">
                            <p class="font-bold mb-2 text-gray-700 dark:text-gray-300">Nombre del Profesional: {{ $summary['name'] }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Total de horas contratadas por semana: 40</p>
                            <p class="text-gray-600 dark:text-gray-400">Horas pendientes de aprobación de la semana en curso: {{ $summary['pending_hours'] }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Horas restantes para completar la semana: {{ max(0, 40 - $summary['total_hours']) }}</p>
                            <div class="grid grid-cols-5 gap-2 mt-4">
                                @foreach ($summary['days'] as $day)
                                    <div class="p-2 border border-gray-200 dark:border-gray-600 rounded">
                                        <div class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ Carbon\Carbon::parse($day['date'])->format('D d') }}</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ $day['hours'] }} hrs</div>
                                        @if ($day['approved'])
                                            <span class="text-green-500 text-xs">Aprobado</span>
                                        @else
                                            <span class="text-yellow-500 text-xs">Pendiente</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @if ($summary['pending_hours'] > 0)
                                <div class="mt-4 flex space-x-2">
                                    <form action="{{ route('work-hours.approve-week') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="week_start" value="{{ $weekStart->format('Y-m-d') }}">
                                        <input type="hidden" name="employee_id" value="{{ $employeeId }}">
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition duration-300">Aprobar</button>
                                    </form>
                                    <button onclick="showCommentModal({{ $employeeId }}, '{{ $weekStart->format('Y-m-d') }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300">
                                        Aprobar con comentarios
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


<div id="commentModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Aprobar con comentarios
                </h3>
                <div class="mt-2">
                    <textarea id="approvalComment" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Ingrese sus comentarios aquí"></textarea>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="approveWithComment()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Aprobar
                </button>
                <button type="button" onclick="closeCommentModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>










        <script>
        let currentEmployeeId, currentWeekStart;

        function showCommentModal(employeeId, weekStart) {
            currentEmployeeId = employeeId;
            currentWeekStart = weekStart;
            document.getElementById('commentModal').classList.remove('hidden');
        }

        function closeCommentModal() {
            document.getElementById('commentModal').classList.add('hidden');
        }

        function approveWithComment() {
            const comment = document.getElementById('approvalComment').value;
            
            fetch('{{ route('work-hours.approve-week-with-comment') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    employee_id: currentEmployeeId,
                    week_start: currentWeekStart,
                    comment: comment
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Semana aprobada con comentarios');
                    location.reload();
                } else {
                    alert('Error al aprobar la semana');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al aprobar la semana');
            });

            closeCommentModal();
        }
        </script>
    </div>
</x-app-layout>