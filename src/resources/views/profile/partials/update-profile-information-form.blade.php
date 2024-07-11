<section>
    <header>
        <h3>
            {{ __('Profile Information') }}
        </h3>

        <p class="fw-light">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    @if (session('status') === 'profile-updated')
        <x-auth-session-status class="alert-success"
                               :status="__('Saved.')" />
    @endif
    @if (session('status') === 'verification-link-sent')
        <x-auth-session-status class="alert-info"
                               :status="__('A new verification link has been sent to your email address.')" />
    @endif

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="w-50">
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <x-input-label for="name" :value="__('Name')" />
                <x-input-text id="name" name="name" type="text" :value="old('name', $user->name)" required autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-input-text id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="fw-light">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-primary">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <x-button-primary :value="__('Save')" position="start" />
            </div>
        </form>
    </div>
</section>
