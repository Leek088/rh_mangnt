    <x-layout-app page-title="Colaborator detalhado">
        <div class="w-100 p-4">
            <h3>Detalhes do colaborador</h3>
            <hr>
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col">
                        <p>Nome: <strong>{{ $colaborator->name }}</strong></p>
                        <p>E-mail: <strong>{{ $colaborator->email }}</strong></p>
                        <p>Perfil: <strong>{{ $colaborator->role }}</strong></p>
                        <p>Permissões:</p>
                        <ul>
                            @foreach (json_decode($colaborator->permissions) as $permission => $value)
                                <li>{{ $permission }}: <strong>{{ $value ? 'Sim' : 'Não' }}</strong></li>
                            @endforeach
                        </ul>
                        <p>Departamento: <strong>{{ $colaborator->department->name ?? 'Não associado' }}</strong></p>
                        <p>Ativo?
                            @empty($colaborator->email_verified_at)
                                <span class="badge bg-danger">Não</span>
                            @else
                                <span class="badge bg-success">Sim</span>
                            @endempty
                        </p>
                    </div>
                    <div class="col">
                        <p>Endereço: <strong>{{ $colaborator->userDetail->address }}</strong></p>
                        <p>CEP: <strong>{{ $colaborator->userDetail->zip_code }}</strong></p>
                        <p>Cidade: <strong>{{ $colaborator->userDetail->city }}</strong></p>
                        <p>Telefone: <strong>{{ $colaborator->userDetail->phone }}</strong></p>
                        <p>Data de admissão: <strong>{{ $colaborator->userDetail->admission_date }}</strong></p>
                        <p>Salario: R$
                            <strong>{{ number_format($colaborator->userDetail->salary, 2, ',', '.') }}</strong>
                        </p>
                    </div>
                </div>
            </div>
            @if (auth()->user()->role !== 'colaborador')
                <a href="{{ route('colaborators.index') }}" class="btn btn-outline-dark"><i
                        class="fas fa-arrow-left me-2"></i>Voltar</a>
            @endif
        </div>
    </x-layout-app>
