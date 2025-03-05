<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(): View
    {
        switch (auth()->user()->role) {
            case 'colaborador':
                $colaborator = User::with('userDetail', 'department')->findOrFail(auth()->id());
                return view('colaborators.show', compact('colaborator'));
            default:
                return view('home');
        }
    }
}
