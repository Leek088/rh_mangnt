<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;


class DepartmentController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdmin();

        $departments = Department::orderBy('id', 'desc')->get();
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

        $id = intval(Crypt::decryptString($id));

        $this->checkDepartment($id);

        $department = Department::findOrFail($id);

        return view('department.edit-department', compact('department'));
    }

    public function updateDepartment(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $id = Crypt::decryptString($request->id);

        $this->checkDepartment($id);

        $department = Department::findOrFail($id);

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

        $id = intval(Crypt::decryptString($id));

        $this->checkDepartment($id);

        $department = Department::findOrFail($id);

        return view('department.delete-department-confirm', compact('department'));
    }

    public function destroyDepartment(string $id): RedirectResponse
    {
        $this->authorizeAdmin();

        $id = intval(Crypt::decryptString($id));

        $this->checkDepartment($id);

        $department = Department::findOrFail($id);
        $department->delete();

        User::where('department_id', $id)->update(['department_id' => null]);

        return redirect()->route('department.index');
    }

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }

    public function checkDepartment(int $id): void
    {
        $department = Department::findOrFail($id);

        if (in_array($department->name, ['Administração', 'Recursos Humanos'])) {
            abort(403, 'Não é permitido atualizar, editar ou excluir este departamento');
        }
    }
}
