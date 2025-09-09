<?php

namespace App\Services;

use App\Repositories\ProposalRepository;
use App\DTOs\ProposalDTO;
use Illuminate\Support\Facades\DB;

class ProposalService
{
    protected $repo;

    public function __construct(ProposalRepository $repo)
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

    public function create(ProposalDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            return $this->repo->create($dto->toArray());
        });
    }

    public function update($proposal, ProposalDTO $dto)
    {
        return DB::transaction(function () use ($proposal, $dto) {
            return $this->repo->update($proposal, $dto->toArray());
        });
    }

    public function delete($proposal)
    {
        return $this->repo->delete($proposal);
    }
}
