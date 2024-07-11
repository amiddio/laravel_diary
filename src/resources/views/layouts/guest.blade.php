<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page_title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('styles/custom.css') }}" rel="stylesheet" />
    <style>
        .container {
            width: auto;
            max-width: 680px;
            padding: 0 15px;
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column h-100">

    {{-- Begin page content --}}
    <main class="flex-shrink-0 mb-5">
        <div class="container">

            <div class="text-center my-5">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}" width="100">
            </div>

            <x-card-general class="w-75 m-auto">
                <h1 class="h3 fw-normal text-center">{{ $page_title }}</h1>
                <div>
                    {{ $content }}
                </div>
            </x-card-general>
        </div>
    </main>

    @include('includes/footer')
</body>
</html>
