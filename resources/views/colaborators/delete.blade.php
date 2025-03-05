<x-layout-app pageTitle="Deletar usuário">
    <div class="w-25 p-4">
        <h3>Deletar usuário</h3>
        <hr>
        <p>Você tem certeza de que deseja deletar este usuário?</p>
        <div class="text-center">
            <h3 class="my-5">{{ $colaborator->name }}</h3>
            <a href="{{ route('colaborators.index') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('colaborators.destroy', ['id' => Crypt::encryptString($colaborator->id)]) }}"
                class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>
