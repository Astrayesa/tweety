<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tweets.update', $tweet->id) }}">
            <textarea name="message" id="message" placeholder="Apa yang kamu pikirkan?"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                readonly>{{ $tweet->message }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <a href="{{ route('tweets.index')}}">Kembali</a>
            </div>
        </form>
    </div>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form method="POST" action="{{ route('tweets.comments.store', $tweet->id) }}">
                @csrf
                <input type="hidden" value="{{ $tweet->id }}" name="tweet_id" />
                <textarea name="message" id="message" placeholder="Apa komentar kamu?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <div class="mt-4 space-x-2">
                    <x-primary-button>Komentar</x-primary-button>
                    <!-- <a href="{{ route('tweets.index')}}">Kembali</a> -->
                </div>
            </form>
        </div>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach($comments as $tweet)
            <div class="p-6 flex space-x-2">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $tweet->user->name}}</span>
                            <small class="ml-2 text-sm text-gray-600">{{ $tweet->created_at->format("H:i:s d M Y")
                                }}</small>
                        </div>
                        @if($tweet->user->is(auth()->user()) || auth()->user()->email == 'test@example.com')
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    X
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('tweets.show', $tweet)">
                                    Show
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('tweets.edit', $tweet)">
                                    Edit
                                </x-dropdown-link>
                                <form method="post" action="{{ route('tweets.destroy', $tweet->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Hapus</button>
                                </form>
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