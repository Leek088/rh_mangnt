<x-layout-app pageTitle="Novo departamento">
    <div class="w-50 p-4">
        <h3>Novo departamento</h3>
        <hr>
        <form action="{{ route(name: 'department.update-department') }}" method="post">
            @csrf
            <input type="hidden" name="encrypted_id" value="{{ encrypt(value: $department->id) }}">
            <div class="mb-3">
                <label for="name" class="form-label">Nome do departamento</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old(key: $department->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Criar Departamento</button>
                    <a href="{{ route(name: 'department.index') }}" class="btn btn-warning me-3">Cancelar</a>
                </div>
        </form>
    </div>
</x-layout-app>
