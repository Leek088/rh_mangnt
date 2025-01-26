<x-layout-app pageTitle="Novo departamento">
    <div class="w-25 p-4">
        <h3>Novo departamento</h3>
        <hr>
        <form action="{{ route('department.store-department') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Department name</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <a href="{{ route('department.index') }}" class="btn btn-warning me-3">Voltar</a>
                <button type="submit" class="btn btn-primary">Criar</button>
            </div>
        </form>
    </div>
</x-layout-app>
