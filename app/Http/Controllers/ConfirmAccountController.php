<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

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
}
