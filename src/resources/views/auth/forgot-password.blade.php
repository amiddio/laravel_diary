<x-guest-layout>
    <x-slot name="page_title">{{ __('Forgot your password?') }}</x-slot>

    <x-slot name="content">
        <x-card-message>
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </x-card-message>

        <!-- Session Status -->
        <x-auth-session-status class="alert-success" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-input-text id="email" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="d-flex">
                <div class="d-inline-block">
                    <a href="{{ route('login') }}">{{ __('Log in') }}</a>
                </div>
                <div class="d-inline-block flex-grow-1">
                    <x-button-primary :value="__('Email Password Reset Link')" />
                </div>
            </div>

        </form>
    </x-slot>
</x-guest-layout>
