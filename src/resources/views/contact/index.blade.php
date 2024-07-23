<x-home-layout>
    <x-slot name="page_title">{{ __('Contact') }}</x-slot>

    <x-slot name="content">
        <div class="w-50">
            <form method="post" action="{{ route('contact.send') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-3 row">
                    <x-input-label for="name" class="col-sm-2 col-form-label" :value="__('Name')" />
                    <div class="col-sm-10">
                        <x-input-text type="text" id="name" name="name" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                </div>

                {{-- Email --}}
                <div class="mb-3 row">
                    <x-input-label for="email" class="col-sm-2 col-form-label" :value="__('Email')" />
                    <div class="col-sm-10">
                        <x-input-text type="text" id="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                </div>

                {{-- Subject --}}
                <div class="mb-3 row">
                    <x-input-label for="subject" class="col-sm-2 col-form-label" :value="__('Subject')" />
                    <div class="col-sm-10">
                        <x-input-text type="text" id="subject" name="subject" :value="old('subject')" required />
                        <x-input-error :messages="$errors->get('subject')" />
                    </div>
                </div>

                {{-- Message --}}
                <div class="mb-3 row">
                    <x-input-label for="message" class="col-sm-2 col-form-label" :value="__('Message')" />
                    <div class="col-sm-10">
                        <textarea name="message" class="form-control" rows="7" required>{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" />
                    </div>
                </div>

                <div class="mb-3 row">
                    <x-button-primary :value="__('Send')" />
                </div>
            </form>
        </div>
    </x-slot>

</x-home-layout>
