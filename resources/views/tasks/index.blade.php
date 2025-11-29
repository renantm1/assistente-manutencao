@extends('layouts.app')

@section('title', 'Tarefas')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-4xl font-bold mb-2">✅ Tarefas Pessoais</h1>
        <p class="text-slate-400">Total: {{ $tasks->count() }} | Ativas: {{ $tarefasAtivas }}</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
        ➕ Nova Tarefa
    </a>
</div>

<!-- Tarefas em Colunas (Kanban-style) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- Coluna: A Fazer -->
    <div class="bg-slate-800 border border-slate-700 rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4 pb-4 border-b border-slate-700">📋 A Fazer</h2>
        <div class="space-y-3">
            @forelse($tasks->where('status', 'todo') as $task)
                <div class="bg-slate-700/50 p-4 rounded hover:bg-slate-700 transition cursor-pointer">
                    <p class="font-semibold">{{ $task->titulo }}</p>
                    <p class="text-xs text-slate-400 mt-1">
                        @if($task->prioridade == 'alta')
                            🔴 Prioridade Alta
                        @elseif($task->prioridade == 'media')
                            🟡 Prioridade Média
                        @else
                            🟢 Prioridade Baixa
                        @endif
                    </p>
                    @if($task->data_vencimento)
                        <p class="text-xs text-slate-400 mt-1">📅 {{ $task->data_vencimento->format('d/m/Y') }}</p>
                    @endif
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-sm text-blue-400 hover:text-blue-300">✏️ Editar</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm text-red-400 hover:text-red-300">🗑️ Deletar</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-slate-500 text-center py-4">Nenhuma tarefa</p>
            @endforelse
        </div>
    </div>

    <!-- Coluna: Em Progresso -->
    <div class="bg-slate-800 border border-slate-700 rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4 pb-4 border-b border-slate-700">🔄 Em Progresso</h2>
        <div class="space-y-3">
            @forelse($tasks->where('status', 'em_progresso') as $task)
                <div class="bg-slate-700/50 p-4 rounded hover:bg-slate-700 transition cursor-pointer">
                    <p class="font-semibold">{{ $task->titulo }}</p>
                    <p class="text-xs text-slate-400 mt-1">
                        @if($task->prioridade == 'alta')
                            🔴 Prioridade Alta
                        @elseif($task->prioridade == 'media')
                            🟡 Prioridade Média
                        @else
                            🟢 Prioridade Baixa
                        @endif
                    </p>
                    @if($task->data_vencimento)
                        <p class="text-xs text-slate-400 mt-1">📅 {{ $task->data_vencimento->format('d/m/Y') }}</p>
                    @endif
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-sm text-blue-400 hover:text-blue-300">✏️ Editar</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm text-red-400 hover:text-red-300">🗑️ Deletar</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-slate-500 text-center py-4">Nenhuma tarefa</p>
            @endforelse
        </div>
    </div>

    <!-- Coluna: Concluída -->
    <div class="bg-slate-800 border border-slate-700 rounded-lg p-6">
        <h2 class="text-lg font-bold mb-4 pb-4 border-b border-slate-700">✅ Concluída</h2>
        <div class="space-y-3">
            @forelse($tasks->where('status', 'concluida') as $task)
                <div class="bg-slate-700/50 p-4 rounded hover:bg-slate-700 transition cursor-pointer opacity-75">
                    <p class="font-semibold line-through">{{ $task->titulo }}</p>
                    <p class="text-xs text-slate-400 mt-1">🎉 Concluída!</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-sm text-blue-400 hover:text-blue-300">✏️ Editar</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-sm text-red-400 hover:text-red-300">🗑️ Deletar</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-slate-500 text-center py-4">Nenhuma tarefa</p>
            @endforelse
        </div>
    </div>

</div>

@endsection
