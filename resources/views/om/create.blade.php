@extends('layouts.app')

@section('title', 'Nova Ordem de Manutenção')

@section('content')

<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">Criar Nova OM</h1>
    <a href="{{ route('om.index') }}" class="text-blue-400 hover:underline">← Voltar</a>
</div>

<div class="bg-slate-800 border border-slate-700 rounded-lg p-8 max-w-2xl">
    <form method="POST" action="{{ route('om.store') }}" class="space-y-6">
        @csrf

        <!-- Número OM -->
        <div>
            <label class="block text-sm font-semibold mb-2">Número OM *</label>
            <input type="text" name="numero_om" value="{{ old('numero_om') }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" 
                   placeholder="OM-2025-001" required>
            @error('numero_om') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Máquina -->
        <div>
            <label class="block text-sm font-semibold mb-2">Máquina *</label>
            <input type="text" name="maquina" value="{{ old('maquina') }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" 
                   placeholder="ex: Empilhadeira MXL-500" required>
            @error('maquina') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Descrição -->
        <div>
            <label class="block text-sm font-semibold mb-2">Descrição *</label>
            <textarea name="descricao" rows="4" 
                      class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" 
                      placeholder="Descreva o problema ou manutenção necessária" required>{{ old('descricao') }}</textarea>
            @error('descricao') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Data Vencimento -->
        <div>
            <label class="block text-sm font-semibold mb-2">Data Vencimento *</label>
            <input type="date" name="data_vencimento" value="{{ old('data_vencimento') }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('data_vencimento') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Notas -->
        <div>
            <label class="block text-sm font-semibold mb-2">Notas (Opcional)</label>
            <textarea name="notas" rows="3" 
                      class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" 
                      placeholder="Informações adicionais">{{ old('notas') }}</textarea>
        </div>

        <!-- Botões -->
        <div class="flex gap-4">
            <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                ✅ Criar OM
            </button>
            <a href="{{ route('om.index') }}" class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg font-semibold text-center transition">
                ❌ Cancelar
            </a>
        </div>
    </form>
</div>

@endsection
