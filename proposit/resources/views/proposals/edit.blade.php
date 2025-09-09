@extends('layouts.app')

@section('title', 'Editar Proposta')

@section('content')
<h1>Editar Proposta</h1>

<div class="col-md-4 mb-3">
    <label for="proposal_status_id" class="form-label">Status</label>
    <select name="proposal_status_id" id="proposal_status_id" class="form-select">
        @foreach($statuses as $status)
            <option value="{{ $status->id }}" {{ $proposal->proposal_status_id == $status->id ? 'selected' : '' }}>
                {{ $status->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="d-flex justify-content-end mt-3">
    <a href="{{ route('proposals.index') }}" class="btn btn-secondary me-2">Cancelar</a>
    <button class="btn btn-success">Salvar</button>
</div>

@endsection
