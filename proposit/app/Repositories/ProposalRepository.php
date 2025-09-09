<?php

namespace App\Repositories;

use App\Models\Proposal;

class ProposalRepository
{
    public function getAll()
    {
        return Proposal::with(['user', 'event', 'status'])->get();
    }

    public function getById(int $id)
    {
        return Proposal::with(['user', 'event', 'status'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Proposal::create($data);
    }

    public function update(Proposal $proposal, array $data)
    {
        $proposal->update($data);
        return $proposal->fresh(['user', 'event', 'status']);
    }

    public function delete(Proposal $proposal)
    {
        return $proposal->delete();
    }
}
