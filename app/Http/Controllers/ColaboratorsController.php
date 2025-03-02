<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class ColaboratorsController extends Controller
{
    public function index(): View
    {
        $this->authorizeAdminOrRh();

        $colaborators = User::with('userDetail', 'department')
            ->where('role', '<>', 'admin')
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
