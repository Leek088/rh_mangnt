<div class="d-flex justify-content-between bg-color-1 text-white py-1 px-3">
    <div class="d-flex align-items-center">
        <a href="{{ route(name: 'home') }}">
            <img src="{{ asset(path: 'assets/images/favicon.png') }}" alt="logo" width="50px" class="img-fluid">
        </a>
        <h4 class="ms-3 text-primary m-0 p-0">
            {{ env(key: 'APP_NAME') }}
        </h4>
    </div>
    <div class="d-flex align-items-center">
        <i class="fas fa-user-circle me-3"></i>
        <a href="#" class="text-primary me-3">
            {{ auth()->user()->name }}
        </a>
        <form action="{{ route(name: 'logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</div>
