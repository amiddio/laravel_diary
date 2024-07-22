<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.html_head')
</head>
<body class="d-flex flex-column h-100">

    @include('includes.header')

    {{-- Begin page content --}}
    <main class="flex-shrink-0 mb-5">
        <div class="container">
            <h1 class="h2 fw-normal mb-4">{{ $page_title }}</h1>
            <div class="row">
                <div class="col-md-4">
                    {{ $content_left }}
                </div>
                <div class="col-md-8">
                    {{ $content }}
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
</body>
</html>
