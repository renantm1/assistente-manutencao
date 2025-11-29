@extends('layouts.app')

@section('title', 'Editar Demonstração')

@section('content')

<div class="mb-8">
    <h1 class="text-4xl font-bold mb-2">Editar Demo: {{ $demo->titulo }}</h1>
    <a href="{{ route('demonstrations.index') }}" class="text-blue-400 hover:underline">← Voltar</a>
</div>

<div class="bg-slate-800 border border-slate-700 rounded-lg p-8 max-w-2xl">
    <form method="POST" action="{{ route('demonstrations.update', $demo->id) }}" class="space-y-6">
        @csrf @method('PUT')

        <!-- Título -->
        <div>
            <label class="block text-sm font-semibold mb-2">Título *</label>
            <input type="text" name="titulo" value="{{ old('titulo', $demo->titulo) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('titulo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Cliente -->
        <div>
            <label class="block text-sm font-semibold mb-2">Cliente *</label>
            <input type="text" name="cliente" value="{{ old('cliente', $demo->cliente) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('cliente') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Máquina -->
        <div>
            <label class="block text-sm font-semibold mb-2">Máquina *</label>
            <input type="text" name="maquina" value="{{ old('maquina', $demo->maquina) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('maquina') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Data e Hora -->
        <div>
            <label class="block text-sm font-semibold mb-2">Data e Hora *</label>
            <input type="datetime-local" name="data_hora" value="{{ old('data_hora', $demo->data_hora->format('Y-m-d\TH:i')) }}" 
                   class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            @error('data_hora') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-semibold mb-2">Status *</label>
            <select name="status" class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                <option value="agendada" @selected(old('status', $demo->status) == 'agendada')>📅 Agendada</option>
                <option value="realizada" @selected(old('status', $demo->status) == 'realizada')>✅ Realizada</option>
                <option value="cancelada" @selected(old('status', $demo->status) == 'cancelada')>❌ Cancelada</option>
            </select>
            @error('status') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Notas -->
        <div>
            <label class="block text-sm font-semibold mb-2">Notas</label>
            <textarea name="notas" rows="3" 
                      class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-blue-500">{{ old('notas', $demo->notas) }}</textarea>
        </div>

        <!-- Botões -->
        <div class="flex gap-4">
            <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
                ✅ Atualizar
            </button>
            <a href="{{ route('demonstrations.index') }}" class="flex-1 px-6 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg font-semibold text-center transition">
                ❌ Cancelar
            </a>
        </div>
    </form>
</div>

@endsection
