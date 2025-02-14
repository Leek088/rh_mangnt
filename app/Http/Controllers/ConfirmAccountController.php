<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmAccountController extends Controller
{
    public function cunfirmAccoount(string $url): void
    {
        echo "Entrou aqui {$url}";
    }
}
