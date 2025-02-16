<x-layout-guest pageTitle="Login">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-sm-12">
                <div class="text-center mb-5">
                    <img src="{{ asset(path: 'assets/images/logo.png') }}" alt="Logo" width="200px">
                </div>
                <div class="card p-5">
                    <h2 class="text-center mb-4">Crie sua senha</h2>
                    <form action="{{ route('confirm-account.submit') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $user->confirmation_token }}">
                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation">Confirmar senha</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary px-4">Concluir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout-guest>
