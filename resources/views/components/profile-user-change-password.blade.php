<div class="col-md-6">
    <div class="border p-5 shadow-sm">
        <form action="{{ route(name: 'user.update.password') }}" method="post">
            @csrf
            <h3 class="text-center">Trocar senha</h3>
            <div class="mb-3 mt-3">
                <label for="current_password" class="form-label">Senha atual</label>
                <input type="password" name="current_password" id="current_password" class="form-control">
                @error('current_password')
                    <div class="text-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nova senha</label>
                <input type="password" name="new_password" id="new_password" class="form-control">
                @error('new_password')
                    <div class="text-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirme a nova senha</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="form-control">
                @error('new_password_confirmation')
                    <div class="text-danger mt-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Trocar a senha</button>
            </div>
        </form>
        @if (session(key: 'success-change-password'))
            <div class="alert alert-success mt-3">
                {{ session(key: 'success-change-password') }}
            </div>
        @endif
    </div>
</div>
