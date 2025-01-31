<x-layout-app pageTitle="Recursos Humanos">
    <div class="w-100 p-4">
        <h3>Recursos Humanos</h3>
        <hr>
        @if ($rhColaborators->isEmpty())
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
                <a href="{{ route('rh-user.new-rh-user') }}" class="btn btn-primary">Criar um colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('rh-user.new-rh-user') }}" class="btn btn-primary">Crie um novo
                    colaborador</a>
            </div>
            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Permissão</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($rhColaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>{{ implode(',', json_decode($colaborator->permission)) }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if ($colaborator->name == 'Administração' || $department->name == 'Recursos Humanos')
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                        <a href="{{ route('', ['id' => Crypt::encryptString($colaborator->id)]) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fa-regular fa-pen-to-square me-2"></i>
                                            Editar
                                        </a>
                                        <a href="{{ route('', ['id' => Crypt::encryptString($colaborator->id)]) }}"
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
