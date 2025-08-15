<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
        'proposal_status_id',
        'title',
        'abstract',
        'details'
    ];

    // Evento associado à proposta
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // Usuário (palestrante) que submeteu a proposta
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Status da proposta
    public function status(): BelongsTo
    {
        return $this->belongsTo(ProposalStatus::class, 'proposal_status_id');
    }
}
