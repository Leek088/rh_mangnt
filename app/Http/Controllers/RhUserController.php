<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RhUserController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdmin();

        $rhColaborators = User::where('role', 'rh')->get();

        return view('colaborators.rh-users', compact('rhColaborators'));
    }

    public function newRhUser(): View
    {
        $this->authorizeAdmin();

        $departments = Department::all();

        return view('colaborators.new-rh-user', compact('departments'));
    }

    public function storeRhUser(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'address' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|numeric|min:0',
            'admission_date' => 'required|date',

        ]);

        $department = Department::where('name', 'Recursos Humanos')->firstOrFail();

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = 'rh';
        $user->department_id = $department->id;
        $user->permissions = json_encode([
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);

        $user->save();

        $user->userDetail()->create([
            'address' => $validatedData['address'],
            'zip_code' => $validatedData['zip_code'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'salary' => $validatedData['salary'],
            'admission_date' => $validatedData['admission_date'],
        ]);

        return redirect()->route('rh-user.index')->with('success', 'Usuário RH criado com sucesso!');
    }

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
