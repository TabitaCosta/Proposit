<?php

namespace App\DTOs;

class EventDTO
{
    public string $name;
    public ?string $description;
    public string $start_date;
    public ?string $end_date;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->description = $data['description'] ?? null;
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
