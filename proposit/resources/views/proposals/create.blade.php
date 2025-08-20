@extends('layouts.app')

@section('title', 'Criar Proposta')

@section('content')
<h1>Criar Proposta</h1>

<form action="{{ route('proposals.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="abstract" class="form-label">Resumo</label>
        <textarea name="abstract" id="abstract" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="details" class="form-label">Detalhes</label>
        <textarea name="details" id="details" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">Palestrante</label>
        <select name="user_id" id="user_id" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="event_id" class="form-label">Evento</label>
        <select name="event_id" id="event_id" class="form-control" required>
            @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="proposal_status_id" class="form-label">Status</label>
        <select name="proposal_status_id" id="proposal_status_id" class="form-control">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection
