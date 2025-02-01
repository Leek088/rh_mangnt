<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
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

    public function storeRhUser(Request $request)
    {
        $this->authorizeAdmin();

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|min:8',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt('password');
        $user->role = 'rh';
        $user->department_id = $validatedData['department_id'];
        $user->permissions = json_encode([
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);
        $user->save();

        return redirect()->route('rh-user.index')->with('success', 'Usuário RH criado com sucesso!');
    }

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
