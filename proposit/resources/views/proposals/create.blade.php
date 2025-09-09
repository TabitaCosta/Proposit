@extends('layouts.app')

@section('title', 'Criar Proposta')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Criar Nova Proposta</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('proposals.store') }}" method="POST">
                @csrf

                {{-- Título --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Digite o título da proposta" required>
                </div>

                {{-- Resumo --}}
                <div class="mb-3">
                    <label for="abstract" class="form-label">Resumo</label>
                    <textarea name="abstract" id="abstract" class="form-control" rows="3" placeholder="Escreva um resumo da proposta" required></textarea>
                </div>

                {{-- Detalhes --}}
                <div class="mb-3">
                    <label for="details" class="form-label">Detalhes</label>
                    <textarea name="details" id="details" class="form-control" rows="4" placeholder="Adicione detalhes adicionais"></textarea>
                </div>

                <div class="row">
                    {{-- Palestrante --}}
                    <div class="col-md-4 mb-3">
                        <label for="user_id" class="form-label">Palestrante</label>
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="" disabled selected>Selecione um palestrante</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Evento --}}
                    <div class="col-md-4 mb-3">
                        <label for="event_id" class="form-label">Evento</label>
                        <select name="event_id" id="event_id" class="form-select" required>
                            <option value="" disabled selected>Selecione um evento</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4 mb-3">
                        <label for="proposal_status_id" class="form-label">Status</label>
                        <select name="proposal_status_id" id="proposal_status_id" class="form-select">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Botão --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('proposals.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button class="btn btn-success">Salvar Proposta</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
