<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\ProposalStatus;

class ProposalController extends Controller
{
    // Lista todas as propostas
    public function index()
    {
        $proposals = Proposal::with(['user', 'event', 'status'])->get();
        return view('proposals.index', compact('proposals'));
    }

    // Mostra o formulário para criar uma nova proposta
    public function create()
    {
        $users = User::all();
        $events = Event::all();
        $statuses = ProposalStatus::all();
        return view('proposals.create', compact('users', 'events', 'statuses'));
    }

    // Salva a nova proposta no banco
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'proposal_status_id' => 'nullable|exists:proposal_statuses,id',
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'details' => 'nullable|string',
        ]);

        // Definir status padrão "pendente" se não informado
        if (!isset($data['proposal_status_id'])) {
            $data['proposal_status_id'] = 1; // pendente
        }

        Proposal::create($data);

        return redirect()->route('proposals.index')->with('success', 'Proposta criada com sucesso!');
    }

    // Mostra o formulário para editar uma proposta
    public function edit(Proposal $proposal)
    {
        $users = User::all();
        $events = Event::all();
        $statuses = ProposalStatus::all();
        return view('proposals.edit', compact('proposal', 'users', 'events', 'statuses'));
    }

    // Atualiza a proposta no banco
    public function update(Request $request, Proposal $proposal)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id',
            'proposal_status_id' => 'required|exists:proposal_statuses,id',
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'details' => 'nullable|string',
        ]);

        $proposal->update($data);

        return redirect()->route('proposals.index')->with('success', 'Proposta atualizada com sucesso!');
    }

    // Deleta a proposta
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposta excluída com sucesso!');
    }

    // (Opcional) Mostra detalhes da proposta
    public function show(Proposal $proposal)
    {
        return view('proposals.show', compact('proposal'));
    }
}
