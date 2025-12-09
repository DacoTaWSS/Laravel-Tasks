@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('content')
    <div class="header">
        <h1>Mis Tareas</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nueva Tarea</a>
    </div>

    <div class="container">
        @if($tasks->isEmpty())
            <div class="empty-state">
                No hay tareas registradas. Crea tu primera tarea.
            </div>
        @else
            <div class="kanban-columns">
                <!-- Columna Pendientes -->
                <div class="kanban-column">
                    <div class="column-header">
                        <h2>Pendiente</h2>
                        <span class="task-count">{{ $tasks->where('is_done', false)->count() }}</span>
                    </div>
                    
                    <div class="column-content">
                        @foreach($tasks->where('is_done', false) as $task)
                            <div class="task-card">
                                <div class="task-title">{{ $task->title }}</div>
                                
                                @if($task->description)
                                    <div class="task-description">
                                        {{ Str::limit($task->description, 80) }}
                                    </div>
                                @endif
                                
                                @if($task->due_date)
                                    <div class="task-date">
                                        📅 {{ $task->due_date->format('d/m/Y') }}
                                    </div>
                                @endif
                                
                                <div class="task-actions">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-success">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="width: 100%;"
                                                onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($tasks->where('is_done', false)->isEmpty())
                            <div class="column-empty">No hay tareas pendientes</div>
                        @endif
                    </div>
                </div>

                <!-- Columna Completadas -->
                <div class="kanban-column">
                    <div class="column-header column-header-done">
                        <h2>Completada</h2>
                        <span class="task-count">{{ $tasks->where('is_done', true)->count() }}</span>
                    </div>
                    
                    <div class="column-content">
                        @foreach($tasks->where('is_done', true) as $task)
                            <div class="task-card">
                                <div class="task-title">{{ $task->title }}</div>
                                
                                @if($task->description)
                                    <div class="task-description">
                                        {{ Str::limit($task->description, 80) }}
                                    </div>
                                @endif
                                
                                @if($task->due_date)
                                    <div class="task-date">
                                         {{ $task->due_date->format('d/m/Y') }}
                                    </div>
                                @endif
                                
                                <div class="task-actions">
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-success">Editar</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="flex: 1;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="width: 100%;"
                                                onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($tasks->where('is_done', true)->isEmpty())
                            <div class="column-empty">No hay tareas completadas</div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection