<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Lista todos os eventos
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Mostra o formulário para criar um novo evento
    public function create()
    {
        return view('events.create');
    }

    // Salva o novo evento no banco
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    // Mostra um evento específico (opcional, pode usar apenas index)
    public function show(Event $event)
    {
        return view('events.show', compact('event')); // se criar view show
    }

    // Mostra o formulário para editar o evento
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Atualiza o evento no banco
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    // Deleta o evento
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }
}
