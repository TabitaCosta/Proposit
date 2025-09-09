<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\DTOs\RoleDTO;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->getAll();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' => 'nullable|string',
        ]);

        $dto = new RoleDTO($data); // ✅ cria o DTO
        $this->roleService->create($dto);

        return redirect()->route('roles.index')->with('success', 'Papel criado com sucesso!');
    }

    public function show(Role $role)
    {
        $role = $this->roleService->getById($role->id);
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'string|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $dto = new RoleDTO($data); // ✅ cria o DTO
        $this->roleService->update($role, $dto);

        return redirect()->route('roles.index')->with('success', 'Papel atualizado com sucesso!');
    }

    public function destroy(Role $role)
    {
        $this->roleService->delete($role);

        return redirect()->route('roles.index')->with('success', 'Papel excluído com sucesso!');
    }
}
