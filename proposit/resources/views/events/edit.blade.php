@extends('layouts.app')

@section('title', 'Editar Evento')

@section('content')
<h1>Editar Evento</h1>

<form action="{{ route('events.update', $event) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea name="description" id="description" class="form-control">{{ $event->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Data de Início</label>
        <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') }}" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">Data de Fim</label>
        <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '' }}">
    </div>
    <button class="btn btn-success">Atualizar</button>
</form>
@endsection
