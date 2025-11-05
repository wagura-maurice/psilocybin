<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            @include('profile.partials.two-factor-authentication-form')
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            @include('profile.partials.browser-sessions')
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
