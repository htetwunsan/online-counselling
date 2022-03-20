<x-guest-layout>

    <div class="flex flex-col items-stretch justify-center m-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
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
                What led you to consider therapy today?
            </h1>

            @foreach ($questions as $question)
                <div class="flex items-center gap-x-2 mt-1">
                    <x-input id="{{ 'questions.' . $question->id }}" class="block" type="checkbox"
                        name="questions[]" value="{{ $question->id }}" />
                    <x-label for="{{ 'questions.' . $question->id }}">
                        {{ $question->name }}
                    </x-label>
                </div>
            @endforeach

            <h1 class="text-xl font-bold my-4">
                How do you prefer to communicate with your therapist?
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
                What is your preferred language?
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </div>
</x-guest-layout>
