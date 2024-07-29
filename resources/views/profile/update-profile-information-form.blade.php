<x-form-section submit="updateProfileInformation">
    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-12 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" class="dark:text-gray-50" />
<hr>
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-lg h-40 w-40 object-cover mx-auto">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-lg w-40 h-40 bg-cover bg-no-repeat bg-center mx-auto"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif
        <hr>
        <!-- url -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="u_id" value="{{ __('Your Link') }}" class="dark:text-gray-50" />
            <x-input id="u_id" type="text" class="mt-1 block w-full" wire:model="state.u_id" required
                autocomplete="u_id" />
            <x-input-error for="u_id" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" class="dark:text-gray-50" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" class="dark:text-gray-50" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
        <!-- facebook -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="facebook" value="{{ __('Facebook Url') }}" class="dark:text-gray-50" />
            <x-input id="facebook" type="url" class="mt-1 block w-full" wire:model="state.facebook"
                autocomplete="facebook" />
            <x-input-error for="facebook" class="mt-2" />
        </div>
        <!-- twitter -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="twitter" value="{{ __('Twitter Url') }}" class="dark:text-gray-50" />
            <x-input id="twitter" type="url" class="mt-1 block w-full" wire:model="state.twitter"
                autocomplete="twitter" />
            <x-input-error for="twitter" class="mt-2" />
        </div>
        <!-- linkedin -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="linkedin" value="{{ __('LinkedIn Url') }}" class="dark:text-gray-50" />
            <x-input id="linkedin" type="url" class="mt-1 block w-full" wire:model="state.linkedin"
                autocomplete="linkedin" />
            <x-input-error for="linkedin" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
