<app-layout>
    <x-app-layout>
        <x-slot name="header">
        </x-slot>

        <div class="max-w-7xl mx-auto">
            <div class="flex bg-white p-4 m-8 gap-x-8 rounded-xl overflow-hidden">
                <div class="flex flex-col items-stretch gap-1 w-96 rounded-lg overflow-hidden">
                    <img class="w-full object-cover" src="{{ $counsellor->latestImage?->src }}"
                        alt="{{ $counsellor->latestImage?->alt }}" />
                    <h1 class="text-xl font-bold">{{ $counsellor->user->name }}</h1>
                    <h2 class="text-base">{{ $counsellor->description }}</h2>
                </div>

                <div class="flex flex-col items-stretch gap-y-4">
                    <div class="flex flex-col items-stretch">
                        <h2 class="text-base font-semibold">Specilities</h2>
                        <ul class="list-inside list-disc">
                            @foreach ($counsellor->specialities as $specility)
                                <li class="list-item text-sm">
                                    {{ Str::ucfirst($specility->name) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex flex-col items-stretch">
                        <h2 class="text-base font-semibold">Services</h2>
                        <ul class="list-inside list-disc">
                            @foreach ($counsellor->services as $service)
                                <li class="list-item text-sm">
                                    {{ Str::ucfirst($service->name) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex flex-col items-stretch">
                        <h2 class="text-base font-semibold">Prefer Languages</h2>
                        <ul class="list-inside list-disc">
                            @foreach ($counsellor->preferLanguages as $preferLanguage)
                                <li class="list-item text-sm">
                                    {{ Str::ucfirst($preferLanguage->name) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="flex flex-col items-stretch">
                        @if ($hasBooked)
                            <x-button disabled>
                                Already booked
                            </x-button>
                        @else
                            <form action="{{ route('bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="booker_id" value="{{ Auth::id() }}" />
                                <input type="hidden" name="booked_id" value="{{ $counsellor->user_id }}" />
                                <x-button>
                                    Book it now !!
                                </x-button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

</app-layout>
