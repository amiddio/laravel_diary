<section>
    <header>
        <h3>
            {{ __('Delete Account') }}
        </h3>
        <p class="fw-light">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div class="w-50">
        @php
            $modal_id = 'delete-account';
        @endphp

        <x-modal :id="$modal_id" :title="__('Are you sure you want to delete your account?')" :submit_text="__('Delete Account')">
            <form method="post" action="{{ route('profile.destroy') }}" id="{{ $modal_id }}-form">
                @csrf
                @method('delete')
                <p class="fw-light">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
                <div class="mt-3">
                    <x-input-label for="password" value="{{ __('Password') }}" />
                    <x-input-text id="password" name="password" type="password" required autofocus />
                    <x-input-error :messages="$errors->userDeletion->get('password')" />
                </div>
            </form>
        </x-modal>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $modal_id }}">
            {{ __('Delete') }}
        </button>

        @if($errors->userDeletion->get('password'))
            <script type="text/javascript">
                window.onload = () => {
                    const myModal = new bootstrap.Modal('#{{ $modal_id }}');
                    myModal.show();
                }
            </script>
        @endif

    </div>
</section>
