@extends('layouts.app')

@section('title', 'Editar Ordem de Manutenção')

@section('content')

<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">Editar OM #{{ $om->numero_om }}</h1>
    <a href="{{ route('om.index') }}" class="text-blue-400 hover:underline">← Voltar</a>
</div>

<div class="bg-slate-800 border border-slate-700 rounded-lg p-8 max-w-2xl">
    <form method="POST" action="{{ route('om.update', $om->id) }}" class="space-y-6">
        @csrf @method('PUT')

        <!-- Número OM -->
        <div>
            <label class="block text-sm font-semibold mb-2">Número OM *</label>
            <input type="text" name="numero_om" value="{{ old('numero_om', $om->numero_om) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('numero_om') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Máquina -->
        <div>
            <label class="block text-sm font-semibold mb-2">Máquina *</label>
            <input type="text" name="maquina" value="{{ old('maquina', $om->maquina) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('maquina') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Descrição -->
        <div>
            <label class="block text-sm font-semibold mb-2">Descrição *</label>
            <textarea name="descricao" rows="4" 
                      class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>{{ old('descricao', $om->descricao) }}</textarea>
            @error('descricao') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-semibold mb-2">Status *</label>
            <select name="status" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                <option value="pendente" @selected(old('status', $om->status) == 'pendente')>⏳ Pendente</option>
                <option value="em_andamento" @selected(old('status', $om->status) == 'em_andamento')>🔄 Em Andamento</option>
                <option value="concluida" @selected(old('status', $om->status) == 'concluida')>✅ Concluída</option>
            </select>
            @error('status') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Data Vencimento -->
        <div>
            <label class="block text-sm font-semibold mb-2">Data Vencimento *</label>
            <input type="date" name="data_vencimento" value="{{ old('data_vencimento', $om->data_vencimento->format('Y-m-d')) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('data_vencimento') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Notas -->
        <div>
            <label class="block text-sm font-semibold mb-2">Notas (Opcional)</label>
            <textarea name="notas" rows="3" 
                      class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500">{{ old('notas', $om->notas) }}</textarea>
        </div>

        <!-- Botões -->
        <div class="flex gap-4">
            <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                ✅ Atualizar OM
            </button>
            <a href="{{ route('om.index') }}" class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg font-semibold text-center transition">
                ❌ Cancelar
            </a>
        </div>
    </form>
</div>

@endsection
