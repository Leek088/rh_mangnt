<div class="d-flex flex-column sidebar pt-4">
    <a href="{{ route(name: 'home') }}"><i class="fas fa-home me-3"></i>Inicio</a>
    @can(abilities: 'admin')
        <a href="#"><i class="fas fa-users me-3"></i>Colaboradores</a>
        <a href="{{ route('rh-user.index') }}"><i class="fas fa-user-gear me-3"></i>Usuarios RH</a>
        <a href="{{ route(name: 'department.index') }}"><i class="fas fa-industry me-3"></i>Departamentos</a>
    @endcan
    <hr>
    <a href="{{ route(name: 'user.profile') }}"><i class="fas fa-cog me-3"></i>Perfil do usuário</a>
    <hr>
    <div class="text-center mt-3">
        <form action="{{ route(name: 'logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger">
                <i class="fas fa-sign-out-alt me-3"></i>Sair
            </button>
        </form>
    </div>
</div>
