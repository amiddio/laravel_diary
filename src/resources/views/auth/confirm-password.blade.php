<x-guest-layout>
    <x-slot name="page_title">{{ __('Confirm password') }}</x-slot>

    <x-slot name="content">
        <x-card-message>
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </x-card-message>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-3">
                <x-input-label for="password" :value="__('Password')" />
                <x-input-text type="password" id="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div>
                <x-button-primary :value="__('Confirm')" />
            </div>
        </form>
    </x-slot>
</x-guest-layout>
