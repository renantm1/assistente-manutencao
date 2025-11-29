@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Cabeçalho --}}
    <div class="mb-6 flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-white">
                Olá, Renan 👋
            </h1>
            <p class="mt-1 text-sm text-slate-400">
                Hoje é {{ now()->format('d/m/Y') }} — aqui está um resumo das suas OMs, demos e tarefas.
            </p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('om.create') }}"
               class="inline-flex items-center gap-2 rounded-md bg-blue-600 px-3 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-500 transition">
                <span>＋</span>
                <span>Nova OM</span>
            </a>
            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center gap-2 rounded-md border border-slate-700 px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 transition">
                <span>＋</span>
                <span>Nova tarefa</span>
            </a>
        </div>
    </div>

    {{-- Cards resumo --}}
    <div class="mb-6 grid gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-slate-800 bg-slate-900/60 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">OMs pendentes</p>
                    <p class="mt-2 text-3xl font-semibold text-amber-300">
                        {{ $omsPendentes ?? 0 }}
                    </p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-amber-500/10 text-amber-300">
                    ⚙️
                </span>
            </div>
        </div>

        <div class="rounded-xl border border-slate-800 bg-slate-900/60 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Demos hoje</p>
                    <p class="mt-2 text-3xl font-semibold text-sky-300">
                        {{ $demosHoje ?? 0 }}
                    </p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-sky-500/10 text-sky-300">
                    📊
                </span>
            </div>
        </div>

        <div class="rounded-xl border border-slate-800 bg-slate-900/60 p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">Tarefas ativas</p>
                    <p class="mt-2 text-3xl font-semibold text-emerald-300">
                        {{ $tarefasAtivas ?? 0 }}
                    </p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-300">
                    ✅
                </span>
            </div>
        </div>
    </div>

    {{-- Próximas OMs --}}
    <div class="mt-4 rounded-xl border border-slate-800 bg-slate-900/60 p-4">
        <div class="mb-3 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-100">Próximas OMs</h2>
            <span class="text-xs text-slate-500">
                {{ ($omsProximas ?? collect())->count() }} encontradas
            </span>
        </div>

        @if(!empty($omsProximas) && count($omsProximas))
            <div class="space-y-2">
                @foreach($omsProximas as $om)
                    <div class="flex items-center justify-between rounded-lg border border-slate-800/70 bg-slate-900/60 px-3 py-2 text-sm hover:border-slate-600 transition">
                        <div>
                            <p class="font-medium text-slate-100">
                                {{ $om->numero_om }}
                            </p>
                            <p class="text-xs text-slate-400">
                                {{ $om->maquina }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                @php
                                    $venc = $om->data_vencimento;
                                @endphp
                                @if($venc->isPast() && !$venc->isToday())
                                    <p class="text-xs font-medium text-rose-300">Vencida</p>
                                @elseif($venc->isToday())
                                    <p class="text-xs font-medium text-amber-300">Vence hoje</p>
                                @else
                                    <p class="text-xs font-medium text-emerald-300">
                                        {{ $venc->diffForHumans() }}
                                    </p>
                                @endif
                                <p class="text-[11px] text-slate-500">
                                    {{ $venc->format('d/m/Y') }}
                                </p>
                            </div>

                            <a href="{{ route('om.edit', $om->id) }}"
                               class="inline-flex items-center rounded-md bg-slate-800 px-3 py-1.5 text-xs font-medium text-slate-100 hover:bg-slate-700 transition">
                                Abrir
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="py-6 text-center text-sm text-slate-500">
                Nenhuma OM pendente no momento.
            </p>
        @endif
    </div>
@endsection
