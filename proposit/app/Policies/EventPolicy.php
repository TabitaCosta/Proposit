<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    // Apenas o dono do evento pode editar
    public function update(User $user, Event $event)
    {
        return $user->id === $event->user_id
            ? Response::allow()
            : Response::deny('Você não pode editar este evento.');
    }

    // Apenas o dono do evento pode deletar
    public function delete(User $user, Event $event)
    {
        return $user->id === $event->user_id
            ? Response::allow()
            : Response::deny('Você não pode deletar este evento.');
    }

    // Qualquer usuário logado pode ver detalhes do evento
    public function view(User $user, Event $event)
    {
        return Response::allow();
    }

    // Qualquer usuário logado pode listar eventos
    public function viewAny(User $user)
    {
        return Response::allow();
    }
}
