<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page_title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('styles/custom.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body class="d-flex flex-column h-100">

    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}" width="30" />
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-3">
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="nav-link px-2 @if('dashboard' == Route::current()->getName()) link-secondary @else link-body-emphasis @endif">{{ __('Dashboard') }}</a>
                    </li>
                    <li>
                        <a href="/"
                           class="nav-link px-2 @if('diary' == Route::current()->getName()) link-secondary @else link-body-emphasis @endif">{{ __('Diary') }}</a>
                    </li>
                    <li>
                        <a href="/"
                           class="nav-link px-2 @if('blog' == Route::current()->getName()) link-secondary @else link-body-emphasis @endif">{{ __('Blog') }}</a>
                    </li>
                </ul>

{{--                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">--}}
{{--                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">--}}
{{--                </form>--}}

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="ps-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-button-primary :value="__('Sign out')" position="start" size="btn-sm" />
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    {{-- Begin page content --}}
    <main class="flex-shrink-0 mb-5">
        <div class="container">
            <h1 class="h2 fw-normal mb-4">{{ $page_title }}</h1>
            {{ $content }}
        </div>
    </main>

    @include('includes/footer')
</body>
</html>
