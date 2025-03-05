<x-layout-guest pageTitle="Recuperar Senha">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="com-lg-6 col-md-8 col-sm-12">
                <!-- logo -->
                <div class="text-center mb-5">
                    <img src="{{ asset(path: 'assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <div class="card p-5">
                    @if (!session(key: 'status'))
                        <!-- forgot password -->
                        <p>Para recuperar a sua senha, por favor indique o seu email.
                            Irá receber um email com um link
                            pararecuperar a senha.
                        </p>
                        <form action="{{ route(name: 'password.email') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route(name: 'login') }}">Já sei a minha senha?</a>
                                <button type="submit" class="btn btn-primary px-4">Enviar email</button>
                            </div>
                        </form>
                    @else
                        <div class="text-center mb-5">
                            <p>Um email foi enviado com um link para recuperar a sua senha.</p>
                            <p class="mb-5">Verifique a caixa de entrada ou span.</p>
                            <a href="{{ route(name: 'login') }}" class="btn btn-primary">Voltar ao login</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
