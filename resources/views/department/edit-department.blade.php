<x-layout-app pageTitle="Editar departamento">
    <div class="w-50 p-4">
        <h3>Editar departamento</h3>
        <hr>
        <form action="{{ route('department.update-department') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ Crypt::encryptString($department->id) }}">
            <div class="mb-3">
                <label for="name" class="form-label">Nome do departamento</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $department->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Atualizar departamento</button>
                    <a href="{{ route('department.index') }}" class="btn btn-warning me-3">Cancelar</a>
                </div>
        </form>
    </div>
</x-layout-app>
