<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index(): View
    {
        if (!Gate::allows(ability: 'admin')) {
            abort(code: 403, message: 'Você não está autorizado a acessar essa página');
        }

        $departments = Department::orderBy(column: 'id', direction: 'desc')->get();
        return view(view: 'department.departments', data: compact(var_name: 'departments'));
    }

    public function newDepartment(): View
    {
        if (!Gate::allows(ability: 'admin')) {
            abort(code: 403, message: 'Você não está autorizado a acessar essa página');
        }

        return view(view: 'department.add-department');
    }

    public function storeDepartment(Request $request): RedirectResponse
    {
        if (!Gate::allows(ability: 'admin')) {
            abort(code: 403, message: 'Você não está autorizado a acessar essa página');
        }

        $validatedData = $request->validate(
            rules: [
                'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            ]
        );

        Department::create(attributes: $validatedData);

        return redirect()->route(route: 'department.index');
    }
}
