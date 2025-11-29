<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Assistente de Manutenção')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 antialiased">
<div class="flex h-screen overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 border-r border-slate-200 bg-white">
        <div class="flex flex-col h-full">
            {{-- Logo --}}
            <div class="border-b border-slate-200 px-6 py-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white text-lg">
                        🛠
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Assistente</p>
                        <p class="text-xs text-slate-500">Manutenção</p>
                    </div>
                </a>
            </div>

            {{-- Menu items --}}
            <nav class="flex-1 space-y-1 px-3 py-4">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                   {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    <span class="text-lg">📊</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('om.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                   {{ request()->routeIs('om.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    <span class="text-lg">⚙️</span>
                    <span>Ordens de Manutenção</span>
                </a>

                <a href="{{ route('demonstrations.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                   {{ request()->routeIs('demonstrations.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    <span class="text-lg">📺</span>
                    <span>Demonstrações</span>
                </a>

                <a href="{{ route('tasks.index') }}"
                   class="flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                   {{ request()->routeIs('tasks.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-100' }}">
                    <span class="text-lg">✅</span>
                    <span>Tarefas</span>
                </a>
            </nav>

            {{-- User profile (rodapé da sidebar) --}}
            <div class="border-t border-slate-200 p-3">
                <div class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-700 hover:bg-slate-100 transition cursor-pointer text-sm">
                    <div class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-slate-600 text-lg">
                        👤
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-slate-900">Renan</p>
                        <p class="text-xs text-slate-500 truncate">renan@exemplo.com</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    {{-- Main content --}}
    <main class="flex-1 overflow-auto bg-slate-50">
        {{-- Top bar --}}
        <div class="border-b border-slate-200 bg-white px-8 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-slate-900">
                        @yield('page-title', 'Dashboard')
                    </h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center gap-2 text-sm text-slate-600">
                        <span>{{ now()->format('d \\d\\e F') }}</span>
                    </div>
                    <button class="p-2 hover:bg-slate-100 rounded-lg transition">
                        <span class="text-lg">🔔</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Page content --}}
        <div class="p-8">
            @if($message = session('success'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    ✅ {{ $message }}
                </div>
            @endif
            @if($message = session('error'))
                <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    ❌ {{ $message }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
