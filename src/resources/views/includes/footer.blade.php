{{-- Page footer --}}
<footer class="footer mt-auto py-3 bg-body-tertiary text-center">
    <div class="container">
        <span class="text-body-secondary">{!! $copyright !!}</span>
    </div>
</footer>

{{-- Scripts section --}}
@vite(['resources/bootstrap/js/bootstrap.bundle.min.js'])
@stack('scripts')
