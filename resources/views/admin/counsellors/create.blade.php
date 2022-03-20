<x-app-layout>

    <x-slot name="header">
        <h1 class="mx-4">Create new counsellor</h1>
    </x-slot>

    <div class="flex flex-col items-stretch justify-center m-4">
        <h2 class="text-green-500">{{ session('success') }}</h2>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.counsellors.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />

                <textarea id="description"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="description"></textarea>
            </div>

            <div class="mt-4">
                <x-label for="image" :value="__('Image')" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <h1 class="text-xl font-bold my-4">
                Specialities
            </h1>

            @foreach ($specialities as $speciality)
                <div class="flex items-center gap-x-2 mt-1">
                    <x-input id="{{ 'specialities.' . $speciality->id }}" class="block" type="checkbox"
                        name="specialities[]" value="{{ $speciality->id }}" />
                    <x-label for="{{ 'specialities.' . $speciality->id }}">
                        {{ $speciality->name }}
                    </x-label>
                </div>
            @endforeach

            <h1 class="text-xl font-bold my-4">
                Services
            </h1>

            @foreach ($services as $service)
                <div class="flex items-center gap-x-2 mt-1">
                    <x-input id="{{ 'services.' . $service->id }}" class="block" type="checkbox"
                        name="services[]" value="{{ $service->id }}" />
                    <x-label for="{{ 'services.' . $service->id }}">
                        {{ Str::ucfirst($service->name) }}
                    </x-label>
                </div>
            @endforeach

            <h1 class="text-xl font-bold my-4">
                Prefer languages
            </h1>

            @foreach ($preferLanguages as $preferLanguage)
                <div class="flex items-center gap-x-2 mt-1">
                    <x-input id="{{ 'languages.' . $preferLanguage->id }}" class="block" type="checkbox"
                        name="languages[]" value="{{ $preferLanguage->id }}" />
                    <x-label for="{{ 'languages.' . $preferLanguage->id }}">
                        {{ Str::ucfirst($preferLanguage->name) }}
                    </x-label>
                </div>
            @endforeach

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Create') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
