<x-guest-layout>
    <x-slot name="page_title">{{ __('Register') }}</x-slot>

    <x-slot name="content">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <x-input-label for="name" :value="__('Name')" />
                <x-input-text type="text" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email address')" />
                <x-input-text type="email" id="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-input-text type="password" id="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input-text type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>

            <div class="d-flex">
                <div class="d-inline-block">
                    <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
                </div>
                <div class="d-inline-block flex-grow-1">
                    <x-button-primary :value="__('Register')" />
                </div>
            </div>
        </form>
    </x-slot>
</x-guest-layout>
