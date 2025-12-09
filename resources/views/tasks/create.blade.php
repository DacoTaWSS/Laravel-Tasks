@extends('layouts.app')

@section('title', 'Crear Tarea')

@section('content')
<style>
    .form-container {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .form-header {
        margin-bottom: 32px;
    }
    
    .form-header h1 {
        font-size: 28px;
        color: #172b4d;
        margin-bottom: 8px;
    }
    
    .form-header p {
        color: #5e6c84;
        font-size: 14px;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #172b4d;
        font-size: 14px;
    }
    
    .form-group label .required {
        color: #de350b;
        margin-left: 2px;
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #5e6c84;
        font-size: 16px;
        pointer-events: none;
    }
    
    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #dfe1e6;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
        background: #fafbfc;
    }
    
    input[type="text"].with-icon {
        padding-left: 40px;
    }
    
    input[type="text"]:focus,
    input[type="date"]:focus,
    textarea:focus {
        outline: none;
        border-color: #4c9aff;
        background: white;
        box-shadow: 0 0 0 3px rgba(76, 154, 255, 0.1);
    }
    
    textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.6;
    }
    
    .char-count {
        text-align: right;
        font-size: 12px;
        color: #8993a4;
        margin-top: 4px;
    }
    
    .checkbox-card {
        background: #f4f5f7;
        border: 2px solid #dfe1e6;
        border-radius: 8px;
        padding: 16px;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .checkbox-card:hover {
        background: #ebecf0;
        border-color: #b3bac5;
    }
    
    .checkbox-card.checked {
        background: #e3fcef;
        border-color: #00875a;
    }
    
    .checkbox-card input[type="checkbox"] {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #00875a;
    }
    
    .checkbox-card label {
        margin: 0 !important;
        cursor: pointer;
        flex: 1;
        font-weight: 500;
        color: #172b4d;
    }
    
    .checkbox-card .checkbox-icon {
        font-size: 20px;
    }
    
    .error-message {
        color: #de350b;
        font-size: 13px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #f4f5f7;
    }
    
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
        flex: 1;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0052cc 0%, #0747a6 100%);
        color: white;
        box-shadow: 0 2px 4px rgba(5, 71, 166, 0.2);
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(5, 71, 166, 0.3);
    }
    
    .btn-secondary {
        background: white;
        color: #172b4d;
        border: 2px solid #dfe1e6;
    }
    
    .btn-secondary:hover {
        background: #f4f5f7;
        border-color: #b3bac5;
    }
    
    .input-hint {
        font-size: 12px;
        color: #5e6c84;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    @media (max-width: 640px) {
        .form-container {
            padding: 24px;
        }
        
        .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h1> Crear Nueva Tarea</h1>
            <p>Completa los detalles de tu nueva tarea</p>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">
                    Título de la tarea
                    <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <span class="input-icon"></span>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           class="with-icon"
                           value="{{ old('title') }}" 
                           placeholder="Ej: Diseñar página de inicio"
                           required
                           maxlength="255">
                </div>
                @error('title')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" 
                          name="description"
                          placeholder="Añade más detalles sobre esta tarea..."
                          maxlength="1000">{{ old('description') }}</textarea>
                <div class="char-count">
                    <span id="charCount">0</span> / 1000 caracteres
                </div>
                @error('description')
                    <div class="error-message">
                         {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="due_date">Fecha límite</label>
                <div class="input-wrapper">
                    <input type="date" 
                           id="due_date" 
                           name="due_date" 
                           value="{{ old('due_date') }}"
                           min="{{ date('Y-m-d') }}">
                </div>
                <div class="input-hint">
                     Opcional: Define cuándo debe completarse
                </div>
                @error('due_date')
                    <div class="error-message">
                         {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label>Estado</label>
                <div class="checkbox-card" id="checkboxCard">
                    <input type="checkbox" 
                           id="is_done" 
                           name="is_done" 
                           value="1" 
                           {{ old('is_done') ? 'checked' : '' }}>
                    <span class="checkbox-icon"></span>
                    <label for="is_done">Marcar como completada</label>
                </div>
                @error('is_done')
                    <div class="error-message">
                         {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                     Guardar Tarea
                </button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                    ← Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Contador de caracteres para descripción
    const textarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    
    function updateCharCount() {
        charCount.textContent = textarea.value.length;
    }
    
    textarea.addEventListener('input', updateCharCount);
    updateCharCount();
    
    // Toggle visual del checkbox
    const checkbox = document.getElementById('is_done');
    const checkboxCard = document.getElementById('checkboxCard');
    
    function updateCheckboxCard() {
        if (checkbox.checked) {
            checkboxCard.classList.add('checked');
        } else {
            checkboxCard.classList.remove('checked');
        }
    }
    
    checkbox.addEventListener('change', updateCheckboxCard);
    checkboxCard.addEventListener('click', function(e) {
        if (e.target !== checkbox) {
            checkbox.checked = !checkbox.checked;
            updateCheckboxCard();
        }
    });
    
    updateCheckboxCard();
</script>
@endsection