<x-layout-guest pageTitle="Login">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-sm-12">
                <div class="text-center mb-5">
                    <img src="{{ asset(path: 'assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <div class="card p-5">
                    <form action="{{ route(name: 'login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route(name: 'password.request') }}">Esqueceu a sua senha?</a>
                            <button type="submit" class="btn btn-primary px-4">Entrar</button>
                        </div>
                    </form>
                    @if (session('status'))
                        <div class="alert alert-success text-center mt-3">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
