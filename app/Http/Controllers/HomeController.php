<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function home(): View
    {
        switch (auth()->user()->role) {
            case 'colaborador':
                $colaborator = User::with('userDetail', 'department')->findOrFail(auth()->id());
                return view('colaborators.show', compact('colaborator'));
            default:
                $data = $this->recuperarDadosDaEmpresa();
                return view('home', compact('data'));
        }
    }

    private function recuperarDadosDaEmpresa(): array
    {
        $data = [];

        $data['activeUsersCount'] = User::whereNull('deleted_at')->count();

        $data['deletedUsersCount'] = User::onlyTrashed()->count();

        $data['totalSalary'] = User::withoutTrashed()
            ->with('userDetail')
            ->get()
            ->sum(function (User $user): float {
                return $user->userDetail->salary;
            });

        $data['totalSalary'] = 'R$ ' . number_format($data['totalSalary'], 2, ',', '.');

        $data['totalUsersPerDepartment'] = User::withoutTrashed()
            ->with('department')
            ->get()
            ->groupBy('department_id')
            ->map(function (Collection $users): array {
                return [
                    'department' => $users->first()->department->name ?? 'Sem departamento',
                    'total' => $users->count()
                ];
            });

        $data['totalSalaryPerDepartment'] = User::withoutTrashed()
            ->with('department', 'userDetail')
            ->get()
            ->groupBy('department_id')
            ->map(function (Collection $users): array {
                return [
                    'department' => $users->first()->department->name ?? 'Sem departamento',
                    'total' => 'R$ ' . number_format($users->sum(function (User $user): float {
                        return $user->userDetail->salary;
                    }), 2, ',', '.')
                ];
            });

        return $data;
    }
}
