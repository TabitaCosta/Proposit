@extends('layouts.app')

@section('title', 'Criar Papel')

@section('content')
<h1>Criar Papel</h1>

<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <button class="btn btn-success">Salvar</button>
</form>
@endsection
