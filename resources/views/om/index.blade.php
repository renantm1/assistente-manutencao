@extends('layouts.app')

@section('title', 'Ordens de Manutenção')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-4xl font-bold mb-2">Ordens de Manutenção</h1>
        <p class="text-slate-400">Total: {{ $oms->count() }} | Pendentes: {{ $omsPendentes }} | Vencidas: {{ $omsVencidas }}</p>
    </div>
    <a href="{{ route('om.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold transition">
        ➕ Nova OM
    </a>
</div>

<!-- Tabela de OMs -->
<div class="bg-slate-800 border border-slate-700 rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-700 border-b border-slate-600">
            <tr>
                <th class="px-6 py-3 text-left">Número</th>
                <th class="px-6 py-3 text-left">Máquina</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Vencimento</th>
                <th class="px-6 py-3 text-left">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
            @forelse($oms as $om)
                <tr class="hover:bg-slate-700/50 transition">
                    <td class="px-6 py-4 font-semibold">{{ $om->numero_om }}</td>
                    <td class="px-6 py-4">{{ $om->maquina }}</td>
                    <td class="px-6 py-4">
                        @if($om->status == 'pendente')
                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-300 rounded-full text-xs font-semibold">⏳ Pendente</span>
                        @elseif($om->status == 'em_andamento')
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-semibold">🔄 Em Andamento</span>
                        @else
                            <span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-xs font-semibold">✅ Concluída</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="@if($om->data_vencimento->isPast()) text-red-400 @else text-slate-300 @endif">
                            {{ $om->data_vencimento->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('om.edit', $om->id) }}" class="text-blue-400 hover:text-blue-300">✏️ Editar</a>
                        <form method="POST" action="{{ route('om.destroy', $om->id) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">🗑️ Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                        Nenhuma OM cadastrada. <a href="{{ route('om.create') }}" class="text-blue-400 hover:underline">Criar uma nova</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
