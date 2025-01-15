<?php

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "Bem vindo";
});

Route::get('/mail', function () {
    Mail::raw('Mensagem de teste de RH MANGNT', function (Message $message) {
        $message->to('teste@email.com')
            ->subject('Bem vindo ao RH MANGNT')
            ->from('rh@email.com');
    });

    echo 'Email enviado com sucesso';
});
