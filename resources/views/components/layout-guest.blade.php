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
    <link rel="stylesheet" href="{{ asset(path: 'assets/bootstrap/bootstrap.min.css') }}">
    <!-- custom -->
    <link rel="stylesheet" href="{{ asset(path: 'assets/css/main.css') }}">
</head>

<body>

    {{ $slot }}

    <!-- resources -->
    <script src="{{ asset(path: 'assets/bootstrap/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
