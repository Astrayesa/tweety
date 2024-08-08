<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tweets.store') }}">
            @csrf
            <textarea name="message" id="message" placeholder="Apa yang kamu pikirkan?"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">Tweet</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach($tweets as $tweet)
            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $tweet->user->name}}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ $tweet->created_at->format("H:i:s d M Y") }}</small>
                        </div>
                        @if($tweet->user->is(auth()->user()) || auth()->user()->email == 'test@example.com')
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    X
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('tweets.edit', $tweet)">
                                    Edit
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                        @endif
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{$tweet->message}}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-app-layout>