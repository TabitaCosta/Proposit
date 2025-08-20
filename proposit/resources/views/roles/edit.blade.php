@extends('layouts.app')

@section('title', 'Editar Papel')

@section('content')
<h1>Editar Papel</h1>

<form action="{{ route('roles.update', $role) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea name="description" id="description" class="form-control">{{ $role->description }}</textarea>
    </div>
    <button class="btn btn-success">Atualizar</button>
</form>
@endsection
