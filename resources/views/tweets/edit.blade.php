<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('tweets.update', $tweet->id) }}">
            @csrf
            @method('PATCH')
            <textarea name="message" id="message" placeholder="Apa yang kamu pikirkan?"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $tweet->message }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>Update</x-primary-button>
                <a href="{{ route('tweets.index')}}">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>