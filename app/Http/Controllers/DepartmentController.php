<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;

/**
 * Classe DepartmentController
 *
 * Este controlador lida com a gestão de departamentos, incluindo listar, criar, atualizar e excluir departamentos.
 * Ele garante que apenas administradores autorizados possam realizar essas ações.
 *
 * Métodos:
 * - index(): Exibe uma lista de todos os departamentos.
 * - newDepartment(): Mostra o formulário para criar um novo departamento.
 * - storeDepartment(Request $request): Armazena um departamento recém-criado no banco de dados.
 * - editDepartment(string $id): Mostra o formulário para editar um departamento existente.
 * - updateDepartment(Request $request): Atualiza um departamento existente no banco de dados.
 * - deleteDepartment(string $id): Mostra o formulário de confirmação para excluir um departamento.
 * - destroyDepartment(string $id): Exclui um departamento do banco de dados.
 * - authorizeAdmin(): Verifica se o usuário está autorizado como administrador.
 */

class DepartmentController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdmin();

        $departments = Department::orderBy(column: 'id', direction: 'desc')->get();
        return view('department.departments', compact('departments'));
    }

    public function newDepartment(): View
    {
        $this->authorizeAdmin();

        return view('department.add-department');
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validatedData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            ]
        );

        Department::create($validatedData);

        return redirect()->route('department.index');
    }

    public function editDepartment(string $id): View
    {
        $this->authorizeAdmin();

        $id = Crypt::decryptString($id);
        $department = Department::findOrFail(intval($id));

        return view('department.edit-department', compact('department'));
    }

    public function updateDepartment(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $id = Crypt::decryptString($request->id);
        $department = Department::findOrFail(intval($id));

        $validatedData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255', "unique:departments,name,{$department->id}"],
            ]
        );

        $department->update($validatedData);

        return redirect()->route('department.index');
    }

    public function deleteDepartment(string $id): View
    {
        $this->authorizeAdmin();

        $id = Crypt::decryptString($id);
        $department = Department::findOrFail(intval($id));

        return view('department.delete-department-confirm', compact('department'));
    }

    public function destroyDepartment(string $id): RedirectResponse
    {
        $this->authorizeAdmin();

        $id = Crypt::decryptString($id);
        $department = Department::findOrFail(intval($id));
        $department->delete();

        return redirect()->route('department.index');
    }

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
