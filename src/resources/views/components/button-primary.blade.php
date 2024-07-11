@props(['value', 'position' => 'end', 'size' => ''])

<div class="text-{{ $position }}">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary ' . $size]) }}>
        {{ $value ?? $slot }}
    </button>
</div>
