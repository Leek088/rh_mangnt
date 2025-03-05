<x-layout-guest page-title="Welcome">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <div class="card p-5 text-center">
                    <p>Bem vindo, <strong>{{ $user->name }}</strong>!</p>
                    <p>Sua conta foi criada com sucesso. </p>
                    <p>Você agora pode fazer o
                        <a href="{{ route('login') }}">login aqui!</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
