<?php

namespace App\DTOs;

class ProposalDTO
{
    public int $event_id;
    public int $user_id;
    public ?int $proposal_status_id;
    public string $title;
    public string $abstract;
    public ?string $details;

    public function __construct(array $data)
    {
        $this->event_id = $data['event_id'];
        $this->user_id = $data['user_id'];
        $this->proposal_status_id = $data['proposal_status_id'] ?? 1; // padrão "pendente"
        $this->title = $data['title'];
        $this->abstract = $data['abstract'];
        $this->details = $data['details'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'event_id' => $this->event_id,
            'user_id' => $this->user_id,
            'proposal_status_id' => $this->proposal_status_id,
            'title' => $this->title,
            'abstract' => $this->abstract,
            'details' => $this->details,
        ];
    }
}
