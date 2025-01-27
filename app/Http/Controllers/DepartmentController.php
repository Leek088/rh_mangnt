<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends Controller
{
    public function index(): View
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }

        $departments = Department::orderBy(column: 'id', direction: 'desc')->get();
        return view('department.departments', compact('departments'));
    }

    public function newDepartment(): View
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }

        return view('department.add-department');
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }

        $validatedData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            ]
        );

        Department::create(attributes: $validatedData);

        return redirect()->route('department.index');
    }

    public function editDepartment(string $id): View
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }

        $id = Crypt::decryptString($id);
        $department = Department::findOrFail(intval($id));

        return view('department.edit-department', compact('department'));
    }

    public function updateDepartment(Request $request): RedirectResponse
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }

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
}
