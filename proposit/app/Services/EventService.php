<?php

namespace App\Services;

use App\Repositories\EventRepository;
use App\DTOs\EventDTO;
use Illuminate\Support\Facades\DB;

class EventService
{
    protected $repo;

    public function __construct(EventRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getById(int $id)
    {
        return $this->repo->getById($id);
    }

    public function create(EventDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            return $this->repo->create($dto->toArray());
        });
    }

    public function update($event, EventDTO $dto)
    {
        return DB::transaction(function () use ($event, $dto) {
            return $this->repo->update($event, $dto->toArray());
        });
    }

    public function delete($event)
    {
        return $this->repo->delete($event);
    }
}
