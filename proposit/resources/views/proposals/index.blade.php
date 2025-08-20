@extends('layouts.app')

@section('title', 'Propostas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Propostas</h1>
    <a href="{{ route('proposals.create') }}" class="btn btn-primary">Criar Proposta</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Título</th>
            <th>Palestrante</th>
            <th>Evento</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proposals as $proposal)
        <tr>
            <td>{{ $proposal->title }}</td>
            <td>{{ $proposal->user->name }}</td>
            <td>{{ $proposal->event->name }}</td>
            <td>{{ $proposal->status->name }}</td>
            <td>
                <a href="{{ route('proposals.edit', $proposal) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('proposals.destroy', $proposal) }}" method="POST" class="d-inline">
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
