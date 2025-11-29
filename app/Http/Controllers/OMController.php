<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceOrder;
use Illuminate\Http\Request;

class OMController extends Controller
{
    // Listar todas as OMs
    public function index()
    {
        $oms = MaintenanceOrder::orderBy('data_vencimento')->get();
        $omsPendentes = MaintenanceOrder::pendentes()->count();
        $omsVencidas = MaintenanceOrder::vencidas()->count();

        return view('om.index', compact('oms', 'omsPendentes', 'omsVencidas'));
    }

    // Formulário para criar OM
    public function create()
    {
        return view('om.create');
    }

    // Salvar OM no banco
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_om' => 'required|unique:maintenance_orders',
            'maquina' => 'required',
            'descricao' => 'required',
            'data_vencimento' => 'required|date',
            'notas' => 'nullable',
        ]);

        MaintenanceOrder::create($validated);

        return redirect()->route('om.index')->with('success', '✅ OM criada com sucesso!');
    }

    // Editar OM
    public function edit($id)
    {
        $om = MaintenanceOrder::findOrFail($id);
        return view('om.edit', compact('om'));
    }

    // Atualizar OM
    public function update(Request $request, $id)
    {
        $om = MaintenanceOrder::findOrFail($id);

        $validated = $request->validate([
            'numero_om' => 'required|unique:maintenance_orders,numero_om,' . $id,
            'maquina' => 'required',
            'descricao' => 'required',
            'status' => 'required|in:pendente,em_andamento,concluida',
            'data_vencimento' => 'required|date',
            'notas' => 'nullable',
        ]);

        $om->update($validated);

        return redirect()->route('om.index')->with('success', '✅ OM atualizada!');
    }

    // Deletar OM
    public function destroy($id)
    {
        MaintenanceOrder::findOrFail($id)->delete();
        return redirect()->route('om.index')->with('success', '✅ OM deletada!');
    }
}
