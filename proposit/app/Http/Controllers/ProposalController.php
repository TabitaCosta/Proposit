<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProposalService;
use App\DTOs\ProposalDTO;
use App\Models\User;
use App\Models\Event;
use App\Models\ProposalStatus;
use App\Models\Proposal; 

class ProposalController extends Controller
{
    protected $proposalService;

    public function __construct(ProposalService $proposalService)
    {
        $this->proposalService = $proposalService;
        $this->middleware('auth'); // garante que só usuários logados acessem
    }

    public function index()
    {
        $proposals = $this->proposalService->getAll();
        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        $users = User::all(); 
        $events = Event::all(); 
        $statuses = ProposalStatus::all(); // buscar todos os status

        return view('proposals.create', compact('users', 'events', 'statuses'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'abstract' => 'required|string',
            'details' => 'nullable|string',
            'event_id' => 'required|exists:events,id',
        ]);

        // Cria DTO e atribui o usuário logado
        $dto = new ProposalDTO(array_merge($data, [
            'user_id' => $request->user()->id,
            'proposal_status_id' => 1, // status inicial
        ]));

        $proposal = $this->proposalService->create($dto);

        return redirect()->route('proposals.index')->with('success', 'Proposta criada com sucesso!');
    }

    public function edit(Proposal $proposal)
    {
        $proposal->load('event'); // garante que a relação está carregada

        // Só dono do evento pode editar
        if (auth()->id() !== $proposal->event->user_id) {
            abort(403, 'Você não tem permissão para editar esta proposta.');
        }

        $statuses = ProposalStatus::all();

        return view('proposals.edit', compact('proposal', 'statuses'));
    }


    public function update(Request $request, Proposal $proposal)
    {
        $proposal->load('event'); // garante que a relação está carregada

        if (auth()->id() !== $proposal->event->user_id) {
            abort(403, 'Você não tem permissão para atualizar esta proposta.');
        }

        $data = $request->validate([
            'proposal_status_id' => 'required|exists:proposal_statuses,id',
        ]);

        $proposal->update($data);

        return redirect()->route('proposals.index')->with('success', 'Status atualizado com sucesso!');
}


    public function changeStatus(Request $request, Proposal $proposal)
    {
        $this->authorize('changeStatus', $proposal);

        $data = $request->validate([
            'proposal_status_id' => 'required|exists:proposal_statuses,id',
        ]);

        $dto = new ProposalDTO($data);

        $this->proposalService->update($proposal, $dto);

        return redirect()->route('proposals.index')->with('success', 'Status da proposta atualizado!');
    }

    public function destroy(Proposal $proposal)
    {
        $this->authorize('delete', $proposal);

        $this->proposalService->delete($proposal);

        return redirect()->route('proposals.index')->with('success', 'Proposta removida com sucesso!');
    }

    public function show(Proposal $proposal)
    {
        return view('proposals.show', compact('proposal'));
    }
}
