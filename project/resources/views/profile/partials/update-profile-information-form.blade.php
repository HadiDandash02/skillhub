<section class="profile-info-section">
    <header class="profile-info-header">
        <h2 class="profile-info-title">{{ __('Profile Information') }}</h2>
        <p class="profile-info-description">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="profile-info-form mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="profile-info-field">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="profile-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="profile-info-field">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="profile-input" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="profile-info-save flex items-center gap-4">
            <x-primary-button class="save-button">{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="status-message">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
