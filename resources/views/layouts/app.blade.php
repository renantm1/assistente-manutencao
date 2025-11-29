<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Assistente de Manutenção')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-white">
    
    <!-- Navbar -->
    <nav class="bg-slate-800 border-b border-slate-700 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-blue-400">
                🛠️ Assistente de Manutenção
            </a>
            <div class="flex gap-6">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-400 transition">Dashboard</a>
                <a href="{{ route('om.index') }}" class="hover:text-blue-400 transition">OMs</a>
                <a href="{{ route('demonstrations.index') }}" class="hover:text-blue-400 transition">Demos</a>
                <a href="{{ route('tasks.index') }}" class="hover:text-blue-400 transition">Tarefas</a>
            </div>
        </div>
    </nav>

    <!-- Container Principal -->
    <div class="min-h-screen p-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Messages de Sucesso -->
            @if($message = session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-300">
                    {{ $message }}
                </div>
            @endif

            @if($message = session('error'))
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-300">
                    {{ $message }}
                </div>
            @endif

            <!-- Conteúdo -->
            @yield('content')
        </div>
    </div>

</body>
</html>
