<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Mail\ConfirmAccountEmail;
use Illuminate\Support\Facades\Mail;

class ColaboratorsController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdminOrRh();

        $colaborators = Auth::user()->role == 'admin' ? User::withTrashed()->get()
            : $colaborators = User::with('userDetail', 'department')
                ->where('role', '<>', 'admin')
                ->withTrashed()
                ->get();

        return view('colaborators.index', compact('colaborators'));
    }

    public function show(string $id): View
    {
        $this->authorizeAdminOrRh();

        $id = intval(Crypt::decryptString($id));

        $colaborator = User::with('userDetail', 'department')->findOrFail($id);

        return view('colaborators.show', compact('colaborator'));
    }

    public function create(): View
    {
        $this->authorizeAdminOrRh();

        $departments = Auth::user()->role == 'admin' ? Department::all()
            : Department::whereNotIn('name', ['Administração', 'Recursos Humanos'])->get();

        $permissions = ['create', 'read', 'update', 'delete'];

        return view('colaborators.create', compact('departments', 'permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeAdminOrRh();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'address' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|numeric|min:0',
            'admission_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'permissions' => 'required|array',
            'permissions.*' => 'in:true,false',
        ]);

        $departmentName = Department::find($validatedData['department_id'])->name;

        $role = match ($departmentName) {
            'Administração' => 'admin',
            'Recursos Humanos' => 'rh',
            default => 'User',
        };

        $token = Str::random(60);

        $colaborator = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'permissions' => json_encode([
                'create' => $validatedData['permissions']['create'] ?? false,
                'read' => $validatedData['permissions']['read'] ?? false,
                'update' => $validatedData['permissions']['update'] ?? false,
                'delete' => $validatedData['permissions']['delete'] ?? false,
            ]),
            'department_id' => $validatedData['department_id'],
            'role' => $role,
            'confirmation_token' => $token
        ]);

        try {
            $colaborator->userDetail()->create([
                'address' => $validatedData['address'],
                'zip_code' => $validatedData['zip_code'],
                'city' => $validatedData['city'],
                'phone' => $validatedData['phone'],
                'salary' => $validatedData['salary'],
                'admission_date' => $validatedData['admission_date'],
            ]);
        } catch (\Exception $e) {
            return redirect()->route('colaborators.index')->with('error', 'Erro ao criar detalhes do usuário.');
        }

        Mail::to($colaborator->email)
            ->send(new ConfirmAccountEmail(route('confirm-account', ['token' => $token])));

        return redirect()->route('colaborators.index')->with('success', 'Colaborador criado com sucesso.');
    }

    public function edit(string $id): View
    {
        $this->authorizeAdminOrRh();

        $id = intval(Crypt::decryptString($id));

        $colaborator = User::with('userDetail', 'department')->findOrFail($id);

        $departments = Auth::user()->role == 'admin' ? Department::all()
            : Department::where('name', '<>', 'Administração', 'and', 'rh')->get();

        $permissions = ['create', 'read', 'update', 'delete'];
        $colaborator->permissions = json_decode($colaborator->permissions, true);

        return view('colaborators.edit', compact('colaborator', 'departments', 'permissions'));
    }

    public function update(Request $request): RedirectResponse
    {
        $this->authorizeAdminOrRh();

        $id = intval(Crypt::decryptString($request->id));

        $colaborator = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}|max:255",
            'address' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|numeric|min:0',
            'admission_date' => 'required|date',
            'permissions' => 'required|array',
            'permissions.*' => 'boolean',
        ]);

        $colaborator->name = $validatedData['name'];
        $colaborator->email = $validatedData['email'];
        $colaborator->permissions = json_encode([
            'create' => $validatedData['permissions']['create'] ?? false,
            'read' => $validatedData['permissions']['read'] ?? false,
            'update' => $validatedData['permissions']['update'] ?? false,
            'delete' => $validatedData['permissions']['delete'] ?? false,
        ]);
        $colaborator->save();

        try {
            $colaborator->userDetail()->updateOrCreate(
                ['user_id' => $colaborator->id],
                [
                    'address' => $validatedData['address'],
                    'zip_code' => $validatedData['zip_code'],
                    'city' => $validatedData['city'],
                    'phone' => $validatedData['phone'],
                    'salary' => $validatedData['salary'],
                    'admission_date' => $validatedData['admission_date'],
                ]
            );
        } catch (\Exception $e) {
            return redirect()->route('rh-user.index')->with('error', 'Erro ao atualizar detalhes do usuário RH.');
        }

        return redirect()->route('colaborators.index')->with('success', 'Colaborador atualizado com sucesso.');
    }

    public function delete(string $id): View
    {
        $this->authorizeAdminOrRh();

        $id = intval(Crypt::decryptString($id));

        $colaborator = User::findOrFail($id);

        return view('colaborators.delete', compact('colaborator'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->authorizeAdminOrRh();

        $id = intval(Crypt::decryptString($id));

        $colaborator = User::findOrFail($id);
        $colaborator->delete();

        return redirect()->route('colaborators.index')->with('success', 'Colaborador deletado com sucesso.');
    }

    private function authorizeAdminOrRh(): void
    {
        if (!Gate::allows('admin') && !Gate::allows('rh')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
