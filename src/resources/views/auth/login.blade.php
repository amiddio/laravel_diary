<x-guest-layout>

    <x-slot name="page_title">{{ __('Log in') }}</x-slot>

    <x-slot name="content">

        <!-- Session Status -->
        <x-auth-session-status class="alert-success" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <x-input-label for="email" :value="__('Email address')" />
                <x-input-text type="email" id="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-input-text type="password" id="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
            </div>

            <div class="d-flex">
                <div class="d-inline-block">
                    @if (Route::has('password.request'))
                        <div>
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                    @if (Route::has('register'))
                        <div>
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>
                    @endif
                </div>
                <div class="d-inline-block flex-grow-1">
                    <x-button-primary :value="__('Log in')" />
                </div>
            </div>
        </form>

    </x-slot>
</x-guest-layout>
