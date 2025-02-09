<x-layout-app page-title="Novo usuário RH">
    <div class="w-40 p-4 mb-5">
        <h3>Novo colaborador do RH</h3>
        <hr>
        <form action="{{ route('rh-user.store-rh-user') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="row gap-3">
                    <div class="col rounded border border-black p-4">
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
                            </div>
                        </div>
                    </div>
                    <div class="col rounded border border-black p-4">
                        <div class="mb-3">
                            <label for="Address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address') }}">
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Cep</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                        value="{{ old('zip_code') }}">
                                    @error('zip_code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="city" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city') }}">
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salario</label>
                                    <input type="number" class="form-control" id="salary" name="salary"
                                        step=".01" placeholder="0,00" value="{{ old('salary') }}">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Adimissão</label>
                                    <input type="text" class="form-control" id="admission_date" name="admission_date"
                                        placeholder="YYYY-mm-dd" value="{{ old('admission_date') }}">
                                    @error('admission_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 row justify-content-center">
                <div class="col-md-6 d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50">Criar</button>
                    <a href="{{ route('rh-user.index') }}" class="ms-2 btn btn-danger w-50">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</x-layout-app>
