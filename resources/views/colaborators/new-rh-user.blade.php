<x-layout-app page-title="Novo usuário RH">
    <div class="w-40 p-4">
        <h3>Novo colaborador do RH</h3>
        <hr>
        <form action="{{ route('rh-user.store-rh-user') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="row gap-3">
                    <div class="col p-4">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="seelct_department" class="form-label">Departamento</label>
                            <select class="form-select" name="department" id="department">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="mb-3">Perfil: <strong>Recursos Humanos</strong></p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('rh-user.index') }}" class="btn btn-outline-danger me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create colaborator</button>
                </div>
            </div>
        </form>
    </div>
</x-layout-app>
