<section>
    <header>
        <h3>
            {{ __('Update Password') }}
        </h3>

        <p class="fw-light">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    @if (session('status') === 'password-updated')
        <x-auth-session-status class="alert-success" :status="__('Saved.')" />
    @endif

    <div class="w-50">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <x-input-text id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div class="mb-3">
                <x-input-label for="update_password_password" :value="__('New Password')" />
                <x-input-text id="update_password_password" name="password" type="password" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" />
            </div>

            <div class="mb-3">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <x-input-text id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>

            <div class="mb-3">
                <x-button-primary :value="__('Save')" position="start" />
            </div>
        </form>
    </div>
</section>
