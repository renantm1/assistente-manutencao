@extends('layouts.app')

@section('title', 'Demonstrações')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-4xl font-bold mb-2">📊 Demonstrações de Máquinas</h1>
        <p class="text-slate-400">Total: {{ $demos->count() }} | Hoje: {{ $demosHoje }}</p>
    </div>
    <a href="{{ route('demonstrations.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
        ➕ Agendar Demo
    </a>
</div>

<!-- Tabela de Demos -->
<div class="bg-slate-800 border border-slate-700 rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-700 border-b border-slate-600">
            <tr>
                <th class="px-6 py-3 text-left">Título</th>
                <th class="px-6 py-3 text-left">Cliente</th>
                <th class="px-6 py-3 text-left">Máquina</th>
                <th class="px-6 py-3 text-left">Data/Hora</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
            @forelse($demos as $demo)
                <tr class="hover:bg-slate-700/50 transition">
                    <td class="px-6 py-4 font-semibold">{{ $demo->titulo }}</td>
                    <td class="px-6 py-4">{{ $demo->cliente }}</td>
                    <td class="px-6 py-4">{{ $demo->maquina }}</td>
                    <td class="px-6 py-4">{{ $demo->data_hora->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($demo->status == 'agendada')
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-semibold">📅 Agendada</span>
                        @elseif($demo->status == 'realizada')
                            <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-xs font-semibold">✅ Realizada</span>
                        @else
                            <span class="px-3 py-1 bg-red-500/20 text-red-300 rounded-full text-xs font-semibold">❌ Cancelada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('demonstrations.edit', $demo->id) }}" class="text-blue-400 hover:text-blue-300">✏️</a>
                        <form method="POST" action="{{ route('demonstrations.destroy', $demo->id) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">
                        Nenhuma demonstração agendada. <a href="{{ route('demonstrations.create') }}" class="text-blue-400 hover:underline">Agendar uma</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
