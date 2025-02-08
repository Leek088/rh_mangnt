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
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
            @endif
            <table class="table w-60" id="table">
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
                            <td>
                                @php
                                    $permissions = json_decode($colaborator->permissions);
                                    $formattedPermissions = [];
                                    foreach ($permissions as $key => $value) {
                                        if ($value) {
                                            $formattedPermissions[] = $key;
                                        }
                                    }
                                @endphp
                                {{ implode(', ', $formattedPermissions) }}
                            </td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="#" class="btn btn-sm btn-outline-info">
                                        <i class="fa-regular fa-pen-to-square me-2"></i>
                                        Editar
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger">
                                        <i class="fa-regular fa-trash-can me-2"></i>
                                        Deletar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout-app>
