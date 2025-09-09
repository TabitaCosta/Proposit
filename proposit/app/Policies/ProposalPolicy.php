<?php

namespace App\Policies;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProposalPolicy
{
    // O dono da proposta pode editar
    public function update(User $user, Proposal $proposal)
    {
        return $user->id === $proposal->user_id;
    }

    // O organizador do evento pode mudar o status
    public function changeStatus(User $user, Proposal $proposal)
    {
        return $user->id === $proposal->event->user_id || $user->role->name === 'admin';
    }

    // Quem criou ou organizador podem deletar
    public function delete(User $user, Proposal $proposal)
    {
        return $user->id === $proposal->user_id || $user->id === $proposal->event->user_id;
    }
}