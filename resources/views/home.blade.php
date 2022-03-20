<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight px-6 py-2">
            <form class="flex gap-x-2 flex-wrap" action="{{ route('home') }}">
                <div class="flex justify-between">
                    <div class="flex flex-col items-stretch gap-y-1">
                        <div class="flex flex-col items-stretch">
                            <h1 class="text-lg font-bold">
                                Specialities
                            </h1>

                            <div class="flex gap-x-2">
                                @foreach ($specialities as $speciality)
                                    <div class="flex items-center gap-x-1 mt-1">
                                        @if ($speciality->checked)
                                            <x-input id="{{ 'specialities.' . $speciality->id }}"
                                                class="block" type="checkbox" name="specialities[]"
                                                value="{{ $speciality->id }}" checked />
                                        @else
                                            <x-input id="{{ 'specialities.' . $speciality->id }}"
                                                class="block" type="checkbox" name="specialities[]"
                                                value="{{ $speciality->id }}" />
                                        @endif

                                        <x-label for="{{ 'specialities.' . $speciality->id }}">
                                            {{ Str::ucfirst($speciality->name) }}
                                        </x-label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex flex-col items-stretch">
                            <h1 class="text-lg font-bold">
                                Services
                            </h1>

                            <div class="flex gap-x-2">
                                @foreach ($services as $service)
                                    <div class="flex items-center gap-x-1 mt-1">
                                        @if ($service->checked)
                                            <x-input id="{{ 'services.' . $service->id }}" class="block"
                                                type="checkbox" name="services[]" value="{{ $service->id }}"
                                                checked />
                                        @else
                                            <x-input id="{{ 'services.' . $service->id }}" class="block"
                                                type="checkbox" name="services[]" value="{{ $service->id }}" />
                                        @endif
                                        <x-label for="{{ 'services.' . $service->id }}">
                                            {{ Str::ucfirst($service->name) }}
                                        </x-label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex flex-col items-stretch">
                            <h1 class="text-lg font-bold">
                                Prefer Languages
                            </h1>

                            <div class="flex gap-x-2">
                                @foreach ($preferLanguages as $preferLanguage)
                                    <div class="flex items-center gap-x-1 mt-1">
                                        @if ($preferLanguage->checked)
                                            <x-input id="{{ 'languages.' . $preferLanguage->id }}"
                                                class="block" type="checkbox" name="languages[]"
                                                value="{{ $preferLanguage->id }}" checked />
                                        @else
                                            <x-input id="{{ 'languages.' . $preferLanguage->id }}"
                                                class="block" type="checkbox" name="languages[]"
                                                value="{{ $preferLanguage->id }}" />
                                        @endif
                                        <x-label for="{{ 'languages.' . $preferLanguage->id }}">
                                            {{ Str::ucfirst($preferLanguage->name) }}
                                        </x-label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-stretch m-2 gap-y-4">

                    <div class="flex flex-col items-stretch">
                        <x-label for="sort">
                            Sort by
                        </x-label>
                        <select id="sort" class="block" name="sort" required>
                            <option value="most_relavant" @if ($sort === 'most_relavant') selected @endif>Most
                                relavant</option>
                            <option value="most_irrelevant" @if ($sort === 'most_irrelevant') selected @endif>Most
                                irrelevant</option>
                        </select>
                    </div>

                    <div class="flex">
                        <x-button class="ml-3">
                            {{ __('Filter') }}
                        </x-button>
                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3"
                            href={{ route('home') }}>Recommend</a>
                    </div>
                </div>
            </form>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <ul class="flex flex-wrap justify-evenly gap-2 m-2">
            @foreach ($counsellors as $counsellor)
                <li class="flex flex-col items-stretch w-60 bg-white rounded-lg overflow-hidden">
                    <a class="flex flex-col items-stretch"
                        href="{{ route('counsellors.show', ['counsellorDetail' => $counsellor]) }}">
                        <img class="w-full object-cover" src="{{ $counsellor->latestImage?->src }}"
                            alt="{{ $counsellor->latestImage?->alt }}" />
                        <div class="flex flex-col m-2 gap-y-1">
                            <h1 class="text-lg font-bold">{{ $counsellor->user->name }}</h1>
                            <h2 class="text-sm line-clamp-5">{{ $counsellor->description }}</h2>
                            <hr />
                            <h3 class="text-xs font-semibold">
                                Specialized in -
                                {{ implode(', ', $counsellor->specialities->pluck('name')->toArray()) }}</h3>

                            <hr />
                            <h3 class="text-xs font-semibold">
                                Services -
                                {{ implode(', ', $counsellor->services->pluck('name')->toArray()) }}</h3>

                            <hr />
                            <h3 class="text-xs font-semibold">
                                Prefer languages -
                                {{ implode(', ', $counsellor->preferLanguages->pluck('name')->toArray()) }}</h3>
                            <em class="text-[0.5em] self-end">Matched filters - {{ $counsellor->rank }}</em>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="m-4">
            {{ $counsellors->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
