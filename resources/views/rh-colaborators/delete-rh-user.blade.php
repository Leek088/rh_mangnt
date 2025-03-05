<x-layout-app pageTitle="Deletar usuário RH">
    <div class="w-25 p-4">
        <h3>Deletar usuário RH</h3>
        <hr>
        <p>Você tem certeza de que deseja deletar este usuário?</p>
        <div class="text-center">
            <h3 class="my-5">{{ $user->name }}</h3>
            <a href="{{ route('rh-user.index') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('rh-user.destroy-rh-user', ['id' => Crypt::encryptString($user->id)]) }}"
                class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>
