<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Lista todos os papéis
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    // Mostra o formulário para criar um novo papel
    public function create()
    {
        return view('roles.create');
    }

    // Salva o novo papel no banco
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' => 'nullable|string'
        ]);

        Role::create($data);

        return redirect()->route('roles.index')->with('success', 'Papel criado com sucesso!');
    }

    // Mostra o formulário para editar um papel
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Atualiza o papel no banco
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'description' => 'nullable|string'
        ]);

        $role->update($data);

        return redirect()->route('roles.index')->with('success', 'Papel atualizado com sucesso!');
    }

    // Deleta o papel
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Papel excluído com sucesso!');
    }

    // (Opcional) Mostra detalhes do papel
    public function show(Role $role)
    {
        return view('roles.show', compact('role')); // se criar view show
    }
}
