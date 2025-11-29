@extends('layouts.app-with-sidebar')

@section('page-title', 'Dashboard')

@section('content')
    {{-- Top section: Resumo rápido --}}
    <div class="grid gap-4 mb-6 md:grid-cols-3">
        {{-- OMs Pendentes --}}
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">OMs Pendentes</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $omsPendentes ?? 0 }}</p>
                    <p class="mt-1 text-xs text-slate-500">
                        @if(($omsPendentes ?? 0) > 3)
                            ⚠️ Ação necessária
                        @else
                            ✅ Sob controle
                        @endif
                    </p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100 text-xl">
                    ⚙️
                </div>
            </div>
        </div>

        {{-- Demos Hoje --}}
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Demos Agendadas</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $demosHoje ?? 0 }}</p>
                    <p class="mt-1 text-xs text-slate-500">Para hoje</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100 text-xl">
                    📊
                </div>
            </div>
        </div>

        {{-- Tarefas Ativas --}}
        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">Tarefas Ativas</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $tarefasAtivas ?? 0 }}</p>
                    <p class="mt-1 text-xs text-slate-500">Em progresso</p>
                </div>
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-100 text-xl">
                    ✅
                </div>
            </div>
        </div>
    </div>

    {{-- Próximas OMs --}}
    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="text-base font-semibold text-slate-900">Próximas OMs</h2>
                <p class="text-sm text-slate-500 mt-1">Ordens que precisam de atenção</p>
            </div>
            <a href="{{ route('om.create') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                Ver todas →
            </a>
        </div>

        @if(!empty($omsProximas) && count($omsProximas))
            <div class="space-y-3">
                @foreach($omsProximas as $om)
                    <div class="flex items-center justify-between rounded-lg border border-slate-100 bg-slate-50 px-4 py-3 hover:bg-slate-100 transition">
                        <div class="flex items-center gap-3">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-lg">
                                ⚙️
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">{{ $om->numero_om }}</p>
                                <p class="text-sm text-slate-500">{{ $om->maquina }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                @php $venc = $om->data_vencimento; @endphp
                                @if($venc->isPast() && !$venc->isToday())
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                                        Vencida
                                    </span>
                                @elseif($venc->isToday())
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                        Vence hoje
                                    </span>
                                @else
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        {{ $venc->diffForHumans() }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('om.edit', $om->id) }}"
                               class="inline-flex items-center gap-1 rounded-lg border border-slate-300 px-3 py-1.5 text-sm font-medium text-slate-700 hover:bg-slate-100 transition">
                                Abrir
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-8 text-center">
                <p class="text-sm text-slate-500">
                    Nenhuma OM pendente no momento. Ótimo trabalho! 🎉
                </p>
            </div>
        @endif
    </div>
@endsection
