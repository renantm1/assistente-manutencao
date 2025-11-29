<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Assistente de Manutenção')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">

    {{-- Top bar --}}
    <header class="border-b border-slate-800 bg-slate-950/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-500/10 text-blue-400">
                    🛠
                </span>
                <div>
                    <p class="text-sm font-semibold tracking-tight">Assistente de Manutenção</p>
                    <p class="text-xs text-slate-400">Seu painel pessoal</p>
                </div>
            </a>

            <nav class="flex items-center gap-4 text-sm">
                <a href="{{ route('dashboard') }}"
                   class="rounded-md px-3 py-1.5 text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    Dashboard
                </a>
                <a href="{{ route('om.index') }}"
                   class="rounded-md px-3 py-1.5 text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    OMs
                </a>
                <a href="{{ route('demonstrations.index') }}"
                   class="rounded-md px-3 py-1.5 text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    Demos
                </a>
                <a href="{{ route('tasks.index') }}"
                   class="rounded-md px-3 py-1.5 text-slate-300 hover:bg-slate-800 hover:text-white transition">
                    Tarefas
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-6">
        {{-- Alerts --}}
        @if($message = session('success'))
            <div class="mb-4 rounded-md border border-emerald-500/40 bg-emerald-500/10 px-4 py-2 text-sm text-emerald-200">
                {{ $message }}
            </div>
        @endif
        @if($message = session('error'))
            <div class="mb-4 rounded-md border border-rose-500/40 bg-rose-500/10 px-4 py-2 text-sm text-rose-200">
                {{ $message }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
