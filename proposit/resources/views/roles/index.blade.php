@extends('layouts.app')

@section('title', 'Papéis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Papéis</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">Criar Papel</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
            <td>
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline">
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
