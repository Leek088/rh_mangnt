<x-layout-app pageTitle="Departamentos">
    <div class="w-100 p-4">
        <h3>Departamentos</h3>
        <hr>
        @if ($departments->isEmpty())
            <div class="text-center my-5">
                <p>Nenhum departamento encontrado.</p>
                <a href="{{ route('department.new-department') }}" class="btn btn-primary">Criar um departamento</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('department.new-department') }}" class="btn btn-primary">Crie um novo
                    departamento</a>
            </div>
            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Departamento</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if (in_array($department->name, ['Administração', 'Recursos Humanos']))
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                        <a href="{{ route('department.edit-department', ['id' => Crypt::encryptString($department->id)]) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fa-regular fa-pen-to-square me-2"></i>
                                            Editar
                                        </a>
                                        <a href="{{ route('department.delete-department', ['id' => Crypt::encryptString($department->id)]) }}"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fa-regular fa-trash-can me-2"></i>
                                            Deletar
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout-app>
