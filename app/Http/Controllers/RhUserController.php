<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;

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
        $token = Str::random(60);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->confirmation_token = $token;
        $user->role = 'rh';
        $user->department_id = $department->id;
        $user->permissions = json_encode([
            'create' => true,
            'read' => true,
            'update' => true,
            'delete' => true,
        ]);

        $user->save();

        try {
            $user->userDetail()->create([
                'address' => $validatedData['address'],
                'zip_code' => $validatedData['zip_code'],
                'city' => $validatedData['city'],
                'phone' => $validatedData['phone'],
                'salary' => $validatedData['salary'],
                'admission_date' => $validatedData['admission_date'],
            ]);
        } catch (\Exception $e) {
            $user->delete();
            return redirect()->route('rh-user.index')
                ->with('error', 'Erro ao criar detalhes do usuário RH.');
        }

        Mail::to($user->email)
            ->send(new ConfirmAccountEmail(route('confirm-account', ['token' => $token])));

        return redirect()->route('rh-user.index')->with('success', 'Usuário RH criado com sucesso!');
    }

    public function editRhUser(string $id): View
    {
        $this->authorizeAdmin();

        $id = intval(Crypt::decryptString($id));

        $user = User::with(['userDetail', 'department'])->findOrFail($id);

        $departments = Department::all();

        $permissions = ['create', 'read', 'update', 'delete'];
        $user->permissions = json_decode($user->permissions, true);

        return view('colaborators.edit-rh-user', compact('user', 'departments', 'permissions'));
    }

    public function updateRhUser(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $id = intval(Crypt::decryptString($request->id));

        $user = User::findOrFail($id);

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

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->permissions = json_encode([
            'create' => $validatedData['permissions']['create'] ?? false,
            'read' => $validatedData['permissions']['read'] ?? false,
            'update' => $validatedData['permissions']['update'] ?? false,
            'delete' => $validatedData['permissions']['delete'] ?? false,
        ]);
        $user->save();

        try {
            $user->userDetail()->updateOrCreate(
                ['user_id' => $user->id],
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

        return redirect()->route('rh-user.index')->with('success', 'Usuário RH atualizado com sucesso!');
    }

    public function deleteRhUser(string $id): View
    {
        $this->authorizeAdmin();

        $id = intval(Crypt::decryptString($id));

        $user = User::findOrFail($id);

        return view('colaborators.delete-rh-user', compact('user'));
    }

    public function destroyRhUser(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $id = intval(Crypt::decryptString($request->id));

        $user = User::findOrFail($id);

        try {
            $user->userDetail()->delete();
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('rh-user.index')->with('error', 'Erro ao deletar usuário RH.');
        }

        return redirect()->route('rh-user.index')->with('success', 'Usuário RH deletado com sucesso!');
    }

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
