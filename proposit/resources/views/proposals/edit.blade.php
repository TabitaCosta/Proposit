@extends('layouts.app')

@section('title', 'Editar Proposta')

@section('content')
<h1>Editar Proposta</h1>

<form action="{{ route('proposals.update', $proposal) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $proposal->title }}" required>
    </div>
    <div class="mb-3">
        <label for="abstract" class="form-label">Resumo</label>
        <textarea name="abstract" id="abstract" class="form-control" required>{{ $proposal->abstract }}</textarea>
    </div>
    <div class="mb-3">
        <label for="details" class="form-label">Detalhes</label>
        <textarea name="details" id="details" class="form-control">{{ $proposal->details }}</textarea>
    </div>
    <div class="mb-3">
        <label for="user_id" class="form-label">Palestrante</label>
        <select name="user_id" id="user_id" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $proposal->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="event_id" class="form-label">Evento</label>
        <select name="event_id" id="event_id" class="form-control" required>
            @foreach($events as $event)
                <option value="{{ $event->id }}" {{ $proposal->event_id == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="proposal_status_id" class="form-label">Status</label>
        <select name="proposal_status_id" id="proposal_status_id" class="form-control">
            @foreach($statuses as $status)
                <option value="{{ $status->id }}" {{ $proposal->proposal_status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Atualizar</button>
</form>
@endsection
