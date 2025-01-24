<div class="col-md-6">
    <div class="border p-5 shadow-sm">
        <form action="#" method="post">
            @csrf
            <h3>Change user data</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email (Username)</label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update user data</button>
            </div>
        </form>
        @if (session('success-change-profile-data'))
            <div class="alert alert-success mt-3">
                {{ session('success-change-profile-data') }}
            </div>
        @endif
    </div>
</div>
