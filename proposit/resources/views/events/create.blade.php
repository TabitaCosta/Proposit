@extends('layouts.app')

@section('title', 'Criar Evento')

@section('content')
<h1>Criar Evento</h1>

<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="start_date" class="form-label">Data de Início</label>
        <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="end_date" class="form-label">Data de Fim</label>
        <input type="datetime-local" name="end_date" id="end_date" class="form-control">
    </div>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection
