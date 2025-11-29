<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('data_vencimento')->get();
        $tarefasAtivas = Task::ativas()->count();

        return view('tasks.index', compact('tasks', 'tarefasAtivas'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required',
            'descricao' => 'nullable',
            'prioridade' => 'required|in:baixa,media,alta',
            'data_vencimento' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', '✅ Tarefa criada!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required',
            'descricao' => 'nullable',
            'prioridade' => 'required|in:baixa,media,alta',
            'status' => 'required|in:todo,em_progresso,concluida',
            'data_vencimento' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', '✅ Tarefa atualizada!');
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return redirect()->route('tasks.index')->with('success', '✅ Tarefa deletada!');
    }
}
