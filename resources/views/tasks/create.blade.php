@extends('layouts.app')

@section('title', 'Nova Tarefa')

@section('content')

<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">Criar Nova Tarefa</h1>
    <a href="{{ route('tasks.index') }}" class="text-blue-400 hover:underline">← Voltar</a>
</div>

<div class="bg-slate-800 border border-slate-700 rounded-lg p-8 max-w-2xl">
    <form method="POST" action="{{ route('tasks.store') }}" class="space-y-6">
        @csrf

        <!-- Título -->
        <div>
            <label class="block text-sm font-semibold mb-2">Título da Tarefa *</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" 
                   placeholder="ex: Revisar relatório de OMs" required>
            @error('titulo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Descrição -->
        <div>
            <label class="block text-sm font-semibold mb-2">Descrição (Opcional)</label>
            <textarea name="descricao" rows="4" 
                      class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" 
                      placeholder="Descreva a tarefa em detalhes">{{ old('descricao') }}</textarea>
            @error('descricao') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Prioridade -->
        <div>
            <label class="block text-sm font-semibold mb-2">Prioridade *</label>
            <select name="prioridade" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                <option value="baixa" @selected(old('prioridade') == 'baixa')>🟢 Baixa</option>
                <option value="media" @selected(old('prioridade') == 'media' || !old('prioridade'))>🟡 Média</option>
                <option value="alta" @selected(old('prioridade') == 'alta')>🔴 Alta</option>
            </select>
            @error('prioridade') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Data Vencimento -->
        <div>
            <label class="block text-sm font-semibold mb-2">Data Vencimento (Opcional)</label>
            <input type="date" name="data_vencimento" value="{{ old('data_vencimento') }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500">
            @error('data_vencimento') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Botões -->
        <div class="flex gap-4">
            <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                ✅ Criar Tarefa
            </button>
            <a href="{{ route('tasks.index') }}" class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg font-semibold text-center transition">
                ❌ Cancelar
            </a>
        </div>
    </form>
</div>

@endsection
