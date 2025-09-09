<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\DTOs\RoleDTO;
use Illuminate\Support\Facades\DB;

class RoleService
{
    protected $repo;

    public function __construct(RoleRepository $repo)
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

    public function create(RoleDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            return $this->repo->create($dto->toArray());
        });
    }

    public function update($role, RoleDTO $dto)
    {
        return DB::transaction(function () use ($role, $dto) {
            return $this->repo->update($role, $dto->toArray());
        });
    }

    public function delete($role)
    {
        return $this->repo->delete($role);
    }
}
