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

        return view('dashboard', compact('omsPendentes', 'demosHoje', 'tarefasAtivas', 'omsProximas'));
    })->name('dashboard');

    // Rotas para Ordem de Manutenção
    Route::resource('om', OMController::class);

    // Rotas para Demonstrações
    Route::resource('demonstrations', DemonstrationController::class);

    // Rotas para Tarefas
    Route::resource('tasks', TaskController::class);
