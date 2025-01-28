<x-layout-app pageTitle="Deletar departamento">
    <div class="w-25 p-4">
        <h3>Deletar departmento</h3>
        <hr>
        <p>Você tem certeza de que deseja deletar este departamento?</p>
        <div class="text-center">
            <h3 class="my-5">{{ $department->name }}</h3>
            <a href="{{ route('department.index') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('department.destroy-department', ['id' => Crypt::encryptString($department->id)]) }}"
                class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>
