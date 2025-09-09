<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Services\EventService;
use App\DTOs\EventDTO;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
        $this->middleware('auth'); // só usuários logados
    }

    public function index()
    {
        $events = $this->eventService->getAll();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Cria DTO com user_id do criador
        $dto = new EventDTO(array_merge($data, [
            'user_id' => $request->user()->id
        ]));

        $event = $this->eventService->create($dto);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event); // só dono pode editar

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $dto = new EventDTO($data);

        $this->eventService->update($event, $dto);

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $this->eventService->delete($event);

        return redirect()->route('events.index')->with('success', 'Evento removido com sucesso!');
    }
}
