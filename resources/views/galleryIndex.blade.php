<x-main-layout>
    <!-- component -->
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">
                {{ __('All galleries') }}</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @forelse ($galleries as $gallery)
                    <div class="lg:flex border-1 p-2">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="{{ Storage::url($gallery->image) }}"
                            alt="{{ $gallery->caption }}">
                    </div>
                @empty
                    <div class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">{{ __('No galleries founds') }}
                    </div>
                @endforelse
            </div>
            {{ $galleries->links() }}
        </div>
    </section>
</x-main-layout>
