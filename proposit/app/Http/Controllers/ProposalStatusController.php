<?php

namespace App\Http\Controllers;

use App\Models\ProposalStatus;
use Illuminate\Http\Request;

class ProposalStatusController extends Controller
{
    public function index()
    {
        return ProposalStatus::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:proposal_statuses,name',
        ]);

        $status = ProposalStatus::create($data);
        return response()->json($status, 201);
    }

    public function show(ProposalStatus $proposalStatus)
    {
        return $proposalStatus->load('proposals');
    }

    public function update(Request $request, ProposalStatus $proposalStatus)
    {
        $data = $request->validate([
            'name' => 'string|unique:proposal_statuses,name,' . $proposalStatus->id,
        ]);

        $proposalStatus->update($data);
        return response()->json($proposalStatus);
    }

    public function destroy(ProposalStatus $proposalStatus)
    {
        $proposalStatus->delete();
        return response()->json(null, 204);
    }
}
