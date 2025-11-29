<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OMController;
use App\Http\Controllers\DemonstrationController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    $omsPendentes = \App\Models\MaintenanceOrder::pendentes()->count();
    $demosHoje = \App\Models\Demonstration::hoje()->agendadas()->count();
    $tarefasAtivas = \App\Models\Task::ativas()->count();
    $omsProximas = \App\Models\MaintenanceOrder::where('status', '!=', 'concluida')
        ->orderBy('data_vencimento')
        ->limit(5)
        ->get();

    return view('dashboard-new', compact('omsPendentes', 'demosHoje', 'tarefasAtivas', 'omsProximas'));
})->name('dashboard');

Route::resource('om', OMController::class);
Route::resource('demonstrations', DemonstrationController::class);
Route::resource('tasks', TaskController::class);
