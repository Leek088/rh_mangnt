<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view(view: 'user.profile');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'current_password' => ['required'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'current_password.required' => 'O campo senha atual é obrigatório.',
                'new_password.required' => 'O campo nova senha é obrigatório.',
                'new_password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
                'new_password.confirmed' => 'A confirmação da nova senha não corresponde.',
            ]
        );

        if (!Hash::check(value: $request->current_password, hashedValue: Auth::user()->password)) {
            throw ValidationException::withMessages(messages: [
                'current_password' => 'A senha atual não está correta.',
            ]);
        }

        $user = Auth::user();
        $user->password = Hash::make(value: $request->new_password);
        $user->save();

        return redirect()->back()->with(key: 'success-change-password', value: 'Senha atualizada com sucesso!');
    }

    public function updateData(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O email deve ser um endereço de email válido.',
                'email.unique' => 'O email já está em uso.',
            ]
        );

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with(key: 'success-update-data', value: 'Dados atualizados com sucesso!');
    }
}
