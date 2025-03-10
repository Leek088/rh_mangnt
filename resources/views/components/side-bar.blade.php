<div class="d-flex flex-column sidebar pt-4">
    <a href="{{ route('home') }}"><i class="fas fa-home me-3"></i>Inicio</a>
    @canany(['admin', 'rh'])
        <a href="{{ route('colaborators.index') }}"><i class="fas fa-users me-3"></i>Colaboradores</a>
    @endcanany
    @can('admin')
        <a href="{{ route('department.index') }}"><i class="fas fa-industry me-3"></i>Departamentos</a>
        <a href="{{ route('rh-user.index') }}"><i class="fas fa-user-gear me-3"></i>Usuarios RH</a>
    @endcan
    <hr>
    <a href="{{ route('user.profile') }}"><i class="fas fa-cog me-3"></i>Perfil do usuário</a>
    <hr>
    <div class="text-center mt-3">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-sign-out-alt me-3"></i>Sair
            </button>
        </form>
    </div>
</div>
