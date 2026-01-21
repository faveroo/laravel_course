<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    const STATUS_PENDENTE = 'pendente';
    const STATUS_EM_ANDAMENTO = 'andamento';
    const STATUS_CONCLUIDO = 'concluida';

    protected $fillable = [
        'title',
        'description',
        'status',
        'project_id',
        'assigned_to'
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function scopePendentes($query)
    {
        return $query->where('status', self::STATUS_PENDENTE);
    }

    public function scopeEmAndamento($query)
    {
        return $query->where('status', self::STATUS_EM_ANDAMENTO);
    }

    public function scopeConcluidas($query)
    {
        return $query->where('status', self::STATUS_CONCLUIDO);
    }
}
