<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demonstration extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'cliente',
        'maquina',
        'data_hora',
        'status',
        'notas',
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    // Scope para demos de hoje
    public function scopeHoje($query)
    {
        return $query->whereDate('data_hora', now()->toDateString());
    }

    // Scope para demos agendadas
    public function scopeAgendadas($query)
    {
        return $query->where('status', 'agendada');
    }
}
