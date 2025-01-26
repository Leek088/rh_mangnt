<div class="col-md-6">
    <div class="border p-5 shadow-sm">
        <form action="{{ route('user.update.data') }}" method="post">
            @csrf
            <h3>Atualizar dados</h3>
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? auth()->user()->name }}"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail (Usuário)</label>
                <input type="email" name="email" id="email" value="{{ old('email') ?? auth()->user()->email }}"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Atualizar dados</button>
            </div>
        </form>
        @if (session('success-update-data'))
            <div class="alert alert-success mt-3">
                {{ session('success-update-data') }}
            </div>
        @endif
    </div>
</div>
