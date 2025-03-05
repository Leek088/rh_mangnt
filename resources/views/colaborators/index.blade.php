<x-layout-app page-title="Colaboradores">
    <div class="w-100 p-4">
        <h3>Todos colaboradores</h3>
        <hr>
        @if ($colaborators->isEmpty())
            <div class="text-center my-5">
                <p>Nenhum colaborador encontrado.</p>
                <a href="#" class="btn btn-primary">Criar um colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.create') }}" class="btn btn-primary">Criar um colaborador</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
            @endif
            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ativo</th>
                    <th>Departamento</th>
                    <th>Perfil</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>
                                @empty($colaborator->email_verified_at)
                                    <span class="badge bg-danger">Não</span>
                                @else
                                    <span class="badge bg-success">Sim</span>
                                @endempty
                            </td>
                            <td>
                                {{ $colaborator->department->name ?? 'Não associado' }}
                            </td>
                            <td>{{ $colaborator->role }}</td>
                            <td>
                                @if ($colaborator->trashed())
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('colaborators.restore', ['id' => Crypt::encryptString($colaborator->id)]) }}"
                                            class="btn btn-sm btn-outline-success">
                                            <i class="fa-solid fa-trash-can-arrow-up me-2"></i>
                                            Restaurar
                                        </a>
                                    </div>
                                @else
                                    <div class="d-flex gap-3 justify-content-end">
                                        <a href="{{ route('colaborators.show', Crypt::encryptString($colaborator->id)) }}"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="fa-regular fa-pen-to-square me-2"></i>
                                            Detalhes
                                        </a>
                                        <a href="{{ route('colaborators.edit', ['id' => Crypt::encryptString($colaborator->id)]) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="fa-regular fa-pen-to-square me-2"></i>
                                            Editar
                                        </a>
                                        <a href="{{ route('colaborators.delete', ['id' => Crypt::encryptString($colaborator->id)]) }}"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fa-regular fa-trash-can me-2"></i>
                                            Deletar
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
</x-layout-app>
