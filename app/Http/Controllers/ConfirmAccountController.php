<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ConfirmAccountController extends Controller
{
    public function confirmAccount(string $token): View
    {
        $user = User::where('confirmation_token', $token)->firstOrFail();

        if ($user->email_verified_at !== null) {
            abort(403, 'Esta conta já está confirmada!');
        }

        if ($user->confirmation_token !== $token) {
            abort(403, 'Token invalido!');
        }

        return view('auth.confirm-account', compact('user'));
    }

    public function submitConfirmAccount(Request $request): RedirectResponse|View
    {
        $request->validate([
            'token' => 'required|string|size:60',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ]);

        $user = User::where('confirmation_token', $request->token)->firstOrFail();

        if ($user->email_verified_at !== null) {
            return redirect()->route('login')->withErrors(['email' => 'Esta conta já está confirmada!']);
        }

        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        $user->confirmation_token = null;
        $user->save();

        return view('auth.welcome', compact('user'));
    }
}
