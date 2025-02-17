<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class ColaboratorsController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdmin();

        $colaborators = User::with('userDetail', 'department')
            ->where('role', '<>', 'admin')
            ->get();

        return view('colaborators.index', compact('colaborators'));
    }

    private function authorizeAdmin(): void
    {
        if (!Gate::allows('admin')) {
            abort(403, 'Você não está autorizado a acessar essa página');
        }
    }
}
