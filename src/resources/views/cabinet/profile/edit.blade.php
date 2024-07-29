<x-app-layout>
    <x-slot name="page_title">{{ __('Profile') }}</x-slot>

    <x-slot name="content">
        <x-card-general>
            @include('cabinet.profile.partials.update-profile-information-form')
        </x-card-general>
        <x-card-general class="my-4">
            @include('cabinet.profile.partials.update-password-form')
        </x-card-general>
        <x-card-general>
            @include('cabinet.profile.partials.delete-user-form')
        </x-card-general>
    </x-slot>
</x-app-layout>
