<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page_title }}</title>
    @vite(['resources/bootstrap/css/bootstrap.min.css', 'resources/css/cabinet.css'])
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
            <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}"
                 width="100">
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
