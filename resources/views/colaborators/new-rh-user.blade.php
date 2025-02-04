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
                            <label for="department_id" class="form-label">Departamento</label>
                            <div class="d-flex">
                                <select disabled class="form-select" name="department_id" id="department_id">
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $department->name == 'Recursos Humanos' ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="m-3">
                                    <a href="{{ route('department.new-department') }}"
                                        class="btn btn-outline-primary mt-4">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <button type="submit" class="w-50 btn btn-primary">Criar</button>
                    <a href="{{ route('rh-user.index') }}" class="w-40 btn btn-outline-danger me-3">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</x-layout-app>
