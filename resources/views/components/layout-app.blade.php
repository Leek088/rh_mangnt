<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        {{ env(key: 'APP_NAME') }}
        @isset($pageTitle)
            - {{ $pageTitle }}
        @endisset
    </title>
    <!-- favicon -->
    <link rel="icon" href="{{ asset(path: 'assets/images/favicon.png') }}" type="image/png">
    <!-- resources -->
    <link rel="stylesheet" href="{{ asset(path: 'assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset(path: 'assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset(path: 'assets/bootstrap/bootstrap.min.css') }}">
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset(path: 'assets/css/main.css') }}">
</head>

<body>
    <x-user-bar />
    <div class="d-flex pt-2">
        <x-side-bar />
        {{ $slot }}
    </div>
    <!-- resources -->
    <script src="{{ asset(path: 'assets/datatables/jquery.min.js') }}"></script>
    <script src="{{ asset(path: 'assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(path: 'assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset(path: 'assets/js/main.js') }}"></script>
</body>

</html>
