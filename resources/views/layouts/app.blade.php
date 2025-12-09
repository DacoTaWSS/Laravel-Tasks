<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f6f8;
            min-height: 100vh;
            padding: 20px;
        }
        .header {
            max-width: 1400px;
            margin: 0 auto 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1 {
            color: #172b4d;
            font-size: 24px;
            font-weight: 600;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            background: #e3fcef;
            color: #006644;
            border-left: 4px solid #00875a;
            font-size: 14px;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }
        .btn-primary {
            background: #0052cc;
            color: white;
        }
        .btn-primary:hover {
            background: #0747a6;
        }
        .btn-success {
            background: #00875a;
            color: white;
        }
        .btn-success:hover {
            background: #006644;
        }
        .btn-danger {
            background: #de350b;
            color: white;
        }
        .btn-danger:hover {
            background: #bf2600;
        }
        .btn-secondary {
            background: #f4f5f7;
            color: #172b4d;
            border: 1px solid #dfe1e6;
        }
        .btn-secondary:hover {
            background: #ebecf0;
        }
        
        /* Columnas Kanban */
        .kanban-columns {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .kanban-column {
            background: #f4f5f7;
            border-radius: 8px;
            padding: 12px;
            min-height: 400px;
        }
        .column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            margin-bottom: 12px;
        }
        .column-header h2 {
            font-size: 14px;
            font-weight: 600;
            color: #172b4d;
        }
        .task-count {
            background: #dfe1e6;
            color: #172b4d;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .column-header-done .task-count {
            background: #00875a;
            color: white;
        }
        .column-content {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .column-empty {
            text-align: center;
            padding: 40px 20px;
            color: #5e6c84;
            font-size: 13px;
        }
        
        /* Tarjetas de tareas */
        .task-card {
            background: white;
            border-radius: 6px;
            padding: 14px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            transition: box-shadow 0.2s;
        }
        .task-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .task-title {
            font-size: 14px;
            font-weight: 600;
            color: #172b4d;
            margin-bottom: 8px;
            line-height: 1.4;
        }
        .task-description {
            font-size: 13px;
            color: #5e6c84;
            margin-bottom: 12px;
            line-height: 1.5;
        }
        .task-date {
            font-size: 12px;
            color: #5e6c84;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .task-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f4f5f7;
        }
        .task-actions .btn {
            flex: 1;
            text-align: center;
            font-size: 12px;
            padding: 6px 12px;
        }
        .empty-state {
            text-align: center;
            color: #5e6c84;
            padding: 60px 20px;
            background: white;
            border-radius: 8px;
            font-size: 14px;
        }
        
        /* Formularios */
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            max-width: 600px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #172b4d;
            font-size: 14px;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #dfe1e6;
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
            transition: border 0.2s;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            outline: none;
            border-color: #4c9aff;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .kanban-columns {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</body>
</html>