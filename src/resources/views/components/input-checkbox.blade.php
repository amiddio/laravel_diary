@props(['checked' => false, 'disabled' => false])

<input type="hidden" {!! $attributes !!} value="0" />
<input {{ $disabled ? 'disabled' : '' }} type="checkbox" {!! $attributes->merge(['class' => 'form-check-input']) !!} value="1" @if($checked) checked @endif />
