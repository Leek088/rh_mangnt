<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
