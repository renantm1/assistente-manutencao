<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_om',
        'maquina',
        'descricao',
        'status',
        'data_vencimento',
        'notas',
    ];

    protected $casts = [
        'data_vencimento' => 'date',
    ];

    // Scope para OMs pendentes
    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    // Scope para OMs vencidas
    public function scopeVencidas($query)
    {
        return $query->where('data_vencimento', '<', now()->toDateString());
    }
}
