<x-guest-layout>
    <x-slot name="page_title">{{ __('Verify email') }}</x-slot>

    <x-slot name="content">
        @if (session('status') == 'verification-link-sent')
            <x-auth-session-status class="alert-success"
                                   :status="__('A new verification link has been sent to the email address you provided during registration.')" />
        @else
            <x-card-message>
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </x-card-message>
        @endif

        <div class="position-relative">
            <div class="position-absolute top-0 start-0">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-button-primary :value="__('Resend Verification Email')" />
                    </div>
                </form>
            </div>

            <div class="position-absolute top-0 end-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-button-primary :value="__('Log Out')" />
                </form>
            </div>
        </div>
    </x-slot>
</x-guest-layout>
