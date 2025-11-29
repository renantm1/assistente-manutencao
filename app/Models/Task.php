<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'prioridade',
        'status',
        'data_vencimento',
    ];

    protected $casts = [
        'data_vencimento' => 'date',
    ];

    // Scope para tarefas ativas
    public function scopeAtivas($query)
    {
        return $query->whereIn('status', ['todo', 'em_progresso']);
    }
}
