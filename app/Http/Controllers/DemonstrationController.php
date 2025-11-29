<?php

namespace App\Http\Controllers;

use App\Models\Demonstration;
use Illuminate\Http\Request;

class DemonstrationController extends Controller
{
    public function index()
    {
        $demos = Demonstration::orderBy('data_hora')->get();
        $demosHoje = Demonstration::hoje()->agendadas()->count();

        return view('demonstrations.index', compact('demos', 'demosHoje'));
    }

    public function create()
    {
        return view('demonstrations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required',
            'cliente' => 'required',
            'maquina' => 'required',
            'data_hora' => 'required|date_format:Y-m-d H:i',
            'notas' => 'nullable',
        ]);

        Demonstration::create($validated);

        return redirect()->route('demonstrations.index')->with('success', '✅ Demo agendada!');
    }

    public function edit($id)
    {
        $demo = Demonstration::findOrFail($id);
        return view('demonstrations.edit', compact('demo'));
    }

    public function update(Request $request, $id)
    {
        $demo = Demonstration::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required',
            'cliente' => 'required',
            'maquina' => 'required',
            'data_hora' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:agendada,realizada,cancelada',
            'notas' => 'nullable',
        ]);

        $demo->update($validated);

        return redirect()->route('demonstrations.index')->with('success', '✅ Demo atualizada!');
    }

    public function destroy($id)
    {
        Demonstration::findOrFail($id)->delete();
        return redirect()->route('demonstrations.index')->with('success', '✅ Demo deletada!');
    }
}
