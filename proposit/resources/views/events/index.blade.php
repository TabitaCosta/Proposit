@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Eventos</h1>
    <a href="{{ route('events.create') }}" class="btn btn-primary">Criar Evento</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Início</th>
            <th>Fim</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ $event->start_date }}</td>
            <td>{{ $event->end_date ?? '-' }}</td>
            <td>
                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
